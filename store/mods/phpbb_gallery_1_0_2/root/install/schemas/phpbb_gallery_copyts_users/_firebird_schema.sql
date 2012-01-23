#
# $Id: _firebird_schema.sql 719 2008-09-29 18:35:33Z nickvergessen $
#


# Table: 'phpbb_gallery_copyts_users'
CREATE TABLE phpbb_gallery_copyts_users (
	user_id INTEGER DEFAULT 0 NOT NULL,
	personal_album_id INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_gallery_copyts_users ADD PRIMARY KEY (user_id);;


