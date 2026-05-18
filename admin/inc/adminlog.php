<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
 <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Admin Log
                    <small></small>
                </h3>

   
            <script src="plugins/sweetalert/sweetalert.min.js"></script>
		
		   <div class="box-body" id="search-content">
                <div class="table-responsive">
    <table  class="table table-striped"> 
        <thead>
        <tr>
            <th>#</th>
            <th>Kullanıcı Adı</th>
            <th>İşlem</th>
            <th>Veri</th>
            <th>IP Adresi</th>
            <th>İşlem Zamanı</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 25;
		$toplam_icerik = $admin->toplam_icerik103();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["pageadminlogs"]) ? $_GET["pageadminlogs"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY id desc) AS Row, * FROM AdminLog) AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);

		  foreach($blogg as $row){
		 
 ?>


   <tr>
                <td><?php echo $row['Row']; ?></td>
                
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['type']; ?></td>
         
                <td>
                                            <a href="#" class="fa fa-info-circle text-danger" title="İşlem Verileri" data-toggle="modal"
                           data-target="#data-modal-<?php echo $row['Row']; ?>">
                        </a>
						 <div id="data-modal-<?php echo $row['Row']; ?>" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
<?php echo html_entity_decode($row['bilgi']) ?>
<td><?php echo $row['ipadres']; ?></td>
<td><?php echo $row['tarih']; ?></td>
				 <?php } ?>

  </tbody>
</table>


</div>

<div class="row">
    <div class="col-sm-12">
               <ul class="pagination" id="pager">
<?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
    </div>
</div>
           <script type="text/javascript">
                var xhr, fastSearch, saveRequest = '';

                $('#searchInput').keydown(function () {
                    if (xhr && xhr.readyState != 4) {
                        xhr.abort();
                    }
                    window.clearTimeout(fastSearch);
                    fastSearch = window.setTimeout(function () {
                        doAjaxSearch();
                    }, 500);
                });

                function doAjaxSearch() {
                    var sValue = $('#searchInput').val().replace(/[^a-zA-Z0-9]/gi, '');
                    if (sValue.length < 2) {
                        return;
                    }
                    if (xhr && xhr.readyState != 4) {
                        xhr.abort();
                    }
                    overOverLayer();
                    saveRequest = sValue + '/';
                    $('#search-content').load("faqs.php?name=" + sValue, function (response, status, xhr) {
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

                function switchPage(page) {
                    overOverLayer();
                    $('#search-content').load("faqs.php?pageadminlogs=" + page,function (response, status, xhr) {
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
            

	<?php include('footer.php'); ?>
      