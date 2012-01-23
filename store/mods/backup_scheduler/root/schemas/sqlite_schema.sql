#
# $Id: $
#

BEGIN TRANSACTION;

# Table: 'phpbb_backup_scheduler'
CREATE TABLE phpbb_backup_scheduler (
	backup_id INTEGER PRIMARY KEY NOT NULL ,
	backup_active tinyint(1) NOT NULL DEFAULT '1',
	backup_name varchar(25) NOT NULL DEFAULT '',
	backup_key varchar(6) NOT NULL DEFAULT '',
	backup_type varchar(15) NOT NULL DEFAULT '',
	backup_file_type varchar(10) NOT NULL DEFAULT '',
	backup_tables text(65535) NOT NULL DEFAULT '',
	backup_frequency INTEGER UNSIGNED NOT NULL DEFAULT '0',
	backup_post_count INTEGER UNSIGNED NOT NULL DEFAULT '0',
	backup_ftp tinyint(1) NOT NULL DEFAULT '0',
	backup_last INTEGER UNSIGNED NOT NULL DEFAULT '0',
	backup_next INTEGER UNSIGNED NOT NULL DEFAULT '0',
	backup_post_next INTEGER UNSIGNED NOT NULL DEFAULT '0',
	backup_expire INTEGER UNSIGNED NOT NULL DEFAULT '0'
);



COMMIT;