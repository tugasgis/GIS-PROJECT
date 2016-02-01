<html>
<head>
</head>
<body>
<?

$host="localhost";
$user="root";
$pass="";
$db="endemikdb";
$entries=3;
$gis=5; //jmlah untuk menampilkan data gis
$loc=10; //jumlah lokasi yang ditampilkan

$koneksi=mysql_connect($host,$user,$pass);
$tanggal=date("Y-m-d H:i:s");
/*
if ($koneksi)
{
	echo "berhasil : )";
}else{
	echo "Gagal !";
}
*/
?>

</body>
</html>
