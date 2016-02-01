<? session_start();
include "./include/conn.php";
if (session_is_registered('id'))
{
	$_SESSION['id'];
	$_SESSION['user'];
	
	
	
	if (isset($_POST['kirim']))
	{
		$penyakit=ucwords($_POST['penyakit']);
		
		$periksa=mysql_db_query($db,"select * from tblpenyakit where nama_penyakit='$penyakit' ",$koneksi);
		$cek=mysql_num_rows($periksa);
		
		
		if (empty($penyakit))
		{
			echo "<script> document.location.href='dpenyakit.php?status=Data Anda masih kosong!!!'; </script>";
		}else{
			if($cek){
			echo "<script> document.location.href='dpenyakit.php?status=Data sudah ada!!!'; </script>";
			}else{
				$simpan=mysql_db_query($db,"insert into tblpenyakit(nama_penyakit) values('$penyakit')",$koneksi); 
			}
		}
	}else{
		unset($_POST['kirim']);
	}
	
	
	?>
	<html>
	<head>
		<title>GIS-Endemik</title>
		<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
		<style type="text/css">
		<!--
		.style1 {
		font-family: Verdana, Arial, Helvetica, sans-serif;
		font-size: 12px;
		}
		-->
		</style>
	</head>
	<body background="./img/background.jpg">
	<p>&nbsp;</p>
		<table border="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td width="210">
			<table width="189" height="247" border="0" align="center">
			<tr>
				<td width="103" align="center" valign="top"><? include "./include/banner.php"; ?></td>
			</tr>
			<tr>
				<td height="63" align="center"><? include "menu.php"; ?></td>
			</tr>
			<tr>
				<td height="50" align="center">
					 
					<?
					$query=mysql_db_query($db,"select * from tblpenyakit order by nama_penyakit asc",$koneksi);
					?>
					<font color='#0066FF' face='verdana' size='2'><blink><? echo $_GET['status'] ?></blink></font><br><br>
					<table width="212" border="1" align="center">
					<tr>
						<th><font size="2">Nama Penyakit</font></th><th><font size="2">Hapus</font></th>
					</tr>
					<?
					while($row=mysql_fetch_row($query))
					{
					?>
					<tr>
						<td width="165" align="center"><font face="Arial, Helvetica, sans-serif" color="#009900" size="2"><? echo $row[1]; ?></font></td>
						<td width="70" align="center"> <a href=delete.php?id=<? echo $row[0] ?>&type=dpenyakit style='text-decoration:none'>
						<img src="./img/hapus.png" border="0" title="Hapus"></a> </td>
					</tr>
					<?
					}
					?>
					</table>
				
					<br>
					<form action="dpenyakit.php" method="post">
					  <div align="center"><font face="verdana" size="2">Nama Penyakit Baru :</font> 
						<input type="text" name="penyakit" size="20">
						<input type="submit" name="kirim" value="Simpan">
					  </div>
					</form>
					
			
				</td>
			</tr>
			<tr>
				<td><p align="center">
				 <a href="home.php?page=8" title="Kembali"><img src="./img/back.png" border="0"></a>
				</p>
			    <? include "./include/footer.php"; ?></td>
			</tr>
			</table>
		  </td>
		</tr>
		</table>
	</body>
	</html>
	<?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>