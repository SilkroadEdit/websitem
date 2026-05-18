
<?php
if(strpos($_SERVER['REQUEST_URI'],'hesabım') !== false){
$titlem = "Hesabım";
}elseif(strpos($_SERVER['REQUEST_URI'],'bildirim') !== false){
$titlem = "Bildirimlerim";
}elseif(strpos($_SERVER['REQUEST_URI'],'bildirimyolla') !== false){
$titlem = "Bildirim Yolla";
}elseif(strpos($_SERVER['REQUEST_URI'],'bugkurtar') !== false){
$titlem = "Bug'tan Kurtarma";
}elseif(strpos($_SERVER['REQUEST_URI'],'maxicard') !== false){
$titlem = "TL Yükle";
}elseif(strpos($_SERVER['REQUEST_URI'],'faq') !== false){
$titlem = "S.S.S";
}elseif(strpos($_SERVER['REQUEST_URI'],'ozel') !== false){
$titlem = "Özel İşlemler";
}elseif(strpos($_SERVER['REQUEST_URI'],'wheellog') !== false){
$titlem = "Çarkıfelek Gecmişi";
}elseif(strpos($_SERVER['REQUEST_URI'],'wheel') !== false){
$titlem = "Çarkıfelek";
}elseif(strpos($_SERVER['REQUEST_URI'],'ozellog') !== false){
$titlem = "Özel İşlem Log";
}elseif(strpos($_SERVER['REQUEST_URI'],'settings') !== false){
$titlem = "Genel Ayarlar";
}elseif(strpos($_SERVER['REQUEST_URI'],'sifredes') !== false){
$titlem = "Şifre Değiştir";
}else {
$titlem = "Anasayfa";
}
?>
<?php include('lib/reg_users.php'); 	if(!isset($_SESSION['guardf'])){
		?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL=index.php"> <?php
		exit();
	} $_SESSION['_token'] = sha1(md5(rand(00000, 99999)));?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Kullanıcı Paneli | <?php echo $titlem;?> </title>
        <meta content="Admin Dashboard" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="public/assets/images/favicon.ico">
<link rel="stylesheet" href="public/plugins/chartist/css/chartist.min.css">
<link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="public/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
<link href="public/assets/css/icons.css" rel="stylesheet" type="text/css">
<link href="public/assets/css/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="public/plugins/sweetalert/sweetalert.css">
</head>
<body>
        <!-- Begin page -->
        <div id="wrapper">
		   <div class="topbar">

	<script type="text/javascript">
document.write('<div id="loading" align="center"><div class="blockUI blockOverlay" style="z-index: 1000; border: none; margin: 0px; padding: 0px; width: 100%; height: 100%; top: 0px; left: 0px; background-color: rgb(0, 0, 0); opacity: 0.8; cursor: wait; position: fixed;"></div><div class="blockUI blockMsg blockPage" style="z-index: 1011; position: fixed; padding: 0px; margin: 0px; width: 30%; top: 40%; left: 35%; text-align: center; color: rgb(255, 255, 255); border: 0px; background-color: transparent; cursor: wait;"><h1><div class="loading-spin"><div class="spin-img"></div><div class="fixed-img"></div></div></h1></div><h1><div class="loading-spin"><div class="spin-img"></div><div class="fixed-img"></div></div></h1><div class="loading-spin"><div class="spin-img"></div><div class="fixed-img"></div></div><div class="spin-img"></div><div class="fixed-img"></div></div>');window.onload=function(){document.getElementById("loading").style.display="none";}
</script>

<div class="topbar-left">
    <a href="hesabim.php" class="logo">
        <span>
                 <span><b>Kullanıcı</b> Paneli</span>

            </span>
        <i>
             K<b>P</b>
            </i>
    </a>
</div>
<?php
			$testquery = $users->link->db_conn_account->query(" SELECT
        soxitems = (SELECT COUNT(obj.CodeName128)
			from SRO_VT_SHARD.._Items as it
			LEFT JOIN SRO_VT_SHARD.._Inventory as inv ON it.ID64 = inv.ItemID
			LEFT JOIN SRO_VT_SHARD.._RefObjCommon as obj ON it.RefItemID = obj.ID
			LEFT JOIN SRO_VT_SHARD.._RefObjItem as item ON obj.Link = item.ID
			where (CodeName128 like '%RARE%')),
        total_char = (SELECT sum(remaingold)
                      FROM SRO_VT_SHARD.dbo._Char),
        active_user = (SELECT TOP 1 nUserCount
                       FROM SRO_VT_ACCOUNT.dbo._ShardCurrentUser
                       ORDER BY dLogDate DESC),
        fake = (SELECT TOP 1 total_fake
                       FROM Panel.dbo.Siteayar
                       ),
		usergenel = (select usergenel from Panel..Bolum where id = 1),	
        wheel = (select type from Panel..wheelsettings where ID = 1),					   
        total_guild = (SELECT COUNT(ID)
                       FROM SRO_VT_SHARD.dbo._Guild)");
					   $rowayar = $testquery ->fetchAll();
?>
<nav class="navbar-custom">
    <ul class="navbar-right list-inline float-right mb-0">
        <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">

        </li>


        <li class="dropdown notification-list list-inline-item">
            <div class="dropdown notification-list nav-pro-img">
                <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                   <span><?php echo $_SESSION['username'] ?></span> <img src="public/assets/images/users/user-4.jpg" alt="user" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                    <a class="dropdown-item" ><i class="mdi mdi-account-check"></i> <font color="white"><?php echo $_SESSION['username'] ?></font></a>
                    <a class="dropdown-item" href="hesabim.php"><i class="mdi mdi-account-circle m-r-5"></i> Profil</a>
					<a class="dropdown-item" href="/market.php"><i class="mdi mdi-account-circle m-r-5"></i> Market</a>	
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#" data-toggle="modal" data-target="#LogoutConfirm"><i class="mdi mdi-power text-danger"></i> Çıkış Yap</a>
                </div>
            </div>
        </li>

    </ul>

    <ul class="list-inline menu-left mb-0">
        <li class="float-left">
            <button class="button-menu-mobile open-left waves-effect">
                <i class="mdi mdi-menu"></i>
            </button>
        </li>

    </ul>
</nav>
</div>

<div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Menü</li>
                            <li>
                                <a href="hesabim.php" class="waves-effect">
                                    <i class="ti-home"></i> <span> Hesabım </span>
                                </a>
                            </li>
                            <li>
                                <a href="bildirim.php" class="waves-effect">
                                    <i class="ti-email"></i><span class="badge badge-danger badge-pill float-right"><?php echo $users -> notices($_SESSION['username']); ?></span> <span> Bildirimlerim </span>
                                </a>
                            </li>
                           <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-universal-access"></i> <span> Özel İşlemler <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="ozel.php">Stat Ve Skill Reset</a></li>
                                    <li><a href="bugkurtar.php">Karakter Kurtar</a></li>
									<li><a href="ozellog.php">Özel İşlem Geçmişi</a></li>
									<li><a href="marketglog.php">Market Geçmişi</a></li>
                                </ul>
                            </li>
							<?php if($rowayar[0]["wheel"] == 1){ ?>	
                           <li>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-puzzle-piece"></i> <span> Şans Oyunları <span class="float-right menu-arrow"><i class="mdi mdi-chevron-right"></i></span> </span> </a>
                                <ul class="submenu">
                                    <li><a href="wheel.php">Çarkıfelek</a></li>
                                    <li><a href="wheellog.php">Çarkıfelek Geçmişi</a></li>

                                </ul>
                            </li>	
							<?php } ?>								
                            <li>
                                <a href="settings.php" class="waves-effect">
                                    <i class="fa fa-cogs"></i> <span> Genel Ayarlar </span>
                                </a>
                            </li>	
                            <li>
                                <a href="sifredes.php" class="waves-effect">
                                    <i class="fa fa-lock"></i> <span> Şifre Değiştir </span>
                                </a>
                            </li>	
                            <li>
                                <a href="maxicard.php" class="waves-effect">
                                    <i class="fa fa-euro-sign"></i> <span> TL Yükle </span>
                                </a>
                            </li>	
                            <li>
                                <a href="faq.php" class="waves-effect">
                                    <i class="fa fa-question-circle"></i> <span> S.S.S </span>
                                </a>
                            </li>							
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>		   