#
# $Id: $
#

# Table: 'phpbb_backup_scheduler'
CREATE TABLE phpbb_backup_scheduler (
	backup_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	backup_active tinyint(1) DEFAULT '1' NOT NULL,
	backup_name varbinary(25) DEFAULT '' NOT NULL,
	backup_key varbinary(6) DEFAULT '' NOT NULL,
	backup_type varbinary(15) DEFAULT '' NOT NULL,
	backup_file_type varbinary(10) DEFAULT '' NOT NULL,
	backup_tables blob NOT NULL,
	backup_frequency mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	backup_post_count int(4) UNSIGNED DEFAULT '0' NOT NULL,
	backup_ftp tinyint(1) DEFAULT '0' NOT NULL,
	backup_last int(11) UNSIGNED DEFAULT '0' NOT NULL,
	backup_next int(11) UNSIGNED DEFAULT '0' NOT NULL,
	backup_post_next int(11) UNSIGNED DEFAULT '0' NOT NULL,
	backup_expire smallint(4) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (backup_id)
);


