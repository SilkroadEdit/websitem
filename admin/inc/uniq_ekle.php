<?PHP echo !defined("ADMIN") ? die("Hacking?"): null;?>	
  <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Unique Puani Ekle</h3>
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
					
					swal('Başarılı', 'Unique puan başarıyla eklendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=uniqlog';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Bir sorun oluştu.');	



				}
			}

		});

	}
</script>
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
				<br>		<fieldset>
							<div class="box-body">
       

                    <div class="form-group" id="group-mob_name">
                        <label for="mob_name" class="col-sm-3 control-label">Mob Kodu</label>

                        <div class="col-sm-8">

							<input type="text" name="unique" class="form-control" placeholder="MOB_" >
						</fieldset>
						<fieldset>
						<div class="box-body">
					                            <div class="form-group" id="group-point">
                        <label for="point" class="col-sm-3 control-label">Puani</label>

                        <div class="col-sm-8">

							<input type="text" name="point" class="form-control" >
						</fieldset>
				<input type="hidden" name="add_puan" >
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgec
                    </button>
                    <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
                </div>

				
            </form>
           </div>    </div>    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgiler</h3>
            </div>
            <div class="box-body">
                           <div class="callout callout-info">
                        <p>Mob Koduna _RefObjCommon tablosunda yer alan CodeName'i yazmalisiniz.</p>
                    </div>
            </div>
        </div>    </div> 
     
<?php include('footer.php'); ?>
   
	
	
