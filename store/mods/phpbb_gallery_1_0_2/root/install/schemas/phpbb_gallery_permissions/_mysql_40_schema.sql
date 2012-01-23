#
# $Id: _mysql_40_schema.sql 933 2009-01-28 21:51:34Z nickvergessen $
#

# Table: 'phpbb_gallery_permissions'
CREATE TABLE phpbb_gallery_permissions (
	perm_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	perm_role_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	perm_album_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	perm_user_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	perm_group_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	perm_system int(3) DEFAULT '0' NOT NULL,
	PRIMARY KEY (perm_id)
);


