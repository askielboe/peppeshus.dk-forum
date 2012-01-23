/*

 $Id: $

*/

BEGIN TRANSACTION
GO

/*
	Table: 'phpbb_backup_scheduler'
*/
CREATE TABLE [phpbb_backup_scheduler] (
	[backup_id] [int] IDENTITY (1, 1) NOT NULL ,
	[backup_active] [int] DEFAULT (1) NOT NULL ,
	[backup_name] [varchar] (25) DEFAULT ('') NOT NULL ,
	[backup_key] [varchar] (6) DEFAULT ('') NOT NULL ,
	[backup_type] [varchar] (15) DEFAULT ('') NOT NULL ,
	[backup_file_type] [varchar] (10) DEFAULT ('') NOT NULL ,
	[backup_tables] [varchar] (4000) DEFAULT ('') NOT NULL ,
	[backup_frequency] [int] DEFAULT (0) NOT NULL ,
	[backup_post_count] [int] DEFAULT (0) NOT NULL ,
	[backup_ftp] [int] DEFAULT (0) NOT NULL ,
	[backup_last] [int] DEFAULT (0) NOT NULL ,
	[backup_next] [int] DEFAULT (0) NOT NULL ,
	[backup_post_next] [int] DEFAULT (0) NOT NULL ,
	[backup_expire] [int] DEFAULT (0) NOT NULL 
) ON [PRIMARY]
GO

ALTER TABLE [phpbb_backup_scheduler] WITH NOCHECK ADD 
	CONSTRAINT [PK_phpbb_backup_scheduler] PRIMARY KEY  CLUSTERED 
	(
		[backup_id]
	)  ON [PRIMARY] 
GO



COMMIT
GO

