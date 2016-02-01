<?  session_start(); 
if (session_is_registered('id'))
{
	include "./include/conn.php";
	
	//ambil ID_penyebaran dari 
	$tahun=$_GET['tahun'];
	$penyakit=$_GET['penyakit'];
	$cekid=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun' and nama_penyakit='$penyakit'",$koneksi);
	
	
	while($row=mysql_fetch_row($cekid)){
		$id_penyebaran=$row[0];
	}


	if (isset($_POST['lokasi']))
	{
		$id_lokasi=$_POST['id_penyebaran'];
		$jumlah=$_POST['jumlah'];
		$lokasi=ucwords($_POST['lokasi']);
			
		
		$periksa=mysql_db_query($db,"select * from tbllokasi where puskesmas='$lokasi' && id_lokasi='$id_lokasi'",$koneksi);
		$cek=mysql_num_rows($periksa);
		
		//periksa apakah data yang dimasukan tidak ada yang kosong??
		if (empty($jumlah) || empty($lokasi))
		{
		
			?><script> document.location.href="home.php?page=9&status=Data Anda belum lengkap!!&id_penyebaran=<? echo $id_penyebaran; ?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>"; </script><?
			
		}else{
			//periksa apakah jumlah penderita yang dimasukan berupa angka apa selain angka??
			if (is_numeric($jumlah))
			{
				//periksa tahun, apakah sudah ada di database??
				if ($cek){
				
				?><script> document.location.href="home.php?page=9&status=Maaf, Data Anda sudah ada!!&id_penyebaran=<? echo $id_penyebaran; ?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>"; </script><?
				
				}else{
					
					$simpan=mysql_db_query($db,"insert into tbllokasi(id_lokasi,puskesmas,jumlah,tanggal) values('$id_lokasi','$lokasi','$jumlah','$tanggal')",$koneksi);
					if ($simpan)
					{
						?><script> document.location.href="home.php?page=9&status=Data Anda telah disimpan. Silahkan masukan lagi. Jika tidak ada, klik NEXT&id_penyebaran=<? echo $id_penyebaran; ?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>"; </script><?
						
					}else{
						echo "gagal!!";
					}
				}
			}else{
				?><script> document.location.href="home.php?page=9&status=Data Anda bukan angka!!&id_penyebaran=<? echo $id_penyebaran; ?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>"; </script><?
			}
		}
	}else{
		unset($_POST['lokasi']);
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
			<div align="center"><? echo $_GET['status'] ?></div>
			</font><br /><br />
			<form action="home.php?page=9&id_penyebaran=<? echo $id_penyebaran;?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>" method="post">
			<table width="477" align="center">
			<tr>
				<td><font face="Arial, Helvetica, sans-serif" size="2">ID</font></td>
				<td>
				<input type="hidden" name="id_penyebaran" value="<? echo $id_penyebaran; ?>" />
				<font face="Arial, Helvetica, sans-serif" size="2" color="#666666">
				<? echo $id_penyebaran;?></font>
				</td>
			</tr>
			<tr>
				<td width="126">
				<font face="Arial, Helvetica, sans-serif" size="2">Tahun</font>				</td>
				<td width="339">
				<font face="Arial, Helvetica, sans-serif" size="2" color="#666666"><? echo $_GET['tahun']; ?></font>
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
				<td><font face="Arial, Helvetica, sans-serif" size="2">Lokasi (Puskesmas)</font></td>
				<td><input type="text" name="lokasi" /></td>
			</tr>
			<tr>
				<td><font face="Arial, Helvetica, sans-serif" size="2">Jumlah (Penderita)</font></td>
				<td><input type="text" name="jumlah" /></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit" name="simpan" value="Save" />
				<input type="button" name="next" value="Next" onclick="location.replace('home.php?page=10&id_penyebaran=<? echo $_GET['id_penyebaran'];?>&tahun=<? echo $_GET['tahun'];?>&penyakit=<? echo $_GET['penyakit'];?>');" />
				</td>
			</tr>
			<tr>
				<td colspan="2"><p>&nbsp;</p>
				  <p><font size="2" face="Arial, Helvetica, sans-serif">Catatan :
				    
				    </font></p>
				  <p><font size="2" face="Arial, Helvetica, sans-serif">
				  1. <font color="#000000">Masukan Tahun dan nama Penyakit.</font><br />
				  2. <font color="#009900">Masukan Lokasi berdasarkan nama Puskesmas dan jumlah penderitanya.</font><br />
				  3. Masukan Peta yang sudah dibuat.</font><br />
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
	<br />
	
	
	<?
	$id_lokasi=$_GET['id_penyebaran'];
	
	if (empty($id_lokasi)){
	
	}else{
	?>
   	<table width="370" border="1">
	<tr>
	  <td width="65" align="center"><strong><font size="2" face="verdana">NO</font></strong></td>
	  <td width="173" align="center"><font face="verdana" size="2"><strong>LOKASI</strong></font></td>
	  <td width="110" align="center"><font  face="verdana" size="2"><strong>PENDERITA</strong></font></td>
	</tr>
	<?
		$query=mysql_db_query($db,"select * from tbllokasi where id_lokasi='$id_lokasi' order by tanggal desc",$koneksi);
		
		while($row=mysql_fetch_array($query))
		{
			?>
			
			<tr>
			  <td align="center"><font face="verdana" size="2"><? echo $c=$c+1; ?></font></td>
			  <td align="center"><font face="verdana" size="2"><? echo $row['puskesmas']; ?></font></td>
			  <td align="center"><font  face="verdana" size="2"><? echo $row['jumlah']." Orang"; ?></font></td>
			</tr>
			
<?
		} 
	
	?></table><br />
	</p>
	
	<? } ?>
	
	
<?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>