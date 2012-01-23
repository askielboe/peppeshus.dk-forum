<!--
Smilies Packager version 0.5
Author: Budi Santoso (Chow Shan Yuen) <webdev@tulungagungonline.com>

Note: 
1. Create new folder in your root. ex: http://localhost/mysmiley
2. Put pack.php and all your smiley images to that folder.
3. Run pack.php
4. Move all image and smilies.pak to your phpBB forum (/images/smiles).
5. Import smilies.pak files.

Many people asking me to develop this code, but i don't have time for that :(
Same as previous version, i have 15 minutes only to create/modifying this code.
Please develop this.

What's new :
-pack.php with packsave.php blended.
-Register global problem fixed.
-Unlink warning message when no smilies.pak file has been fixed.

Give me your modification of this code, then please send it to me.
Of course, you'll be the next author.
-->

<HTML>
<HEAD>
<TITLE>Smilies Packager v0.5</TITLE>
</HEAD>
<BODY bgcolor="#ffffff">
<?php
error_reporting(E_ALL ^ E_WARNING);
if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
unlink("smilies.pak");
  $pegangan = fopen("smilies.pak", "a");
  $nf=$_POST['nf'];
  $desc=$_POST['desc'];
  $code=$_POST['code'];
  for($i=0;$i<=sizeof($nf)-1;$i++) {
//	echo "$nf[$i] $desc[$i] $code[$i] <br>" ;
	fputs($pegangan, $nf[$i] . "=+:");
	fputs($pegangan, $desc[$i] ."=+::");
	fputs($pegangan, $code[$i] . "\n");
  }
  fclose($pegangan);
  print("smilies.pak created <BR>\n");
  print("<A href=\"javascript:history.back();\">Back</A>");

} else {
?>

<FORM action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" >
<table bgcolor="#929DB1"   border="1" align="center" cellspacing="0" bordercolordark="white" bordercolorlight="black">
<tr>
<th bgcolor="#8894B8"><font size="3" face="Arial">Images</font></th>
<th bgcolor="#8894B8"><font size="3" face="Arial">Description</font></th>
<th bgcolor="#8894B8"><font size="3" face="Arial">Code</font></th>
<?php
    $dir = opendir(".");
    while ($entri = readdir($dir))
	{
	echo ("<tr>");
	if(($entri<>".") AND ($entri<>"..") AND (substr($entri,-4,4)<>".php") AND (substr($entri,-4,4)<>".txt"))
	{ 
	  print("<INPUT TYPE=HIDDEN NAME=\"nf[]\" VALUE=$entri>");
      print("<td><img src=\"$entri\" align=\"right\"></td><td><INPUT TYPE=TEXT NAME=\"desc[]\" VALUE=$entri  style=\"font-family:Verdana; font-style:normal; font-weight:bold; color:white; text-decoration:none; background-color:black; border-width:1; border-color:silver; border-style:solid;\"></td><td><INPUT TYPE=TEXT NAME=\"code[]\" VALUE=$entri style=\"font-family:Verdana; font-style:normal; font-weight:bold; color:lime; text-decoration:none; background-color:black; border-width:1; border-color:silver; border-style:solid;\"></td>");
	}
	echo ("</tr>");
	}
    closedir($dir);
?>
</tr>
</table>
<br>
<input type="hidden" name="action" value="submitted" />
<div align="center"><INPUT TYPE=SUBMIT VALUE="Create"></div>
</FORM>
<?php
}
?> 
</BODY>
</HTML>
