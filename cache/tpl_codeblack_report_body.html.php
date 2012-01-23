<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<form method="post" id="report" action="<?php echo (isset($this->_rootref['S_REPORT_ACTION'])) ? $this->_rootref['S_REPORT_ACTION'] : ''; ?>">

<table class="tablebg" width="100%" cellspacing="1">
<tr>
	<th colspan="2"><?php echo ((isset($this->_rootref['L_REPORT_POST'])) ? $this->_rootref['L_REPORT_POST'] : ((isset($user->lang['REPORT_POST'])) ? $user->lang['REPORT_POST'] : '{ REPORT_POST }')); ?></th>
</tr>
<tr>
	<td class="row3" colspan="2"><span class="gensmall"><?php echo ((isset($this->_rootref['L_REPORT_POST_EXPLAIN'])) ? $this->_rootref['L_REPORT_POST_EXPLAIN'] : ((isset($user->lang['REPORT_POST_EXPLAIN'])) ? $user->lang['REPORT_POST_EXPLAIN'] : '{ REPORT_POST_EXPLAIN }')); ?></span></td>
</tr>
<tr>
	<td class="row1" width="22%"><b class="gen"><?php echo ((isset($this->_rootref['L_REASON'])) ? $this->_rootref['L_REASON'] : ((isset($user->lang['REASON'])) ? $user->lang['REASON'] : '{ REASON }')); ?>:</b></td>
	<td class="row2" width="78%"><select name="reason_id">
		<?php $_reason_count = (isset($this->_tpldata['reason'])) ? sizeof($this->_tpldata['reason']) : 0;if ($_reason_count) {for ($_reason_i = 0; $_reason_i < $_reason_count; ++$_reason_i){$_reason_val = &$this->_tpldata['reason'][$_reason_i]; ?><option value="<?php echo $_reason_val['ID']; ?>"<?php if ($_reason_val['S_SELECTED']) {  ?> selected="selected"<?php } ?>><?php echo $_reason_val['TITLE']; ?> &raquo; <?php echo $_reason_val['DESCRIPTION']; ?></option><?php }} ?>

	</select></td>
</tr>
<?php if ($this->_rootref['S_CAN_NOTIFY']) {  ?>

	<tr>
		<td class="row1"><span class="gen"><b><?php echo ((isset($this->_rootref['L_REPORT_NOTIFY'])) ? $this->_rootref['L_REPORT_NOTIFY'] : ((isset($user->lang['REPORT_NOTIFY'])) ? $user->lang['REPORT_NOTIFY'] : '{ REPORT_NOTIFY }')); ?>:</b></span><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_REPORT_NOTIFY_EXPLAIN'])) ? $this->_rootref['L_REPORT_NOTIFY_EXPLAIN'] : ((isset($user->lang['REPORT_NOTIFY_EXPLAIN'])) ? $user->lang['REPORT_NOTIFY_EXPLAIN'] : '{ REPORT_NOTIFY_EXPLAIN }')); ?></span></td>
		<td class="row2"><span class="gen"><input type="radio" class="radio" name="notify" value="1"<?php if ($this->_rootref['S_NOTIFY']) {  ?> checked="checked"<?php } ?> />&nbsp; <?php echo ((isset($this->_rootref['L_YES'])) ? $this->_rootref['L_YES'] : ((isset($user->lang['YES'])) ? $user->lang['YES'] : '{ YES }')); ?> &nbsp;<input type="radio" class="radio" name="notify" value="0"<?php if (! $this->_rootref['S_NOTIFY']) {  ?> checked="checked"<?php } ?> />&nbsp; <?php echo ((isset($this->_rootref['L_NO'])) ? $this->_rootref['L_NO'] : ((isset($user->lang['NO'])) ? $user->lang['NO'] : '{ NO }')); ?></span></td>
	</tr>
<?php } ?>

<tr>
	<td class="row1" valign="top"><span class="gen"><b><?php echo ((isset($this->_rootref['L_MORE_INFO'])) ? $this->_rootref['L_MORE_INFO'] : ((isset($user->lang['MORE_INFO'])) ? $user->lang['MORE_INFO'] : '{ MORE_INFO }')); ?>:</b></span><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_CAN_LEAVE_BLANK'])) ? $this->_rootref['L_CAN_LEAVE_BLANK'] : ((isset($user->lang['CAN_LEAVE_BLANK'])) ? $user->lang['CAN_LEAVE_BLANK'] : '{ CAN_LEAVE_BLANK }')); ?></span></td>
	<td class="row2"><textarea class="post" name="report_text" rows="10" cols="50"><?php echo (isset($this->_rootref['REPORT_TEXT'])) ? $this->_rootref['REPORT_TEXT'] : ''; ?></textarea></td>
</tr>
<tr>
	<td class="cat" colspan="2" align="center"><input type="submit" name="submit" class="btnmain" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;<input type="submit" name="cancel" class="btnlite" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" /></td>
</tr>
</table>
<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

</form>

<br clear="all" />

<?php $this->_tpl_include('breadcrumbs.html'); ?>


<div style="float: <?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>;"><?php $this->_tpl_include('jumpbox.html'); ?></div>

<?php $this->_tpl_include('overall_footer.html'); ?>