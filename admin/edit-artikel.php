<? session_start(); 
	include "./include/conn.php";
if (session_is_registered('id'))
{
?>

	<html> 
	<head> 
	<title>Edit Artikel</title>
	<table width="49%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
	<tr> 
		<td width="2%" align="right"><img src="./img/kiri.jpg"></td>
		<td width="96%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">Edit Artikel</font></strong></div></td>
		<td width="2%"><img src="./img/kanan.jpg"></td>
	</tr>
	
	<tr>   
		<td background="./img/b-kiri.jpg"></td>
		<td>  
			<table width="376" align="center"> 
				 <tr><td width="368">     
				
				 
				
				
				   <div align="center">
				     <p><a href="home.php?page=13" style="text-decoration:none" title="Buat artikel baru"><img src="./img/new-artikel.png" / border="0"></a></p>
				    <p><font color='#0066FF' face='verdana' size='2'>
		      <div align="center"><blink><? echo $_GET['status'] ?></blink></div>
			    </font></p>
				   </div>
				   <div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">
			    <?
				//untuk paging
				$query=mysql_db_query($db,"select * from berita order by tgl desc",$koneksi); //input
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
							<a href="home.php?page=6&id=<? echo ($pages-1); ?> " style="text-decoration:none"><font color="#0066FF"><? echo $pages; ?></font></a> 
						 <?
							$pages++;
					}
				}else{
					$pages=0;
				}
				?>
						 </font>
					 </p>
						 
						 <?
				//akhir paging
				
				
				//proses halaman
				$page=(int)$_GET['id'];
				$offset=$page*$entries;
				$result=mysql_db_query($db,"select * from berita order by tgl desc limit $offset,$entries",$koneksi); //output
				$jumlah=mysql_num_rows($query);
					
				
				if ($jumlah){
					?>
				   </div>
					   <table align="center" width="362" border="0">
					<tr>
						 <td width="41%" bgcolor="#333333"><div align="center"><b><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">ARTIKEL</font></b>
						   </div>
						 <td width="37%" bgcolor="#333333"><div align="left">
					     <div align="center"><b><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">GAMBAR</font></b> </div></td>
						 <td width="22%" bgcolor="#333333"><div align="center"><b><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EDIT</font></b>
						 </div>
					  </td>
					</tr>
					<?
					
					while ($row=mysql_fetch_array($result))
					{
					?>
					<tr>
						<td align="left">
							<font face="verdana" size="1" color="#999999">By : <? echo $row[2]; ?></font><br>
							<font face="verdana" size="2" color="#0033FF"><? echo $row['head']; ?></font>		
						</td>
						
						<td align="left">
							<font face="verdana" size="-4" color="#666666">
							<? 
							$gambarku=substr($row['gambar'],15,40);
							
							
							echo $gambarku; 
							
							?></font><br>	
						</td>
						
						<td align="center">
							<a href=home.php?page=14&id=<? echo $row[0]; ?> style='text-decoration:none' title="Update terakhir : <? echo $row[1];?>">
							<img src="./img/update.png" border="0"></a>&nbsp;
							<a href=delete.php?id=<? echo $row[0]; ?>&gambar=<? echo $gambarku; ?>&type=catatan&hal=home.php?page=6 style='text-decoration:none' title="hapus">
							<img src="./img/hapus.png" border="0"></a>
							
							<script type="text/javascript">
							<!--
							function konfirmasi(){
								var answer = confirm ("Are you having fun?")
								if (answer)
								alert ("Woo Hoo! So am I.")
								else
								alert ("Darn. Well, keep trying then.")
							}
							</script> 
							
						</td>
					</tr>
					
					<tr>
						<td colspan="3"><hr></td>
					</tr>
					<?
					} 
					?> 
				   </table>
					<?
				
				}else{
					echo "<font color='#FF0000' face='verdana' size='2'><b>Belum ada data!!</b></font>";
				}
				?>
				 
				 
				 
				 
				 
				 
						
				</td></tr> 
			</table>
		</td>
		<td background="./img/b-kanan.jpg"></td>
	</tr>
	<tr> 
		<td align="right"><img src="./img/kib.jpg"></td>
		<td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">Jumlah Artikel : <b><? echo $jumlah; ?></font></strong></div></td>
		<td><img src="./img/kab.jpg"></td>
	</tr>
	</table>


    <p>&nbsp;</p>
    <?	
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>