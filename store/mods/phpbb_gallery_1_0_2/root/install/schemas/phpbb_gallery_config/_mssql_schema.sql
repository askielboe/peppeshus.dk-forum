/*

 $Id: _mssql_schema.sql 692 2008-08-26 19:49:31Z nickvergessen $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_gallery_config'
*/
CREATE TABLE [phpbb_gallery_config] (
	[config_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[config_value] [varchar] (255) DEFAULT ('') NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_gallery_config] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_gallery_config] PRIMARY KEY  CLUSTERED 
	(
		[config_name]
	)  ON [PRIMARY] 
GO



COMMIT
GO

