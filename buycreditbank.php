<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>

			 <?php 

		if($rowayar[0]["hesapno"] == 1){
			$hesapno = $users->link->db_conn_pann->prepare("select * from HesapNo");
			$hesapno -> execute();
echo'    <div id="content">
                    <div class="haberBoxBg">
						<div class="haberBox"><h3>'.$dils['bnk_hsp'].'</h3>
                            <div id="ranking-result" class="ranking-tables">
							<table>
			<tbody>
			<tr class="first">
            <td width="10">Banka Adı</th>
            <td width="300">Şube No</th>
            <td width="200">IBAN</th>
            <td width="200">Hesap No</th>
            <td width="200">Hesap sahibi</th>
        </tr>';
			foreach($hesapno as $row){
			
	
	echo'
    <tr>
        <td>'.$row['bankaAdi'].'</td>
        <td>'.$row['subeNo'].'</td>
        <td>'.$row['IBAN'].'</td>
        <td>'.$row['hesapNo'].'</td>
        <td>'.$row['hesapSahibi'].'</td>
    </tr>';
	}
		echo '</tbody></table></div></div></div></div>';
	}else{	
	echo'  <div id="content">
<div id="oyunKurallari" class="haberBoxBg">
<div class="haberBox">
<h3>'.$dils['bnk_hsp'].'</h3>
<p style="text-align: center" class="tcolor-kirmizi">
'.$dils['close_bnk_hsp'].'
</p>
</div>
</div>
</div>';	
} 
 ?> 
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>