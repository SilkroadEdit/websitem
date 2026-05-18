<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>
			<?php
						$jid = (int)htmlspecialchars($_GET['jid']);
						$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬-]/';
			$detay = $admin->link->db_conn_account->query("SELECT * FROM tb_user WHERE JID = '$jid'");
					$row = $detay->fetchAll();
				if(empty($jid)){
		?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL=admin.php"> <?php
		exit();
				}else if(sizeof($row) == 0){
		?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL=admin.php"> <?php
		exit();
					}else{

								?>	
       <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcı Düzenle - <?php echo $row[0]['StrUserID']; ?></h3>
            </div>
            <form class="form-horizontal" method="post" id="user-update">
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
                    <div class="form-group" id="group-username">
                        <label for="username" class="col-sm-3 control-label">Kullanıcı Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="username" name="username"
                                   value="<?php echo $row[0]['StrUserID']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-email">
                        <label for="email" class="col-sm-3 control-label">Email Adresi</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="email" name="email"
                                   value="">
                        </div>
                    </div>
					<input type="hidden" name="kullanıcıedit1" id="kullanıcıedit1" >
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php?do=kullanici')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
            <script type="text/javascript">
			    $('#user-update').submit(function () {
					
        var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);		
		removeAlertBox(form);
        $.post("kontrol.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    swal(json_obj.name,json_obj.text,json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alert('Lütfen, özel karakter kullanmayın.', 'error');
                }
              
            })
            .fail(function () {
                alert('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');

            });
		form.find('button[type=submit]').attr("disabled", false);	
        return false;
    });
   
            </script>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcının Şifresini Değiştir</h3>
            </div>
            <form class="form-horizontal" method="post" id="user-change-pw">
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
                    <div class="form-group" id="group-password">
                        <label for="password" class="col-sm-3 control-label">Şifre</label>
							<input type="hidden" name="username" id="username" value="<?php echo $row[0]['StrUserID']; ?>">
                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div>
                    </div>
                    <div class="form-group" id="group-password_confirmation">
                        <label for="password_confirmation" class="col-sm-3 control-label">Şifre Tekrar</label>

                        <div class="col-sm-8">
                            <input type="password" class="form-control" id="repass"
                                   name="repass">
                        </div>
                    </div>
										<input type="hidden" name="kullanıcıedit2" id="kullanıcıedit2" >
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php?do=kullanici')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
			            <script type="text/javascript">
			    $('#user-change-pw').submit(function () {
					
        var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);		
		removeAlertBox(form);
        $.post("kontrol.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    swal(json_obj.name,json_obj.text,json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alert('Lütfen, özel karakter kullanmayın.', 'error');
                }
              
            })
            .fail(function () {
                alert('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');

            });
		form.find('button[type=submit]').attr("disabled", false);	
        return false;
    });
   
            </script>

            <div class="box-header with-border">
                <h3 class="box-title">Kullanıcının Gizli Yanıtını Değiştir</h3>
            </div>
            <form class="form-horizontal" method="post" id="user-change-secret">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden"  name="username" value="<?php echo $row[0]['StrUserID']; ?>">

                <div class="box-body">
                    <div class="form-group" id="group-secret">
                        <label for="secret" class="col-sm-3 control-label">Gizli Yanıt</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="gs">
                        </div>
                    </div>
                    <div class="form-group" id="group-secret_confirmation">
                        <label for="secret_confirmation" class="col-sm-3 control-label">Gizli Yanıt Tekrar</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" 
                                   name="regs">
                        </div>
                    </div>
					<input type="hidden"  name="kullanıcıedit3">
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php?do=kullanici')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
<script type="text/javascript">
			    $('#user-change-secret').submit(function () {
					
        var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);		
		removeAlertBox(form);
        $.post("kontrol.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    swal(json_obj.name,json_obj.text,json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alert('Lütfen, özel karakter kullanmayın.', 'error');
                }
              
            })
            .fail(function () {
                alert('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');

            });
		form.find('button[type=submit]').attr("disabled", false);	
        return false;
    });
   
            </script>
 

</div> </div>
		<?php include('footer.php'); ?>
					<?php } ?>		