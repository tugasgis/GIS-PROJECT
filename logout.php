<? session_start();
if (session_is_registered('user_id'))
{
	//hapus session
	session_unregister("user_id");
	session_unregister("user_name");
	echo "<script> document.location.href='index.php'; </script>";
	
}else{
	echo "<script> document.location.href='akses.php?go=session'; </script>";
}
?>