<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bölüm Ayar</h3>
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
					
					swal('Başarılı', 'Bölüm ayarları başarıyla güncellendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=bolumayar';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Beklenmedik bir hata oluştu.');	



				}
			}

		});

	}
</script>
		<?php			
		$query = $admin->link->db_conn_pann->query("SELECT * FROM Bolum where id = 1");
		$row = $query->fetchAll();
		
			?>
	
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
 
					                    <div class="form-group" id="group-jangan">
                        <label for="jangan" class="col-sm-3 control-label">Kayıt Ol</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="jangan" name="kayit">
                                <option value="0" <?php if($row[0]['kayit'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['kayit'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
					                    <div class="form-group" id="group-jangan">
                        <label for="jangan" class="col-sm-3 control-label">Stat Sıfırlama</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="jangan" name="stat">
                                <option value="0" <?php if($row[0]['stat'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['stat'] == 1){ echo 'selected'; }else{ echo ''; } ?> >
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-hotan">
                        <label for="hotan" class="col-sm-3 control-label">Skill Sıfırlama</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="hotan" name="stats">
                                <option value="0" <?php if($row[0]['stats'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['stats'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-bandit">
                        <label for="bandit" class="col-sm-3 control-label">Bildirim</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="bandit" name="bugkurtar">
                                <option value="0" <?php if($row[0]['karakter'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['karakter'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-constantinople">
                        <label for="constantinople" class="col-sm-3 control-label">Şifremi Unuttum</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="constantinople" name="unuttum">
                                <option value="0" <?php if($row[0]['unuttum'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['unuttum'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-constantinople">
                        <label for="constantinople" class="col-sm-3 control-label">Hesap No</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="constantinople" name="hesapno">
                                <option value="0" <?php if($row[0]['hesapno'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['hesapno'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>		
                    <div class="form-group" id="group-constantinople">
                        <label for="constantinople" class="col-sm-3 control-label">İstatistikler</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="constantinople" name="istatislik">
                                <option value="0" <?php if($row[0]['istatislik'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['istatislik'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>	
                    <div class="form-group" id="group-constantinople">
                        <label for="constantinople" class="col-sm-3 control-label">User Genel</label>

                        <div class="col-sm-8">
                            <select class="form-control" id="constantinople" name="usergenel">
                                <option value="0" <?php if($row[0]['usergenel'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                    Kapalı
                                </option>
                                <option value="1" <?php if($row[0]['usergenel'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    Açık
                                </option>
                            </select>
                        </div>
                    </div>					
                </div>

					<input type="hidden" name="add_bolum">
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
                    
                    <b>User Genel</b> bölümü user panelde bulunan server toplam sox,server toplam gold v.s olan bölümdür.
                </div>
                
            </div>
        </div>
 
    </div>
	<?php include('footer.php'); ?>