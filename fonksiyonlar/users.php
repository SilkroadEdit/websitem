<?php 
class Users {
		
		public $link;
		
		public function __construct(){

			include('config.php');
			$this->link=new dbConnection();
			$this->link->connect();
			return $this->link;

		}

	public function QueryHasRows($query)
	{
		$checkRows = $this->link->db_conn_account->query($query);
		
		if($checkRows->execute())
		{
			$rows = $checkRows->fetchAll();
			$rowsCount = count($rows);
		}
		If ($rowsCount >= 1) 
		{
			return true;
		} else {
			return false;
		}
	}
	 
	    public function registerUsers($StrUserID,$password,$Email,$address,$regtime,$reg_ip){
		
		 $query = $this->link->db_conn_account->prepare("INSERT INTO TB_User(StrUserID,password,Email,address,regtime,reg_ip,sec_primary,sec_content) VALUES(:StrUserID,:password,:Email,:address,:regtime,:reg_ip,:sec_primary,:sec_content)");
		 $values = array(':StrUserID' => $StrUserID,
						 ':password'  => $password,
						 ':Email'	  => $Email,
						 ':address'   => $address,
						 ':regtime'   => $regtime,
						 ':reg_ip'	  => $reg_ip,
						 'sec_primary'=> 3,
						 'sec_content'=> 3);
		 $query->execute($values);
		 $counts = $query->rowCount();
		 return $counts;
	
	}
	
	public function registerUsers2($username,$pw,$mail,$gs,$ip){
		
		$query = $this->link->db_conn_account->query("INSERT INTO TB_User(StrUserID,password,game_credit,credit,Status,GMrank,Name,Email,sex,address,postcode,phone,regtime,reg_ip,sec_primary,sec_content,AccPlayTime,LatestUpdateTime_ToPlayTime) 
		VALUES('$username','$pw','0','0',NULL,NULL,NULL,'$mail',NULL,'$gs',NULL,'0',NULL,'$ip','3','3','0','0')");
		$counts=$query->rowCount();
		return $counts;
	}
	
	public function start_silk($JID,$silk){
		
		$query = $this->link->db_conn_account->query("INSERT INTO SK_Silk (JID,silk_own,silk_gift,silk_point) VALUES('$JID','$silk',0,0)");
		$counts=$query->rowCount();
		return $counts;
	}
	
	public function LoginUsers($StrUserID,$password){
			$query=$this->link->db_conn_account->query("SELECT * FROM TB_User WHERE StrUserID = '$StrUserID' and password = '$password'");
			$rowcount=$query->rowCount();
			return $rowcount;
	}
	

	
	public function GetUserInfo($StrUserID){
			
			$query = $this->link->db_conn_account->query("SELECT * FROM TB_User WHERE StrUserID = '$StrUserID'");
			$rowcount = $query->rowCount();
			if($rowcount == true){
				$result = $query->fetchAll();
				return $result;
			}else{
			
				return $rowcount;
			}
	}

	 public function notices($charname){

		$query=$this->link->db_conn_pann->query("select count(*) as Ticket from _Tickets where Status = 1 and StrUserID = '$charname'");
		foreach($query as $row)
		{
			if($row['Ticket']==0) {
				
			}else{
				return $row['Ticket'];
			}
			
		}
		
	 }
	
	 public function onlineuser($fake=1){
	 
		$query=$this->link->db_conn_account->query("SELECT TOP 1 nUserCount FROM _ShardCurrentUser ORDER BY dLogDate DESC");
		foreach($query as $row)
		{
			return $row['nUserCount'] + $fake;
		}
		
	 }
		//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function fortressJangan(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 1");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "<a id='dumb-button' onclick='return false;' >Hiç Kimse</a>"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
			//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function fortressJangan1(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 1");	
		foreach($query as $row){

			  return $id=$row['GuildID'];		  
		}
	
	}
	
	public function fortressHotan(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 3");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "<a id='dumb-button' onclick='return false;' >Hiç Kimse</a>"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
				//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function fortressHotan1(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 3");	
		foreach($query as $row){

			  return $id=$row['GuildID'];		  
		}
	
	}
	
	public function fortressBandit(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 6");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "<a id='dumb-button' onclick='return false;' >Hiç Kimse</a>"; 
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
					//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function fortressBandit1(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 6");	
		foreach($query as $row){

			  return $id=$row['GuildID'];		  
		}
	
	}
	
	public function fortressConstantinople(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 4");	
		foreach($query as $row){

			  $id=$row['GuildID'];		  
		}
		if(@$id == 0){ 
		
			return "<a id='dumb-button' onclick='return false;' >Hiç Kimse</a>";  
			
		}else{
			$query2=$this->link->db_conn_shard->query("SELECT Name FROM _Guild WHERE ID = $id");
			
			foreach($query2 as $row2){
			
				return $jangan=$row2['Name'];
			}
		}
	}
	
						//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function fortressConstantinople1(){
	
		$query=$this->link->db_conn_shard->query("SELECT GuildID FROM _SiegeFortress WHERE FortressID = 4");	
		foreach($query as $row){

			  return $id=$row['GuildID'];		  
		}
	
	}
	
	public function toplam_icerik(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM Haberler");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_ticket(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM Panel.._Tickets where StrUserID = '$_SESSION[username]'");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_ozellog(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM Panel..SpecialLog where username = '$_SESSION[username]'");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_mozellog(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM Panel..MarketLog where username = '$_SESSION[username]'");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}

	public function toplam_wozellog(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM Panel..WheelLog where username = '$_SESSION[username]'");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}
	
		public function toplam_stats(){
		
		$query = $this->link->db_conn_pann->query("SELECT COUNT(*) AS toplam FROM _OnlineOffline");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}
	
	public function referans(){
		
		$query =$this->link->db_conn_pann->query("SELECT * FROM Sponsor ");
		$result = $query->fetchAll();
		return $result;
		
	}
	
	public function slider_listele(){
		
		$query =$this->link->db_conn_pann->query("SELECT * FROM Slider");
		$result=$query->fetchAll();
		return $result;
	}
	
	public function pay_listele(){
		
		$query = $this->link->db_conn_account->query("SELECT * FROM fy_pay");
		$result = $query->fetchAll();
		return $result;	
		
	}
	
	
	public function blog_sorgu($id){
		
		$query =$this->link->db_conn_pann->prepare("SELECT * FROM Haberler WHERE id=:id");
		$values = array(':id' => $id);
		$query->execute($values);
		$result = $query->fetchAll();
		return $result;
	}
	
	public function hesapno_listele(){
	
		$query = $this->link->db_conn_pann->query("SELECT * FROM  HesapNo");
		$result = $query->fetchAll();
		return $result;

	}
	public function server_tanitim(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Tanitim");
		$result = $query->fetchAll();
		return $result;
	}
	
		public function server_ozellik(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Ozellik");
		$result = $query->fetchAll();
		return $result;
	}
	
	public function server_ulasim(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM iletisim");
		$result = $query->fetchAll();
		return $result;
	}
	
	public function down_listele(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Download");
		$result = $query->fetchAll();
		return $result;	
		
	}
	
	public function silk($username){
	
	$query = $this->link->db_conn_account->prepare("SELECT  JID, StrUserID FROM TB_User WHERE StrUserID = :username");
	$values = array(':username' => $username);
	$query->execute($values);
	$result = $query ->fetchAll();
	@$JID = $result[0][0];
	
	$query2 = $this->link->db_conn_account->prepare("SELECT silk_own FROM SK_Silk WHERE JID = :JID");
	$values2 =array(':JID' => $JID);
	$query2->execute($values2);
	$result2= $query2->fetchAll();
	return $result2;
		
	}
	
	public function epin_listele($username){
		
		$query = $this->link->db_conn_account->prepare("SELECT * FROM fy_epin WHERE username = :username");
		$values = array(':username' => $username);
		$query -> execute($values);
		$result = $query->fetchAll();
		return $result;	
		
	}
	
	public function epin_kontrol($epin,$sec){
		
		$sorgu = $this->link->db_conn_account->prepare("SELECT * FROM fy_epin WHERE epin =:epin AND sec = :sec");
		$values = array(':epin' => $epin,
						':sec' => $sec);
		$sorgu->execute($values);
		$rowcount = $sorgu->rowCount();
		if($rowcount == true){
			$result = $sorgu->fetchAll();
			return $result;
		}else{
		
			return $rowcount;
		}
	}
	
		public function epin_onay($addsilk,$JID,$addtl,$username,$tarih,$epin){
		
	$query1 = $this->link->db_conn_account->prepare("UPDATE SK_Silk SET silk_own = silk_own + :addsilk WHERE JID = :JID");
	$values1 = array(':addsilk' => $addsilk,
					':JID'		=> $JID);
	$query1->execute($values1);
	$rc1= $query1->rowCount();
	
		// silkroadın vt sine ...  o kadar kod yazdırdı bana :D
	$tl = $this->link->db_conn_account->query("SELECT credit FROM TB_User WHERE JID = $JID");
	$astl = $tl->fetchAll();
	$eskitl = $astl[0]['credit'];
	$yenitl = $eskitl + $addtl;
	
	$query2 = $this->link->db_conn_account->prepare("UPDATE TB_User SET credit = :addtl WHERE JID = :JID");
	$values2 = array(':addtl'	 => $yenitl,
					 ':JID'		=> $JID);
	$query2->execute($values2);
	$rc2= $query2->rowCount();
	
	$query3 = $this->link->db_conn_account->prepare("UPDATE fy_epin SET durum = 0,username=:username,tarih=:tarih WHERE epin = :epin");
	$values3 = array(':username'  => $username,
				   ':tarih'		=> $tarih,
				   ':epin'		=> $epin);
	$query3->execute($values3);
	$rc3= $query3->rowCount();
	
		if($rc1 == 1  AND $rc2 == 1 AND $rc3 == 1){
			
			return  1;
			
		}else{
			
			return 0;
		}
	}
	
	public function user_login_log($username,$tarih,$location,$ip){
		
		$query = $this->link->db_conn_pann->prepare("INSERT INTO UserLog(username,tarih,location,ip) VALUES(:username,:tarih,:location,:ip)");
		$values = array(':username'  => $username,
						':tarih'	 => $tarih,
						':location'	 => $location,
						':ip'		 => $ip);
						
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;
	}
	
	public function user_login_log_listele($username){
		
		$query = $this->link->db_conn_pann->query("SELECT TOP 10 * FROM UserLog WHERE username = '$username' ORDER BY tarih DESC");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			$result = $query->fetchAll();
			return $result;
		}else{
		
			return $rowcount;
		} 
	}
	
	public function sifre_degistir($username,$newpw){
		
		$query = $this->link->db_conn_account->prepare("UPDATE TB_User SET password=:newpw WHERE StrUserID=:username");
		$values = array(':newpw' => $newpw,
						':username' => $username);
		$query->execute($values);
		$counts = $query->rowCount();
		return $counts;		
	}
	

	
	public function market_listele(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Market order by sira asc");
		$result = $query->fetchAll();
		return $result;
	}

	public function game_listesi(){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM game_rewards order by ratio asc");
		$result = $query->fetchAll();
		return $result;
	}
	
	public function market_listele_id($id){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM Market WHERE id='$id' ");
		$result = $query->fetchAll();
		return $result;
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

	public function CharInfoss($jid){
	
		$query = $this->link->db_conn_shard->query("SELECT * FROM _User WHERE UserJID='$jid'");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
	}

	public function settingsinfo($charname){
		
		$query = $this->link->db_conn_pann->query("SELECT * FROM user_settings WHERE jid='$charname'");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
	}	
	
	public function CharisTrue($charname){
		$jidim = $_SESSION['JID'];
		$query = $this->link->db_conn_shard->query("select CharName16 from _Char inner join _User on _User.CharID=_Char.CharID where _Char.CharName16='$charname' and _User.UserJID='$jidim'");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
	}
	

	public function MarketLog($karakteradi,$item,$username,$fiyat,$tarih){
		
		$query = $this->link->db_conn_pann->query("INSERT INTO MarketLog(karakteradi,itemadi,username,fiyat,tarih) VALUES ('$karakteradi','$item','$username','$fiyat','$tarih')");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
		
	}

	public function SpecialLog($karakteradi,$type,$username,$fiyattl,$fiyatsilk,$tarih){
		
		$query = $this->link->db_conn_pann->query("INSERT INTO SpecialLog(oyuncu,type,username,fiyattl,fiyatsilk,tarih) VALUES ('$karakteradi','$type','$username','$fiyattl','$fiyatsilk','$tarih')");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
		
	}

	public function CarkLog($username,$name,$total,$plus,$tarih){
		
		$query = $this->link->db_conn_pann->query("INSERT INTO WheelLog(username,name,adet,plus,tarih) VALUES ('$username','$name','$total','$plus','$tarih')");
		$rowcount = $query->rowCount();
		if($rowcount == true){
			
			return 1;
			
		}else{
			
			return 0;
		}
		
	}
	
	//FortressID 1 Jangan - 3 Hotan - 4 Constantinople - 6 Bandit Fortress
	public function  kale_sahibi_guild($id){
		
		$query = $this->link->db_conn_shard->query(" SELECT FortressID FROM _SiegeFortress  WHERE GuildID = '$id' ");
		$row=$query->fetchAll();
		@$fid  = $row[0]['FortressID'];
		
		if ($fid == 1){
			
			return  '<div class="fortress-owner"> <br> <h3>Kale Sahİbİ</h3> </div> <div class="separator-box margin-top"></div>';

			
		}else if ($fid == 3){
			
			return  '<div class="fortress-owner"> <br> <h3>Kale Sahİbİ</h3> </div> <div class="separator-box margin-top"></div>';
			
		}else if ($fid == 4){
			
			return  '<div class="fortress-owner"> <br> <h3>Kale Sahİbİ</h3> </div> <div class="separator-box margin-top"></div>';
			
		}else if ($fid == 6){
			
			return  '<div class="fortress-owner"> <br> <h3>Kale Sahİbİ</h3> </div> <div class="separator-box margin-top"></div>';
		}
		
	}
	

    function reset_pw($username,$email,$gs,$pw){
	$pwx = md5($pw);
	$gsx = sha1(md5($gs));
	$query = $this->link->db_conn_account->query("UPDATE TB_User  SET  password = '$pwx' WHERE StrUserID = '$username'  AND Email = '$email' AND address = '$gsx'");
	$rowcount = $query->rowCount();
	return $rowcount;
	}

    function reset_gs($username,$gs){
	$gsx = sha1(md5($gs));
	$query = $this->link->db_conn_account->query("UPDATE TB_User SET  address = '$gsx' WHERE StrUserID = '$username'");
	$rowcount = $query->rowCount();
	return $rowcount;
	}	
	
	/* guild war için yazdım bu fonksiyonu*/
	function name_back($id) {
		
	$sql = "SELECT Name FROM _Guild WHERE ID = $id ";
	$guild_ismi = $this->link->db_conn_shard->query($sql);
	$guild_ismi_cek = $guild_ismi ->fetchAll();
	return print($guild_ismi_cek[0][0]);
		
	}
	
	public function user_settings($username){
	
		$query = $this->link->db_conn_pann->query("INSERT INTO user_settings VALUES ('$username',1,1,1,Getdate())");
		
	}
	
	/*Bu fonksiyon reklam yap tl kazanın bir parçasıdır */
	public function ref_username($a){
		
		$query=$this->link->db_conn_account->query("SELECT StrUserID FROM TB_User WHERE JID = '$a'");
		$result = $query->fetchAll();
		return $result;
		
	}
	public function update_t_currency(){
		$jid = (int)$_SESSION['JID']; 
		$is_login = @$_SESSION['guardf'];
		if($is_login == 'ok'){
			$query = $this->link->db_conn_account->query("select credit,ISNULL(silk_own, 0) as silk_own from TB_User left join SK_Silk on SK_Silk.JID = TB_User.JID where TB_User.JID = '$jid'");
			$result = $query->fetchAll();
			(int)$_SESSION['tlmiktari'] = $result[0]['credit'];
			(int)$_SESSION['silk'] = $result[0]['silk_own'];
			return true;
		}else{
			return false;
		}
	}
	
	public function toplam_iceriks(){
		
		$query = $this->link->db_conn_log->query("SELECT COUNT(*) AS toplam from SRO_VT_LOG.._StallLog as b,SRO_VT_SHARD.._RefObjCommon as a where a.ID = b.RefID");
		foreach($query as $row)
		{
			return $row['toplam'];
		}
	}


	
		public function get_jid2(){
		$jidim = $_SESSION['JID'];
		$query1 = $this->link->db_conn_shard->query("select count(CharName16) as toplam from _Char inner join _User on _User.CharID=_Char.CharID where _User.UserJID='$jidim'");
		$fetchle = $query1->fetchAll();
		return $fetchle[0]['toplam'];

	}
	public function get_jid(){
		$jidim = $_SESSION['JID'];
		$query1 = $this->link->db_conn_shard->query("select * from _Char inner join _User on _User.CharID=_Char.CharID where _User.UserJID='$jidim'");
		$fetchle = $query1->fetchAll();
		return $fetchle;

	}
	
	public function bugtankurtar($charname){
	$query = $this->link->db_conn_shard->prepare("UPDATE _Char SET  LatestRegion='24431',PosX='1223',PosY='2034.56689',PosZ='1312',WorldID='1' WHERE CharName16 = :charname");
	$values = array(':charname' => $charname);
	$query->execute($values);
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