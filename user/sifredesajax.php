<?php 
session_start();
include ('lib/reg_users.php');
				$kontrol = "/\S*((?=\S{8,})(?=\S*[A-Z]))\S*/";				
				$epin_gecmis=$users ->epin_listele($_SESSION['username']);
				$JID = $_SESSION['JID'];
				$kullanici =$_SESSION['username'];
				$tarih = date("d.m.Y H:i:s");
				
				if(!isset($_SESSION['log'])){
				@$user_login_log = $users->user_login_log($kullanici,$tarih,$sehirulke,$ip);
				$_SESSION['log'] ="ok";
				}
if(isset($_POST['_token'])){
if($_SESSION['_token'] == $_POST['_token']){
if(isset($_SESSION['guardf'])){				
				if(isset($_POST['changepw'])){
					
					$pweski = anti_injection(htmlspecialchars($_POST['eskipass']));
					$pwpass = anti_injection(htmlspecialchars($_POST['pass']));
					$pwrepass = anti_injection(htmlspecialchars($_POST['repass']));
					$gs = anti_injection(htmlspecialchars($_POST['gs']));
					
					if(empty($pweski) || empty($pwpass) || empty($pwrepass)	|| empty($gs)){
						
						echo "passbos";
						
					}else if(md5($pweski) != $_SESSION['password']){
						
						echo "eskipass";	

					}else if(sha1(md5($gs)) != $_SESSION['gizlicevap']){
						
						echo "gs";
						
					}else if(strlen($pwpass) > 24  || strlen($pwpass) < 8){
						
						echo "alan";

					}else if(!preg_match($kontrol,$pwpass)){

					    echo 'kontrolyal';					
	
					}else if($pwpass != $pwrepass){
						
						echo "newpass";
						
				
					}else{
						
						$newpw = md5($pwpass);
						
						$sifre_degistir = $users->sifre_degistir($kullanici,$newpw);
						
						if($sifre_degistir == 1)
						{
							echo "passok";
							
						}else{
							
							echo "<strong style='color:#2ac0ff;font-size:15px'>BEKLENMEDİK HATA</strong>";
						}
					}
				}
}}}