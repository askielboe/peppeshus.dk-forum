/*

 $Id: _oracle_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $

*/


/*
	Table: 'phpbb_gallery_users'
*/
CREATE TABLE phpbb_gallery_users (
	user_id number(8) DEFAULT '0' NOT NULL,
	watch_own number(3) DEFAULT '0' NOT NULL,
	watch_favo number(3) DEFAULT '0' NOT NULL,
	watch_com number(3) DEFAULT '0' NOT NULL,
	user_images number(8) DEFAULT '0' NOT NULL,
	personal_album_id number(8) DEFAULT '0' NOT NULL,
	user_lastmark number(11) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_gallery_users PRIMARY KEY (user_id)
)
/


