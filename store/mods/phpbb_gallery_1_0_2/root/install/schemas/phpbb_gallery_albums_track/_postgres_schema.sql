/*

 $Id: _postgres_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $

*/

BEGIN;


/*
	Table: 'phpbb_gallery_albums_track'
*/
CREATE TABLE phpbb_gallery_albums_track (
	user_id INT4 DEFAULT '0' NOT NULL CHECK (user_id >= 0),
	album_id INT4 DEFAULT '0' NOT NULL CHECK (album_id >= 0),
	mark_time INT4 DEFAULT '0' NOT NULL CHECK (mark_time >= 0),
	PRIMARY KEY (user_id, album_id)
);



COMMIT;