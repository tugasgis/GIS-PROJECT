<? session_start();
include "./include/conn.php";
if (session_is_registered('id'))
{
	$_SESSION['id'];
	$_SESSION['user'];
	
	?>
	<html>
	<head>
		<title>GIS-Endemik</title>
		<style type="text/css">
		<!--
.style2 {font-size: 14px}
		-->
		</style>
	</head>
	<body background="./img/background.jpg">
	<p>&nbsp;</p>
		<table border="0" align="center" bgcolor="#FFFFFF">
		<tr>
			<td width="328">
			<table width="269" height="247" border="0" align="center">
			<tr>
				<td width="263" align="center" valign="top"><? include "./include/banner.php"; ?></td>
			</tr>
			<tr>
				<td height="63" align="center"><? include "menu.php"; ?></td>
			</tr>
			<tr>
			  <td height="50" align="center">
				 
				 	<h2 class="style2">[Edit Replay]</h2>
					<p><font color='#0066FF' face='verdana' size='2'><blink><? echo $_GET['status'] ?></blink></font><br>
		        </p>
					<table width="266" border="0" align="center">
						<tr>
							<td width="191" align="left" bgcolor="#CCCCCC">
							<?
							#menampilkan topik
							$ID_topik=$_GET['id'];

							$query=mysql_db_query($db,"select * from forum where ID_topik='$ID_topik'",$koneksi); //untuk posting
							$quey=mysql_db_query($db,"select * from forum where ID_replay='$ID_topik'",$koneksi); //untuk jumlah replay
							
							$jml=mysql_num_rows($quey); //untuk jumlah replay
		
							while ($row=mysql_fetch_array($query))
							{
								$ID_topik=$row[0];
								$nama=$row[1];
								$email=$row[2];
								$topik=$row[3];
								$isi=$row[4];
								$ID_replay=$row[5];
								$tanggal=$row[6];	
							}
								//isi dari forum yang di tampilkan
								echo "<b>"."<font color='#000099' face='Arial, Helvetica, sans-serif'>";
								?>
								<? echo "Topik : ".$topik."</b>"."</font>"."<br>";?>
								<?

								?><font face="verdana"  size="-4" color="#666666"><?
								
								echo "Posted : ".$tanggal."<br>";
								?>By : <a href="mailto:<? echo $email;?>" style="text-decoration:none "><? echo $nama; ?></a><br>
								<? 
								echo "Hit : ".$jml." replay"."<br>";
								
								?></font><br><font face="verdana" size="2"><?
								
								echo $isi;
								
								session_register('isi');
								
								echo "</font>";
								
							?>
						  </td>
						</tr>
						
						<tr>
							<td align="left">
							<?
							#untuk menampilkan replay
							$query2=mysql_db_query($db,"select * from forum where ID_replay='$ID_topik' ORDER BY tanggal desc",$koneksi);
							
							while ($row2=mysql_fetch_array($query2))
							{
								$ID_topik2=$row2[0];
								$nama2=$row2[1];
								$email2=$row2[2];
								$topik2=$row2[3];
								$isi2=$row2[4];
								$ID_replay2=$row2[5];
								$tanggal2=$row2[6];	
								
								echo "<br>";
								echo "<b><font face='Arial, Helvetica, sans-serif' size='2'>Re : ".$topik2."</font></b>"."<br>";
								
								?><font face="verdana" size="-4" color="#666666"><?
								echo "Posted : ".$tanggal2;
								?> 
							<font size="4"></font>
							<a href=warning.php?id=<? echo $row2[0] ?>&type=replay&hal=edit-forum-reply.php?id=<? echo $ID_topik; ?> style='text-decoration:none'>
							<img src="./img/hapus.png" border="0" title="Hapus"></a><? 
								?></font><?
								
								echo "<font face='verdana' size='2'><br>".$isi2."</font><br>";
								echo "<hr>";
							}
							
							?>
							</td>
						</tr>
			    </table>
					 
				
				 

				 
			    <p><a href="home.php?page=5" title="Kembali"><img src="./img/back.png" border="0"></a></p></td>
			</tr>
			<tr>
				<td><? include "./include/footer.php"; ?></td>
			</tr>
			</table>
		  </td>
		</tr>
		</table>
	</body>
	</html>
	<?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>