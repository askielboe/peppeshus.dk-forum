#
# $Id: _sqlite_schema.sql 692 2008-08-26 19:49:31Z nickvergessen $
#

BEGIN TRANSACTION;

# Table: 'phpbb_gallery_reports'
CREATE TABLE phpbb_gallery_reports (
	report_id INTEGER PRIMARY KEY NOT NULL ,
	report_album_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	report_image_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	reporter_id INTEGER UNSIGNED NOT NULL DEFAULT '0',
	report_manager INTEGER UNSIGNED NOT NULL DEFAULT '0',
	report_note mediumtext(16777215) NOT NULL DEFAULT '',
	report_time INTEGER UNSIGNED NOT NULL DEFAULT '0',
	report_status INTEGER UNSIGNED NOT NULL DEFAULT '0'
);



COMMIT;