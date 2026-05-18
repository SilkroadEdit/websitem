<?PHP echo !defined("ADMIN") ? die("Hacking?"): null;?>	
		<?php
		$id =(int)htmlspecialchars($_GET['id']);
	
		$query = $admin->link->db_conn_pann->query("SELECT * FROM Haberler WHERE id='$id'");
		$row = $query->fetchAll();
						
			?>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Haber Düzenle</h3>
            </div>
            <form class="form-horizontal" method="post" id="news-edit">
		  <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
			<input type="hidden" name="id" value="<?php echo $row[0]['id']; ?>">
				<input type="hidden" name="haberdüzen">  
                <div class="box-body">
                    <div class="form-group" id="group-title">
                        <label for="title" class="col-sm-2 control-label">Başlık</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="konu_baslik" value="<?php echo $row[0]['baslik']; ?>">
                        </div>
                    </div>
                   				
                    <div class="form-group" id="group-content">
                        <label for="content" class="col-sm-2 control-label">İçerik</label>

                        <div class="col-sm-8">
                            <textarea class="form-control"  name="content"><?php echo $row[0]['icerikfull']; ?></textarea>
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
            <!-- CK Editor -->
            <script src="plugins/ckeditor2/ckeditor.js"></script>
            <script type="text/javascript">
                $(function () {
                    CKEDITOR.replace('content');
                });

                $('#news-edit').submit(function () {
                    var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);
                    removeFormErrors(form);
                    removeAlertBox(form);
                    CKEDITOR.instances.content.updateElement();
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

	<?php include('footer.php'); ?>		