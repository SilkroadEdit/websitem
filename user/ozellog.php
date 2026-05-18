<?php include('lib/header.php'); include('lib/paginiation.php');
$pgn = new Pagenation(); ?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Özel işlemler</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Özel işlemler Geçmişi</li>
                                    </ol>


                                </div>
                                <div class="col-sm-6">

                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                   
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
	
                    <div class="col-lg-12">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Özel İşlem Geçmişi</h4>
            <div class="box-body" id="ticket-content">
                <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
        <tr>
			<th>#</th>         
			<th>Karakter Adı</th>			
            <th>İşlem</th>			
            <th>TL Fiyatı</th>
            <th>Silk Fiyatı</th>
            <th>Tarih</th>
        </tr>
        </thead>
        <tbody>
							<?php 	
		$sayfada = 25;
		$toplam_icerik = $users->toplam_ozellog();
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
		
		$blogg = $users->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY tarih desc) AS Row, * FROM SpecialLog where username = '$_SESSION[username]') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		  foreach($blogg as $Data){	
		  ?>
		                                    <tr class="order">
									    <!--Item Slot-->
										<td><?php echo $Data['Row']; ?></td>
										
										<td><?php echo $Data['oyuncu']; ?></td>
										<td><?php echo $Data['type']; ?></td>
										<td><?php echo $Data['fiyattl']; ?></td>
										<td><?php echo $Data['fiyatsilk']; ?></td>
										<td><?php echo $Data['tarih']; ?></td>

            </tr>
 
									
		  <?php } ?>
                </tbody>
    </table>
</div>

                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate"><ul class="pagination"><?php $pgn->Pagination($getfonk, $toplam_sayfa);?><li class="paginate_button page-item "></ul></div></div></div></div>

            <script type="text/javascript">

                function switchPage(page) {
                   
                    $('#ticket-content').load("fonks.php?pageozellog=" + page,function (response, status, xhr) {
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
     <br><br><br><br><br><br>
<?php include('lib/footer.php'); ?>