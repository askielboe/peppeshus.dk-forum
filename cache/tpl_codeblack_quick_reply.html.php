<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('breadcrumbs.html'); ?>

	
<form action="<?php echo (isset($this->_rootref['S_POST_ACTION'])) ? $this->_rootref['S_POST_ACTION'] : ''; ?>" method="post" id="postform" name="postform"<?php echo (isset($this->_rootref['S_FORM_ENCTYPE'])) ? $this->_rootref['S_FORM_ENCTYPE'] : ''; ?>>

<table class="tablebg" width="100%" cellspacing="1">
	<tr>
		<th colspan="4"><b><?php echo ((isset($this->_rootref['L_QUICK_REPLY'])) ? $this->_rootref['L_QUICK_REPLY'] : ((isset($user->lang['QUICK_REPLY'])) ? $user->lang['QUICK_REPLY'] : '{ QUICK_REPLY }')); ?></b></th>
	</tr>
<td class="row2" width="20%" valign="top">
	
</td>

<td class="row1" width="60%" valign="top">
	
<table class="tablebg" width="100%" cellspacing="1">

<?php if ($this->_rootref['ERROR']) {  ?>

	<tr>
		<td class="row2" colspan="2" align="center"><span class="genmed error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></span></td>
	</tr>
<?php } if ($this->_rootref['S_DISPLAY_USERNAME']) {  ?>

	<tr>
		<td class="row1"><b class="genmed"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>:</b></td>
		<td class="row2"><input class="post" type="text" tabindex="1" name="username" size="25" value="<?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>" /></td>
	</tr>
<?php } ?>


<tr>
	<td class="row2" valign="top">
		<script type="text/javascript">
		// <![CDATA[
			var form_name = 'postform';
			var text_name = 'message';
		// ]]>
		</script>		

		<table width="100%" cellspacing="0" cellpadding="0" border="0">
	<?php $this->_tpl_include('posting_buttons_quickreply.html'); ?>

		<tr>
			<td valign="top" style="width: 100%;"><textarea name="message" rows="10" cols="76" tabindex="3" onselect="storeCaret(this);" onclick="storeCaret(this);" onkeyup="storeCaret(this);" style="width: 99.3%;"><?php echo (isset($this->_rootref['MESSAGE'])) ? $this->_rootref['MESSAGE'] : ''; ?></textarea></td>
			<?php if ($this->_rootref['S_BBCODE_ALLOWED']) {  } ?>

	 	</tr>
		</table>
	</td>
</tr>

<tr  style="display: <?php echo (isset($this->_rootref['EXTRA_OPTIONS_DISPLAY'])) ? $this->_rootref['EXTRA_OPTIONS_DISPLAY'] : ''; ?>;">
	<td class="row1" valign="top"><b class="genmed"><?php echo ((isset($this->_rootref['L_OPTIONS'])) ? $this->_rootref['L_OPTIONS'] : ((isset($user->lang['OPTIONS'])) ? $user->lang['OPTIONS'] : '{ OPTIONS }')); ?>:</b><br />
		<table cellspacing="2" cellpadding="0" border="0">
		<tr>
			<td class="gensmall"><?php echo (isset($this->_rootref['BBCODE_STATUS'])) ? $this->_rootref['BBCODE_STATUS'] : ''; ?></td>
		</tr>
		<?php if ($this->_rootref['S_BBCODE_ALLOWED']) {  ?>

		<tr>
			<td class="gensmall"><?php echo (isset($this->_rootref['IMG_STATUS'])) ? $this->_rootref['IMG_STATUS'] : ''; ?></td>
		</tr>
		<tr>
			<td class="gensmall"><?php echo (isset($this->_rootref['FLASH_STATUS'])) ? $this->_rootref['FLASH_STATUS'] : ''; ?></td>
		</tr>
		<tr>
			<td class="gensmall"><?php echo (isset($this->_rootref['URL_STATUS'])) ? $this->_rootref['URL_STATUS'] : ''; ?></td>
		</tr>
		<tr>
			<td class="gensmall"><?php echo (isset($this->_rootref['SMILIES_STATUS'])) ? $this->_rootref['SMILIES_STATUS'] : ''; ?></td>
		</tr>
		<?php } ?>

		</table>
	</td>
	<td class="row2">
		<table cellpadding="1">
		<?php if ($this->_rootref['S_BBCODE_ALLOWED']) {  ?>

			<tr>
				<td><input type="checkbox" class="radio" name="disable_bbcode"<?php echo (isset($this->_rootref['S_BBCODE_CHECKED'])) ? $this->_rootref['S_BBCODE_CHECKED'] : ''; ?> /></td>
				<td class="gen"><?php echo ((isset($this->_rootref['L_DISABLE_BBCODE'])) ? $this->_rootref['L_DISABLE_BBCODE'] : ((isset($user->lang['DISABLE_BBCODE'])) ? $user->lang['DISABLE_BBCODE'] : '{ DISABLE_BBCODE }')); ?></td>
			</tr>
		<?php } if ($this->_rootref['S_SMILIES_ALLOWED']) {  ?>

			<tr>
				<td><input type="checkbox" class="radio" name="disable_smilies"<?php echo (isset($this->_rootref['S_SMILIES_CHECKED'])) ? $this->_rootref['S_SMILIES_CHECKED'] : ''; ?> /></td>
				<td class="gen"><?php echo ((isset($this->_rootref['L_DISABLE_SMILIES'])) ? $this->_rootref['L_DISABLE_SMILIES'] : ((isset($user->lang['DISABLE_SMILIES'])) ? $user->lang['DISABLE_SMILIES'] : '{ DISABLE_SMILIES }')); ?></td>
			</tr>
		<?php } if ($this->_rootref['S_LINKS_ALLOWED']) {  ?>

		<tr>
			<td><input type="checkbox" class="radio" name="disable_magic_url"<?php echo (isset($this->_rootref['S_MAGIC_URL_CHECKED'])) ? $this->_rootref['S_MAGIC_URL_CHECKED'] : ''; ?> /></td>
			<td class="gen"><?php echo ((isset($this->_rootref['L_DISABLE_MAGIC_URL'])) ? $this->_rootref['L_DISABLE_MAGIC_URL'] : ((isset($user->lang['DISABLE_MAGIC_URL'])) ? $user->lang['DISABLE_MAGIC_URL'] : '{ DISABLE_MAGIC_URL }')); ?></td>
		</tr>
		<?php } if ($this->_rootref['S_SIG_ALLOWED']) {  ?>

			<tr>
				<td><input type="checkbox" class="radio" name="attach_sig"<?php echo (isset($this->_rootref['S_SIGNATURE_CHECKED'])) ? $this->_rootref['S_SIGNATURE_CHECKED'] : ''; ?> /></td>
				<td class="gen"><?php echo ((isset($this->_rootref['L_ATTACH_SIG'])) ? $this->_rootref['L_ATTACH_SIG'] : ((isset($user->lang['ATTACH_SIG'])) ? $user->lang['ATTACH_SIG'] : '{ ATTACH_SIG }')); ?></td>
			</tr>
		<?php } if ($this->_rootref['S_NOTIFY_ALLOWED']) {  ?>

			<tr>
				<td><input type="checkbox" class="radio" name="notify"<?php echo (isset($this->_rootref['S_NOTIFY_CHECKED'])) ? $this->_rootref['S_NOTIFY_CHECKED'] : ''; ?> /></td>
				<td class="gen"><?php echo ((isset($this->_rootref['L_NOTIFY_REPLY'])) ? $this->_rootref['L_NOTIFY_REPLY'] : ((isset($user->lang['NOTIFY_REPLY'])) ? $user->lang['NOTIFY_REPLY'] : '{ NOTIFY_REPLY }')); ?></td>
			</tr>
		<?php } if ($this->_rootref['S_LOCK_TOPIC_ALLOWED']) {  ?>

			<tr>
				<td><input type="checkbox" class="radio" name="lock_topic"<?php echo (isset($this->_rootref['S_LOCK_TOPIC_CHECKED'])) ? $this->_rootref['S_LOCK_TOPIC_CHECKED'] : ''; ?> /></td>
				<td class="gen"><?php echo ((isset($this->_rootref['L_LOCK_TOPIC'])) ? $this->_rootref['L_LOCK_TOPIC'] : ((isset($user->lang['LOCK_TOPIC'])) ? $user->lang['LOCK_TOPIC'] : '{ LOCK_TOPIC }')); ?></td>
			</tr>
		<?php } if ($this->_rootref['S_LOCK_POST_ALLOWED']) {  ?>

			<tr>
				<td><input type="checkbox" class="radio" name="lock_post"<?php echo (isset($this->_rootref['S_LOCK_POST_CHECKED'])) ? $this->_rootref['S_LOCK_POST_CHECKED'] : ''; ?> /></td>
				<td class="gen"><?php echo ((isset($this->_rootref['L_LOCK_POST'])) ? $this->_rootref['L_LOCK_POST'] : ((isset($user->lang['LOCK_POST'])) ? $user->lang['LOCK_POST'] : '{ LOCK_POST }')); ?> [<?php echo ((isset($this->_rootref['L_LOCK_POST_EXPLAIN'])) ? $this->_rootref['L_LOCK_POST_EXPLAIN'] : ((isset($user->lang['LOCK_POST_EXPLAIN'])) ? $user->lang['LOCK_POST_EXPLAIN'] : '{ LOCK_POST_EXPLAIN }')); ?>]</td>
			</tr>
		<?php } ?>

		</table>
	</td>
</tr>

<?php if ($this->_rootref['S_CONFIRM_CODE']) {  ?>

	<tr>
		<th colspan="2" valign="middle"><?php echo ((isset($this->_rootref['L_POST_CONFIRMATION'])) ? $this->_rootref['L_POST_CONFIRMATION'] : ((isset($user->lang['POST_CONFIRMATION'])) ? $user->lang['POST_CONFIRMATION'] : '{ POST_CONFIRMATION }')); ?></th>
	</tr>
	<tr>
		<td class="row3" colspan="2"><span class="gensmall"><?php echo ((isset($this->_rootref['L_POST_CONFIRM_EXPLAIN'])) ? $this->_rootref['L_POST_CONFIRM_EXPLAIN'] : ((isset($user->lang['POST_CONFIRM_EXPLAIN'])) ? $user->lang['POST_CONFIRM_EXPLAIN'] : '{ POST_CONFIRM_EXPLAIN }')); ?></span></td>
	</tr>
	<tr>
		<td class="row1" colspan="2" align="center">
			<input type="hidden" name="confirm_id" value="<?php echo (isset($this->_rootref['CONFIRM_ID'])) ? $this->_rootref['CONFIRM_ID'] : ''; ?>" />
			<?php echo (isset($this->_rootref['CONFIRM_IMAGE'])) ? $this->_rootref['CONFIRM_IMAGE'] : ''; ?>

		</td>
	</tr>
	<tr>
		<td class="row1"><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_CODE'])) ? $this->_rootref['L_CONFIRM_CODE'] : ((isset($user->lang['CONFIRM_CODE'])) ? $user->lang['CONFIRM_CODE'] : '{ CONFIRM_CODE }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_CONFIRM_CODE_EXPLAIN'])) ? $this->_rootref['L_CONFIRM_CODE_EXPLAIN'] : ((isset($user->lang['CONFIRM_CODE_EXPLAIN'])) ? $user->lang['CONFIRM_CODE_EXPLAIN'] : '{ CONFIRM_CODE_EXPLAIN }')); ?></span></td>
		<td class="row2"><input class="post" type="text" name="confirm_code" size="8" maxlength="8" /></td>
	</tr>
<?php } if ($this->_rootref['S_SHOW_ATTACH_BOX']) {  ?>

	<tr>
		<td class="cat" colspan="2" align="center">
			<input class="btnlite" type="submit" tabindex="5" name="preview" value="<?php echo ((isset($this->_rootref['L_PREVIEW'])) ? $this->_rootref['L_PREVIEW'] : ((isset($user->lang['PREVIEW'])) ? $user->lang['PREVIEW'] : '{ PREVIEW }')); ?>" />
			&nbsp; <input class="btnmain" type="submit" accesskey="s" tabindex="6" name="post" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />
		</td>
	</tr>

<?php $this->_tpl_include('posting_attach_body.html'); } ?>


<tr>
	<td class="cat" colspan="2" align="center">
		<?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?>

		<input class="btnlite" type="submit" tabindex="10" name="preview" value="<?php echo ((isset($this->_rootref['L_PREVIEW'])) ? $this->_rootref['L_PREVIEW'] : ((isset($user->lang['PREVIEW'])) ? $user->lang['PREVIEW'] : '{ PREVIEW }')); ?>" />
		&nbsp; <input class="btnmain" type="submit" accesskey="s" tabindex="11" name="post" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />
	</td>
</tr>
</table>
</td>

<td class="row2" width="20%" valign="top">
	
</td>

<br clear="all" />
<?php echo (isset($this->_rootref['S_FORM_TOKEN'])) ? $this->_rootref['S_FORM_TOKEN'] : ''; ?>

</form>