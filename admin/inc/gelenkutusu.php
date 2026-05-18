<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Gelen Kutusu <small></small></h3>
<script src="plugins/sweetalert/sweetalert.min.js"></script>

		
		<?php 

			$degerler =$admin->link->db_conn_pann->query("SELECT * FROM Panel.._Tickets  order by Date DESC");
			$rank = 1;
			
			
		?>
		
		<div class="box-body" id="market-content">
                <div class="table-responsive">
    <table id="myTable" class="table table-responsive">
        <thead>
        <tr>
            <th>#</th>
		<th>Kategori</th>			
            <th>Konu</th>
			
            <th>Durum</th>
	
            <th>Tarih</th>
			 <th>Güncellenme Tarihi</th>
            <th>İşlem</th>
        </tr>
        </thead>
		 <tbody>
		<?php  foreach($degerler as $Data){
			 $rank = 1;
		  									$ID = $Data['ID'];
									
									$Title = $Data['Title'];//Ticekt title
									$kate = $Data['Category'];//Ticekt title
									//Ticket status
									if ($Data['Status'] == 0){
										$Status = "<p >Cevaplanmamış</p>";
									} else if ($Data['Status'] == 2){
										$Status = "<p >Kapatılmış</p>";
									}else {
										$Status = "<p>Cevaplanmış</p>";
									}
									$Date = $Data['Date'];
$Date2 = $Data['UpdateDate']		?>
       
                    <tr>
      		<td><?php echo $rank++; ?></td>
										
										<td><?php echo $kate;?></td>
										<td><?php echo $Title;?></td>
										<td><?php echo $Status;?></td>
										<td><?php echo $Date;?></td>
										<td><?php echo $Date2;?></td>

                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-sm btn-info" title="Görüntüle"
                                onclick="window.location.href = '?do=msg_goruntule&id=<?php echo $ID; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button></div>

                </td>
            </tr>
               
				<?php } ?>
    </tbody>
</table>
<link rel="stylesheet" type="text/css" href="plugins/datatables/jquery.dataTables.css">

<script type="text/javascript" src="plugins/datatables/jquery.dataTables.js"></script><script>
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

</div>

            </div>
            
        </div>
	
            <script type="text/javascript">
                function deleteNews(id) {
                    swal({
                        title: "İtem Silinsin mi?",
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
                        $.post("?do=market_sil&id=" + id,
                                {
                                    '_token': '<?php echo $_SESSION['_token']; ?>',
                                    '_method': 'DELETE'
                                })
                                .done(function (data) {
                                     swal({
                title: "Silindi!", 
                text: "İtem Başarıyla Silindi.", 
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
			