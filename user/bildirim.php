<?php include('lib/header.php'); include('lib/paginiation.php');
$pgn = new Pagenation(); ?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Bildirimlerim</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Bildirimlerim</li>
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
<?php

function kisalt($kelime, $uzunluk, $son="..."){
 $say = strlen($kelime); 
 if($say > $uzunluk){ 
 $yeni = substr($kelime,0,$uzunluk); 
 $yeni .= $son;
 }elseif(($say == $uzunluk) or ($say < $uzunluk)){ 
 $yeni = $kelime;
 }
 return $yeni;
}
?>	
                    <div class="col-lg-12">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Bildirimlerim</h4>
            <div class="box-body" id="ticket-content">
                <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
							<?php 	
		$sayfada = 5;
		$toplam_icerik = $users->toplam_ticket();
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
		(SELECT ROW_NUMBER() OVER (ORDER BY Date desc) AS Row, * FROM _Tickets where StrUserID = '$_SESSION[username]') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $Data){

		  $rank = 1;
		  									$ID = $Data['ID'];
									
									$Title = kisalt($Data['Title'],15);//Ticekt title
									$kate = $Data['Category'];//Ticekt title
									//Ticket status
									if ($Data['Status'] == 0){
										$Status = "Cevaplanmamış";
									} else if ($Data['Status'] == 2){
										$Status = "Kapatılmış";
									}else {
										$Status = "Cevaplanmış";
									}
									$Date = $Data['Date'];
$Date2 = $Data['UpdateDate']									?>
		                                    <tr class="order">
									    <!--Item Slot-->
										<td><?php echo $Data['Row']; ?></td>
										
										<td><?php echo $kate;?></td>
										<td><?php echo $Title;?></td>
										<td><?php echo $Status;?></td>
										<td><?php echo $Date;?></td>
										<td><?php echo $Date2;?></td>
										<td>
                                 
                        <button class="btn btn-success waves-effect waves-light" title="G&ouml;r&uuml;nt&uuml;le"
                                onclick="window.location.href = 'showticket.php?id=<?php echo $ID ; ?>';">
                            <i class="fa fa-eye"></i>
                        </button>
						
                                                           
                </td>
            </tr>
 
									
		  <?php } ?>
                </tbody>
    </table>
</div>

                                        <div class="row"><div class="col-sm-12 col-md-5"><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="datatable-buttons_paginate"><ul class="pagination"><?php $pgn->Pagination($getfonk, $toplam_sayfa);?><li class="paginate_button page-item "></ul></div></div></div></div>
    <div class="col-sm-2">
        <div class="pull-right" style="padding: 20px 0">
            <a class="btn btn-primary"
               href="bildirimyolla.php">
                <i class="fa fa-check"></i> Yeni
            </a>
        </div>
    </div>
</div>
            </div>
            <script type="text/javascript">

                function switchPage(page) {
                   
                    $('#ticket-content').load("fonks.php?page=" + page,function (response, status, xhr) {
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