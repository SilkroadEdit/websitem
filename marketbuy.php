<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>

<?php 
		$getitem = (int)$_GET['item'];
	if(isset($_SESSION['guardf']) && gettype($getitem) !== "string"){
		$marketitem=$users->market_listele_id((int)$getitem); 

		
		if(sizeof($marketitem) == 0 ){
			header("Location: index.php");
		die();
		}
		?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?=$dils['market'];?></h3>
<br>
<div id="buyitinfo">
<div class="tcolor-koyumavi" style="font-size: 15px">
<span style="font-weight: bold">Lütfen okumadan satın alma yapmayınız!</span>
<br/>
1- Tüm satın aldığınız itemler "Bankanıza" gönderilecektir.<br/>
2- Satın alma işleminden önce bankanızda boş slot olup olmadığına dikkat ediniz. Aksi takdirde sistem işlemi
tamamlamayacaktır.<br/>
3- Satın alma işleminden önce <span class="tcolor-kirmizi">MUTLAKA OYUNDAN ÇIKIŞ YAPINIZ.</span> Aksi
takdirde bazı ürünleri teslim alamayabilirsiniz.
</div>
<div style="margin-top: 10px">
<form id="buyit-form" method="post">
<input type="hidden" name="item" value="<?php echo $marketitem[0]['id']?>" />
<label class="formBlock1" style="width: 90%; margin: 0 auto; text-align: center; height: auto;">
Lütfen aşağıdan itemlerin aktarılmasını istediğiniz charınızı seçin;
<select class="formInput1" name="char_list" style="float: none; margin: 0 auto;">
<option value="0">Karakter Seçin</option>
<?php
		$karakterler_class = $users->get_jid();
		foreach($users->get_jid() as $karakterler){
			echo "<option value='".$karakterler['CharName16']."'>".$karakterler['CharName16']."</option>";
		}
		?></select>
</label>
<label class="formBlock1" style="width: 90%; margin: 0 auto; text-align: center;height: auto;">
Güvenlik için hesap şifrenizi yazınız
<input class="formInput1" name="marketpass" type="password" style="float: none; margin: 0 auto;">
<input type="hidden" name="buy_item">
</label>
</form>
</div>

<span class="result"></span>
<div style="margin-top: 15px">
<table class="marketBuyTablo">
<tr>
<td>Ürün resmi</td>
<td>
<img src="<?php echo $marketitem[0]['resim']?>" width="32" height="32" />
</td>
</tr>
<?php if($marketitem[0]['types'] == 2){ $tl1 = ''.$marketitem[0]['fiyat'].'	Silk'; }else{ $tl1 = ''.$marketitem[0]['fiyat'].'	TL '; } ?>		
<tr>
<td>Satın alacağınız ürün</td>
<td>
<?php echo $marketitem[0]['item_adi']?></td>
</tr>
<tr>
<td>Toplam ödenecek tutar</td>
<td><?php echo " ".$tl1.""; ?></td>
</tr>
<tr>
<td colspan="2"><a class="alisverisbtn" style="width: 160px" href="javascript:void(0);" id="buyit"><?=$dils['marketbtn'];?></a></td>
</tr>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php
		
	}else{
		
		Null;
	}	
	?>
	<?php  
	if(isset($_SESSION['guardf'])){
	
		
	}else{
		//Giriş yapılmamışsa
		echo'<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3>'.$dils['market'].'</h3>
<br>
<div style="text-align: center">
<img src="media/images/error.png" alt />
<br><br>
<div class="bilgiilk hatu">
<br>
<font color="red" size="4px">'.$dils['markethata1'].'</font>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>';

	}
	?>	
<?php include('fonksiyonlar/footer.php'); ?>