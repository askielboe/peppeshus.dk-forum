#
# $Id: _mysql_40_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $
#

# Table: 'phpbb_gallery_albums_track'
CREATE TABLE phpbb_gallery_albums_track (
	user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	album_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	mark_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (user_id, album_id)
);


