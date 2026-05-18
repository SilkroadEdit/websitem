<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
 <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Yasaklı Kullanıcılar
                    <small></small>
                </h3>

<script src="plugins/sweetalert/sweetalert.min.js"></script>
	
		<?php 
		

			$degerler =$admin->link->db_conn_account->query("SELECT  A.Executor, A.Guide, D.userjid , D.userid, D.timebegin, D.timeend
	FROM _BlockedUser D
	JOIN sro_vt_account.dbo._Punishment A ON D.userjid = A.userjid ORDER By D.timeend DESC ");	
		?>
		
		<div class="box-body" id="market-content">
                <div class="table-responsive">
      <table id="myTable" class="table table-responsive">
        <thead>
        <tr>
            <th>#</th>
            <th>Kullanıcı Adı</th>
            <th>Yasaklayan</th>
            <th>Açıklama</th>
            <th>Başlangıç</th>
            <th>Bitiş</th>
			<th>İşlem</th>

        </tr>
        </thead>        <tbody>
		<?php  $rank=1; foreach($degerler as $row){?>

                    <tr>
                <td><?php echo $rank++; ?></td>
                <td><?php echo $row['userid']; ?></td>
                <td><?php echo $row['Executor']; ?></td>
                <td><?php echo $row['Guide']; ?></td>
				<td><?php echo $row['timebegin']; ?></td>
				<td><?php echo $row['timeend']; ?></td>
                <td>
				
                    <div class="btn-group btn-group-xs">
						<a  class="btn btn-sm btn-danger" style="margin-left: 10px" title="Sil" onclick="deleteNews(<?php echo $row['userjid']; ?>);">
						<i class="glyphicon glyphicon-remove"></i></a>
					
                        
                    </div>
             
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
    <div class="col-sm-10">
        
    </div>
    <div class="col-sm-2">
        <div class="pull-right" style="padding: 20px 0">
            <a class="btn btn-primary"
               href="?do=banat">
                <i class="fa fa-check"></i> Yeni Ekle
            </a>
			<script src="assets/js/bootstrap.min.js"></script>
<script src="plugins/sweetalert/sweetalert.min.js"></script>
            <script type="text/javascript">
                function deleteNews(id) {
                    swal({
                        title: "Ban Silinsin mi?",
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
                                    'banremove': 'DELETE',
									'id': +id
                                })
                                .done(function (data) {
                                     swal({
                title: "Silindi!", 
                text: "Ban Başarıyla Silindi.", 
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
</div>
</div>
</div>

</div>
            </div>

	<?php include('footer.php'); ?>