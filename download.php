<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl");
$down =$users->down_listele();
?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['download'];?></h3>
<?php 
		if (sizeof($down) == 0){  
				
					echo '<p class="text-center text-danger">'.$dils['veri'].'</p>'; 
				
		}
		foreach($down as $row){
		//print_r($down);
		?>	

<div class="col-sm-4">
<div class="download-box">
<i class="fa fa-cloud-download"></i>
<h4><?php echo $row['ad'] ?></h4>
<a target="_blank" href="<?php echo $row['link'] ?>" class="alisverisbtn" style="text-decoration: none"><?=$dils['download'];?></a>
<hr>
<span> <i class="fa fa-calendar"></i>
<?php echo $row['boyut'] ?> </span>
</div>
</div>
<?php } ?>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>