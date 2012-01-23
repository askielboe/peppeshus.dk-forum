#
# $Id: _sqlite_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $
#

BEGIN TRANSACTION;

# Table: 'phpbb_gallery_users'
CREATE TABLE phpbb_gallery_users (
	user_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	watch_own INTEGER UNSIGNED NOT NULL DEFAULT '0',
	watch_favo INTEGER UNSIGNED NOT NULL DEFAULT '0',
	watch_com INTEGER UNSIGNED NOT NULL DEFAULT '0',
	user_images INTEGER UNSIGNED NOT NULL DEFAULT '0',
	personal_album_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	user_lastmark INTEGER UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (user_id)
);



COMMIT;