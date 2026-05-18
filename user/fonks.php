<?php
session_start();

include('lib/paginiation.php');
$pgn = new Pagenation();
include('../fonksiyonlar/item_stats.class.php');

//print_r($_SESSION);
include('../fonksiyonlar/users.php');
$users=new Users();


if(isset($_POST['_token'])){
if($_SESSION['_token'] == $_POST['_token']){
if(isset($_SESSION['guardf'])){	
if(isset($_POST) && !empty($_POST)){
	$r_test = $users->link->db_conn_pann->query("select * from Bolum");
	$bolumayar = $r_test->fetchAll();
//Bug Kurtarma Başladı			
					if(isset($_POST['bugkurtar'])){
						
					if($bolumayar[0]["bugkurtar"] == 1){
					$charname = anti_injection(htmlspecialchars($_POST['charname']));
					$tarih = date("d.m.Y H:i:s");
					$username=$_SESSION['username'];
					$fiyat="0";
				$job_checket = $users->link->db_conn_shard->query("select a.CharID,a.CharName16,a.CurLevel,(CASE c.ItemID WHEN 0 THEN 0 ELSE 1 END) as JobDurum from _Char a,_User b,_Inventory c where a.CharID=b.CharID and b.UserJID='".$_SESSION['JID']."' and a.CharName16='".$charname."' and a.CharID=c.CharID and c.Slot=8");
				$job_fecth = $job_checket->fetchAll();
					
					if(empty($charname)){
						
					echo 'bosalankur';
										
					}else if($users->CharisTrue($charname) == 0){
					
					echo 'karaktersiz';			
					
					}else if($job_fecth[0]['JobDurum'] == "1"){
					
					echo 'models';
					
					}else{
						$type="Karakter Kurtar";
						$market_log = $users->SpecialLog($charname,$type,$username,$fiyat,$fiyat,$tarih);						
						$bug_k_suc = $users->bugtankurtar($charname);

						if($bug_k_suc == 1)
						{

						echo 'bugkrtok';
							
						}else{
							
							echo "<strong style='color:#2ac0ff;font-size:15px'>BEKLENMEDİK HATA</strong>";
						}
					}
									}else{
	
								echo'bugkapalı';
	
						}
				}//Bug Kurtarma Bitti 
				
//Stat Sıfırlama Başladı 				
		if(isset($_POST['statsıfırla']))
		{
			
		if($bolumayar[0]["stat"] == 1){
			//Fiyatlar Başladı			
				$p_test = $users->link->db_conn_pann->query("select * from SpecialFiyat");
				$marketitem = $p_test->fetchAll();
//Fiyatlar Bitti

			$charname=anti_injection(htmlspecialchars($_POST['charname']));
			
			 	$job_checket = $users->link->db_conn_pann->query("select Status,Charname from _OnlineOffline where CharName='$charname'");
				$job_fecth = $job_checket->fetchAll();
			if(empty($charname)){
				 echo "bosalankur";
			
			}else if($users->CharisTrue($charname) == 0){
				echo "karaktersiz";

			}else if($job_fecth[0]['Status'] == "Online"){
				echo 'models';
			
			}else{
				$charvarmi = $users->CharInfo($charname);
				if($charvarmi == 1){

					$silk=$marketitem[0]['statsilk'];
					$tl=$marketitem[0]['stattl'];
					$JID=$_SESSION['JID'];
					$username=$_SESSION['username'];
					$silkmiktari = $users->silk($username);
					$guncelsilk=$silkmiktari[0]['silk_own'];
					$gunceltl =$_SESSION['tlmiktari'];
					$tarih = date("d.m.Y H:i:s");

				     if($_SESSION['silk'] >= $silk && $_SESSION['tlmiktari'] >= $tl)
					 {
						 
						 $yenisilk = $guncelsilk - $silk;
						 $yenitl  = $_SESSION['tlmiktari'] - $tl;
						
						 
						 $silkupdate = $users->link->db_conn_account->query("UPDATE SK_Silk SET silk_own = '$yenisilk' WHERE JID='$JID' ");
						 $tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET credit = '$yenitl' WHERE StrUserID = '$username' ");
						 
						 // belki tow count ile kontrol etmem gerek neyse hallederiz
						 // bu and olayına bakkkkk bi hata var gibi
						 if($silkupdate == 1 AND $tlupdate == 1){
							 
							 $_SESSION['silk']=$yenisilk;
							 $_SESSION['tlmiktari']=$yenitl;
							$type="Stat Sıfırlama";
							$market_log = $users->SpecialLog($charname,$type,$username,$tl,$silk,$tarih);							 
							$ekle = $users->link->db_conn_shard->prepare("DECLARE @CharName varchar(255)
        DECLARE @CharID INT
        SET @CharName=:charname
        SELECT @CharID = CharID FROM _Char WHERE CharName16=@CharName
		declare @Strength int 
            declare @Intellect int 
            declare @MaxLevel int 
            declare @RemainStatPoint int 
            select @MaxLevel = MaxLevel from SRO_VT_SHARD.._Char where CharID = @CharID
            set @RemainStatPoint = (@MaxLevel*3)-3 
            set @MaxLevel = @MaxLevel+19 
            UPDATE SRO_VT_SHARD.._Char SET Strength=@MaxLevel, Intellect=@MaxLevel, RemainStatPoint=@RemainStatPoint WHERE CharID=@CharID
			DELETE FROM SRO_VT_SHARD.dbo._CharSkill WHERE SkillID BETWEEN '8092' AND '8122' AND CharID = @CharID");
									$values = array(':charname' => $charname);		
								$ekle->execute($values);
								
									if($ekle->rowCount() == 1)
									{
							
										echo "bugkrtok";
										
									}else{
										
										
										echo "cantabos";
										$silkupdate = $users->link->db_conn_account->query("UPDATE SK_Silk SET silk_own = '$guncelsilk' WHERE JID='$JID' ");
										$tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET credit = '$gunceltl' WHERE StrUserID = '$username' ");
										$_SESSION['silk']=$guncelsilk;
										$_SESSION['tlmiktari']=$gunceltl;
									}
							 
							 }else{
								 
								  echo "gs";
							 }
						 
						 
					 }else{
						 
						 
						 echo "gs";
					 }
					
				}else
				{
					
					 echo "<script type='text/javascript'> alerta('$karakteradi Bu isimde bir karakter bulunamadı...', 'error');</script>";
				}
				
				 
				
			}
				}else{
	
	echo'statkapalı';
	
}
		}//Stat Sıfırlama Bitti 

//Skill Sıfırlama Başladı 				
		if(isset($_POST['skillsıfırla']))
		{
		if($bolumayar[0]["stats"] == 1){
			//Fiyatlar Başladı			
				$p_test = $users->link->db_conn_pann->query("select * from SpecialFiyat");
				$marketitem = $p_test->fetchAll();
//Fiyatlar Bitti

			$charname=anti_injection(htmlspecialchars($_POST['charname1']));
	
			 	$job_checket = $users->link->db_conn_pann->query("select Status,Charname from _OnlineOffline where CharName='$charname'");
				$job_fecth = $job_checket->fetchAll();
			if(empty($charname)){
				 echo "bosalankur";
			
			}else if($users->CharisTrue($charname) == 0){
				echo "karaktersiz";

			}else if($job_fecth[0]['Status'] == "Online"){
				echo 'models';
			
			}else{
				$charvarmi = $users->CharInfo($charname);
				if($charvarmi == 1){

					$silk=$marketitem[0]['skillsilk'];
					$tl=$marketitem[0]['skilltl'];
					$JID=$_SESSION['JID'];
					$username=$_SESSION['username'];
					$silkmiktari = $users->silk($username);
					$guncelsilk=$silkmiktari[0]['silk_own'];
					$gunceltl =$_SESSION['tlmiktari'];
					$tarih = date("d.m.Y H:i:s");

				     if($_SESSION['silk'] >= $silk && $_SESSION['tlmiktari'] >= $tl)
					 {
						 
						 $yenisilk = $guncelsilk - $silk;
						 $yenitl  = $_SESSION['tlmiktari'] - $tl;
						
						 
						 $silkupdate = $users->link->db_conn_account->query("UPDATE SK_Silk SET silk_own = '$yenisilk' WHERE JID='$JID' ");
						 $tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET credit = '$yenitl' WHERE StrUserID = '$username' ");
						 
						 // belki tow count ile kontrol etmem gerek neyse hallederiz
						 // bu and olayına bakkkkk bi hata var gibi
						 if($silkupdate == 1 AND $tlupdate == 1){
							 
							 $_SESSION['silk']=$yenisilk;
							 $_SESSION['tlmiktari']=$yenitl;
							$type="Skill Sıfırlama";
							$market_log = $users->SpecialLog($charname,$type,$username,$tl,$silk,$tarih);								 
							$ekle = $users->link->db_conn_shard->prepare("DECLARE @CharName varchar(255)
        DECLARE @CharID INT
	declare @TotalSP int, @TotalSPMastery int 
	declare @ExtraSp int = 5000000 -- Extra Sp miktarını buradan ayarlayabilirsiniz.
        SET @CharName=:charname
        SELECT @CharID = CharID FROM _Char WHERE CharName16=@CharName
	SELECT @TotalSP = SUM(SRO_VT_SHARD.dbo._RefSkill.ReqLearn_SP) FROM SRO_VT_SHARD.dbo._RefSkill, SRO_VT_SHARD.dbo._CharSkill WHERE SRO_VT_SHARD.dbo._RefSkill.ID=SRO_VT_SHARD.dbo._CharSkill.SkillID AND SRO_VT_SHARD.dbo._CharSkill.CharID=@CharID AND SRO_VT_SHARD.dbo._RefSkill.ReqCommon_MasteryLevel1 <= '140'
	SELECT @TotalSPMastery = SUM(SRO_VT_SHARD.dbo._RefLevel.Exp_M) FROM SRO_VT_SHARD.dbo._CharSkillMastery, SRO_VT_SHARD.dbo._RefLevel WHERE SRO_VT_SHARD.dbo._RefLevel.Lvl=SRO_VT_SHARD.dbo._CharSkillMastery.Level AND SRO_VT_SHARD.dbo._CharSkillMastery.CharID=@CharID AND SRO_VT_SHARD.dbo._CharSkillMastery.Level <= '140' 
	UPDATE SRO_VT_SHARD.dbo._Char SET RemainSkillPoint=RemainSkillPoint+@ExtraSp WHERE CharID=@CharID 
	DELETE SRO_VT_SHARD.dbo._CharSkill FROM SRO_VT_SHARD.dbo._RefSkill, SRO_VT_SHARD.dbo._CharSkill WHERE SRO_VT_SHARD.dbo._RefSkill.ID=SRO_VT_SHARD.dbo._CharSkill.SkillID AND SRO_VT_SHARD.dbo._CharSkill.CharID=@CharID AND SRO_VT_SHARD.dbo._RefSkill.ReqCommon_MasteryLevel1 <= '140' AND SRO_VT_SHARD.dbo._RefSkill.ID NOT IN (1,70,40,2,8421,9354,9355,11162,9944,8419,8420,11526,10625) 
	UPDATE SRO_VT_SHARD.dbo._CharSkillMastery SET Level='0' WHERE CharID=@CharID AND Level <= '140'");
									$values = array(':charname' => $charname);		
								$ekle->execute($values);

									if($ekle->rowCount() == 1)
									{
					
										echo "bugkrtok";
										
									}else{
										
										
										echo "cantabos";
										$silkupdate = $users->link->db_conn_account->query("UPDATE SK_Silk SET silk_own = '$guncelsilk' WHERE JID='$JID' ");
										$tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET credit = '$gunceltl' WHERE StrUserID = '$username' ");
										$_SESSION['silk']=$guncelsilk;
										$_SESSION['tlmiktari']=$gunceltl;
									}
							 
							 }else{
								 
								  echo "gs";
							 }
						 
						 
					 }else{
						 
						 
						 echo "gs";
					 }
					
				}else
				{
					
					 echo "<script type='text/javascript'> alerta('$karakteradi Bu isimde bir karakter bulunamadı...', 'error');</script>";
				}
				
				 
				
			}
		}else{
	
	echo'skillkapalı';
	
}
		}//Skill Sıfırlama Bitti 
?>
<?php
if(isset($_POST['settings'])){
	
		$jid=anti_injection(htmlspecialchars($_POST['jid']));
		$deger1=anti_injection(htmlspecialchars($_POST['deger1']));
		$deger2 =anti_injection(htmlspecialchars($_POST['deger2']));
		$deger3=anti_injection(htmlspecialchars($_POST['deger3']));

		
			if($users->settingsinfo($jid) == 0){
			$fy_userpass =$users->user_settings($jid);	
			echo 'bosalankur';

		}else{
		$ekle =$users->link->db_conn_pann->query("update user_settings set detay=$deger1 , job=$deger2 , gold=$deger3 where jid=$jid");

	
			if($ekle == 1){
			
				echo 'bugkrtok';
				
			}else{
				
				echo 'bugkpass';
			}
		}

}

if(isset($_POST['tickets'])){
	if($bolumayar[0]["karakter"] == 1){
	$Ticket = $_POST['ticket'];
	$Title = anti_injection(htmlspecialchars($_POST['Title']));
	$captcha = anti_injection($_POST['captcha']);
	$Category = anti_injection($_POST['Category']);
	$time = date('d.m.Y H:i:s');
	$Owner = $_SESSION['username'];
	
	// filter the ticket content
	$Ticket = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Ticket);
	$Ticket = trim($Ticket);
	$Ticket = addslashes($Ticket);
	$Ticket = stripslashes($Ticket);
	$Ticket = str_replace("'", "''", $Ticket);
	
	if(empty($Title) || empty($captcha) || empty($Ticket)){
	
	 echo "bosalankur";

	}else if(strlen($Ticket) < 1) {
		
		echo 'hane';
	
	}else if($_POST['captcha'] != $_SESSION['captcha']) {
		
		echo 'bugkpass';

	}else{
		
$ekle =$users->link->db_conn_pann->query("INSERT INTO Panel.._Tickets values ('$Owner','$Category','$Title','$Ticket','0','$time','$time')");


			if($ekle == 1){
			
				echo 'bugkrtok';
				
			}else{
				
				echo 'bugkpass';
			}

}
			}else{
				
				echo 'kapalı';
			}
}

if(isset($_POST['addtickets'])){
	
	$Ticket = $_POST['ticket'];
	$captcha = anti_injection($_POST['captcha']);
	$id = $_POST['id'];
	$time = date('d.m.Y H:i:s');
	$Owner = $_SESSION['username'];
	
	// filter the ticket content
	$Ticket = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Ticket);
	$Ticket = trim($Ticket);
	$Ticket = addslashes($Ticket);
	$Ticket = stripslashes($Ticket);
	$Ticket = str_replace("'", "''", $Ticket);
	
	if(empty($captcha) || empty($Ticket)){
	
	 echo "bosalankur";

	}else if(strlen($Ticket) < 1) {
		
		echo 'hane';
	
	}else if($_POST['captcha'] != $_SESSION['captcha']) {
		
		echo 'bugkpass';

	}else{
$ekles =$users->link->db_conn_pann->query("update _Tickets set Status = 0 where ID=$id");			
$ekle =$users->link->db_conn_pann->query("INSERT INTO Panel.._TicketsAnswer values ('$id','$Owner','$Ticket','Görülmedi','$time')");


			if($ekle == 1){
			
				echo 'bugkrtok';
				
			}else{
				
				echo 'bugkpass';
			}

}
}
if(isset($_POST['ticketdown'])){
	$id =(int)$_POST['id'];
	
$ekle =$users->link->db_conn_pann->query("update _Tickets set Status = 2 where ID=$id");


			if($ekle == 1){
			
				echo 'skillok';
				
			}else{
				
				echo 'hata';
} }
}
}}}
//GET 
if(isset($_GET) && !empty($_GET)){ if(isset($_GET['page'])){ 
?>
              <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
		<th>#</th>
          
		<th>Kategori</th>			
            <th>Konu</th>
			
            <th>Durum</th>
	
            <th>Tarih</th>
			 <th>Güncellenme Tarihi</th>
            <th>İşlem</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 5;
		$toplam_icerik = $users->toplam_ticket();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["page"]) ? $_GET["page"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $users->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY Date desc) AS Row, * FROM _Tickets where StrUserID = '$_SESSION[username]') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $Data){

		  $rank = 1;
		  									$ID = $Data['ID'];
									
									$Title = $Data['Title'];//Ticekt title
									$kate = $Data['Category'];//Ticekt title
									//Ticket status
									if ($Data['Status'] == 0){
										$Status = "Cevaplanmamış";
									} else if ($Data['Status'] == 2){
										$Status = "Kapatılmış";
									}else {
										$Status = "Cevaplanmış";
									}
									$Date = $Data['Date'];
$Date2 = $Data['UpdateDate']									?>
		                                    <tr class="order">
									    <!--Item Slot-->
										<td><?php echo $Data['Row']; ?></td>
										
										<td><?php echo $kate;?></td>
										<td><?php echo $Title;?></td>
										<td><?php echo $Status;?></td>
										<td><?php echo $Date;?></td>
										<td><?php echo $Date2;?></td>
										<td>
                                 
                        <button class="btn btn-success waves-effect waves-light" title="G&ouml;r&uuml;nt&uuml;le"
                                onclick="window.location.href = 'showticket.php?id=<?php echo $ID ; ?>';">
                            <i class="fa fa-eye"></i>
                        </button>
						
                                                           
                </td>
            </tr>
 
									
		  <?php } ?>
                </tbody>
    </table>
</div>

                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate"><ul class="pagination"><?php $pgn->Pagination($getfonk, $toplam_sayfa);?><li class="paginate_button page-item "></ul></div></div></div></div>
   <div class="col-sm-2">
        <div class="pull-right" style="padding: 20px 0">
            <a class="btn btn-primary"
               href="bildirimyolla.php">
                <i class="fa fa-check"></i> Yeni
            </a>
        </div>
    </div>
</div>

<?php } if(isset($_GET['pageozellog'])){
?>
                 <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
			<th>#</th>         
			<th>Karakter Adı</th>			
            <th>İşlem</th>			
            <th>TL Fiyatı</th>
            <th>Silk Fiyatı</th>
            <th>Tarih</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 25;
		$toplam_icerik = $users->toplam_ozellog();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pageozellog"]) ? $_GET["pageozellog"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $users->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY tarih desc) AS Row, * FROM SpecialLog where username = '$_SESSION[username]') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		  foreach($blogg as $Data){	
		  ?>
		                                    <tr class="order">
									    <!--Item Slot-->
										<td><?php echo $Data['Row']; ?></td>
										
										<td><?php echo $Data['oyuncu']; ?></td>
										<td><?php echo $Data['type']; ?></td>
										<td><?php echo $Data['fiyattl']; ?></td>
										<td><?php echo $Data['fiyatsilk']; ?></td>
										<td><?php echo $Data['tarih']; ?></td>

            </tr>
 
									
		  <?php } ?>
                </tbody>
    </table>
</div>

                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate"><ul class="pagination"><?php $pgn->Pagination($getfonk, $toplam_sayfa);?><li class="paginate_button page-item "></ul></div></div></div></div>
<?php } ?>
<?php if(isset($_GET['pagelogm'])){
?>
                   <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
			<th>#</th>         
			<th>Karakter Adı</th>			
            <th>Ürün Adı</th>			
            <th>Ürün Fiyatı</th>
            <th>Tarih</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 25;
		$toplam_icerik = $users->toplam_mozellog();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pagelogm"]) ? $_GET["pagelogm"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $users->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY tarih desc) AS Row, * FROM MarketLog where username = '$_SESSION[username]') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		  foreach($blogg as $Data){	
		  ?>
		                                    <tr class="order">
									    <!--Item Slot-->
										<td><?php echo $Data['Row']; ?></td>
										
										<td><?php echo $Data['karakteradi']; ?></td>
										<td><?php echo $Data['itemadi']; ?></td>
										<td><?php echo $Data['fiyat']; ?></td>
										<td><?php echo $Data['tarih']; ?></td>

            </tr>
 
									
		  <?php } ?>
                </tbody>
    </table>
</div>

                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate"><ul class="pagination"><?php $pgn->Pagination($getfonk, $toplam_sayfa);?><li class="paginate_button page-item "></ul></div></div></div></div>
<?php } ?>

<?php if(isset($_GET['pagelogwheel'])){
?>
                   <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
			<th>#</th>         
			<th>Kullanıcı Adı</th>			
            <th>Ürün Adı</th>			
            <th>Ürün Adeti</th>
			<th>Ürün Artısı</th>
            <th>Tarih</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 25;
		$toplam_icerik = $users->toplam_wozellog();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pagelogwheel"]) ? $_GET["pagelogwheel"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $users->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY tarih desc) AS Row, * FROM WheelLog where username = '$_SESSION[username]') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		  foreach($blogg as $Data){	
		  ?>
		                                    <tr class="order">
									    <!--Item Slot-->
										<td><?php echo $Data['Row']; ?></td>
										
										<td><?php echo $Data['username']; ?></td>
										<td><?php echo $Data['name']; ?></td>
										<td><?php echo $Data['adet']; ?></td>
										<td>+<?php echo $Data['plus']; ?></td>
										<td><?php echo $Data['tarih']; ?></td>

            </tr>
 
									
		  <?php } ?>
                </tbody>
    </table>
</div>

                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate"><ul class="pagination"><?php $pgn->Pagination($getfonk, $toplam_sayfa);?><li class="paginate_button page-item "></ul></div></div></div></div>
<?php } ?>

<?php } ?>