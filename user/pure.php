<?php 
session_start();
ob_start();

//print_r($_SESSION);
include('../fonksiyonlar/users.php');
$users=new Users();

if(isset($_POST['username'])) { 
    $username = anti_injection(htmlspecialchars($_POST['username']));
}
if(isset($_POST['pass'])) { 
    $pass = anti_injection(htmlspecialchars($_POST['pass']));
}
if(isset($_POST['_token'])){
if($_SESSION['_token'] == $_POST['_token']){	
if(!isset($_SESSION['guardf'])){	
if(isset($_POST['login'])){
	
	if(empty($username) || empty($pass)){
	
		echo "loginbos";
		
	}else if(preg_match($no,$username) || preg_match($no,$pass)){
	
			$error = "Hatalı Kullancı Adı veya Parola <br /> <a href='passreset.php'>ŞİFREMİ UNUTTUM ?</a> ";
	}else{
	
		$login_user = $users->LoginUsers($username,md5($pass));		
		if($login_user == true){
		$result=$users->GetUserInfo($username);
		$_SESSION['guardf']= "ok";
		$_SESSION['username']=$result[0][1];
		$_SESSION['password']=$result[0]['password'];
		$_SESSION['JID']=$result[0]['JID'];
		$_SESSION['mail']=$result[0]['Email'];
		$_SESSION['tlmiktari']=$result[0]['phone'];
		$_SESSION['tlmiktari'] == "" ? $_SESSION['tlmiktari']=0 :$_SESSION['tlmiktari'];
		$_SESSION['gizlicevap']=$result[0]['address'];
		$_SESSION['checkgm'] = $result[0]['sec_primary'];
		$silkmiktari = $users->silk($_SESSION['username']);
		$_SESSION['silk']=$silkmiktari[0]['silk_own'];
		$_SESSION['silk'] == "" ? $_SESSION['silk']=0 :$_SESSION['silk'];
		if($_SESSION['checkgm'] == 3){
		
				echo "girisok";	
				
			}
		else{
				
				echo "girisok";
		
			}
		}else{
		
			echo "hata";
		}
	
	}

}
}
}
}