<? session_start();
include "./include/conn.php";
if (session_is_registered('id'))
{
	$_SESSION['id'];
	$_SESSION['user'];
	
	if (isset($_POST['simpan']))
	{
		$tahun=$_POST['tahun'];
		$periksa=mysql_db_query($db,"select * from tbltahun where nama_tahun='$tahun' ",$koneksi);
		$cek=mysql_num_rows($periksa);
		
		if (empty($tahun))
		{
			echo "<script> document.location.href='dtahun.php?status=Data Anda masih kosong!!!'; </script>";
		}else{
			if($cek){
			echo "<script> document.location.href='dtahun.php?status=Data sudah ada!!!'; </script>";
			}else{
				$simpan=mysql_db_query($db,"insert into tbltahun(nama_tahun) values('$tahun')",$koneksi); 
			}
		}
	}else{
		unset($_POST['simpan']);
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
				 
				 
				<table>
				<tr>
					<td align="center">
						<font color='#0066FF' face='verdana' size='2'><blink><? echo $_GET['status'] ?></blink></font><br><br>
						<table width="61%" border="0" align="center">
						<table width="212" border="1" align="center">
						<tr>
							<th><font size="2">Daftar Tahun</font></th><th><font size="2">Hapus</font></th>
						</tr>
						<?
						$query=mysql_db_query($db,"select * from tbltahun order by nama_tahun asc",$koneksi);
						while($row=mysql_fetch_row($query))
						{
						?>
						<tr align="center">
							<td width="165"><font face="Arial, Helvetica, sans-serif" color="#009900" size="2"><? echo $row[1]; ?></font></td>
							<td width="70" align="center"> <a href=delete.php?id=<? echo $row[0] ?>&type=dtahun style='text-decoration:none'>
							<img src="./img/hapus.png" border="0" title="Hapus"></a> </td>
						</tr>
						<?
						}
						?>
						</table>
					</td>
				</tr>
				<tr>
				  <td>
					<br>
					<form action="dtahun.php" method="post">
					<font face="verdana" size="2">Pilih Tahun : </font> 
					<select name="tahun">
						<option value="2000">2000
						<option value="2001">2001
						<option value="2002">2002
						<option value="2003">2003
						<option value="2004">2004
						<option value="2005">2005
						<option value="2006">2006
						<option value="2007">2007
						<option value="2008">2008
						<option value="2009">2009
						<option value="2010">2010
						<option value="2011">2011
						<option value="2012">2012
						<option value="2013">2013
						<option value="2014">2014
						<option value="2015">2015
						<option value="2016">2016
						<option value="2017">2017
						<option value="2018">2018
						<option value="2019">2019
						<option value="2020">2020
					</select>
					<input type="submit" value="Simpan" name="simpan">		
					</form>
					</td>
				</tr>
				</table>
				 
				 
				 
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