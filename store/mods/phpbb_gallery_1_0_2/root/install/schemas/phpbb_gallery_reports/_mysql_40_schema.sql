#
# $Id: _mysql_40_schema.sql 692 2008-08-26 19:49:31Z nickvergessen $
#

# Table: 'phpbb_gallery_reports'
CREATE TABLE phpbb_gallery_reports (
	report_id mediumint(8) UNSIGNED NOT NULL auto_increment,
	report_album_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	report_image_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	reporter_id mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	report_manager mediumint(8) UNSIGNED DEFAULT '0' NOT NULL,
	report_note mediumblob NOT NULL,
	report_time int(11) UNSIGNED DEFAULT '0' NOT NULL,
	report_status int(3) UNSIGNED DEFAULT '0' NOT NULL,
	PRIMARY KEY (report_id)
);


