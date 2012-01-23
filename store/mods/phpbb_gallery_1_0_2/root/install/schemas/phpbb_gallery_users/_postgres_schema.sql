/*

 $Id: _postgres_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $

*/

BEGIN;


/*
	Table: 'phpbb_gallery_users'
*/
CREATE TABLE phpbb_gallery_users (
	user_id INT4 DEFAULT '0' NOT NULL CHECK (user_id >= 0),
	watch_own INT4 DEFAULT '0' NOT NULL CHECK (watch_own >= 0),
	watch_favo INT4 DEFAULT '0' NOT NULL CHECK (watch_favo >= 0),
	watch_com INT4 DEFAULT '0' NOT NULL CHECK (watch_com >= 0),
	user_images INT4 DEFAULT '0' NOT NULL CHECK (user_images >= 0),
	personal_album_id INT4 DEFAULT '0' NOT NULL CHECK (personal_album_id >= 0),
	user_lastmark INT4 DEFAULT '0' NOT NULL CHECK (user_lastmark >= 0),
	PRIMARY KEY (user_id)
);



COMMIT;