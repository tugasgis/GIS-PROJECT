<html><br>
<table width="51%" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
<script languange="Javascript1.2"><!--
function pilpenyakit(pilih){
	
    location.replace("index.php?page=6&type=p&penyakit="+pilih);
    }
--></script>

<script languange="Javascript1.2"><!--
function piltahun(pilih){
	
    location.replace("index.php?page=6&type=t&tahun="+pilih);
    }
--></script>

<tr> 
	<td width="2%" align="right"><img src="./img/kiri.jpg"></td>
	<td width="95%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">DIAGRAM PENYEBARAN PENYAKIT</font></strong></div></td>
	<td width="3%"><img src="./img/kanan.jpg"></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td>
	<table width="520" align="center">
		<tr><td width="512"><font face="verdana" size="2">&nbsp;
		</font>
		    
		
		
		<table width="459" align="center">
		<tr>
			<td width="228" align="right">
				<select title="Ganti jenis penyakit" onChange="pilpenyakit(this.value)">
				<option value="Pilih Penyakit" selected="selected">Pilih Penyakit</option>
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
			<td width="214" align="left"> 
				<select title="Ganti tahun" onChange="piltahun(this.value)">
				<option value="Pilih Tahun" selected="selected">Pilih Tahun</option>
				<?
				$query=mysql_db_query($db,"select * from tbltahun",$koneksi);
				
				while($row=mysql_fetch_row($query))
				{
					?><option value="<? echo $row[1]; ?>"><? echo $row[1]; ?></option><?
				}
				?>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="5"><p>&nbsp;</p>
			  <p>&nbsp;</p></td>
		</tr>
		<tr>
			<td colspan="5" align="center">

			<? include "diagram-view.php"; ?>
		
			</td>
		</tr>
		</table>
		
		
		
		</td>
		</tr>
	</table>
</tr>
<tr> 
	<td align="right"><img src="./img/kib.jpg"></td>
	<td bgcolor="#5686c6" ><div align="left"><strong><font face="verdana" size="3"></font></strong><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif"><em>Sumber Data : Dinas Kesehatan Kota Depok </em></font></div></td>
	<td><img src="./img/kab.jpg"></td>
</tr>
</table>
<p>&nbsp;</p>
</html>
