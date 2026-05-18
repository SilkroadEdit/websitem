<?php

	

	// SQL BAGLANTI BİLGİLERİ 
$serverName = "WIN-T278VF13QJ8\SQLEXPRESS";
$serverUser = "hatay34";
$serverPass = "ist31";
$dbShard 	= "SRO_VT_SHARD";
$dbAccount	= "SRO_VT_ACCOUNT";
$dbLog 		= "SRO_VT_LOG";
$dbPann 		= "Panel";
$dbLogger 		= "RemoLogger";


	// SERVER GENEL BİLGİLER
$gameName   = "Test Server";
$serverCap  = 100;
$expRate	= "-";
$goldRate	= "-";
$dropRate	= "-";
$Total		= 300;
$ch_eu		= "Chine";


	// SOSYAL MEDYA ADRESLERİ
# Kullandığınız sosyal medya adresilerini aşağıdaki gibi giriniz.
# Panel kullandığınız adreslere göre otomatik şekillenecektir.

$facebook	= "https://www.facebook.com/clubsilkroad";
$twitter	= "https://www.twitter.com/clubsilkroad";
$google		= "https://plus.google.com/114936550945797112172";
$youtube	= "https://www.youtube.com/channel/UCFQoIqxbz43E4CFS4BIIxnw";


	// UNIQ RANK SAYFA UZANTISI
# Server'ınızda kullandığınız uniq rank'ın uzantısını burada belirtiniz.(asp veya php fark etmez.)

$uniqrank = "#";

	// FORUM SAYFA UZANTISI
# Hali hazırda kullanmak istediğiniz forumunuz var ise forumun linkini burada belirtiniz.
# Forumunuz yoksa biz size forum kuruyoruz.

$forum ="http://destek.clubsilkroad.org";  // DESTEK YAPTIM BUNU 

// BU KISIMLA OYNAMAYIN !
$config['db']=array(
    'host'  	=>  $serverName,
    'dbshard'	=>  $dbShard,
	'dbaccount'	=>  $dbAccount,
	'dblog'		=> 	$dbLog,
	'dbpann'		=> 	$dbPann,
	'dblogger'		=> 	$dbLogger,
    'user'  	=>  $serverUser,
    'pass'  	=>  $serverPass
    );