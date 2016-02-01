<? session_start(); 
//halaman untuk menangkap variabel $map dan mendaftarkan nilai variabel tersebut kedalam sebuah session
//sehingga nilai variabel $map tersebut bisa di panggil oleh halaman peta.php 
//setelah session berhasil di buat, maka user akan di redirect ke halaman peta.php
//dan halaman peta tinggal memanggil session yang terdapat nilai variabel $map yang sudah di buat sebelumnya di halaman session.php
//penciptaan session
include 'koneksi';
$map = $_GET['map'];
$tahun = $_GET['tahun'];

?>
<?php
session_register();
$_SESSION['map'];
$_SESSION['tahun'];
?>
<html>
<head>
<script language="javascript">
var HitungDetik=1

function PindahHalaman()
{
	HitungDetik=HitungDetik+1;
	
	if (HitungDetik==3)
		document.location.href="peta.php";
	else
		setTimeout("PindahHalaman()",1000);
}
</script>
<style type="text/css">
<!--
.style2 {color: #0033FF}
-->
</style>
</head>
<body onLoad="PindahHalaman()">
<link rel="shortcut icon" href="./img/proses.ico" type="image/x-icon">
<p align="center" class="style2">&nbsp;</p>
<p align="center" class="style2">&nbsp;</p>
<p align="center" class="style2">&nbsp;</p>
<p align="center" class="style2">&nbsp;</p>
<p align="center" class="style2">&nbsp;</p>
<p align="center" class="style2"><img src="./img/proses.ico">&nbsp;</p>
<p align="center" class="style2"><font face="verdana" size="3"><b>Sedang di proses...</b></font></p>
</body>
</html>