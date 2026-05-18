<?php include('fonksiyonlar/header.tpl'); ?>

<?php include('fonksiyonlar/sol.tpl'); ?>
<div id="content">
<div style="margin: 10px 0; padding-left: 3px">
<a href="http://www.maxigame.org/k/296-maxicard.php" target="_blank"><img src="maxicard/img/maxigame700.gif" width="605"></a>
</div>
</div>
<div class="bxslider">
<div>
<a href="register.php"><img src="media/banners/slide-1.png" /></a>
</div>
<div>
<a href="download.php"><img src="media/banners/slide-2.png" /></a>
</div>
</div>
<?php $dosyaAdi = "haberler.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['genelcache'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start(); ?>	
							<?PHP 
		$blogg = $users->link->db_conn_pann->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY tarih DESC) AS Row, * FROM Haberler) AS blog");
		
		$blogg -> execute();
		  foreach($blogg as $row){
			  
		  ?>		
		  <div id="haber-<?php echo $row['id']; ?>" class="haberBoxBg">
<div class="haberBox">
<h3><?php echo $row['baslik']; ?></h3>
<p><?php echo html_entity_decode($row['icerikfull']) ?></p>
<div class="clear"></div>
<div class="haber-info">
<div class="publish-date"><?php echo $row['tarih']; ?></div>
</div>
</div>
</div>
                                                               
	 <?php } ?>					
<?php
$ac = fopen($cache, "w+");
fwrite($ac, ob_get_contents());
fclose($ac);
ob_end_flush();
	}

?>	



</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>