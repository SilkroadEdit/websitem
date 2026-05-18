<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>	
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Maxigame API Ayarları</h3>
            </div>
		<?php
					$query = $admin->link->db_conn_pann->query("SELECT * FROM maxigame where id =1");
					$row = $query->fetchAll();
	
			?>			
            <form class="form-horizontal" method="post" id="maxigame-update">
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden" name="maxigameayar">
				
                <div class="box-body">

                    <div class="form-group" id="group-apikey">
                        <label for="apikey" class="col-sm-3 control-label">Api Key</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="apikey"
                                   value="<?php echo $row[0]['ApiKey'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-apisecret">
                        <label for="apisecret" class="col-sm-3 control-label">Api Secret</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="apisecret"
                                   value="<?php echo $row[0]['ApiSecret'] ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-chargetype">
                        <label for="chargetype" class="col-sm-3 control-label">Yükleme Tipi</label>

                        <div class="col-sm-8">
                            <select class="form-control" name="chargetype">
                                <option value="1" <?php if($row[0]['ChargeType'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                    TL
                                </option>
                                <option value="2" <?php if($row[0]['ChargeType'] == 2){ echo 'selected'; }else{ echo ''; } ?>>
                                    Silk
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
            <script type="text/javascript">
                $('#maxigame-update').submit(function () {
                    var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);
                    removeFormErrors(form);
                    removeAlertBox(form);
                    $.post("kontrol.php", form.serialize())
                            .done(function (data) {
								var json_obj = $.parseJSON(data);
                                swal({
                                    title: json_obj.title,
                                    text: json_obj.text,
                                    type: json_obj.type,
                                    timer: 2000
                                }, function () {
                                    if (json_obj.url) {
                                        window.location.replace(json_obj.url);
                                    }
                                    form.find('button[type=submit]').attr("disabled", false);
                                });
                            })
                            .fail(function (data) {
                                if (data.responseJSON) {
                                    appendFormErrors(form, data.responseJSON)
                                } else {
                                    swal("Üzgünüz!", "Bir hata meydana geldi.", "error");
                                }
                                form.find('button[type=submit]').attr("disabled", false);
                            });
                    return false;
                });
            </script>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Maxigame İletişim</h3>
            </div>
            <div class="box-body">
                <div class="post text-center">
                    <p>
                        Maxigame Üyelik Adresi:
                        <br>
                        <a href="http://www.maxigame.com/private"
                           target="_blank">http://www.maxigame.com/private</a>
                    </p>
                    <p>
                        Mağaza Açma Adresi:
                        <br>
                        <a href="https://www.maxigame.com/bayilik-basvuru.php" target="_blank">https://www.maxigame.com/bayilik-basvuru.php</a>
                    </p>
                    <p class="text-info">Not : Üye olduktan sonra hesabınızın aktif edilmesi için alttaki iletişim kanallarından maxigame ile kontak kurunuz.</p>
                    <hr>
                    <p> Gazimağusa / Kıbrıs</p>
                    <p><span><i class="fa fa-skype"></i> deepbluen</span></p>
                   
                    <p><span><i class="fa fa-envelope"></i> info@maxigame.com</span></p>
                </div>
            </div>
        </div>
    </div>
    
	<?php include('footer.php'); ?>