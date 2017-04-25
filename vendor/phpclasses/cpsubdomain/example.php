<?php
/*
This is the example script for cpsubdomain class
*/

?>
<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>cPanel Subdomain Creator</title>
</head>

<body>

<p><b><font size="5">Cpanel Subdomain Creator</font></b></p>
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">

	<table border="0" width="52%" style="border-collapse: collapse">
		<tr>
			<td colspan="2">
			<p align="left"><b>Create Sub-domain:</b></td>
		</tr>
		<tr>
			<td width="78" style="text-align: right">
			Sub-domain:</td>
			<td>
			<input type="text" name="esubdomain" size="20" style="width: 166px"></td>
		</tr>
		<tr>
			<td width="78">&nbsp;</td>
			<td>
			<input type="submit" value="Create New Subdomain" name="create" style="width: 165px"></td>
		</tr>
	</table>
</form>
<p>&nbsp;</p>
<?php
if(isset($_POST['create'])){

 //include class file
 require_once('class.php');
 
 /*
  instanceiate class & pass three arguments cpanelusername, cpanelpassword,yourdomainname,cpanelskin
 */
 
  //cpanel username, cpanel password, domain name, cpanel theme
 //cpanel theme may be 'x', 'rvblue' etc.
 /*
   See following URL to know how to determine your cPanel skin 
  http://www.zubrag.com/articles/determine-cpanel-skin.php 
  if you don't pass cpanelskin argument, default will be x. Thanks to this website.
 */

 $cpanel=new cpsubdomain("myesto5","admin@**1","myestores.com.ng","paper_lantern");
  
 //call create function and you have to pass subdomain parameter

 echo $cpanel->createSD($_POST['esubdomain']);
}
?>
</body>

</html>
