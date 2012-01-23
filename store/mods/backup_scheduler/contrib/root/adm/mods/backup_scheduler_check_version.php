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
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package backup_scheduler_check_version
*/
class backup_scheduler_check_version
{
	function version()
	{
		return array(
			'author'	=> 'david63',
			'title'		=> 'Backup Scheduler',
			'tag'		=> 'backup_scheduler_check',
			'version'	=> '0.0.4',
			'file'		=> array('mywebworld.org.uk', 'updatecheck', 'backup_scheduler.xml'),
		);
	}
}

?>