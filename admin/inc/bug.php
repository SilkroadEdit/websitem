<?PHP error_reporting(E_ALL); ini_set("display_errors", 1); 
echo !defined("ADMIN") ? die("Hacking?"): null;?>	
<script src="plugins/sweetalert/sweetalert.min.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Karakteri Koordinata Işınla</h3>
            </div>
            <form class="form-horizontal" method="post" id="to-coordinate-form">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden" name="returnkarakter">

                <div class="box-body">
                    <div class="callout callout-info">
                        <p>Tüm karakterleri ışınlamak için karakter kısmına <b class="text-red">all</b> yazabilirsiniz.
                        </p>

                    </div>
                    <div class="form-group" id="group-charname">
                        <label for="charname" class="col-sm-4 control-label">Karakter Adı</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="charname">
                        </div>
                    </div>
                    <div class="form-group" id="group-charname">
                        <label for="charname" class="col-sm-4 control-label">LatestRegion</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="region">
                        </div>
                    </div>
                    <div class="form-group" id="group-charname">
                        <label for="charname" class="col-sm-4 control-label">PosX</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="posx">
                        </div>
                    </div>
                    <div class="form-group" id="group-charname">
                        <label for="charname" class="col-sm-4 control-label">PosY</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="posy">
                        </div>
                    </div>	
                    <div class="form-group" id="group-charname">
                        <label for="charname" class="col-sm-4 control-label">PosZ</label>

                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="posz">
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
                $('#to-coordinate-form').submit(function () {
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
        <div class="box box-warning">
            <div class="box-header with-border">
                <h3 class="box-title">Karakteri Başka Bir Karakterin Yanına Işınla</h3>
            </div>
            <form class="form-horizontal" method="post" id="to-another-form">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden" name="returnkarakter2">

                <div class="box-body">
                    <div class="callout callout-info">
                        <p>
                            Karakter Adı kısmına ışınlanmasını istediğiniz karakteri yazmalısınız.
                        </p>
                        <p>
                            Diğer Karakter kısmına ise yanına ışınlanılacak karakteri yazmalısınız.
                        </p>
                    </div>
                    <div class="form-group" id="group-charname">
                        <label for="charname" class="col-sm-4 control-label">Karakter Adı</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="charname">
                        </div>
                    </div>
                    <div class="form-group" id="group-charname2">
                        <label for="charname2" class="col-sm-4 control-label">Diğer Karakter</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control"  name="charname2">
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
                $('#to-another-form').submit(function () {
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

	<?php include('footer.php'); ?>	
		