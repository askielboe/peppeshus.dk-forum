<?php
/**
*
* permissions_gallery [English]
*
* @package phpBB Gallery
* @version $Id: permissions_gallery.php 847 2008-12-30 00:57:23Z nickvergessen $
* @copyright (c) 2007 nickvergessen nickvergessen@gmx.de http://www.flying-bits.org
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
**/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

$lang['permission_cat']['gallery'] = 'phpBB Gallery';

// Adding the permissions
$lang = array_merge($lang, array(
	'acl_a_gallery_manage'		=> array('lang' => 'Can manage the phpBB Gallery adjustments',	'cat' => 'gallery'),
	'acl_a_gallery_albums'		=> array('lang' => 'Can add/edit albums and permissions',		'cat' => 'gallery'),
	'acl_a_gallery_import'		=> array('lang' => 'Can use the import-funtion',				'cat' => 'gallery'),
	'acl_a_gallery_cleanup'		=> array('lang' => 'Can clean up the phpBB Gallery',			'cat' => 'gallery'),
));
?>