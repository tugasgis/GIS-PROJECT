<?
include "./include/conn.php";
$type=$_GET['type'];


switch($type)
{
case "p";
	//tampilkan data berdasarkan penyakit
	$penyakit=$_GET['penyakit'];
	
	
	$tampil=mysql_db_query($db,"select * from tblpenyebaran where nama_penyakit='$penyakit' order by tahun desc ",$koneksi);
	$tampil2=mysql_db_query($db,"select * from tblpenyebaran where nama_penyakit='$penyakit' order by tahun desc ",$koneksi);
	
	$jumlah=mysql_num_rows($tampil);
	if ($jumlah){
		?><font face="verdana" size="2" color="#0033FF">
		<b>Query : </b> Menampilkan data penyakit <i><font color="#009900"><b><? echo $penyakit ?></b></font></i>
		pada semua tahun.
		</font>
		<p align="center">
		<table width="343" border="0" align="center" cellpadding="0" cellspacing="0">
		<?
		//mencari total jumlah penderita
		while($row2=mysql_fetch_array($tampil2))
		{
			$nilai=$row2[3];
			$tambah=$nilai+$tambah;
		}
			$total=$tambah;
		
		
		while($row=mysql_fetch_array($tampil))
		{
		
			$persen=round(((int)$row[3]/(int)$total)*100,2);
			$lebar=$persen*2;
			
			
			?>
		<tr ><?
			?><td width="62" align="center"><font face="verdana" size="2"><? echo $row['tahun']; ?></font></td>
		<?
			?><td width="272" align="left"><a href="#" title="<? echo $row[3]; ?> Orang">
			<img src="./img/diagram.jpg" width="<? echo $lebar; ?>" height="12"/ border="0"></a><font face="verdana" size="2">&nbsp;
			<a href="#" title="<? echo $row[3]; ?> Orang" style="text-decoration:none"><font color="#00CC33"><? echo $persen; ?> %</font></a>
			</td>
		<?
			?></tr>
			<?
		}
		?>
</table>
	<font face="verdana" size="2" color="#666666"><br />Total Penderita : <? echo $total; ?></font>
		</p>
		<?
	}else{
		?>
		<font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font>
		<?
	}
	break;
}

case "t";
	//tampilkan data berdasarkan tahun
	$tahun=$_GET['tahun'];
	
?>
$tampil=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun' order by nama_penyakit asc",$koneksi);
	$tampil2=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun' order by nama_penyakit desc ",$koneksi);
	
	$jumlah=mysql_num_rows($tampil);
	if ($jumlah){
		?><font face="verdana" size="2" color="#0033FF">
		<b>Query : </b> Menampilkan data semua penyakit pada tahun <i><font color="#009900"><b><? echo $tahun; ?>.</b></font></i>
		</font>
		<p align="center">
		<table width="340" border="0" align="center" cellpadding="0" cellspacing="0">
		<?
		
		//mencari total jumlah penderita
		while($row2=mysql_fetch_row($tampil2))
		{
			$nilai=$row2[3];
			$tambah=$nilai+$tambah;
		}
			$total=$tambah;
		
		
		while($row=mysql_fetch_row($tampil))
		{
		
			$persen=round(((int)$row[3]/(int)$total)*100,2);
			$lebar=$persen*2;
			?>
		<tr ><?
			?><td width="99" align="left"><font face="verdana" size="2"><? echo $row[1]; ?></font></td>
		<?
			?><td width="293" align="left"><a href="#" title="<? echo $row[3]; ?> Orang">
			<img src="./img/diagram.jpg" width="<? echo $lebar; ?>" height="12"/ border="0"></a><font face="verdana" size="2">&nbsp;
			<a href="#" title="<? echo $row[3]; ?> Orang" style="text-decoration:none"><font color="#00CC33"><? echo $persen; ?> %</font></a>
			</td>
		<?
			?></tr>
			<?
		}
		?>
</table>
<font face="verdana" size="2" color="#666666"><br />Total Penderita : <? echo $total; ?></font>
		</p>
		<?
	}else{
		?>
		<font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font>
		<?
	}
	break;



default;
		
	?><p align="center"><font face="verdana" size="2" color="#666666"><b>Catatan : </b>Silahkan pilih nama Penyakit atau Tahun yang akan ditampilkan dalam diagram balok<br /></font></p>
	<p align="center">&nbsp;</p>
	<?
		
	break;
}

?>
