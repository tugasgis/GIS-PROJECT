<? session_start(); 
if (session_is_registered('id'))
{
	include "./include/conn.php";
	$id_lokasi=$_GET['id_lokasi'];
	?>
	
		<html><title>Lokasi Puskesmas</title>
		<table width="322" align="center">
			<tr><td width="314" height="253"><p align="center"><font face="verdana" size="2"><?
			//untuk paging
			$query=mysql_db_query($db,"select * from tbllokasi where id_lokasi='$id_lokasi'",$koneksi); //input
			$get_pages=mysql_num_rows($query);
			
			if ($get_pages>$loc)  //proses
			{
				echo "Halaman : ";
				$pages=1;
				while($pages<=ceil($get_pages/$loc))
				{
					if ($pages!=1)
					{
						echo " | ";
					}
				?>
				<a href="home.php?page=12&id=<? echo ($pages-1); ?>&id_lokasi=<? echo $id_lokasi; ?>" style="text-decoration:none"><font face="verdana" size="2" color="#009900"><? echo $pages; ?>
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
			$offset=$page*$loc;
			$result=mysql_db_query($db,"select * from tbllokasi where id_lokasi='$id_lokasi' order by tanggal desc limit $offset,$loc",$koneksi); //output
			$jumlah=mysql_num_rows($query);

			
			
			
			if ($jumlah){
				?>
			  <font color='#0066FF' face='verdana' size='2'>
			  <div align="center">
			    <p><? echo $_GET['status'] ?></p>
		      </div>
			  </font>
			  
			  <table width="362" border="1" align="center">
				<tr>
					<th width="156" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">LOKASI</font></th>
					<th width="130" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PENDERITA</font></th>
					<th width="54" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EDIT</font></th>
				</tr>
				<?
				while($row=mysql_fetch_array($result))
				{
					?><tr>
					  <td align="center"><font face="verdana" size="2"><? echo $row['puskesmas']; ?></font></td>
					  <td align="center"><font  face="verdana" size="2"><? echo $row['jumlah']." Orang"; ?></font></td>
					  <td align="center">&nbsp;
						  <a href=delete.php?id=<? echo $row['id'] ?>&type=lokasi&id_lokasi=<? echo $id_lokasi;?> style='text-decoration:none'>
						<img src="./img/hapus.png" border="0" title="Hapus"></a> 
					</td>
					</tr>
			  <?
				}
				?></table>
				<div align="center">
				  <p><font size="2" face="Arial, Helvetica, sans-serif">Jumlah Lokasi : <? echo $jumlah;?> 
			        </font></p>
				  <p><a href="home.php?page=7" title="Kembali"><img src="./img/back.png" alt="Back" border="0" /></a></p>
				</div>
				<p>
					  <?
			}else{
				?>
			  </p>
				<p align="center"><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font></p>
				<p align="center"><a href="home.php?page=7" title="Kembali"><img src="./img/back.png" alt="Back" border="0" /></a></p>
				<p>
				    <?
			}
			
			?>
		      </p>
				  
				  </td></tr>
		</table>
		<p>
      <?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>
</p>
    <p>&nbsp;        </p>
