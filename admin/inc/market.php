<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Market <small></small></h3>
<script src="plugins/sweetalert/sweetalert.min.js"></script>

		
		<?php 
	#Resim İmage Başlangıc
			function filtering ($string) {
				
				$find[] = "1"; $replace[] = "İtem";
				$find[] = "2"; $replace[] = "Skill Point";
				$find[] = "3"; $replace[] = "Gold";
				$find[] = "4"; $replace[] = "Silk";
				$find[] = "5"; $replace[] = "Rütbe";
				$find[] = "6"; $replace[] = "Kredi";
				return str_replace($find, $replace, $string);
			}#END			
			function filterings ($string) {
				
				$find[] = "1"; $replace[] = "₺";
				$find[] = "2"; $replace[] = "Silk";

				return str_replace($find, $replace, $string);
			}#END	
			$degerler=$admin->market_listele();
			$rank = 1;
			
			
		?>
		
		<div class="box-body" id="market-content">
                <div class="table-responsive">
    <table id="myTable" class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
			<th>Ürün Tipi</th>
            <th>Ürün Adı</th>
            <th>Ürün Artı'sı</th>
            <th>Ürün Adet/Miktar</th>
             <th>Ürün Fiyatı</th>
			<th>İtem Sırası</th>
            <th>İşlem</th>
        </tr>
        </thead>
		 <tbody>
		<?php  foreach($degerler as $row){?>
       
                    <tr>
                <td><?php echo $rank++; ?></td>
				<td><?php echo filtering($row['type']); ?></td>
                <td title="<?php echo $row['item_adi']; ?>">
                    <?php echo $row['item_adi']; ?>
                </td>
                <td><?php echo $row['arti_miktari']; ?></td>
                <td><?php echo $row['pot_sc_miktari']; ?></td>
                <td><?php echo $row['fiyat']; ?> <?php echo filterings($row['types']); ?> </td>
				<td><?php echo $row['sira']; ?></td>
                <td>
           
						<div class="btn-group btn-group-xs">
                        <button class="btn btn-sm btn-danger" title="Sil" onclick="deleteNews(<?php echo $row['id']; ?>);">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                    </div>
                </td>
            </tr>
               
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
               href="admin.php?do=mitem_ekle">
                <i class="fa fa-check"></i> Item Ekle
            </a>
            <a class="btn btn-sm btn-soundcloud btn-flat"
               href="admin.php?do=msilk_ekle">
                <i class="fa fa-check"></i> Silk Ekle
            </a>
            <a class="btn btn-sm btn-warning btn-flat"
               href="admin.php?do=mgold_ekle">
                <i class="fa fa-check"></i> Gold Ekle
            </a>
            <a class="btn btn-sm btn-success btn-flat"
               href="admin.php?do=msp_ekle">
                <i class="fa fa-check"></i> SP Ekle
            </a>
            <a class="btn btn-sm btn-facebook btn-flat"
               href="admin.php?do=mrutbe_ekle">
                <i class="fa fa-check"></i> Rütbe Ekle
            </a>
			
            <a class="btn btn-sm btn-bitbucket btn-flat" title="Oyun Kredisi Ekle"
                href="admin.php?do=mkredi_ekle">
                <i class="fa fa-check"></i> Kredi Ekle
            </a>


            
        </div>
    </div>
	
</div>

            </div>
            
        </div>
	
            <script type="text/javascript">
                function deleteNews(id) {
                    swal({
                        title: "Ürün Silinsin mi?",
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
                                    '_token': '<?php echo $_SESSION['_token']; ?>',
                                    'marketremove': 'DELETE',
									'id': +id
                                })
                                .done(function (data) {
                                     swal({
                title: "Silindi!", 
                text: "Ürün Başarıyla Silindi.", 
                type: "success",
                html: true,
                timer: 2000},
               function(){ 
                   location.reload();
               }
            );
                                })
                                .fail(function () {
                                    swal("Üzgünüz!", "Bir hata meydana geldi.", "error");
                                });
                    });
                }

                function switchPage(page) {
                    overOverLayer();
                    $('#roles-content').load("" + page, function (response, status, xhr) {
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
			<?php include('footer.php'); ?>