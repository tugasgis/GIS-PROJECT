<? session_start();
ini_set("display_errors",FALSE);

if (session_is_registered('id'))
{
	include "./include/conn.php";
	$id=$_GET['id']; //id catatan
	$gambar=$_POST['gambar'];
	echo $ok=$_POST['ok'];
	
	if (isset($_POST['isi']))//periksa apakah user telah menekan submit, dengan menggunakan parameter setingan isi
	{
		
		$tanggal;
		$head=htmlentities($_POST['head']);
		$isi=$_POST['isi'];
		$fotodoc=$_FILES['fotodoc']['name'];
		$type=$_FILES['fotodoc']['type'];
		$idu=$_POST['id'];
		
		if ($ok=="ok"){
			//kalo gambar gak mau di ganti
			if ($head=="" || $isi=="")//periksa jika data yang dimasukan belum lengkap
			{
				?><script> document.location.href='home.php?page=14&id=<? echo $id; ?>&status=Maaf, Data Anda belum lengkap'; </script>";<?
			}
			else
			{	
				$upload=mysql_db_query($db,"UPDATE berita SET tgl='$tanggal',head='$head', isi='$isi' where id_brt='$idu'",$koneksi);
				?><script> document.location.href='home.php?page=6&status=Data berhasil di ubah'; </script>";<?
			}
		
		}else{
		
			//kalo gambar di ganti
			if ($head=="" || $isi=="" || $fotodoc=="")//periksa jika data yang dimasukan belum lengkap
			{
				?><script> document.location.href='home.php?page=14&id=<? echo $id; ?>&status=Maaf, Data Anda belum lengkap'; </script>";<?
			}
			else
			{
				//jika gambar ikut di ubah
				//hapus file yang lama
				$myFile ="./gambar/".$gambar;
				unlink($myFile);
				
				$uploaddir='./gambar/';
				$alamatgambar=$uploaddir.$_FILES['fotodoc']['name'];
				$alamatdatabase='./admin/gambar/'.$_FILES['fotodoc']['name'];
				if (move_uploaded_file($_FILES['fotodoc']['tmp_name'],$alamatgambar))//periksa jika proses upload berjalan sukses
				{
					
					?><script> document.location.href='home.php?page=6&status=Data berhasil di ubah'; </script>";<?
					
					$upload=mysql_db_query($db,"UPDATE berita SET tgl='$tanggal',head='$head', isi='$isi',gambar='$alamatdatabase' where id_brt='$idu'",$koneksi);
				}else{
					echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
				}
			}
			
		}
	}
	else
	{
		unset($_POST['isi']);
	}
	?>


	<html>
	<head>
		<title>GIS-Endemik</title>
		<style type="text/css">
		<!--
.style2 {
	font-size: 18px;
	font-family: Arial, Helvetica, sans-serif;
}
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
		-->
		</style>
	</head>
	<body>
	<p>&nbsp;</p>
		
		<?
		$tampil=mysql_db_query($db,"select * from berita where id_brt='$id'",$koneksi);
		while ($row=mysql_fetch_array($tampil))
		{
			$id=$row['id_brt'];
			$tgl=$row['tgl'];
			$head=$row['head'];
			$penulis=$row['penulis'];
			$isi=$row['isi'];
			$gambar=$row['gambar'];
		}
		?> 
		<html><head>
	
		<script type="text/javascript" src="./jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
		tinyMCE.init({
		mode : "exact",
		elements : "elm2",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",
		
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,
		
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
		
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
		});
		</script>
		</head>

		<h2 align="center" class="style2">	[Update Artikel]</h2>
		<p><font color='#0066FF' face='verdana' size='2'>
		      <div align="center"><blink><? echo $_GET['status'] ?></blink></div>
			    </font></p>
				
		<form enctype="multipart/form-data" action="edit-artikel-update.php?id=<? echo $id; ?>" method="post">
		<table width="735" cellspacing="0" cellpadding="0" border="0" align="center">
		<tr>
			<td width="39%" height="30"><font face="verdana" size="2">Penulis</font>
			<td width="61%"><font face="verdana" size="2" color="#666666"><? echo ucwords($penulis);?></font></td>
		</tr>
		<tr>
			<input type="hidden" name="id" value="<? echo $id;?>" >
			<td width="39%" height="36"><font face="verdana" size="2">Judul</font></td>
		  <td width="61%"><font face="Times New Roman" size="2">
	      <input type="text"name="head" cols="30" rows="1" value="<? echo $head;?>"></textarea></font></td>
		</tr>
		
		<tr>
			<td width="39%" height="30">&nbsp;</td>
			<td width="61%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">(Gunakan Editor untuk mengedit tulisan)</font></td>
		</tr>
		
		<tr>
			<td width="39%" height="163"><font face="verdana" size="2">Isi Berita</font></td>
		  <td width="61%"><font face="Times New Roman" size="2">
	      <textarea name="isi" cols="30" rows="10" id="elm2"><? echo $isi; ?></textarea></font></td>
		</tr> 
		
		<? $pic=substr($gambar,15,40); ?>
		
		<tr>
			<td height="115"><span class="style3"><img src="./gambar/<? echo $pic; ?>" width="100" height="100" border="0" title="<? echo substr($gambar,15,40); ?>"></span>
			</td>
			<input type="hidden" name="gambar" value="<? echo $pic; ?>">
			<td><p><font face="verdana" size="1" color="#666666"><? echo $gambar; ?></font></p>
		    <p>
		      <input type="checkbox" name="ok" value="ok">
              <span class="style5">Jika gambar tidak ingin di ganti, silahkan ceklist tanda ini !!</span></p></td>
		</tr>
		
		<tr>
			<td height="27">&nbsp;</td>
		  <td>&nbsp;</td>
		</tr>
		
		<tr>
		  <td width="39%" height="33" valign="middle">
		  <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
		  <font size="2" face="verdana">Gambar</font></td>
			<td><input type="file" name="fotodoc" size="30"></td>
		</tr>
		
		<tr>
			<td>&nbsp;</td>
			<td width="61%">&nbsp;</td>
		</tr>
		
		<tr>
			<td width="39%"><p>&nbsp;
			  </p>
		  <p>&nbsp;</p></td>
		  <td width="61%"><input type="submit" value="Update">&nbsp;
		  <input type="button" name="batal" value="Batal" onClick="location.replace('home.php?page=6');" /></td>
		</tr>
		</table>
		</form>
	
				
			 
	</body>
	</html>
	<?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>