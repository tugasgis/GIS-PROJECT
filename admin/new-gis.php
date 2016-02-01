<?  session_start(); 
if (session_is_registered('id'))
{
include "./include/conn.php";

	if (isset($_POST['tambah']))
	{
		$tahun=$_POST['tahun'];
		$penyakit=$_POST['penyakit'];
		$tanggal;
			
		
		$periksa=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun' && nama_penyakit='$penyakit'",$koneksi);
		$cek=mysql_num_rows($periksa);
		
		
		if ($cek){
		
		?><script> document.location.href="home.php?page=8&status=Maaf, Data Anda sudah ada!!&id_penyebaran=<? echo $id_penyebaran; ?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>"; </script><?
		
		}else{
			
			$simpan=mysql_db_query($db,"insert into tblpenyebaran(nama_penyakit,tahun,tanggal) 
			values('$penyakit','$tahun','$tanggal')",$koneksi);
			if ($simpan)
			{
				?><script> document.location.href='home.php?page=9&tahun=<? echo $tahun; ?>&penyakit=<? echo $penyakit;?>'; </script><?
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
			<div align="center">
			  <p><? echo $_GET['status'] ?></p>
			</div>
			</font>
			<form action="new-gis.php" method="post">
			<table width="477" align="center">
			<tr>
				<td height="32"></td>
				<td><font face="verdana" size="2">Tanggal</font></td>
				<td><font face="verdana" size="2" color="#666666"><? echo $tanggal; ?></font></td>
			</tr>
			<tr>
				<td width="43">&nbsp;</td>
				<td width="70"><div align="left"><font face="verdana" size="2">Tahun</font></div></td>
				<td width="348">
					<select name="tahun">
					<?
					$query=mysql_db_query($db,"select * from tbltahun order by nama_tahun asc",$koneksi);
					
					while($row=mysql_fetch_row($query))
					{
						?><option value="<? echo $row[1]; ?>"><? echo $row[1]; ?></option><?
					}
					?>
					</select>
					<a href="dtahun.php" class="style1" style="text-decoration:none"><font color="#666666" face="verdana" size="1">[Tambah Tahun Baru]</font>
					</a>				
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td height="43"><div align="left"><font face="verdana" size="2">Penyakit</font></div></td>
				<td>
					<select name="penyakit">
					<?
					$query=mysql_db_query($db,"select * from tblpenyakit order by nama_penyakit asc",$koneksi);
					
					while($row=mysql_fetch_row($query))
					{
						?><option value="<? echo $row[1]; ?>"><? echo $row[1]; ?></option><?
					}
					?>
					</select>
					<a href="dtahun.php"></a> <a href="dpenyakit.php" class="style1" style="text-decoration:none">
					<font color="#666666" face="verdana" size="1">[Tambah Penyakit Baru]</font></a></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td><input type="submit"  name="tambah" value="Next" /></td>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td colspan="3"><p>&nbsp;</p>
				  <p><font size="2" face="Arial, Helvetica, sans-serif">Catatan :
				    
				    </font></p>
				  <p><font size="2" face="Arial, Helvetica, sans-serif">
				  1. <font color="#009900">Masukan Tahun dan nama Penyakit.</font><br />
				  2. Masukan Lokasi berdasarkan nama Puskesmas dan jumlah penderitanya.<br />
				  3. Masukan Peta yang sudah dibuat.</font><br />
				  </p>				  </td>
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