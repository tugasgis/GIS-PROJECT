<? session_start();
ini_set('display_errors',FALSE);

if (session_is_registered('map'))
{
	$map=$_SESSION["map"];
	$judul=$_SESSION["tahun"];
	
	include("./include/mapscript.php");
	?>
	
	<html>
	<body><head><title>GIS-Endemik</title></head>
	<link rel="shortcut icon" href="./img/home.gif" type="image/x-icon">
	
	<table width="59%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="left">
	<tr>
		<td align="center" colspan="3"><a href="index.php?page=5" title="Kembali"><img src="./img/backclr.gif" border="0"></a></td>
	</tr>
	<tr> 
		<td width="1%" align="right"><img src="./img/kiri.jpg"></td>
	  <td width="92%" bgcolor="#5686c6" ><div align="center"><font face="verdana" size="2" color="#FFFFFF"><b>Peta Penyebaran Penyakit Tahun <? echo $judul; ?></b></font></div></td>
		<td width="1%"><img src="./img/kanan.jpg"></td>
	</tr>
	<tr>
		<td background="./img/b-kiri.jpg">&nbsp;</td>
		<td>
			<script languange="Javascript1.2"><!--
			function piltahun(pilih){
				
			location.replace("peta-proses.php?tahun="+pilih);
			}
			--></script>

			<table width="692">
			<tr>
				<td width="740" height="54"><br>
					<table width="637" align="left">
					<tr>
						<td width="189" valign="middle" align="center">
						<font size="4" face="Arial, Helvetica, sans-serif">Tahun</font>						<select title="Ganti tahun" onChange="piltahun(this.value)">
						<option value="Pilih Tahun" selected="selected">Pilih Tahun</option>
						<?
						include "./include/conn.php";
						$query=mysql_db_query($db,"select * from tbltahun",$koneksi);
						
						while($row=mysql_fetch_row($query))
						{
							?><option value="<? echo $row[1]; ?>"><? echo $row[1]; ?></option><?
						}
						?>
						</select>	 
				  	  </td>
						
					  	<td width="436"><div align="right">
&nbsp;						</td>
					</tr>
				  </table>
	
				
			  </td>
			</tr>
			<tr>
				<td><form name="main" method="GET"><br>
				 
				<table width="674" border="0" align="center" bordercolor="#0033FF">
				
				
				<tr>
					<!--tampilan legenda-->
<td width="204" rowspan="2" valign="top" align="left"><table width="92%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99">
						<tr> 
							<td width="3%" align="right"><img src="./img/kiri.jpg"></td>
							<td width="93%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">LEGENDA</font></strong></div>							</td>
							<td width="3%"><img src="./img/kanan.jpg"></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>
							<table width="168" align="center">
								<tr><td width="160"><font face="verdana" size="2">&nbsp;
								</font>
									
								<?php DrawLegend(); ?><br>
								
								</td></tr>
							</table>						</td>
							<td>&nbsp;</td>
						</tr>
						<tr> 
							<td align="right"><img src="./img/kib.jpg"></td>
							<td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="3"></font></strong></div></td>
							<td><img src="./img/kab.jpg"></td>
						</tr>
					  </table>			
						
						<br>
						<!--////////////////////////////////////////////////////////////////////////////////////////-->
						
					  <table width="96%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99">
						<tr> 
							<td width="3%" align="right"><img src="./img/kiri.jpg"></td>
							<td width="94%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">NAVIGASI</font></strong>
						  </div></td>
							<td width="3%"><img src="./img/kanan.jpg"></td>
						</tr>
						<tr>
							<td ></td>
							<td>
							<table width="165" align="center">
								<tr><td width="157"><font face="verdana" size="2">
								</font>
									
								<? include "./include/zoom.php"; ?>
								
								</td></tr>
							</table></td>
							<td></td>
							<td width="0%"></td>
						</tr>
						<tr> 
							<td align="right"><img src="./img/kib.jpg"></td>
							<td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="3"></font></strong></div></td>
							<td><img src="./img/kab.jpg"></td>
						</tr>
				    </table>		
						<p align="center"><br>
				        <img src="./images/navigasi.jpg" title="Arah mata angin"></p>				 
					</td>
					
					<!-- tampilan peta -->
					<td width="460" height="324" align="center">
					<table border="1" bordercolor="#009933">
					<tr>
					<td><?php DrawMap(); ?></td>
					</tr>
				  </table>				  </td>
				</tr>
				
				<tr>
					<!-- skala grafis -->
					<td align="center"><?php DrawScaleBar(); ?>
					  <p>&nbsp;</p></td>
				</tr>
				</table>
				</form>  
				
				
				  
				
			  </td>
			</tr>
		  </table>
		
		</td>
		<td background="./img/b-kanan.jpg">&nbsp;</td>
		<td width="6%"></td>
	</tr>
	<tr> 
		<td align="right"><img src="./img/kib.jpg"></td>
		<td bgcolor="#5686c6" ><div align="center"><marquee behavior="scroll" direction="left" scrollamount="4">
		  <font color="#CCCCCC" size="2" face="Arial, Helvetica, sans-serif">Copyright &copy; Agus Sumarna Jur.Teknik Informatika 2006 - WebGIS using Mapserver </font>
		</marquee></div></td>
		<td><img src="./img/kab.jpg"></td>
	</tr>
	<tr>
		<td align="right" colspan="3">&nbsp;</td>
	</tr>
	</table>
	
	
	<br><br>
				
	<table width="220" align="center">
		<tr>
		  <td width="212" align="left">&nbsp;
			  <? 	DrawPointQueryResults(); ?>
			  <br>
		  </td>
		</tr>
	</table>
	</body>
	</html>
<?
}else{
	echo "<script> document.location.href='index.php'; </script>";
}
?>

