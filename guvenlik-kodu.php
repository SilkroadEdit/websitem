<?php
session_start();
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
echo '<center><font size="6" color="black">'.$_SESSION['guvenlikKodu'].'</font></center>';
?>