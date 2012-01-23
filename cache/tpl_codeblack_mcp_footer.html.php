<?php if (!defined('IN_PHPBB')) exit; ?></td>
		</tr>
	</table>

	<?php if ($this->_rootref['PAGINATION']) {  ?>

		<table width="80%" align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>" cellspacing="1">
		<tr>
			<td class="nav" valign="middle" nowrap="nowrap">&nbsp;<?php echo (isset($this->_rootref['PAGE_NUMBER'])) ? $this->_rootref['PAGE_NUMBER'] : ''; ?><br /></td>
			<td class="gensmall" nowrap="nowrap">&nbsp;[ <?php if ($this->_rootref['TOTAL_TOPICS']) {  echo (isset($this->_rootref['TOTAL_TOPICS'])) ? $this->_rootref['TOTAL_TOPICS'] : ''; } else if ($this->_rootref['TOTAL_POSTS']) {  echo (isset($this->_rootref['TOTAL_POSTS'])) ? $this->_rootref['TOTAL_POSTS'] : ''; } else { echo (isset($this->_rootref['TOTAL'])) ? $this->_rootref['TOTAL'] : ''; } ?> ]&nbsp;</td>
			<td class="gensmall" width="100%" align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>" nowrap="nowrap"><?php $this->_tpl_include('pagination.html'); ?></td>
		</tr>
		</table>
		<br />
	<?php } ?>

	
</div>

<br clear="all" />

<?php $this->_tpl_include('breadcrumbs.html'); ?>


<br clear="all" />

<div align="<?php echo (isset($this->_rootref['S_CONTENT_FLOW_END'])) ? $this->_rootref['S_CONTENT_FLOW_END'] : ''; ?>"><?php $this->_tpl_include('jumpbox.html'); ?></div>

<?php $this->_tpl_include('overall_footer.html'); ?>