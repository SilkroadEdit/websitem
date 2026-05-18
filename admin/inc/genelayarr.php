<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
   <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Genel Ayarlar
                    <small>Kullanıcılar ile ilişkili ayarlar</small>
                </h3>
                <div class="box-tools">
               
                </div>
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
					
					swal('Başarılı', 'Genel ayarlar başarıyla güncellendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=genelayarr';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Beklenmedik bir hata oluştu.');	



				}
			}

		});

	}
</script>
					<?php

		$query = $admin->link->db_conn_pann->query("SELECT * FROM gm_settings where id = 1");
		$result = $query->fetchAll();
		foreach($result as $row){
	
		
			?>
     
     	<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
                                            <div class="form-group" id="group-0">
                            <label class="col-sm-3 control-label"
                                   style="margin-top: 24px">Item Statları:</label>

                                                      <div class="col-sm-4">
                                <label class="control-label" for="0-status">Genel Durum</label>
                                <select class="form-control" name="detaygm"
                                        id="0-status">
                                    <option value="0" <?php if($row['detaygm'] == 0){ echo 'selected'; }else{ echo ''; } ?>>Kapalı</option>
                                    <option value="1" <?php if($row['detaygm'] == 1){ echo 'selected'; }else{ echo ''; } ?>>Açık</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="0-permission">Kullanıcı İzni</label>
                                <select class="form-control" name="detayk"
                                        id="0-permission">
                                    <option value="0" <?php if($row['detayk'] == 0){ echo 'selected'; }else{ echo ''; } ?>>Kapalı</option>
                                    <option value="1" <?php if($row['detayk'] == 1){ echo 'selected'; }else{ echo ''; } ?>>Açık</option>
                                </select>
                            </div>
                        </div>
                                            <div class="form-group" id="group-1">
                            <label class="col-sm-3 control-label"
                                   style="margin-top: 24px">Job Adı:</label>

                 

                            <div class="col-sm-4">
                                <label class="control-label" for="1-status">Genel Durum</label>
                                <select class="form-control" name="jobgm"
                                        id="1-status">
                                    <option value="0" <?php if($row['jobgm'] == 0){ echo 'selected'; }else{ echo ''; } ?>>Kapalı</option>
                                    <option value="1" <?php if($row['jobgm'] == 1){ echo 'selected'; }else{ echo ''; } ?>>Açık</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="1-permission">Kullanıcı İzni</label>
                                <select class="form-control" name="jobk"
                                        id="1-permission">
                                    <option value="0" <?php if($row['jobk'] == 0){ echo 'selected'; }else{ echo ''; } ?>>Kapalı</option>
                                    <option value="1" <?php if($row['jobk'] == 1){ echo 'selected'; }else{ echo ''; } ?>>Açık</option>
                                </select>
                            </div>
                        </div>
                                            <div class="form-group" id="group-2">
                            <label class="col-sm-3 control-label"
                                   style="margin-top: 24px">Char Gold:</label>

                         

                            <div class="col-sm-4">
                                <label class="control-label" for="2-status">Genel Durum</label>
                                <select class="form-control" name="goldgm"
                                        id="2-status">
                                    <option value="0" <?php if($row['goldgm'] == 0){ echo 'selected'; }else{ echo ''; } ?>>Kapalı</option>
                                    <option value="1" <?php if($row['goldgm'] == 1){ echo 'selected'; }else{ echo ''; } ?>>Açık</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label class="control-label" for="2-permission">Kullanıcı İzni</label>
                                <select class="form-control" name="goldk"
                                        id="2-permission">
                                    <option value="0" <?php if($row['goldk'] == 0){ echo 'selected'; }else{ echo ''; } ?>>Kapalı</option>
                                    <option value="1" <?php if($row['goldk'] == 1){ echo 'selected'; }else{ echo ''; } ?>>Açık</option>
                                </select>
                            </div>
                        </div>
						<input type="hidden" name="genelsettings">
                                    </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('/admin')">Vazgeç
                    </button>
                    <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
	<?php } ?>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgiler</h3>
            </div>
            <div class="box-body">
			 <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  Kullanıcı izni bölümünden ya hepsini kapatınız yada hicbirini kapatmayınız .
				  Bunun nedeni bazı sorunlar olabilir uyarıyı kaideye almanız dileğiyle ..
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Bu sistem ile kullanıcılarınızın özel olarak kendi ayarlarını yapabilmelerine imkan tanırsınız.
                    Kullanıcılar panellerinde kendi karakterlerine ait item bilgisi, gold, job vb. gizleyebilirler.
                    Kullanıcıların hangi ayarları yapıp hangilerini yapamayacağına siz karar verirsiniz. Ayrıca bir
                    ayarı genel olarakta acıp kapayabilirsiniz. Örneğin; item statlarında, genel durumu kapalı
                    yaparsanız tüm karakterlerin item statları gözükmez.
                </div>
 </div> </div> </div>
	<?php include('footer.php'); ?>