<?php
/**
*
* info_acp_gallery [Deutsch]
*
* @package phpBB Gallery
* @version $Id: info_acp_gallery.php 1108 2009-04-15 14:24:03Z nickvergessen $
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

$lang = array_merge($lang, array(
	'ACP_GALLERY_ALBUM_MANAGEMENT'		=> 'Album-Verwaltung',
	'ACP_GALLERY_ALBUM_PERMISSIONS'		=> 'Berechtigungen',
	'ACP_GALLERY_CLEANUP'				=> 'Galerie reinigen',
	'ACP_GALLERY_CONFIGURE_GALLERY'		=> 'Galerie konfigurieren',
	'ACP_GALLERY_LOGS'					=> 'Gallery-Protokoll',
	'ACP_GALLERY_LOGS_EXPLAIN'			=> 'Diese Liste zeigt alle Vorgänge, die von Moderatoren an Bildern und Kommentaren durchgeführt wurden.',
	'ACP_GALLERY_MANAGE_ALBUMS'			=> 'Alben verwalten',
	'ACP_GALLERY_OVERVIEW'				=> 'Übersicht',
	'ACP_IMPORT_ALBUMS'					=> 'Bilder importieren',

	'GALLERY'							=> 'Galerie',
	'GALLERY_EXPLAIN'					=> 'Bilder Galerie',
	'GALLERY_HELPLINE_ALBUM'			=> 'Galerie-Bild: [album]image_id[/album], mit diesem BBCode kannst du Bilder aus der Galerie in deinen Beitrag einfügen.',

	'IMAGES'							=> 'Bilder',
	'IMG_BUTTON_UPLOAD_IMAGE'			=> 'Bild hochladen',

	'PERSONAL_ALBUM'					=> 'Persönliches Album',
	'PHPBB_GALLERY'						=> 'phpBB Galerie',

	'TOTAL_IMAGES_OTHER'				=> 'Bilder insgesamt: <strong>%d</strong>',
	'TOTAL_IMAGES_ZERO'					=> 'Bilder insgesamt: <strong>0</strong>',
));

?>