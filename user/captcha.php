<?php
session_start();
function sifreureteci(){
 $karakterler = "1234567890abcdefghijuvwxyzklmnopqrst0987654321";
 $sifre = '';
 for($i=0;$i<6;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 46};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}
$_SESSION['captcha']=sifreureteci();
echo '<center><font size="5" color="gold">'.$_SESSION['captcha'].'</font></center>';
?>
