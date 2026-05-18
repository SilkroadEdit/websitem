<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<div id="content">
<div id="iletisim" class="haberBoxBg">
<div class="haberBox">
<h3><?= $dils['iletisim']; ?></h3>
<p style="text-align: center; color: red;">
<?= $dils['iletisim2']; ?>
</p>
<div style="font-size: 16px">Facebook: <a href="<?php echo $rowayar[0]['facebook']; ?>" target="_blank"><?php echo $rowayar[0]['facebook']; ?></a></div><div style="font-size: 16px">Youtube: <a href="<?php echo $rowayar[0]['youtube']; ?>" target="_blank"><?php echo $rowayar[0]['youtube']; ?></a></div> <div style="font-size: 16px">Bildiri Sistemi:
<a href="user/"> Bildiri Yolla</a>
</div>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>