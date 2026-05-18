<?php 
session_start();
ob_start();

//print_r($_SESSION);
include('../fonksiyonlar/admin.php');
$admin=new Admin();
$tarihver =date('d.m.Y H:i:s');
if(isset($_POST['username'])) { 
    $username = anti_injection(htmlspecialchars($_POST['username']));
}
if(isset($_POST['pass'])) { 
    $pass = anti_injection(htmlspecialchars($_POST['pass']));
}
if(isset($_POST['_token'])){
if($_SESSION['_token'] == $_POST['_token']){	
if(!isset($_SESSION['loginadmin'])){
	$r_test = $admin->link->db_conn_pann->query("select * from adminyetki");
	$bolumayar = $r_test->fetchAll();
	$ItemType = $bolumayar[0]["ipadres"];
	if(empty($ItemType)){ $guild1 = empty($username); }else{ $guild1 = $bolumayar[0]["ipadres"] != $_SERVER['REMOTE_ADDR']; }

	if(isset($_POST['login'])){
	
	if(empty($username) || empty($pass)){
	
		echo "loginbos";
		
	}else if(preg_match($no,$username) || preg_match($no,$pass)){
	
	$error = "Hatalı Kullancı Adı veya Parola <br /> <a href='passreset.php'>ŞİFREMİ UNUTTUM ?</a> ";
	
	}else if($guild1){
			echo "ipadres";		
	
	}else{
	
		$login_admin = $admin->LoginAdmin($username,md5($pass));		
		if($login_admin == true){
		$result=$admin->GetAdminInfo($username);
		$_SESSION['loginadmin']= "ok";
		$_SESSION['username2']=$result[0]['StrUserID'];
		$_SESSION['password2']=$result[0]['password'];
		
				$_SESSION['gamemasterlogin']="yesmasterlogin";
				$market_log = $admin->LoginLog($username,$tarihver,$_SERVER['REMOTE_ADDR']);
				echo "girisok";
		
				}else{
		
			echo "hata";
		}
	
	}

}
}
}
}