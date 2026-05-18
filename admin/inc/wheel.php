<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
     <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
					<?php 
			$degerler =$admin->link->db_conn_pann->query("select * from game_rewards");	
			$degerler2 =$admin->link->db_conn_pann->query("select * from wheelsettings");
			$ayar = $degerler2->fetchAll();
			$rank = 1;			
		?>
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Çarkıfelek Ayarları</h3>
                    </div>
                    <form class="form-horizontal" method="post" id="wheel-update">
					<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                        <input type="hidden" name="wheel">

                        <div class="box-body">
                            <div class="form-group" id="group-state">
                                <label for="state" class="col-sm-4 control-label">Durum</label>

                                <div class="col-sm-6">
                                    <select class="form-control" name="state">
                                        <option value="0" <?php if($ayar[0]['type'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                            Kapalı
                                        </option>
                                        <option value="1" <?php if($ayar[0]['type'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                            Açık
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group" id="group-price">
                                <label for="price" class="col-sm-4 control-label">Kredi</label>

                                <div class="col-sm-6">
                                    <input type="text" class="form-control"  name="price"
                                           value="<?php echo $ayar[0]['WheelPrice']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="reset" class="btn btn-default"
                                    onclick="window.location.replace('/')">Vazgeç
                            </button>
                            <button type="submit" class="btn btn-info pull-right">Gönder</button>
                        </div>
                    </form>
                    <script type="text/javascript">
                        $('#wheel-update').submit(function () {
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
                    </div>

                    <div class="box-body">
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Kredi</b>, alanına oyunu oynamak için gereken kredi miktarını yazmalısınız. Krediler, TL
                            ve Silk'ten bagımsız olarak sadece oyunlar için kullanılmaktadır, dilerseniz markette TL
                            veya Silk karşılığında Oyun Kredisi satabilirsiniz.
                        </div>
					
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Ödüller,</b>user panel'de ödüller bölümü 10 dakikada bir güncellenir.<br>
                        </div>
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <b>Durum,</b>bölümünden çarkıfelek sisteminin aktif olup olmadığını seçmeniz gerekmektedir.<br>
						
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Çarkıfelek Ödülleri
                            <small></small>
                        </h3>
                    </div>
                    <div class="box-body" id="rewards-content">
                        <div class="table-responsive">
    <table id="myTable" class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Ödül Tipi</th>
            <th>Ödül Adı</th>
            <th>Ödül Resmi</th>
            <th>Ödül Adet/Miktar</th>
            <th>Ödül Artısı</th>
            <th>Şans Yüzdesi</th>
            <th>İşlem</th>
        </tr>
        </thead>
        <tbody>
<?php  foreach($degerler as $row){ 
 //Goruntulencek Metnin Tam Hali
$detay = $row['image'];
$uzunluk = strlen($detay);
$limit = 15;
if ($uzunluk > $limit) {
$detay = substr($detay,0,$limit) . "...";
}
?>

                    <tr>
                <td><?php echo $rank++; ?></td>
                <td><?php echo $row['types']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $detay; ?></td>
				<td><?php echo $row['total']; ?></td>
				<td><?php echo $row['plus']; ?></td>
				<td><?php echo $row['ratio']; ?></td>
                <td>
                    <div class="btn-group btn-group-xs">
						<a  class="btn btn-sm btn-danger" style="margin-left: 10px" title="Sil" onclick="deleteReward(<?php echo $row['id']; ?>);">
						<i class="glyphicon glyphicon-remove"></i></a>
					
                        
                    </div></td>

<?php } ?>		
                </tbody>
    </table>
<link rel="stylesheet" type="text/css" href="plugins/datatables/jquery.dataTables.css">

<script type="text/javascript" src="plugins/datatables/jquery.dataTables.js"></script>	<script>
        $('#myTable').DataTable({
            language: {
                info: "_TOTAL_ kayıttan _START_ - _END_ kayıt gösteriliyor.",
                infoEmpty:      "Gösterilecek hiç kayıt yok.",
                loadingRecords: "Kayıtlar yükleniyor.",
                zeroRecords: "Tablo boş",
                search: "Arama:",
                infoFiltered:   "(toplam _MAX_ kayıttan filtrelenenler)",
                buttons: {
                    copyTitle: "Panoya kopyalandı.",
                    copySuccess:"Panoya %d satır kopyalandı",
                    copy: "Kopyala",
                    print: "Yazdır",
                },

                paginate: {
                    first: "İlk",
                    previous: "Önceki",
                    next: "Sonraki",
                    last: "Son"
                },
            }
        });
</script>	
</div>
<div class="row">
    <div class="col-lg-4">
            </div>
    <div class="col-lg-8">
        <div class="pull-right" style="padding: 20px 0">
            <a class="btn btn-sm btn-primary btn-flat"
               href="admin.php?do=wheelitem">
                <i class="fa fa-check"></i> Item Ekle
            </a>
            <a class="btn btn-sm btn-danger btn-flat"
               href="admin.php?do=wheeltl">
                <i class="fa fa-check"></i> TL Ekle
            </a>
            <a class="btn btn-sm btn-soundcloud btn-flat"
               href="admin.php?do=wheelsilk">
                <i class="fa fa-check"></i> Silk Ekle
            </a>

        </div>
    </div>
</div>
                    </div>
                    <script type="text/javascript">
                        function deleteReward(id) {
                            swal({
                                title: "Ödül kaldırılsın mı?",
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
                                        'wheelremov': 'fYsuBAanNG',
                                        'id': + id,
										'_token':'<?php echo $_SESSION['_token']; ?>'
                                    })
                               .done(function (data) {
									var json_obj = $.parseJSON(data);
									swal(json_obj.title, json_obj.text, json_obj.type);
									
									if (json_obj.type == 'success') {
											
									setTimeout("window.location = 'admin.php?do=wheel';", 1500);
										return true;
										}
																
                                })
                                    .fail(function () {
                                        swal("Üzgünüz!", "Bir hata meydana geldi.", "error");
                                    });
                            });
                        }

                        function switchPage(page) {
                            overOverLayer();
                            $('#rewards-content').load("https://tasarim1.remopanel.com/admin/games/wheel-of-fortune/rewards/page/" + page, function (response, status, xhr) {
                                if (status != "success") {
                                    swal({
                                        title: 'Opps...',
                                        text: xhr.statusText,
                                        type: 'error',
                                        timer: 2000,
                                        showConfirmButton: false
                                    });
                                }
                                overOverLayerClose();
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
</div>
            <script src="plugins/sweetalert/sweetalert.min.js"></script>

	<?php include('footer.php'); ?>