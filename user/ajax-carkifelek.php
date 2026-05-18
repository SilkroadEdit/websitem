<?php 
include('lib/reg_users.php');
$username=$_SESSION['username'];
$herotest = $users->link->db_conn_pann->query("select *,(select game_credit from sro_vt_account..tb_user where StrUserID = '$username') as credit,(select type from Panel..wheelsettings where ID = 1) as wheel from wheelsettings where ID = 1");
$rowla = $herotest->fetchAll();	

$marketitem=$users->game_listesi(); 
if(isset($_POST['_token'])){
if($_SESSION['_token'] == $_POST['_token']){
if(isset($_SESSION['guardf'])){
if($rowla[0]["wheel"] == 1){	
if(isset($_POST)){ 
//Elimizde Var olması gereken değerler
	$fiyat=$rowla[0]['WheelPrice'];
	$JID=$_SESSION['JID'];

	$gunceltl =$rowla[0]["credit"];
	$tarih = date("d.m.Y H:i:s");	
//degerlerler bitti .	

$kontrol=$users->CharInfoss($JID); 
if($kontrol==0){
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['message']="Hesabınız'da karakter bulunmamaktadır";
		echo json_encode($data);	
}else{	
// CARKI FELEK BAŞLANGIC
    if($gunceltl >= $fiyat) {

$yenitl  = $rowla[0]["credit"] - $fiyat;						
$tlupdate=$users->link->db_conn_account->query("UPDATE TB_User SET game_credit = '$yenitl' WHERE StrUserID = '$username' ");
 if($tlupdate == 1){

	 
	$wheel_items = array();
		
	foreach($marketitem as $wheel_item){
		
       $wheel_items[] = array(
     "id" => $wheel_item["id"],
     "name" => $wheel_item["name"],
     "image" => $wheel_item["image"],
     "ratio" => $wheel_item["ratio"],
     "color" => $wheel_item["color"],
                    );
                }			
		$_wheel_items = $wheel_items;			
		$items = $_wheel_items;
         $newItems = array();
        foreach ($items as $item)
        {
            $newItems = array_merge($newItems, array_fill(0, $item["ratio"], $item));
        }
        $winned_item = $newItems[array_rand($newItems)];
        $data = array(
                "id" => $winned_item["id"],
                "image" => $winned_item["image"],
                "name" => $winned_item["name"],
                "remain_tl" => $yenitl,
        );
		
		

		$herotest1 = $users->link->db_conn_pann->query("select * from game_rewards where id = ".$winned_item["id"]);
		$rowlas = $herotest1->fetchAll();
		$deger1=$rowlas[0]['codename128'];
		$deger2=$rowlas[0]['total'];
		$deger3=$rowlas[0]['plus'];
		$deger4=$rowlas[0]['name'];
		$ayarq=$rowlas[0]['types'];
		
	if($ayarq == 'item'){
	$ekle = $users->link->db_conn_pann->prepare("EXEC _ADD_ITEM_EXTERN_CHEST :kadi, :itkod, :miktar, :arti");
		$values = array(':kadi' => $username,
		':itkod' 	  => $deger1,
		':miktar' => $deger2,
		':arti'	  => $deger3);		
		$ekle->execute($values);		
	}	
	if($ayarq == 'tl'){
	$ekle = $users->link->db_conn_account->prepare("update tb_user set credit=credit+:miktar where StrUserID = :kadi");
		$values = array(':kadi' => $username,
		':miktar'	  => $deger2);		
		$ekle->execute($values);			
	}
	if($ayarq == 'silk'){
	$ekle = $users->link->db_conn_account->prepare("UPDATE SK_Silk SET silk_own = silk_own + :miktar WHERE JID = (select JID from tb_user where StrUserID=:kadi)");
		$values = array(':kadi' => $username,
		':miktar'	  => $deger2);		
		$ekle->execute($values);			
	}
								
		if($ekle->rowCount() == 1){
		$market_log = $users->CarkLog($username,$deger4,$deger2,$deger3,$tarih);
		}
		
		 echo json_encode($data);


		 }else{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['message']="Hesabınız'da yeterli bakiye bulunmamaktadır";
		echo json_encode($data);
							 }
		 
		 }else{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['message']="Hesabınız'da yeterli bakiye bulunmamaktadır";
		echo json_encode($data);
							 }

	// CARKI FELEK BİTİŞ	
} } } } } }