<?php 
session_start();
ob_start();

//print_r($_SESSION);
include('../fonksiyonlar/users.php');
$users=new Users();

	if(!isset($_SESSION['guardf'])){
	}else{
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1200)) { 
session_unset();
session_destroy();
} 
$_SESSION['LAST_ACTIVITY'] = time();
}

if(isset($_POST['username'])) { 
    $username = htmlspecialchars(trim($_POST['username']));
}
if(isset($_POST['pass'])) { 
    $pass = htmlspecialchars(trim($_POST['pass']));
	
}

if(isset($_POST['repass'])) { 
    $repass = htmlspecialchars(trim($_POST['repass']));
}

if(isset($_POST['email'])) { 
    $email = htmlspecialchars(trim($_POST['email']));
}

if(isset($_POST['gs'])) { 
    $gs = htmlspecialchars(trim($_POST['gs']));
}
if(isset($_POST['guvenlikKodu'])) {
	$guvenlikKodu = htmlspecialchars(trim($_POST['guvenlikKodu']));
}
$users->update_t_currency();
//  register.php?ref= gelen değeri burada alıyorum
if(isset($_POST['refuser'])){
	
	$refuser =(int) htmlspecialchars(trim($_POST['refuser']));
}

$ip_adress = $_SERVER['REMOTE_ADDR'];

$kontrol = "/\S*((?=\S{8,})(?=\S*[A-Z]))\S*/";
$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬]/';
$no2 ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{#~?><>,;|=+¬]/';

//kayıt ol
if(isset($_POST['register'])){
	if(preg_match($no,$username) || preg_match($no,$pass) || preg_match($no,$repass) || preg_match($no2,$email) || preg_match($no,$gs)){
	
	 echo "karakter";
	
	}else if(empty($username) || empty($pass) || empty($repass) || empty($email) || empty($gs) || empty($guvenlikKodu)){
	
		$data['status']="error";
		$data['text']="Lütfen tüm alanları doldurun.";
		echo json_encode($data);
		
	}else if($pass !== $repass){
		
		$data['status']="error";
		$data['text']="Şifreler bir biri ile uyuşmuyor.";
		echo json_encode($data);
	
	}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
	
		$data['status']="error";
		$data['text']="Lütfen gecerli bir mail adresi giriniz.";
		echo json_encode($data);
		
	}else if(strlen($username)<6 || strlen($username)>16){
	
		$data['status']="error";
		$data['text']="Kullanıcı adınız en az 6 en fazla 16 karakter olabilir.";
		echo json_encode($data);
		
	}else if(strlen($pass)<8 || strlen($pass) >24){
	
		$data['status']="error";
		$data['text']="Şifreniz en az 8 en fazla 24 karakter olabilir.";
		echo json_encode($data);

	}else if(strlen($email)>30){
	
		$data['status']="error";
		$data['text']="Email adresiniz en fazla 30 karakter'den oluşabilir.";
		echo json_encode($data);
	}else if(strlen($gs)<8 || strlen($gs) >24){
	
		$data['status']="error";
		$data['text']="Gizli yanıtınız en az 8 en fazla 24 karakterden oluşabilir.";
		echo json_encode($data);		
		
	}else if(!preg_match($kontrol,$pass)){
		
		$data['status']="error";
		$data['text']="Şifrenizde 1 büyük harf olmak zorundadır.";
		echo json_encode($data);

	}else if(!preg_match($kontrol,$gs)){
		
		$data['status']="error";
		$data['text']="Gizli yanıtınızda 1 büyük harf olmak zorundadır.";
		echo json_encode($data);

	}else if($_POST['guvenlikKodu'] != $_SESSION['guvenlikKodu']) {
		
		$data['status']="error";
		$data['text']="Güvenlik kodunuz hatalı.";
		echo json_encode($data);
	}else{
	
		$check_user = $users->GetUserInfo($username);
		if($check_user == 0)
		{
			 $register_user = $users->registerUsers2($username,md5($pass),$email,md5($gs),$ip_adress);
			 $fy_userpass =$users->fy_userpass($username,$pass);
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
					if($start_silk == 1){
						
		$data['status']="success";
		$data['text']="Başarılı şekilde kayıt oldunuz.Yönlendiriliyorsunuz.";
		echo json_encode($data);
					
					}else{
						
		$data['status']="success";
		$data['text']="Başarılı şekilde kayıt oldunuz.Yönlendiriliyorsunuz.";
		echo json_encode($data);
						
					}
							
			}else{
				
				echo 'Hata: '.mysql_error();
			}
			
		}else{
		
		$data['status']="error";
		$data['text']="Kullanıcı adı mevcut.";
		echo json_encode($data);
		}
	
	}

}

//giriş yap
if(isset($_POST['login'])){
	
	if(empty($username) || empty($pass)){
	
			echo 'loginbos';
			
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
		$data['text']="Başarılı şekilde giriş yaptınız.";
		echo json_encode($data);
				
			}
		else{
				
		$data['status']="success";
		$data['text']="Başarılı şekilde giriş yaptınız.";
		echo json_encode($data);
		
			}
		}else{
		
		$data['status']="error";
		$data['text']="Hatalı kullanıcı adı yada şifre.";
		echo json_encode($data);

		}
	
	}

}

//şifre değiştir
 if(isset($_POST['passreset'])){
 
		$reset_username = htmlspecialchars(strip_tags($_POST['username']));
		$reset_email	= htmlspecialchars(strip_tags($_POST['email']));
		$reset_gs = htmlspecialchars(strip_tags($_POST['gs']));
		$reset_sifre = htmlspecialchars(strip_tags($_POST['pass']));
		$reset_resifre = htmlspecialchars(strip_tags($_POST['repass']));

		if(empty($reset_username) || empty($reset_email) || empty($reset_gs) || empty($reset_sifre) || empty($reset_resifre)){
		
		$data['status']="error";
		$data['text']="Lütfen tüm alanları doldurun";
		echo json_encode($data);
		
		}else if (preg_match($no,$reset_username) || preg_match($no2,$reset_email) || preg_match($no,$reset_gs) || preg_match($no,$reset_sifre) || preg_match($no,$reset_resifre)){
			
		$data['status']="error";
		$data['text']="Girilen bilgiler hatalı.";
		echo json_encode($data);
			
			
		}else if(strlen($reset_sifre) > 24  || strlen($reset_sifre) < 8){
			
		$data['status']="error";
		$data['text']="Şifrenize en az 8 en fazla 20 karakter olabilir.";
		echo json_encode($data);
		
		}else if(!preg_match($kontrol,$reset_sifre)){
		
		$data['status']="error";
		$data['text']="Yeni Şifrenizde 1 büyük harf olmak zorundadır.";
		echo json_encode($data);
		
		}else if($reset_sifre != $reset_resifre ){
			
		$data['status']="error";
		$data['text']="Şifreler bir biri ile uyuşmuyor.";
		echo json_encode($data);
		}else{
			
			$reset = $users->reset_pw($reset_username,$reset_email,$reset_gs,$reset_sifre);
			
			if($reset == 1){
				
				echo "passok";
				
			}else{
				
				echo "bilgihata";		
				
			}
		}
}