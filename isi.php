<?
$page=$_GET['page'];

switch($page)
{
	case "1";
	include "welcome.php";
	break;
	
		
	case "2";
	include "artikel.php";
	break;
	
	
	case "3";
	include "guestbook.php";
	break;
	
	
	case "4";
	include "forum.php";
	break;
			
	case "5";
	include "tabel.php";
	break;
	
	case "6";
	include "diagram.php";
	break;
			
	case "7";
	include "peta.php";
	break;
	
	
	case "8";
	include "artikel-view.php";
	break;
	
	
	case "9";
	include "forum-view.php";
	break;
	
	case "10";
	include "forum-reply.php";
	break;
	
	case "11";
	include "forum-new.php";
	break;
	
	default;
	include "welcome.php";
	break;
}

?>