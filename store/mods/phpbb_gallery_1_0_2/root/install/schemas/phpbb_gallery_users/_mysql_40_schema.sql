#
# $Id: _mysql_40_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $
#

# Table: 'phpbb_gallery_users'
CREATE TABLE phpbb_gallery_users (
	user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	watch_own int(3) UNSIGNED DEFAULT '0' NOT NULL,
	watch_favo int(3) UNSIGNED DEFAULT '0' NOT NULL,
	watch_com int(3) UNSIGNED DEFAULT '0' NOT NULL,
	user_images mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	personal_album_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	user_lastmark int(11) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (user_id)
);


