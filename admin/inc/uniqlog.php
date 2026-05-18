<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Unique Puanları <small></small></h3>

			<script src="plugins/sweetalert/sweetalert.min.js"></script>			
					
		<?php 

			$degerler =$admin->link->db_conn_pann->query("SELECT * FROM UniquePoints ORDER BY Point DESC");			
			$rank = 1;
		
		?>
		 
            <div class="box-body" id="market-content">
                <div class="table-responsive">
  <table id="myTable" class="table table-responsive">
        <thead>
        <tr>
		<th>#</th>
            <th>Unique</th>
            <th>Puan</th>
            <th>İşlem</th>
        </tr>
        </thead>
      <tbody>
		<?php  foreach($degerler as $row){?>
  
                    <tr>
					<td><?php echo $rank++; ?></td>
                <td><?php echo $row['Unique'] ?></td>
                <td><?php echo $row['Point'] ?></td>
                <td>
                      <div class="btn-group btn-group-xs">
                        <button class="btn btn-sm btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=newpage&name=<?php echo $row['Unique']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                     
                        <button class="btn btn-sm btn-danger" title="Sil" onclick="deleteUnique('<?php echo $row['Unique'] ?>');">
                            <i class="glyphicon glyphicon-remove"></i>
                        </button>
                    </div></div>
					

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
</div>
           <script type="text/javascript">
                function deleteUnique(unique) {
                    swal({
                        title: "Unique Puanı kaldırılsın mı?",
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
						   $.post("kontrol.php?Unique="+unique,
                                {
                                    '_token': '<?php echo $_SESSION['_token']; ?>',
                                    'uniqremove': 'DELETE'
                                })	
                                .done(function (data) {
                                    swal({
                                        title: 'Başarılı',
                                        text: 'Unique puan listesinden başarılı şekilde kaldırıldı.',
                                        type: 'success',
                                        timer: 2000
                                    }, function () {
                                       location.reload();
                                    });
                                })
                                .fail(function () {
                                    swal("Üzgünüz!", "Bir hata meydana geldi.", "error");
                                });
                    });
                }

                function switchPage(page) {
                    overOverLayer();
                    $('#market-content').load("" + page, function (response, status, xhr) {
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
<div class="row">
    <div class="col-sm-10">
        
    </div>
    <div class="col-sm-2">
        <div class="pull-right" style="padding: 20px 0">
            <a class="btn btn-primary"
               href="admin.php?do=uniq_ekle">
                <i class="fa fa-check"></i> Yeni
            </a>
        </div>
    </div>
</div>
            </div>
            
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Rank İşlemleri</h3>
            </div>
            <div class="box-body" id="action-menu">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Unique Rankı Sıfırla</p>
                        </div>
                        <a href="#" data-type="unique" class="small-box-footer">Devam Et <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
                    <div class="small-box bg-yellow-gradient">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">PvP Rankı Sıfırla</p>
                        </div>
                        <a href="#" data-type="pvp" class="small-box-footer">Devam Et <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                $('#action-menu').find('a').click(function () {
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
                                    '_token': '<?php echo $_SESSION['_token']; ?>',
                                    'action': type
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
               
            </div></div>
 
 



	<?php include('footer.php'); ?>			
