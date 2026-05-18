<?php include('lib/header.php'); ?>

		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Sıkça Sorulan Sorular</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">S.S.S</li>
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
<?php $dosyaAdi = "faqsss.txt";
$cache = "../cache/".$dosyaAdi;
$sure = 900;

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start(); ?>
                    <div class="col-lg-12">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Sıkça Sorulan Sorular</h4>
        <div class="box-body" id="faqs-content">
                <div class="box-group" id="accordion">
    <div class="row">
<?php $degerler =$users->link->db_conn_pann->query("SELECT * FROM Panel..faqss");  
	$rank = 1; $rank1 = 1;  $rank2 = 1; ?>	
	  <?php  foreach($degerler as $row){?>
                    <div class="col-md-10 col-md-offset-1">
                <div class="panel box box-warning">
                    <div class="box-header with-border">
                        <h4 class="box-title">
                         <center>  <?php echo $rank1++; ?>-) <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapse-<?php echo $rank++; ?>">
                                <?php echo $row['title']; ?>
                            </a></center>
                        </h4>
                    </div>
                    <div id="collapse-<?php echo $rank2++; ?>"
                         class="panel-collapse collapse">
                        <div class="box-body">
                           <center> <?php echo html_entity_decode($row['icerik']); ?></center>

                        </div>
                    </div>
                </div> </div>
<br>
	  <?php } ?>
                                    </div>  </div>
<?php
			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}

?>										

            </div>
        </div>
    </div>
<br><br><br><br><br><br>
<?php include('lib/footer.php'); ?>