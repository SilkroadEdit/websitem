<?php
include('../fonksiyonlar/users.php');
$users=new Users();
header("Content-Type: text/html; charset=utf-8");

if(preg_match('/maxigame_epin_api_ayar\.php/smi',$_SERVER['PHP_SELF'])){

	header('Location: index.php');

	exit();

}

$hesapno = $users->link->db_conn_pann->query("select * from maxigame where id=1");
$row = $hesapno->fetchAll();
//Maxigame Epin Api Ayarları

$maxigame['api_user'] = "9f044c536cad56278354268a2da474cd";//Maxigame Api Key

$maxigame['api_pass'] = "3wOBnuH?";//Maxigame Api Şifresi

$maxigame['post_url'] = 'http://www.maxigame.com/epin/yukle.php'; //post url



//Server veritabanı ayarları

$sql_server_ayar = array(
	'ip' => 'DESKTOP-Q7FASMR\SQLEXPRESS',
	//'ip' => 'ip',
	'port' => '1433',	
	'db' => 'SRO_VT_ACCOUNT',
	'user' => 'sa',
	'pass' => '1907Fener'	
);

$sql_tl_server_ayar = array(
	'ip' => 'DESKTOP-Q7FASMR\SQLEXPRESS',
	//'ip' => 'ip'
	'port' => '1433',
	'db' => 'Panel',
	'user' => 'sa',
	'pass' => '1907Fener'
);


?>