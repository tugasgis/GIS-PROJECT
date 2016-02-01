<? session_start();
if (session_is_registered('id'))
{
	include "./include/conn.php";
	$id=$_GET['id'];
	$hal=$_GET['hal'];
	$jenis=$_GET['type'];
	$id_lokasi=$_GET['id_lokasi'];
	$gambar=$_GET['gambar'];
	
	
	
	switch($jenis)
	{
	case "gis";
		//echo "anda hapus data gis";
		$hapus="delete from tblpenyebaran where id_penyebaran='$id'";
		$hasil=mysql_db_query($db,$hapus,$koneksi);
		
		//hapus data di tabel lokasi
		$hapuslok="delete from tbllokasi where id_lokasi='$id'";
		mysql_db_query($db,$hapuslok,$koneksi);
		
		if ($hasil)
		{
			//echo "berhasil di hapus";
			echo "<script> document.location.href='home.php?page=7&status=Data Anda sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
		
	case "guest";
		//echo "anda hapus guestbook";
		$hapus="delete from guestbook where id_gb='$id'";
		$hasil=mysql_db_query($db,$hapus);
		if ($hasil)
		{
			echo "<script> document.location.href='home.php?page=4&status=Data sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
		
	case "topik";
		//echo "anda hapus topik";
		$hapus="delete from forum where ID_topik='$id' or ID_replay='$id' ";
		$hasil=mysql_db_query($db,$hapus,$koneksi);
		if ($hasil)
		{
			//echo "berhasil di hapus";
			echo "<script> document.location.href='home.php?page=5&status=Data Forum sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
	case "replay";
		//echo "anda hapus replay";
		$hapus="delete from forum where ID_topik='$id'";
		$hasil=mysql_db_query($db,$hapus,$koneksi);
		if ($hasil)
		{
			//echo "berhasil di hapus";
			?><script> document.location.href='<? echo $hal; ?>&status=Data replay sudah di hapus'; </script><?
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
	
	
	case "dtahun";
		//echo "anda hapus daftar tahun";
		$hapus="delete from tbltahun where id_tahun='$id'";
		$hasil=mysql_db_query($db,$hapus);
		if ($hasil)
		{
			echo "<script> document.location.href='dtahun.php?status=Data sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
	case "dpenyakit";
		//echo "anda hapus daftar tahun";
		$hapus="delete from tblpenyakit where id_penyakit='$id'";
		$hasil=mysql_db_query($db,$hapus);
		if ($hasil)
		{
			echo "<script> document.location.href='dpenyakit.php?status=Data sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
	case "member";
		//echo "anda hapus anggota";
		$hapus="delete from daftar where id='$id'";
		$hasil=mysql_db_query($db,$hapus);
		if ($hasil)
		{
			echo "<script> document.location.href='home.php?page=3&status=Data sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
	case "lokasi";
		//echo "anda hapus anggota";
		$hapus="delete from tbllokasi where id='$id'";
		$hasil=mysql_db_query($db,$hapus);
		if ($hasil)
		{
			?><script> document.location.href='home.php?page=12&id_lokasi=<? echo $id_lokasi;?>&status=Data sudah di hapus'; </script><?
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
		
	
	case "catatan";
		//hapus data dan filenya
		$myFile ="./gambar/".$gambar;
		unlink($myFile);
		
		$hapus="delete from berita where id_brt='$id'";
		$hasil=mysql_db_query($db,$hapus);
		if ($hasil)
		{
			echo "<script> document.location.href='home.php?page=6&status=Data sudah di hapus'; </script>";
		}
		else
		{
			echo "Proses Penghapusan data gagal";
			echo mysql_error();
		}
		break;
	
	}
	
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>