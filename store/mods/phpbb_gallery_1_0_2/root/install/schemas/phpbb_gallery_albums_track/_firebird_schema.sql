#
# $Id: _firebird_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $
#


# Table: 'phpbb_gallery_albums_track'
CREATE TABLE phpbb_gallery_albums_track (
	user_id INTEGER DEFAULT 0 NOT NULL,
	album_id INTEGER DEFAULT 0 NOT NULL,
	mark_time INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_gallery_albums_track ADD PRIMARY KEY (user_id, album_id);;


