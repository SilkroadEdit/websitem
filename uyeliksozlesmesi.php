<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<div id="content">
<div id="oyunKurallari" class="haberBoxBg">
<div class="haberBox">
<h3>Üyelik Sözleşmesi ve Kurallar</h3>
<ul>
<li>1. Her oyuncu kendi hesabından sorumludur. Çalınan ve kaybolan eşyalarınızdan <?php echo $rowayar[0]['oyunismi']; ?> sorumlu değildir.</li><li>2. TL yükleyerek aldiğiniz eşyalar <?php echo $rowayar[0]['oyunismi']; ?>'a destek içindir. Herhangi bir hak iddaa edilemez.</li><li>3. <?php echo $rowayar[0]['oyunismi']; ?> Yönetimi gerektiği takdirde bir oyuncuyu süresiz veya belirli bir süreliğine mazeret göstermeksizin oyundan uzaklaştırma hakkını saklı tutar.</li><li>4. <?php echo $rowayar[0]['oyunismi']; ?> Yönetimi gerektiği takdirde üyelik sözleşmesi kullanıcılara haber vermeksizin değiştirme hakkını saklı tutar.</li><li>5. <?php echo $rowayar[0]['oyunismi']; ?>'dan satın aldığım TL kredilerini kendi arzumla aldığımı ve para iadesini hiç bir şekilde yapmayacağımı veya şikayet etme hakkım olmadığını beyan ederim.</li></ul> </div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>