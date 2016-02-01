<marquee behavior="scroll" direction="up" scrollamount="3" title="Galery">
<div align="center">
  <?
include "./include/conn.php";

$gambar=mysql_db_query($db,"select * from berita",$koneksi);
while($row=mysql_fetch_array($gambar)){
	$pic=$row['gambar'];
	
	?>
  <br>
  <br>
  <img src="<? echo $pic;?>" border="0" width="150" height="150" title="<? echo "Gambar : ".substr($pic,15,30); ?>">
  <?
}

?>
</div>
</marquee>