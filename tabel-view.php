<?
include "./include/conn.php";
$type=$_GET['type'];

switch($type)
{
case "p";
	//tampilkan data berdasarkan penyakit	
	$penyakit=$_GET['penyakit'];
	$tampil=mysql_db_query($db,"select * from tblpenyebaran where nama_penyakit='$penyakit' order by tahun desc ",$koneksi);
	$jumlah=mysql_num_rows($tampil);
	if ($jumlah){
		?><font face="verdana" size="2" color="#0033FF">
		<b>Query : </b> Menampilkan data penyakit <i><font color="#009900"><b><? echo $penyakit;?></b></font></i>
		pada semua tahun.
		</font>
		<p>
		<table width="500" height="56" border="0" align="center">
		<tr>
			<th width="78" bgcolor="#333333"><font color="#FFFFFF" face="verdana" size="2">Tahun</font></th>
			<th width="190" bgcolor="#333333"><font color="#FFFFFF" size="2" face="verdana">LOKASI</font></th>
			<th width="150" bgcolor="#333333"><font color="#FFFFFF" face="verdana" size="2">Jumlah</font></th>
			<th width="64" bgcolor="#333333"><font color="#FFFFFF" face="verdana" size="2">Map</font></th>
		</tr>
		<tr>
		<?
		while($row=mysql_fetch_array($tampil))
		{
			?><tr><?
			?><td align="center" valign="top"><font face="verdana" size="2"><? echo $row['tahun'] ?></td><?
			?>
		<td valign="top" align="center">
			
			<a href="#" onClick="window.open('tabel-view-lokasi.php?id_lokasi=<? echo $row[0];?>&tahun=<? echo $row['tahun'];?>&penyakit=<? echo $row['nama_penyakit'];?>','scrollwindow','top=200,left=400,width=420,height=450');" style="text-decoration:none" title="Lihat lokasi penyebaran">
		<font face="verdana" size="2" color="#009933">Klik Puskesmas</font></a>
			
			</td>
		<?
			?><td align="center" valign="top"><font face="verdana" size="2"><? echo $row['jumlah']." orang"; ?></font></td><?
			?><td align="center" valign="top"><a href="session.php?map=<? echo $row['map']; ?>&tahun=<? echo $row['tahun']; ?>" style="text-decoration:none" >
			<font face="verdana" size="2" color="#0033FF">Klik</font></a></td><?
			?></tr>
			<tr><td colspan="5"><hr></td></tr>
			<?
		}
		?>
		</tr>
</table>
		</p>
		<p><font color="#000000" face="verdana" size="2">Jumlah Data GIS : <b><? echo $jumlah; ?></b></font>
		<?
	}else{
		?>
		<font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font>
		<?
	}
	
	break;
	
	
	
case "t";
	//tampilkan data berdasarkan tahun
	$tahun=$_GET['tahun'];
	
	?><p align="center"><font face="verdana" size="2"><?
	//untuk paging
	$query=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun' order by nama_penyakit asc",$koneksi); //input
	$get_pages=mysql_num_rows($query);
	
	if ($get_pages>$gistahun)  //proses
	{
		echo "Halaman : ";
		$pages=1;
		while($pages<=ceil($get_pages/$gistahun))
		{
			if ($pages!=1)
			{
				echo " | ";
			}
		?>
		<a href="index.php?page=5&id=<? echo ($pages-1); ?>&tahun=<? echo $tahun; ?>&type=t" style="text-decoration:none"><font size="2" face="verdana" color="#009900"><? echo $pages; ?></font>
		</a> 
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
	$offset=$page*$gistahun;
	$result=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun' order by nama_penyakit asc limit $offset,$gistahun",$koneksi); //output
	$cek=mysql_num_rows($query);
	
	if ($cek){
		?><font face="verdana" size="2" color="#0033FF">
		<b>Query : </b> Menampilkan data semua penyakit pada tahun <i><font color="#009900"><b><? echo $tahun; ?></b></font></i>
		</font>
		<p>
		<table width="500" height="56" border="0" align="center">
		<tr>
			<th width="123" bgcolor="#333333"><font color="#FFFFFF" face="verdana" size="2">Nama Penyakit</font></th>
			<th width="137" bgcolor="#333333"><font color="#FFFFFF" size="2" face="verdana">LOKASI</font></th>
			<th width="141" bgcolor="#333333"><font color="#FFFFFF" face="verdana" size="2">Jumlah</font></th>
			<th width="81" bgcolor="#333333"><font color="#FFFFFF" face="verdana" size="2">Map</font></th>
		</tr>
		<tr>
		<?
		while($row=mysql_fetch_array($result))
		{
			?><tr><?
			?><td valign="top"><font face="verdana" size="2"><? echo $row[1]; ?></font></td><?
			?>
		  <td><div align="center"><a href="#" onclick="window.open('tabel-view-lokasi.php?id_lokasi=<? echo $row[0];?>&amp;tahun=<? echo $row['tahun'];?>&amp;penyakit=<? echo $row['nama_penyakit'];?>','scrollwindow','top=200,left=400,width=420,height=450');" style="text-decoration:none" title="Lihat lokasi penyebaran"><font face="verdana" size="2" color="#009933">Klik Puskesmas</font></a></div></td>
		  <?
			?><td align="center" valign="top"><font face="verdana" size="2"><? echo $row['jumlah']." orang"; ?></font></td><?
			?><td align="center" valign="top">
			<a href="session.php?map=<? echo $row['map']; ?>&tahun=<? echo $row['tahun']; ?>" style="text-decoration:none" title="Menuju ke Peta">
			<font face="verdana" size="2" color="#0033FF">Klik</font></a></td><?
			?></tr>
			<tr><td colspan="5"><hr></td></tr>
			<?
		}
		?>
		</tr>
</table>
		<p><font color="#000000" face="verdana" size="2">Jumlah Data GIS : <b><? echo $cek; ?></b></font>
		</p>
		<?
	}else{
		?>
		<font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font>
		<?
	}
	
	break;




default;
	?><p align="center"><font face="verdana" size="2" color="#666666"><b>Catatan : </b>Silahkan pilih nama Penyakit atau Tahun yang akan ditampilkan dalam Tabel<br /></font></p>
	<p align="center">&nbsp;</p>
	<?
		
	break;
}

?>