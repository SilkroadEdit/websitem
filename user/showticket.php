<?php include('lib/header.php'); ?>
<?php
function sifreureteci(){
 $karakterler = "abcdefghjkmnprstuxvyz23456789ABCDEFGHJKMNPRSTUXVYZ";
 $sifre = '';
 for($i=0;$i<6;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 50};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}

$_SESSION['captcha']=sifreureteci();

?>
		<?php 
			$id =(int)htmlspecialchars($_GET['id']);
			$detay = $users->link->db_conn_pann->query("SELECT * FROM Panel.._Tickets where ID = '$id' and StrUserID = '$_SESSION[username]'");
			$row = $detay->fetchAll();
				if(empty($id)){
					header('Location:index.php');
				}else if(sizeof($row) == 0){
					header('Location:index.php');
					}else{					?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Bildirim Görüntüle</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Bildirim Görüntüle</li>
                                    </ol>

                                </div>
                                <div class="col-sm-6">

                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                   
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    <div class="col-lg-12">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5"><?php echo $row[0]["Title"]; ?> -
                    <small>
                                                    <?php echo $row[0]["Category"]; ?>
                                            </small></h4>
         
				                                  
                       						<?php  if ($row[0]['Status'] == 2){ ?>
	<?php } else { ?>				<script>
	function stat_reset(){
		
		var deger = $("#statsıfırla").serialize();
                    swal({
                        title: "İşlem gerçekleştirilsin mi?",
                        text: "Evete tıkladığınız taktirde işlem geri alınamaz!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Evet",
                        closeOnConfirm: false,
                        cancelButtonText: "Hayır",
                        showLoaderOnConfirm: true,
                        html: false
                    }, function () {
		$.ajax({
			type : "POST",
			data : deger,
			url : "fonks.php",
		
			success : function(pure){

				if($.trim(pure) == "skillok"){
					
					swal('Başarılı', 'Bildirim kapatıldı.', 'success');
					 setTimeout("location.reload();", 2000);
				}else if($.trim(pure) == "hata"){
				swal('Başarısız', 'Üzgünüm işlem gercekleştirilemedi.','error');	



				}
			}
  });

		});

	}
</script><form id="statsıfırla" onsubmit="return false;"> <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>"><input type="hidden" name="id" value="<?php echo $id; ?>"><button class="btn btn-sm btn-danger pull-right" onclick="stat_reset();">Bildirimi Kapat</button><input type="hidden" name="ticketdown"></form><?php  }  ?>
 <br>
                <div class="col-md-12">

             <div class="alert alert-warning" role="alert">
                      
                          <span class="text-danger"><?php echo $row[0]["StrUserID"]; ?>
                        </span>
                       
                            <i class="fa fa-calendar"></i> <?php echo $row[0]["UpdateDate"]; ?>
           
           <?php echo html_entity_decode($row[0]['Ticket']) ?>
 </div>
   
<?php 
$query = $users->link->db_conn_pann->query("SELECT * FROM Panel.._TicketsAnswer WHERE TicketID ='$id'");
foreach($query as $rows){
?>
           
                      						<?php  if ($rows['StrUserID'] == "Yönetici"){ ?>
										   <div class="alert alert-success" role="alert">	
	<?php } else { ?>
             <div class="alert alert-warning" role="alert">
                 <?php  }  ?> 
                        
                          <span class="text-danger"><?php echo $rows["StrUserID"]; ?></span>
                       
                       
                            <i class="fa fa-calendar"></i> <?php echo $rows["Date"]; ?>
         
           <?php echo html_entity_decode($rows['Message']) ?>

        </div>
<?php } ?>
 

	<script>

		function kurtarcar(){
		CKEDITOR.instances.ticket.updateElement();	
		var bugdeger = $("#bugkurtars").serialize();
			
		$.ajax({
			type : "POST",
			data : bugdeger,
			url : "fonks.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
					swal('Başarısız', 'Boş alanlar mevcut.', 'error');
					
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Bildirim başarılı şekilde iletildi .','success');
					
								setTimeout("window.location = 'bildirim.php';", 1900);		
										
				}else if($.trim(pure) == "bugkpass"){
					
					swal('Başarısız', 'Güvenlik kodu hatalı .', 'error');
				}else if($.trim(pure) == "hane"){
				
						swal('Başarısız', 'Lütfen yeniden gönder butonuna tıklayınız.', 'error');	
				}
			}

		});

	}
	</script>
					<?php  if ($row[0]['Status'] == 2){ ?>
	<?php } else { ?>
	
	           <form class="form-horizontal" id="bugkurtars" onsubmit="return false;"  method="post" action="">		
					<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
					<input type="hidden" name="id" value="<?php echo $id; ?>" >
                 <div class="form-group row">
                   <label for="example-text-input" class="col-sm-2 col-form-label">Mesaj</label>

                        <div class="col-sm-8">
                            <textarea class="ckeditor" class="form-control" name="ticket" ></textarea>
                        </div>
                    </div>
					                  <div class="form-group row">
									  <style>
font {
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -o-user-select: none;
  user-select: none;
}
</style>
                   <label >
				   <div id="captchaimg" style="background-color:#000000; "><font size="7" color="gold"><center><?= $_SESSION['captcha'];?></center></font>
                            </div> </label >
                        <div class="col-sm-5">
                           <input type="text" class="form-control input-lg"  name="captcha" placeholder="G&uuml;venlik Kodu">
                        </div>
                    </div> <input type="hidden" name="addtickets" >
                                             <center><div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="kurtarcar();">
                                                        Gönder
                                                    </button><?php  }  ?>
                                                <button type="reset" class="btn btn-secondary waves-effect m-l-5"  onclick="window.location.replace('bildirim.php')">
                                                        Geri Dön
                                                    </button>
                                                </div>
                                            </div></center>
									
           
                    </div>
                </div>
            </form>

            <!-- CK Editor -->
          <script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>

        </div>
    </div> </div> <br><br><br><br><br><br><br><br>
	 <?php } ?>
 
<?php include('lib/footer.php'); ?>