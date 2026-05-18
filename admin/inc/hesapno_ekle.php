<?PHP error_reporting(E_ALL); ini_set("display_errors", 1); 
echo !defined("ADMIN") ? die("Hacking?"): null;?>	
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Banka Hesabı Ekle</h3>
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
					
				appendAlertBox('#itemformu', 'error', 'Banka adı boş bırakılamaz.');
				}else if($.trim(pure) == "itemok"){
					
					swal('Başarılı', 'Hesap numarası başarıyla eklendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=hesapno';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Bir sorun oluştu.');	



				}
			}

		});

	}
</script>
	
		<form id="itemformu" onsubmit="return false;" action="" method="post">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
					<div class="box-body">

						
						<fieldset>
							<div class="box-body">
                    <div class="form-group" id="group-code_name">
                        <label for="code_name" class="col-sm-3 control-label">Banka Adı</label>

                        <div class="col-sm-8">
							<input type="text" name="banka_adi" class="form-control">
						</fieldset>
						<fieldset>
							<div class="box-body">
                    <div class="form-group" id="group-code_name">
                        <label for="code_name" class="col-sm-3 control-label">Şube Kodu</label>

                        <div class="col-sm-8">
							<input type="text" name="sube_no" class="form-control">
						</fieldset>
						<fieldset>
							<div class="box-body">
                    <div class="form-group" id="group-code_name">
                        <label for="code_name" class="col-sm-3 control-label">IBAN</label>

                        <div class="col-sm-8">
							<input type="text" name="iban" class="form-control">
						</fieldset>
						<fieldset>
							<div class="box-body">
                    <div class="form-group" id="group-code_name">
                        <label for="code_name" class="col-sm-3 control-label">Hesap No</label>

                        <div class="col-sm-8">
							<input type="text" name="hesap_no" class="form-control">
						</fieldset>
						<fieldset>
							<div class="box-body">
                    <div class="form-group" id="group-code_name">
                        <label for="code_name" class="col-sm-3 control-label">Hesap Sahibi</label>

                        <div class="col-sm-8">
							<input type="text" name="hesap_sahibi" class="form-control">
						</fieldset>
				<input type="hidden" name="add_banka" >	
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
			</div>
	<?php include('footer.php'); ?>