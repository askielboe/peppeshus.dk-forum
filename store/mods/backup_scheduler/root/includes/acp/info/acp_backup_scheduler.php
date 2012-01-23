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
* @package module_install
*/
class acp_backup_scheduler_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_backup_scheduler',
			'title'		=> 'ACP_BACKUP_SCHEDULER',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'main'		=> array('title'	=> 'ACP_BACKUP_SCHEDULER', 'auth'	=> 'acl_a_backup', 'cat'	=> array('ACP_CAT_DATABASE')),
			),
		);
	}

	function install()
	{
	}

	function uninstall()
	{
	}
}

?>