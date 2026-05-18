<?php 
session_start();
ob_start();

$dil = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2);

if($dil=="tr"){
   include 'dil/tr.php';
}else if($dil=="ku"){
   include 'dil/tr.php';   
}else if($dil=="az"){
   include 'dil/tr.php';
}else{
   include 'dil/en.php';
}	

//print_r($_SESSION);
include('fonksiyonlar/users.php');
$users=new Users();

	if(!isset($_SESSION['guardf'])){
	}else{
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) { 
session_unset();
session_destroy();
} 
$_SESSION['LAST_ACTIVITY'] = time();
}

$r_test = $users->link->db_conn_pann->query("select * from Bolum");
$bolumayar = $r_test->fetchAll();	
	
if(isset($_POST['username'])) { 
    $username =anti_injection(htmlspecialchars($_POST['username']));
}
if(isset($_POST['pass'])) { 
    $pass = anti_injection(htmlspecialchars($_POST['pass']));
	
}

if(isset($_POST['repass'])) { 
    $repass = anti_injection(htmlspecialchars($_POST['repass']));
}

if(isset($_POST['email'])) { 
    $email = anti_injection(htmlspecialchars($_POST['email']));
}

if(isset($_POST['gs'])) { 
    $gs = anti_injection(htmlspecialchars($_POST['gs']));
}
if(isset($_POST['guvenlikKodu'])) {
	$guvenlikKodu = anti_injection(htmlspecialchars($_POST['guvenlikKodu']));
}
$users->update_t_currency();
//  register.php?ref= gelen değeri burada alıyorum
if(isset($_POST['refuser'])){
	
	$refuser =(int) anti_injection(htmlspecialchars($_POST['refuser']));
}

$ip_adress = $_SERVER['REMOTE_ADDR'];

$kontrol = "/\S*((?=\S{8,})(?=\S*[A-Z]))\S*/";
$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬]/';
$no2 ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{#~?><>,;|=+¬]/';

//kayıt ol
if(isset($_POST['register'])){
	
	if($bolumayar[0]["kayit"] == 1){
	if(preg_match($no,$username) || preg_match($no,$pass) || preg_match($no,$repass) || preg_match($no2,$email) || preg_match($no,$gs)){
	
	 echo "karakter";
	
	}else if(empty($username) || empty($pass) || empty($repass) || empty($email) || empty($gs) || empty($guvenlikKodu)){
	
		$data['status']="error";
		$data['text']=$dils['hatabos'];
		echo json_encode($data);
		
	}else if($pass !== $repass){
		
		$data['status']="error";
		$data['text']=$dils['rhata4'];
		echo json_encode($data);
	
	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	
		$data['status']="error";
		$data['text']=$dils['rhata5'];
		echo json_encode($data);
		
	}else if(strlen($username)<6 || strlen($username)>16){
	
		$data['status']="error";
		$data['text']=$dils['rhata1'];
		echo json_encode($data);
		
	}else if(strlen($pass)<8 || strlen($pass) >24){
	
		$data['status']="error";
		$data['text']=$dils['rhata2'];
		echo json_encode($data);

	}else if(strlen($email)>30){
	
		$data['status']="error";
		$data['text']="Email adresiniz en fazla 30 karakter'den oluşabilir.";
		echo json_encode($data);
	}else if(strlen($gs)<8 || strlen($gs) >24){
	
		$data['status']="error";
		$data['text']=$dils['rhata6'];
		echo json_encode($data);		
		
	}else if(!preg_match($kontrol,$pass)){
		
		$data['status']="error";
		$data['text']=$dils['rhata3'];
		echo json_encode($data);

	}else if(!preg_match($kontrol,$gs)){
		
		$data['status']="error";
		$data['text']=$dils['rhata7'];
		echo json_encode($data);

	}else if($_POST['guvenlikKodu'] != $_SESSION['guvenlikKodu']) {
		
		$data['status']="error";
		$data['text']=$dils['rhata9'];
		echo json_encode($data);
	}else{
	
		$check_user = $users->GetUserInfo($username);
		if($check_user == 0)
		{
			 $register_user = $users->registerUsers2($username,md5($pass),$email,sha1(md5($gs)),$ip_adress);
			 
			 //$register_user = $users->registerUsers2();
			 //print_r($register_user);
			if($register_user == 1)
			{
					$result = $users->GetUserInfo($username);
					
					/*REKLAM YAP TL KAZAN KODLARI BURADA*/
					if($refuser !=0 ){
						
						$referansuye = $users->ref_username($refuser);
						$ref_uye = $referansuye[0][0];
						$ref_user_ekle = $users->ref_user_ekle($ref_uye,$username);
					}
					$site_ayar= $users->link->db_conn_pann->query("SELECT * from Siteayar");
					$rowayar = $site_ayar ->fetchAll();

					/* 2 SİLK EKLEMEK İÇİN  GEREKLİ KODLARI BURAYA YAZDIM*/
					$new_JID = $result[0][0];
					$eklenecek_silk = $rowayar[0]['silk'];
					$start_silk = $users->start_silk($new_JID,$eklenecek_silk);
					$fy_userpass =$users->user_settings($new_JID);			
					if($start_silk == 1){
			
		$data['status']="success";
		$data['text']=$dils['rhata10'];
		echo json_encode($data);
					
					}else{
						
		$data['status']="success";
		$data['text']=$dils['rhata10'];
		echo json_encode($data);
						
					}
							
			}else{
				
				echo 'Hata: '.mysql_error();
			}
			
		}else{
		
		$data['status']="error";
		$data['text']=$dils['rhata11'];
		echo json_encode($data);
		}
	
	}
	
	if(empty($username) || empty($pass)){
		
	}else if(preg_match($no,$username) || preg_match($no,$pass)){
	
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
					
			}
		else{
		
			}
		}else{
		
		}
	
	}	
		}else{
	
		$data['status']="error";
		$data['text']=$dils['rhata12'];
		echo json_encode($data);
	}	
}

//giriş yap
if(isset($_POST['login'])){
	
	if(empty($username) || empty($pass)){
	
		$data['status']="error";
		$data['text']=$dils['hatabos'];
		echo json_encode($data);
		
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
		
		$data['status']="success";
		$data['text']=$dils['rhata13'];
		echo json_encode($data);
				
			}
		else{
				
		$data['status']="success";
		$data['text']=$dils['rhata13'];
		echo json_encode($data);
		
			}
		}else{
		
		$data['status']="error";
		$data['text']=$dils['rhata14'];
		echo json_encode($data);

		}
	
	}

}

//şifre değiştir
 if(isset($_POST['passreset'])){

 if($bolumayar[0]["unuttum"] == 1){
		$reset_username = anti_injection(htmlspecialchars($_POST['username']));
		$reset_email	= anti_injection(htmlspecialchars($_POST['email']));
		$reset_gs = anti_injection(htmlspecialchars($_POST['gs']));
		$reset_sifre = anti_injection(htmlspecialchars($_POST['pass']));
		$reset_resifre = anti_injection(htmlspecialchars($_POST['repass']));

		if(empty($reset_username) || empty($reset_email) || empty($reset_gs) || empty($reset_sifre) || empty($reset_resifre)){
		
		$data['status']="error";
		$data['text']=$dils['hatabos'];
		echo json_encode($data);
		
		}else if (preg_match($no,$reset_username) || preg_match($no2,$reset_email) || preg_match($no,$reset_gs) || preg_match($no,$reset_sifre) || preg_match($no,$reset_resifre)){
			
		$data['status']="error";
		$data['text']="Girilen bilgiler hatalı.";
		echo json_encode($data);
			
			
		}else if(strlen($reset_sifre) > 24  || strlen($reset_sifre) < 8){
			
		$data['status']="error";
		$data['text']=$dils['rhata2'];
		echo json_encode($data);
		
		}else if(!preg_match($kontrol,$reset_sifre)){
		
		$data['status']="error";
		$data['text']=$dils['rhata3'];
		echo json_encode($data);
		
		}else if($reset_sifre != $reset_resifre ){
			
		$data['status']="error";
		$data['text']=$dils['rhata4'];
		echo json_encode($data);

	}else if($_POST['guvenlikKodu'] != $_SESSION['guvenlikKodu']) {
		
		$data['status']="error";
		$data['text']=$dils['rhata9'];
		echo json_encode($data);		
		}else{
			
			$reset = $users->reset_pw($reset_username,$reset_email,$reset_gs,$reset_sifre);
			
			if($reset == 1){
				
		$data['status']="success";
		$data['text']=$dils['shata1'];
		echo json_encode($data);
				
			}else{
				
		$data['status']="error";
		$data['text']=$dils['shata2'];
		echo json_encode($data);	
				
			}
		}
				}else{
	
		$data['status']="error";
		$data['text']=$dils['shata3'];
		echo json_encode($data);
	}	
} 
 if(isset($_POST['replaygs'])){
 
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$gs = anti_injection(htmlspecialchars($_POST['gs']));
		$regs = anti_injection(htmlspecialchars($_POST['regs']));

		if(empty($gs) || empty($regs)){
		
		$data['status']="error";
		$data['text']=$dils['hatabos'];
		echo json_encode($data);
		
		}else if(strlen($gs)<8 || strlen($gs) >24){
	
		$data['status']="error";
		$data['text']=$dils['rhata6'];
		echo json_encode($data);		

		}else if(!preg_match($kontrol,$gs)){
		
		$data['status']="error";
		$data['text']=$dils['rhata7'];
		echo json_encode($data);
		
		}else if($regs != $gs ){
			
		$data['status']="error";
		$data['text']=$dils['shata4'];
		echo json_encode($data);
		}else{
			
			$reset = $users->reset_gs($username,$gs);
			
			if($reset == 1){
				
		$data['status']="success";
		$data['text']=$dils['shata5'];
		echo json_encode($data);
				
			}else{
				
		$data['status']="error";
		$data['text']="Opps.";
		echo json_encode($data);	
				
			}
		}

}
