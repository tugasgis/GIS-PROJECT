<?  session_start(); 
if (session_is_registered('id'))
{
	include "./include/conn.php";

	if (isset($_POST['map']))
	{
		$id_penyebaran=$_POST['id_penyebaran'];
		$jumlah=$_POST['jumlah'];
		
		$map="C:/ms4w/apps/endemikgis/".$_POST['map'];
		
		
		//periksa apakah data yang dimasukan tidak ada yang kosong??
		if ($map=="C:/ms4w/apps/endemikgis/")
		{
			?><script> document.location.href="home.php?page=10&status=Data Anda belum lengkap!!&&id_penyebaran=<? echo $_GET['id_penyebaran'];?>&tahun=<? echo $_GET['tahun'];?>&penyakit=<? echo $_GET['penyakit'];?>"; </script><?
			
		}else{
			
			$simpan=mysql_db_query($db,"UPDATE tblpenyebaran SET jumlah='$jumlah',map='$map' where id_penyebaran='$id_penyebaran'",$koneksi);
			if ($simpan)
			{
				?><script> document.location.href="konfirmasi.php?go=berhasil_gis"; </script><?
				
			}else{
				echo "gagal!!";
			}
			
		}
	}else{
		unset($_POST['map']);
	}
	
	?>
	<table width="43%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
	<tr> 
		<td width="3%" align="right"><img src="./img/kiri.jpg"></td>
		<td width="94%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">New GIS</font></strong></div></td>
		<td width="3%"><img src="./img/kanan.jpg"></td>
	</tr>
	<tr>
		<td background="./img/b-kiri.jpg">&nbsp; </td>
		<td>
		<table width="484" align="center">
			<tr><td width="476">
				
			<font color='#0066FF' face='verdana' size='2'><br />
			<div align="center"><? echo $_GET['status'] ?><br><br></div>
			</font>
			<form action="home.php?page=10&id_penyebaran=<? echo $_GET['id_penyebaran'];?>&tahun=<? echo $_GET['tahun'];?>&penyakit=<? echo $_GET['penyakit'];?>" method="post">
			<table width="477" align="center">
			<tr>
				<td width="126">
				<font face="Arial, Helvetica, sans-serif" size="2">ID</font>
				<input type="hidden" name="id_penyebaran" value="<? echo $_GET['id_penyebaran']; ?>" />				
				</td>
				<td width="339">
				<font face="Arial, Helvetica, sans-serif" size="2" color="#666666"><? echo $_GET['id_penyebaran']; ?></font>				
				</td>
			</tr>
			<tr>
				<td width="126">
				<font face="Arial, Helvetica, sans-serif" size="2">Tahun</font>				
				</td>
				<td width="339">
				<font face="Arial, Helvetica, sans-serif" size="2" color="#666666"><b><? echo $_GET['tahun']; ?></b></font>				
				</td>
			</tr>
			<tr>
				<td>
				<font face="Arial, Helvetica, sans-serif" size="2">Penyakit</font>				
				</td>
				<td>
				<font face="Arial, Helvetica, sans-serif" size="2" color="#666666"><? echo $_GET['penyakit'];?></font>				
				</td>
			</tr>
			<tr>
				<td>
				<font face="Arial, Helvetica, sans-serif" size="2">Jumlah</font>				
				</td>
				<td>
				<? 
				$id_lokasi=$_GET['id_penyebaran'];
				$query=mysql_db_query($db,"select sum(jumlah) from tbllokasi where id_lokasi='$id_lokasi'",$koneksi);
				
				while ($rows=mysql_fetch_row($query)){
					$jumlah=$rows[0];
				}
				?>
				<font face="Arial, Helvetica, sans-serif" size="2" color="#666666"><? echo $jumlah;?></font>				
				<input type="hidden" name="jumlah" value="<? echo $jumlah;?>" />
				</td>
			</tr>
			<tr>
				<td><font face="Arial, Helvetica, sans-serif" size="2">Peta</font></td>
				<td><input type="file" name="map" size="30" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="simpan" value="Save" /></td>
			</tr>
			<tr>
				<td colspan="2"><p>
				</p>
				  <p><font size="2" face="Arial, Helvetica, sans-serif">Catatan :
				    
				    </font></p>
				  <p><font size="2" face="Arial, Helvetica, sans-serif">
				  1. <font color="#000000">Masukan Tahun dan nama Penyakit.</font><br />
				  2. <font color="#000000">Masukan Lokasi berdasarkan nama Puskesmas dan jumlah penderitanya.</font><br />
				  3.<font color="#009900"> Masukan Peta yang sudah dibuat.</font></font><br />
				  </p>				  
				 </td>
			</tr>
			</table>
			</form>
			
					
			</td></tr>
		</table>
		</td>
		<td background="./img/b-kanan.jpg">&nbsp;</td>
		<td width="0%"></td>
	</tr>
	<tr> 
		<td align="right"><img src="./img/kib.jpg"></td>
		<td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="3"></font></strong></div></td>
		<td><img src="./img/kab.jpg"></td>
	</tr>
</table>

    <p>&nbsp;</p>
<?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>