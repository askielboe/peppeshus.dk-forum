<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('ucp_header.html'); ?>


<table class="tablebg" width="100%" cellspacing="1">
<tr>
	<th colspan="2" valign="middle"><?php echo ((isset($this->_rootref['L_TITLE'])) ? $this->_rootref['L_TITLE'] : ((isset($user->lang['TITLE'])) ? $user->lang['TITLE'] : '{ TITLE }')); ?></th>
</tr>
<?php if ($this->_rootref['S_FORCE_PASSWORD']) {  ?>

	<tr>
		<td class="row3" colspan="2" align="center"><span class="gensmall"><?php echo ((isset($this->_rootref['L_FORCE_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_FORCE_PASSWORD_EXPLAIN'] : ((isset($user->lang['FORCE_PASSWORD_EXPLAIN'])) ? $user->lang['FORCE_PASSWORD_EXPLAIN'] : '{ FORCE_PASSWORD_EXPLAIN }')); ?></span></td>
	</tr>
<?php } if ($this->_rootref['ERROR']) {  ?>

	<tr>
		<td class="row3" colspan="2" align="center"><span class="gensmall error"><?php echo (isset($this->_rootref['ERROR'])) ? $this->_rootref['ERROR'] : ''; ?></span></td>
	</tr>
<?php } ?>

<tr>
	<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_USERNAME'])) ? $this->_rootref['L_USERNAME'] : ((isset($user->lang['USERNAME'])) ? $user->lang['USERNAME'] : '{ USERNAME }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_USERNAME_EXPLAIN'])) ? $this->_rootref['L_USERNAME_EXPLAIN'] : ((isset($user->lang['USERNAME_EXPLAIN'])) ? $user->lang['USERNAME_EXPLAIN'] : '{ USERNAME_EXPLAIN }')); ?></span></td>
	<td class="row2"><?php if ($this->_rootref['S_CHANGE_USERNAME']) {  ?><input type="text" class="post" name="username" size="30" value="<?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?>" /><?php } else { ?><b class="gen"><?php echo (isset($this->_rootref['USERNAME'])) ? $this->_rootref['USERNAME'] : ''; ?></b><?php } ?></td>
</tr>
<tr>
	<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_EMAIL_ADDRESS'])) ? $this->_rootref['L_EMAIL_ADDRESS'] : ((isset($user->lang['EMAIL_ADDRESS'])) ? $user->lang['EMAIL_ADDRESS'] : '{ EMAIL_ADDRESS }')); ?>: </b></td>
	<td class="row2"><?php if ($this->_rootref['S_CHANGE_EMAIL']) {  ?><input type="text" class="post" name="email" size="30" maxlength="100" value="<?php echo (isset($this->_rootref['EMAIL'])) ? $this->_rootref['EMAIL'] : ''; ?>" /><?php } else { ?><b class="gen"><?php echo (isset($this->_rootref['EMAIL'])) ? $this->_rootref['EMAIL'] : ''; ?></b><?php } ?></td>
</tr>
<?php if ($this->_rootref['S_CHANGE_EMAIL']) {  ?>

	<tr>
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_EMAIL'])) ? $this->_rootref['L_CONFIRM_EMAIL'] : ((isset($user->lang['CONFIRM_EMAIL'])) ? $user->lang['CONFIRM_EMAIL'] : '{ CONFIRM_EMAIL }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_CONFIRM_EMAIL_EXPLAIN'])) ? $this->_rootref['L_CONFIRM_EMAIL_EXPLAIN'] : ((isset($user->lang['CONFIRM_EMAIL_EXPLAIN'])) ? $user->lang['CONFIRM_EMAIL_EXPLAIN'] : '{ CONFIRM_EMAIL_EXPLAIN }')); ?></span></td>
		<td class="row2"><input type="text" class="post" name="email_confirm" size="30" maxlength="100" value="<?php echo (isset($this->_rootref['CONFIRM_EMAIL'])) ? $this->_rootref['CONFIRM_EMAIL'] : ''; ?>" /></td>
	</tr>
<?php } if ($this->_rootref['S_CHANGE_PASSWORD']) {  ?>

	<tr>
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_NEW_PASSWORD'])) ? $this->_rootref['L_NEW_PASSWORD'] : ((isset($user->lang['NEW_PASSWORD'])) ? $user->lang['NEW_PASSWORD'] : '{ NEW_PASSWORD }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_CHANGE_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_CHANGE_PASSWORD_EXPLAIN'] : ((isset($user->lang['CHANGE_PASSWORD_EXPLAIN'])) ? $user->lang['CHANGE_PASSWORD_EXPLAIN'] : '{ CHANGE_PASSWORD_EXPLAIN }')); ?></span></td>
		<td class="row2"><input type="password" class="post" name="new_password" size="30" maxlength="255" value="<?php echo (isset($this->_rootref['NEW_PASSWORD'])) ? $this->_rootref['NEW_PASSWORD'] : ''; ?>" /></td>
	</tr>
	<tr>
		<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_CONFIRM_PASSWORD'])) ? $this->_rootref['L_CONFIRM_PASSWORD'] : ((isset($user->lang['CONFIRM_PASSWORD'])) ? $user->lang['CONFIRM_PASSWORD'] : '{ CONFIRM_PASSWORD }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_CONFIRM_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_CONFIRM_PASSWORD_EXPLAIN'] : ((isset($user->lang['CONFIRM_PASSWORD_EXPLAIN'])) ? $user->lang['CONFIRM_PASSWORD_EXPLAIN'] : '{ CONFIRM_PASSWORD_EXPLAIN }')); ?></span></td>
		<td class="row2"><input type="password" class="post" name="password_confirm" size="30" maxlength="255" value="<?php echo (isset($this->_rootref['PASSWORD_CONFIRM'])) ? $this->_rootref['PASSWORD_CONFIRM'] : ''; ?>" /></td>
	</tr>
<?php } ?>

<tr>
	<th colspan="2"><?php echo ((isset($this->_rootref['L_CONFIRM_CHANGES'])) ? $this->_rootref['L_CONFIRM_CHANGES'] : ((isset($user->lang['CONFIRM_CHANGES'])) ? $user->lang['CONFIRM_CHANGES'] : '{ CONFIRM_CHANGES }')); ?></th>
</tr>
<tr>
	<td class="row1" width="35%"><b class="genmed"><?php echo ((isset($this->_rootref['L_CURRENT_PASSWORD'])) ? $this->_rootref['L_CURRENT_PASSWORD'] : ((isset($user->lang['CURRENT_PASSWORD'])) ? $user->lang['CURRENT_PASSWORD'] : '{ CURRENT_PASSWORD }')); ?>: </b><br /><span class="gensmall"><?php echo ((isset($this->_rootref['L_CURRENT_PASSWORD_EXPLAIN'])) ? $this->_rootref['L_CURRENT_PASSWORD_EXPLAIN'] : ((isset($user->lang['CURRENT_PASSWORD_EXPLAIN'])) ? $user->lang['CURRENT_PASSWORD_EXPLAIN'] : '{ CURRENT_PASSWORD_EXPLAIN }')); ?></span></td>
	<td class="row2"><input type="password" class="post" name="cur_password" size="30" maxlength="255" value="<?php echo (isset($this->_rootref['CUR_PASSWORD'])) ? $this->_rootref['CUR_PASSWORD'] : ''; ?>" /></td>
</tr>
<tr>
	<td class="cat" colspan="2" align="center"><?php echo (isset($this->_rootref['S_HIDDEN_FIELDS'])) ? $this->_rootref['S_HIDDEN_FIELDS'] : ''; ?><input class="btnmain" type="submit" name="submit" value="<?php echo ((isset($this->_rootref['L_SUBMIT'])) ? $this->_rootref['L_SUBMIT'] : ((isset($user->lang['SUBMIT'])) ? $user->lang['SUBMIT'] : '{ SUBMIT }')); ?>" />&nbsp;&nbsp;<input class="btnlite" type="reset" value="<?php echo ((isset($this->_rootref['L_RESET'])) ? $this->_rootref['L_RESET'] : ((isset($user->lang['RESET'])) ? $user->lang['RESET'] : '{ RESET }')); ?>" name="reset" /></td>
</tr>
</table>

<?php $this->_tpl_include('ucp_footer.html'); ?>