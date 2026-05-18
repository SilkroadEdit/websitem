<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>	
<script src="plugins/sweetalert/sweetalert.min.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Veritabanı Temizleme</h3>
            </div>
            <div class="box-body" id="table-menu">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Market Geçmişi</p>
                        </div>
                        <a href="#" data-type="market_items" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Bildirimler</p>
                        </div>
                        <a href="#" data-type="tickets" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Haberler</p>
                        </div>
                        <a href="#" data-type="posts" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Yardım Konuları</p>
                        </div>
                        <a href="#" data-type="faqs" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Dosyalar</p>
                        </div>
                        <a href="#" data-type="downloads" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Banka Hesapları</p>
                        </div>
                        <a href="#" data-type="bank_accounts" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Çarkıfelek Ödül Geçmişi</p>
                        </div>
                        <a href="#" data-type="wheel" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Özel İşlem Geçmişi</p>
                        </div>
                        <a href="#" data-type="special_actions" class="small-box-footer">Temizle <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#table-menu').find('a').click(function () {
                    var type = $(this).data('type');
                    swal({
                        title: "İşlem gerçekleştirilsin mi?",
                        text: "Evete tıkladığınız taktirde işlem geri alınamaz!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Evet",
                        closeOnConfirm: false,
                        cancelButtonText: "Hayır",
                        showLoaderOnConfirm: true,
                        html: false
                    }, function () {
                        $.post("kontrol.php",
                            {
                                'action': type,
								'_token':'<?php echo $_SESSION['_token']; ?>'
                            })
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
                                });
                            })
                            .fail(function (data) {
                                data = data.responseJSON;
                                swal({
                                    title: data.title ? data.title : 'Üzgünüz!',
                                    text: data.text ? data.text : "Bir hata meydana geldi.",
                                    type: data.type ? data.type : 'error',
                                    timer: 2000
                                });
                            });
                    });
                    return false;
                });
            </script>

        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Uyarılar!</h3>
            </div>
            <div class="box-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Burada yapacağınız işlemlerin geri dönüşü yoktur. Lütfen temizlemek istediğiniz tabloyu dikkatli
                        seçin.</b>
                </div>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>
                        Bildiri temizlemede ilişkili tüm tablolar temizlenir.
                    </b>
                </div>
            </div>
        </div> </div>
	<?php include('footer.php'); ?>
		
