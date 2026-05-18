<div id="footerWrapper">
<div id="footer" class="w980 center">
<div id="footerLogo">
<a href="index.php">
<span><div><?php if(strstr($rowayar[0]['oyunlogo'], "http")) { echo  '<img src="'.$rowayar[0]['oyunlogo'].'" alt="...">'; }
	else echo '<span>'.$rowayar[0]['oyunlogo'].'</span>'; ; ?></div></span> </a>
</div>
<div id="footerMenu">
<ul>
<li><a href="index.php" style="background-image:none;"><?= $dils['anasayfa'];?></a></li>
<li><a href="user/"><?= $dils['yardim'];?></a></li>
<li><a href="uyeliksozlesmesi.php"><?= $dils['sözlesme'];?></a></li>
<li><a href="/" target="_blank"><?= $dils['forum'];?></a></li>
<li><a href="iletisim.php"><?= $dils['iletisim'];?></a></li>
<li><a href="user/"><?= $dils['bug'];?></a></li>
</ul>
</div>
<div id="copyright">
<span>
Copyright &copy; 2024 <?php echo $rowayar[0]['oyunismi']; ?>. All rights reserved. | Coded by <a href="https://www.vsro.org/members/serveredit.275/" target="_blank">ServerEdit</a>
</span>
</div>
<div id="sosyalMedya">
<ul>
<li><a href="<?php echo $rowayar[0]['facebook']; ?>" target="_blank" class="facebook">Facebook</a></li>
<li><a href="<?php echo $rowayar[0]['youtube']; ?>" target="_blank" class="youtube">Youtube</a></li>
</ul>
</div>
</div>
<div class="clear"></div>
</div>
<?php
if(strpos($_SERVER['REQUEST_URI'],'index') !== false){
$titlem1 = "home";
}elseif(strpos($_SERVER['REQUEST_URI'],'download') !== false){
$titlem1 = "download";
}elseif(strpos($_SERVER['REQUEST_URI'],'market') !== false){
$titlem1 = "mall";
}elseif(strpos($_SERVER['REQUEST_URI'],'ranking') !== false){
$titlem1 = "ranking";
}elseif(strpos($_SERVER['REQUEST_URI'],'userstats') !== false){
$titlem1 = "faq";
}elseif(strpos($_SERVER['REQUEST_URI'],'iletisim') !== false){
$titlem1 = "contact";
}elseif(strpos($_SERVER['REQUEST_URI'],'news') !== false){
$titlem1 = "home";
}elseif(strpos($_SERVER['REQUEST_URI'],'/') !== false){
$titlem1 = "home";
}else {
$titlem1 = "home";
}
?>
</body>
</html>