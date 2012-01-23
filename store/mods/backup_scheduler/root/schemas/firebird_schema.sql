#
# $Id: $
#


# Table: 'phpbb_backup_scheduler'
CREATE TABLE phpbb_backup_scheduler (
	backup_id INTEGER NOT NULL,
	backup_active INTEGER DEFAULT 1 NOT NULL,
	backup_name VARCHAR(25) CHARACTER SET NONE DEFAULT '' NOT NULL,
	backup_key VARCHAR(6) CHARACTER SET NONE DEFAULT '' NOT NULL,
	backup_type VARCHAR(15) CHARACTER SET NONE DEFAULT '' NOT NULL,
	backup_file_type VARCHAR(10) CHARACTER SET NONE DEFAULT '' NOT NULL,
	backup_tables BLOB SUB_TYPE TEXT CHARACTER SET UTF8 DEFAULT '' NOT NULL,
	backup_frequency INTEGER DEFAULT 0 NOT NULL,
	backup_post_count INTEGER DEFAULT 0 NOT NULL,
	backup_ftp INTEGER DEFAULT 0 NOT NULL,
	backup_last INTEGER DEFAULT 0 NOT NULL,
	backup_next INTEGER DEFAULT 0 NOT NULL,
	backup_post_next INTEGER DEFAULT 0 NOT NULL,
	backup_expire INTEGER DEFAULT 0 NOT NULL
);;

ALTER TABLE phpbb_backup_scheduler ADD PRIMARY KEY (backup_id);;


CREATE GENERATOR phpbb_backup_scheduler_gen;;
SET GENERATOR phpbb_backup_scheduler_gen TO 0;;

CREATE TRIGGER t_phpbb_backup_scheduler FOR phpbb_backup_scheduler
BEFORE INSERT
AS
BEGIN
	NEW.backup_id = GEN_ID(phpbb_backup_scheduler_gen, 1);
END;;


