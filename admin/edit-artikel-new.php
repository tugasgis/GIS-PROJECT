<? session_start();
if (session_is_registered('id'))
{
	$userid=$_SESSION['userid'];
	include "./include/conn.php";
	
	if (isset($_POST['isi']))//periksa apakah user telah menekan submit, dengan menggunakan parameter setingan isi
	{
		$tanggal;
		$head=ucwords(htmlentities($_POST['head']));
		$penulis=ucwords(htmlentities($_POST['penulis']));
		$isi=$_POST['isi'];
		$fotodoc=$_FILES['fotodoc']['name'];
		$type=$_FILES['fotodoc']['type'];
		
		if ($head=="" || $isi=="" || $fotodoc=="")//periksa jika data yang dimasukan belum lengkap
		{
			?><script> document.location.href='home.php?page=13&status=Data Anda belum lengkap.';</script>";<?
		}
		else
		{
			
			$uploaddir='./gambar/';
			$alamatgambar=$uploaddir.$_FILES['fotodoc']['name'];
			$alamatdatabase='./admin/gambar/'.$_FILES['fotodoc']['name'];
			
			
			if (move_uploaded_file($_FILES['fotodoc']['tmp_name'],$alamatgambar))//periksa jika proses upload berjalan sukses
			{
				
				?><script> document.location.href='home.php?page=6&status=Data Anda berhasil di simpan.'; </script>";<?
				
				$upload=mysql_db_query($db,"INSERT INTO berita(tgl,head,isi,gambar,penulis) VALUES('$tanggal','$head','$isi','$alamatdatabase','$penulis')");
			}else{
				echo "Proses upload gagal, kode error = " . $_FILES['location']['error'];
			}
		}
		
	}
	else
	{
		unset($_POST['isi']);
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
		 
	<h2 align="center"><font size="3" face="Arial, Helvetica, sans-serif">[New Artikel]</font></h2>
	<p><font color='#0066FF' face='verdana' size='2'>
		      <div align="center"><blink><? echo $_GET['status'] ?></blink></div>
			    </font></p>
	<form enctype="multipart/form-data" action="edit-artikel-new.php" method="post">
	
	<table width="693" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr>
		<td width="29%" height="30"><font face="verdana" size="2">Penulis</font>
      <input type="hidden" name="penulis" value="<? echo $userid;?>" /></td>
	    <td width="71%"><font face="verdana" size="2" color="#666666"><? echo ucwords($userid);?></font></td>
	</tr>
	<tr>
		<td width="29%" height="30"><font face="verdana" size="2">Judul</font></td>
	    <td width="71%"><font face="Times New Roman" size="2">
      <input type="text" name="head"/ size="40"></font></td>
	</tr>
	
	<tr>
		<td width="29%" height="30">&nbsp;</td>
	    <td width="71%"><font face="Verdana, Arial, Helvetica, sans-serif" size="1">(Gunakan editor untuk mengedit tulisan)</font></td>
	</tr>
	
	<tr>
		<td width="29%" height="182"><font face="verdana" size="2">Isi Berita</font></td>
	  <td width="71%"><font face="Times New Roman" size="2">
      <textarea name="isi" cols="30" rows="10" id='elm2'></textarea></font></td>
	</tr> 
	
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	
	<tr>
	  <td width="29%" height="37" valign="middle">
	  <input type="hidden" name="MAX_FILE_SIZE" value="1000000" id="gambar">
	  <font size="2" face="verdana">Gambar</font></td>
		<td><input type="file" name="fotodoc" size="30" id="gambar"></td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
		<td width="71%"><input type="submit" value="Kirim" onclick="return cek();">&nbsp;
	  <input type="button" name="batal" value="Batal" onclick="location.replace('home.php?page=6');" /></td>
	</tr>
	</table>
	
	</form>

					
			
<?
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>