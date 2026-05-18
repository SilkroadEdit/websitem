<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['unuttum']; ?></h3>
<br>
<form method="post" id="lostpw-form">
<label class="formBlock1"><?=$dils['login1']; ?>
<input class="formInput1" name="username" type="text">
</label>
<label class="formBlock1"><?=$dils['ri2']; ?>
<input class="formInput1" name="email" type="text">
</label>

<label class="formBlock1"><?=$dils['ri3']; ?>
<input class="formInput1" name="gs" type="text">
</label>
<label class="formBlock1"><?=$dils['unuttum2']; ?>
<input class="formInput1" name="pass" type="password">
</label>
<label class="formBlock1"><?=$dils['unuttum1']; ?>
<input class="formInput1" name="repass" type="password">
</label>
 <input type="hidden" name="passreset"/>
<input class="kayitBtn" type="submit" value="<?=$dils['unuttumbtn']; ?>">
</form>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>