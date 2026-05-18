<?PHP error_reporting(E_ALL); ini_set("display_errors", 1); 
echo !defined("ADMIN") ? die("Hacking?"): null;?>	
<script src="plugins/sweetalert/sweetalert.min.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Markete Rütbe Ekle</h3>
            </div>
            <form class="form-horizontal" method="post" id="market-create">
                <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">

                <input type="hidden" name="add_mrutbe">

                <div class="box-body">
                    <div class="form-group" id="group-name">
                        <label for="name" class="col-sm-3 control-label">Ürün Adı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="isim">
                        </div>
                    </div>
                    <div class="form-group" id="group-image">
                        <label for="image" class="col-sm-3 control-label">Ürün Resmi</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="resim" placeholder="http://">
                        </div>
                    </div>
                    <div class="form-group" id="group-total">
                        <label for="total" class="col-sm-3 control-label">Rütbe Numarası</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="pot_sc_miktari">
                        </div>
                    </div>
                    <div class="form-group" id="group-price_type">
                        <label for="price_type" class="col-sm-3 control-label">Fiyat Tipi</label>

                        <div class="col-sm-8">
                            <select class="form-control" name="silk">
                                <option value="1">TL ile Sat</option>
                                <option value="2">Silk ile Sat</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="group-price">
                        <label for="price" class="col-sm-3 control-label">Rütbe Fiyatı</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tl">
                        </div>
                    </div>
                    <div class="form-group" id="group-row">
                        <label for="row" class="col-sm-3 control-label">Ürün Sırası</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="sira">
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
                $('#market-create').submit(function () {
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
                <h3 class="box-title">Bilgiler</h3>

                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="callout callout-info">
  <ul>
                        <li>Ürün Adı kısmına örneğin, (General Rütbesi) gibi isim yazmalısınız.</li>
                        <li>Ürün Resmi alanına resmin linkini yazmalısınız.</li>
                        <li>Rütbe Numarası alanına _RefHWANLevel tablosunda yer alan HwanLevel'i yazmalısınız. Örneğin; 1 = General, 2 = Baronet</li>
                        <li>Fiyat Tipi alanında rütbenin TL veya Silk ile mi satılacağını seçmelisiniz.</li>
                        <li>Rütbe Fiyatı alanında rütbenin TL veya Silk fiyatını yazmalısınız.</li>
                        <li>Ürün Sırası alanına rakam olarak ürünün gözükeceği sırayı yazmalısınız.</li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
	<?php include('footer.php'); ?>