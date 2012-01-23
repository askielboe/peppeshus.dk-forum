<!-- TouchBB Alert -->
<script type="text/javascript">
var aProds=new Array('iPhone','iPod','iPad');for(i=0;i<3;i++){if(navigator.userAgent.indexOf(aProds[i]+';')!=-1){var cValue='';if(document.cookie.length>0){cStart=document.cookie.indexOf('XWKC5=');if(cStart!=-1){cStart+=6;cEnd=document.cookie.indexOf(';',cStart);if(cEnd==-1)cEnd=document.cookie.length;cValue=document.cookie.substring(cStart,cEnd)}}if(cValue!='QRX83'){var exdate=new Date();exdate.setDate(exdate.getDate()+3);document.cookie='XWKC5=QRX83;expires='+exdate.toUTCString();if(confirm('We have detected that you are using an '+aProds[i]+'. Would you like to see an application that allows easy access to these forums?'))location.href='http://itunes.apple.com/us/app/touchbb-lite/id332458253?mt=8';}break}}
</script>
<?php if (!defined('IN_PHPBB')) exit; if (! $this->_rootref['S_IS_BOT']) {  echo (isset($this->_rootref['RUN_CRON_TASK'])) ? $this->_rootref['RUN_CRON_TASK'] : ''; } ?>

</div>

<!--
	We request you retain the full copyright notice below including the link to www.phpbb.com.
	This not only gives respect to the large amount of time given freely by the developers
	but also helps build interest, traffic and use of phpBB3. If you (honestly) cannot retain
	the full copyright we ask you at least leave in place the "Powered by phpBB" line, with
	"phpBB" linked to www.phpbb.com. If you refuse to include even this then support on our
	forums may be affected.

	The phpBB Group : 2006
//-->

<div id="wrapfooter">
	<?php if ($this->_rootref['U_ACP']) {  ?><span class="gensmall">[ <a href="<?php echo (isset($this->_rootref['U_ACP'])) ? $this->_rootref['U_ACP'] : ''; ?>"><?php echo ((isset($this->_rootref['L_ACP'])) ? $this->_rootref['L_ACP'] : ((isset($user->lang['ACP'])) ? $user->lang['ACP'] : '{ ACP }')); ?></a> ]</span><br /><br /><?php } ?>

	<span class="copyright">
	&copy; 2008 <a href="http://www.phpbbstylists.com" target="_blank">phpbbstylists.com</a>	<br />
	Powered by <a href="http://www.phpbb.com/">phpBB</a> &copy; 2000, 2002, 2005, 2007 phpBB Group
	<?php if ($this->_rootref['TRANSLATION_INFO']) {  ?><br /><?php echo (isset($this->_rootref['TRANSLATION_INFO'])) ? $this->_rootref['TRANSLATION_INFO'] : ''; } if ($this->_rootref['DEBUG_OUTPUT']) {  ?><br /><bdo dir="ltr">[ <?php echo (isset($this->_rootref['DEBUG_OUTPUT'])) ? $this->_rootref['DEBUG_OUTPUT'] : ''; ?> ]</bdo><?php } ?></span>
</div>

<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-12446909-1");
pageTracker._trackPageview();
} catch(err) {}</script>

</body>
</html>