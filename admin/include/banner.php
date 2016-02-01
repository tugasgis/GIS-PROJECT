<? session_start();
if (session_is_registered('id'))
{
?>
	<html>
	<head>
		<title>GIS-Endemik</title>
	</head>
	<body>
	<img src="./img/banner.jpg" border="1">
	
	</body>
	</html>
<?
}else{
	echo "<script> document.location.href='konfirmasi.php?id=session'; </script>";
}
?>