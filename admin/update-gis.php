<? session_start();
include "./include/conn.php";
if (session_is_registered('id'))
{
	$_SESSION['id'];
	$_SESSION['user'];
	
	
	if(isset($_POST['map']))
	{
	
		$id_penyebaran=$_POST['id_penyebaran'];
		$peta=$_POST['map'];
		$map="C:/ms4w/apps/endemikgis/".$_POST['map'];
		$tanggal;
		
		
		//periksa apakah data yang dimasukan tidak ada yang kosong??
		if (empty($peta))
		{
			?><script> document.location.href='update-gis.php?status=Maaf, Data Anda belum lengkap!!&id=<? echo $id_penyebaran; ?>'; </script><?
		}else{
			//periksa apakah jumlah penderita yang dimasukan berupa angka apa selain angka??
					
			$simpan=mysql_db_query($db,"update tblpenyebaran set map='$map',tanggal='$tanggal' where id_penyebaran='$id_penyebaran'",$koneksi);
			
			if ($simpan)
			{
				echo "<script> alert('Data Anda sudah di ubah'); </script>";
				echo "<script> document.location.href='home.php?page=7'; </script>";
			}else{
				echo "gagal!!";
			}
				
		}
		
	
	
	
	}else{
		unset($_POST['map']);
	}
	
	
	?>
	<html>
	<head>
		<link rel="shortcut icon" href="./img/favicon.ico" type="image/x-icon">
		<title>GIS-Endemik</title>
		<style type="text/css">
		<!--
.style2 {font-size: 14px}
.style3 {font-family: Arial, Helvetica, sans-serif}
		-->
		</style>
	</head>
	<body background="./img/background.jpg">
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
				$id=$_GET['id']; //id catatan
				
				$tampil=mysql_db_query($db,"select * from tblpenyebaran where id_penyebaran='$id'",$koneksi);
				while ($row=mysql_fetch_array($tampil))
				{
					$id_penyebaran=$row[0];
					$nama_penyakit=$row[1];
					$jumlah=$row['jumlah'];
					$tahun=$row['tahun'];
					$map=$row['map'];
				}
				?>
				
				</p>
				<h2 class="style2 style3">[Update GIS]</h2>
				<p><font color='#0066FF' face='verdana' size='2'><? echo $_GET['status'] ?></font><br>
			    </p>
				<form action="update-gis.php?id=<? echo $id;?>" method="post">
				<table width="459" align="center">
				<tr>
					<td width="134"><font face="verdana" size="2">ID</font></td>
					<td width="313">
						<font color="#666666" size="2"><? echo $id_penyebaran; ?></font>
					</td>
				</tr>
				<tr>
					<td width="134"><font face="verdana" size="2">Tahun</font></td>
					<td width="313">
						<font color="#666666" size="2"><? echo $tahun; ?></font>
					</td>
				</tr>
				<tr>
					<td><font face="verdana" size="2">Penyakit</font></td>
					<td>
						<font color="#666666" size="2"><? echo $nama_penyakit; ?></font>
					</td>
				</tr>
				<tr>
					<td><font face="verdana" size="2">Jumlah penderita</td>
					<td><font color="#666666" size="2"><? echo $jumlah; ?></font></td>
				</tr>
				<tr>
					<td><font face="verdana" size="2">Peta Lama </font></td>
					<td><font color="#666666" size="2"><? echo $map; ?></font></td>
				</tr>
				<tr>
					<td><font face="verdana" size="2">Peta Baru </font></td>
					<td><input type="file" name="map" size="30" value="<? echo $map; ?>"></td>
					<input type="hidden" name="id_penyebaran" value="<? echo $id_penyebaran; ?>"
				</tr>
				<tr>
					<td>&nbsp;</td>
					
					<td><br><input type="submit"  name="update" value="Update">&nbsp;<input type="button" onClick="location.replace('home.php?page=11&tahun=<? echo $tahun?>&penyakit=<? echo $nama_penyakit?>&id_penyebaran=<? echo $id_penyebaran;?>')" value="Tambah Data"></td>
				</tr>
				<tr>
					<td><a href="home.php?page=7" title="Kembali"><img src="./img/back.png" border="0"></a></td>
					<td>&nbsp;</td>
				</tr>
				</table>
				</form>
				

				<p align="left">&nbsp;</p></td>
			</tr>
			<tr>
				<td><? include "./include/footer.php"; ?></td>
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