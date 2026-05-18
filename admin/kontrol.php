<?php 
session_start();
$gmadı=$_SESSION['username2'];
$tarihver =date('d.m.Y H:i:s');
		include('../fonksiyonlar/admin.php');
			$admin = new Admin();
			if(isset($_POST)){
if(isset($_POST['_token'])){
if($_SESSION['_token'] == $_POST['_token']){	
if(isset($_SESSION['loginadmin'])){
			
		if(isset($_POST['add_item'])){
		$item = htmlspecialchars($_POST['item_name']);
		$arti =(int)anti_injection($_POST['arti']);
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'İtem Verme';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>İtem Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
														                          <tr>
                                                        <td class="text-bold">İtem Kodu</td>
                                                                                                                    <td>'.$item.'</td>
                                                                                                            </tr>													
                                                                                                    <tr>
                                                        <td class="text-bold">Miktar</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                                                                   <tr>
                                                        <td class="text-bold">Plus</td>
                                                                                                                    <td>'.$arti.'</td>
                                                                                                            </tr>
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($item) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_shard->query("exec _ADD_ITEM_EXTERN '$username','$item',$miktar,$arti");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Haber SİL
if(isset($_POST['haberremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_pann->query("DELETE FROM Haberler WHERE id='$id'");	
if($delete){
echo '';
}else{
echo '';
}
}

//Hesap no SİL
if(isset($_POST['hesapremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_pann->query("DELETE FROM HesapNo WHERE id='$id'");	
if($delete){
echo '';
}else{
echo '';
}
}

//Market SİL
if(isset($_POST['marketremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_pann->query("DELETE FROM Market WHERE id='$id'");	
if($delete){
echo '';
}else{
echo '';
}
}

//İndirme SİL
if(isset($_POST['downremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_pann->query("DELETE FROM Download WHERE id='$id'");	
if($delete){
echo '';
}else{
echo '';
}
}

//Admin SİL
if(isset($_POST['adminremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_pann->query("DELETE FROM adminyetki WHERE id='$id'");	
if($delete){
echo '';
}else{
echo '';
}
}

//Ban SİL
if(isset($_POST['banremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_account->query("DECLARE @AccJID INT;  
		SET @AccJID= '$id'
		DELETE FROM _BlockedUser WHERE UserJID=@AccJID
DELETE FROM _Punishment where UserJID=@AccJID");	
if($delete){
echo '';
}else{
echo '';
}
}

//Ban SİL
if(isset($_POST['gmremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_account->query("UPDATE tb_user SET sec_primary = 3 , sec_content = 3 where JID=$id");	
if($delete){
echo '';
}else{
echo '';
}
}

//S.S.S SİL
if(isset($_POST['faqsremove'])){
$id = (int)htmlspecialchars($_POST['id']);
$delete= $admin->link->db_conn_pann->query("delete from Panel..faqss where id=$id");	
if($delete){
echo '';
}else{
echo '';
}
}

//Unique SİL
if(isset($_POST['uniqremove'])){
$Unique = htmlspecialchars($_GET['Unique']);	
$delete= $admin->link->db_conn_pann->query("DELETE FROM UniquePoints WHERE [Unique]='$Unique'");	
if($delete){
echo '';
}else{
echo '';
}
}

//Karakter Adı Değişitr
		if(isset($_POST['karaktername'])){
		$miktar=anti_injection(htmlspecialchars($_POST['miktar']));
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Karakter Adı Değiştirme';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Karakter Adı Değiştirme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Yeni Karakter Adı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';

			}else if($admin->CharInfo($miktar)>0){
	
				echo 'hatalar';
				
		}else{
		$ekle =$admin->link->db_conn_shard->query("UPDATE _Char SET CharName16='$miktar' WHERE CharName16 = '$username'");
		$ekle =$admin->link->db_conn_shard->query("UPDATE _CharNameList SET CharName16='$miktar' WHERE CharName16 = '$username'");
	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Karakter Adı Değişitr
		if(isset($_POST['jobname'])){
		$miktar=anti_injection(htmlspecialchars($_POST['miktar']));
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Job Adı Değiştirme';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Job Adı Değiştirme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Job Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Yeni Job Adı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->AvcıInfo($username) == 0){
	
				echo 'hata';

			}else if($admin->AvcıInfo($miktar)>0){
	
				echo 'hatalar';
				
		}else{
		$ekle =$admin->link->db_conn_shard->query("UPDATE _Char SET NickName16='$miktar' WHERE NickName16 = '$username'");
	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Kullanıcıya TL Ver
		if(isset($_POST['add_kredi2'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Kredi Verme';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Kredi Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Kredi Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE TB_User SET game_credit=game_credit + '$miktar' WHERE JID = (Select  U.JID As UserName From SRO_VT_SHARD.dbo._User Right Join SRO_VT_SHARD.dbo._Char
On SRO_VT_SHARD.dbo._User.CharID = SRO_VT_SHARD.dbo._Char.CharID
Right Join SRO_VT_ACCOUNT.dbo.TB_User As U
On U.JID = SRO_VT_SHARD.dbo._User.UserJID Where _Char.CharName16 = '$username')");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Kullanıcıya TL Ver
		if(isset($_POST['add_kredi'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Kredi Verme';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Kredi Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Kredi Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE TB_User SET game_credit=game_credit + '$miktar' WHERE StrUserID = '$username'");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Kullanıcıya TL Ver
		if(isset($_POST['add_tl'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'TL Verme';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>TL Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen TL Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE TB_User SET credit=credit + '$miktar' WHERE StrUserID = '$username'");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Kullanıcıya Silk Ver
		if(isset($_POST['add_silk2'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Silk Verme';
		$bilgi = '       <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Silk Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Silk Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE SK_Silk SET silk_own=silk_own + '$miktar' WHERE JID = (Select  U.JID As UserName From SRO_VT_SHARD.dbo._User Right Join SRO_VT_SHARD.dbo._Char
On SRO_VT_SHARD.dbo._User.CharID = SRO_VT_SHARD.dbo._Char.CharID
Right Join SRO_VT_ACCOUNT.dbo.TB_User As U
On U.JID = SRO_VT_SHARD.dbo._User.UserJID Where _Char.CharName16 = '$username')");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Karaktere TL Ver
		if(isset($_POST['add_tl2'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username =anti_injection( htmlspecialchars($_POST['username']));
		$type = 'TL Verme';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>TL Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen TL Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE TB_User SET credit=credit + '$miktar' WHERE StrUserID = (Select  U.StrUserID As UserName From SRO_VT_SHARD.dbo._User Right Join SRO_VT_SHARD.dbo._Char
On SRO_VT_SHARD.dbo._User.CharID = SRO_VT_SHARD.dbo._Char.CharID
Right Join SRO_VT_ACCOUNT.dbo.TB_User As U
On U.JID = SRO_VT_SHARD.dbo._User.UserJID Where _Char.CharName16 = '$username')");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Maxigame Entegrasyonu
		if(isset($_POST['maxigameayar'])){
		$apikey=htmlspecialchars($_POST['apikey']);
		$apisecret = htmlspecialchars($_POST['apisecret']);
		$chargetype = (int)anti_injection($_POST['chargetype']);

		$ekle =$admin->link->db_conn_pann->query("UPDATE maxigame SET ApiKey='$apikey',ApiSecret='$apisecret',ChargeType='$chargetype' WHERE id = 1");
	
			if($ekle == 1){
	
							 
		$data['title']="Başarılı";
		$data['text']="İşlem başarılı şekilde yapıldı.";
		$data['type']="success";
		$data['url']="admin.php?do=maxigame";
		echo json_encode($data);
				
			}else{
				
							 
		$data['title']="Opps!";
		$data['text']="";
		$data['type']="error";
		echo json_encode($data);
			}

}

//Kullanıcıya TL Ver
		if(isset($_POST['genelsettings'])){
		$detaygm=(int)anti_injection($_POST['detaygm']);
		$detayk = (int)anti_injection($_POST['detayk']);
		$jobgm = (int)anti_injection($_POST['jobgm']);
		$jobk = (int)anti_injection($_POST['jobk']);
		$goldgm = (int)anti_injection($_POST['goldgm']);
		$goldk = (int)anti_injection($_POST['goldk']);
		

		$ekle =$admin->link->db_conn_pann->query("UPDATE gm_settings SET detaygm=$detaygm,detayk=$detayk,jobgm=$jobgm,jobk=$jobk,goldgm=$goldgm,goldk=$goldk WHERE id = 1");

	
			if($ekle == 1){
	
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}

}

//Kullanıcıya TL Ver
		if(isset($_POST['wheel'])){
		$detaygm=(int)anti_injection($_POST['price']);
		$detayk = (int)anti_injection($_POST['state']);
		
		if(empty($detaygm)){
						 
		$data['title']="Hata!";
		$data['text']="Fiyat bölümü boş bırakılamaz.";
		$data['type']="error";
		echo json_encode($data);		
		}else{		
		$ekle =$admin->link->db_conn_pann->query("UPDATE wheelsettings SET WheelPrice=$detaygm,type=$detayk WHERE ID = 1");

	
			if($ekle == 1){
	
							 
		$data['title']="Başarılı";
		$data['text']="Ayarlar başarılı şekilde değiştirildi.";
		$data['type']="success";
		echo json_encode($data);
				
			}else{
				
							 
		$data['title']="Hata!";
		$data['text']="Bir hata oluştu.";
		$data['type']="error";
		echo json_encode($data);
			}
		}
}

//Kullanıcıya TL Ver
		if(isset($_POST['wheelremov'])){
		$id=(int)anti_injection($_POST['id']);
		
	
		$ekle =$admin->link->db_conn_pann->query("delete game_rewards WHERE id = $id");

	
			if($ekle == 1){
	
						 
		$data['title']="Başarılı";
		$data['text']="Ödül başarılı şekilde kaldırıldı.";
		$data['type']="success";
		echo json_encode($data);
				
			}else{
				
						 
		$data['title']="Hata!";
		$data['text']="Bir hata oluştu.";
		$data['type']="error";
		echo json_encode($data);
			}
}

//Kullanıcıya Silk Ver
		if(isset($_POST['add_silk'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Silk Verme';
		$bilgi = '       <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Silk Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Silk Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE SK_Silk SET silk_own=silk_own + '$miktar' WHERE JID = (Select JID from tb_user where StrUserID='$username')");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Karaktere SP Ver
		if(isset($_POST['add_sp'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'SP Verme';
		$bilgi = '   <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>SP Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen SP Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_shard->query("UPDATE _Char SET RemainSkillPoint=RemainSkillPoint + '$miktar' WHERE CharName16 = '$username'");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Karaktere Gold Ver
		if(isset($_POST['add_gold'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'Gold Verme';
		$bilgi = '   <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Gold Verme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Karakter Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Gold Miktarı</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_shard->query("UPDATE _Char SET RemainGold=RemainGold + '$miktar' WHERE CharName16 = '$username'");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Kullanıcı Ban AT
		if(isset($_POST['add_ban'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$msg = anti_injection(htmlspecialchars($_POST['msg']));
		$type = 'Ban Atma';
		$types = "1";
		$bilgi = '   <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Ban Atma</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Ban Cezası Günü</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                                                                  <tr>
                                                        <td class="text-bold">Ban Cezası Mesajı</td>
                                                                                                                    <td>'.$msg.'</td>
                                                                                                            </tr>
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($username) || empty($msg)){

			echo 'bos';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo 'hata';
		}else{
				if(empty($type)){
					$types = "1";
					$ekle = $admin -> banat($username,$types,$msg,$miktar);
					}else{
					$ekle = $admin -> banat($username,$types,$msg,$miktar);
					}
					if ($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata2';
			}
		}
}

//Kullanıcı GM Yap
		if(isset($_POST['add_gm'])){
		$miktar=(int)anti_injection($_POST['miktar']);
		$username = anti_injection(htmlspecialchars($_POST['username']));
		$type = 'GM Yapma';
		$bilgi = '  
                                        <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>GM Yapma</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Yetki</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($miktar) || empty($username)){

			echo 'bos';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo 'hata';
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE TB_User SET sec_primary='$miktar' , sec_content='$miktar' WHERE StrUserID='$username'");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Kullanıcı GM Yap
		if(isset($_POST['add_admin'])){

		$username = anti_injection(htmlspecialchars($_POST['username']));
		$miktar = anti_injection(htmlspecialchars($_POST['miktar']));
		$type = 'Site Admin Yapma';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Site Admin Yapma</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Verilen Yetki</td>
                                                                                                                    <td>'.$miktar.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		
			if(empty($username)){

			echo 'bos';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo 'hata';
		}else{
			$ekle =$admin->link->db_conn_pann->query("INSERT INTO adminyetki(kuladi,yetki,ipadres) VALUES ('$username','1','$miktar')");

	
			if($ekle == 1){
				$$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
				echo 'itemok';
				
			}else{
				
				echo 'hata';
			}
		}
}

//Site ayar yap
		if(isset($_POST['add_ayar'])){
				
				$oyunismi = anti_injection(htmlspecialchars($_POST['oyunismi']));
				$oyunlogo = anti_injection(htmlspecialchars($_POST['oyunlogo']));
				$levelcap =(int)anti_injection($_POST['levelcap']);
				$masterycap = (int)anti_injection($_POST['masterycap']);
				$silk =(int)anti_injection($_POST['silk']);
				$irk = anti_injection(htmlspecialchars($_POST['irk']));
				$exprate = anti_injection(htmlspecialchars($_POST['exprate']));
				$sprate = anti_injection(htmlspecialchars($_POST['sprate']));
				$facebook = anti_injection(htmlspecialchars($_POST['facebook']));
				$twitter = anti_injection(htmlspecialchars($_POST['twitter']));
				$google = anti_injection(htmlspecialchars($_POST['google']));
				$skype = anti_injection(htmlspecialchars($_POST['skype']));
				$youtube = anti_injection(htmlspecialchars($_POST['youtube']));
				$kapasite =(int)anti_injection($_POST['kapasite']);
				$baslangic = anti_injection(htmlspecialchars($_POST['baslangic']));
				$fake_ch = anti_injection(htmlspecialchars($_POST['fake_ch']));
				$fake_eu = anti_injection(htmlspecialchars($_POST['fake_eu']));
				$fake_total = anti_injection(htmlspecialchars($_POST['fake_total']));
				
				if(empty($oyunismi) || empty($oyunlogo))
				{
					echo 'bos';
				}else
				{
		
					$ayar_yap = $admin->ayaryap($oyunismi,$oyunlogo,$levelcap,$masterycap,$silk,$irk,$exprate,$sprate,$facebook,$twitter,$google,$skype,$youtube,$kapasite,$baslangic,$fake_ch,$fake_eu,$fake_total);
				
					if ($ayar_yap == 1){
					 	echo 'itemok';
						
					}else{
					
						echo 'hata';
					}
					
				}
				
			}
//cache ayar yap
		if(isset($_POST['cache_ayar'])){
				
				$news = (int)anti_injection($_POST['news']);
				$faqs = (int)anti_injection($_POST['faqs']);
				$downloads =(int)anti_injection($_POST['downloads']);
				$guild_rank = (int)anti_injection($_POST['guild_rank']);
				$player_rank =(int)anti_injection($_POST['player_rank']);
				$honor_rank = (int)anti_injection($_POST['honor_rank']);
				$thief_rank = (int)anti_injection($_POST['thief_rank']);
				$trader_rank = (int)anti_injection($_POST['trader_rank']);
				$hunter_rank = (int)anti_injection($_POST['hunter_rank']);
				$unique_rank = (int)anti_injection($_POST['unique_rank']);
				$pvp_rank = (int)anti_injection($_POST['pvp_rank']);
				$charinfo = (int)anti_injection($_POST['charinfo']);
				$guildinfo = (int)anti_injection($_POST['guildinfo']);
				$unioninfo = (int)anti_injection($_POST['unioninfo']);
				$union_rank = (int)anti_injection($_POST['union_rank']);
				
	
	$ayar_yap =$admin->link->db_conn_pann->query("update onbellek_ayarları set union_rank=$union_rank,unioninfo=$unioninfo,news=$news,faqs=$faqs,downloads=$downloads,guild_rank=$guild_rank,player_rank=$player_rank,honor_rank=$honor_rank,thief_rank=$thief_rank,trader_rank=$trader_rank,hunter_rank=$hunter_rank,unique_rank=$unique_rank,pvp_rank=$pvp_rank,charinfo=$charinfo,guildinfo=$guildinfo where id=1");


					
					if ($ayar_yap == 1){
					 	echo 'itemok';
						
					}else{
					
						echo 'hata';
					}
		
				
			}			
//Kale Ayar Yap
		if(isset($_POST['add_kale'])){
				
				$jangan = (int)anti_injection($_POST['jangan']);
				$hotan = (int)anti_injection($_POST['hotan']);
				$bandit =(int)anti_injection($_POST['bandit']);
				$cons = (int)anti_injection($_POST['cons']);

				
					
					$ayar_yap = $admin->kaleayar($jangan,$hotan,$bandit,$cons);

									
					if ($ayar_yap == 1){
					 	echo 'itemok';
						
					}else{
					
						echo 'hata';
					}
					
				}

//Bölüm Ayar Yap
		if(isset($_POST['add_bolum'])){
				

				$kayit = (int)anti_injection($_POST['kayit']);
				$stat =(int)anti_injection($_POST['stat']);
				$stats = (int)anti_injection($_POST['stats']);
				$bugkurtar = (int)anti_injection($_POST['bugkurtar']);
				$unuttum = (int)anti_injection($_POST['unuttum']);
				$hesapno = (int)anti_injection($_POST['hesapno']);
				$istatislik = (int)anti_injection($_POST['istatislik']);
				$usergenel = (int)anti_injection($_POST['usergenel']);
				
					$ayar_yap = $admin->bolumayar($kayit,$stat,$stats,$bugkurtar,$unuttum,$hesapno,$istatislik,$usergenel);

									
					if ($ayar_yap == 1){
					echo 'itemok';						
					}else{
					
						echo 'hata';
					}
					
				}
//Haber Düzenle

		if(isset($_POST['haberdüzen'])){
			$id = (int)anti_injection($_POST['id']);
			$konu_baslik = anti_injection(htmlspecialchars($_POST['konu_baslik']));
			$konu_anasayfa_aciklama = anti_injection(htmlspecialchars($_POST['konu_anasayfa_aciklama']));
			$konu_full_aciklama = $_POST['content'];
			$resim = htmlspecialchars($_POST['resim']);
			$tarih = date("d.m.Y H:i:s");
			if(empty($konu_baslik) || empty($konu_full_aciklama))
			{
		$data['title']="Hata!";
		$data['text']="Lütfen devam etmeden önce tüm alanları doldurun.";
		$data['type']="error";
		echo json_encode($data);
			}else if(strlen($konu_anasayfa_aciklama) > 400){
			
		$data['title']="Hata!";
		$data['text']="Ana sayfa acıklaması en fazla 400 karakterden oluşabilir.";
		$data['type']="error";
		echo json_encode($data);
			}else{
			$admin->icerik_guncelle($konu_baslik,$konu_anasayfa_aciklama,$konu_full_aciklama,$resim,$tarih,$id);
			if($admin == true){
		$data['title']="Başarılı";
		$data['text']="Haber başarılı şekilde düzenlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=icerikler";
		echo json_encode($data);
			 
			}else{
			
		$data['title']="Opps!";
		$data['text']="";
		$data['type']="error";
		echo json_encode($data);
			}
		}
	}

//Haber Ekle
		if(isset($_POST['add_haber'])){
			
				$konu_baslik = anti_injection(htmlspecialchars($_POST['konu_baslik']));
				$konu_anasayfa_aciklama = anti_injection(htmlspecialchars($_POST['konu_anasayfa_aciklama']));
				$konu_full_aciklama = $_POST['content'];
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$tarih = date("d.m.Y H:i:s");
				
				if(empty($konu_baslik) || empty($konu_full_aciklama))
				{
		$data['title']="Hata!";
		$data['text']="Lütfen devam etmeden önce tüm alanları doldurun.";
		$data['type']="error";
		echo json_encode($data);
				}else if(strlen($konu_anasayfa_aciklama) > 400){
				
		$data['title']="Hata!";
		$data['text']="Ana sayfa acıklaması en fazla 400 karakterden oluşabilir.";
		$data['type']="error";
		echo json_encode($data);
				}else{

				
					if(empty($resim)){
					$resim = "media/images/articles/loading_jupiter.png";
					$ekle = $admin -> icerik_ekle($konu_baslik,$konu_anasayfa_aciklama,$konu_full_aciklama,$resim,$tarih);
					}else{
					$ekle = $admin -> icerik_ekle($konu_baslik,$konu_anasayfa_aciklama,$konu_full_aciklama,$resim,$tarih);
					}
					if ($ekle == 1){
		$data['title']="Başarılı";
		$data['text']="Haber başarılı şekilde eklendi.";
		$data['type']="success";
		$data['url']="admin.php?do=icerikler";
		echo json_encode($data);
						
					}else{
					
		$data['title']="Opps!";
		$data['text']="";
		$data['type']="error";
		echo json_encode($data);
					}
				}

		}				

//Haber Ekle
		if(isset($_POST['faqsekle'])){
			
				$baslik = anti_injection(htmlspecialchars($_POST['title']));
				$icerik = $_POST['content'];
				$tarih = date("d.m.Y H:i:s");
				
				if(empty($baslik) || empty($icerik) )
				{
		$data['title']="Hata!";
		$data['text']="Lütfen devam etmeden önce tüm alanları doldurun.";
		$data['type']="error";
		echo json_encode($data);
				}else if(strlen($icerik) < 10){
				
		$data['title']="Hata!";
		$data['text']="İcerik 10 karakterden kücük olamaz";
		$data['type']="error";
		echo json_encode($data);
				}else{

$ekle =$admin->link->db_conn_pann->query("INSERT INTO Panel..faqss (title,icerik,tarih) values ('$baslik','$icerik','$tarih')");


					if ($ekle == 1){
		$data['title']="Başarılı";
		$data['text']="Yardım konusu başarılı şekilde eklendi.";
		$data['type']="success";
		$data['url']="admin.php?do=faqs";
		echo json_encode($data);
						
					}else{
					
		$data['title']="Opps!";
		$data['text']="";
		$data['type']="error";
		echo json_encode($data);
					}
				}

		}
//İndirme Link Güncelle

		if(isset($_POST['downdüzen'])){
				$id = (int)anti_injection($_POST['id']);
				$ad = anti_injection(htmlspecialchars($_POST['ad']));
				$link = htmlspecialchars($_POST['link']);


				if(empty($ad) || empty($link)){
				
					echo 'bos';
				}else{
				
					
					$downup = $admin->down_update($ad,$link,$id);

					
					if ($downup == 1){
					 	echo 'itemok';
						
					}else{
					
						echo 'bos';
					}
				}
		}

		
//İndirme Link Ekle
		if(isset($_POST['add_down'])){
			
				$ad = anti_injection(htmlspecialchars($_POST['ad']));
				$link = anti_injection(htmlspecialchars($_POST['link']));
				$boyut = date("d.m.Y H:i:s");
				

				if(empty($ad) || empty($link)){
				
					echo 'bos';
				}else{
				
					
						
					if(empty($resim)){
					$resim ='./media/images/dl-icon.png';
					$downekle = $admin->down_ekle($ad,$link,$boyut,$resim);
					}else{
					
					$downekle = $admin->down_ekle($ad,$link,$boyut,$resim);

					}
					
					if ($downekle == 1){
					 	echo  'itemok';
					}else{
					
						echo 'hata';
					}
				}
		}

//Stat Ve Skill Sıfırlama Fiyatları
		if(isset($_POST['add_ente'])){
				
				$stattl = (int)anti_injection($_POST['stattl']);
				$statsilk = (int)anti_injection($_POST['statsilk']);
				$skilltl = (int)anti_injection($_POST['skilltl']);
				$skillsilk = (int)anti_injection($_POST['skillsilk']);
			
				$ayar_yap = $admin->entegre($stattl,$statsilk,$skilltl,$skillsilk);

					
					if ($ayar_yap == 1){
					 	echo 'itemok';
						
					}else{
					
						echo 'hata';
					}
				
				
				
			}

//Hesap No Ekle
		if(isset($_POST['add_banka'])){
			
				$hesap_sahibi = anti_injection(htmlspecialchars($_POST['hesap_sahibi']));
				$sube_no = anti_injection(htmlspecialchars($_POST['sube_no']));
				$hesap_no = anti_injection(htmlspecialchars($_POST['hesap_no']));
				$iban = anti_injection(htmlspecialchars($_POST['iban']));
				$banka_adi = anti_injection(htmlspecialchars($_POST['banka_adi']));


				if(empty($banka_adi)){
				
					echo 'bos';
				}else{
					
					$hesapekle = $admin->hesapno_ekle($hesap_sahibi,$sube_no,$hesap_no,$iban,$banka_adi);

					
					
					if ($hesapekle == 1){
					 	echo 'itemok';
					}else{
					
						echo 'hata';
					}
				}
		}		

//Unique Puan Ekle
		if(isset($_POST['add_puan'])){
			
				$Unique = anti_injection(htmlspecialchars($_POST['unique']));
				$Point = anti_injection(htmlspecialchars($_POST['point']));
				
				if(empty($Unique) || empty($Point))
				{
					echo 'bos';

				}else{

					$ekle = $admin -> uniq_ekle($Unique,$Point);

					if ($ekle == 1){
					echo 'itemok';
						
					}else{
					
						echo 'hata';
					}
				}

		}		

//Unique Puan Ekle
		if(isset($_POST['puanduzenle'])){
				$names = anti_injection(htmlspecialchars($_POST['names']));
				$Unique = anti_injection(htmlspecialchars($_POST['unique']));
				$Point = anti_injection(htmlspecialchars($_POST['point']));
				
				if(empty($Unique) || empty($Point))
				{
					echo 'bos';

				}else{

	$ekle =$admin->link->db_conn_pann->query("UPDATE UniquePoints SET [Unique] = '$Unique',Point='$Point' where [Unique] = '$names'");

					if ($ekle == 1){
					echo 'itemok';
						
					}else{
					
						echo 'hata';
					}
				}

		}
		
//Market İtem Ekle
			if(isset($_POST['add_mitem'])){
				
				$isim = anti_injection(htmlspecialchars($_POST['isim']));
				$kod = anti_injection(htmlspecialchars($_POST['kod']));
				$arti_miktari =(int)anti_injection($_POST['arti_miktari']);
				$pot_sc_miktari = (int)anti_injection($_POST['pot_sc_miktari']);
				$silk =(int)anti_injection($_POST['silk']);
				$tl = (int)anti_injection($_POST['tl']);
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$sira = (int)anti_injection($_POST['sira']);
				
				if(empty($isim) || empty($kod))
				{
					echo 'bos';
				}else
				{
					
					
						
					if(empty($resim)){
					$resim ='/media/images/icon_default.PNG';
					$item_ekle = $admin->market_item_ekle($isim,$kod,$arti_miktari,$pot_sc_miktari,$silk,$tl,$resim,$sira);
					}else{
					
					$item_ekle = $admin->market_item_ekle($isim,$kod,$arti_miktari,$pot_sc_miktari,$silk,$tl,$resim,$sira);

					}
					
					if ($item_ekle == 1){
						echo 'itemok';
					}else{
					
						echo 'hata';
					}
					
				}
				
			}		

//Wheel İtem Ekle
			if(isset($_POST['wheelitem'])){
				
				$code_name = anti_injection(htmlspecialchars($_POST['code_name']));
				$name = anti_injection(htmlspecialchars($_POST['name']));
				$optlevel =(int)anti_injection($_POST['optlevel']);
				$total = (int)anti_injection($_POST['total']);
				$ratio =(int)anti_injection($_POST['ratio']);
				$image = anti_injection(htmlspecialchars($_POST['image']));
				
				if(empty($name) || empty($code_name) || empty($image) || empty($ratio))
				{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="İşleme devam etmek icin tüm alanları doldurunuz";
		$data['type']="error";
		echo json_encode($data);
				}else
				{
$ran=array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
$color="#".$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)];
					
	$ekle =$admin->link->db_conn_pann->query("INSERT INTO Panel..game_rewards (name,codename128,image,types,total,plus,color,ratio) values ('$name','$code_name','$image','item','$total','$optlevel','$color','$ratio')");

				
					if ($ekle == 1){
		$data['id']=false;						 
		$data['title']="Başarılı";
		$data['text']="Ödül başarılı şekilde eklendi.";
		$data['type']="success";
		echo json_encode($data);
					}else{
					
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="Opps.";
		$data['type']="error";
		echo json_encode($data);
					}
					
				}
				
			}
//Truncates TABLES

if(isset($_POST['action'])){

if($_POST['action'] == 'market_items') {
	$delete= $admin->link->db_conn_pann->query("delete from MarketLog");
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Market gecmişi başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'tickets') {
	$delete= $admin->link->db_conn_pann->query("delete from _Tickets");
	$delete= $admin->link->db_conn_pann->query("delete from _TicketsAnswer");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Bildirimler başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'posts') {
	$delete= $admin->link->db_conn_pann->query("delete from Haberler");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Haberler başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'unique') {
	$delete= $admin->link->db_conn_pann->query("delete from UniqueRanking");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Unique rank başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=uniqlog";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'pvp') {
	$delete= $admin->link->db_conn_pann->query("delete from PvpKills");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Pvp rank başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=uniqlog";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'faqs') {
	$delete= $admin->link->db_conn_pann->query("delete from faqss");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Yardım konuları başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'downloads') {
	$delete= $admin->link->db_conn_pann->query("delete from Download");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="İndirme linkleri başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'bank_accounts') {
	$delete= $admin->link->db_conn_pann->query("delete from HesapNo");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Hesap numaraları başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'wheel') {
	$delete= $admin->link->db_conn_pann->query("delete from WheelLog");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Çarkıfelek ödül geçmişi başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}

if($_POST['action'] == 'special_actions') {
	$delete= $admin->link->db_conn_pann->query("delete from SpecialLog");	
if ($delete == 1){					 
		$data['title']="Başarılı";
		$data['text']="Özel işlem geçmişi başarılı şekilde temizlendi.";
		$data['type']="success";
		$data['url']="admin.php?do=truncates";
		echo json_encode($data);	
}else{
		$data['id']=false;						 
		$data['title']="Opps!!";
		$data['text']="Bir sorun oluştu. İşlem başarısız.";
		$data['type']="error";
		echo json_encode($data);	
}		
}
	
}//Action biterrr

//Wheel TL Ekle
			if(isset($_POST['wheeltl'])){
				
				$name = anti_injection(htmlspecialchars($_POST['name']));
				$total = (int)anti_injection($_POST['total']);
				$ratio =(int)anti_injection($_POST['ratio']);
				$image = anti_injection(htmlspecialchars($_POST['image']));
				
				if(empty($name) || empty($image) || empty($ratio))
				{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="İşleme devam etmek icin tüm alanları doldurunuz";
		$data['type']="error";
		echo json_encode($data);
				}else
				{
$ran=array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
$color="#".$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)];
					
	$ekle =$admin->link->db_conn_pann->query("INSERT INTO Panel..game_rewards (name,codename128,image,types,total,plus,color,ratio) values ('$name','0','$image','tl','$total','0','$color','$ratio')");

				
					if ($ekle == 1){
		$data['id']=false;						 
		$data['title']="Başarılı";
		$data['text']="Ödül başarılı şekilde eklendi.";
		$data['type']="success";
		echo json_encode($data);
					}else{
					
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="Opps.";
		$data['type']="error";
		echo json_encode($data);
					}
					
				}
				
			}

//Wheel Silk Ekle
			if(isset($_POST['wheelsilk'])){
				
				$name = anti_injection(htmlspecialchars($_POST['name']));
				$total = (int)anti_injection($_POST['total']);
				$ratio =(int)anti_injection($_POST['ratio']);
				$image = anti_injection(htmlspecialchars($_POST['image']));
				
				if(empty($name) || empty($image) || empty($ratio))
				{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="İşleme devam etmek icin tüm alanları doldurunuz";
		$data['type']="error";
		echo json_encode($data);
				}else
				{
$ran=array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
$color="#".$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)].$ran[rand(0,15)];
					
	$ekle =$admin->link->db_conn_pann->query("INSERT INTO Panel..game_rewards (name,codename128,image,types,total,plus,color,ratio) values ('$name','0','$image','silk','$total','0','$color','$ratio')");

				
					if ($ekle == 1){
		$data['id']=false;						 
		$data['title']="Başarılı";
		$data['text']="Ödül başarılı şekilde eklendi.";
		$data['type']="success";
		echo json_encode($data);
					}else{
					
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="Opps.";
		$data['type']="error";
		echo json_encode($data);
					}
					
				}
				
			}
			
//Market Gold Ekle
			if(isset($_POST['add_mgold'])){
				
				$isim = anti_injection(htmlspecialchars($_POST['isim']));
				$pot_sc_miktari = (int)anti_injection($_POST['pot_sc_miktari']);
				$silk =(int)anti_injection($_POST['silk']);
				$tl = (int)anti_injection($_POST['tl']);
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$sira = (int)anti_injection($_POST['sira']);
				
				if(empty($isim) || empty($pot_sc_miktari))
				{
					echo 'bos';
				}else
				{
					
					
						
					if(empty($resim)){
					$resim ='/media/images/icon_default.PNG';
					$item_ekle = $admin->market_gold_ekle($isim,$pot_sc_miktari,$silk,$tl,$resim,$sira);
					}else{
					
					$item_ekle = $admin->market_gold_ekle($isim,$pot_sc_miktari,$silk,$tl,$resim,$sira);

					}
					
					if ($item_ekle == 1){
					 	echo 'itemok';
					}else{
					
						echo 'hata';
					}
					
				}
				
			}

//Market Silk Ekle
			if(isset($_POST['add_msilk'])){
				
				$isim = anti_injection(htmlspecialchars($_POST['isim']));
				$pot_sc_miktari = (int)anti_injection($_POST['pot_sc_miktari']);
				$silk =(int)anti_injection($_POST['silk']);
				$tl = (int)anti_injection($_POST['tl']);
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$sira = (int)anti_injection($_POST['sira']);
				
				if(empty($isim) || empty($pot_sc_miktari))
				{
					echo 'bos';
				}else
				{
					
					
						
					if(empty($resim)){
					$resim ='/media/images/icon_default.PNG';
					$item_ekle = $admin->market_silk_ekle($isim,$pot_sc_miktari,$silk,$tl,$resim,$sira);
					}else{
					
					$item_ekle = $admin->market_silk_ekle($isim,$pot_sc_miktari,$silk,$tl,$resim,$sira);

					}
					
					if ($item_ekle == 1){
					 	echo 'itemok';
					}else{
					
						echo 'hata';
					}
					
				}
				
			}

			//Return Karkter 1
if(isset($_POST['returnkarakter'])){
	
	$charname = htmlspecialchars($_POST['charname']);
	$region = htmlspecialchars($_POST['region']);
	$posx = htmlspecialchars($_POST['posx']);
	$posy = htmlspecialchars($_POST['posy']);
	$posz = htmlspecialchars($_POST['posz']);
	
	if(empty($charname) || empty($region)) {
		
		$data['title']="Başarısız";
		$data['text']="Lütfen formdaki bütün alanları doldurunuz.";
		$data['type']="error";
		echo json_encode($data);

	}else{
	if($_POST['charname'] == all){
			$ekle =$admin->link->db_conn_shard->query("UPDATE _Char SET LatestRegion = '$region',PosX='$posx',PosY='$posy',PosZ ='$posz'");
	}else{
			$ekle =$admin->link->db_conn_shard->query("update _Char set LatestRegion = '$region',PosX='$posx',PosY='$posy',PosZ ='$posz' where CharName16='$charname'");
	}	
		
			if($ekle == 1){
			
		$data['title']="Başarılı";
		$data['text']="İşlem başarılı şekilde gerçekleştirildi..";
		$data['type']="success";
		$data['url']="admin.php?do=bug";
		echo json_encode($data);
				
			}else{
				
		$data['title']="Opps";
		$data['text']="Bir hata oluştu. İşlem gerçekleştirilemedi.";
		$data['type']="error";
		echo json_encode($data);
			}

}
}

			//Return Karkter 1
if(isset($_POST['returnkarakter2'])){
	
	$charname = htmlspecialchars($_POST['charname']);
	$charname2 = htmlspecialchars($_POST['charname2']);	
	if(empty($charname) || empty($charname2)) {
		
		$data['title']="Başarısız";
		$data['text']="Lütfen formdaki bütün alanları doldurunuz.";
		$data['type']="error";
		echo json_encode($data);
	}else if($admin->CharInfo($charname) == 0){
		$data['title']="Opps";
		$data['text']="".$charname." isminde karakter bulunamadı.";
		$data['type']="error";
		echo json_encode($data);
	}else if($admin->CharInfo($charname2) == 0){	
		$data['title']="Opps";
		$data['text']="".$charname2." isminde karakter bulunamadı.";
		$data['type']="error";
		echo json_encode($data);	
	}else{

	$ekle =$admin->link->db_conn_shard->query("update _Char set LatestRegion = (select LatestRegion from _Char where CharName16='$charname2'),PosX=(select PosX from _Char where CharName16='$charname2'),PosY=(select PosY from _Char where CharName16='$charname2'),PosZ =(select PosZ from _Char where CharName16='$charname2') where CharName16='$charname'");
	
		
			if($ekle == 1){
			
		$data['title']="Başarılı";
		$data['text']="İşlem başarılı şekilde gerçekleştirildi..";
		$data['type']="success";
		$data['url']="admin.php?do=bug";
		echo json_encode($data);
				
			}else{
				
		$data['title']="Opps";
		$data['text']="Bir hata oluştu. İşlem gerçekleştirilemedi.";
		$data['type']="error";
		echo json_encode($data);
			}

}
}
			
			//ticketSavar :D
if(isset($_POST['addtickets'])){
	
	$Ticket = $_POST['ticket'];
	$id = anti_injection($_POST['id']);
	$time = date('d.m.Y H:i:s');
	$Owner = 'Yönetici';
	
	// filter the ticket content
	$Ticket = preg_replace("/(from|select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "", $Ticket);
	$Ticket = trim($Ticket);
	$Ticket = addslashes($Ticket);
	$Ticket = stripslashes($Ticket);
	$Ticket = str_replace("'", "''", $Ticket);
	
	if(strlen($Ticket) < 10) {
		
		echo 'hane';

	}else{
$ekles =$admin->link->db_conn_pann->query("update _Tickets set Status = 1 where ID=$id");		
$ekle =$admin->link->db_conn_pann->query("INSERT INTO Panel.._TicketsAnswer values ('$id','$Owner','$Ticket','Görüldü','$time')");


			if($ekle == 1){
			
				echo 'bugkrtok';
				
			}else{
				
				echo 'bugkpass';
			}

}
}
if(isset($_POST['ticketdown'])){
	$id =(int)anti_injection($_POST['id']);
	
$ekle =$admin->link->db_conn_pann->query("update _Tickets set Status = 2 where ID=$id");


			if($ekle == 1){
			
				echo 'skillok';
				
			}else{
				
				echo 'hata';
			}
}
//Market SP Ekle
			if(isset($_POST['add_msp'])){
				
				$isim = anti_injection(htmlspecialchars($_POST['isim']));
			
				
				$pot_sc_miktari = (int)anti_injection($_POST['pot_sc_miktari']);
				$silk =(int)anti_injection($_POST['silk']);
				$tl = (int)anti_injection($_POST['tl']);
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$sira = (int)anti_injection($_POST['sira']);
				
				if(empty($isim) || empty($pot_sc_miktari))
				{
					echo 'bos';
				}else
				{
					
					
						
					if(empty($resim)){
					$resim ='/media/images/icon_default.PNG';
					$item_ekle = $admin->market_sp_ekle($isim,$pot_sc_miktari,$silk,$tl,$resim,$sira);
					}else{
					
					$item_ekle = $admin->market_sp_ekle($isim,$pot_sc_miktari,$silk,$tl,$resim,$sira);

					}
					
					if ($item_ekle == 1){
					 	echo 'itemok';
					}else{
					
						echo 'hata';
					}
					
				}
				
			}

//Market Rütbe Ekle
			if(isset($_POST['add_mrutbe'])){
				
				$isim = anti_injection(htmlspecialchars($_POST['isim']));							
				$pot_sc_miktari = (int)anti_injection($_POST['pot_sc_miktari']);
				$silk =(int)anti_injection($_POST['silk']);
				$tl = (int)anti_injection($_POST['tl']);
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$sira = (int)anti_injection($_POST['sira']);
				
				if(empty($isim) || empty($pot_sc_miktari))
				{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="İşleme devam etmek icin tüm alanları doldurunuz";
		$data['type']="error";
		echo json_encode($data);
				}else
				{
		$query = $admin->link->db_conn_pann->prepare("INSERT INTO Market(item_adi,item_kodu,arti_miktari,pot_sc_miktari,types,fiyat,resim,sira,type) VALUES(:item_adi,'NULL','0',:pot_sc_miktari,:silk,:tl,:resim,:sira,'5')");
		$values = array(':item_adi'        => $isim,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':silk'			   => $silk,
						':tl'			   => $tl,
						':resim'			   => $resim,
						':sira'		   => $sira);
		$query->execute($values);
		$counts = $query->rowCount();
					
					if ($counts == 1){
		$data['id']=false;						 
		$data['title']="Başarılı";
		$data['text']="Markete ürün başarıyla eklendi.";
		$data['type']="success";
		$data['url']="admin.php?do=market";
		echo json_encode($data);
					}else{
					
		$data['id']=false;						 
		$data['title']="Opps!";
		$data['text']="";
		$data['type']="error";
		echo json_encode($data);
					}
					
				}
				
			}
			
//Market Kredi Ekle
			if(isset($_POST['add_mkredi'])){
				
				$isim = anti_injection(htmlspecialchars($_POST['isim']));			
				$pot_sc_miktari = (int)anti_injection($_POST['pot_sc_miktari']);
				$silk =(int)anti_injection($_POST['silk']);
				$tl = (int)anti_injection($_POST['tl']);
				$resim = anti_injection(htmlspecialchars($_POST['resim']));
				$sira = (int)anti_injection($_POST['sira']);
				
				if(empty($isim) || empty($pot_sc_miktari))
				{
		$data['id']=false;						 
		$data['title']="Hata!";
		$data['text']="İşleme devam etmek icin tüm alanları doldurunuz";
		$data['type']="error";
		echo json_encode($data);
				}else
				{
		$query = $admin->link->db_conn_pann->prepare("INSERT INTO Market(item_adi,item_kodu,arti_miktari,pot_sc_miktari,types,fiyat,resim,sira,type) VALUES(:item_adi,'NULL','0',:pot_sc_miktari,:silk,:tl,:resim,:sira,'6')");
		$values = array(':item_adi'        => $isim,
						':pot_sc_miktari'  => $pot_sc_miktari,
						':silk'			   => $silk,
						':tl'			   => $tl,
						':resim'			   => $resim,
						':sira'		   => $sira);
		$query->execute($values);
		$counts = $query->rowCount();
					
					if ($counts == 1){
		$data['id']=false;						 
		$data['title']="Başarılı";
		$data['text']="Markete ürün başarıyla eklendi.";
		$data['type']="success";
		$data['url']="admin.php?do=market";
		echo json_encode($data);
					}else{
					
		$data['id']=false;						 
		$data['title']="Opps!";
		$data['text']="";
		$data['type']="error";
		echo json_encode($data);
					}
					
				}
				
			}			
?>
<?php
			if(isset($_POST['kullanıcı'])){
			$username = anti_injection(htmlspecialchars($_POST['username']));
			if(empty($username)){

			echo '<script type="text/javascript">swal("HATA!", "Lütfen kullanıcı adını yazınız.", "error");</script>';
			
			}else if($admin->UserInfo($username) == 0){
	
				echo '<script type="text/javascript">swal("HATA!", "'.$username.'	İsminde bir kullanıcı sistemde bulunamadı.", "error");</script>';
			}else{
			?>
			<div class="col-sm-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Genel Bilgiler</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" id="search-content">
            <dl class="dl-horizontal">
                <dt>Görüntülenen Kullanıcı:</dt>
                <dd><?php echo $username; ?></dd>
				<?php 
							$testquery = $admin->link->db_conn_account->query("select *,(SELECT COUNT(*) FROM SRO_VT_SHARD.dbo._User WHERE UserJID = JID) AS TotalMember from tb_user where StrUserID = '$username'");
					   $rows = $testquery ->fetchAll();
				?>
                <dt>JID Numarası:</dt>
                <dd><?php echo $rows[0]['JID']; ?></dd>
                <dt>Karakter Sayısı:</dt>
                <dd><?php echo $rows[0]['TotalMember']; ?></dd>
            </dl>
        </div>
        <div class="box-footer"></div>
    </div>
</div>
<div class="col-xs-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Kullanıcı Bilgileri</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" id="search-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>JID</th>
                        <th>Kullanıcı Adı</th>
                        <th>Email Adresi</th>
                        <th>Kayıt IP</th>
                        <th>GM Durumu</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
					
                        <td><?php echo $rows[0]['JID']; ?></td>
                        <td><?php echo $rows[0]['StrUserID']; ?></td>
                        <td><?php echo $rows[0]['Email']; ?></td>
                        <td><?php echo $rows[0]['reg_ip']; ?></td>
                        <td><?php if($rows[0]['sec_primary'] == 3){ echo 'Player'; } else{ echo 'GameMaster'; } ?></td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button class="btn btn-xs btn-info" title="Düzenle" onclick="window.location.href = 'admin.php?do=useredit&jid=<?php echo $rows[0]['JID']; ?>';">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Bilgileri</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" id="search-content">

						<?php 	$jidim=$rows[0]['JID'];
						$query = $admin->link->db_conn_shard->query("select * from _Char inner join _User on _User.CharID=_Char.CharID where _User.UserJID='$jidim'");
		$result = $query->fetchAll();
				if (sizeof($result) == 0){  
		echo 'Karakter bilgisi bulunamadı';
			}else{
	echo'                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>CharID</th>
                            <th>Karakter Adı</th>
                            <th>Race</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
}
		foreach($result as $row){
 ?>
                                                    <tr>
                                <td><?php echo $row['CharID']; ?></td>
                                <td><?php echo $row['CharName16']; ?></td>
                                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                                <td><?php echo $row['CurLevel']; ?></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                      <button class="btn btn-xs btn-info" title="Düzenle" onclick="window.location.replace('admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>');">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
		<?php } ?>
                                                </tbody>
                    </table>
                </div>
            </div>
			<?php
			}
			}
			?>
<?php
			if(isset($_POST['karakter'])){
			$username = anti_injection(htmlspecialchars($_POST['username']));
			if(empty($username)){

			echo '<script type="text/javascript">swal("HATA!", "Lütfen Karakter adını yazınız.", "error");</script>';
			
			}else if($admin->CharInfo($username) == 0){
	
				echo '<script type="text/javascript">swal("HATA!", "'.$username.'	İsminde bir  sistemde bulunamadı.", "error");</script>';
			}else{
			?>
			<div class="col-sm-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Genel Bilgiler</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
		
        <div class="box-body" id="search-content">
            <dl class="dl-horizontal">
					<?php 
							$testquery = $admin->link->db_conn_account->query("Select U.*,(SELECT COUNT(*) FROM SRO_VT_SHARD.dbo._User O WHERE O.UserJID = U.JID) as TotalMember From SRO_VT_SHARD.dbo._User Right Join SRO_VT_SHARD.dbo._Char
On SRO_VT_SHARD.dbo._User.CharID = SRO_VT_SHARD.dbo._Char.CharID
Right Join SRO_VT_ACCOUNT.dbo.TB_User As U
On U.JID = SRO_VT_SHARD.dbo._User.UserJID Where _Char.CharName16 = '$username'");
					   $rows = $testquery ->fetchAll();
				?>
                <dt>Görüntülenen Karakter:</dt>
                <dd><?php echo $username; ?></dd>
		
                <dt>JID Numarası:</dt>
                <dd><?php echo $rows[0]['JID']; ?></dd>
                <dt>Karakter Sayısı:</dt>
                <dd><?php echo $rows[0]['TotalMember']; ?></dd>
            </dl>
        </div>
        <div class="box-footer"></div>
    </div>
</div>
   <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Bilgileri</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" id="search-content">

						<?php 	$jidim=$rows[0]['JID'];
						$query = $admin->link->db_conn_shard->query("select * from _Char inner join _User on _User.CharID=_Char.CharID where _User.UserJID='$jidim'");
		$result = $query->fetchAll();
				if (sizeof($result) == 0){  
		echo 'Karakter bilgisi bulunamadı';
			}else{
	echo'                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>CharID</th>
                            <th>Karakter Adı</th>
                            <th>Race</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
}
		foreach($result as $row){
 ?>
                                                    <tr>
                                <td><?php echo $row['CharID']; ?></td>
                                <td><?php echo $row['CharName16']; ?></td>
                                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                                <td><?php echo $row['CurLevel']; ?></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                      <button class="btn btn-xs btn-info" title="Düzenle" onclick="window.location.replace('admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>');">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
		<?php } ?>
                                                </tbody>
                    </table>
                </div>
            </div>
			   </div>
</div>
<div class="col-xs-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Kullanıcı Bilgileri</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" id="search-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>JID</th>
                        <th>Kullanıcı Adı</th>
                        <th>Email Adresi</th>
                        <th>Kayıt IP</th>
                        <th>GM Durumu</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
					
                        <td><?php echo $rows[0]['JID']; ?></td>
                        <td><?php echo $rows[0]['StrUserID']; ?></td>
                        <td><?php echo $rows[0]['Email']; ?></td>
                        <td><?php echo $rows[0]['reg_ip']; ?></td>
                        <td><?php if($rows[0]['sec_primary'] == 3){ echo 'Player'; } else{ echo 'GameMaster'; } ?></td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button class="btn btn-xs btn-info" title="Düzenle" onclick="window.location.href = 'admin.php?do=useredit&jid=<?php echo $rows[0]['JID']; ?>';">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
 
 
			<?php
			}
			}
			?>
<?php
			if(isset($_POST['avcıara'])){
			$username = anti_injection(htmlspecialchars($_POST['username']));
			if(empty($username)){

			echo '<script type="text/javascript">swal("HATA!", "Lütfen Job adını yazınız.", "error");</script>';
			
			}else if($admin->AvcıInfo($username) == 0){
	
				echo '<script type="text/javascript">swal("HATA!", "'.$username.'	İsminde bir Job sistemde bulunamadı.", "error");</script>';
			}else{
			?>
			<div class="col-sm-6">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Genel Bilgiler</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
		
        <div class="box-body" id="search-content">
            <dl class="dl-horizontal">
					<?php 
							$testquery = $admin->link->db_conn_account->query("Select U.*,(SELECT COUNT(*) FROM SRO_VT_SHARD.dbo._User O WHERE O.UserJID = U.JID) as TotalMember From SRO_VT_SHARD.dbo._User Right Join SRO_VT_SHARD.dbo._Char
On SRO_VT_SHARD.dbo._User.CharID = SRO_VT_SHARD.dbo._Char.CharID
Right Join SRO_VT_ACCOUNT.dbo.TB_User As U
On U.JID = SRO_VT_SHARD.dbo._User.UserJID Where _Char.NickName16 = '$username'");
					   $rows = $testquery ->fetchAll();
				?>
                <dt>Görüntülenen Job :</dt>
                <dd><?php echo $username; ?></dd>
		
                <dt>JID Numarası:</dt>
                <dd><?php echo $rows[0]['JID']; ?></dd>
                <dt>Karakter Sayısı:</dt>
                <dd><?php echo $rows[0]['TotalMember']; ?></dd>
            </dl>
        </div>
        <div class="box-footer"></div>
    </div>
</div>
   <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Bilgileri</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body" id="search-content">

						<?php 	$jidim=$rows[0]['JID'];
						$query = $admin->link->db_conn_shard->query("select * from _Char inner join _User on _User.CharID=_Char.CharID where _User.UserJID='$jidim'");
		$result = $query->fetchAll();
				if (sizeof($result) == 0){  
		echo 'Karakter bilgisi bulunamadı';
			}else{
	echo'                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>CharID</th>
                            <th>Karakter Adı</th>
                            <th>Race</th>
                            <th>Level</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>';
}
		foreach($result as $row){
 ?>
                                                    <tr>
                                <td><?php echo $row['CharID']; ?></td>
                                <td><?php echo $row['CharName16']; ?></td>
                                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                                <td><?php echo $row['CurLevel']; ?></td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <button class="btn btn-xs btn-info" title="Düzenle" onclick="window.location.replace('admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>');">
                                            <i class="glyphicon glyphicon-edit"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
		<?php } ?>
                                                </tbody>
                    </table>
                </div>
            </div>
			   </div>
</div>
<div class="col-xs-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">Kullanıcı Bilgileri</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" id="search-content">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>JID</th>
                        <th>Kullanıcı Adı</th>
                        <th>Email Adresi</th>
                        <th>Kayıt IP</th>
                        <th>GM Durumu</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
					
                        <td><?php echo $rows[0]['JID']; ?></td>
                        <td><?php echo $rows[0]['StrUserID']; ?></td>
                        <td><?php echo $rows[0]['Email']; ?></td>
                        <td><?php echo $rows[0]['reg_ip']; ?></td>
                        <td><?php if($rows[0]['sec_primary'] == 3){ echo 'Player'; } else{ echo 'GameMaster'; } ?></td>
                        <td>
                            <div class="btn-group btn-group-xs">
                                <button class="btn btn-xs btn-info" title="Düzenle" onclick="window.location.href = 'admin.php?do=useredit&jid=<?php echo $rows[0]['JID']; ?>';">
                                    <i class="glyphicon glyphicon-edit"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
 
 
			<?php
			}
			}
			?>
<?php 
//Kullanıcı Adı Ve Email Değiştir
if(isset($_POST['kullanıcıedit1'])){

	$username = anti_injection(htmlspecialchars($_POST['username']));
	$email = anti_injection(htmlspecialchars($_POST['email']));
		$type = 'Kullanıcı Düzenle Mail & Username';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Email Ve Username Değiştir</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">Değiştirilen Kullanıcı Adı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Değiştirilen Email</td>
                                                                                                                    <td>'.$email.'</td>
                                                                                                            </tr>
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
			if(empty($username) || empty($email)){
		$data['name']="Başarısız";
		$data['text']="Lütfen tüm alanları doldurun.";
		$data['status']="error";		
		echo json_encode($data);	
		}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$data['name']="Başarısız";
		$data['text']="Lütfen gecerli bir mail adresi giriniz.";
		$data['status']="error";		
		echo json_encode($data);
		
		}else{
		$ekle =$admin->link->db_conn_account->query("UPDATE tb_user SET StrUserID='$username' , Email='$email' WHERE JID = (Select JID from tb_user where StrUserID='$username')");
		$ekle =$admin->link->db_conn_shard->query("UPDATE _AccountJID SET AccountID='$username' WHERE JID = (Select JID from sro_vt_account..tb_user where StrUserID='$username')");
	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);
		$data['name']="Başarılı";
		$data['text']="".$username."'nin	Bilgileri hatasız şekilde düzenlendi.";
		$data['status']="success";		
		echo json_encode($data);
		
				
			}else{
				
		$data['name']="Başarısız";
		$data['text']="Üzgünüz işleminizi gercekleştiremedik.";
		$data['status']="error";		
		echo json_encode($data);
			}
		}
}
//Kullanıcı Şifre Değiştir
if(isset($_POST['kullanıcıedit2'])){
$username = anti_injection(htmlspecialchars($_POST['username']));
$pass = anti_injection(htmlspecialchars($_POST['pass']));
$repass = anti_injection(htmlspecialchars($_POST['repass']));
		$type = 'Kullanıcı Şifre Değiştirme';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Kullanıcı Şifre Değiştirme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
											 <tr>
                                                        <td class="text-bold">İşlme yapılan kullanıcı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Değiştirilen Şifre</td>
                                                                                                                    <td>'.$pass.'</td>
                                                                                                            </tr>
                                                                                
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
			if(empty($pass) || empty($repass)){
		$data['name']="Başarısız";
		$data['text']="Lütfen tüm alanları doldurun.";
		$data['status']="error";		
		echo json_encode($data);	
		
		}else if($pass !== $repass){
		$data['name']="Başarısız";
		$data['text']="Şifreler bir biri ile uyuşmuyor.";
		$data['status']="error";		
		echo json_encode($data);

		}else{
			$newpass = md5($pass);	
		$ekle =$admin->link->db_conn_account->query("UPDATE tb_user SET password='$newpass' WHERE JID = (Select JID from tb_user where StrUserID='$username')");

	
			if($ekle == 1){
			$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);	
		$data['name']="Başarılı";
		$data['text']="".$username."'nin	Şifresi hatasız şekilde düzenlendi.";
		$data['status']="success";		
		echo json_encode($data);
		
				
			}else{
				
		$data['name']="Başarısız";
		$data['text']="Üzgünüz işleminizi gercekleştiremedik.";
		$data['status']="error";		
		echo json_encode($data);
			}
		}
}

//Kullanıcı Adı Ve GS Değiştir
if(isset($_POST['kullanıcıedit3'])){
	$username = anti_injection(htmlspecialchars($_POST['username']));
	$gs = anti_injection(htmlspecialchars($_POST['gs']));
	$regs = anti_injection(htmlspecialchars($_POST['regs']));
		$type = 'Kullanıcı Gizli Yanıt Değiştirme';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Kullanıcı İşlemleri</b>
                                            <br>
                                            İşlem: <b>Kullanıcı Gizli Yanıt Değiştirme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
											 <tr>
                                                        <td class="text-bold">İşlme yapılan kullanıcı</td>
                                                                                                                    <td>'.$username.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Değiştirilen Gizli Yanıt</td>
                                                                                                                    <td>'.$gs.'</td>
                                                                                                            </tr>
                                                                                
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';	
			if(empty($gs) || empty($regs)){
		$data['name']="Başarısız";
		$data['text']="Lütfen tüm alanları doldurun.";
		$data['status']="error";		
		echo json_encode($data);	
		}else if($gs !== $regs){
		$data['name']="Başarısız";
		$data['text']="Gizli yanıt bir biri ile uyuşmuyor.";
		$data['status']="error";		
		echo json_encode($data);
		
		}else{
			$newgs = sha1(md5($gs));	
		$ekle =$admin->link->db_conn_account->query("UPDATE tb_user SET address='$newgs' WHERE JID = (Select JID from tb_user where StrUserID='$username')");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);	
		$data['name']="Başarılı";
		$data['text']="".$username."'nin	Bilgileri hatasız şekilde düzenlendi.";
		$data['status']="success";		
		echo json_encode($data);
		
				
			}else{
				
		$data['name']="Başarısız";
		$data['text']="Üzgünüz işleminizi gercekleştiremedik.";
		$data['status']="error";		
		echo json_encode($data);
			}
		}
}

//Karakter Düzenle
if(isset($_POST['karakterdüzenle'])){
	$charname = anti_injection(htmlspecialchars($_POST['charname']));
	$level = anti_injection(htmlspecialchars($_POST['level']));
	$str = anti_injection(htmlspecialchars($_POST['str']));
	$int = anti_injection(htmlspecialchars($_POST['int']));
	$gold = anti_injection(htmlspecialchars($_POST['gold']));
	$skill = anti_injection(htmlspecialchars($_POST['skill']));
	$stat = anti_injection(htmlspecialchars($_POST['stat']));
	$hwan = anti_injection(htmlspecialchars($_POST['hwan']));
		$type = 'Karakter Düzenle';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Karakter Düzenle</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
											 <tr>
                                                        <td class="text-bold">İşlem yapılan Karakter</td>
                                                                                                                    <td>'.$charname.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Level</td>
                                                                                                                    <td>'.$level.'</td>
                                                                                                            </tr>
                                                                                                     <tr>
                                                        <td class="text-bold">Strength</td>
                                                                                                                    <td>'.$str.'</td>
                                                                                                            </tr>
                                             <tr>
                                                        <td class="text-bold">Intellect</td>
                                                                                                                    <td>'.$int.'</td>
                                                                                                            </tr>
                                             <tr>
                                                        <td class="text-bold">Gold</td>
                                                                                                                    <td>'.$gold.'</td>
                                                                                                            </tr>
                                             <tr>
                                                        <td class="text-bold">Skill Point</td>
                                                                                                                    <td>'.$skill.'</td>
                                                                                                            </tr>																											
         <tr>
                                                        <td class="text-bold">Stat Point</td>
                                                                                                                    <td>'.$stat.'</td>
                                                                                                            </tr>	    
         <tr>
                                                        <td class="text-bold">Hwan Level</td>
                                                                                                                    <td>'.$hwan.'</td>
                                                                                                            </tr>																												
                                                                                            </table>  </div> </div>   </div> </div> </div>';		
	
			if(empty($level) || empty($str) || empty($int)){
		$data['name']="Başarısız";
		$data['text']="Lütfen tüm alanları doldurun.";
		$data['status']="error";		
		echo json_encode($data);	
		
		}else{
		
		$ekle =$admin->link->db_conn_shard->query("UPDATE _Char SET CurLevel='$level' , Strength='$str' , Intellect='$int', RemainGold='$gold', RemainSkillPoint='$skill', RemainStatPoint='$stat', HwanLevel='$hwan' WHERE CharID = (Select CharID from _Char where CharName16='$charname')");

	
			if($ekle == 1){
				$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);	
		$data['name']="Başarılı";
		$data['text']="".$charname."'nin	Bilgileri hatasız şekilde düzenlendi.";
		$data['status']="success";		
		echo json_encode($data);
		
				
			}else{
				
		$data['name']="Başarısız";
		$data['text']="Üzgünüz işleminizi gercekleştiremedik.";
		$data['status']="error";		
		echo json_encode($data);
			}
		}
}

//Karakter Skill Sıfırla
if(isset($_POST['kskillsıfırla'])){
$charname = anti_injection(htmlspecialchars($_POST['charname']));
		$type = 'Karakter Skill Sıfırlama';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Karakter Skill Sıfırlama</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">İşlem yapılan karakter</td>
                                                                                                                    <td>'.$charname.'</td>
                                                                                                            </tr>
                                                               
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		$ekle =$admin->link->db_conn_shard->query("DECLARE @CharName varchar(255)
        DECLARE @CharID INT
	declare @TotalSP int, @TotalSPMastery int 
	declare @ExtraSp int = 5000000 -- Extra Sp miktarını buradan ayarlayabilirsiniz.
        SET @CharName='$charname'
        SELECT @CharID = CharID FROM _Char WHERE CharName16=@CharName
	SELECT @TotalSP = SUM(SRO_VT_SHARD.dbo._RefSkill.ReqLearn_SP) FROM SRO_VT_SHARD.dbo._RefSkill, SRO_VT_SHARD.dbo._CharSkill WHERE SRO_VT_SHARD.dbo._RefSkill.ID=SRO_VT_SHARD.dbo._CharSkill.SkillID AND SRO_VT_SHARD.dbo._CharSkill.CharID=@CharID AND SRO_VT_SHARD.dbo._RefSkill.ReqCommon_MasteryLevel1 <= '140'
	SELECT @TotalSPMastery = SUM(SRO_VT_SHARD.dbo._RefLevel.Exp_M) FROM SRO_VT_SHARD.dbo._CharSkillMastery, SRO_VT_SHARD.dbo._RefLevel WHERE SRO_VT_SHARD.dbo._RefLevel.Lvl=SRO_VT_SHARD.dbo._CharSkillMastery.Level AND SRO_VT_SHARD.dbo._CharSkillMastery.CharID=@CharID AND SRO_VT_SHARD.dbo._CharSkillMastery.Level <= '140' 
	UPDATE SRO_VT_SHARD.dbo._Char SET RemainSkillPoint=RemainSkillPoint+@ExtraSp WHERE CharID=@CharID 
	DELETE SRO_VT_SHARD.dbo._CharSkill FROM SRO_VT_SHARD.dbo._RefSkill, SRO_VT_SHARD.dbo._CharSkill WHERE SRO_VT_SHARD.dbo._RefSkill.ID=SRO_VT_SHARD.dbo._CharSkill.SkillID AND SRO_VT_SHARD.dbo._CharSkill.CharID=@CharID AND SRO_VT_SHARD.dbo._RefSkill.ReqCommon_MasteryLevel1 <= '140' AND SRO_VT_SHARD.dbo._RefSkill.ID NOT IN (1,70,40,2,8421,9354,9355,11162,9944,8419,8420,11526,10625) 
	UPDATE SRO_VT_SHARD.dbo._CharSkillMastery SET Level='0' WHERE CharID=@CharID AND Level <= '140'
		");

	
			if($ekle == 1){
$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);				
			echo 'skillok';		
				
			}else{
			echo 'hata';
			}

}

//karakter Stat Sıfırla
if(isset($_POST['kstatsıfırla'])){
$charname = anti_injection(htmlspecialchars($_POST['charname']));
		$type = 'Karakter Stat Sıfırlama';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Karakter Stat Sıfırlama</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">İşlem yapılan karakter</td>
                                                                                                                    <td>'.$charname.'</td>
                                                                                                            </tr>
                                                               
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		$ekle =$admin->link->db_conn_shard->query("DECLARE @CharName varchar(255)
        DECLARE @CharID INT
        SET @CharName='$charname'
        SELECT @CharID = CharID FROM _Char WHERE CharName16=@CharName
		declare @Strength int 
            declare @Intellect int 
            declare @MaxLevel int 
            declare @RemainStatPoint int 
            select @MaxLevel = MaxLevel from SRO_VT_SHARD.._Char where CharID = @CharID
            set @RemainStatPoint = (@MaxLevel*3)-3 
            set @MaxLevel = @MaxLevel+19 
            UPDATE SRO_VT_SHARD.._Char SET Strength=@MaxLevel, Intellect=@MaxLevel, RemainStatPoint=@RemainStatPoint WHERE CharID=@CharID
			DELETE FROM SRO_VT_SHARD.dbo._CharSkill WHERE SkillID BETWEEN '8092' AND '8122' AND CharID = @CharID	");

	
			if($ekle == 1){
$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);				
			echo 'skillok';		
				
			}else{
			echo 'hata';
			}

}

//karakter meslek Sıfırla
if(isset($_POST['kmesleksıfırla'])){
$charname = anti_injection(htmlspecialchars($_POST['charname']));
		$type = 'Karakter Job Ceza Sıfırlama';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Karakter Job Ceza Sıfırlama</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">İşlem yapılan karakter</td>
                                                                                                                    <td>'.$charname.'</td>
                                                                                                            </tr>
                                                               
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		$ekle =$admin->link->db_conn_shard->query("DELETE FROM SRO_VT_SHARD.._TimedJob WHERE CharID='$charname' and (JobID = 1 and Category = 2)");

	
			if($ekle == 1){
$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);						
			echo 'skillok';		
				
			}else{
			echo 'hata';
			}

}

//karakter guild Sıfırla
if(isset($_POST['kguildsıfırla'])){
$charname = anti_injection(htmlspecialchars($_POST['charname']));
		$type = 'Karakter Guild Ceza Sıfırlama';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Karakter İşlemleri</b>
                                            <br>
                                            İşlem: <b>Karakter Guild Ceza Sıfırlama</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">İşlem yapılan karakter</td>
                                                                                                                    <td>'.$charname.'</td>
                                                                                                            </tr>
                                                               
                                              
                                                                                            </table>  </div> </div>   </div> </div> </div>';
		$ekle =$admin->link->db_conn_shard->query("DELETE FROM SRO_VT_SHARD.._TimedJob WHERE CharID='$charname' and (JobID = 2)");

	
			if($ekle == 1){
$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);					
			echo 'skillok';		
				
			}else{
			echo 'hata';
			}

}

//Guild ARa Düzenle :DECLARE
if(isset($_POST['guildüzenle'])){
	$guildname = anti_injection(htmlspecialchars($_POST['guildname']));
	$level = anti_injection(htmlspecialchars($_POST['level']));
	$gold = anti_injection(htmlspecialchars($_POST['gold']));
	$gatheredsp = anti_injection(htmlspecialchars($_POST['gatheredsp']));
	$title = anti_injection(htmlspecialchars($_POST['title']));
	$content = anti_injection(htmlspecialchars($_POST['content']));
		$type = 'Guild Düzenleme';
		$bilgi = '<button type="button" class="close" data-dismiss="modal"
                                                aria-label="Kapat"><span
                                                    aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">İşlem Verileri</h4>
                                        <small class="modal-title">
                                            İşlem Grubu: <b>Guild İşlemleri</b>
                                            <br>
                                            İşlem: <b>Guild Düzenleme</b>
                                        </small>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                                                                    <tr>
                                                        <td class="text-bold">İşlem yapılan Guild</td>
                                                                                                                    <td>'.$guildname.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Level</td>
                                                                                                                    <td>'.$level.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Kasadaki Gold</td>
                                                                                                                    <td>'.$gold.'</td>
                                                                                                            </tr>
                                                                                                    <tr>
                                                        <td class="text-bold">Bağışlanan GP</td>
                                                                                                                    <td>'.$gatheredsp.'</td>
                                                                                                            </tr>																											
                                                                                                    <tr>
                                                        <td class="text-bold">Guild Başlık</td>
                                                                                                                    <td>'.$title.'</td>
                                                                                                            </tr>	
                                                                                                    <tr>
                                                        <td class="text-bold">Guild İçerik</td>
                                                                                                                    <td>'.$content.'</td>
                                                                                                            </tr>																												
                                                                                            </table>  </div> </div>   </div> </div> </div>';	
	
			if(empty($level) || empty($gatheredsp)){
		$data['name']="Başarısız";
		$data['text']="Lütfen tüm alanları doldurun.";
		$data['status']="error";		
		echo json_encode($data);	
		
		}else{
		
		$ekle =$admin->link->db_conn_shard->query("UPDATE _Guild SET Lvl='$level' , Gold='$gold' , GatheredSP='$gatheredsp', MasterCommentTitle='$title', MasterComment='$content' WHERE ID = (Select ID from _Guild where Name='$guildname')");

	
			if($ekle == 1){
		$market_log = $admin->AdminLog($gmadı,$type,trim($bilgi),$tarihver,$_SERVER['REMOTE_ADDR']);			
		$data['name']="Başarılı";
		$data['text']="".$guildname."'nin	Bilgileri hatasız şekilde düzenlendi.";
		$data['status']="success";		
		echo json_encode($data);
		
				
			}else{
				
		$data['name']="Başarısız";
		$data['text']="Üzgünüz işleminizi gercekleştiremedik.";
		$data['status']="error";		
		echo json_encode($data);
			}
		}
}

if($_POST['type'] == 'epins') {

		$data['text']="Şifreler bir biri ile uyuşmuyor.";
		echo json_encode($data);
}
?>			
			<?php
		//Döngüler BİTTİ
		}
			}
			}
			}