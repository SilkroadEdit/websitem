<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">İndirme Adresi Düzelt</h3>
            </div>
			<script src="plugins/sweetalert/sweetalert.min.js"></script>
		<?php
		$id =(int)htmlspecialchars($_GET['id']);
	
		$query = $admin->link->db_conn_pann->query("SELECT * FROM Download WHERE id='$id'");
		$result = $query->fetchAll();
		foreach($result as $row){
						
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
					
					swal('Başarılı', 'İndirme linki başarılı şekilde düzenlendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=down';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Bir sorun oluştu.');	



				}
			}

		});

	}
</script>
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
		<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
						<fieldset>
							<div class="box-body">
                    <div class="form-group" id="group-title">
                        <label for="title" class="col-sm-3 control-label">Başlık</label>

                        <div class="col-sm-8">
							<input type="text" name="ad" class="form-control" value="<?php echo $row['ad']; ?>">
						</fieldset>
						<fieldset>
						<div class="box-body">
							<div class="form-group" id="group-link">
                        <label for="link" class="col-sm-3 control-label">İndirme Adresi</label>

                        <div class="col-sm-8">
							<input type="text" name="link" class="form-control" value="<?php echo $row['link']; ?>">
						</fieldset>
<input type="hidden" name="downdüzen">
				<div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgeç
                    </button>
                  <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
                </div>
				</div>
				</div></form>
<?php include('footer.php'); ?>
		<?php } ?>
		