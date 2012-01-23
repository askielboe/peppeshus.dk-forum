#
# $Id: _mysql_40_schema.sql 692 2008-08-26 19:49:31Z nickvergessen $
#

# Table: 'phpbb_gallery_favorites'
CREATE TABLE phpbb_gallery_favorites (
	favorite_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	image_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (favorite_id),
	KEY user_id (user_id),
	KEY image_id (image_id)
);


