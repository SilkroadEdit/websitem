<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>	
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Adı Değiştir</h3>
            </div>
<script src="plugins/sweetalert/sweetalert.min.js"></script>
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
					
					swal('Başarılı', 'Karkater adı başarıyla değiştirildi.', 'success');
					 setTimeout("window.location = 'admin.php?do=namek';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'İşlem yapmak istediğiniz karakter bulunamadı.');	
				}else if($.trim(pure) == "hatasaaa"){
				appendAlertBox('#itemformu', 'error', 'Karakter bir guild üyesi guildten cıktıktan sonra tekrardan deneyin');					
				}else if($.trim(pure) == "hatalar"){
				appendAlertBox('#itemformu', 'error', 'Değiştirmek istediğiniz karakter adı zaten kullanılır durumda');


				}
			}

		});

	}
</script>
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
			             <div class="box-body">
                    <div class="form-group" id="group-username">
                        <label for="username" class="col-sm-3 control-label">Karakter Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="username">
                        </div>
                    </div>
                    <div class="form-group" id="group-amount">
                        <label for="amount" class="col-sm-3 control-label">Yeni Karakter Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control"  name="miktar">
                        </div>
                    </div>

								<input type="hidden" name="karaktername">
							
						<footer>
						<div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgeç
                    </button>
					
                    <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
               
					</footer>
		</form>
</article>
         </div>    </div>    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgiler</h3>
            </div>
            <div class="box-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                         <ul>
                            <li>
                                İsim değiştireceğiniz karakter guildte ise guildten cıktıktan sonra işlemi yapınız.
                            </li>
            
                        </ul>
                </div>
            </div>
        </div>    </div>      
	<?php include('footer.php'); ?>	
		