<?php
/** 
*
* @package acp_backup_scheduler
* @version $Id: 1.0.0
* @copyright (c) 2008 david63
* @license http://opensource.org/licenses/gpl-license.php GNU Public License  
*
*/

/**
* @ignore
*/

define('IN_PHPBB', true);

$phpbb_root_path = './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/info_acp_backup_scheduler');

if ($user->data['user_type'] != USER_FOUNDER)
{
	trigger_error($user->lang['NO_FOUNDER']);
}

$page_title		= $user->lang['INSTALL_BACKUP_SCHEDULER'];
$template_html	= 'message_body.html';

// Let's see if the table has been created
$sql = "SHOW TABLES LIKE '" . $table_prefix . 'backup_scheduler' . "'";
$result = $db->sql_query($sql);

$row = $db->sql_fetchrow($result);
$db->sql_freeresult($result);
$table_exists = ($row) ? true : false;

if (!$table_exists)
{
	load_schema($phpbb_root_path . 'schemas/');
}

// Insert config values
set_config('backup_post_count', 0, true);
set_config('backup_posts', 0, false);
set_config('backup_scheduler', '0', false);
set_config('backup_scheduler_next', time(), true);
set_config('backup_ftp', '0', false);
set_config('backup_ftp_host', '', false);
set_config('backup_ftp_user', '', false);
set_config('backup_ftp_pass', '', false);
set_config('backup_ftp_port', '', false);
set_config('backup_ftp_path', '', false);

// Automatically add the modules
require($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
$modules = new acp_modules();
$module_data = array();

$cat_module = 'ACP_CAT_DATABASE';

$acp_settings_parent = get_module_id('acp', $cat_module);

if (!$acp_settings_parent)
{
	trigger_error(sprintf($user->lang['CAT_ERROR'], $cat_module), E_USER_ERROR);
}

// Check that the module has not already been installed
$acp_module = 'ACP_BACKUP_SCHEDULER';

$acp_settings_module = get_module_id('acp', $acp_module);

if (!$acp_settings_module)
{
	//Define ACP Database Module
	$module_data[] = array('module_enabled' => '1', 'module_display' => '1', 'module_basename' => 'backup_scheduler',  'module_class' => 'acp', 'parent_id' => $acp_settings_parent, 'module_langname' => 'ACP_BACKUP_SCHEDULER', 'module_mode' => 'main', 'module_auth' => 'acl_a_backup');

	$acp_settings_parent = get_module_id('acp', 'ACP_BOARD_CONFIGURATION');

	//Define ACP Settings Module
	$module_data[] = array('module_enabled' => '1', 'module_display' => '1', 'module_basename' => 'board',  'module_class' => 'acp', 'parent_id' => $acp_settings_parent, 'module_langname' => 'ACP_BACKUP_SCHEDULER', 'module_mode' => 'schedule', 'module_auth' => 'acl_a_backup');

	$acp_settings_parent = get_module_id('acp', 'ACP_FORUM_LOGS');

	//Define ACP Logs Module
	$module_data[] = array('module_enabled' => '1', 'module_display' => '1', 'module_basename' => 'logs',  'module_class' => 'acp', 'parent_id' => $acp_settings_parent, 'module_langname' => 'ACP_BACKUP_LOGS', 'module_mode' => 'backup', 'module_auth' => 'acl_a_viewlogs');

	create_modules($module_data);
}

$cache->purge();

$template->assign_vars(array(
	'MESSAGE_TITLE'	=> $user->lang['INSTALL_BACKUP_SCHEDULER'],
	'MESSAGE_TEXT'	=> $user->lang['COMPLETE'],
	)
);

// Output the page
page_header($page_title);

$template->set_filenames(array(
	'body' => $template_html)
);

page_footer();

// The following functions are by poyntesm
// (modified to comply with mod db)

function create_modules($module_data)
{
	global $modules;

	for ($i = 0, $count = sizeof($module_data); $i < $count; $i++)
	{
		$errors = $modules->update_module_data($module_data[$i]);
		if (!sizeof($errors))
		{
			$modules->remove_cache_file();
		}
	}
}

function get_module_id($type, $module)
{
	global $db;

	$sql = 'SELECT module_id
		FROM ' . MODULES_TABLE . '
		WHERE ' . $db->sql_in_set('module_class', $type) . '
			AND ' . $db->sql_in_set('module_langname', $module);
	$result = $db->sql_query($sql);
	$row = $db->sql_fetchrow($result);

	return $row['module_id'];
}

// This function is by eviL<3 
function load_schema($install_path = '', $install_dbms = false)
{
	global $db;
	global $table_prefix;

	if ($install_dbms === false)
	{
		global $dbms;
		$install_dbms = $dbms;
	}

	static $available_dbms = false;

	if (!$available_dbms)
	{
		if (!function_exists('get_available_dbms'))
		{
			global $phpbb_root_path, $phpEx;
			include($phpbb_root_path . 'includes/functions_install.' . $phpEx);
		}

		$available_dbms = get_available_dbms($install_dbms);

		if ($install_dbms == 'mysql')
		{
			if (version_compare($db->mysql_version, '4.1.3', '>='))
			{
				$available_dbms[$install_dbms]['SCHEMA'] .= '_41';
			}
			else
			{
				$available_dbms[$install_dbms]['SCHEMA'] .= '_40';
			}
		}
	}

	$remove_remarks = $available_dbms[$install_dbms]['COMMENTS'];
	$delimiter = $available_dbms[$install_dbms]['DELIM'];

	$dbms_schema = $install_path . $available_dbms[$install_dbms]['SCHEMA'] . '_schema.sql';

	if (file_exists($dbms_schema))
	{
		$sql_query = @file_get_contents($dbms_schema);
		$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);

		$remove_remarks($sql_query);

		$sql_query = split_sql_file($sql_query, $delimiter);

		foreach ($sql_query as $sql)
		{
			$db->sql_query($sql);
		}
		unset($sql_query);
	}

	if (file_exists($install_path . 'schema_data.sql'))
	{
		$sql_query = file_get_contents($install_path . 'schema_data.sql');

		switch ($install_dbms)
		{
			case 'mssql':
			case 'mssql_odbc':
				$sql_query = preg_replace('#\# MSSQL IDENTITY (phpbb_[a-z_]+) (ON|OFF) \##s', 'SET IDENTITY_INSERT \1 \2;', $sql_query);
			break;

			case 'postgres':
				$sql_query = preg_replace('#\# POSTGRES (BEGIN|COMMIT) \##s', '\1; ', $sql_query);
			break;
		}

		$sql_query = preg_replace('#phpbb_#i', $table_prefix, $sql_query);
		$sql_query = preg_replace_callback('#\{L_([A-Z0-9\-_]*)\}#s', 'adjust_language_keys_callback', $sql_query);

		remove_remarks($sql_query);

		$sql_query = split_sql_file($sql_query, ';');

		foreach ($sql_query as $sql)
		{
			$db->sql_query($sql);
		}
		unset($sql_query);
	}
}

?>