<?php include('lib/header.php'); ?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
							
<?php if($rowayar[0]['usergenel'] == 1){ ?>
         <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="alert alert-success alert-dismissible">
            <span class="info-box-icon bg-aqua"><i class="fa fa-align-right"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Server Toplam Sox :</span>
                <span class="info-box-number"><?php echo $rowayar[0]['soxitems']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
       <div class="alert alert-danger alert-dismissible">
            <span class="info-box-icon bg-green"><i class="fa fa-align-right"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Server Toplam Gold :</span>
                <span class="info-box-number"><?php echo wordwrap($rowayar[0]["total_char"], 3, '.', TRUE); ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
         <div class="alert alert-info alert-dismissible">
          <i class="fa fa-align-right"></i>

            <div class="info-box-content">
                <span class="info-box-text">Server Aktif Oyuncu : </span>
                <span class="info-box-number"><?php echo $rowayar[0]['active_user']+$rowayar[0]['fake']; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
       <div class="alert alert-warning alert-dismissible">
            <span class="info-box-icon bg-red"><i class="fa fa-align-right"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Server Toplam Guild :</span>
                <span class="info-box-number"><?php echo $rowayar[0]['total_guild']; ?></span>
            </div>
        </div>
    </div>	
<?php } ?>	
                    <div class="col-lg-6">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Hesap Bilgilerim</h4>
                   <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <tr>
                            <th>Kullanıcı Adı</th>
                            <th><?php echo $_SESSION['username'] ?></th>
                        </tr>
                        <tr>
                            <th>E-Mail Adresi</th>
                            <th><?php echo $_SESSION['mail'] ?></th>
                        </tr>
                        <tr>
                            <th>TL Miktarı</th>
                            <th><?php echo $_SESSION['tlmiktari'] ?> ₺</th>
                        </tr>
                    </table>
                </div> </div>
            </div>
        </div>            
                   <div class="col-lg-6">
                        <div class="card">
       <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Karakterlerim</h4>
                         <div class="table-responsive">
    <table  class="table" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Karakter Adı</th>
                            
                            <th>Level</th>
                            <th>Strength</th>
                            <th>Intellect</th>
							<th>Gold Miktarı</th>
                        </tr>
                        </thead>
                        <tbody>
		<?php
		$karakterler_class = $users->get_jid();
		foreach($users->get_jid() as $karakterler){
			echo "<tr><td>".$karakterler['CharName16']."</td>";
			echo "<td>".$karakterler['CurLevel']."</td>";
			echo "<td>".$karakterler['Strength']."</td>";
			echo "<td>".$karakterler['Intellect']."</td>";
			echo "<td>".$karakterler['RemainGold']."</td></tr>";
		}
		?>
          
                            </tr>
   </tbody>
                    </table>
				 </div>
                </div>
           </div>
   <br><br><br><br>
<?php include('lib/footer.php'); ?>
