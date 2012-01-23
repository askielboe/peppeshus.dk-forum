<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('mcp_header.html'); ?>


<form name="mcp" id="mcp" method="post" action="<?php echo (isset($this->_rootref['S_MCP_ACTION'])) ? $this->_rootref['S_MCP_ACTION'] : ''; ?>">

<table class="tablebg" width="100%" cellspacing="1">
<?php if ($this->_rootref['S_CAN_SPLIT']) {  ?>

	<tr>
		<th colspan="3" nowrap="nowrap"><?php echo ((isset($this->_rootref['L_SPLIT_TOPIC'])) ? $this->_rootref['L_SPLIT_TOPIC'] : ((isset($user->lang['SPLIT_TOPIC'])) ? $user->lang['SPLIT_TOPIC'] : '{ SPLIT_TOPIC }')); ?></th>
	</tr>
	<tr>
		<td class="row2" colspan="3" align="center"><span class="gensmall"><?php echo ((isset($this->_rootref['L_SPLIT_TOPIC_EXPLAIN'])) ? $this->_rootref['L_SPLIT_TOPIC_EXPLAIN'] : ((isset($user->lang['SPLIT_TOPIC_EXPLAIN'])) ? $user->lang['SPLIT_TOPIC_EXPLAIN'] : '{ SPLIT_TOPIC_EXPLAIN }')); ?></span></td>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="gen"><?php echo ((isset($this->_rootref['L_SPLIT_SUBJECT'])) ? $this->_rootref['L_SPLIT_SUBJECT'] : ((isset($user->lang['SPLIT_SUBJECT'])) ? $user->lang['SPLIT_SUBJECT'] : '{ SPLIT_SUBJECT }')); ?></span></td>
		<td class="row2" colspan="2"><input class="post" style="width: 350px" type="text" size="35" maxlength="64" name="subject" value="<?php echo (isset($this->_rootref['SPLIT_SUBJECT'])) ? $this->_rootref['SPLIT_SUBJECT'] : ''; ?>" /></td>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="gen"><?php echo ((isset($this->_rootref['L_SPLIT_FORUM'])) ? $this->_rootref['L_SPLIT_FORUM'] : ((isset($user->lang['SPLIT_FORUM'])) ? $user->lang['SPLIT_FORUM'] : '{ SPLIT_FORUM }')); ?></span></td>
		<td class="row2" colspan="2"><select name="to_forum_id"><?php echo (isset($this->_rootref['S_FORUM_SELECT'])) ? $this->_rootref['S_FORUM_SELECT'] : ''; ?></select></td>
	</tr>

	<?php if ($this->_rootref['S_SHOW_TOPIC_ICONS']) {  ?>

		<tr>
			<td class="row1"><span class="gen"><?php echo ((isset($this->_rootref['L_TOPIC_ICON'])) ? $this->_rootref['L_TOPIC_ICON'] : ((isset($user->lang['TOPIC_ICON'])) ? $user->lang['TOPIC_ICON'] : '{ TOPIC_ICON }')); ?></span></td>
			<td class="row2" colspan="2">
				<table width="100%" cellspacing="0" cellpadding="0" border="0">
				<tr>
					<td><span class="genmed nowrap"><input type="radio" class="radio" name="icon" value="0"<?php if (! $this->_rootref['S_TOPIC_ICON']) {  ?> checked="checked"<?php } ?> /><?php echo ((isset($this->_rootref['L_NO_TOPIC_ICON'])) ? $this->_rootref['L_NO_TOPIC_ICON'] : ((isset($user->lang['NO_TOPIC_ICON'])) ? $user->lang['NO_TOPIC_ICON'] : '{ NO_TOPIC_ICON }')); ?></span> <?php $_topic_icon_count = (isset($this->_tpldata['topic_icon'])) ? sizeof($this->_tpldata['topic_icon']) : 0;if ($_topic_icon_count) {for ($_topic_icon_i = 0; $_topic_icon_i < $_topic_icon_count; ++$_topic_icon_i){$_topic_icon_val = &$this->_tpldata['topic_icon'][$_topic_icon_i]; ?><span class="nowrap"><input type="radio" class="radio" name="icon" value="<?php echo $_topic_icon_val['ICON_ID']; ?>"<?php if ($_topic_icon_val['S_CHECKED']) {  ?> checked="checked"<?php } ?> /><img src="<?php echo $_topic_icon_val['ICON_IMG']; ?>" width="<?php echo $_topic_icon_val['ICON_WIDTH']; ?>" height="<?php echo $_topic_icon_val['ICON_HEIGHT']; ?>" alt="" title="" hspace="2" vspace="2" /></span> <?php }} ?></td>
				</tr>
				</table>
			</td>
		</tr>
	<?php } } if ($this->_rootref['S_CAN_MERGE']) {  ?>

	<tr>
		<th colspan="3" nowrap="nowrap"><?php echo ((isset($this->_rootref['L_MERGE_TOPIC'])) ? $this->_rootref['L_MERGE_TOPIC'] : ((isset($user->lang['MERGE_TOPIC'])) ? $user->lang['MERGE_TOPIC'] : '{ MERGE_TOPIC }')); ?></th>
	</tr>
	<tr>
		<td class="row2" colspan="3" align="center"><span class="gensmall"><?php echo ((isset($this->_rootref['L_MERGE_TOPIC_EXPLAIN'])) ? $this->_rootref['L_MERGE_TOPIC_EXPLAIN'] : ((isset($user->lang['MERGE_TOPIC_EXPLAIN'])) ? $user->lang['MERGE_TOPIC_EXPLAIN'] : '{ MERGE_TOPIC_EXPLAIN }')); ?></span></td>
	</tr>
	<tr>
		<td class="row1" nowrap="nowrap"><span class="gen"><?php echo ((isset($this->_rootref['L_MERGE_TOPIC_ID'])) ? $this->_rootref['L_MERGE_TOPIC_ID'] : ((isset($user->lang['MERGE_TOPIC_ID'])) ? $user->lang['MERGE_TOPIC_ID'] : '{ MERGE_TOPIC_ID }')); ?></span></td>
		<td class="row2" colspan="2"><input class="post" type="text" size="6" name="to_topic_id" value="<?php echo (isset($this->_rootref['TO_TOPIC_ID'])) ? $this->_rootref['TO_TOPIC_ID'] : ''; ?>" /> <a href="<?php echo (isset($this->_rootref['U_SELECT_TOPIC'])) ? $this->_rootref['U_SELECT_TOPIC'] : ''; ?>"><?php echo ((isset($this->_rootref['L_SELECT_TOPIC'])) ? $this->_rootref['L_SELECT_TOPIC'] : ((isset($user->lang['SELECT_TOPIC'])) ? $user->lang['SELECT_TOPIC'] : '{ SELECT_TOPIC }')); ?></a></td>
	</tr>
	<?php if ($this->_rootref['TO_TOPIC_INFO']) {  ?>

		<tr>
			<td class="row3" colspan="3" align="center"><b class="gen"><?php echo (isset($this->_rootref['TO_TOPIC_INFO'])) ? $this->_rootref['TO_TOPIC_INFO'] : ''; ?></b></td>
		</tr>
	<?php } } ?>

<tr>
	<th colspan="3" nowrap="nowrap"><?php echo ((isset($this->_rootref['L_DISPLAY_OPTIONS'])) ? $this->_rootref['L_DISPLAY_OPTIONS'] : ((isset($user->lang['DISPLAY_OPTIONS'])) ? $user->lang['DISPLAY_OPTIONS'] : '{ DISPLAY_OPTIONS }')); ?></th>
</tr>
<tr>
	<td class="row1" nowrap="nowrap"><span class="gen"><?php echo ((isset($this->_rootref['L_POSTS_PER_PAGE'])) ? $this->_rootref['L_POSTS_PER_PAGE'] : ((isset($user->lang['POSTS_PER_PAGE'])) ? $user->lang['POSTS_PER_PAGE'] : '{ POSTS_PER_PAGE }')); ?></span><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_POSTS_PER_PAGE_EXPLAIN'])) ? $this->_rootref['L_POSTS_PER_PAGE_EXPLAIN'] : ((isset($user->lang['POSTS_PER_PAGE_EXPLAIN'])) ? $user->lang['POSTS_PER_PAGE_EXPLAIN'] : '{ POSTS_PER_PAGE_EXPLAIN }')); ?></span></td>
	<td class="row2" colspan="2"><input class="post" type="text" name="posts_per_page" size="6" value="<?php echo (isset($this->_rootref['POSTS_PER_PAGE'])) ? $this->_rootref['POSTS_PER_PAGE'] : ''; ?>" /></td>
</tr>
<tr>
	<td class="cat" colspan="3" align="center"><span class="gensmall"><?php echo ((isset($this->_rootref['L_DISPLAY_POSTS'])) ? $this->_rootref['L_DISPLAY_POSTS'] : ((isset($user->lang['DISPLAY_POSTS'])) ? $user->lang['DISPLAY_POSTS'] : '{ DISPLAY_POSTS }')); ?>:</span> <?php echo (isset($this->_rootref['S_SELECT_SORT_DAYS'])) ? $this->_rootref['S_SELECT_SORT_DAYS'] : ''; ?>&nbsp;<span class="gensmall"><?php echo ((isset($this->_rootref['L_SORT_BY'])) ? $this->_rootref['L_SORT_BY'] : ((isset($user->lang['SORT_BY'])) ? $user->lang['SORT_BY'] : '{ SORT_BY }')); ?></span> <?php echo (isset($this->_rootref['S_SELECT_SORT_KEY'])) ? $this->_rootref['S_SELECT_SORT_KEY'] : ''; ?> <?php echo (isset($this->_rootref['S_SELECT_SORT_DIR'])) ? $this->_rootref['S_SELECT_SORT_DIR'] : ''; ?>&nbsp;<input class="btnlite" type="submit" name="sort" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" /></td>
</tr>
<tr>
	<th nowrap="nowrap"><?php echo ((isset($this->_rootref['L_AUTHOR'])) ? $this->_rootref['L_AUTHOR'] : ((isset($user->lang['AUTHOR'])) ? $user->lang['AUTHOR'] : '{ AUTHOR }')); ?></th>
	<th nowrap="nowrap"><?php echo ((isset($this->_rootref['L_MESSAGE'])) ? $this->_rootref['L_MESSAGE'] : ((isset($user->lang['MESSAGE'])) ? $user->lang['MESSAGE'] : '{ MESSAGE }')); ?></th>
	<th nowrap="nowrap"><?php echo ((isset($this->_rootref['L_SELECT'])) ? $this->_rootref['L_SELECT'] : ((isset($user->lang['SELECT'])) ? $user->lang['SELECT'] : '{ SELECT }')); ?></th>
</tr>
<tr>
	<td class="row3" colspan="3" align="center"><span class="gensmall"><?php echo (isset($this->_rootref['RETURN_TOPIC'])) ? $this->_rootref['RETURN_TOPIC'] : ''; ?></span></td>
</tr>
<?php $_postrow_count = (isset($this->_tpldata['postrow'])) ? sizeof($this->_tpldata['postrow']) : 0;if ($_postrow_count) {for ($_postrow_i = 0; $_postrow_i < $_postrow_count; ++$_postrow_i){$_postrow_val = &$this->_tpldata['postrow'][$_postrow_i]; if (!($_postrow_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="row1"><?php } else { ?><tr class="row2"><?php } ?>


		<td align="center"><b class="postauthor"><?php echo $_postrow_val['POST_AUTHOR_FULL']; ?></b></td>
		<td width="100%">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr valign="top">
				<td class="gensmall" nowrap="nowrap">&nbsp;<b><?php echo ((isset($this->_rootref['L_POST_SUBJECT'])) ? $this->_rootref['L_POST_SUBJECT'] : ((isset($user->lang['POST_SUBJECT'])) ? $user->lang['POST_SUBJECT'] : '{ POST_SUBJECT }')); ?>:</b>&nbsp;</td>
				<td class="gensmall" width="100%"><?php echo $_postrow_val['POST_SUBJECT']; ?></td>
			</tr>
			</table>
		</td>
		<td rowspan="2" width="5%" align="center"><input type="checkbox" class="radio" name="post_id_list[]" value="<?php echo $_postrow_val['POST_ID']; ?>"<?php if ($_postrow_val['S_CHECKED']) {  ?> checked="checked"<?php } ?> /></td>
	</tr>

	<?php if (!($_postrow_val['S_ROW_COUNT'] & 1)  ) {  ?><tr class="row1"><?php } else { ?><tr class="row2"><?php } ?>


		<td valign="bottom">
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tr valign="middle">
				<td align="center"><span class="gensmall">[ <a href="<?php echo $_postrow_val['U_POST_DETAILS']; ?>"><?php echo ((isset($this->_rootref['L_POST_DETAILS'])) ? $this->_rootref['L_POST_DETAILS'] : ((isset($user->lang['POST_DETAILS'])) ? $user->lang['POST_DETAILS'] : '{ POST_DETAILS }')); ?></a> ]</span></td>
			</tr>
			</table>
		</td>
		<td width="100%" valign="top">
			<table width="100%" cellspacing="0" cellpadding="2" border="0">
			<tr>
				<td valign="top">
					<div class="postbody"><?php echo $_postrow_val['MESSAGE']; ?></div>
					<?php if ($_postrow_val['S_HAS_ATTACHMENTS']) {  ?>

						<br clear="all" /><br />

						<table class="tablebg" width="100%" cellspacing="1">
						<tr>
							<td class="row3"><b class="genmed"><?php echo ((isset($this->_rootref['L_ATTACHMENTS'])) ? $this->_rootref['L_ATTACHMENTS'] : ((isset($user->lang['ATTACHMENTS'])) ? $user->lang['ATTACHMENTS'] : '{ ATTACHMENTS }')); ?>: </b></td>
						</tr>
						<?php $_attachment_count = (isset($_postrow_val['attachment'])) ? sizeof($_postrow_val['attachment']) : 0;if ($_attachment_count) {for ($_attachment_i = 0; $_attachment_i < $_attachment_count; ++$_attachment_i){$_attachment_val = &$_postrow_val['attachment'][$_attachment_i]; ?>

							<tr>
								<?php if (!($_attachment_val['S_ROW_COUNT'] & 1)  ) {  ?><td class="row2"><?php } else { ?><td class="row1"><?php } echo $_attachment_val['DISPLAY_ATTACHMENT']; ?></td>
							</tr>
						<?php }} ?>

						</table>
					<?php } ?>


				</td>
			</tr>
			<tr>
				<td valign="bottom">
					<table width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr valign="middle">
						<td width="100%">
							<?php if ($_postrow_val['S_POST_UNAPPROVED'] && $_postrow_val['U_MCP_APPROVE']) {  echo (isset($this->_rootref['UNAPPROVED_IMG'])) ? $this->_rootref['UNAPPROVED_IMG'] : ''; ?> <span class="postapprove"><a href="<?php echo $_postrow_val['U_MCP_APPROVE']; ?>"><?php echo ((isset($this->_rootref['L_POST_UNAPPROVED'])) ? $this->_rootref['L_POST_UNAPPROVED'] : ((isset($user->lang['POST_UNAPPROVED'])) ? $user->lang['POST_UNAPPROVED'] : '{ POST_UNAPPROVED }')); ?></a></span><?php } if ($_postrow_val['S_POST_REPORTED'] && $_postrow_val['U_MCP_REPORT']) {  echo (isset($this->_rootref['REPORTED_IMG'])) ? $this->_rootref['REPORTED_IMG'] : ''; ?><span class="postreported"><a href="<?php echo $_postrow_val['U_MCP_REPORT']; ?>"><?php echo ((isset($this->_rootref['L_POST_REPORTED'])) ? $this->_rootref['L_POST_REPORTED'] : ((isset($user->lang['POST_REPORTED'])) ? $user->lang['POST_REPORTED'] : '{ POST_REPORTED }')); ?></a></span><?php } ?>

						</td>
						<td width="10" nowrap="nowrap"><?php echo $_postrow_val['MINI_POST_IMG']; ?></td>
						<td class="gensmall" nowrap="nowrap"><b><?php echo ((isset($this->_rootref['L_POSTED'])) ? $this->_rootref['L_POSTED'] : ((isset($user->lang['POSTED'])) ? $user->lang['POSTED'] : '{ POSTED }')); ?>:</b> <?php echo $_postrow_val['POST_DATE']; ?></td>
					</tr>
					</table>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="row3" colspan="3" height="1"><img src="images/spacer.gif" width="1" height="1" alt="" /></td>
	</tr>
<?php }} ?>

<tr>
	<td class="cat" colspan="3" align="center"><select name="action"><option value="" selected="selected"><?php echo ((isset($this->_rootref['L_SELECT_ACTION'])) ? $this->_rootref['L_SELECT_ACTION'] : ((isset($user->lang['SELECT_ACTION'])) ? $user->lang['SELECT_ACTION'] : '{ SELECT_ACTION }')); ?></option>
		<?php if ($this->_rootref['S_CAN_APPROVE']) {  ?><option value="approve"><?php echo ((isset($this->_rootref['L_APPROVE_POSTS'])) ? $this->_rootref['L_APPROVE_POSTS'] : ((isset($user->lang['APPROVE_POSTS'])) ? $user->lang['APPROVE_POSTS'] : '{ APPROVE_POSTS }')); ?></option><?php } if ($this->_rootref['S_CAN_LOCK']) {  ?><option value="lock_post"><?php echo ((isset($this->_rootref['L_LOCK_POST_POSTS'])) ? $this->_rootref['L_LOCK_POST_POSTS'] : ((isset($user->lang['LOCK_POST_POSTS'])) ? $user->lang['LOCK_POST_POSTS'] : '{ LOCK_POST_POSTS }')); ?> [ <?php echo ((isset($this->_rootref['L_LOCK_POST_EXPLAIN'])) ? $this->_rootref['L_LOCK_POST_EXPLAIN'] : ((isset($user->lang['LOCK_POST_EXPLAIN'])) ? $user->lang['LOCK_POST_EXPLAIN'] : '{ LOCK_POST_EXPLAIN }')); ?> ]</option><option value="unlock_post"><?php echo ((isset($this->_rootref['L_UNLOCK_POST_POSTS'])) ? $this->_rootref['L_UNLOCK_POST_POSTS'] : ((isset($user->lang['UNLOCK_POST_POSTS'])) ? $user->lang['UNLOCK_POST_POSTS'] : '{ UNLOCK_POST_POSTS }')); ?></option><?php } if ($this->_rootref['S_CAN_DELETE']) {  ?><option value="delete_post"><?php echo ((isset($this->_rootref['L_DELETE_POSTS'])) ? $this->_rootref['L_DELETE_POSTS'] : ((isset($user->lang['DELETE_POSTS'])) ? $user->lang['DELETE_POSTS'] : '{ DELETE_POSTS }')); ?></option><?php } if ($this->_rootref['S_CAN_MERGE']) {  ?><option value="merge_posts"<?php if ($this->_rootref['ACTION'] == ('merge')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_MERGE_POSTS'])) ? $this->_rootref['L_MERGE_POSTS'] : ((isset($user->lang['MERGE_POSTS'])) ? $user->lang['MERGE_POSTS'] : '{ MERGE_POSTS }')); ?></option><?php } if ($this->_rootref['S_CAN_SPLIT']) {  ?><option value="split_all"<?php if ($this->_rootref['ACTION'] == ('split')) {  ?> selected="selected"<?php } ?>><?php echo ((isset($this->_rootref['L_SPLIT_POSTS'])) ? $this->_rootref['L_SPLIT_POSTS'] : ((isset($user->lang['SPLIT_POSTS'])) ? $user->lang['SPLIT_POSTS'] : '{ SPLIT_POSTS }')); ?></option><option value="split_beyond"><?php echo ((isset($this->_rootref['L_SPLIT_AFTER'])) ? $this->_rootref['L_SPLIT_AFTER'] : ((isset($user->lang['SPLIT_AFTER'])) ? $user->lang['SPLIT_AFTER'] : '{ SPLIT_AFTER }')); ?></option><?php } ?>

	</select>&nbsp;<input class="btnmain" type="submit" name="mcp_topic_submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" /></td>
</tr>
</table>
<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

</form>

<table width="100%" cellspacing="2" cellpadding="2" border="0" align="center">
<tr>
	<td align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>" valign="top" nowrap="nowrap"><b class="gensmall"><a href="#" onclick="marklist('mcp', '', true); return false;"><?php echo ((isset($this->_rootref['L_MARK_ALL'])) ? $this->_rootref['L_MARK_ALL'] : ((isset($user->lang['MARK_ALL'])) ? $user->lang['MARK_ALL'] : '{ MARK_ALL }')); ?></a> :: <a href="#" onclick="marklist('mcp', '', false); return false;"><?php echo ((isset($this->_rootref['L_UNMARK_ALL'])) ? $this->_rootref['L_UNMARK_ALL'] : ((isset($user->lang['UNMARK_ALL'])) ? $user->lang['UNMARK_ALL'] : '{ UNMARK_ALL }')); ?></a></b></td>
</tr>
</table>

<?php $this->_tpl_include('mcp_footer.html'); ?>