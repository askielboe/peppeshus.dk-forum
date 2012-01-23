/*

 $Id: _mssql_schema.sql 719 2008-09-29 18:35:33Z nickvergessen $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_gallery_copyts_albums'
*/
CREATE TABLE [phpbb_gallery_copyts_albums] (
	[album_id] [int] IDENTITY (1, 1) NOT NULL ,
	[parent_id] [int] DEFAULT (0) NOT NULL ,
	[left_id] [int] DEFAULT (1) NOT NULL ,
	[right_id] [int] DEFAULT (2) NOT NULL ,
	[album_name] [varchar] (255) DEFAULT ('') NOT NULL ,
	[album_desc] [text] DEFAULT ('') NOT NULL ,
	[album_user_id] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [phpbb_gallery_copyts_albums] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_gallery_copyts_albums] PRIMARY KEY  CLUSTERED 
	(
		[album_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

