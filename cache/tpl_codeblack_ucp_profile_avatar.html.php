<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<table class="tablebg" width="100%" cellspacing="1">
<tr>
	<th colspan="2" valign="middle"><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></th>
</tr>
<?php if ($this->_rootref['ERROR']) {  ?>

	<tr>
		<td class="row3" colspan="2" align="center"><span class="gensmall error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></span></td>
	</tr>
<?php } ?>

<tr> 
	<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_CURRENT_IMAGE'])) ? $this->_rootref['L_CURRENT_IMAGE'] : ((isset($user->lang['CURRENT_IMAGE'])) ? $user->lang['CURRENT_IMAGE'] : '{ CURRENT_IMAGE }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_AVATAR_EXPLAIN'])) ? $this->_rootref['L_AVATAR_EXPLAIN'] : ((isset($user->lang['AVATAR_EXPLAIN'])) ? $user->lang['AVATAR_EXPLAIN'] : '{ AVATAR_EXPLAIN }')); ?></span></td>
	<td class="row2" align="center"><br />
		<?php if ($this->_rootref['AVATAR']) {  echo (isset($this->_rootref['AVATAR'])) ? $this->_rootref['AVATAR'] : ''; ?><br /><br /><input type="checkbox" class="radio" name="delete" />&nbsp;<span class="gensmall"><?php echo ((isset($this->_rootref['L_DELETE_AVATAR'])) ? $this->_rootref['L_DELETE_AVATAR'] : ((isset($user->lang['DELETE_AVATAR'])) ? $user->lang['DELETE_AVATAR'] : '{ DELETE_AVATAR }')); ?></span>
		<?php } else { ?><img src="<?php echo (isset($this->_rootref['T_THEME_PATH'])) ? $this->_rootref['T_THEME_PATH'] : ''; ?>/images/no_avatar.gif" alt="" />
		<?php } ?></td>
</tr>
<?php if (! $this->_rootref['S_AVATARS_ENABLED']) {  ?>

	<tr>
		<td class="row3" colspan="2" align="center"><?php echo ((isset($this->_rootref['L_AVATAR_FEATURES_DISABLED'])) ? $this->_rootref['L_AVATAR_FEATURES_DISABLED'] : ((isset($user->lang['AVATAR_FEATURES_DISABLED'])) ? $user->lang['AVATAR_FEATURES_DISABLED'] : '{ AVATAR_FEATURES_DISABLED }')); ?></td>
	</tr>
<?php } if ($this->_rootref['S_UPLOAD_AVATAR_FILE']) {  ?>

	<tr> 
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_UPLOAD_AVATAR_FILE'])) ? $this->_rootref['L_UPLOAD_AVATAR_FILE'] : ((isset($user->lang['UPLOAD_AVATAR_FILE'])) ? $user->lang['UPLOAD_AVATAR_FILE'] : '{ UPLOAD_AVATAR_FILE }')); ?>: </b></td>
		<td class="row2"><input type="hidden" name="MAX_FILE_SIZE" value="<?php echo (isset($this->_rootref['AVATAR_SIZE'])) ? $this->_rootref['AVATAR_SIZE'] : ''; ?>" /><input class="post" type="file" name="uploadfile" /></td>
	</tr>
<?php } if ($this->_rootref['S_UPLOAD_AVATAR_URL']) {  ?>

	<tr> 
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_UPLOAD_AVATAR_URL'])) ? $this->_rootref['L_UPLOAD_AVATAR_URL'] : ((isset($user->lang['UPLOAD_AVATAR_URL'])) ? $user->lang['UPLOAD_AVATAR_URL'] : '{ UPLOAD_AVATAR_URL }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_UPLOAD_AVATAR_URL_EXPLAIN'])) ? $this->_rootref['L_UPLOAD_AVATAR_URL_EXPLAIN'] : ((isset($user->lang['UPLOAD_AVATAR_URL_EXPLAIN'])) ? $user->lang['UPLOAD_AVATAR_URL_EXPLAIN'] : '{ UPLOAD_AVATAR_URL_EXPLAIN }')); ?></span></td>
		<td class="row2"><input class="post" type="text" name="uploadurl" size="40" value="<?php echo (isset($this->_rootref['AVATAR_URL'])) ? $this->_rootref['AVATAR_URL'] : ''; ?>" /></td>
	</tr>
<?php } if ($this->_rootref['S_LINK_AVATAR']) {  ?>

	<tr> 
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_LINK_REMOTE_AVATAR'])) ? $this->_rootref['L_LINK_REMOTE_AVATAR'] : ((isset($user->lang['LINK_REMOTE_AVATAR'])) ? $user->lang['LINK_REMOTE_AVATAR'] : '{ LINK_REMOTE_AVATAR }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_LINK_REMOTE_AVATAR_EXPLAIN'])) ? $this->_rootref['L_LINK_REMOTE_AVATAR_EXPLAIN'] : ((isset($user->lang['LINK_REMOTE_AVATAR_EXPLAIN'])) ? $user->lang['LINK_REMOTE_AVATAR_EXPLAIN'] : '{ LINK_REMOTE_AVATAR_EXPLAIN }')); ?></span></td>
		<td class="row2"><input class="post" type="text" name="remotelink" size="40" value="<?php echo (isset($this->_rootref['AVATAR_REMOTE'])) ? $this->_rootref['AVATAR_REMOTE'] : ''; ?>" /></td>
	</tr>
	<tr> 
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_LINK_REMOTE_SIZE'])) ? $this->_rootref['L_LINK_REMOTE_SIZE'] : ((isset($user->lang['LINK_REMOTE_SIZE'])) ? $user->lang['LINK_REMOTE_SIZE'] : '{ LINK_REMOTE_SIZE }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_LINK_REMOTE_SIZE_EXPLAIN'])) ? $this->_rootref['L_LINK_REMOTE_SIZE_EXPLAIN'] : ((isset($user->lang['LINK_REMOTE_SIZE_EXPLAIN'])) ? $user->lang['LINK_REMOTE_SIZE_EXPLAIN'] : '{ LINK_REMOTE_SIZE_EXPLAIN }')); ?></span></td>
		<td class="row2"><input class="post" type="text" name="width" size="3" value="<?php echo (isset($this->_rootref['AVATAR_WIDTH'])) ? $this->_rootref['AVATAR_WIDTH'] : ''; ?>" /> <span class="gen">px X </span> <input class="post" type="text" name="height" size="3" value="<?php echo (isset($this->_rootref['AVATAR_HEIGHT'])) ? $this->_rootref['AVATAR_HEIGHT'] : ''; ?>" /> <span class="gen">px</span></td>
	</tr>
<?php } if ($this->_rootref['S_DISPLAY_GALLERY']) {  ?>

	<tr> 
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_AVATAR_GALLERY'])) ? $this->_rootref['L_AVATAR_GALLERY'] : ((isset($user->lang['AVATAR_GALLERY'])) ? $user->lang['AVATAR_GALLERY'] : '{ AVATAR_GALLERY }')); ?>: </b></td>
		<td class="row2"><strong><a href="<?php echo (isset($this->_rootref['U_GALLERY'])) ? $this->_rootref['U_GALLERY'] : ''; ?>"><?php echo ((isset($this->_rootref['L_DISPLAY_GALLERY'])) ? $this->_rootref['L_DISPLAY_GALLERY'] : ((isset($user->lang['DISPLAY_GALLERY'])) ? $user->lang['DISPLAY_GALLERY'] : '{ DISPLAY_GALLERY }')); ?></a></strong></td>
	</tr>
<?php } if ($this->_rootref['S_IN_AVATAR_GALLERY']) {  ?>

	<tr> 
		<th colspan="2"><?php echo ((isset($this->_rootref['L_AVATAR_GALLERY'])) ? $this->_rootref['L_AVATAR_GALLERY'] : ((isset($user->lang['AVATAR_GALLERY'])) ? $user->lang['AVATAR_GALLERY'] : '{ AVATAR_GALLERY }')); ?></th>
	</tr>
	<tr> 
		<td class="cat" colspan="2" align="center" valign="middle"><span class="genmed"><?php echo ((isset($this->_rootref['L_AVATAR_CATEGORY'])) ? $this->_rootref['L_AVATAR_CATEGORY'] : ((isset($user->lang['AVATAR_CATEGORY'])) ? $user->lang['AVATAR_CATEGORY'] : '{ AVATAR_CATEGORY }')); ?>: </span><select name="category"><?php echo (isset($this->_rootref['S_CAT_OPTIONS'])) ? $this->_rootref['S_CAT_OPTIONS'] : ''; ?></select>&nbsp; <input class="btnlite" tabindex="0" type="submit" value="<?php echo ((isset($this->_rootref['L_GO'])) ? $this->_rootref['L_GO'] : ((isset($user->lang['GO'])) ? $user->lang['GO'] : '{ GO }')); ?>" name="display_gallery" /></td>
	</tr>
	<tr> 
		<td class="row1" colspan="2" align="center">
			<table cellspacing="1" cellpadding="4" border="0">
			<?php $_avatar_row_count = (isset($this->_tpldata['avatar_row'])) ? sizeof($this->_tpldata['avatar_row']) : 0;if ($_avatar_row_count) {for ($_avatar_row_i = 0; $_avatar_row_i < $_avatar_row_count; ++$_avatar_row_i){$_avatar_row_val = &$this->_tpldata['avatar_row'][$_avatar_row_i]; ?>

			<tr> 
				<?php $_avatar_column_count = (isset($_avatar_row_val['avatar_column'])) ? sizeof($_avatar_row_val['avatar_column']) : 0;if ($_avatar_column_count) {for ($_avatar_column_i = 0; $_avatar_column_i < $_avatar_column_count; ++$_avatar_column_i){$_avatar_column_val = &$_avatar_row_val['avatar_column'][$_avatar_column_i]; ?>

					<td class="row1" align="center"><img src="<?php echo $_avatar_column_val['AVATAR_IMAGE']; ?>" alt="<?php echo $_avatar_column_val['AVATAR_NAME']; ?>" title="<?php echo $_avatar_column_val['AVATAR_NAME']; ?>" /></td>
				<?php }} ?>

			</tr>
			<tr>
				<?php $_avatar_option_column_count = (isset($_avatar_row_val['avatar_option_column'])) ? sizeof($_avatar_row_val['avatar_option_column']) : 0;if ($_avatar_option_column_count) {for ($_avatar_option_column_i = 0; $_avatar_option_column_i < $_avatar_option_column_count; ++$_avatar_option_column_i){$_avatar_option_column_val = &$_avatar_row_val['avatar_option_column'][$_avatar_option_column_i]; ?>

					<td class="row2" align="center"><input type="radio" class="radio" name="avatar_select" value="<?php echo $_avatar_option_column_val['S_OPTIONS_AVATAR']; ?>" /></td>
				<?php }} ?>

			</tr>
			<?php }} ?>

			</table>
		</td>
	</tr>
<?php } if ($this->_rootref['S_DISPLAY_GALLERY'] || $this->_rootref['S_IN_AVATAR_GALLERY'] || $this->_rootref['S_LINK_AVATAR'] || $this->_rootref['S_UPLOAD_AVATAR_URL'] || $this->_rootref['S_UPLOAD_AVATAR_FILE'] || $this->_rootref['AVATAR']) {  ?>

	<tr>
		<td class="cat" colspan="2" align="center"><?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?><input class="btnmain" type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;&nbsp;<?php if ($this->_rootref['S_IN_AVATAR_GALLERY']) {  ?><input class="btnlite" type="submit" name="cancel" value="<?php echo ((isset($this->_rootref['L_CANCEL'])) ? $this->_rootref['L_CANCEL'] : ((isset($user->lang['CANCEL'])) ? $user->lang['CANCEL'] : '{ CANCEL }')); ?>" /><?php } else { ?><input class="btnlite" type="reset" value="<?php echo ((isset($this->_rootref['L_RESET'])) ? $this->_rootref['L_RESET'] : ((isset($user->lang['RESET'])) ? $user->lang['RESET'] : '{ RESET }')); ?>" name="reset" /><?php } ?></td>
	</tr>
<?php } ?>

</table>

<?php $this->_tpl_include('ucp_footer.html'); ?>