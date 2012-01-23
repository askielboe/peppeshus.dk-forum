/*

 $Id: _mssql_schema.sql 1004 2009-03-03 23:04:13Z nickvergessen $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_gallery_users'
*/
CREATE TABLE [phpbb_gallery_users] (
	[user_id] [int] DEFAULT (0) NOT NULL ,
	[watch_own] [int] DEFAULT (0) NOT NULL ,
	[watch_favo] [int] DEFAULT (0) NOT NULL ,
	[watch_com] [int] DEFAULT (0) NOT NULL ,
	[user_images] [int] DEFAULT (0) NOT NULL ,
	[personal_album_id] [int] DEFAULT (0) NOT NULL ,
	[user_lastmark] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_gallery_users] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_gallery_users] PRIMARY KEY  CLUSTERED 
	(
		[user_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

