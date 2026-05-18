<?php 
session_start();
ob_start();

//print_r($_SESSION);
include('fonksiyonlar/users.php');
$users=new Users();
$name = strip_tags(htmlspecialchars($_GET['name']));
if(isset($_POST)) { 

if(isset($_POST['action'])) { 
					$site_ayar= $users->link->db_conn_pann->query("SELECT * from onbellek_ayarları");
					$rowayar = $site_ayar ->fetchAll();

//player

if($_POST['action'] == 'player') {

		$player = $users->link->db_conn_shard->query("select
			TOP(50) refChar.CharID,
			refChar.CharName16,
			refChar.RemainSkillPoint,
			refChar.RefObjID,
			refChar.CurLevel,
			refChar.HwanLevel,
			C.Name,
			(
				select
					SUM(
						refObjItem.ItemClass + (
							(
								case
									when binding.nOptValue is null then 1
									else binding.nOptValue + 1
								end
							) + (
								case
									when binding.nOptLvl is null then 1
									else binding.nOptLvl + 1
								end
							)
						) * (item.OptLevel + 1) + refObjChar.Rarity + refObjItem.SetID + item.MagParamNum
					)
				FROM
					SRO_VT_SHARD.._Inventory inventory
					INNER JOIN SRO_VT_SHARD.._Items item ON inventory.ItemID = item.ID64
					LEFT OUTER JOIN SRO_VT_SHARD.._BindingOptionWithItem binding ON item.ID64 = binding.nItemDBID
					INNER JOIN SRO_VT_SHARD.._RefObjCommon refObjChar ON refObjChar.ID = item.RefItemID
					INNER JOIN SRO_VT_SHARD.._RefObjItem refObjItem ON refObjChar.Link = refObjItem.ID
				where
					inventory.CharID = refChar.CharID
					and item.RefItemID != 0
					and inventory.ItemID != 0
					and refObjChar.ReqLevel1 != 0
					and inventory.Slot between 0
					and 12
			) Puan,
			C.Name GuildName
		FROM
			SRO_VT_SHARD.._Char refChar
			LEFT OUTER JOIN SRO_VT_SHARD.._Guild C ON C.ID = refChar.GuildID
		WHERE
			refChar.CharName16 like '%' + '$name' + '%' and refChar.CharName16 NOT LIKE '%GM%'
		GROUP BY
			refChar.CharName16,
			C.Name,
			refChar.HwanLevel,
			refChar.CurLevel,
			refChar.CharID,
			refChar.RefObjID,
			refChar.RemainSkillPoint
		ORDER BY
			Puan DESC,
			refChar.CurLevel DESC");
$rank = 1;
$players = $player ->fetchAll();
if (sizeof($players) == 0){  
echo '<p class="text-center text-danger">Aradığınız karakter bulunamadı.</p>'; }else{
echo'    
   <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        <td width="10">Sıra</td>
        <td width="230">Oyuncu Adı</td>
		<td width="190">Guild</td>
		<td width="94">Level</td>
        <td width="94">Item Puanı</td>
    </tr>';
}
	foreach($players as $row){
	$ranks1 = $rank++;
			if($row['Name'] == dummy){ $guild1 = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild1 = $row['Name']; }
			if($ranks1 == 1){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks1 == 2){ $sıra1 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks1 == 3){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra1 = ''.$ranks1.''; }

		echo'
<tr>
                	
             <td>'.$sıra1.'</td>
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName16'].'</a></td>
			<td><a href="guildinfo.php?q='.$row['GuildID'].'">'.$guild1.'</td>
			<td> '.$row['CurLevel'].'</td>
			<td> '.$row['Puan'].'</td>
		
		
   </tr>';
		 }

}
//guild

if($_POST['action'] == 'guild') {

		$guild = $users->link->db_conn_shard->query("SELECT TOP 50

		A.ID , A.Name ,A.Lvl, A.GatheredSP , B.CharID, B.CharName , D.CodeName128 , C.HwanLevel, 
		(SELECT COUNT(*) FROM SRO_VT_SHARD.dbo._GuildMember O WHERE O.GuildID = A.ID) AS TotalMember
	FROM 
			 SRO_VT_SHARD.dbo._Guild A
		JOIN SRO_VT_SHARD.dbo._GuildMember B ON A.ID = B.GuildID
		JOIN SRO_VT_SHARD.dbo._Char C ON C.CharID = B.CharID
		JOIN SRO_VT_SHARD.dbo._RefObjCommon D ON D.ID = C.RefObjID
		
	WHERE
		A.Name like '%' + '$name' + '%' AND
		A.ID > 0 AND
		A.ID != 5 AND B.Permission = -1
	
	ORDER BY A.Lvl DESC, TotalMember DESC");
$rank = 1;
$guilds = $guild ->fetchAll();
if (sizeof($guilds) == 0){  
echo '<p class="text-center text-danger">Aradığınız guild bulunamadı.</p>'; }else{
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        <td width="50">Sıra</td>
        <td width="250">Guild ismi</td>
        <td width="220">Master</td>
        <td width="115">Guild Level</td>
		<td width="115">Oyuncu</td>
 
		
        </tr>';
}
	foreach($guilds as $row){
	$ranks1 = $rank++;
if($ranks1 == 1){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks1 == 2){ $sıra1 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks1 == 3){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra1 = ''.$ranks1.''; }

		echo'
<tr>
                	
             <td>'.$sıra1.'</td>
			<td><a href="guildinfo.php?q='.$row['ID'].'">'.$row['Name'].'</a></td>
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName'].'</td>
			<td> '.$row['Lvl'].'</td>
			<td> '.$row['TotalMember'].'</td>
		
		
   </tr>';
		 }

}

if($_POST['action'] == 'guildrank') { 

$dosyaAdi = "guildrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['guild_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="50">Sıra</th>
            <td width="200">Guild ismi</th>
            <td width="200">Guild Başkanı</th>
            <td width="110">Guild Leveli</th>
            <td width="100">Üyeler</th>
            <td width="110">Toplam Item Puanı</th>
        </tr>';
		$guildrank = $users->link->db_conn_shard->query("select TOP 50 B.ID,B.Name,B.Lvl, B.GatheredSP, A.CharID, A.CharName, Panel.dbo._GetGuildItemPoints(B.ID) AS Puan, 
			(SELECT COUNT(*) FROM SRO_VT_SHARD.dbo._GuildMember O WHERE O.GuildID = B.ID) AS TotalMember
			
			from SRO_VT_SHARD.._GuildMember A
			CROSS JOIN SRO_VT_SHARD.._Guild B
			where A.MemberClass = 0 and A.GuildID = B.ID
			ORDER BY Puan DESC,B.GatheredSP desc");
	$rank = 1;

	foreach($guildrank as $row){
		$ranks = $rank++;
		if($ranks == 1){ $sıra = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks == 2){ $sıra = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks == 3){ $sıra = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra = ''.$ranks.''; }
		
		echo'
<tr data-toggle="tooltip" title="'.$row['Name'].' Toplam Gold Miktarı : '.$row['toplamgold'].'">
                	 <td>'.$sıra.'</td>
             
			<td><a href="guildinfo.php?q='.$row['ID'].'">'.$row['Name'].'</td>
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName'].'</a></td>
			<td> '.$row['Lvl'].'</td>
			
			<td> '.$row['TotalMember'].'</td>
			<td> '.$row['Puan'].'</td>
		
				
   </tr>';
		 }
		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}

if($_POST['action'] == 'unionrank') { 

$dosyaAdi = "unionrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['union_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
            <td width="50">Sıra</th>
            <td width="250">Union Master Guild</th>

            <td width="250">Toplam Item Puanı</th>
        </tr>';
		$guildrank = $users->link->db_conn_shard->query("SELECT *,(SELECT Name FROM SRO_VT_SHARD.dbo._Guild G WHERE G.ID = Ally1) AS Name,
			Panel.dbo._GetGuildItemPoints(Ally1) + 
			Panel.dbo._GetGuildItemPoints(Ally2) +
			Panel.dbo._GetGuildItemPoints(Ally3) +
			Panel.dbo._GetGuildItemPoints(Ally4) +
			Panel.dbo._GetGuildItemPoints(Ally5) +
			Panel.dbo._GetGuildItemPoints(Ally6) +
			Panel.dbo._GetGuildItemPoints(Ally7) +
			Panel.dbo._GetGuildItemPoints(Ally8) 
			AS Puan
 FROM _AlliedClans WHERE ID > 0 and Ally3 IS NOT NULL
 order by Puan desc");
	$rank = 1;

	foreach($guildrank as $row){
		$ranks = $rank++;
		if($ranks == 1){ $sıra = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks == 2){ $sıra = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks == 3){ $sıra = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra = ''.$ranks.''; }
		
		echo'
<tr>
                	 <td>'.$sıra.'</td>
              
			<td><a href="unioninfo.php?q='.$row['Ally1'].'&puan='.$row['Puan'].'">'.$row['Name'].'</td>

			<td> '.$row['Puan'].'</td>
		
				
   </tr>';
		 }
		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//player rank
if($_POST['action'] == 'playerrank') {
$dosyaAdi = "playerrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['player_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables">
<table>
        <tr class="first">
            <td width="10">Sıra</td>
            <td width="230">Oyuncu Adı</td>
            <td width="190">Guild</td>
            <td width="94">Level</td>
            <td width="94">Item Puanı</td>
        </tr>
        ';
		$playerrank = $users->link->db_conn_shard->query("
select
			TOP(50) refChar.CharID,
			refChar.CharName16,
			refChar.RemainSkillPoint,
			refChar.RefObjID,
			refChar.CurLevel,
			refChar.HwanLevel,
			C.Name,
			(
				select
					SUM(
						refObjItem.ItemClass + (
							(
								case
									when binding.nOptValue is null then 1
									else binding.nOptValue + 1
								end
							) + (
								case
									when binding.nOptLvl is null then 1
									else binding.nOptLvl + 1
								end
							)
						) * (item.OptLevel + 1) + refObjChar.Rarity + refObjItem.SetID + item.MagParamNum
					)
				FROM
					SRO_VT_SHARD.._Inventory inventory
					INNER JOIN SRO_VT_SHARD.._Items item ON inventory.ItemID = item.ID64
					LEFT OUTER JOIN SRO_VT_SHARD.._BindingOptionWithItem binding ON item.ID64 = binding.nItemDBID
					INNER JOIN SRO_VT_SHARD.._RefObjCommon refObjChar ON refObjChar.ID = item.RefItemID
					INNER JOIN SRO_VT_SHARD.._RefObjItem refObjItem ON refObjChar.Link = refObjItem.ID
				where
					inventory.CharID = refChar.CharID
					and item.RefItemID != 0
					and inventory.ItemID != 0
					and refObjChar.ReqLevel1 != 0
					and inventory.Slot between 0
					and 12
			) Puan,
			C.Name GuildName
		FROM
			SRO_VT_SHARD.._Char refChar
			LEFT OUTER JOIN SRO_VT_SHARD.._Guild C ON C.ID = refChar.GuildID
		WHERE
			refChar.CharName16 NOT LIKE '%GM%'
		GROUP BY
			refChar.CharName16,
			C.Name,
			refChar.HwanLevel,
			refChar.CurLevel,
			refChar.CharID,
			refChar.RefObjID,
			refChar.RemainSkillPoint
		ORDER BY
			Puan DESC,
			refChar.CurLevel DESC
	");
	$rank1 = 1;

	foreach($playerrank as $row){
		$ranks1 = $rank1++;
		if($ranks1 == 1){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks1 == 2){ $sıra1 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks1 == 3){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra1 = ''.$ranks1.''; }
		if($row['Name'] == dummy){ $guild1 = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild1 = $row['Name']; }
		
		echo'
<tr>
                	 <td>'.$sıra1.'</td>
             
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName16'].'</a></td>
			<td><a href="guildinfo.php?q='.$row['GuildID'].'">'.$guild1.'</td>
			<td> '.$row['CurLevel'].'</td>
			<td> '.$row['Puan'].'</td>

		
   </tr>';
		 }
		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//unique rank
if($_POST['action'] == 'uniquerank') {
$dosyaAdi = "uniqrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['unique_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="10">Sıra</th>
            <td width="145">İsim</th>
            <td width="145">Guild</th>
            <td width="85">Puan</th>
            <td width="135">Toplam kesilen unique</th>
        </tr>';
		$uniquerank = $users->link->db_conn_pann->query("SELECT TOP 50

A.*, B.CharName16, C.ID as GuildID, C.Name as GuildName, B.HwanLevel, D.CodeName128
,(select SUM(MOB_EU_KERBEROS) + SUM(MOB_CH_TIGERWOMAN) + SUM(MOB_KK_ISYUTARU) 
+ SUM(MOB_TK_BONELORD) + SUM(MOB_AM_IVY) + SUM(MOB_JUPITER_THE_EARTH1) + 
SUM(MOB_RM_TAHOMET) + SUM(MOB_JUPITER_JUPITER) + SUM(MOB_OA_URUCHI) + SUM(MOB_JUPITER_YUNO) +
SUM(MOB_SD_ISIS) + SUM(MOB_JUPITER_DARK_DOG) + SUM(MOB_JUPITER_BABILION) + SUM(MOB_TQ_WHITESNAKE) +
SUM(MOB_JUPITER_BAAL) + SUM(MOB_SD_ANUBIS) + SUM(MOB_SD_HEOERIS) + SUM(MOB_SD_SETH) +
SUM(MOB_RM_ROC) + SUM(MOB_SD_SELKIS) + SUM(MOB_SD_NEITH) from Panel.dbo.UniqueRanking O WHERE O.CharID = A.CharID) as Toplam

FROM

UniqueRanking A

JOIN SRO_VT_SHARD.dbo._Char B ON B.CharID = A.CharID
JOIN SRO_VT_SHARD.dbo._Guild C ON C.ID = B.GuildID
JOIN SRO_VT_SHARD.dbo._RefObjCommon D ON D.ID = B.RefObjID

ORDER BY A.Point DESC");
	$rank2 = 1;

	foreach($uniquerank as $row){
		$ranks2 = $rank2++;
		if($ranks2 == 1){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks2 == 2){ $sıra2 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks2 == 3){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra2 = ''.$ranks2.''; }
		if($row['GuildName'] == dummy){ $guild = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild = $row['GuildName']; }
		echo'
<tr>
                	 <td>'.$sıra2.'</td>
             
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName16'].'</a></td>
			<td><a href="guildinfo.php?q='.$row['GuildID'].'">'.$guild.'</td>
			<td> '.$row['Point'].'</td>
			<td> '.$row['Toplam'].'</td>
			
		
   </tr>';
		 }
		 		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//thief rank
if($_POST['action'] == 'thiefrank') {
$dosyaAdi = "thiefrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['thief_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="10">Sıra</th>
            <td width="300">Job Adı</th>
            <td width="200">Job Level</th>
            <td width="200">Tür</th>
            <td width="200">Kazanılan Puan</th>
        </tr>';
		$thiefrank = $users->link->db_conn_shard->query("SELECT TOP 50 Y.NickName16,X.Level,X.Exp FROM _CharTrijob X,_Char Y WHERE X.CharID=Y.CharID AND X.JobType=2 ORDER BY X.Level DESC, X.Exp DESC");
	$rank3 = 1;

	foreach($thiefrank as $row){
		$ranks3 = $rank3++;
		if($ranks3 == 1){ $sıra3 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks3 == 2){ $sıra3 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks3 == 3){ $sıra3 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra3 = ''.$ranks3.''; }
		echo'
<tr>
                	 <td>'.$sıra3.'</td>
             
			<td>*'.$row['NickName16'].'</td>
			<td>'.$row['Level'].'</td>
			<td><img src="/media/images/thief.jpg"> Thief</td>
			<td> '.$row['Exp'].'</td>
			
		
   </tr>';
		 }
		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//trader rank
if($_POST['action'] == 'traderrank') {
$dosyaAdi = "traderrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['trader_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="10">Sıra</th>
            <td width="300">Job Adı</th>
            <td width="200">Job Level</th>
            <td width="200">Tür</th>
            <td width="200">Kazanılan Puan</th>
        </tr>';
		$traderrank = $users->link->db_conn_shard->query("SELECT TOP 50 Y.NickName16,X.Level,X.Exp FROM _CharTrijob X,_Char Y WHERE X.CharID=Y.CharID AND X.JobType=1 ORDER BY X.Level DESC, X.Exp DESC");
	$rank3 = 1;

	foreach($traderrank as $row){
		$ranks3 = $rank3++;
		if($ranks3 == 1){ $sıra3 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks3 == 2){ $sıra3 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks3 == 3){ $sıra3 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra3 = ''.$ranks3.''; }
		echo'
<tr>
                	 <td>'.$sıra3.'</td>
             
			<td>*'.$row['NickName16'].'</td>
			<td>'.$row['Level'].'</td>
			<td><img src="/media/images/trader.jpg"> Trader</td>
			<td> '.$row['Exp'].'</td>
			
		
   </tr>';
		 }
		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//hunter rank
if($_POST['action'] == 'hunterrank') {
$dosyaAdi = "hunterrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['hunter_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="10">Sıra</th>
            <td width="300">Job Adı</th>
            <td width="200">Job Level</th>
            <td width="200">Tür</th>
            <td width="200">Kazanılan Puan</th>
        </tr>';
		$hunterrank = $users->link->db_conn_shard->query("SELECT TOP 50 Y.NickName16,X.Level,X.Exp FROM _CharTrijob X,_Char Y WHERE X.CharID=Y.CharID AND X.JobType=3 ORDER BY X.Level DESC, X.Exp DESC");
	$rank3 = 1;

	foreach($hunterrank as $row){
		$ranks3 = $rank3++;
		if($ranks3 == 1){ $sıra3 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks3 == 2){ $sıra3 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks3 == 3){ $sıra3 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra3 = ''.$ranks3.''; }
		echo'
<tr>
                	 <td>'.$sıra3.'</td>
             
			<td>*'.$row['NickName16'].'</td>
			<td>'.$row['Level'].'</td>
			<td><img src="/media/images/hunter.jpg"> Hunter</td>
			<td> '.$row['Exp'].'</td>
			
		
   </tr>';
		 }
		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//Pvp rank
if($_POST['action'] == 'pvprank') {
	$dosyaAdi = "pvprank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['pvp_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="10">Sıra</th>
            <td width="240">İsim</th>
            <td width="170">Guild</th>
            <td width="110">Öldürülen</th>
            <td width="104">Ölme</th>
            <td width="104">Puan</th>
        </tr>';
		$pvprank = $users->link->db_conn_pann->query("SELECT TOP 30 A.CharID, A.CharName16 AS CharName, A.RemainSkillPoint, A.HwanLevel, B.CodeName128, C.ID AS GuildID,C.Name AS GuildName, D.[Kill], D.Dead, D.Point
	FROM PvpKills D
	JOIN SRO_VT_SHARD.dbo._Char A ON D.CharID = A.CharID
	JOIN SRO_VT_SHARD.dbo._RefObjCommon B ON A.RefObjID = B.ID
	JOIN SRO_VT_SHARD.dbo._Guild C ON C.ID = A.GuildID
	ORDER BY D.Point DESC");
	$rank2 = 1;

	foreach($pvprank as $row){
		$ranks2 = $rank2++;
		if($ranks2 == 1){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks2 == 2){ $sıra2 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks2 == 3){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra2 = ''.$ranks2.''; }
		if($row['GuildName'] == dummy){ $guild = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild = $row['GuildName']; }
		echo'
<tr>
                	 <td>'.$sıra2.'</td>
             
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName'].'</a></td>
			<td><a href="guildinfo.php?q='.$row['GuildID'].'">'.$guild.'</td>
			<td> '.$row['Kill'].'</td>
			<td> '.$row['Dead'].'</td>
			<td> '.$row['Point'].'</td>
			
		
   </tr>';
		 }
		 		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//Anlık PVP
if($_POST['action'] == 'extpvp') {
echo'   <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
	   
            <td width="700">Veriler Anlık Güncellenir</th>
        </tr>';
	$extpvp = $users->link->db_conn_pann->query("SELECT TOP 20
	
	B.CharID AS DeadManID, B.CharName16 AS DeadMan , C.CharID AS KillerID, C.CharName16 AS KillerName , A.[Time], B.HwanLevel AS HwanLevelDeadman, C.HwanLevel AS HwanLevelKiller,
	D.CodeName128 AS CodeNameDeadMan, E.CodeName128 AS CodeNameKiller, F.Name AS GuildNameDeadMan,
	G.Name AS GuildNameKiller
	
	FROM 
	
	PvpKillHistory A
	JOIN SRO_VT_SHARD.dbo._Char B ON B.CharID = A.DeadMan
	JOIN SRO_VT_SHARD.dbo._Char C ON C.CharID = A.Killer
	JOIN SRO_VT_SHARD.dbo._RefObjCommon D ON D.ID = B.RefObjID
	JOIN SRO_VT_SHARD.dbo._RefObjCommon E ON E.ID = C.RefObjID
	JOIN SRO_VT_SHARD.dbo._Guild F ON F.ID = B.GuildID
	JOIN SRO_VT_SHARD.dbo._Guild G ON G.ID = C.GuildID
	
	ORDER BY [Time] DESC");
	$rank = 1;

	foreach($extpvp as $row){
		$ranks = $rank++;
		if($ranks == 1){ $sıra = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks == 2){ $sıra = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks == 3){ $sıra = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra = ''.$ranks.''; }
		$detay = $row['Time'];
		$datey = date('H:i:s', strtotime($detay));
	echo'
<tr>

                    <td class="text-left">
                        <span class="text-danger">'.$datey.'</span> »
                        <a href="charinfo.php?q='.$row['DeadManID'].'">
                            <b class="text-danger">'.$row['DeadMan'].'</b>
                        </a>
                        ,
                        <a href="charinfo.php?q='.$row['KillerID'].'">
                            <b class="text-success">'.$row['KillerName'].'</b>
                        </a>
                        tarafından öldürüldü.
                    </td>
                </tr>';
		 }
}
//Anlık extunique
if($_POST['action'] == 'extunique') {
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="700">Veriler Anlık Güncellenir</th>
        </tr>';
	$extunique = $users->link->db_conn_logger->query("SELECT TOP(50)

	B.CharID, A.CharName, A.UniqueID, A.[Date], A.Type, B.HwanLevel, C.CodeName128, D.MobName

	FROM 

	PureLogger.dbo._UniqueLogger A
	
	JOIN _MobName D ON D.MobID = A.UniqueID
	LEFT JOIN SRO_VT_SHARD.dbo._Char B ON B.CharName16 = A.CharName Collate Turkish_CI_AS
	LEFT JOIN SRO_VT_SHARD.dbo._RefObjCommon C ON C.ID = B.RefObjID
	
	ORDER BY A.[Date] DESC");
	$rank = 1;

	foreach($extunique as $row){
		$ranks = $rank++;
		$deta = $row['Date'];
		$date = date('H:i:s', strtotime($deta));
		if($ranks == 1){ $sıra = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks == 2){ $sıra = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks == 3){ $sıra = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra = ''.$ranks.''; }
		if($row['Type'] == 1){ $durum = 'Doğdu'; }else{ $durum = 'Tarafından Kesildi'; }
		if($row['Type'] == 1){ $durum2 = ' <span class="text-primary">'.$date.'</span>'; }else{ $durum2 = '<span class="text-danger">'.$date.'</span>'; }
	echo'
                                                                <tr>
                        <td class="text-left">
                            '.$durum2.'»
                            <span class="text-primary">'.$row['MobName'].'</span> ,
                                                            <a href="charinfo.php?q='.$row['CharID'].'">
                                    <b class="text-success">
                                       '.$row['CharName'].'                                   </b>
                                </a> '.$durum.'
                                                    </td>
 
   </tr>';
		 }
}
//honor rank
if($_POST['action'] == 'honorrank') {
	$dosyaAdi = "honorrank50.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['honor_rank'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();	
echo'    <div id="ranking-result" class="ranking-tables"><table>
       <tbody><tr class="first">
        
            <td width="10">Sıra</th>
            <td width="200">İsim</th>
            <td width="153">Guild</th>
            <td width="80">Mezun sayısı</th>
            <td width="120">Mezun puanı</th>
        </tr>';
		$honorrank = $users->link->db_conn_shard->query("SELECT TOP 50	C.CharId, C.CharName16 as CharName, C.HwanLevel, D.CodeName128, E.ID as GuildID, E.Name as GuildName, F.GraduateCount, B.HonorPoint, F.EvaluationPoint
	FROM SRO_VT_SHARD.dbo._TrainingCampHonorRank AS A 
	JOIN SRO_VT_SHARD.dbo._TrainingCampMember AS B ON A.CampID = B.CampID
	JOIN SRO_VT_SHARD.dbo._Char AS C ON B.CharID = C.CharID
	JOIN SRO_VT_SHARD.dbo._RefObjCommon AS D ON B.RefObjID = D.ID
	JOIN SRO_VT_SHARD.dbo._Guild AS E ON E.ID = C.GuildID
	JOIN SRO_VT_SHARD.dbo._TrainingCamp AS F ON B.CampID = F.ID
	WHERE B.MemberClass = 0
	ORDER BY F.EvaluationPoint desc, F.GraduateCount desc");
	$rank1 = 1;

	foreach($honorrank as $row){
		$ranks1 = $rank1++;
		if($ranks1 == 1){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks1 == 2){ $sıra1 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks1 == 3){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra1 = ''.$ranks1.''; }
		if($row['GuildName'] == dummy){ $guild1 = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild1 = $row['GuildName']; }
		
		echo'
<tr>
                	 <td>'.$sıra1.'</td>
             
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName'].'</a></div></td>
			<td><a href="guildinfo.php?q='.$row['GuildID'].'">'.$guild1.'</div></td>
			<td> '.$row['GraduateCount'].'</div></td>
			<td> '.$row['HonorPoint'].'</div></td>
		
   </tr>';
   		 		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
		 }
}
//player-mini rank
if($_POST['action'] == 'player-mini') {
$dosyaAdi = "playerrank10.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['downloads'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'   <table>
        <tr>
        <td>Sıra</td>
        <td>Oyuncu Adı</td>
        <td>Item Puanı</td>
    </tr>';
		$playerrank = $users->link->db_conn_shard->query("
select
			TOP(10) refChar.CharID,
			refChar.CharName16,
			refChar.RemainSkillPoint,
			refChar.RefObjID,
			refChar.CurLevel,
			refChar.HwanLevel,
			C.Name,
			(
				select
					SUM(
						refObjItem.ItemClass + (
							(
								case
									when binding.nOptValue is null then 1
									else binding.nOptValue + 1
								end
							) + (
								case
									when binding.nOptLvl is null then 1
									else binding.nOptLvl + 1
								end
							)
						) * (item.OptLevel + 1) + refObjChar.Rarity + refObjItem.SetID + item.MagParamNum
					)
				FROM
					SRO_VT_SHARD.._Inventory inventory
					INNER JOIN SRO_VT_SHARD.._Items item ON inventory.ItemID = item.ID64
					LEFT OUTER JOIN SRO_VT_SHARD.._BindingOptionWithItem binding ON item.ID64 = binding.nItemDBID
					INNER JOIN SRO_VT_SHARD.._RefObjCommon refObjChar ON refObjChar.ID = item.RefItemID
					INNER JOIN SRO_VT_SHARD.._RefObjItem refObjItem ON refObjChar.Link = refObjItem.ID
				where
					inventory.CharID = refChar.CharID
					and item.RefItemID != 0
					and inventory.ItemID != 0
					and refObjChar.ReqLevel1 != 0
					and inventory.Slot between 0
					and 12
			) Puan,
			C.Name GuildName
		FROM
			SRO_VT_SHARD.._Char refChar
			LEFT OUTER JOIN SRO_VT_SHARD.._Guild C ON C.ID = refChar.GuildID
		WHERE
			refChar.CharName16 NOT LIKE '%GM%'
		GROUP BY
			refChar.CharName16,
			C.Name,
			refChar.HwanLevel,
			refChar.CurLevel,
			refChar.CharID,
			refChar.RefObjID,
			refChar.RemainSkillPoint
		ORDER BY
			Puan DESC,
			refChar.CurLevel DESC
	");
	$rank1 = 1;

	foreach($playerrank as $row){
		$ranks1 = $rank1++;
		if($ranks1 == 1){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks1 == 2){ $sıra1 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks1 == 3){ $sıra1 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra1 = ''.$ranks1.''; }
		if($row['Name'] == dummy){ $guild1 = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild1 = $row['Name']; }
		
		echo'
				<tr>
                	<td>'.$sıra1.'</td>             
					<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName16'].'</a></td>
					<td>'.$row['Puan'].'</td>		
				</tr>';
		 }
		echo '</tbody></table>';
		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//guild-mini rank
if($_POST['action'] == 'guild-mini') {

$dosyaAdi = "guildrank10.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['downloads'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'   <table>
        <tr>
        <td>Sıra</td>
        <td>Guild Adı</td>
        <td>Item Puanı</td>
    </tr>';
		$guildrank = $users->link->db_conn_shard->query("select TOP 10 B.ID,B.Name,B.Lvl, B.GatheredSP, A.CharID, A.CharName, Panel.dbo._GetGuildItemPoints(B.ID) AS Puan, 
			(SELECT COUNT(*) FROM SRO_VT_SHARD.dbo._GuildMember O WHERE O.GuildID = B.ID) AS TotalMember
			
			from SRO_VT_SHARD.._GuildMember A
			CROSS JOIN SRO_VT_SHARD.._Guild B
			where A.MemberClass = 0 and A.GuildID = B.ID
			ORDER BY Puan DESC,B.GatheredSP desc");
	$rank = 1;

	foreach($guildrank as $row){
		$ranks = $rank++;
		if($ranks == 1){ $sıra = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks == 2){ $sıra = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks == 3){ $sıra = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra = ''.$ranks.''; }
		
		echo'
<tr>
                	 <td>'.$sıra.'</td>
             
			<td><a href="guildinfo.php?q='.$row['ID'].'">'.$row['Name'].'</td>

			<td> '.$row['Puan'].'</td>
		
				
   </tr>';
		 }
		 echo '</tbody></table>';
		
		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//uniq-mini rank
if($_POST['action'] == 'unique-mini') {
$dosyaAdi = "uniqmini10.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['downloads'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <table>
        <tr>
        <td>Sıra</td>
        <td>Oyuncu Adı</td>
        <td>Item Puanı</td>
    </tr>';
		$uniquerank = $users->link->db_conn_pann->query("SELECT TOP 10

A.*, B.CharName16, C.ID as GuildID, C.Name as GuildName, B.HwanLevel, D.CodeName128


FROM

UniqueRanking A

JOIN SRO_VT_SHARD.dbo._Char B ON B.CharID = A.CharID
JOIN SRO_VT_SHARD.dbo._Guild C ON C.ID = B.GuildID
JOIN SRO_VT_SHARD.dbo._RefObjCommon D ON D.ID = B.RefObjID

ORDER BY A.Point DESC");
	$rank2 = 1;

	foreach($uniquerank as $row){
		$ranks2 = $rank2++;
		if($ranks2 == 1){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks2 == 2){ $sıra2 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks2 == 3){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra2 = ''.$ranks2.''; }
		if($row['GuildName'] == dummy){ $guild = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild = $row['GuildName']; }
		echo'
<tr>
                	 <td>'.$sıra2.'</td>
             
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName16'].'</a></td>

			<td> '.$row['Point'].'</td>

   </tr>';
		 }
		  echo '</tbody></table>';

		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
//uniq-mini rank
if($_POST['action'] == 'pvp-mini') {

$dosyaAdi = "pvpmini10.txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['downloads'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
echo'    <table>
        <tr>
        <td>Sıra</td>
        <td>Oyuncu Adı</td>
        <td>Item Puanı</td>
    </tr>';
		$pvprank = $users->link->db_conn_pann->query("SELECT TOP 10 A.CharID, A.CharName16 AS CharName, A.RemainSkillPoint, A.HwanLevel, B.CodeName128, C.ID AS GuildID,C.Name AS GuildName, D.[Kill], D.Dead, D.Point
	FROM PvpKills D
	JOIN SRO_VT_SHARD.dbo._Char A ON D.CharID = A.CharID
	JOIN SRO_VT_SHARD.dbo._RefObjCommon B ON A.RefObjID = B.ID
	JOIN SRO_VT_SHARD.dbo._Guild C ON C.ID = A.GuildID
	ORDER BY D.Point DESC");
	$rank2 = 1;

	foreach($pvprank as $row){
		$ranks2 = $rank2++;
		if($ranks2 == 1){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyFirst"></i>'; }else if($ranks2 == 2){ $sıra2 = '<i class="fa fa-trophy fa-fw trophySecond"></i>'; }else if($ranks2 == 3){ $sıra2 = '<i class="fa fa-trophy fa-fw trophyThird"></i>'; }else{ $sıra2 = ''.$ranks2.''; }
		if($row['GuildName'] == dummy){ $guild = '<a id="dumb-button"  onclick="return false;"><font color="darkgray">&lt;Guildsiz&gt;</font></a>'; }else{ $guild = $row['GuildName']; }
		echo'
<tr>
                	 <td>'.$sıra2.'</td>
             
			<td><a href="charinfo.php?q='.$row['CharID'].'">'.$row['CharName'].'</a></td>

			<td> '.$row['Point'].'</td>
			
		
   </tr>';
		 }
		 echo '</tbody></table>';

		 		 			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}
}
}
}

?>