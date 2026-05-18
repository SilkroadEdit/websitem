<html>
<body>
<div id="navigasyon" class="fLeft">
<ul>
<li><a href="index.php" style="background-image:none;">Anasayfa</a></li>
<li><a href="register.php">Kayıt Ol</a></li>
<li><a href="userstats.php">İstatistikler</a></li>
<li><a href="search.php">Karakter ve Guild Arama</a></li>
<li><a href="iletisim.php">İletişim</a></li>
</ul>
</div>
<div class="clear"></div>
</div>



<?php if(!isset($_SESSION['guardf'])){ ?>
<div id="sidebar" class="w300 fLeft">
<div id="uyeEkrani">
<div id="uyeEkraniIcerik">
<h3 class="sidebarBaslik"><?= $dils['login'];?></h3>
<br/><br/>
<form method="post" id="login-form">
<input type="hidden" name="login" />
<label class="formBlock label">
<input class="formBlock input" name="username" id="logusername" type="text" placeholder="<?= $dils['login1'];?>" autocomplete="off">
</label>
<label class="formBlock label">
<input class="formBlock input" name="pass" id="logpassword" type="password" placeholder="<?= $dils['login2'];?>" autocomplete="off">
</label>
<label>
<button class="girisBtn" type="submit">
<?= $dils['login'];?>
</button>
</label>
</form>
</div>
<a href="lostpassword.php"><?= $dils['unuttum'];?></a>
<div id="kayitButon"><a class="sidebarButon" href="register.php">ÜCRETSİZ KAYIT OL</a></div>
</div>
<?php }else {
	echo '  
<div id="sidebar" class="w300 fLeft">
<div id="uyeEkrani">
<h3 class="sidebarBaslik">'.$dils['hg'].'</h3>
<p><span style="font-weight: bold;"> ('.$_SESSION['username'].')</span></p>
<p><span>Silk : '.$_SESSION['silk'].'</span></p>
<p><span>TL: '.$_SESSION['tlmiktari'].' <i class="fa fa-turkish-lira"></i></span></p>
<a href="/user" class="girisBtn">Kullanıcı Paneli</a>
<a href="/maxicard" class="girisBtn" target="_blank">MaxiCard E-Pin Yükle</a>
<div id="kayitButon"><a class="sidebarButon" href="exit.php">Çıkış Yap</a></div>
</div>
';
		}?>  
<div class="sidebarBox-new">
<h3 class="sidebarBaslik"><?=$dils['sunucu'];?></h3>
<?php $degerler=$rowayar[0]['Player'] + $fake; $pure= $degerler*100/$rowayar[0]['kapasite']; ?>
<div id="online" class="center">
<span class="eu fLeft">EU<br><?php echo $rowEUonline[0]['count'] + $fakeEU; ?></span>
<span class="cevrimiciSayi"><?php echo $rowayar[0]['Player'] + $fake; ?> / <?php echo $rowayar[0]['kapasite']; ?> <br> <p class="cevrimiciYazi" style="margin-left:27px;">Çevrimiçi</p></span>
<span class="ch fRight">CH<br><?php echo $rowCHonline[0]['count'] + $fakeCH; ?></span>
</div>
<div class="clear"></div>
<br>
</div>
<div class="sidebarBox-new">
<h3 class="sidebarBaslik"><?=$dils['rank'];?></h3>
<div class="center" style="width: 95%;">
<div class="pvplonca">
<ul id="rank-menu">
<li class="selected"><a href="javascript:void(0);" data-type="player-mini">Player</a></li>
<li><a href="javascript:void(0);" data-type="guild-mini">Guild</a></li>
<li><a href="javascript:void(0);" data-type="unique-mini">Unique</a></li>
<li><a href="javascript:void(0);" data-type="pvp-mini">PvP</a></li>
</ul>
</div>
<div class="siralamaTablo">
<div id="rank-result">
</div>
<button class="alisverisbtn" onclick="window.location.href = 'ranking.php'">Tüm Sıralamayı Gör</button>
</div>
<script type="text/javascript">
          $(document).ready(function () {
                elementLoading('#rank-result');
                $.post('ranks.php', {action: 'player-mini'})
                    .done(function (data) {
                        $('#rank-result').html(data);
                        elementLoading('#rank-result', 'hide');
                    })
                    .fail(function (data) {
                        $('#rank-result').html('Bad Request');
                        elementLoading('#rank-result', 'hide');
                    });

                $('#rank-menu').find('li a').click(function () {
                    var type = $(this).data('type'), list = $(this).parent('li');

                    elementLoading('#rank-result');
                    $.post('ranks.php', {action: type})
                        .done(function (data) {
                            $('#rank-menu').find('li.selected').removeClass('selected');
                            list.addClass('selected');
                            $('#rank-result').html(data);
                            elementLoading('#rank-result', 'hide');
                        })
                        .fail(function (data) {
                            $('#rank-result').html('Bad Request');
                            elementLoading('#rank-result', 'hide');
                        });
                    return false;
                })
            });
        </script>
</div>
<div class="clear"></div>
</div>
<div id="fortressWar" class="sidebarBox-new widget-fortress">
<h3 class="sidebarBaslik">Kale Sahipleri</h3>
<?php $dosyaAdi = "kaleayar.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['genelcache'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start(); ?>
 <?php $aliance =  $users->link->db_conn_shard->query("SELECT b.name,b.ID,a.*,(select jangan from Panel..kaleayar where id = 1) as jangan,(select hotan from Panel..kaleayar where id = 1) as hotan,(select bandit from Panel..kaleayar where id = 1) as bandit,(select cons from Panel..kaleayar where id = 1) as cons from _SiegeFortress as a inner join _Guild b on b.ID=a.GuildID");
$rows = $aliance->fetchAll();
foreach($rows as $row){
 ?>    
<?php if($row['FortressID'] == 1){ ?> 
<?php if($rows[0]['jangan'] == 1){ ?> 
<div style="width:85%;" class="center">
<div id="jangan_fortress" class="fortress">
                <h3>Jangan Fortress</h3>
                <div class="guildname"><?php if($row['name'] == dummy){ echo $dils['fortress']; }else{ echo '<a href="guildinfo.php?q='.$row['ID'].'">'.$row['name'].'</a>'; } ?></div>
               <div class="guildtax">Tax: <?php echo $row['TaxRatio']; ?>%</div>
            </div> 
		<?php echo '</div>'; } ?>
	<?php } ?>
<?php if($row['FortressID'] == 3){ ?> 
<?php if($rows[0]['hotan'] == 1){ ?> 
<div style="width:85%;" class="center">
<div id="hotan_fortress" class="fortress">
                <h3>Hotan Fortress</h3>
                <div class="guildname"><?php if($row['name'] == dummy){ echo $dils['fortress']; }else{ echo '<a href="guildinfo.php?q='.$row['ID'].'">'.$row['name'].'</a>'; } ?></div>
				<div class="guildtax">Tax: <?php echo $row['TaxRatio']; ?>%</div>
            </div>
	<?php echo '</div>'; } ?>
	<?php } ?>	
<?php if($row['FortressID'] == 6){ ?> 
<?php if($rows[0]['bandit'] == 1){ ?> 
<div style="width:85%;" class="center">
<div id="bandit_fortress" class="fortress">
                <h3>Bandit Fortress</h3>
                <div class="guildname"><?php if($row['name'] == dummy){ echo $dils['fortress']; }else{ echo '<a href="guildinfo.php?q='.$row['ID'].'">'.$row['name'].'</a>'; } ?></div>
				<div class="guildtax">Tax: <?php echo $row['TaxRatio']; ?>%</div>	
            </div>
	<?php echo '</div>'; } ?>
<?php } ?>		
<?php if($row['FortressID'] == 4){ ?> 
<?php if($rows[0]['cons'] == 1){ ?> 
<div style="width:85%;" class="center">
 <div id="constantinople_fortress" class="fortress">
                <h3>Constantinople Fortress</h3>
                <div class="guildname"><?php if($row['name'] == dummy){ echo $dils['fortress']; }else{ echo '<a href="guildinfo.php?q='.$row['ID'].'">'.$row['name'].'</a>'; } ?></div>
				<div class="guildtax">Tax: <?php echo $row['TaxRatio']; ?>%</div>	
            </div>
	<?php echo '</div>'; } ?>	
	<?php } ?>	
<?php

 }  ?>	
                     <?php 
			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}

?>	


<div class="clear"></div>
</div>
<div class="sidebarBox-new">
<h3 class="sidebarBaslik"><?=$dils['schedule'];?></h3>
<div style="width:85%;" class="center" id="timers">
<table class="schedule-table">
<?php include('fonksiyonlar/ekstra.tpl'); ?>
</table>
</div>
<div class="clear"></div>
</div>
<div class="sidebarBox-new">
<h3 class="sidebarBaslik"><?=$dils['maxi'];?></h3>
<div class="center">
<div style="text-align: center; margin-bottom: 0;">
<a href="http://www.maxigame.org/odeme-secenekleri.php" target="_blank"><img src="maxicard/img/sol_banner.gif"></a>
</div>
</div>
<div class="clear"></div>
</div>
<div class="sidebarBox-new">
<h3 class="sidebarBaslik"><?=$dils['server'];?></h3>
<div style="width:85%;" class="center">
<table class="stats-table">
<tr>
<td><span style="font-weight: bold">Exp Rate</span></td>
<td><?php echo $rowayar[0]['exprate']; ?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Sp Rate</span></td>
<td><?php echo $rowayar[0]['sprate']; ?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Level Cap</span></td>
<td><?php echo $rowayar[0]['levelcap']; ?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Mastery Cap</span></td>
<td><?php echo $rowayar[0]['masterycap']; ?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Silk</span></td>
<td><?php echo $rowayar[0]['baslangic']; ?></td>
</tr>
<tr>
<td><span style="font-weight: bold">Version</span></td>
<td>v1.4xxx</td>
</tr>
</table>
</div>
<div class="clear"></div>
</div>
<div class="sidebarBox-new">
<h3 class="sidebarBaslik"><?=$dils['sponsor'];?></h3>
<div style="text-align: center; margin-bottom: 10px">
<a href="https://www.vsro.org/" title="vSro.org" target="_blank">
<img src="https://www.vsro.org/yedekler/xenforo-logo.png" style="width: 150px; height: auto;" />
</a>
</div>
<div class="clear"></div>
</div>
</div> <div id="container" class="fRight">
<div id="ikinciMenu">
<ul>
<li><a class="market" href="market.php">market</a></li>
<li><a class="download" href="download.php">Download</a></li>
<li><a class="tlYukle" href="buycreditbank.php">tl yükle</a></li>
<li><a class="ranklar" href="ranking.php">ranklar</a></li>
<li><a class="rehber" href="user/">rehber</a></li>
<li><a class="galeri" href="user/">oyun oyna</a></li>
<li><a class="facebook" href="<?php echo $rowayar[0]['facebook']; ?>" target="_blank">facebook</a></li>
</ul>
</div> 
