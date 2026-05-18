<?php 
header("Content-Type: text/html; charset=UTF-8");
include ('fonksiyonlar/header.tpl');

$ref =(int)strip_tags($_GET['ref']);
function rastgeleparola() {
  $sozluk = "ABCHEFGHJKMNabchefghjkmnpq0123456PQRTSUVWXYZrstuvwxyz789";
  srand((double)microtime()*1000000);
      $i = 0;
      while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($sozluk, $num, 1);
            $pass = $pass . $tmp;
            $i++;
      }
      return $pass;
}
$parola_yap = rastgeleparola();
?>	
<?php
function sifreureteci(){
 $karakterler = "abcdefghjkmnprstuxvyz23456789ABCDEFGHJKMNPRSTUXVYZ";
 $sifre = '';
 for($i=0;$i<6;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 50};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}
$_SESSION['guvenlikKodu']=sifreureteci();

?>
<?php if(!isset($_SESSION['guardf'])){
		
		
	?>
	<?php include("fonksiyonlar/sol.tpl"); ?> 
 <div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['register'];?></h3>
<br>
<form method="post" id="register-form">
<input type="hidden" name="register"/>
<label class="formBlock1"><?=$dils['login1'];?>
<input class="formInput1" name="username" type="text">
</label>
<label class="formBlock1"><?=$dils['login2'];?>
<input class="formInput1" name="pass" type="password">
</label>
<label class="formBlock1"><?=$dils['ri1'];?>
<input class="formInput1" name="repass" type="password">
</label>
<label class="formBlock1"><?=$dils['ri2'];?>
<input class="formInput1" name="email" type="text">
</label>
<label class="formBlock1"><?=$dils['ri3'];?>
<input class="formInput1" name="gs" type="text">
</label>
<label class="formBlock1" style="display: flex; align-items: center;">
    <span style="flex-grow: 1;"><?=$dils['ri4'];?></span>
    <input type="text" class="formInput1" name="guvenlikKodu" id="regsecurity" style="width: 36%; margin-right: 10px;" />
    <div id="captchaimg" style="background-color:#c0b700; width: 130px;">
        <center><font size="6" color="black"><?= $_SESSION['guvenlikKodu'];?></font></center>
    </div>
	<i onclick="reloadCaptcha()" style="padding: 6px;" title="Kodu Yenile"
                                       class="fa fa-refresh refreshIconCaptcha"></i>
</label>
<label class="formBlock1">
<span style="float: right;"><?=$dils['kyt_olrk'];?> <a href="uyeliksozlesmesi.php" target="_blank"><font color="white"><?=$dils['uylik_söz'];?></font></a><?=$dils['uylik_söz_kbl'];?></span>
</label>
<input class="kayitBtn" type="submit" value="<?=$dils['register'];?>">
</form>
<br><br>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<style>
font {
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -o-user-select: none;
  user-select: none;
}
</style>
<script>
		  function reloadCaptcha() {
        $.get('guvenlik-kodu.php', function(data) {
            $("#captchaimg").html(data);
         
        });
		  }
                </script>
<?php include('fonksiyonlar/footer.php'); ?>
<?php }else {
		

	header('Location:index.php'); } ?>