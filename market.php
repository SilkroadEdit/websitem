<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['market'];?></h3>
<br>
<?php  
	if(isset($_SESSION['guardf'])){
		echo '      <table class="download-table" border="0" style="font-size: 13px;width: 100% !important;">
                            <tbody>';
	$markets = $users->market_listele();
		if (sizeof($markets) == 0){  
				
				echo '<p class="text-center text-danger">'.$dils['veri'].'</p>'; 
				
		}
	foreach($markets as $row){
 //Goruntulencek Metnin Tam Hali
$detay = $row['item_adi'];
//Var olan metin içindeki karakter sayısı
$uzunluk = strlen($detay);
//Kaç Karakter Göstermek İstiyorsunuz
$limit = 15;
//Uzun olan yer "devamı..." ile değişecek.
if ($uzunluk > $limit) {
$detay = substr($detay,0,$limit) . "...";
}		
	  if($row['types'] == 2){ $tl1 = '<span style="color:#f4a460;">Silk Fiyatı:	'.$row['fiyat'].'	Silk</span>'; }else{ $tl1 = '<span style="color:#f4a460;">TL Fiyatı:	'.$row['fiyat'].'	<i class="fa fa-try"></i> </span> '; }
	  $item_id = $row['id'];
		echo '                    <div class="corner-box">
<div class="item-image">
<div style="background:url('.$row["resim"].') no-repeat; background-size: 48px 48px;"></div>
</div>
<h4 class="item-name" style="color: #74c564;">
'.$row['item_adi'].'</h4>
<div class="item-price">
'.$tl1.' </div>
<div class="item-buy">
<a href="marketbuy.php?item='.$item_id.'" id="item-buy" class="alisverisbtn">'.$dils['marketbtn'].'</a>
</div>
</div>
                 ';	} 
			echo' </tbody>  </table>';
		
	}else{
		//Giriş yapılmamışsa
		echo'<div style="text-align: center">
<img src="media/images/error.png" alt />
<br><br>
<div class="bilgiilk hatu">
<br>
<font color="red" size="4px">'.$dils['markethata1'].'</font>
</div>
</div>';

	}
	?>


</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>