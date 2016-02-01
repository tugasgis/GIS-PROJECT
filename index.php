<? session_start();
session_unregister('map');
setcookie("counter","visitor",time()+3600); ?>

<html>
<head><title>GIS-Endemik</title>

</head>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<body background="./img/background.jpg">
<p>&nbsp;</p>

<table width="1001" height="341" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr valign="top">
	<td height="18" colspan="7" align="center"><? include "./include/banner.php"; ?></td>
</tr>


<tr>
	<td width="13" valign="top" align="left"  background="./img/b-kiri.jpg">&nbsp;</td>
	<td width="17" valign="top" colspan="0" rowspan="0">
		<? include "menu1.php";?>
		<? include "menu2.php";?><br>
		<? include "counter.php"; ?><br>
		<? include "jam.php"; ?><br>
		
	</td>
	
	<td width="17" valign="top" align="right" background="./img/b-kanan.jpg">&nbsp;</td>
	<td width="757" valign="top" align="center"><? include "isi.php" ?>	</td>		
	<td width="12" valign="top" align="right" background="./img/b-kiri.jpg">&nbsp;</td>
	<td width="166" valign="top" align="center"><br>
	<? include "voting.php"; ?><br>
	<? 
	
	if (session_is_registered('user_id'))
	{
		include "status.php";
	}else{
		include "login.php";
	} 
	
	
	?>
	<br>
	<? include "./include/slide.php"; ?>
	</td>
	<td width="19" valign="top" align="right" background="./img/b-kanan.jpg">&nbsp;</td>
</tr>

<tr valign="top">
	<td height="18" colspan="7" align="center"><? include "./include/footer.php"; ?></td>
</tr>
</table>
<p>&nbsp;</p>
</body>
</html>