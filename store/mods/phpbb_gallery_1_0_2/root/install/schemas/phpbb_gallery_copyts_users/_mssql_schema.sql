/*

 $Id: _mssql_schema.sql 719 2008-09-29 18:35:33Z nickvergessen $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_gallery_copyts_users'
*/
CREATE TABLE [phpbb_gallery_copyts_users] (
	[user_id] [int] DEFAULT (0) NOT NULL ,
	[personal_album_id] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_gallery_copyts_users] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_gallery_copyts_users] PRIMARY KEY  CLUSTERED 
	(
		[user_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

