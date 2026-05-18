<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Market Geçmişi
                    <small></small>
                </h3>
        

			 <script src="plugins/sweetalert/sweetalert.min.js"></script>
			
		<?php 

			$degerler =$admin->link->db_conn_pann->query("SELECT * FROM MarketLog ORDER BY tarih DESC"); 
						if(isset($_POST['durumsil'])){
				
			$degerler =$admin->link->db_conn_pann->query("DELETE FROM MarketLog");
			echo ' <script type="text/javascript">swal("BAŞARILI", "Tüm Kayıtlar Başarı İle Silindi..", "success");</script>';
			}
			$rank2 = 1;
			?>
		
		<div class="box-body" id="market-content">
                <div class="table-responsive">
<table id="myTable" class="table table-responsive">
    <thead>
    <tr>
	<th>#</th>
            <th>Kullanıcı Adı</th>
            <th>Karaket Adı </th>
            <th>Ürün Adı</th>
			<th>Ürün Fiyatı</th>
            <th>Satın Alma Zamanı</th>
    </tr>
    </thead>
    <tbody>
	<?php  foreach($degerler as $row){?>
    <tr>
	<td><?php echo $rank2++; ?></td> 
   					<td><?php echo $row['username']; ?></td> 
    				<td><?php echo $row['karakteradi']; ?></td> 
    				<td><?php echo $row['itemadi']; ?></td> 
					<td><?php echo $row['fiyat']; ?></td> 
    				<td><?php echo $row['tarih']; ?></td> 
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

</div></div></div>
            </div>
            <?php include('footer.php'); ?>		