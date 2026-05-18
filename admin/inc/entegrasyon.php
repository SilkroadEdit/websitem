<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Skill Ve Stat Sıfırlama Fiyatları</h3>
            </div>
			<script src="plugins/sweetalert/sweetalert.min.js"></script>
		<?php
					$query = $admin->link->db_conn_pann->query("SELECT * FROM SpecialFiyat");
					$row = $query->fetchAll();
	
			?>
	
	
<script>
	function itemver(){
		removeAlertBox('#itemformu');
		var deger = $("#itemformu").serialize();
			
		$.ajax({
			type : "POST",
			data : deger,
			url : "kontrol.php",
		
			success : function(pure){

				if($.trim(pure) == "bos"){
					
				appendAlertBox('#itemformu', 'error', 'Lütfen tüm alanları doldurunuz.');
				}else if($.trim(pure) == "itemok"){
					
					swal('Başarılı', 'Fiyatlar başarılı şekilde düzenlendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=entegrasyon';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Bir sorun oluştu.');	



				}
			}

		});

	}
</script>
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
					 <div class="box-body">
                    <div class="form-group" id="group-site_title">
                        <label for="site_title" class="col-sm-4 control-label">Stat Sıfırlama TL Miktarı</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="stattl"
                              value="<?php echo $row[0]['stattl'] ?>"  >
                        </div>
                    </div>
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Stat Sıfırlama Silk Miktarı</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="statsilk"
                                   value="<?php echo $row[0]['statsilk'] ?>"   >
                        </div>
                    </div>

                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Skill Sıfırlama TL Miktarı</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="skilltl"
                                    value="<?php echo $row[0]['skilltl'] ?>"  >
                        </div>
                    </div>
					
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Skill Sıfırlama Silk Miktarı</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="skillsilk"
                                  value="<?php echo $row[0]['skillsilk'] ?>" >
                        </div>
                    </div>

  
                </div>

					<input type="hidden" name="add_ente" >
				<footer>
				<div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgeç
                    </button>
      <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
                </div>
				
            </form>
                    </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgilendirme</h3>
            </div>
            <div class="box-body">
               <div class="callout callout-info">
                             <ul>
                        <li>Eğer TL miktarı 1 TL'nin üzerindeyse silk miktarı gözükmez lakin
						ücret işlem yapılırken her 2 (Silk Ve TL) side karakterden alınır.
                        </li>
       
                    </ul>
                </div>

            </div>
        </div>

   
    </div>
	<?php include('footer.php'); ?>
