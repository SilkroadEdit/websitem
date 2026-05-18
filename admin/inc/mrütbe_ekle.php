<?PHP error_reporting(E_ALL); ini_set("display_errors", 1); 
echo !defined("ADMIN") ? die("Hacking?"): null;?>	
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Markete Item Ekle</h3>
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
					
				appendAlertBox('#itemformu', 'error', 'Ürün adı ve kod boş bırakılamaz.');
				}else if($.trim(pure) == "itemok"){
					
					swal('Başarılı', 'Ürün markete başarılı şekilde eklendi..', 'success');
					 setTimeout("window.location = 'admin.php?do=market';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Bir sorun oluştu.');	



				}
			}

		});

	}
</script>
	
		<form id="itemformu" onsubmit="return false;" class="form-horizontal" method="post" >
<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">

                <div class="box-body">
                    <div class="form-group" id="group-code_name">
                        <label for="code_name" class="col-sm-3 control-label">Item Kodu</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="kod" placeholder="ITEM_">
                        </div>
                    </div>
                    <div class="form-group" id="group-name">
                        <label for="name" class="col-sm-3 control-label">Item Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="isim">
                        </div>
                    </div>
                    <div class="form-group" id="group-image">
                        <label for="image" class="col-sm-3 control-label">Item Resmi</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="resim" placeholder="http://">
                        </div>
                    </div>
                    <div class="form-group" id="group-optlevel">
                        <label for="optlevel" class="col-sm-3 control-label">Item Artısı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="arti_miktari" value="0">
                        </div>
                    </div>
                    <div class="form-group" id="group-total">
                        <label for="total" class="col-sm-3 control-label">Item Adeti</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pot_sc_miktari" value="1">
                        </div>
                    </div>
                    <div class="form-group" id="group-price_type">
                        <label for="price_type" class="col-sm-3 control-label">Fiyat Tipi</label>

                        <div class="col-sm-8">
                            <select class="form-control" name="silk">
                                <option value="1">TL ile Sat</option>
                                <option value="2">Silk ile Sat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-price">
                        <label for="price" class="col-sm-3 control-label">Item Fiyatı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tl">
                        </div>
                    </div>
                    <div class="form-group" id="group-row">
                        <label for="row" class="col-sm-3 control-label">Item Sırası</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="sira">
                        </div>
                    </div>
                </div>
				<input type="hidden" name="add_mitem" >	
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('/admin')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right" onclick="itemver();">Gönder</button>
                </div>
            </form>

            
       </div> 
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgiler</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="callout callout-info">
  <ul>
                        <li>Ürün Adı kısmına örneğin, (General Rütbesi) gibi isim yazmalısınız.</li>
                        <li>Ürün Resmi alanına resmin linkini yazmalısınız.</li>
                        <li>Rütbe Numarası alanına _RefHWANLevel tablosunda yer alan HwanLevel'i yazmalısınız. Örneğin; 1 = General, 2 = Baronet</li>
                        <li>Fiyat Tipi alanında rütbenin TL veya Silk ile mi satılacağını seçmelisiniz.</li>
                        <li>Rütbe Fiyatı alanında rütbenin TL veya Silk fiyatını yazmalısınız.</li>
                        <li>Ürün Sırası alanına rakam olarak ürünün gözükeceği sırayı yazmalısınız.</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
	<?php include('footer.php'); ?>