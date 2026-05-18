<?php 
include('reg_users.php');
		$getitem = (int)anti_injection($_POST['item']);
	if(isset($_SESSION['guardf']) && gettype($getitem) !== "string"){
		
		$marketitem=$users->market_listele_id((int)$getitem); 

		
		if(sizeof($marketitem) == 0 ){
			header("Location: index.php");
		die();
		}
		
		if(isset($_POST['buy_item']))
		{ 
			$karakteradi=anti_injection(htmlspecialchars($_POST['char_list']));
			$marketpass=anti_injection(htmlspecialchars($_POST['marketpass']));
			if(empty($karakteradi) ){
				
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata1'];
		echo json_encode($data);
		
			}else if(empty($marketpass)){
				
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata2'];
		echo json_encode($data);
		
			}else if($users->CharisTrue($karakteradi) == 0){
				
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata3'];
		echo json_encode($data);
		
			}else if(md5($marketpass) != $_SESSION['password']){
				
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata4'];
		echo json_encode($data);	
			
			}else{
				$charvarmi = $users->CharInfo($karakteradi);
				if($charvarmi == 1){
					$item_kodu=$marketitem[0]['item_kodu'];
					$miktar=$marketitem[0]['pot_sc_miktari'];
					$arti=$marketitem[0]['arti_miktari'];
					$types=$marketitem[0]['types'];
					$fiyat=$marketitem[0]['fiyat'];
					$ItemType=$marketitem[0]['type'];
					$JID=$_SESSION['JID'];
					$username=$_SESSION['username'];
					$silkmiktari = $users->silk($username);
					$guncelsilk=$silkmiktari[0]['silk_own'];
					$gunceltl =$_SESSION['tlmiktari'];
					$tarih = date("d.m.Y H:i:s");

if($types==1){
	//TL SATIŞ
				     if($_SESSION['tlmiktari'] >= $fiyat)
					 {
						 $yenitl  = $_SESSION['tlmiktari'] - $fiyat;
						
						 $tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET credit = '$yenitl' WHERE StrUserID = '$username' ");

						 if($tlupdate == 1){
							 
							 $_SESSION['tlmiktari']=$yenitl;
							 if($ItemType == 1){
							$ekle = $users->link->db_conn_pann->prepare("EXEC _ADD_ITEM_EXTERN_CHEST :kadi, :itkod, :miktar, :arti");
									$values = array(':kadi' => $username,
									':itkod' 	  => $item_kodu,
									':miktar' => $miktar,
									':arti'	  => $arti);		
								$ekle->execute($values);
								}else{
									}
							 if($ItemType == 2){
							$ekle = $users->link->db_conn_shard->prepare("UPDATE _Char SET RemainSkillPoint=RemainSkillPoint + :miktar WHERE CharName16 = :kadi");
									$values = array(':kadi' => $karakteradi,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}		
							 if($ItemType == 3){
								$ekle = $users->link->db_conn_shard->prepare("UPDATE _Char SET RemainGold=RemainGold + :miktar WHERE CharName16 = :kadi");
									$values = array(':kadi' => $karakteradi,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}			
							 if($ItemType == 4){
								$ekle = $users->link->db_conn_account->prepare("UPDATE SK_Silk SET silk_own=silk_own + :miktar WHERE JID=:JID ");
									$values = array(':JID' => $JID,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}
							 if($ItemType == 5){
								$ekle = $users->link->db_conn_shard->prepare("UPDATE _Char SET HwanLevel=:miktar WHERE CharName16 = :kadi");
									$values = array(':kadi' => $karakteradi,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}									
							 if($ItemType == 6){
								$ekle = $users->link->db_conn_account->prepare("UPDATE tb_user SET game_credit=game_credit + :miktar WHERE JID=:JID ");
									$values = array(':JID' => $JID,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}									
									if($ekle->rowCount() == 1)
									{
					$marketlogtl="".$marketitem[0]['fiyat']." TL";					
					$market_log = $users->MarketLog($karakteradi,$marketitem[0]['item_adi'],$username,$marketlogtl,$tarih);					
		$data['status']="success"; $data['status2']="Başarılı";
		$data['text']=$dils['mhata5'];
		echo json_encode($data);
										
									}else{
										
										
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata6'];
		echo json_encode($data);
										$tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET credit = '$gunceltl' WHERE StrUserID = '$username' ");
										$_SESSION['tlmiktari']=$gunceltl;
									}
							 
							 }else{
								 
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata7'];
		echo json_encode($data);
							 }
						 
						 
					 }else{
						 
						 
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata7'];
		echo json_encode($data);
					 }	
}else if($types==2){
	//SİLK SATIŞ
				     if($_SESSION['silk'] >= $fiyat)
					 {
						 $yenisilk = $guncelsilk - $fiyat;

						 $silkupdate = $users->link->db_conn_account->query("UPDATE SK_Silk SET silk_own = '$yenisilk' WHERE JID='$JID' ");
						 
						 if($silkupdate == 1){
							 
							 $_SESSION['silk']=$yenisilk;
							 if($ItemType == 2){
							$ekle = $users->link->db_conn_shard->prepare("UPDATE _Char SET RemainSkillPoint=RemainSkillPoint + :miktar WHERE CharName16 = :kadi");
									$values = array(':kadi' => $karakteradi,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}		
							 if($ItemType == 3){
								$ekle = $users->link->db_conn_shard->prepare("UPDATE _Char SET RemainGold=RemainGold + :miktar WHERE CharName16 = :kadi");
									$values = array(':kadi' => $karakteradi,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}			
							 if($ItemType == 4){
								$ekle = $users->link->db_conn_account->prepare("UPDATE SK_Silk SET silk_own=silk_own + :miktar WHERE JID=:JID ");
									$values = array(':JID' => $JID,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}
							 if($ItemType == 5){
								$ekle = $users->link->db_conn_shard->prepare("UPDATE _Char SET HwanLevel=:miktar WHERE CharName16 = :kadi");
									$values = array(':kadi' => $karakteradi,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}									
							 if($ItemType == 6){
								$ekle = $users->link->db_conn_account->prepare("UPDATE tb_user SET game_credit=game_credit + :miktar WHERE JID=:JID ");
									$values = array(':JID' => $JID,
									':miktar' => $miktar);		
								$ekle->execute($values);
								}else{
									}							
									if($ekle->rowCount() == 1)
									{
										
					$marketlogtl="".$marketitem[0]['fiyat']." Silk";					
					$market_log = $users->MarketLog($karakteradi,$marketitem[0]['item_adi'],$username,$marketlogtl,$tarih);							
		$data['status']="success"; $data['status2']="Başarılı";
		$data['text']=$dils['mhata5'];
		echo json_encode($data);
										
									}else{
										
										
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata6'];
		echo json_encode($data);
										$silkupdate = $users->link->db_conn_account->query("UPDATE SK_Silk SET silk_own = '$guncelsilk' WHERE JID='$JID' ");
										
										$_SESSION['silk']=$guncelsilk;
									
									}
							 
							 }else{
								 
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata7'];
		echo json_encode($data);
							 }
						 
						 
					 }else{
						 
						 
		$data['status']="error"; $data['status2']="Başarısız";
		$data['text']=$dils['mhata7'];
		echo json_encode($data);
					 }	
}else{
	
}

					
				}else
				{
					
					 $data['text']=$dils['mhata7'];
				}
				
				 
				
			}
		}
		



	
	}