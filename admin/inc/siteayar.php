<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Site Ayar</h3>
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
					
					swal('Başarılı', 'Site ayarları başarıyla güncellendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=siteayar';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Beklenmedik bir hata oluştu.');	



				}
			}

		});

	}
</script>
		<?php

		$query = $admin->link->db_conn_pann->query("SELECT * FROM Siteayar where id = 1");
		$row = $query->fetchAll();

			?>
	
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
					 <div class="box-body">
                    <div class="form-group" id="group-site_title">
                        <label for="site_title" class="col-sm-4 control-label">Site Başlığı</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="oyunismi"
                                  value="<?php echo $row[0]['oyunismi'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Site Logo</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="oyunlogo"
                                   value="<?php echo $row[0]['oyunlogo'] ?>">
                        </div>
                    </div>
				
					 <div class="form-group" id="group-site_title">
                        <label for="site_title" class="col-sm-4 control-label">Free Silk</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" maxlength="9" name="silk"
                                  value="<?php echo $row[0]['silk'] ?>">
                        </div>
                    </div>
				
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Level Cap</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="levelcap"
                                   value="<?php echo $row[0]['levelcap'] ?>">
                        </div>
                    </div>
					
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Mastery Cap</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="masterycap"
                                   value="<?php echo $row[0]['masterycap'] ?>">
                        </div>
                    </div>

                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Silk</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="baslangic"
                                   value="<?php echo $row[0]['baslangic'] ?>">
                        </div>
                    </div>

                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">İrk</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="irk"
                                   value="<?php echo $row[0]['irk'] ?>">
                        </div>
                    </div>					
					
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Exp Rate</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"  name="exprate"
                                   value="<?php echo $row[0]['exprate'] ?>">
                        </div>
                    </div>
					
                    <div class="form-group" id="group-site_logo">
                        <label for="site_logo" class="col-sm-4 control-label">Sp Rate</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="sprate"
                                   value="<?php echo $row[0]['sprate'] ?>">
                        </div>
                    </div>					
					
                    <div class="form-group" id="group-facebook">
                        <label for="facebook" class="col-sm-4 control-label">Facebook Adresi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="facebook"
                                   value="<?php echo $row[0]['facebook'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-skype">
                        <label for="skype" class="col-sm-4 control-label">Skype Adresi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="skype"
                                   value="<?php echo $row[0]['skype'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-youtube">
                        <label for="youtube" class="col-sm-4 control-label">Youtube Adresi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="youtube"
                                   value="<?php echo $row[0]['youtube'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-google">
                        <label for="google" class="col-sm-4 control-label">Google Adresi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="google"
                                   value="<?php echo $row[0]['google'] ?>">
                        </div>
                    </div>
                   
                    <div class="form-group" id="group-silk">
                        <label for="silk" class="col-sm-4 control-label">Twitter Adresi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="twitter"
                                   value="<?php echo $row[0]['twitter'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-capacity">
                        <label for="capacity" class="col-sm-4 control-label">Sunucu Kapasitesi</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="kapasite"
                                   value="<?php echo $row[0]['kapasite'] ?>">
                        </div>
                    </div>
					<div class="form-group" id="group-capacity">
                        <label for="capacity" class="col-sm-4 control-label">Fake Oyuncu CH</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="fake_ch"
                                   value="<?php echo $row[0]['ch_fake'] ?>">
                        </div>
                    </div>
					<div class="form-group" id="group-capacity">
                        <label for="capacity" class="col-sm-4 control-label">Fake Oyuncu EU</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="fake_eu"
                                   value="<?php echo $row[0]['eu_fake'] ?>">
                        </div>
                    </div>
					 <div class="form-group" id="group-capacity">
                        <label for="capacity" class="col-sm-4 control-label">Fake Oyuncu Totel</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="fake_total"
                                   value="<?php echo $row[0]['total_fake'] ?>">
                        </div>
                    </div>

<input type="hidden" name="add_ayar">
				<footer>
				<div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgeç
                    </button>
     <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
               
                </div>
				
            </form>
</div></div></div>
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgiler</h3>
            </div>
            <div class="box-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Site Logo</b>, kısmına oyun adınızı veya logo linkini yazabilirsiniz.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Sosyal Medya ve İletişim</b>, adreslerini dilerseniz boş bırakabilirsiniz.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Sunucu Kapasitesi</b>, Sunucu Durumu için gereklidir.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Önemli Bilgi</b>, Free silk bölümü kayıt olurken verilecek silk miktarıdır. Örnek : 99999999
<br>
					Silk bölümü sitede gözükecek olan bölümdür. Örnek : 1M Free
                </div>
				                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Fake Oyuncu</b>, Player sayısının üstüne eklemek istediğiniz rakamı yazınız.

                </div>
            </div>
        </div>
</div>
	<?php include('footer.php'); ?>

		