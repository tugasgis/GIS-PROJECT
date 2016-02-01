<?
include "./include/conn.php";
$id_lokasi=$_GET['id_lokasi'];
$tahun=$_GET['tahun'];
$penyakit=$_GET['penyakit'];


?>


<html><title>Lokasi Puskesmas</title>
<table width="100%" cellspacing="2" cellpadding="2" >
<tr>
<td bgcolor="#9ABC67" colspan="2"><div align="center">
	<font color="#FFFFFF" face="Geneva, Arial, Helvetica, sans-serif"><strong><blink><? echo $penyakit;?> - <? echo $tahun; ?></blink></strong></font></div>
</td>	
<tr>
	<td valign="top">
	
	
	
	<font face="verdana" size="2">
	<div align="center">
	  <?
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
	  <a href="tabel-view-lokasi.php?id=<? echo ($pages-1); ?>&id_lokasi=<? echo $id_lokasi; ?>&tahun=<? echo $tahun;?>&penyakit=<? echo $penyakit;?>" style="text-decoration:none">
	  <font face="verdana" size="2" color="#009900"><? echo $pages; ?>				</font></a> 
	  <?
					$pages++;
			}
		}else{
			$pages=0;
		}
		?>
		 <?
		//akhir paging
	
	
		//proses halaman
		$page=(int)$_GET['id'];
		$offset=$page*$loc;
		$result=mysql_db_query($db,"select * from tbllokasi where id_lokasi='$id_lokasi' order by tanggal desc limit $offset,$loc",$koneksi); //output
		$jumlah=mysql_num_rows($query);

		
		
		
		if ($jumlah){
			?>
		 <font color='#0066FF' face='verdana' size='2'>&nbsp;</font><br>
	  <br>
	  </div>
<table width="377" border="1" align="left">
			<tr>
				<th width="44" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">NO</font></th>
				<th width="192" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">LOKASI</font></th>
				<th width="119" bgcolor="#333333"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">PENDERITA</font></th>
			</tr>
			<?
			while($row=mysql_fetch_array($result))
			{
				?><tr>
				  <td align="center"><font face="verdana" size="2"><? echo $c=$c+1; ?></font></td>
				  <td align="left"><font face="verdana" size="2">&nbsp;<? echo $row['puskesmas']; ?></font></td>
				  <td align="right"><font  face="verdana" size="2"><? echo $row['jumlah']." Orang"; ?>&nbsp;</font></td>
				</tr>
		  <?
			}
			?>
			<tr>
				<td>&nbsp;</td>
				<td align="center"><b><font face="Arial, Helvetica, sans-serif" size="2">TOTAL</font></b></td>
				<td align="right">
				
				<?
				$quey=mysql_db_query($db,"select sum(jumlah) from tbllokasi where id_lokasi='$id_lokasi'",$koneksi); //input
				
				while ($row=mysql_fetch_row($quey)){
					?><font face="Arial, Helvetica, sans-serif" size="2"><b><? echo $row[0]; ?> Orang&nbsp;</b></font><?
				}
				?>
				</td>
			</tr>
			<tr><td colspan="3" align="left" bgcolor="#333333"><div align="center"><font face="Arial, Helvetica, sans-serif" size="2" color="#FFFFFF"><strong>Jumlah Lokasi : <? echo $jumlah; ?></strong></font></div></td>
			</tr>
	  </table>
				
			
			<?
		}else{
			?>
		  </p>
			<p align="center"><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font></p>
		<p align="center"><a href="home.php?page=7" title="Kembali"></a></p>
			<p>
				<?
		}
		?>
		  </p>
			  
  </td></tr>
</table>
	



	<div align="center">
      <p>
        <script language="javascript">
<!--
function tutup()
{
	top.window.close()
}
//-->
  </script>
        <input name="button" type="button" onClick="tutup()" value="Keluar">
      </p>
</div>
