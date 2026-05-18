<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
<?php 
$_SESSION['_token'] = sha1(md5(rand(00000, 99999)));
include('paginiation-class.php');
$pgn = new Pagenation(); 
		include('../fonksiyonlar/admin.php');
			$admin = new Admin();
$gmadı=$_SESSION['username2'];
$tarihver =date('d.m.Y H:i:s');
		$detay = $admin->link->db_conn_pann->query("select * from adminyetki where kuladi ='$gmadı'");
		$row = $detay->fetchAll();
		if(sizeof($row) == 0){
		session_destroy();
		header('Location:index.php');
			}else{
		}
		
	if(!isset($_SESSION['loginadmin'])){
	}else{
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) { 
session_unset();
session_destroy();
header('Location:index.php');
} 
$_SESSION['LAST_ACTIVITY'] = time();
}	
?>
<?php
    function kisalt($metin, $uzunluk){
  	// substr ile belirlenen uzunlukta kesiyoruz
        $metin = substr($metin, 0, $uzunluk)."...";
	// kesilen metindeki son kelimeyi buluyoruz
        $metin_son = strrchr($metin, " ");
	// son kelimeyi " ..." ile değiştiriyoruz
        $metin = str_replace($metin_son," ...", $metin);
        
        return $metin;
    }
?>

	<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
        <a href="admin.php" class="logo">
            <span class="logo-mini"><b>A</b>P</span>
            <span class="logo-lg"><b>Admin </b>Panel</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
                            <span class="hidden-xs"><?php echo $_SESSION['username2'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <img src="assets/img/user2-160x160.jpg" class="img-circle"
                                     alt="User Image">
                                <p>
                                   <?php echo $_SESSION['username2'] ?>
                                    <br>
                                    Administrator
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="?do=exit" class="btn btn-default btn-flat">Çıkış Yap</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>Hoşgeldin,</p>
                    <p><?php echo $_SESSION['username2'] ?></p>
                </div>
            </div>
            <ul class="sidebar-menu" id="sidebar-menu">
                <li class="header">GENEL</li>
                     <li class="treeview">
                        <a href="#"><i class="fa fa-cogs"></i> <span>Ayarlar</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="admin.php?do=siteayar"><i class="fa fa-cog"></i>
                                    <span>Site Ayarları</span></a></li>
                            <li><a href="admin.php?do=kaleayar"><i class="fa fa-cog"></i>
                                    <span>Kale Ayarları</span></a></li>
									  <li><a href="admin.php?do=bolumayar"><i class="fa fa-cog"></i>
                                    <span>Bölüm Ayarları</span></a></li>
									      <li><a href="admin.php?do=cacheayar"><i class="fa fa-cog"></i> <span>Önbellek Ayarları</span></a>
                            </li>
							      <li><a href="admin.php?do=genelayarr"><i class="fa fa-cog"></i>
                                    <span>Genel Ayarlar</span></a></li>
                        </ul>
                    </li>

					<li><a href="admin.php?do=icerikler"><i class="fa fa-newspaper-o"></i> <span>Haberler</span></a></li>
				
                    <li>
                        <a href="admin.php?do=down"><i class="fa fa-cloud-download"></i> <span>Dosyalar</span></a>
                    </li>
                    <li><a href="admin.php?do=market"><i class="fa fa-shopping-cart"></i> <span>Market</span></a></li>
						<li><a href="admin.php?do=marketlog"><i class="fa fa-history"></i>
										<span>Market Geçmişi</span></a></li>	
						<li><a href="admin.php?do=gelenkutusu"><i class="fa fa-ticket"></i> <span>Bildirimler</span><span class="label label-danger pull-right"><?php echo $admin -> notices(); ?></span></a></li>
						  <li><a href="admin.php?do=hesapno"><i class="fa fa-bank"></i> <span>Banka Hesapları</span></a></li>
						  <li><a href="admin.php?do=faqs"><i class="fa fa-book"></i> <span>Yardım Konuları</span></a></li>
					     <li><a href="admin.php?do=uniqlog"><i class="fa fa-bar-chart"></i> <span>Rank İşlemleri</span></a>
			
                       	  <li><a href="admin.php?do=entegrasyon"><i class="fa fa-universal-access"></i>
                                    <span>Özel İşlem Fiyatları</span></a></li>				
							<li><a href="admin.php?do=ozellog"><i class="fa fa-history"></i>
                                    <span>Özel İşlem Log </span></a></li>
					                   <li class="treeview">
                        <a href="#"><i class="fa fa-user-secret"></i> <span>Yetki İşlemleri</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="admin.php?do=adminlistesi"><i class="fa fa-user-plus"></i> <span>Panel Admin Yetkileri</span></a>
                            </li>
                            <li><a href="admin.php?do=gmlistesi"><i class="fa fa-user-plus"></i>
                                    <span>Gamemaster Yetkileri</span></a></li>

                        </ul>
                    </li>									
<li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Kullanıcı İşlemleri</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li>
                                <a href="admin.php?do=kullanici">
                                    <i class="fa fa-search"></i> <span>Kullanıcı Ara & Düzenle</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.php?do=banlistesi">
                                    <i class="fa fa-ban"></i> <span>Kullanıcı Yasakla</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.php?do=silk_ekle">
                                    <i class="fa fa-arrow-circle-right"></i> <span>Kullanıcıya Silk Ver</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.php?do=tl">
                                    <i class="fa fa-try"></i> <span>Kullanıcıya TL Ver</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.php?do=gamecredit">
                                    <i class="fa fa-arrow-circle-right"></i> <span>Kullanıcıya Oyun Kredisi Ver</span>
                                </a>
                            </li>							
							                            <li>
                                <a href="#">
                                    <i class="fa fa-question-circle"></i> Tüm Bilgileri Bul <i
                                            class="fa fa-angle-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="admin.php?do=kullaniciara"><i
                                                    class="fa fa-info-circle"></i>
                                            Kullanıcı Adı ile Bul</a></li>
                                    <li><a href="admin.php?do=karakterara"><i
                                                    class="fa fa-info-circle"></i>
                                            Karakter Adı ile Bul</a></li>
                                    <li><a href="admin.php?do=jobara"><i
                                                    class="fa fa-info-circle"></i>
                                            Job Adı ile Bul</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
	<li class="treeview">
                        <a href="#"><i class="fa fa-male"></i> <span>Karakter İşlemleri</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
							<li>
                                <a href="admin.php?do=karakter">
                                    <i class="fa fa-search"></i> <span>Karakter Ara & Düzenle</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.php?do=add_item">
                                    <i class="fa fa-arrow-circle-right"></i> <span>Karaktere Item Ver</span>
                                </a>
                            </li>							
                            <li>
                                <a href="admin.php?do=tl2">
                                    <i class="fa fa-try"></i> <span>Karaktere TL Ver</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin.php?do=silk_ekle2">
                                    <i class="fa fa-arrow-circle-right"></i> <span>Karaktere Silk Ver</span>
                                </a>
                            </li>							
						
							<li>
                                <a href="admin.php?do=sp">
                                    <i class="fa fa-arrow-circle-right" ></i> <span>Karaktere Sp Ver</span>
                                </a>
                            </li>

                            <li>
                                <a href="admin.php?do=gold_ekle">
                                    <i class="fa fa-arrow-circle-right"></i> <span>Karaktere Gold Ver</span>
                                </a>
                            </li>
                          <li>
                            <li>
                                <a href="admin.php?do=gamecredit2">
                                    <i class="fa fa-arrow-circle-right"></i> <span>Karaktere Oyun Kredisi Ver</span>
                                </a>
                            </li>						  
                            <li>
                                <a href="admin.php?do=namek">
                                    <i class="fa fa-refresh"></i> <span>Karakter Adını Değiştir</span>
                                </a>
                            </li>
                            <li>
                                 <a href="admin.php?do=jobname">
                                    <i class="fa fa-refresh"></i> <span>Karakter Job Adını Değiştir</span>
                                </a>
                            </li>
							<li>							  
                                <a href="admin.php?do=bug">
                                    <i class="fa fa-bolt"></i> <span>Karakter Işınlama</span>
                                </a>
                            </li>
						
                            <li>
                           
                        </ul>
                    </li>
					
					<li class="treeview">
                        <a href="#"><i class="fa fa-shield"></i> <span>Guild İşlemleri</span> <i
                                    class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="admin.php?do=guild"><i class="fa fa-search"></i>
                                    <span>Guild Ara & Düzenle</span></a></li>
                        </ul>
                    </li>

				                    <li class="treeview">
                        <a href="#"><i class="fa fa-puzzle-piece"></i> <span>Şans Oyunları</span>
                            <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="admin.php?do=wheel"><i class="fa fa-pie-chart"></i>
                                    <span>Çarkıfelek</span></a></li>
                            <li><a href="admin.php?do=wheellog"><i class="fa fa-history"></i>
                                    <span>Ödül Geçmişi</span></a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="admin.php?do=maxigame">
                            <i class="fa fa-credit-card"></i><span>Maxigame Entegrasyon</span>
                        </a>
                    </li>					
                    <li>
                        <a href="admin.php?do=truncates">
                            <i class="fa fa-database"></i><span>Veritabanı Temizleme</span>
                        </a>
                    </li>					
					                    <li>
                        <a href="admin.php?do=adminlog">
                            <i class="fa fa-history"></i><span>Admin İşlem Kayıtları</span>
                        </a>
                    </li>
                    <li>
                        <a href="admin.php?do=adminloginlog">
                            <i class="fa fa-history"></i><span>Admin Giriş Kayıtları</span>
                        </a>
                    </li>
		
  
        </section>
    </aside>
	<section id="main" class="column">
			<?php 
		function g($par){	
			return strip_tags(trim(addslashes($_GET[$par])));
				}	
	
			$do=g("do");
			 if(file_exists("inc/{$do}.php")){
				require("inc/{$do}.php");
			 }else{
			 
				require("inc/anasayfa.php");
			 }
		
		?>
	</section>

    <!-- ChartJS 1.0.1 -->
    <script src="plugins/chartjs/Chart.min.js"></script>

            </div>
        </section>
 
<script src="assets/js/bootstrap.min.js"></script>
<script src="plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/app.min.js"></script>
</body>
	

