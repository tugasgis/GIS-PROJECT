<html><br>
<table width="82%" height="176" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#99CC99">
<tr> 
	<td width="1%" height="31" align="right"><img src="./img/kiri.jpg"></td>
	<td width="98%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">BACA ARTIKEL</font></strong></div></td>
	<td width="1%"><img src="./img/kanan.jpg"></td>
</tr>
<tr>
	<td height="114">&nbsp;</td>
	<td><?
	include "./include/conn.php";
							
	if (isset($_GET['id']))
	{
		$berita=(int)$_GET['id'];
		$tampil=mysql_db_query($db,"select * from berita where id_brt='$berita'",$koneksi);
		
		while ($row=mysql_fetch_array($tampil))
		{
			$judul=$row['head']; 
			$isi=$row['isi'];
			$gambar=$row['gambar'];
			$penulis=$row['penulis'];
			$tanggal=$row['tgl'];
		}
		
		
		
		?>
		<br>
		<table>
		<tr>
			<td>
				<img src="<? echo $gambar;?>" border="0" width="100" height="100">
			</td>
			<td valign="top">
				<font face="verdana" size="2">
				<?
				echo "<b>Judul </b>".$judul."<br>"; 
				echo "<b>Tanggal </b>".$tanggal."<br>";
				echo "<b>Penulis </b>".$penulis."<br>";
				?>
				</font>
			</td>
		</tr>
		
		</table>
		
		<P>
		<? echo $isi;?>
		</P>
		
	<?
	}
	?>
	
	
	  <a href="index.php?page=2" title="Kembali"><img src="./img/back.png" border="0"></a></p>
	</td>
</tr>
<tr> 
	<td align="right"><img src="./img/kib.jpg"></td>
	<td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="3"></font></strong></div></td>
	<td><img src="./img/kab.jpg"></td>
</tr>
</table>
<br>
</html>
