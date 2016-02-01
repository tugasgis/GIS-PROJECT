<?
$page=$_GET['page'];

switch($page)
{
	case "1";
	include "welcome.php";
	break;
			
	case "2";
	include "edit-profil.php";
	break;
	
	case "3";
	include "edit-member.php";
	break;
	
	case "4";
	include "edit-guestbook.php";
	break;
	
	case "5";
	include "edit-forum.php";
	break;
	
	case "6";
	include "edit-artikel.php";
	break;
	
	case "7";
	include "view-gis.php";
	break;
			
	case "8";
	include "new-gis.php";
	break;
	
	case "9";
	include "new-gis-lokasi.php";
	break;
	
	case "10";
	include "new-gis-peta.php";
	break;
	
	case "11";
	include "update-gis-lokasi.php";
	break;
	
	case "12";
	include "view-gis-lokasi.php";
	break;
	
	case "13";
	include "edit-artikel-new.php";
	break;
	
	case "14";
	include "edit-artikel-update.php";
	break;
	
	default;
	include "welcome.php";
	break;
}

?>