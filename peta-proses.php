<? session_start();
session_unregister("map");
session_unregister("tahun");

include "./include/conn.php";
$type=$_GET['type'];

//tampilkan data berdasarkan tahun
$tahun=$_GET['tahun'];
$tampil=mysql_db_query($db,"select * from tblpenyebaran where tahun='$tahun'",$koneksi);
$jumlah=mysql_num_rows($tampil);
if ($jumlah){
	while($row=mysql_fetch_array($tampil))
	{
		?><script> document.location.href='session.php?map=<? echo $row['map']; ?>&tahun=<? echo $row['tahun']; ?>'; </script><?
	}
	
}else{
	?>
	<font color="#FF0000" face="verdana" size="2"><b>Belum ada data!!</b></font>
	<?
}

break;

?>













