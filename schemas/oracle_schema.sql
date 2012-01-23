/*

 $Id: $

*/

/*
  This first section is optional, however its probably the best method
  of running phpBB on Oracle. If you already have a tablespace and user created
  for phpBB you can leave this section commented out!

  The first set of statements create a phpBB tablespace and a phpBB user,
  make sure you change the password of the phpBB user before you run this script!!
*/

/*
CREATE TABLESPACE "PHPBB"
	LOGGING
	DATAFILE 'E:\ORACLE\ORADATA\LOCAL\PHPBB.ora'
	SIZE 10M
	AUTOEXTEND ON NEXT 10M
	MAXSIZE 100M;

CREATE USER "PHPBB"
	PROFILE "DEFAULT"
	IDENTIFIED BY "phpbb_password"
	DEFAULT TABLESPACE "PHPBB"
	QUOTA UNLIMITED ON "PHPBB"
	ACCOUNT UNLOCK;

GRANT ANALYZE ANY TO "PHPBB";
GRANT CREATE SEQUENCE TO "PHPBB";
GRANT CREATE SESSION TO "PHPBB";
GRANT CREATE TABLE TO "PHPBB";
GRANT CREATE TRIGGER TO "PHPBB";
GRANT CREATE VIEW TO "PHPBB";
GRANT "CONNECT" TO "PHPBB";

COMMIT;
DISCONNECT;

CONNECT phpbb/phpbb_password;
*/
/*
	Table: 'phpbb_backup_scheduler'
*/
CREATE TABLE phpbb_backup_scheduler (
	backup_id number(8) NOT NULL,
	backup_active number(1) DEFAULT '1' NOT NULL,
	backup_name varchar2(25) DEFAULT '' ,
	backup_key varchar2(6) DEFAULT '' ,
	backup_type varchar2(15) DEFAULT '' ,
	backup_file_type varchar2(10) DEFAULT '' ,
	backup_tables clob DEFAULT '' ,
	backup_frequency number(8) DEFAULT '0' NOT NULL,
	backup_post_count number(4) DEFAULT '0' NOT NULL,
	backup_ftp number(1) DEFAULT '0' NOT NULL,
	backup_last number(11) DEFAULT '0' NOT NULL,
	backup_next number(11) DEFAULT '0' NOT NULL,
	backup_post_next number(11) DEFAULT '0' NOT NULL,
	backup_expire number(4) DEFAULT '0' NOT NULL,
	CONSTRAINT pk_phpbb_backup_scheduler PRIMARY KEY (backup_id)
)
/


CREATE SEQUENCE phpbb_backup_scheduler_seq
/

CREATE OR REPLACE TRIGGER t_phpbb_backup_scheduler
BEFORE INSERT ON phpbb_backup_scheduler
FOR EACH ROW WHEN (
	new.backup_id IS NULL OR new.backup_id = 0
)
BEGIN
	SELECT phpbb_backup_scheduler_seq.nextval
	INTO :new.backup_id
	FROM dual;
END;
/


