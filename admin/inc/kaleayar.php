<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kale Ayar</h3>
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
					
				appendAlertBox('#itemformu', 'error', 'Oyun ismi ve oyun logo boş bırakılamaz.');
				}else if($.trim(pure) == "itemok"){
					
					swal('Başarılı', 'Kale ayarları başarıyla güncellendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=kaleayar';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Beklenmedik bir hata oluştu.');	



				}
			}

		});

	}
</script>
		<?php

		$query = $admin->link->db_conn_pann->query("SELECT * FROM kaleayar where id = 1");
		$row = $query->fetchAll();

			?>
	
	
			<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
                    <div class="form-group" id="group-jangan">
                        <label for="jangan" class="col-sm-3 control-label">Jangan</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="jangan" name="jangan">
                                <option value="0" <?php if($row[0]['jangan'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['jangan'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-hotan">
                        <label for="hotan" class="col-sm-3 control-label">Hotan</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="hotan" name="hotan">
                                <option value="0" <?php if($row[0]['hotan'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['hotan'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-bandit">
                        <label for="bandit" class="col-sm-3 control-label">Bandit</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="bandit" name="bandit">
                                <option value="0" <?php if($row[0]['bandit'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['bandit'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-constantinople">
                        <label for="constantinople" class="col-sm-3 control-label">Constantinople</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="constantinople" name="cons">
                                <option value="0" <?php if($row[0]['cons'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['cons'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

					
	<input type="hidden" name="add_kale">
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
                <h3 class="box-title">Uyarı!</h3>
            </div>
            <div class="box-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Buradan sadece sitedeki kalelerin gösterimini açıp kapayabilirsiniz.</b>
                </div>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Burada yaptığınız ayarlar oyundaki kale durumunu etkilemez.</b>
                </div>
            </div>
        </div>
  
    </div>
	<?php include('footer.php'); ?>
