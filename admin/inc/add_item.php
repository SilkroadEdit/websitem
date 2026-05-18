<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>	
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Karaktere Item Ver</h3>
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
					
					swal('Başarılı', 'İtem karaktere başarıyla eklendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=add_item';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'İşlem yapmak istediğiniz karakter bulunamadı.');	



				}
			}

		});

	}
</script>
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
								<fieldset style="margin-bottom:15px">
									<div class="box-body">
   
							
									<fieldset style="margin-bottom:15px">
									<div class="form-group" id="group-data">
                        <label for="data" class="col-sm-3 control-label">İtem Kodu </label>

                        <div class="col-sm-8">
									<input type="text" class="form-control" name="item_name">
								</fieldset>
								<fieldset style="margin-bottom:15px">
									<div class="form-group" id="group-data">
                        <label for="data" class="col-sm-3 control-label">Artı Miktarı </label>

                        <div class="col-sm-8">
									<input type="text" class="form-control" name="arti" value="0">
								</fieldset>
								<fieldset style="margin-bottom:15px">
									<div class="form-group" id="group-data">
                        <label for="data" class="col-sm-3 control-label">İtem Miktarı </label>

                        <div class="col-sm-8">
									<input type="text" class="form-control" name="miktar" value="1">
								</fieldset>
								<fieldset style="margin-bottom:15px">
									<div class="form-group" id="group-data">
                        <label for="data" class="col-sm-3 control-label">Karakter Adı </label>

                        <div class="col-sm-8">
									<input type="text" class="form-control" id="test" name="username">
								</fieldset>
								<input type="hidden" name="add_item">
							
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
                                Item Adı kısmına _RefObjCommon tablosunda yer alan CodeName'i yazmalısınız.
                            </li>
                            <li>
                                Giyilebilir itemler için Adet 1 olmalıdır, çoklu item verilmez.
                            </li>
                            <li>
                                Artı değeri verilmeyen normal itemler için Item Artı değeri 0 olmalıdır.
                            </li>
                            <li>
                                Item Adet kısmında Stack'i 1'den büyük, üst üste koyulabilir itemler için 1'den büyük
                                değer verebilirsiniz.
                            </li>
                        </ul>
                </div>
            </div>
        </div>    </div>      
	<?php include('footer.php'); ?>