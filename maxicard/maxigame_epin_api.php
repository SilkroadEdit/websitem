<?php

header("Content-Type: text/html; charset=utf-8");

######################################################################

#  ============================================

#

#  Metin DOKUZ (c) 2015 

# (acayip@gmail.com)

#  http://www.yamantasarim.com

#

######################################################################



######################################################################

# Bu kısmı Değiştirmeyin



if(preg_match('/maxigame_epin_api\.php/smi',$_SERVER['PHP_SELF'])){

	header('Location: index.php');

	exit();

}



$api_donus_kodlari = array(

'ok' => 'Yükleme işlemi başarılı',

'bayi_hata' => 'Bayi adı veya şifre hatalı',

'bayi_aktif_hata' => 'Bayi aktif değil',

'hesap_hata' => 'Bayi hesabı bulunamadı',

'ip_hata' => 'Bu Ip adresinden işlem yapamazsınız',

'kod_hata' => 'Kart kodu veya kart şifresi hatalı',

'kod_tekrar_hata' => 'Kullanılmış Kart kodu',

'fiyat_hata' => 'Yüklenecek miktar belirsiz veya sistemde kayıtsız miktar',

'komut_hata' => 'Komut Belirsiz',

'eksik_alan' => 'Eksik alan var',

'hata' => 'Hatalı bir işlem yaptınız',

);



function maxigame_post_xml($url, $xml) {

  $ch = curl_init();

  curl_setopt($ch, CURLOPT_URL, $url);

	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);

	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 

  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

  curl_setopt($ch, CURLOPT_HEADER, 0);

	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');

	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, 'data='.urlencode($xml));

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	curl_setopt($ch, CURLOPT_VERBOSE, 1);

	$gelen = curl_exec($ch);

	if(curl_errno($ch))	print curl_error($ch);

	curl_close($ch);

	return $gelen;

}



function maxigame_post($post = ''){

	global $maxigame;

	if(!$maxigame['api_user'] || !$maxigame['api_pass'] || !$maxigame['post_url']) die('Api Bilgileriniz Eksik');

	if(!$post) die('Post Bilgisi Gelmedi');

	$data='<?xml version="1.0" encoding="utf-8"?>

	<APIRequest>

		<params>

			<username>'.$maxigame['api_user'].'</username>

			<password>'.$maxigame['api_pass'].'</password>

			'.$post.'

		</params>

	</APIRequest>';

	$gelen = maxigame_post_xml($maxigame['post_url'], $data);

	return $gelen;

}



function maxigame_epin_yukle($epin){

	if(!$epin) die('Gerekli Alanlar Gelmedi');

	$post = '<cmd>epinadd</cmd>

	<epinusername>'.$epin['username'].'</epinusername>

	<epincode>'.$epin['kart_kodu'].'</epincode>

	<epinpass>'.$epin['kart_sifresi'].'</epinpass>';

	$gelen = maxigame_post($post);

	return $gelen;

}



function rast(){

	srand((double)microtime()*1000000);

	$ifade = md5(rand(0,9999));

	$kod = substr($ifade, 17, 9);

	return $kod;

}



?>