<html>
<head>
</head>
<body>
<?
ini_set('display_errors',FALSE);
$host="localhost";
$user="root";
$pass="";
$db="endemikdb";
$entries=3;
$gis=3;
$gistahun=3;
$loc=10;


$koneksi=mysql_connect($host,$user,$pass);
$tanggal=date("Y-m-d H:i:s");

if ($koneksi)
{
	//echo "berhasil : )";
}else{
	?><script language="javascript">alert("Gagal Koneksi Database MySql !!")</script><?
}

?>

</body>
</html>
