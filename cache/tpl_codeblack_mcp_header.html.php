<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<div id="pageheader">
	<?php if ($this->_rootref['U_MCP']) {  ?>

		<p class="linkmcp">
			[ <a href="<?php echo (isset($this->_rootref['U_MCP'])) ? $this->_rootref['U_MCP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MCP'])) ? $this->_rootref['L_MCP'] : ((isset($user->lang['MCP'])) ? $user->lang['MCP'] : '{ MCP }')); ?></a><?php if ($this->_rootref['U_MCP_FORUM']) {  ?> | <a href="<?php echo (isset($this->_rootref['U_MCP_FORUM'])) ? $this->_rootref['U_MCP_FORUM'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MODERATE_FORUM'])) ? $this->_rootref['L_MODERATE_FORUM'] : ((isset($user->lang['MODERATE_FORUM'])) ? $user->lang['MODERATE_FORUM'] : '{ MODERATE_FORUM }')); ?></a><?php } if ($this->_rootref['U_MCP_TOPIC']) {  ?> | <a href="<?php echo (isset($this->_rootref['U_MCP_TOPIC'])) ? $this->_rootref['U_MCP_TOPIC'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MODERATE_TOPIC'])) ? $this->_rootref['L_MODERATE_TOPIC'] : ((isset($user->lang['MODERATE_TOPIC'])) ? $user->lang['MODERATE_TOPIC'] : '{ MODERATE_TOPIC }')); ?></a><?php } if ($this->_rootref['U_MCP_POST']) {  ?> | <a href="<?php echo (isset($this->_rootref['U_MCP_POST'])) ? $this->_rootref['U_MCP_POST'] : ''; ?>"><?php echo ((isset($this->_rootref['L_MODERATE_POST'])) ? $this->_rootref['L_MODERATE_POST'] : ((isset($user->lang['MODERATE_POST'])) ? $user->lang['MODERATE_POST'] : '{ MODERATE_POST }')); ?></a><?php } ?> ]
		</p>
	<?php } if ($this->_rootref['TOPIC_TITLE'] || $this->_rootref['FORUM_NAME']) {  ?>

	<h2><?php if ($this->_rootref['TOPIC_TITLE']) {  ?><a class="titles" href="<?php echo (isset($this->_rootref['U_VIEW_TOPIC'])) ? $this->_rootref['U_VIEW_TOPIC'] : ''; ?>"><?php echo (isset($this->_rootref['TOPIC_TITLE'])) ? $this->_rootref['TOPIC_TITLE'] : ''; ?></a><?php } else { ?><a class="titles" href="<?php echo (isset($this->_rootref['U_VIEW_FORUM'])) ? $this->_rootref['U_VIEW_FORUM'] : ''; ?>"><?php echo (isset($this->_rootref['FORUM_NAME'])) ? $this->_rootref['FORUM_NAME'] : ''; ?></a><?php } ?></h2>
	<?php } ?>

</div>

<br clear="all" />

<div id="pagecontent">

	<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<tr>
		<td width="20%" valign="top">

			<table class="tablebg" width="100%" cellspacing="1">
			<tr>
				<th><?php echo ((isset($this->_rootref['L_OPTIONS'])) ? $this->_rootref['L_OPTIONS'] : ((isset($user->lang['OPTIONS'])) ? $user->lang['OPTIONS'] : '{ OPTIONS }')); ?></th>
			</tr>
			<?php $_l_block1_count = (isset($this->_tpldata['l_block1'])) ? sizeof($this->_tpldata['l_block1']) : 0;if ($_l_block1_count) {for ($_l_block1_i = 0; $_l_block1_i < $_l_block1_count; ++$_l_block1_i){$_l_block1_val = &$this->_tpldata['l_block1'][$_l_block1_i]; ?>

				<tr>
				<?php if ($_l_block1_val['S_SELECTED']) {  ?>

					<td class="row1"><b class="nav"><?php echo $_l_block1_val['L_TITLE']; ?></b>

					<ul class="nav" style="margin: 0; padding: 0; list-style-type: none; line-height: 175%;">
					<?php $_l_block2_count = (isset($_l_block1_val['l_block2'])) ? sizeof($_l_block1_val['l_block2']) : 0;if ($_l_block2_count) {for ($_l_block2_i = 0; $_l_block2_i < $_l_block2_count; ++$_l_block2_i){$_l_block2_val = &$_l_block1_val['l_block2'][$_l_block2_i]; ?>

						<li>&#187; <?php if ($_l_block2_val['S_SELECTED']) {  ?><b><?php echo $_l_block2_val['L_TITLE']; ?></b><?php } else { ?><a href="<?php echo $_l_block2_val['U_TITLE']; ?>"><?php echo $_l_block2_val['L_TITLE']; ?></a><?php } ?></li>
					<?php }} ?>

					</ul>
				<?php } else { ?>

					<td class="row2" nowrap="nowrap" onmouseover="this.className='row1'" onmouseout="this.className='row2'" onclick="location.href=this.firstChild.href;"><a class="nav" href="<?php echo $_l_block1_val['U_TITLE']; ?>"><?php echo $_l_block1_val['L_TITLE']; ?></a>
				<?php } ?>

					</td>
				</tr>
			<?php }} ?>

			</table>

		</td>
		<td><img src="images/spacer.gif" width="4" alt="" /></td>
		<td width="80%" valign="top">

		<?php if ($this->_rootref['MESSAGE']) {  ?>

			<table class="tablebg" width="100%" cellspacing="1">
			<tr>
				<th><?php echo ((isset($this->_rootref['L_MESSAGE'])) ? $this->_rootref['L_MESSAGE'] : ((isset($user->lang['MESSAGE'])) ? $user->lang['MESSAGE'] : '{ MESSAGE }')); ?></th>
			</tr>
			<tr>
				<td class="row1" align="center"><br /><span class="gen"><?php echo (isset($this->_rootref['MESSAGE'])) ? $this->_rootref['MESSAGE'] : ''; ?><br /><br /><?php $_return_links_count = (isset($this->_tpldata['return_links'])) ? sizeof($this->_tpldata['return_links']) : 0;if ($_return_links_count) {for ($_return_links_i = 0; $_return_links_i < $_return_links_count; ++$_return_links_i){$_return_links_val = &$this->_tpldata['return_links'][$_return_links_i]; echo $_return_links_val['MESSAGE_LINK']; ?><br /><br /><?php }} ?></span></td>
			</tr>
			</table>

			<br />
		<?php } if ($this->_rootref['CONFIRM_MESSAGE']) {  ?>

			<form name="confirm" method="post" action="<?php echo (isset($this->_rootref['S_CONFIRM_ACTION'])) ? $this->_rootref['S_CONFIRM_ACTION'] : ''; ?>">

			<table class="tablebg" width="100%" cellspacing="1">
			<tr>
				<th><?php echo ((isset($this->_rootref['L_PLEASE_CONFIRM'])) ? $this->_rootref['L_PLEASE_CONFIRM'] : ((isset($user->lang['PLEASE_CONFIRM'])) ? $user->lang['PLEASE_CONFIRM'] : '{ PLEASE_CONFIRM }')); ?></th>
			</tr>
			<tr>
				<td class="row1" align="center"><span class="gen"><br /><?php echo (isset($this->_rootref['CONFIRM_MESSAGE'])) ? $this->_rootref['CONFIRM_MESSAGE'] : ''; ?><br /><br /><?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?><input class="btnmain" type="submit" name="confirm" value="<?php echo ((isset($this->_rootref['L_YES'])) ? $this->_rootref['L_YES'] : ((isset($user->lang['YES'])) ? $user->lang['YES'] : '{ YES }')); ?>" />&nbsp;&nbsp;<input class="btnlite" type="submit" name="cancel" value="<?php echo ((isset($this->_rootref['L_NO'])) ? $this->_rootref['L_NO'] : ((isset($user->lang['NO'])) ? $user->lang['NO'] : '{ NO }')); ?>" /><br /><br /></span></td>
			</tr>
			</table>

			</form>

			<br />
		<?php } ?>