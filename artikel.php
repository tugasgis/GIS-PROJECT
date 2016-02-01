<html>
<br>
<table width="15%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99">
<tr> 
	<td width="22%" align="right"><img src="./img/kiri.jpg"></td>
	<td width="70%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">ARTIKEL</font></strong></div></td>
	<td width="6%"><img src="./img/kanan.jpg"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
	<table align="center" width="450" border="0">
		<?
		include "./include/conn.php";
		
		?><p align="center"><font face="verdana" size="2"><?
		//untuk paging
		$query=mysql_db_query($db,"select * from berita",$koneksi); //input
		$get_pages=mysql_num_rows($query);
		
		if ($get_pages>$entries)  //proses
		{
			echo "Halaman : ";
			$pages=1;
			while($pages<=ceil($get_pages/$entries))
			{
				if ($pages!=1)
				{
					echo " | ";
				}
			?>
			<a href="index.php?page=2&id=<? echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><? echo $pages; ?></font></a> 
			 <?
					$pages++;
			}
		}else{
			$pages=0;
		}
		?></font></p><?
		//akhir paging
		
		
		$page=(int)$_GET['id'];
		$offset=$page*$entries;
		$result=mysql_db_query($db,"select * from berita order by tgl desc limit $offset,$entries",$koneksi); //output
		
		
		$sum=mysql_db_query($db,"select * from berita",$koneksi); //untuk semua data
		$jumlah=mysql_num_rows($query); //jumlah data yang 
		
		if ($jumlah){
			while ($row=mysql_fetch_array($result))
			{
			?>
				<tr>
					<td width="62" align="left" colspan="2"><font face="verdana" size="1" color="#666666"><? echo $row['tgl']; ?><br>
					Penulis : <? echo $row['penulis']; ?></font>
					</td>
				</tr>
				<tr>
					<td ><img src="./img/artikel.png"></td>
					<td width="378">
						<font face="verdana" size="2" color="#000000"><b><? echo $row['head']; ?></b><br><br>
						</font>
						
						<font size="2" color="#000000">
						<? $isi=$row['isi']; 
							echo $baca=substr($isi,0,250);
						?>
						</font>
						<a href="index.php?page=8&id=<? echo $row['id_brt']; ?>&judul=<? echo $row['head'];?>" style="text-decoration:none " title="Klik">
						<font face="verdana" size="1" color="#00CC00">[selengkapnya...]
						</font></a>
					</td>
				</tr>
				<tr><td colspan="3"><hr></td></tr>
			<?
			}
		}else{
			?>
			<p align="center"><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font></p>
			<?
		} 
	?>
	</table>
	</td>
	<td>&nbsp;</td>
	<td width="2%"></td>
</tr>
<tr align="center"><td colspan="3">


</td></tr>
<tr> 
	<td align="right"><img src="./img/kib.jpg"></td>
	<td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="1" color="#333333">Jumlah Artikel : <? echo $jumlah; ?></font></div></td>
	<td><img src="./img/kab.jpg"></td>
</tr>
</table>
<p>&nbsp;</p>
</html>



