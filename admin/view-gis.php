<? session_start(); 
if (session_is_registered('id'))
{
	include "./include/conn.php";
	
	
	?>
	
	<table width="28%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
	<tr> 
		<td width="22%" align="right"><img src="./img/kiri.jpg"></td>
		<td width="70%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">View GIS</font></strong></div></td>
		<td width="6%"><img src="./img/kanan.jpg"></td>
	</tr>
	<tr>
		<td background="./img/b-kiri.jpg">&nbsp; </td>
		<td>
		<table width="322" align="center">
			<tr><td width="314">
			
			
	
			</p>
			<p align="center"><font face="verdana" size="2"><?
			//untuk paging
			$query=mysql_db_query($db,"select * from tblpenyebaran",$koneksi); //input
			$get_pages=mysql_num_rows($query);
			
			if ($get_pages>$gis)  //proses
			{
				echo "Halaman : ";
				$pages=1;
				while($pages<=ceil($get_pages/$gis))
				{
					if ($pages!=1)
					{
						echo " | ";
					}
				?>
				<a href="home.php?page=7&id=<? echo ($pages-1); ?> " style="text-decoration:none"><font face="verdana" size="2" color="#009900"><? echo $pages; ?>
				</font></a> 
				 <?
						$pages++;
				}
			}else{
				$pages=0;
			}
			?></font></p>
			<p>
			  <?
			//akhir paging
		
		
			//proses halaman
			$page=(int)$_GET['id'];
			$offset=$page*$gis;
			
			if(isset($_POST['penyakit'])){
				?><center><font face="Arial, Helvetica, sans-serif" size="2" color="#0066FF"><b>CARI :</b> Penyakit <? echo $penyakit=$_POST['penyakit']; ?> 
				pada tahun <? echo $tahun=$_POST['tahun']; ?></font></center><?
				
				$result=mysql_db_query($db,"select * from tblpenyebaran where nama_penyakit='$penyakit' && tahun='$tahun'",$koneksi); //output
			}else{
				$result=mysql_db_query($db,"select * from tblpenyebaran order by tanggal desc limit $offset,$gis",$koneksi); //output
			}
			
			$hasil=mysql_num_rows($result);
			$jumlah=mysql_num_rows($query);
			
			
			if ($jumlah){
				?>
			  <font color='#0066FF' face='verdana' size='2'>
			  <div align="center"><? echo $_GET['status'] ?></div>
			  </font></p>
			  
			
			
			<form action="home.php?page=7" method="post">
			<table align="center">
			<tr>
			<td width="202" align="right">
				<select title="Ganti jenis penyakit" name="penyakit">
				<?
				$query=mysql_db_query($db,"select * from tblpenyakit",$koneksi);
				
				while($row=mysql_fetch_row($query))
				{
					?><option value="<? echo $row[1]; ?>"><? echo $row[1]; ?></option><?
				}
				?>
				</select>
			</td>
			<td width="1">&nbsp;</td>
			<td width="67" align="left"> 
				<select title="Ganti tahun" name="tahun">
				<?
				$query=mysql_db_query($db,"select * from tbltahun",$koneksi);
				
				while($row=mysql_fetch_row($query))
				{
					?><option value="<? echo $row[1]; ?>"><? echo $row[1]; ?></option><?
				}
				?>
				</select>
			</td>
			<td width="170"><input type="submit"  name="cari" value="CARI" /></td>
			</tr>
			</table>
			</form>
			
			
			
			
			
			
			
			<?
			if (empty($hasil)){
				?><p align="center"><font color="#FF0000" face="verdana" size="2"><b>Tidak ada data!!</b></font></p><?
			}else{
			?>
			  
					<table width="645" border="0" align="center">
					<tr>
						<th width="55" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">ID</font></th>
						<th width="54" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">TAHUN</font></th>
						<th width="87" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PENYAKIT</font></th>
						<th width="78" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">LOKASI</font></th>
						<th width="98" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">JUMLAH</font></th>
						<th width="174" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PETA</font></th>
						<th width="69" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EDIT</font></th>
					</tr>
					<?
					while($row=mysql_fetch_array($result))
					{
						?><tr>
						  <td align="center"><font face="verdana" size="2"><? echo $row[0]; ?></font></td>
						  <td align="center"><font  face="verdana" size="2"><? echo $row['tahun']; ?></font></td>
						  <td align="center"><font face="verdana" size="2"><? echo $row['nama_penyakit']; ?></font></td>
						  <td align="center">
						  
						   <a href="home.php?page=12&id_lokasi=<? echo $row[0];?>" style="text-decoration:none" 
						  title="Klik untuk edit"><font face="verdana" size="2" color="#0033FF">Puskesmas</font></a>					  
						  
						  </td>
						  <td align="center"><font face="verdana" size="2"><? echo $row['jumlah']; ?> Orang</td>
						  <td><font  face="verdana" size="2"><? echo $row['map']; ?></font></td>
						  <td align="center">
							 <a href=update-gis.php?id=<? echo $row[0]; ?> style='text-decoration:none' title="update terakhir : <? echo $row['tanggal']; ?>">
							 <img src="./img/update.png" border="0"></a> &nbsp;
							 <a href=warning.php?id=<? echo $row[0]; ?>&type=gis&hal=home.php?page=7 style='text-decoration:none' title="hapus"> 
							 <img src="./img/hapus.png" border="0"></a>					  </td>
						</tr>
						<tr><td colspan="7"><hr></td></tr>
				  	<?
					}
					?></table>
					<?
				}
			}else{
				?><p align="center"><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font></p><?
			}
			
			?>
			
			
			
			
			
					
			</td></tr>
		</table>
		</td>
		<td background="./img/b-kanan.jpg">&nbsp;</td>
		<td width="2%"></td>
	</tr>
	<tr> 
		<td align="right"><img src="./img/kib.jpg"></td>
		<td bgcolor="#5686c6" ><div align="center"><strong><font color="#FFFFFF"><font face="verdana" size="3"><font face="verdana" size="2">Jumlah Data GIS : <b><? echo $jumlah; ?></b></font></font></div></td>
		<td><img src="./img/kab.jpg"></td>
	</tr>
	</table>
		
    <p>
      <?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>
</p>
    <p>&nbsp;        </p>
