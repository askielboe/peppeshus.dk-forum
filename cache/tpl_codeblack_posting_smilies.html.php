<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('simple_header.html'); ?>


<script type="text/javascript">
// <![CDATA[
	var form_name = 'postform';
	var text_name = 'message';
// ]]>
</script>
<script type="text/javascript" src="<?php echo (isset($this->_rootref['T_TEMPLATE_PATH'])) ? $this->_rootref['T_TEMPLATE_PATH'] : ''; ?>/editor.js"></script>

<table width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
	<td>
		<table class="tablebg" width="95%" cellspacing="1" cellpadding="4" border="0">
		<tr>
			<th><?php echo ((isset($this->_rootref['L_SMILIES'])) ? $this->_rootref['L_SMILIES'] : ((isset($user->lang['SMILIES'])) ? $user->lang['SMILIES'] : '{ SMILIES }')); ?></th>
		</tr>
		<tr>
			<td class="row1" align="center" valign="middle"><?php $_smiley_count = (isset($this->_tpldata['smiley'])) ? sizeof($this->_tpldata['smiley']) : 0;if ($_smiley_count) {for ($_smiley_i = 0; $_smiley_i < $_smiley_count; ++$_smiley_i){$_smiley_val = &$this->_tpldata['smiley'][$_smiley_i]; ?> <a href="#" onclick="insert_text('<?php echo $_smiley_val['A_SMILEY_CODE']; ?>', true, true); return false;"><img src="<?php echo $_smiley_val['SMILEY_IMG']; ?>" width="<?php echo $_smiley_val['SMILEY_WIDTH']; ?>" height="<?php echo $_smiley_val['SMILEY_HEIGHT']; ?>" alt="<?php echo $_smiley_val['SMILEY_CODE']; ?>" title="<?php echo $_smiley_val['SMILEY_DESC']; ?>" hspace="2" vspace="2" /></a> <?php }} ?><br /><a class="nav" href="#" onclick="window.close(); return false;"><?php echo ((isset($this->_rootref['L_CLOSE_WINDOW'])) ? $this->_rootref['L_CLOSE_WINDOW'] : ((isset($user->lang['CLOSE_WINDOW'])) ? $user->lang['CLOSE_WINDOW'] : '{ CLOSE_WINDOW }')); ?></a></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<?php $this->_tpl_include('simple_footer.html'); ?>