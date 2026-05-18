<?php 
ob_start();
session_start();
$_SESSION['loginadmin'] = "ok"; 
unset($_SESSION['loginadmin']);  
$_SESSION['username2'] = null; 
unset($_SESSION['username2']);  
$_SESSION['password2'] = null; 
unset($_SESSION['password2']);  
$_SESSION['gamemasterlogin'] = "yesmasterlogin"; 
unset($_SESSION['gamemasterlogin']);  
header('Location:index.php');
ob_end_flush();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
	<META HTTP-EQUIV="Refresh" CONTENT="1;URL=index.php">
	<title></title>
</head>
<body>
	<h4 class="alert_success">Başarıyla çıkış yaptınız yönlendiriliyorsunuz...</h4>
</body>
</html>