<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>	
  <script src="plugins/sweetalert/sweetalert.min.js"></script>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Karakter Ara & Düzenle <small></small></h3>

                <div class="box-tools">
                    <div id="searchForm" class="input-group input-group-sm" style="width: 200px;">
                        <input type="text" class="form-control pull-right" id="searchInput" placeholder="Karakter Adı">
                        <div class="input-group-btn">
                            <button onclick="doAjaxSearch();" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body" id="search-content">
              <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Karakter Adı</th>
            <th>Job Adı</th>
            <th>Irk</th>
            <th>Level</th>
            <th>İşlem</th>
        </tr>
        </thead>
        <tbody>



							<?php 	
		$sayfada = 25;
		$toplam_icerik = $admin->toplam_icerik2();
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["page"]) ? $_GET["page"] : 1;
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
		
		$blogg = $admin->link->db_conn_shard->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY CharID asc) AS Row, * FROM _Char where not CharName16 ='d') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $row){
 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['CharName16']; ?></td>
                <td><?php if(empty($row['NickName16'])){ echo 'Yok'; } else{ echo '*'.$row["NickName16"].''; } ?></td>
                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                <td><?php echo $row['CurLevel']; ?></td>

                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
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
                    $('#search-content').load("faqs.php?name2=" + sValue, function (response, status, xhr) {
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
                   
                    $('#search-content').load("faqs.php?pagekarakter=" + page,function (response, status, xhr) {
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

	<?php include('footer.php') ?>