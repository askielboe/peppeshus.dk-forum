<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('overall_header.html'); ?>


<script type="text/javascript" defer="defer" >
// <![CDATA[

	var old_func = window.onload;

	function disable(disabl)
	{
		document.getElementById("agreed").disabled = disabl;
	}

	function disable_and_handle()
	{
		if (old_func)
		{
			old_func();
		}
		disable(true);
	}

	<?php if ($this->_rootref['S_TIME']) {  ?>

		window.onload = disable_and_handle;
		setInterval("disable(false)", <?php echo (isset($this->_rootref['S_TIME'])) ? $this->_rootref['S_TIME'] : ''; ?>);
	<?php } ?>

// ]]>
</script>

<?php if ($this->_rootref['S_SHOW_COPPA'] || $this->_rootref['S_REGISTRATION']) {  ?>


	<form method="post" action="<?php echo (isset($this->_rootref['S_UCP_ACTION'])) ? $this->_rootref['S_UCP_ACTION'] : ''; ?>">

	<table class="tablebg" width="100%" cellspacing="1">
	<tr>
		<th height="25"><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?> - <?php echo ((isset($this->_rootref['L_REGISTRATION'])) ? $this->_rootref['L_REGISTRATION'] : ((isset($user->lang['REGISTRATION'])) ? $user->lang['REGISTRATION'] : '{ REGISTRATION }')); ?></th>
	</tr>
	<tr>
		<td class="row1" align="center">
			<table width="90%" cellspacing="2" cellpadding="2" border="0" align="center">
			<tr>
				<?php if ($this->_rootref['S_SHOW_COPPA']) {  ?>

					<td class="gen" align="center"><br /><?php echo ((isset($this->_rootref['L_COPPA_BIRTHDAY'])) ? $this->_rootref['L_COPPA_BIRTHDAY'] : ((isset($user->lang['COPPA_BIRTHDAY'])) ? $user->lang['COPPA_BIRTHDAY'] : '{ COPPA_BIRTHDAY }')); ?><br /><br /><a href="<?php echo (isset($this->_rootref['U_COPPA_NO'])) ? $this->_rootref['U_COPPA_NO'] : ''; ?>"><?php echo ((isset($this->_rootref['L_COPPA_NO'])) ? $this->_rootref['L_COPPA_NO'] : ((isset($user->lang['COPPA_NO'])) ? $user->lang['COPPA_NO'] : '{ COPPA_NO }')); ?></a> :: <a href="<?php echo (isset($this->_rootref['U_COPPA_YES'])) ? $this->_rootref['U_COPPA_YES'] : ''; ?>"><?php echo ((isset($this->_rootref['L_COPPA_YES'])) ? $this->_rootref['L_COPPA_YES'] : ((isset($user->lang['COPPA_YES'])) ? $user->lang['COPPA_YES'] : '{ COPPA_YES }')); ?></a><br /><br /></td>
				<?php } else { ?>

					<td>
						<span class="genmed"><br /><?php echo ((isset($this->_rootref['L_TERMS_OF_USE'])) ? $this->_rootref['L_TERMS_OF_USE'] : ((isset($user->lang['TERMS_OF_USE'])) ? $user->lang['TERMS_OF_USE'] : '{ TERMS_OF_USE }')); ?><br /><br /></span>
						<div align="center">
							<input class="btnlite" type="submit" id="agreed" name="agreed" value="<?php echo ((isset($this->_rootref['L_AGREE'])) ? $this->_rootref['L_AGREE'] : ((isset($user->lang['AGREE'])) ? $user->lang['AGREE'] : '{ AGREE }')); ?>" /><br /><br />
							<input class="btnlite" type="submit" name="not_agreed" value="<?php echo ((isset($this->_rootref['L_NOT_AGREE'])) ? $this->_rootref['L_NOT_AGREE'] : ((isset($user->lang['NOT_AGREE'])) ? $user->lang['NOT_AGREE'] : '{ NOT_AGREE }')); ?>" />
						</div>
					</td>
				<?php } ?>

			</tr>
			</table>
		</td>
	</tr>
	</table>
	<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

	<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

	</form>

<?php } else if ($this->_rootref['S_AGREEMENT']) {  ?>


	<table class="tablebg" width="100%" cellspacing="1">
	<tr>
		<th height="25"><?php echo (isset($this->_rootref['SITENAME'])) ? $this->_rootref['SITENAME'] : ''; ?> - <?php echo (isset($this->_rootref['AGREEMENT_TITLE'])) ? $this->_rootref['AGREEMENT_TITLE'] : ''; ?></th>
	</tr>
	<tr>
		<td class="row1" align="center">
			<table width="90%" cellspacing="2" cellpadding="2" border="0" align="center">
			<tr>
				<td>
					<span class="genmed"><br /><?php echo (isset($this->_rootref['AGREEMENT_TEXT'])) ? $this->_rootref['AGREEMENT_TEXT'] : ''; ?><br /><br /></span>
					<div align="center">
						<a href="<?php echo (isset($this->_rootref['U_BACK'])) ? $this->_rootref['U_BACK'] : ''; ?>"><?php echo ((isset($this->_rootref['L_BACK'])) ? $this->_rootref['L_BACK'] : ((isset($user->lang['BACK'])) ? $user->lang['BACK'] : '{ BACK }')); ?></a>
					</div>
				</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>

<?php } $this->_tpl_include('overall_footer.html'); ?>