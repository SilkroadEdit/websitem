<?PHP error_reporting(E_ALL); ini_set("display_errors", 1); 
echo !defined("ADMIN") ? die("Hacking?"): null;?>	

<script src="plugins/sweetalert/sweetalert.min.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">TL Ödülü Ekle</h3>
            </div>
            <form class="form-horizontal" method="post" id="reward-create">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden" name="wheeltl">

                <div class="box-body">

                    <div class="form-group" id="group-name">
                        <label for="name" class="col-sm-3 control-label">Ödül Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group" id="group-image">
                        <label for="image" class="col-sm-3 control-label">Ödül Resmi</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="image" placeholder="http://">
                        </div>
                    </div>

                    <div class="form-group" id="group-total">
                        <label for="total" class="col-sm-3 control-label">TL Miktarı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="total" value="1">
                        </div>
                    </div>
                </div>
                <div class="form-group" id="group-ratio">
                    <label for="ratio" class="col-sm-3 control-label">Şans Oranı</label>

                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="ratio">
                    </div>
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                             onclick="window.location.replace('admin.php?do=wheel')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
            <script type="text/javascript">
                $('#reward-create').submit(function () {
                    var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);
                    removeFormErrors(form);
                    removeAlertBox(form);
                    $.post("kontrol.php", form.serialize())
                                .done(function (data) {
									var json_obj = $.parseJSON(data);
									swal(json_obj.title, json_obj.text, json_obj.type);
									if (json_obj.type == 'success') {
									form.find('button[type=submit]').attr("disabled", false);		
									setTimeout("window.location = 'admin.php?do=wheel';", 1800);
										return true;
										}
									if (json_obj.type == 'error') {
									form.find('button[type=submit]').attr("disabled", false);
										}										
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
                <h3 class="box-title">Bilgiler</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="callout callout-info">
                    <ul>
                        <li>Ödül Adı kısmına örneğin, (10 TL) gibi isim yazmalısınız.</li>
                        <li>Ödül Resmi alanına resmin linkini yazmalısınız.</li>

                        <li>Şans Oranı alanına bir rakam yazmalısınız. Rakam arttıkça
                            ödülün çıkma olasılığı artacaktır. 
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
	<?php include('footer.php'); ?>
