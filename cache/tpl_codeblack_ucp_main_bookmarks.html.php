<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<table class="tablebg" width="100%" cellspacing="1">
<tr>
	<th colspan="4"><?php echo ((isset($this->_rootref['L_UCP'])) ? $this->_rootref['L_UCP'] : ((isset($user->lang['UCP'])) ? $user->lang['UCP'] : '{ UCP }')); ?></th>
</tr>
<tr>
	<td class="row1" colspan="4" align="center"><span class="genmed"><?php echo ((isset($this->_rootref['L_BOOKMARKS_EXPLAIN'])) ? $this->_rootref['L_BOOKMARKS_EXPLAIN'] : ((isset($user->lang['BOOKMARKS_EXPLAIN'])) ? $user->lang['BOOKMARKS_EXPLAIN'] : '{ BOOKMARKS_EXPLAIN }')); ?></span></td>
</tr>
<?php if (sizeof($this->_tpldata['topicrow'])) {  ?>

<tr>
	<th colspan="4"><?php echo ((isset($this->_rootref['L_BOOKMARKS'])) ? $this->_rootref['L_BOOKMARKS'] : ((isset($user->lang['BOOKMARKS'])) ? $user->lang['BOOKMARKS'] : '{ BOOKMARKS }')); ?></th>
</tr>
<?php } if ($this->_rootref['S_NO_DISPLAY_BOOKMARKS']) {  ?>

	<tr class="row1">
		<td colspan="4" align="center"><b class="genmed"><?php echo ((isset($this->_rootref['L_BOOKMARKS_DISABLED'])) ? $this->_rootref['L_BOOKMARKS_DISABLED'] : ((isset($user->lang['BOOKMARKS_DISABLED'])) ? $user->lang['BOOKMARKS_DISABLED'] : '{ BOOKMARKS_DISABLED }')); ?></b></td>
	</tr>
<?php } else { if ($this->_rootref['TOTAL_TOPICS']) {  ?>

		<tr>
			<td class="row3" colspan="4">
				<table width="100%" cellspacing="1">
				<tr>
					<td class="nav" valign="middle" nowrap="nowrap">&nbsp;<?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?><br /></td>
					<td class="gensmall" nowrap="nowrap">&nbsp;[ <?php echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; ?> ]&nbsp;</td>
					<td class="gensmall" width="100%" align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>" nowrap="nowrap"><?php $this->_tpl_include('pagination.html'); ?></td>
				</tr>
				</table>
			</td>
		</tr>
	<?php } $_topicrow_count = (isset($this->_tpldata['topicrow'])) ? sizeof($this->_tpldata['topicrow']) : 0;if ($_topicrow_count) {for ($_topicrow_i = 0; $_topicrow_i < $_topicrow_count; ++$_topicrow_i){$_topicrow_val = &$this->_tpldata['topicrow'][$_topicrow_i]; if (!($_topicrow_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="row1"><?php } else { ?><tr class="row2"><?php } ?>

			<td style="padding: 4px;" width="20" align="center" valign="middle"><?php echo $_topicrow_val['TOPIC_FOLDER_IMG']; ?></td>
		<?php if ($_topicrow_val['S_DELETED_TOPIC']) {  ?>

			<td class="postdetails" style="padding: 4px" width="100%" colspan="2"><?php echo ((isset($this->_rootref['L_DELETED_TOPIC'])) ? $this->_rootref['L_DELETED_TOPIC'] : ((isset($user->lang['DELETED_TOPIC'])) ? $user->lang['DELETED_TOPIC'] : '{ DELETED_TOPIC }')); ?></td>
		<?php } else { ?>

			<td style="padding: 4px;" width="100%" valign="top">
				<p class="topictitle"><?php if ($_topicrow_val['S_UNREAD_TOPIC']) {  ?><a href="<?php echo $_topicrow_val['U_NEWEST_POST']; ?>"><?php echo (isset($this->_rootref['NEWEST_POST_IMG'])) ? $this->_rootref['NEWEST_POST_IMG'] : ''; ?></a> <?php } echo $_topicrow_val['ATTACH_ICON_IMG']; ?> <a href="<?php echo $_topicrow_val['U_VIEW_TOPIC']; ?>"><?php echo $_topicrow_val['TOPIC_TITLE']; ?></a></p>
				<?php if ($_topicrow_val['S_GLOBAL_TOPIC']) {  ?><span class="gensmall"><?php echo ((isset($this->_rootref['L_GLOBAL_ANNOUNCEMENT'])) ? $this->_rootref['L_GLOBAL_ANNOUNCEMENT'] : ((isset($user->lang['GLOBAL_ANNOUNCEMENT'])) ? $user->lang['GLOBAL_ANNOUNCEMENT'] : '{ GLOBAL_ANNOUNCEMENT }')); ?></span><?php } else { ?><span class="gensmall"><b><?php echo ((isset($this->_rootref['L_FORUM'])) ? $this->_rootref['L_FORUM'] : ((isset($user->lang['FORUM'])) ? $user->lang['FORUM'] : '{ FORUM }')); ?>: </b><a href="<?php echo $_topicrow_val['U_VIEW_FORUM']; ?>"><?php echo $_topicrow_val['FORUM_NAME']; ?></a></span><?php } if ($_topicrow_val['PAGINATION']) {  ?>

					<p class="gensmall"> [ <?php echo (isset($this->_rootref['GOTO_PAGE_IMG'])) ? $this->_rootref['GOTO_PAGE_IMG'] : ''; echo ((isset($this->_rootref['L_GOTO_PAGE'])) ? $this->_rootref['L_GOTO_PAGE'] : ((isset($user->lang['GOTO_PAGE'])) ? $user->lang['GOTO_PAGE'] : '{ GOTO_PAGE }')); ?>: <?php echo $_topicrow_val['PAGINATION']; ?> ] </p>
				<?php } ?>

			</td>
			<td style="padding: 4px;" align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_BEGIN'])) ? $this->_rootref['S_CONTENT_FLOW_BEGIN'] : ''; ?>" valign="top" nowrap="nowrap">
				<p class="topicdetails"><?php echo $_topicrow_val['LAST_POST_TIME']; ?></p>
				<p class="topicdetails"><?php echo $_topicrow_val['LAST_POST_AUTHOR_FULL']; ?>

					<a href="<?php echo $_topicrow_val['U_LAST_POST']; ?>"><?php echo (isset($this->_rootref['LAST_POST_IMG'])) ? $this->_rootref['LAST_POST_IMG'] : ''; ?></a>
				</p>
			</td>
		<?php } ?>

			<td style="padding: 4px;"> <input type="checkbox" class="radio" name="t[<?php echo $_topicrow_val['TOPIC_ID']; ?>]" /> </td>
		</tr>
	<?php }} else { ?>

		<tr class="row1">
			<td colspan="4" align="center"><b class="genmed"><?php echo ((isset($this->_rootref['L_NO_BOOKMARKS'])) ? $this->_rootref['L_NO_BOOKMARKS'] : ((isset($user->lang['NO_BOOKMARKS'])) ? $user->lang['NO_BOOKMARKS'] : '{ NO_BOOKMARKS }')); ?></b></td>
		</tr>
	<?php } if (sizeof($this->_tpldata['topicrow'])) {  ?>

			<tr>
				<td class="cat" colspan="5" align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><input class="btnlite" type="submit" name="unbookmark" value="<?php echo ((isset($this->_rootref['L_REMOVE_BOOKMARK_MARKED'])) ? $this->_rootref['L_REMOVE_BOOKMARK_MARKED'] : ((isset($user->lang['REMOVE_BOOKMARK_MARKED'])) ? $user->lang['REMOVE_BOOKMARK_MARKED'] : '{ REMOVE_BOOKMARK_MARKED }')); ?>" />&nbsp;</td>
			</tr>
		<?php } } ?>

</table>

<?php if (! $this->_rootref['S_NO_DISPLAY_BOOKMARKS'] && sizeof($this->_tpldata['topicrow'])) {  ?>

	<div class="gensmall" style="float: <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>; padding-top: 2px;"><b><a href="#" onclick="marklist('ucp', 't', true); return false;"><?php echo ((isset($this->_rootref['L_MARK_ALL'])) ? $this->_rootref['L_MARK_ALL'] : ((isset($user->lang['MARK_ALL'])) ? $user->lang['MARK_ALL'] : '{ MARK_ALL }')); ?></a> :: <a href="#" onclick="marklist('ucp', 't', false); return false;"><?php echo ((isset($this->_rootref['L_UNMARK_ALL'])) ? $this->_rootref['L_UNMARK_ALL'] : ((isset($user->lang['UNMARK_ALL'])) ? $user->lang['UNMARK_ALL'] : '{ UNMARK_ALL }')); ?></a></b></div>
<?php } $this->_tpl_include('ucp_footer.html'); ?>