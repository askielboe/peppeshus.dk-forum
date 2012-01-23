<?php
/**
*
* @package acp_backup_scheduler
* @version 1.0.0
* @copyright (c) 2008 david63
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

global $phpbb_root_path,  $phpEx;
	
include_once($phpbb_root_path . 'includes/functions_messenger.' . $phpEx);

function backup_schedule_check()
{
	global $config;

	if ($config['backup_scheduler'])
	{
		if (time() >= $config['backup_scheduler_next'] || ($config['backup_posts'] && $config['num_posts'] >= $config['backup_post_count']))
		{
				scheduled_backup();
		}
	}
	return;
}

// Some of this code has been adapted from acp_database.php
function scheduled_backup($id = 0, $action = '')
{
	global $db, $config, $phpEx, $phpbb_root_path, $user;

	if ($id == 0)
	{
		// Is this script already running?
		$lock_file = $phpbb_root_path . 'cache/data_backup_lock.' .  $phpEx;
		if (file_exists($lock_file))
		{
			return;
		}
		$fp = fopen($lock_file, 'w');
		fclose($fp);

		// Find out which (if any) schedules have to be run at this time
		$sql = 'SELECT *
			FROM ' . BACKUP_SCHEDULER_TABLE . '
			WHERE backup_next <= ' . time() . '
			OR ' . $config['num_posts'] . ' >= backup_post_next';
		$result = $db->sql_query($sql);
	}
	else
	{
		// We are getting a schedule passed to us
		$sql = 'SELECT *
			FROM ' . BACKUP_SCHEDULER_TABLE . '
			WHERE backup_id = ' . $id;
		$result = $db->sql_query($sql);
	}

	$schedule_ary = array();
	while ($row = $db->sql_fetchrow($result))
	{
		$schedule_ary[] = $row;
	}
	$db->sql_freeresult($result);

	if ($schedule_ary)
	{
		if (!class_exists('acp_database'))
		{
			include($phpbb_root_path . 'includes/acp/acp_database.' . $phpEx);
		}

		// Run the schedules
		foreach ($schedule_ary as $row)
		{				
			if ($row['backup_active'] || $id != 0)
			{
				$download = $structure = $schema_data = false;
				$store = true;

				if ($row['backup_type'] == 'full' || $row['backup_type'] == 'structure')
				{
					$structure = true;
				}

				if ($row['backup_type'] == 'full' || $row['backup_type'] == 'data')
				{
					$schema_data = true;
				}

				@set_time_limit(1200);

				$time = time();
				$expire = $time + ($row['backup_expire'] * 86400);

				$filename = 'backup_' . $time . '_' . $row['backup_key'] . $expire;
				switch ($db->sql_layer)
				{
					case 'mysqli':
					case 'mysql4':
					case 'mysql':
						$extractor = new mysql_extractor($download, $store, $row['backup_file_type'], $filename, $time);
					break;

					case 'sqlite':
						$extractor = new sqlite_extractor($download, $store, $row['backup_file_type'], $filename, $time);
					break;

					case 'postgres':
						$extractor = new postgres_extractor($download, $store, $row['backup_file_type'], $filename, $time);
					break;

					case 'oracle':
						$extractor = new oracle_extractor($download, $store,$row['backup_file_type'], $filename, $time);
					break;

					case 'mssql':
					case 'mssql_odbc':
						$extractor = new mssql_extractor($download, $store, $row['backup_file_type'], $filename, $time);
					break;

					case 'firebird':
						$extractor = new firebird_extractor($download, $store, $row['backup_file_type'], $filename, $time);
					break;
				}

				$extractor->write_start('*');

				foreach (unserialize($row['backup_tables']) as $table_name)
				{
					// Get the table structure
					if ($structure)
					{
						$extractor->write_table($table_name);
					}
					else
					{
						// We might wanna empty out all that junk :D
						switch ($db->sql_layer)
						{
							case 'sqlite':
							case 'firebird':
								$extractor->flush('DELETE FROM ' . $table_name . ";\n");
							break;

							case 'mssql':
							case 'mssql_odbc':
								$extractor->flush('TRUNCATE TABLE ' . $table_name . "GO\n");
							break;

							case 'oracle':
								$extractor->flush('TRUNCATE TABLE ' . $table_name . "\\\n");
							break;

							default:
								$extractor->flush('TRUNCATE TABLE ' . $table_name . ";\n");
							break;
						}
					}

					// Data
					if ($schema_data)
					{
						$extractor->write_data($table_name);
					}
				}

				$extractor->write_end();

				// Do the ftp bit here
				if ($config['backup_ftp'] && $row['backup_ftp'])
				{			
					// Get the file extension
					$extn_ary = array(
						'gzip'	=> '.sql.gz',
						'bzip2'	=> '.sql.bz2',
						'text'	=> '.sql',
					);
					$extn = $extn_ary[$row['backup_file_type']];
	
					$source_file = $phpbb_root_path . 'store/' . $filename . $extn;
					$destination_file = $config['backup_ftp_path'] . '/' . str_replace(' ', '_', substr(trim($row['backup_name']), 0, 10)) . '_' . date('dmy_His', $time) . $extn;

					if (!file_exists($source_file))
					{
						add_log('backup', 'LOG_FILE_INVALID', $row['backup_name']);
					}
					else
					{
						$ftp_port = (!$config['backup_ftp_port']) ? 21 : $config['backup_ftp_port'];
						$connection = @ftp_connect($config['backup_ftp_host'], $ftp_port);
						// Attempt to set passive mode
						@ftp_pasv($connection, true);

						// Check the connection and attempt to login
						if (!$connection || !@ftp_login($connection, $config['backup_ftp_user'], $config['backup_ftp_pass']))
						{ 
							add_log('backup', 'LOG_FTP_FAIL', $row['backup_name']);
						}
						else
						{
							// Upload and chek the file
							if (!@ftp_put($connection, $destination_file, $source_file, FTP_BINARY))
							{ 
								add_log('backup', 'LOG_UPLOAD_FAIL', $row['backup_name']);
							}
							else
							{
								add_log('backup', 'LOG_UPLOAD_SUCCESS', $row['backup_name']);
							}
	
							// Close the FTP stream 
							ftp_close($connection);
						}
					}
				}
		
				// Update the schedules table
				$next_schedule = $time + ($row['backup_frequency'] * 3600);
				$next_count = $config['num_posts'] + $row['backup_post_count'];

				$sql = 'UPDATE ' . BACKUP_SCHEDULER_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
						'backup_last'		=> $time,
						'backup_next'		=> $next_schedule,
						'backup_post_next'	=> $next_count
					)) .'
					WHERE backup_id = ' . $row['backup_id'];
				$db->sql_query($sql);

				add_log('backup', 'LOG_SCHEDULE_RUN', $row['backup_name']);
			}
		}

		// Get next backup/post count schedule and put it in the config table
		$sql = 'SELECT MIN(backup_next) AS next_backup, MIN(IF(backup_post_next > 0, backup_post_next, NULL)) AS post_count
			FROM ' . BACKUP_SCHEDULER_TABLE . '
			WHERE backup_active = ' . true;
		$result = $db->sql_query($sql);
		$row = $db->sql_fetchrow($result);
		$next_schedule = $row['next_backup'];

		set_config('backup_scheduler_next', $next_schedule, true);
		if ($config['backup_posts'])
		{
			// We need to check if all post count have been set to zero and if so add 10000 to the config
			// count so that the backup does not run after every post!!!!
			$next_count = ($row['post_count'] != $config['num_posts']) ? $row['post_count'] : $config['num_posts'] + 10000;
			set_config('backup_post_count', $next_count, true);
		}
		$db->sql_freeresult($result);

		// We need to see if there are any backup files that we can remove
		$dir = $phpbb_root_path . 'store/';
		$dh = @opendir($dir);

		if ($dh)
		{
			while (($file = readdir($dh)) !== false)
			{
				if (preg_match('#^backup_(\d{10,})_[a-z\d]{16}\.(sql(?:\.(?:gz|bz2))?)$#', $file, $matches))
				{
					// Check that it is not a phpBB3 generated backup
					if (preg_match('/^[0-9]{1,}$/', substr($matches[0], 24, 10)) && time() > substr($matches[0], 24, 10))
					{
						unlink($dir . $file);
					}
				}
			}
			closedir($dh);
		}
	}
	if ($id == 0)
	{
		// Remove the lock file
		unlink($lock_file); 
	}
	return;
}

function restore_backup($file, $backup_name = '', $action = '')
{
	global $db, $phpbb_root_path, $user, $phpEx;

	if (!class_exists('acp_database'))
	{
		include($phpbb_root_path . 'includes/acp/acp_database.' . $phpEx);
	}

	if (!preg_match('#^backup_\d{10,}_[a-z\d]{16}\.(sql(?:\.(?:gz|bz2))?)$#', $file, $matches))
	{
		trigger_error($user->lang['BACKUP_INVALID'] . adm_back_link($action), E_USER_WARNING);
	}

	$file_name = $phpbb_root_path . 'store/' . $file;

	if (!file_exists($file_name) || !is_readable($file_name))
	{
		trigger_error($user->lang['BACKUP_INVALID'] . adm_back_link($action), E_USER_WARNING);
	}

	switch ($matches[1])
	{
		case 'sql':
			$fp = fopen($file_name, 'rb');
			$read = 'fread';
			$seek = 'fseek';
			$eof = 'feof';
			$close = 'fclose';
			$fgetd = 'fgetd';
		break;

		case 'sql.bz2':
			$fp = bzopen($file_name, 'r');
			$read = 'bzread';
			$seek = '';
			$eof = 'feof';
			$close = 'bzclose';
			$fgetd = 'fgetd_seekless';
		break;

		case 'sql.gz':
			$fp = gzopen($file_name, 'rb');
			$read = 'gzread';
			$seek = 'gzseek';
			$eof = 'gzeof';
			$close = 'gzclose';
			$fgetd = 'fgetd';
		break;
	}

	switch ($db->sql_layer)
	{
		case 'mysql':
		case 'mysql4':
		case 'mysqli':
		case 'sqlite':
			while (($sql = $fgetd($fp, ";\n", $read, $seek, $eof)) !== false)
			{
				$db->sql_query($sql);
			}
		break;

		case 'firebird':
			$delim = ";\n";
			while (($sql = $fgetd($fp, $delim, $read, $seek, $eof)) !== false)
			{
				$query = trim($sql);
				if (substr($query, 0, 8) === 'SET TERM')
				{
					$delim = $query[9] . "\n";
					continue;
				}
				$db->sql_query($query);
			}
		break;

		case 'postgres':
			$delim = ";\n";
			while (($sql = $fgetd($fp, $delim, $read, $seek, $eof)) !== false)
			{
				$query = trim($sql);
				$db->sql_query($query);
				if (substr($query, 0, 4) == 'COPY')
				{
					while (($sub = $fgetd($fp, "\n", $read, $seek, $eof)) !== '\.')
					{
						if ($sub === false)
						{
							trigger_error($user->lang['RESTORE_FAILURE'] . adm_back_link($action), E_USER_WARNING);
						}
						pg_put_line($db->db_connect_id, $sub . "\n");
					}
					pg_put_line($db->db_connect_id, "\\.\n");
					pg_end_copy($db->db_connect_id);
				}
			}
		break;

		case 'oracle':
			while (($sql = $fgetd($fp, "/\n", $read, $seek, $eof)) !== false)
			{
				$db->sql_query($sql);
			}
		break;

		case 'mssql':
		case 'mssql_odbc':
			while (($sql = $fgetd($fp, "GO\n", $read, $seek, $eof)) !== false)
			{
				$db->sql_query($sql);
			}
		break;
	}

	$close($fp);

	add_log('backup', 'LOG_SCHEDULE_RESTORE', $backup_name);
	trigger_error($user->lang['RESTORE_SUCCESS'] . adm_back_link($action));
}

function get_backup_counts(&$total_count, &$scheduler_count)
{
	global $phpbb_root_path;

	$dir = $phpbb_root_path . 'store/';
	$dh = @opendir($dir);

	$total_count = 0;
	$scheduler_count = 0;

	if ($dh)
	{
		while (($file = readdir($dh)) !== false)
		{
			if (preg_match('#^backup_(\d{10,})_[a-z\d]{16}\.(sql(?:\.(?:gz|bz2))?)$#', $file, $matches))
			{
				$total_count ++;
				// Check that it is not a phpBB3 generated backup
				if (preg_match('/^[0-9]{1,}$/', substr($matches[0], 24, 10)))
				{
					$scheduler_count ++;
				}
			}
		}
		closedir($dh);
	}
}

?>