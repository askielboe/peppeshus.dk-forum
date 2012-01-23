#
# $Id: _mysql_41_schema.sql 692 2008-08-26 19:49:31Z nickvergessen $
#

# Table: 'phpbb_gallery_config'
CREATE TABLE phpbb_gallery_config (
	config_name varchar(255) DEFAULT '' NOT NULL,
	config_value varchar(255) DEFAULT '' NOT NULL,
	PRIMARY KEY (config_name)
) CHARACTER SET `utf8` COLLATE `utf8_bin`;


