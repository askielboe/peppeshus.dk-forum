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

/**
* @package acp
*/
class acp_backup_scheduler
{
	var $u_action;

	function main($id, $mode)
	{
		global $db, $user, $auth, $template, $table_prefix;
		global $config, $phpbb_root_path, $phpbb_admin_path, $phpEx;

		if (!function_exists('scheduled_backup'))
		{
			include($phpbb_root_path . 'includes/functions_backup_scheduler.' . $phpEx);
		}

		$action		= request_var('action', '');
		$backup_id	= request_var('backup_id', 0);

		$user->add_lang('acp/database');

		$form_name = 'acp_backup_scheduler';
		add_form_key($form_name);

		$this->tpl_name		= 'acp_backup_scheduler';
		$this->page_title	= 'ACP_BACKUP_SCHEDULER';

		// Some of this code has been adapted from acp_database.php
		switch ($action)
		{					
			case 'edit':
				$sql = 'SELECT *
					FROM ' . BACKUP_SCHEDULER_TABLE . '
					WHERE '  . $db->sql_in_set('backup_id', $backup_id);
				$result = $db->sql_query($sql);

				$row = $db->sql_fetchrow($result);

				$backup_tables = unserialize($row['backup_tables']);
				$hidden_fields = '';
				if (!$config['backup_ftp'])
				{
					$hidden_fields .= build_hidden_fields(array('ftp'	=> $row['backup_ftp']));
				}
				if (!$config['backup_posts'])
				{
					$hidden_fields .= build_hidden_fields(array('post_count' => $row['backup_post_count']));
				}

				$template->assign_vars(array(				
					'FREQUENCY'			=> $row['backup_frequency'],
					'KEEP'				=> $row['backup_expire'],
					'NAME'				=> $row['backup_name'],
					'POST_COUNT'		=> $row['backup_post_count'],
					'SCHEDULER_HEAD'	=> $user->lang['EDIT_SCHEDULE'],

					'S_ACTIVE'			=> ($row['backup_active']) ? true : false,
					'S_EDIT'			=> true,
					'S_FTP'				=> ($row['backup_ftp']) ? true : false,
					'S_FTP_BACKUP'		=> $config['backup_ftp'],
					'S_POSTS_BACKUP'	=> $config['backup_posts'],
					'S_TYPE_DATA'		=> ($row['backup_type'] == 'data') ? true :false,
					'S_TYPE_FULL'		=> ($row['backup_type'] == 'full') ? true :false,					
					'S_TYPE_STRUCTURE'	=> ($row['backup_type'] == 'structure') ? true :false,					

					'S_HIDDEN_FIELDS'	=> $hidden_fields,
					'U_ACTION'			=> $this->u_action . '&amp;action=update&amp;backup_id=' . $backup_id,
				));

				// No break here by design

			case 'add':
				$available_methods = array('gzip' => 'zlib', 'bzip2' => 'bz2', 'text' => 'text');

				foreach ($available_methods as $type => $module)
				{
					if ($module != 'text' && !@extension_loaded($module))
					{
						continue;
					}

					$displayed_type = $type;
					if ($action == 'edit')
					{
						if ($type == $row['backup_file_type'])
						{
							$displayed_type .= '" checked="checked';
						}
					}
					$displayed_type .= '" />';

					$template->assign_block_vars('methods', array(
						'DISPLAY'	=> $displayed_type,
						'TYPE'		=> $user->lang['file_type'][$type],
					));
				}
				
				include($phpbb_root_path . 'includes/functions_install.' . $phpEx);
				$tables = get_tables($db);			
				foreach ($tables as $table_name)
				{
					$table_list = '<option value="' . $table_name;
					if ($action == 'edit')
					{
						if (in_array($table_name, $backup_tables))
						{
							$table_list .=  '" selected="selected';
						}
					}
					$table_list .= '" > ' . $table_name . '</option>';

					$template->assign_block_vars('tables', array(
						'TABLE'	=> $table_list
					));
				}

				if ($action == 'add')
				{
					$template->assign_vars(array(
						'SCHEDULER_HEAD'	=> $user->lang['ADD_SCHEDULE'],

						'S_ADD'				=> true,
						'S_TYPE_FULL'		=> true,

						'U_ACTION'			=> $this->u_action . '&amp;action=save',
						'U_BACK'			=> $this->u_action,
					));
				}
			break;
			
			case 'save':
			case 'update':
				$name		= utf8_normalize_nfc(request_var('name', '', true));
				$active		= request_var('active', 1);
				$type		= request_var('type', '');
				$table		= request_var('table', array(''));
				$method		= request_var('method', '');
				$frequency	= request_var('frequency', 0);
				$post_count	= request_var('post_count', 0);
				$expire		= request_var('expire', 0);
				$ftp		= request_var('ftp', 0);

				// Validate the input form
				if (!check_form_key($form_name))
				{
					trigger_error($user->lang['FORM_INVALID'] . adm_back_link($this->u_action . '&amp;u=' . $backup_id), E_USER_WARNING);
				}

				if (!$name)
				{
					trigger_error($user->lang['NO_NAME_ENTERED'] . adm_back_link($this->u_action . '&amp;action=add'), E_USER_WARNING);
				}
				if (!sizeof($table))
				{
					trigger_error($user->lang['NO_TABLES_SELECTED'] . adm_back_link($this->u_action . '&amp;action=add'), E_USER_WARNING);
				}
				if (!$frequency)
				{
					trigger_error($user->lang['NO_FREQUENCY_ENTERED'] . adm_back_link($this->u_action . '&amp;action=add'), E_USER_WARNING);
				}
				if (!$expire)
				{
					trigger_error($user->lang['NO_KEEP_ENTERED'] . adm_back_link($this->u_action . '&amp;action=add'), E_USER_WARNING);
				}
					
				if ($action == 'save')
				{
					$sql = 'INSERT INTO ' . BACKUP_SCHEDULER_TABLE . ' ' . $db->sql_build_array('INSERT', array(
						'backup_name'		=> $name,
						'backup_key'		=> strtolower(gen_rand_string(6)),
						'backup_type'		=> $type,
						'backup_file_type'	=> $method,
						'backup_tables'		=> serialize($table),
						'backup_frequency'	=> $frequency,
						'backup_post_count'	=> $post_count,
						'backup_next'		=> time(),
						'backup_expire'		=> $expire,
						'backup_ftp'		=> $ftp
					));

					$db->sql_query($sql);

					$backup_id = $db->sql_nextid();
				}
				else
				{
					$sql = 'UPDATE ' . BACKUP_SCHEDULER_TABLE . ' SET ' . $db->sql_build_array('UPDATE', array(
							'backup_name'		=> $name,
							'backup_active'		=> $active,
							'backup_type'		=> $type,
							'backup_file_type'	=> $method,
							'backup_tables'		=> serialize($table),
							'backup_frequency'	=> $frequency,
							'backup_post_count'	=> $post_count,
							'backup_expire'		=> $expire,
							'backup_ftp'		=> $ftp
						)) . '
						WHERE '  . $db->sql_in_set('backup_id', $backup_id);
					$db->sql_query($sql);
				}

				if ($action == 'save')
				{
					confirm_box(false, $user->lang['BACKUP_NOW'], build_hidden_fields(array(
						'backup_id'	=> $backup_id,
						'i'			=> $id,
						'mode'		=> $mode,
						'action'	=> 'backup'))
					);
				}
			break;

			case 'delete':
				$sql = 'SELECT backup_name
					FROM ' . BACKUP_SCHEDULER_TABLE . "
					WHERE backup_id = $backup_id";
				$result = $db->sql_query($sql);
				$row = $db->sql_fetchrow($result);
				$db->sql_freeresult($result);

				if ($row)
				{
					if (confirm_box(true))
					{
						$db->sql_query('DELETE FROM ' . BACKUP_SCHEDULER_TABLE . " WHERE backup_id = $backup_id");
						add_log('backup', 'LOG_SCHEDULE_DELETE', $row['backup_name']);
					}
					else
					{
						confirm_box(false, $user->lang['CONFIRM_OPERATION'], build_hidden_fields(array(
							'backup_id'	=> $backup_id,
							'i'			=> $id,
							'mode'		=> $mode,
							'action'	=> 'delete'))
						);
					}
				}
			break;

			case 'backup':
			case 'backup_now':
				if ($action == 'backup_now' || confirm_box(true))
				{
					scheduled_backup($backup_id);
				}
			break;

			case 'restore':
				$restore_file	= request_var('file', '');
				$backup_name	= request_var('name', '');

				if (confirm_box(true))
				{
					if ($backup_id)
					{
						// First we have to find the last backup from this schedule
						// Get the schedule key
						$sql = 'SELECT backup_key, backup_name
							FROM ' . BACKUP_SCHEDULER_TABLE . "
							WHERE backup_id = $backup_id";
						$result = $db->sql_query($sql);
		
						while ($row = $db->sql_fetchrow($result))
						{
							$backup_key = $row['backup_key'];
							$backup_name = $row['backup_name'];
						}
						$db->sql_freeresult($result);

						$restore_ary = array();

						// Get a list of the possible backup files
						$dir = $phpbb_root_path . 'store/';
						$dh = @opendir($dir);

						if ($dh)
						{
							while (($file = readdir($dh)) !== false)
							{
								if (preg_match('#^backup_(\d{10,})_[a-z\d]{16}\.(sql(?:\.(?:gz|bz2))?)$#', $file, $matches))
								{
									if (substr($matches[0], 18, 6) == $backup_key)
									{
										$restore_ary[] = $matches;
									}
								}
							}
							closedir($dh);
							}

						// Get the latest backup file
						$restore_file = '';
						if ($restore_ary)
						{
							foreach ($restore_ary as $key => $row)
							{
								$date[$key] = $row[1];
							}
							array_multisort($date, SORT_DESC, $restore_ary);
							// We now have the latest backup file
							$restore_file = $restore_ary[0][0];
						}
					}
					restore_backup($restore_file, $backup_name, $this->u_action);
					}
					else
					{
						confirm_box(false, $user->lang['SCHEDULE_RESTORE_EXPLAIN'], build_hidden_fields(array(
							'file'		=> $restore_file,
							'name'		=> $backup_name,
							'i'			=> $id,
							'mode'		=> $mode,
							'action'	=> 'restore'))
						);
					}
			break;

			case 'lock':
				$lock_file = $phpbb_root_path . 'cache/data_backup_lock.' .  $phpEx;
				unlink($lock_file); 
			break;

			default:
				$template->assign_vars(array(
					'SCHEDULER_HEAD'=> $user->lang['SCHEDULER_STATS'],
					'S_SCHEDULER'	=> true,					
				));
		}

		// Display the list of schedules
		$sql = 'SELECT *
			FROM ' . BACKUP_SCHEDULER_TABLE . '
			ORDER BY LOWER(backup_name)';
		$result = $db->sql_query($sql);

		while ($row = $db->sql_fetchrow($result))
		{
			$template->assign_block_vars('schedules', array(
				'ACTIVE'		=>($row['backup_active']) ? $user->lang['YES'] : $user->lang['NO'],
				'FREQUENCY'		=> $row['backup_frequency'] . ' ' . $user->lang['HOURS'],
				'FTP'			=> ($row['backup_ftp']) ? $user->lang['YES'] : $user->lang['NO'],
				'KEEP'			=> $row['backup_expire'] . ' ' . $user->lang['BUP_DAY'],
				'KEY'			=> $row['backup_key'],
				'LAST'			=> ($row['backup_last'] != 0) ? $user->format_date($row['backup_last']) : $user->lang['NO_BACKUP'],
				'NAME'			=> $row['backup_name'],
				'NEXT'			=> $user->format_date($row['backup_next']),
				'POST_COUNT'	=> $row['backup_post_count'],
				'TYPE'			=> $user->lang['type'][$row['backup_type']] . ' - ' . $user->lang['file_type'][$row['backup_file_type']],					

				'ICON_DELETE'	=> '<img src="' . $phpbb_admin_path . 'images/icon_delete.gif" alt="' . $user->lang['BACKUP_DELETE_ICON'] . '" title="' . $user->lang['BACKUP_DELETE_ICON'] . '" />',
				'ICON_EDIT'		=> '<img src="' . $phpbb_admin_path . 'images/icon_edit.gif" alt="' . $user->lang['BACKUP_EDIT'] . '" title="' . $user->lang['BACKUP_EDIT'] . '" />',
				'ICON_NOW'		=> '<img src="' . $phpbb_admin_path . 'images/file_new.gif" alt="' . $user->lang['BACKUP_NOW'] . '" title="' . $user->lang['BACKUP_NOW'] . '" />',
				'ICON_RESTORE'	=> '<img src="' . $phpbb_admin_path . 'images/icon_sync.gif" alt="' . $user->lang['RESTORE_LAST'] . '" title="' . $user->lang['RESTORE_LAST'] . '" />',

				'U_DELETE'		=> $this->u_action . '&amp;action=delete&amp;backup_id=' . $row['backup_id'],
				'U_EDIT'		=> $this->u_action . '&amp;action=edit&amp;backup_id=' . $row['backup_id'],
				'U_NOW'			=> $this->u_action . '&amp;action=backup_now&amp;backup_id=' . $row['backup_id'],
				'U_RESTORE'		=> $this->u_action . '&amp;action=restore&amp;backup_id=' . $row['backup_id'],
			));	

			$file_ary = array();
			$dir = $phpbb_root_path . 'store/';
			$dh = @opendir($dir);

			if ($dh)
			{
				while (($file = readdir($dh)) !== false)
				{
					$file_ary[] = $file;
				}
			}
			closedir($dh);

			sort($file_ary);
			$backups = '';
			foreach ($file_ary as $file)
			{
				if (preg_match('#^backup_(\d{10,})_[a-z\d]{16}\.(sql(?:\.(?:gz|bz2))?)$#', $file, $matches))
				{
					// Check that it is not a phpBB3 generated backup
					if (preg_match('/^[0-9]{1,}$/', substr($matches[0], 24, 10)) && $row['backup_key'] == substr($matches[0], 18, 6))
					{
						$backups .= '<a href="' . $this->u_action . '&amp;action=restore&amp;name=' . $row['backup_name'] . '&amp;file=' . $file . '" title="' . $user->lang['RESTORE_THIS'] . '">' . $user->format_date($matches[1]) . '</a><br />';	
					}
				}			
			}

			$template->assign_block_vars('schedules.files', array(
				'BACKUPS'	=> ($backups != '') ? $backups : $user->lang['RESTORE_NONE'],
			));
		}
		$db->sql_freeresult($result);

		$backup_status = ($config['backup_scheduler']) ? $user->lang['ACTIVE'] : $user->lang['NON_ACTIVE'];
		get_backup_counts($total_count, $scheduler_count);

		$install_check = false;
		if (file_exists($phpbb_root_path . 'install_backup_scheduler.' . $phpEx) || file_exists($phpbb_root_path . 'schemas'))
		{
			$install_check = true;
		}

		$template->assign_vars(array(
			'ACTION'			=> $this->u_action . '&amp;action=add',
			'U_ACTION_LOCK'		=> $this->u_action . '&amp;action=lock',

			'BACKUP_FILES'		=> sprintf($user->lang['BACKUP_FILES'], $total_count, $scheduler_count),
			'BACKUP_STATS'		=> sprintf($user->lang['BACKUP_STATS'], $backup_status, $user->format_date($config['backup_scheduler_next'])),
			'POST_STATS'		=> sprintf($user->lang['POST_STATS'], $config['backup_post_count'], $config['num_posts']),

			'S_FTP_BACKUP'		=> $config['backup_ftp'],
			'S_POSTS_BACKUP'	=> $config['backup_posts'],
			'S_INSTALL_CHECK'	=> $install_check,
			'S_LOCK_CHECK'		=> file_exists($phpbb_root_path . 'cache/data_backup_lock.' . $phpEx),
		));			
	}
}
		
?>