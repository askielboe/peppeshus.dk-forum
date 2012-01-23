<?php
/**
*
* @package phpBB Gallery
* @version $Id: acp_gallery_permissions.php 1122 2009-04-17 15:27:21Z nickvergessen $
* @copyright (c) 2007 nickvergessen nickvergessen@gmx.de http://www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_install
*/
class acp_gallery_permissions_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_gallery_permissions',
			'title'		=> 'PHPBB_GALLERY',
			'version'	=> '1.0.0',
			'modes'		=> array(
				'manage'	=> array('title' => 'ACP_GALLERY_ALBUM_PERMISSIONS',	'auth' => 'acl_a_gallery_albums',	'cat' => array('PHPBB_GALLERY')),
				),
			);
	}
}
?>