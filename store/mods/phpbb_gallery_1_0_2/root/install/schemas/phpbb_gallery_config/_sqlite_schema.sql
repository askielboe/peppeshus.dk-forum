#
# $Id: _sqlite_schema.sql 692 2008-08-26 19:49:31Z nickvergessen $
#

BEGIN TRANSACTION;

# Table: 'phpbb_gallery_config'
CREATE TABLE phpbb_gallery_config (
	config_name varchar(255) NOT NULL DEFAULT '',
	config_value varchar(255) NOT NULL DEFAULT '',
	PRIMARY KEY (config_name)
);



COMMIT;