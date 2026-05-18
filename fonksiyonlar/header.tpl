<?php include('reg_users.php'); ?>
<?php
if(strpos($_SERVER['REQUEST_URI'],'index') !== false){
$titlem = $dils['anasayfa'];
}elseif(strpos($_SERVER['REQUEST_URI'],'download') !== false){
$titlem = $dils['download'];
}elseif(strpos($_SERVER['REQUEST_URI'],'market') !== false){
$titlem = $dils['market'];
}elseif(strpos($_SERVER['REQUEST_URI'],'ranking') !== false){
$titlem = $dils['rank'];
}elseif(strpos($_SERVER['REQUEST_URI'],'userstats') !== false){
$titlem = $dils['userstats'];
}elseif(strpos($_SERVER['REQUEST_URI'],'search') !== false){
$titlem = $dils['search'];
}elseif(strpos($_SERVER['REQUEST_URI'],'iletisim') !== false){
$titlem = $dils['iletisim'];
}elseif(strpos($_SERVER['REQUEST_URI'],'register') !== false){
$titlem = $dils['register'];
}elseif(strpos($_SERVER['REQUEST_URI'],'lostpassword') !== false){
$titlem = $dils['unuttum'];
}elseif(strpos($_SERVER['REQUEST_URI'],'maxicard') !== false){
$titlem = "Maxigame TL Yükle";
}elseif(strpos($_SERVER['REQUEST_URI'],'charinfo') !== false){
$titlem = $dils['char1'];
}elseif(strpos($_SERVER['REQUEST_URI'],'guildinfo') !== false){
$titlem = $dils['guild1'];
}elseif(strpos($_SERVER['REQUEST_URI'],'unioninfo') !== false){
$titlem = $dils['union1'];
}elseif(strpos($_SERVER['REQUEST_URI'],'news') !== false){
$titlem = "Haberler";
}elseif(strpos($_SERVER['REQUEST_URI'],'faqs') !== false){
$titlem = "Haberler";
}elseif(strpos($_SERVER['REQUEST_URI'],'info') !== false){
$titlem = "Golden İnfo";
}elseif(strpos($_SERVER['REQUEST_URI'],'hesapno') !== false){
$titlem = "Hesap Numaralarımız";
}elseif(strpos($_SERVER['REQUEST_URI'],'/') !== false){
$titlem = $dils['anasayfa'];
}else {
$titlem = "Anasayfa";
}
?>
<?php define("guvenlik", true); ?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8" >	<?php $site_ayar= $users->link->db_conn_pann->query("SELECT *,(SELECT COUNT(*) FROM Panel.dbo._OnlineOffline WHERE Status = 'Online') as Player,(SELECT charinfo from Panel..onbellek_ayarları) as charinfo,(SELECT guildinfo from Panel..onbellek_ayarları) as guildinfo,(SELECT unioninfo from Panel..onbellek_ayarları) as unioninfo,(SELECT hesapno from Panel..Bolum) as hesapno,(SELECT istatislik from Panel..Bolum) as userstats,(SELECT faqs from Panel..onbellek_ayarları) as genelcache from Siteayar where id=1");	$rowayar = $site_ayar ->fetchAll(); $fake=$rowayar[0]['total_fake'];						?>					
<?php $online_CH_ayar= $users->link->db_conn_pann->query("SELECT *, (SELECT COUNT(*) AS count FROM Panel.dbo._OnlineOffline WHERE RefObjID BETWEEN 1907 AND 1932 AND Status = 'Online') as count from Siteayar where id=1");	$rowCHonline = $online_CH_ayar ->fetchAll(); $fakeCH=$rowCHonline[0]['ch_fake']; ?>
<?php $online_EU_ayar= $users->link->db_conn_pann->query("SELECT *, (SELECT COUNT(*) AS count FROM Panel.dbo._OnlineOffline WHERE RefObjID BETWEEN 14875 AND 14900 AND Status = 'Online') as count from Siteayar where id=1");	$rowEUonline = $online_EU_ayar ->fetchAll(); $fakeEU=$rowEUonline[0]['eu_fake']; ?>
<meta http-equiv="Content-type" content="text/html;charset=utf-8" />
<title><?php echo $titlem;?> | <?php echo $rowayar[0]['oyunismi']; ?></title>  
<link rel="shortcut icon" href="media/images/favicon.ico" />
<link rel="stylesheet" href="media/css/jquery.bxslider.css">
<link rel="stylesheet" href="media/css/styles.css">
<link rel="stylesheet" href="media/css/alertify.css">
<link rel="stylesheet" href="media/css/font-awesome.min.css">
<script src="media/javascripts/jquery-2.1.4.min.js" type="text/javascript"></script>
<script src="media/javascripts/alertify.js" type="text/javascript"></script>
<script src="media/javascripts/jquery-ui.js" type="text/javascript"></script>
<script src="media/javascripts/jquery.bxslider.min.js" type="text/javascript"></script>
<script src="media/javascripts/jquery.blockUI.js" type="text/javascript"></script>
<script src="media/javascripts/script.js" type="text/javascript"></script>


</head>
<body>



<body>
<div id="wrapper" class="w980 center">
<div id="header">
<div id="logo" class="fLeft">
<a href="index.php">
<span><div><?php if(strstr($rowayar[0]['oyunlogo'], "http")) { echo  '<img src="'.$rowayar[0]['oyunlogo'].'" alt="...">'; }
	else echo '<span>'.$rowayar[0]['oyunlogo'].'</span>'; ; ?> </div></span> </a>
</div>