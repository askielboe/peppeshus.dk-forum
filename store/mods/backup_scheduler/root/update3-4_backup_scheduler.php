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
set_config('backup_ftp_port', 20, false);
set_config('backup_post_count', 0, true);
set_config('backup_posts', 0, false);

$db_tools = new phpbb_db_tools($db);

// Insert column in the backup scheduler table
$db_tools->sql_column_add(BACKUP_SCHEDULER_TABLE, 'backup_post_count', array('UINT:4', 0));
$db_tools->sql_column_add(BACKUP_SCHEDULER_TABLE, 'backup_post_next', array('INT:11', 0));

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

?>