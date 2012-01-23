#
# $Id: _sqlite_schema.sql 719 2008-09-29 18:35:33Z nickvergessen $
#

BEGIN TRANSACTION;

# Table: 'phpbb_gallery_copyts_users'
CREATE TABLE phpbb_gallery_copyts_users (
	user_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	personal_album_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	PRIMARY KEY (user_id)
);



COMMIT;