<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<?php 
			$id =(int)htmlspecialchars($_GET['id']);
			$detay = $admin->link->db_conn_pann->query("SELECT * FROM Panel.._Tickets where ID = '$id'");
			$row = $detay->fetchAll();
						?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo $row[0]["Title"]; ?> -
                    <small>
                                                    <?php echo $row[0]["Category"]; ?>
                                            </small>
                </h3>

			
                                    <div class="box-tools">
                       						<?php  if ($row[0]['Status'] == 2){ ?>
	<?php } else { ?>				<script>
	function stat_reset(){
		removeAlertBox('#skillsıfırla');
		
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
			url : "kontrol.php",
		
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
                    </div>
                            </div>
            <div class="box-body" id="ticket-content">
                <div class="col-md-12">
            <div class="post">
            <div class="user-block">
   <span class="username" style="margin-left: 0">
                          <span class="text-primary"><?php echo $row[0]["StrUserID"]; ?></span>
                        </span>
                        <span class="description" style="margin-left: 0">
                            <i class="fa fa-calendar"></i> <?php echo $row[0]["UpdateDate"]; ?></span>
            </div>
           <?php echo html_entity_decode($row[0]['Ticket']) ?>

        </div>
<?php 
$query = $admin->link->db_conn_pann->query("SELECT * FROM Panel.._TicketsAnswer WHERE TicketID ='$id'");
foreach($query as $rows){
?>
            <div class="post">
            <div class="user-block">
                        <span class="username" style="margin-left: 0">
                          <span class="text-primary"><?php echo $rows["StrUserID"]; ?></span>
                        </span>
                        <span class="description" style="margin-left: 0">
                            <i class="fa fa-calendar"></i> <?php echo $rows["Date"]; ?></span>
            </div>
           <?php echo html_entity_decode($rows['Message']) ?>

        </div>
<?php } ?>		
            <div class="row">
        <div class="col-sm-12">
            
        </div>
    </div>
</div>            </div>
            <div class="box-footer">
				<script>
		function kurtarcar(){
		removeAlertBox('#bugkurtars');
		CKEDITOR.instances.ticket.updateElement();
		var bugdeger = $("#bugkurtars").serialize();
			
		$.ajax({
			type : "POST",
			data : bugdeger,
			url : "kontrol.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
				reloadCaptcha();
					 appendAlertBox('#bugkurtars', 'error', 'Boş alanlar mevcut.');
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Bildirim başarılı şekilde iletildi .','success');
					
								setTimeout("window.location = 'admin.php?do=gelenkutusu';", 1900);		
					reloadCaptcha();								
				}else if($.trim(pure) == "bugkpass"){
					 appendAlertBox('#bugkurtars', 'error', 'Güvenlik kodu hatalı .');
					reloadCaptcha();
				}else if($.trim(pure) == "hane"){
					 appendAlertBox('#bugkurtars', 'error', 'Mesaj en az 25 haneden oluşabilir .');
					reloadCaptcha();					
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

                        <div class="form-group" id="group-content">
                            <div class="col-lg-8 col-lg-offset-2">
                                <textarea class="form-control" name="ticket" 
                                          placeholder="Cevap..."
                                          style="resize: vertical"></textarea>
                            </div>
                        </div>
 <input type="hidden" name="addtickets" >
                        <div class="form-group">
                            <div class="col-lg-8 col-lg-offset-2">
                                <button type="reset" class="btn btn-app" style="margin-left: 0"
                                        onclick="window.location.replace('/')">
                                    <i class="fa fa-arrow-left"></i> Geri Dön
                                </button>
								
                                <button type="submit" class="btn btn-app pull-right" onclick="kurtarcar();">
                                    <i class="fa fa-send-o"></i> Yanıtla
                                </button>
								
                            </div>
                        </div>
                    </form>
						<?php  }  ?>
                    <script type="text/javascript">
                        $(function () {
                            CKEDITOR.replace('ticket');
                        });
                    </script>
                            </div>
            <!-- CK Editor -->
            <script src="plugins/ckeditor/ckeditor.js"></script>

        </div>
    </div>

           


	<?php include('footer.php'); ?>
