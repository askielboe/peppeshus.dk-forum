#
# $Id: _sqlite_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $
#

BEGIN TRANSACTION;

# Table: 'phpbb_gallery_albums_track'
CREATE TABLE phpbb_gallery_albums_track (
	user_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	album_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	mark_time INTEGER UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (user_id, album_id)
);



COMMIT;