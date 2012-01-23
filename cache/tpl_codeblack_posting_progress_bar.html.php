<?php if (!defined('IN_PHPBB')) exit; $this->_tpl_include('simple_header.html'); ?>

<script type="text/javascript">
// <![CDATA[
	/**
	* Close upload popup
	*/
	function close_popup()
	{
		if (opener != null)
		{
			if (opener.close_waitscreen != null)
			{
				if (opener.close_waitscreen == 1)
				{
					opener.close_waitscreen = 0;
					self.close();
					return 0;
				}
			}
		}
		setTimeout("close_popup()", 1000);
		return 0;
	}
// ]]>
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="10">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="1" cellpadding="4">
		<tr> 
			<td valign="top" class="row1" align="center"><br /><span class="genmed"><?php echo ((isset($this->_rootref['L_UPLOAD_IN_PROGRESS'])) ? $this->_rootref['L_UPLOAD_IN_PROGRESS'] : ((isset($user->lang['UPLOAD_IN_PROGRESS'])) ? $user->lang['UPLOAD_IN_PROGRESS'] : '{ UPLOAD_IN_PROGRESS }')); ?></span><br /><br /><div style="align:center"><?php echo (isset($this->_rootref['PROGRESS_BAR'])) ? $this->_rootref['PROGRESS_BAR'] : ''; ?></div><br /><br /><span class="genmed"><a href="#" onclick="window.close(); return false;"><?php echo ((isset($this->_rootref['L_CLOSE_WINDOW'])) ? $this->_rootref['L_CLOSE_WINDOW'] : ((isset($user->lang['CLOSE_WINDOW'])) ? $user->lang['CLOSE_WINDOW'] : '{ CLOSE_WINDOW }')); ?></a></span><br /><br /></td>
		</tr>
		</table>
	</td>
</tr>
</table>

<script type="text/javascript">
// <![CDATA[
	close_popup();	
// ]]>
</script>
<?php $this->_tpl_include('simple_footer.html'); ?>