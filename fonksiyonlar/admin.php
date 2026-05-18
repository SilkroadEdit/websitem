<?php 
Class Admin{

	public $link;
	
	public function __construct(){
	
		include('config.php');
		$this->link = new dbConnection();
		$this->link->connect();
		return $this->link;
		
	}
	
		public function LoginAdmin($StrUserID,$password){
			$query=$this->link->db_conn_account->query("SELECT * FROM SRO_VT_ACCOUNT.dbo.TB_User,Panel.dbo.adminyetki WHERE StrUserID = '$StrUserID' and password = '$password' and yetki = '1' and kuladi = '$StrUserID'");
			$rowcount=$query->rowCount();
			return $rowcount;
	}
	
	public function GetAdminInfo($StrUserID){
			
			$query = $this->link->db_conn_account->query("SELECT * FROM SRO_VT_ACCOUNT.dbo.TB_User,Panel.dbo.adminyetki WHERE StrUserID = '$StrUserID'  and yetki = '1' and kuladi = '$StrUserID'");
			$rowcount = $query->rowCount();
			if($rowcount == true){
				$result = $query->fetchAll();
				return $result;
			}else{
			
				return $rowcount;
			}
	}
	
		public function AdminLog($username,$type,$bilgi,$tarih,$ipadres){
		
		$query = $this->link->db_conn_pann->query("INSERT INTO AdminLog(username,type,bilgi,tarih,ipadres) VALUES ('$username','$type','$bilgi','$tarih','$ipadres')");		$rowcount = $query->rowCount();

		
	}

	 public function notices(){

		$query=$this->link->db_conn_pann->query("select count(*) as Ticket from _Tickets where Status = 0");
		foreach($query as $row)
		{
			if($row['Ticket']==0) {
				
			}else{
				return $row['Ticket'];
			}
			
		}
		
	 }

	public function CharInfo($charname){
		
		$query = $this->link->db_conn_shard->query("SELECT * FROM _Char WHERE CharName16='$charname'");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
	}	

	public function toplam_icerik(){
		
		$query = $this->link->db_conn_account->query("SELECT COUNT(*) AS toplam FROM tb_user");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_icerikglobal(){
		
		$query = $this->link->db_conn_logger->query("SELECT COUNT(*) AS toplam FROM _LogGlobal");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_iceriknotice(){
		
		$query = $this->link->db_conn_logger->query("SELECT COUNT(*) AS toplam FROM _LogNotice");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_icerik103(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM AdminLog");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_icerik2(){
		
		$query = $this->link->db_conn_shard->query("SELECT COUNT(*) AS toplam FROM _Char where not CharName16 ='d'");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_icerik4($guildid){
		
		$query = $this->link->db_conn_shard->query("SELECT COUNT(*) AS toplam from _GuildMember where GuildID = $guildid");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_icerik3(){
		
		$query = $this->link->db_conn_shard->query("SELECT COUNT(*) AS toplam FROM _Guild where not Name = 'dummy' ");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function AvcıInfo($charname){
		
		$query = $this->link->db_conn_shard->query("SELECT * FROM _Char WHERE NickName16='$charname'");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
	}	

	
	public function UserInfo($charname){
		
		$query = $this->link->db_conn_account->query("SELECT * FROM tb_user WHERE StrUserID='$charname'");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
	}		



	public function LoginLog($username,$tarih,$ipadres){
		
		$query = $this->link->db_conn_pann->query("INSERT INTO adminloginlog(username,tarih,ip) VALUES ('$username','$tarih','$ipadres')");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
		
	}
	


	public function banat($username,$type,$msg,$sure){
		 
			$query = $this->link->db_conn_account->prepare("DECLARE @AccJID INT;  
		DECLARE @UserID varchar(128); 
		SET @AccJID=(SELECT JID FROM TB_User WHERE StrUserID=:username)
		SET @UserID=(SELECT StrUserID FROM TB_User WHERE JID=@AccJID)
	insert into SRO_VT_ACCOUNT.._Punishment 
		values (@AccJID,:type,'Panel',64,'','','',:msg,'',getdate(),getdate(),dateadd(DAY,$sure,getdate()),getdate(),0)
	");
			$values = array(':username' => $username,
							':type' => $type,
							':msg' => $msg);
			$query->execute($values);
			$counts = $query->rowCount();
			
	$query2 = $this->link->db_conn_account->prepare(" DECLARE @AccJID INT;  
		DECLARE @UserID varchar(128); 
		SET @AccJID=(SELECT JID FROM TB_User WHERE StrUserID=:username)
		SET @UserID=(SELECT StrUserID FROM TB_User WHERE JID=@AccJID)
		insert into SRO_VT_ACCOUNT.._BlockedUser 
		values (@AccJID,@UserID,:type,@@IDENTITY,getdate(),dateadd(DAY,$sure,getdate()))");
	$values2 =array(':username' => $username,
					':type' => $type);
	$query2->execute($values2);
	$counts2 = $query2->rowCount();
	return $counts2;
			
	}
	

	
	public function icerik_ekle($baslik,$icerik,$icerikfull,$resim,$tarih){
	
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Haberler(baslik,icerikfull,resim,tarih) VALUES (:baslik,:icerikfull,:resim,:tarih)");
		$values = array(':baslik' 	  => $baslik,
						
						':icerikfull' => $icerikfull,
						':resim'	  => $resim,
						':tarih'	  => $tarih);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function icerik_listele(){
	
		$query = $this->link->db_conn_pann->query("SELECT id,baslik,icerikfull,tarih FROM  Haberler ORDER BY tarih DESC");
		$result = $query->fetchAll();
		return $result;

	}
	
	public function icerik_guncelle($baslik,$icerikfull,$resim,$tarih,$id){
	
		$query = $this->link->db_conn_pann->prepare("UPDATE Haberler SET baslik = :baslik,icerikfull = :icerikfull,resim = :resim,tarih = :tarih WHERE id = :id");
		$values = array(':baslik' 	  => $baslik,
						':icerikfull' => $icerikfull,
						':resim'	  => $resim,
						':tarih'	  => $tarih,
						':id'		  => $id);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
		public function entegre($api_user,$api_pass,$ip,$sqluser){
	
		$query = $this->link->db_conn_pann->prepare("UPDATE SpecialFiyat SET stattl = :api_user,statsilk = :api_pass,skilltl = :ip,skillsilk = :sqluser");
		$values = array(':api_user' 	  => $api_user,
						':api_pass' 	  => $api_pass,
						':ip' => $ip,
						':sqluser' => $sqluser);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
		public function kaleayar($jangan,$hotan,$bandit,$cons){
	
		$query = $this->link->db_conn_pann->prepare("UPDATE kaleayar SET jangan = :jangan,hotan = :hotan,bandit = :bandit,cons = :cons");
		$values = array(':jangan' 	  => $jangan,
						':hotan' 	  => $hotan,
						':bandit' => $bandit,
						':cons'		  => $cons);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
		public function bolumayar($kayit,$stat,$stats,$bugkurtar,$unuttum,$hesapno,$deger,$deger1){
	
		$query = $this->link->db_conn_pann->prepare("UPDATE Bolum SET usergenel=:genel,istatislik=:istatistik,hesapno = :hesapno , kayit = :kayit,stat = :stat,stats = :stats,karakter = :bugkurtar,unuttum = :unuttum");
		$values = array(':kayit' 	  => $kayit,		
						':stat' => $stat,
						':stats' => $stats,
						':bugkurtar' => $bugkurtar,
						':hesapno' => $hesapno,
						':istatistik' => $deger,
						':genel' => $deger1,
						':unuttum'		  => $unuttum);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}	

	public function ayaryap($oyunismi,$oyunlogo,$levelcap,$masterycap,$silk,$irk,$exprate,$sprate,$facebook,$twitter,$google,$skype,$youtube,$kapasite,$baslangic,$fake_ch,$fake_eu,$fake_total){
	
		$query = $this->link->db_conn_pann->prepare("UPDATE Siteayar SET oyunismi = :oyunismi,oyunlogo = :oyunlogo,levelcap = :levelcap,masterycap = :masterycap,silk = :silk,irk = :irk,exprate = :exprate, sprate = :sprate, facebook = :facebook, twitter = :twitter, google = :google, skype = :skype, youtube = :youtube ,kapasite = :kapasite,baslangic = :baslangic,ch_fake = :ch_fake, eu_fake =:eu_fake, total_fake =:total_fake");
		$values = array(':oyunismi' 	  => $oyunismi,
						':oyunlogo' 	  => $oyunlogo,
						':levelcap' => $levelcap,
						':masterycap'	  => $masterycap,
						':silk'	  => $silk,
						':irk'	  => $irk,
						':exprate'	  => $exprate,
						':sprate'	  => $sprate,
						':facebook'	  => $facebook,
						':twitter'	  => $twitter,
						':google'	  => $google,
						':skype'	  => $skype,
						':youtube'	  => $youtube,
						':kapasite'	  => $kapasite,
						':eu_fake'	  => $fake_eu,
						':ch_fake'	  => $fake_ch,
						':total_fake'	  => $fake_total,
						':baslangic'		  => $baslangic);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
public function uniq_ekle($Unique,$Point){
	
		$query = $this->link->db_conn_pann->prepare("INSERT INTO UniquePoints([Unique],Point) VALUES (:Unique,:Point)");
		$values = array(':Unique' 	  => $Unique,
						':Point'	  => $Point);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function uniquepoint($Unique,$Point){
	
		$query = $this->link->db_conn_pann->prepare("update UniquePoints set [Unique] =:Unique , Point=:Point where [Unique]=:Unique");
		$values = array(':Unique' 	  => $Unique,
						':Point'		  => $Point);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function hesapno_ekle($hesap_sahibi,$sube_no,$hesap_no,$iban,$banka_adi){
		 
			$query = $this->link->db_conn_pann->prepare("INSERT INTO HesapNo(hesapSahibi,subeNo,hesapNo,IBAN,bankaAdi) VALUES(:hesapSahibi,:subeNo,:hesapNo,:IBAN,:bankaAdi)");
			$values = array(':hesapSahibi' => $hesap_sahibi,
							':subeNo' 	   => $sube_no,
							'hesapNo'	   => $hesap_no,
							':IBAN'		   => $iban,
							':bankaAdi'   => $banka_adi);
			$query->execute($values);
			$counts = $query->rowCount();
			return $counts;
	}
	
	public function hesapno_listele(){
	
		$query = $this->link->db_conn_pann->query("SELECT * FROM  HesapNo");
		$result = $query->fetchAll();
		return $result;

	}
	
	public function hesapno_guncelle($hesap_sahibi,$sube_no,$hesap_no,$iban,$banka_adi,$id){
	
		$query = $this->link->db_conn_pann->prepare("UPDATE HesapNo SET
		hesapSahibi=:hesap_sahibi,subeNo=:sube_no,hesapNo=:hesap_no,IBAN=:iban,bankaAdi=:banka_adi WHERE id=:id");
		$values = array(
		':hesap_sahibi' => $hesap_sahibi,
		':sube_no'	  	=> $sube_no,
		':hesap_no'     => $hesap_no,
		':iban'		  	=> $iban,
		':banka_adi'    => $banka_adi,
		':id'		    => $id);
		
		$query->execute($values);
		$result = $query ->fetchAll();
		return result;
	}
	
	

	

	
	public function ipbul($username){
	
	$query =$this->link->db_conn_shard->prepare("Select U.StrUserID As UserName From SRO_VT_SHARD.dbo._User Right Join SRO_VT_SHARD.dbo._Char
On SRO_VT_SHARD.dbo._User.CharID = SRO_VT_SHARD.dbo._Char.CharID
Right Join SRO_VT_ACCOUNT.dbo.TB_User As U
On U.JID = SRO_VT_SHARD.dbo._User.UserJID Where _Char.CharName16 =:username");
	$values = array(':username' => $username );
	$query->execute($values);
	$result = $query->fetchAll();
	return $result;
	
	}
	

	
	public function guild($username){
	
	$query =$this->link->db_conn_shard->prepare("SELECT * FROM _Guild WHERE Name = :username");
	$values = array(':username' => $username );
	$query->execute($values);
	$result = $query->fetchAll();
	return $result;
	
	}
	
	public function guild_update($username,$lvl,$gatheredsp,$mastercommenttitle,$mastercomment,$gold,$rename){
		
		$query =$this->link->db_conn_shard->prepare("UPDATE _Guild SET 
		Name=:username,Lvl=:lvl,GatheredSP=:gatheredsp,mastercommenttitle=:mastercommenttitle,mastercomment=:mastercomment,Gold=:gold WHERE Name=:rename");
		$values = array(':username' => $username,
						':lvl' => $lvl,
						':gatheredsp'    => $gatheredsp,
						':mastercommenttitle'    => $mastercommenttitle,
						':mastercomment'    => $mastercomment,
						':gold'   =>$gold,
						':rename'   => $rename);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	
	public function ref_ekle($ad,$url,$resim){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Sponsor(ad,url,resim) VALUES(:ad,:url,:resim)");
		$values = array(':ad'    =>$ad,
						':url'   =>$url,
						':resim' =>$resim);
		$query->execute($values);
		$counts=$query->rowCount();
		return $counts;
	}
	
	public function ref_listele(){
		
		$query =$this->link->db_conn_pann->query("SELECT * FROM Sponsor");
		$result = $query->fetchAll();
		return $result;
		
	}
	
	public function ref_guncelle($ad,$url,$resim,$id) {
		
		$query =$this->link->db_conn_pann->prepare("UPDATE Sponsor SET ad=:ad,url=:url,resim=:resim WHERE id=:id");
		$values = array(':ad'    => $ad,
						':url'   => $url,
						':resim' => $resim,
						':id'	 => $id);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
		
	}
	
	public function slider_listele(){
		
		$query =$this->link->db_conn_pann->query("SELECT * FROM Slider");
		$result=$query->fetchAll();
		return $result;
	}
	
	public function slider_ekle($baslik,$link,$aciklama,$resim){
		
		$query =$this->link->db_conn_pann->prepare("INSERT INTO Slider(baslik,link,aciklama,resim) VALUES(:baslik,:link,:aciklama,:resim)");
		$values = array(':baslik' 	=> $baslik,
						':link'	  	=> $link,
						':aciklama' => $aciklama,
						':resim'	=> $resim);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	public function slider_update($baslik,$link,$aciklama,$resim,$id){
		
		$query =$this->link->db_conn_pann->prepare("UPDATE Slider SET baslik=:baslik,link=:link,aciklama=:aciklama,resim=:resim WHERE id=:id");
		$values = array(':baslik' 	=> $baslik,
				':link'	  	=> $link,
				':aciklama' => $aciklama,
				':resim'	=> $resim,
				':id'		=> $id);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function pay_listele(){
		
		$query = $this->link->db_conn_account->query("SELECT * FROM fy_pay");
		$result = $query->fetchAll();
		return $result;	
		
	}
	
	public function pay_ekle($ad,$link,$resim){
		
		$query = $this->link->db_conn_account->prepare("INSERT INTO fy_pay(ad,link,resim) VALUES(:ad,:link,:resim)");
		$values = array(':ad'    => $ad,
						':link'  => $link,
						':resim' => $resim);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	public function pay_update($ad,$link,$resim,$id){
		
		$query = $this->link->db_conn_account->prepare("UPDATE fy_pay SET ad=:ad,link=:link,resim=:resim WHERE id=:id");
		$values = array(':ad'    => $ad,
						':link'  => $link,
						':resim' => $resim,
						':id'	 => $id);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function server_tanitim($icerik){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Tanitim SET icerik=:icerik");
		$values = array(':icerik' =>$icerik);
		$query->execute($values);
		$counts =$query->rowCount();
		return $counts;
	}
	
	public function server_ulasim($icerik){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Tanitim SET icerik=:icerik");
		$values = array(':icerik' =>$icerik);
		$query->execute($values);
		$counts =$query->rowCount();
		return $counts;
	}
	
	
	
		public function ozellik_tanitim($icerik){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Ozellik SET icerik=:icerik");
		$values = array(':icerik' =>$icerik);
		$query->execute($values);
		$counts =$query->rowCount();
		return $counts;
	}
	
	public function ozellik_ulasim($icerik){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Ozellik SET icerik=:icerik");
		$values = array(':icerik' =>$icerik);
		$query->execute($values);
		$counts =$query->rowCount();
		return $counts;
	}
	
	public function down_ekle($ad,$link,$boyut,$resim){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Download(ad,link,boyut,resim) VALUES(:ad,:link,:boyut,:resim)");
		$values = array(':ad'    => $ad,
						':link'  => $link,
						':boyut' => $boyut,
						':resim' => $resim);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	public function down_listele(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Download");
		$result = $query->fetchAll();
		return $result;	
		
	}
	
	public function down_update($ad,$link,$id){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Download SET ad=:ad,link=:link WHERE id=:id");
		$values = array(':ad'    => $ad,
						':link'  => $link,
						':id'	 => $id);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function epin_ekle($epin,$sec,$silk = 0,$TL = 0,$durum = 1){
		
		$query =$this->link->db_conn_pann->prepare("INSERT INTO Epins(epin,sec,silk,TL,durum) VALUES(:epin,:sec,:silk,:TL,:durum)");
		$values = array(':epin'  => $epin,
						':sec'   => $sec,
						':silk'	 => $silk,
						':TL'	 => $TL,
						':durum' => $durum);
						
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}

	public function epin_varmi($epin){
		
		 $query = $this->link->db_conn_pann->prepare("SELECT * FROM Epins WHERE epin = :epin");
		 $values = array(':epin' => $epin);
		 $query->execute($values);
		 $result = $query->fetchAll();
		 return $result;
	}
	
	public function epin_listele(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Epins");
		$result = $query->fetchAll();
		return $result;	
		
	}
	
	public function epin_update($epin,$sec,$silk=0,$tl=0,$id){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Epins SET epin=:epin,sec=:sec,silk=:silk,TL=:TL WHERE id=:id");
		$values = array(':epin'  => $epin,
						':sec'	 => $sec,
						':silk'  => $silk,
						':TL'	 => $tl,
						':id'    => $id);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	public function gm_login_log($username,$tarih,$location,$ip){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO GMLog(username,tarih,location,ip) VALUES(:username,:tarih,:location,:ip)");
		$values = array(':username'  => $username,
						':tarih'	 => $tarih,
						':location'	 => $location,
						':ip'		 => $ip);
						
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function market_item_ekle($item_adi,$item_kodu,$arti_miktari,$pot_sc_miktari,$silk,$tl,$resim,$sira){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Market(item_adi,item_kodu,arti_miktari,pot_sc_miktari,types,fiyat,resim,sira,type) VALUES(:item_adi,:item_kodu,:arti_miktari,:pot_sc_miktari,:silk,:tl,:resim,:sira,'1')");
		$values = array(':item_adi'        => $item_adi,
						':item_kodu'       => $item_kodu,
						':arti_miktari'    => $arti_miktari,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':silk'			   => $silk,
						':tl'			   => $tl,
						':resim'			   => $resim,
						':sira'		   => $sira);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	public function market_gold_ekle($item_adi,$pot_sc_miktari,$silk,$tl,$resim,$sira){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Market(item_adi,item_kodu,arti_miktari,pot_sc_miktari,types,fiyat,resim,sira,type) VALUES(:item_adi,'NULL','0',:pot_sc_miktari,:silk,:tl,:resim,:sira,'3')");
		$values = array(':item_adi'        => $item_adi,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':silk'			   => $silk,
						':tl'			   => $tl,
						':resim'			   => $resim,
						':sira'		   => $sira);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}	

	public function market_sp_ekle($item_adi,$pot_sc_miktari,$silk,$tl,$resim,$sira){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Market(item_adi,item_kodu,arti_miktari,pot_sc_miktari,types,fiyat,resim,sira,type) VALUES(:item_adi,'NULL','0',:pot_sc_miktari,:silk,:tl,:resim,:sira,'2')");
		$values = array(':item_adi'        => $item_adi,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':silk'			   => $silk,
						':tl'			   => $tl,
						':resim'			   => $resim,
						':sira'		   => $sira);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}	
	
		public function market_silk_ekle($item_adi,$pot_sc_miktari,$silk,$tl,$resim,$sira){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO Market(item_adi,item_kodu,arti_miktari,pot_sc_miktari,types,fiyat,resim,sira,type) VALUES(:item_adi,'NULL','0',:pot_sc_miktari,:types,:tl,:resim,:sira,'4')");
		$values = array(':item_adi'        => $item_adi,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':types'           => $silk,
						':tl'			   => $tl,
						':resim'			   => $resim,
						':sira'		   => $sira);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
		
	}
	
	public function market_listele(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Market order by sira asc");
		$result = $query->fetchAll();
		return $result;
	}
	
	public function market_update($item_adi,$item_kodu,$arti_miktari,$pot_sc_miktari,$silk,$tl,$resim,$sira,$id){
		
		$query = $this->link->db_conn_pann->prepare("UPDATE Market SET item_adi = :item_adi, item_kodu = :item_kodu, arti_miktari = :arti_miktari, pot_sc_miktari = :pot_sc_miktari, silk = :silk, tl=:tl, resim =:resim, sira =:sira WHERE id=:id");
		$values = array(':item_adi'        => $item_adi,
						':item_kodu'       => $item_kodu,
						':arti_miktari'    => $arti_miktari,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':silk'			   => $silk,
						':tl'			   => $tl,
						':resim'		   => $resim,
						':sira'		   => $sira,
						':id'			   => $id);
		$counts = $query->execute($values);
		return $counts;
	}
	
	public function resim_ekle($durum,$link){
		
		$query = $this->link->db_conn_pann->query("INSERT INTO Galeri(durum,link) VALUES('$durum','$link') ");
		$result = $query->rowCount();
		return $result;
		
	}
	
	
	public function toplam_blog(){
		
	$query = $this->link->db_conn_pann->query(" SELECT COUNT (*) FROM Haberler ");
	$result = $query->fetchAll();
	echo $result[0][0];
		
	}
	
	public function bug($a,$b,$c,$d,$kadi){
		
	$query = $this->link->db_conn_shard->query("UPDATE _Char SET  LatestRegion=$a,PosX=$b,PosY=$c,PosZ=$d WHERE CharName16='$kadi' ");
	$count = $query->rowCount();
	return $count;
		
	}

	public function bug2($a,$b,$c,$d){
		
	$query = $this->link->db_conn_shard->query("UPDATE _Char SET  LatestRegion=$a,PosX=$b,PosY=$c,PosZ=$d");
	$count = $query->rowCount();
	return $count;
		
	}
	
	} // sınıf sonu
function anti_injection($Ticket) {
	$Ticket = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Ticket);
	$Ticket = trim($Ticket);
	$Ticket = addslashes($Ticket);
	$Ticket = stripslashes($Ticket);
	$Ticket = str_replace("'", "''", $Ticket);

   return $Ticket;
}  	