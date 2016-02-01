<html><br>
<table width="529" border="0" cellpadding="0" cellspacing="0" bordercolor="#99CC99" align="center">
  <tr>
    <td width="5%" align="right"><img src="./img/kiri.jpg"></td>
    <td width="81%" bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="2" color="#FFFFFF">FORUM</font></strong></div></td>
    <td width="14%"><img src="./img/kanan.jpg"></td>
  </tr>
  <tr>
    <td><div align="center"></div></td>
    <td><table width="503" align="center">
      <tr>
        <td width="495"><?	
		include "include/conn.php";
		
		
		?>
              <p align="center"><font face="verdana" size="2">
                <?
		//untuk paging
		$query=mysql_db_query($db,"select * from forum where ID_replay=0 order by tanggal desc",$koneksi); //input
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
                <a href="index.php?page=4&id=<? echo ($pages-1); ?> " style="text-decoration:none"><font size="2" face="verdana" color="#009900"><? echo $pages; ?></font></a>
                <?
					$pages++;
			}
		}else{
			$pages=0;
		}
		?>
              </font></p>
          <?
		//akhir paging
	
	
		//proses halaman
		$page=(int)$_GET['id'];
		$offset=$page*$entries;
		$result=mysql_db_query($db,"select * from forum where ID_replay=0 order by tanggal desc limit $offset,$entries",$koneksi); //output
		$jumlah=mysql_num_rows($query);
		
		
		if ($jumlah){
			?>
              <p align="center"><font color='#0066FF' face='verdana' size='2'><blink><? echo $_GET['status'] ?></blink></font></p>
			  <p align="center"><font color="#FF0000" face='verdana' size='2'><blink><? echo $_GET['error'] ?></blink></font></p>
          <table width="483" height="89"   border="0" align="center">
                <tr>
                  <td width="223" bgcolor="#e8e8e8"><div align="center"><b><font face="verdana" size="2">TOPIK</font></b></div></td>
                  <td width="59" bgcolor="#e8e8e8"><div align="center"><b><font face="verdana" size="2">Replay</font></b></div></td>
                  <td width="187" bgcolor="#e8e8e8"><div align="center"><b><font face="verdana" size="2">Posting</font></b></div></td>
                </tr>
                <?
			
			while ($row=mysql_fetch_array($result))
			{
				$ID_topik=$row[0];
				$nama=$row[1];
				$email=$row[2];
				$topik=$row[3];
				$isi=$row[4];
				$ID_replay=$row[5];
				$tanggal=$row[6];	
				
				//jumlah replay setiap topik
				$replay=mysql_db_query($db,"select * from forum where ID_replay='$ID_topik'",$koneksi);
				$jml=mysql_num_rows($replay);
			?>
                <tr>
                  <td align="left"><b><a href="index.php?page=9&ID_topik=<? echo $ID_topik;?>" style="text-decoration:none "> <img src="./img/forum.gif" border="0"><font face="verdana" size="2" color="#0033FF"><? echo $topik;?></font></a> </b><br>
                      <font face="Courier New, Courier, mono" size="2"><? echo $isi;?></font> </td>
                  <td align="center"><font face="verdana" size="2"><? echo $jml; ?></font> </td>
                  <td align="left"><font face="verdana" size="-4" color="#666666"><? echo $tanggal; ?></font> <font face="verdana" size="-4" color="#666666">Autor: <? echo $nama; ?> </font> </td>
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
			?>
              <p align="center"><font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font>
                  <?
		}
		?>
              </p>
          <p align="center"><a href="index.php?page=11" style="text-decoration:none" title="Membuat Topik Baru"><img src="./img/forum.png" border="0"></a></p>
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="right"><img src="./img/kib.jpg"></td>
    <td bgcolor="#5686c6" ><div align="center"><strong><font face="verdana" size="1" color="#333333">Jumlah Topik : <? echo $jumlah; ?></font></strong></div></td>
    <td><img src="./img/kab.jpg"></td>
  </tr>
</table>
<p><a href="index.php?page=11" style="text-decoration:none" title="Membuat Topik Baru"></a></p>

<p align="center"><font color="#FF0000" face='verdana' size='2'><blink></blink></font></p>
</html>
