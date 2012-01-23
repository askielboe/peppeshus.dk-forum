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
include($phpbb_root_path . 'includes/db/db_tools.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup('mods/info_acp_backup_scheduler');

if ($user->data['user_type'] != USER_FOUNDER)
{
	trigger_error($user->lang['NO_FOUNDER']);
}

$page_title		= $user->lang['UPDATE_BACKUP_SCHEDULER'];
$template_html	= 'message_body.html';

// Insert config values
set_config('backup_ftp', '0', false);
set_config('backup_ftp_host', '', false);
set_config('backup_ftp_user', '', false);
set_config('backup_ftp_pass', '', false);
set_config('backup_ftp_port', 20, false);
set_config('backup_ftp_path', '', false);
set_config('backup_post_count', 0, true);
set_config('backup_posts', 0, false);

$db_tools = new phpbb_db_tools($db);

// Insert column in the backup scheduler table
$db_tools->sql_column_add(BACKUP_SCHEDULER_TABLE, 'backup_ftp', array('TINT:1', 0));
$db_tools->sql_column_add(BACKUP_SCHEDULER_TABLE, 'backup_post_count', array('UINT:4', 0));
$db_tools->sql_column_add(BACKUP_SCHEDULER_TABLE, 'backup_post_next', array('INT:11', 0));

// Automatically add the module
require($phpbb_root_path . 'includes/acp/acp_modules.' . $phpEx);
$modules = new acp_modules();
$module_data = array();

$acp_settings_parent = get_module_id('acp', 'ACP_BOARD_CONFIGURATION');

//Define ACP Settings Module
$module_data[] = array('module_enabled' => '1', 'module_display' => '1', 'module_basename' => 'board',  'module_class' => 'acp', 'parent_id' => $acp_settings_parent, 'module_langname' => 'ACP_BACKUP_SCHEDULER', 'module_mode' => 'schedule', 'module_auth' => 'acl_a_backup');

$acp_settings_parent = get_module_id('acp', 'ACP_FORUM_LOGS');

//Define ACP Settings Module
$module_data[] = array('module_enabled' => '1', 'module_display' => '1', 'module_basename' => 'logs',  'module_class' => 'acp', 'parent_id' => $acp_settings_parent, 'module_langname' => 'ACP_BACKUP_LOGS', 'module_mode' => 'backup', 'module_auth' => 'acl_a_viewlogs');

create_modules($module_data);

$cache->purge();

$template->assign_vars(array(
	'MESSAGE_TITLE'	=> $user->lang['UPDATE_BACKUP_SCHEDULER'],
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

?>