<?PHP error_reporting(E_ALL); ini_set("display_errors", 1); 
echo !defined("ADMIN") ? die("Hacking?"): null;?>	
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Markete Sp Ekle</h3>
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
					
				appendAlertBox('#itemformu', 'error', 'Ürün adı ve miktar boş bırakılamaz.');
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
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
     <div class="box-body">
                    <div class="form-group" id="group-name">
                        <label for="name" class="col-sm-3 control-label">Ürün Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="isim">
                        </div>
                    </div>
                    <div class="form-group" id="group-image">
                        <label for="image" class="col-sm-3 control-label">Ürün Resmi</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="resim" placeholder="http://">
                        </div>
                    </div>
                    <div class="form-group" id="group-total">
                        <label for="total" class="col-sm-3 control-label">Sp Miktarı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pot_sc_miktari">
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
                        <label for="price" class="col-sm-3 control-label">TL Fiyatı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control"  name="tl">
                        </div>
                    </div>
                    <div class="form-group" id="group-row">
                        <label for="row" class="col-sm-3 control-label">Ürün Sırası</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control"  name="sira">
                        </div>
                    </div>
                </div>
<input type="hidden" name="add_msp" >
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
					               <li>Ürün Adı kısmına örneğin, (1M Sp) gibi isim yazmalısınız.</li>
                        <li>Ürün Resmi alanına resmin linkini yazmalısınız.</li>
					
                        <li>Ürün Sırası alanına rakam olarak ürünün gözükeceği sırayı yazmalısınız.</li>
                        <li>Fiyat Tipi alanında sp'nin TL veya Silk ile mi satılacağını seçmelisiniz.</li>
                        <li>Item Fiyatı alanında sp'nin TL veya Silk fiyatını yazmalısınız.</li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
	<?php include('footer.php'); ?>