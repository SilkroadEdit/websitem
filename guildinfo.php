<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<?php $id = (int)htmlspecialchars($_GET['q']); ?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?= $dils['guild1']; ?></h3>
<br>
<?php 
$dosyaAdi = "guild".$id.".txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['guildinfo'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
  ?>
  <?php
									
						$detay = $users->link->db_conn_shard->query("SELECT a.ID,(SELECT sum(remaingold)FROM _GuildMember AS Musteri 
INNER JOIN _Char AS SatisSiparisBaslik
ON Musteri.CharID = SatisSiparisBaslik.CharID
where Musteri.GuildID = $id) as toplamgold,a.Name,a.Lvl,a.GatheredSP,a.FoundationDate,a.Alliance,a.Gold,b.CharID,b.CharName,b.RefObjID,b.MemberClass,(Panel.dbo._GetGuildItemPoints(a.ID)) AS Puan from _Guild a, _GuildMember b WHERE b.MemberClass=0 and b.GuildID=a.ID and a.ID = '$id'");
						$row = $detay->fetchAll();
						$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬-]/';
			
				if(empty($id)){
					header('Location:index.php');
				}else if(sizeof($row) == 0){
					header('Location:index.php');
				}else{
						$union = $row[0]['Alliance'];
						$guild_id = $row[0]['ID'];
						$guild_member= $users->link->db_conn_shard->query("SELECT  Count(*) as toplam, avg(CharLevel) as avarage FROM _GuildMember WHERE GuildID = '$guild_id' ");
						$rowmember = $guild_member ->fetchAll();
						$metin = $row[0]['Name'];
			?>
<div class="guildinfo">
<div class="lonca-profil-ad">
<div class="karakter-detay"><span class="karakter-adi"><?php echo $row[0]['Name']; ?></span></div>
<div class="karakter-seviye">
<div class="seviye"><span><?= $row[0]['Lvl']; ?></span></div>
<span class="seviye-span">Level :</span></div>
<div class="clear"></div>
</div>
<div class="master-info-container text-center">
<div class="master-info">
<div class="master-image">
<img src="/media/images/char/<?php echo $row[0]['RefObjID']; ?>.gif" alt />
</div>
<div class="master-info-list">
<ul class="list-unstyled">
<li>
<span class="text-bold">Master Adı:</span>
<span><a class="text-danger" href="charinfo.php?q=<?php echo $row[0]['CharID']; ?>"><?php echo $row[0]['CharName']; ?></a></span>
</li>
<li>
<span class="text-bold">Guild:</span>
<span class="text-danger"><?php echo $row[0]['Name']; ?></span>
</li>
<li>
<span class="text-bold">Level:</span>
<span class="text-danger"><?= $row[0]['Lvl']; ?></span>
</li>
</ul>
</div>
</div>
</div>
<div class="guild-menu">
<ul>
<li><a href="#guild-info" class="active">Guild Bilgileri</a></li>
<li><a href="#guild-members">Guild Üyeleri</a></li>
</ul>
</div>
<br>
<div id="guild-info">
<table class="ranking-tables">
<tr>
<td width="30%">Guild Adı</td>
<td width="70%"><?php echo $row[0]['Name']; ?></td>
</tr>
<tr>
<td width="30%">Guild Leveli</td>
<td width="70%"><?= $row[0]['Lvl']; ?></td>
</tr>
<tr>
<td width="30%">Üye Sayısı</td>
<td width="70%"><?php echo $rowmember[0]['toplam']; ?></td>
</tr>
<tr>
<td width="30%">Üye Level Ortalaması</td>
<td width="70%"><?php echo $rowmember[0]['avarage']; ?></td>
</tr>
<tr>
<td width="30%">Guild GP</td>
<td width="70%"><?php echo $row[0]['GatheredSP']; ?></td>
</tr>
<tr>
<td width="30%">Toplam Item Puanı</td>
<td width="70%"><?php echo $row[0]['Puan']; ?></td>
</tr>
<tr>
<td width="30%">Kuruluş Tarihi</td>
<td width="70%"><?php echo $row[0]['FoundationDate']; ?></td>
</tr>
</table>
</div>
<div id="guild-members" class="hidden">
<table class="ranking-tables">
<tr>
<td>Sıra</td>
<td>İsmi</td>
<td>Yetkisi</td>
<td>Leveli</td>
<td>Item Puanı</td>
<td>Katılma Tarihi</td>
</tr>
<?php
										$metin = $row[0]['Name'];
										$aliance =  $users->link->db_conn_shard->query(" SELECT Name,Lvl FROM _Guild WHERE Alliance > 0 AND Alliance = '$union'  ");
						$birlik = $aliance->fetchAll();
						
											$guild_user = $users->link->db_conn_shard->query("SELECT c.CharName,(select sum(remaingold) from _Char where CharID = c.CharID) as goldmk,c.CharID,c.CharLevel,c.SiegeAuthority,c.JoinDate,c.GP_Donation,c.Nickname,c.MemberClass,((
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
					inventory.CharID = C.CharID
					and item.RefItemID != 0
					and inventory.ItemID != 0
					and refObjChar.ReqLevel1 != 0
					and inventory.Slot between 0
					and 12
			)) AS puan FROM _GuildMember as c WHERE GuildID = '$guild_id' ORDER BY MemberClass asc,CharLevel DESC");
											$oyuncu = $guild_user->fetchAll();
											$i = 0;
											$ii = 0;
						foreach ($oyuncu as $row){
							
							$rutbe = $row['SiegeAuthority'];
							if ($rutbe == 1){
								
								$rutbeyaz ="Commander at fortress war";								
							}else if($rutbe == 2){
								
								$rutbeyaz = "Deputy commander at fortress war";	
							}else if ($rutbe == 4){
								
								$rutbeyaz = "Fortress war administrator";
							}else if ($rutbe == 8){
								
								$rutbeyaz = "Production administrator";
							}else if($rutbe == 16){
								
								$rutbeyaz = "Training administrator";
							}else if($rutbe == 32){
								
								$rutbeyaz = "Military engineer";
							}else{
								
								$rutbeyaz = "";
							}											
										?>
<tr>
<td><?php echo ++$ii; ?></td>
<td>
<a href="charinfo.php?q=<?php echo $row['CharID']; ?>"><?php echo $row['CharName']; ?></a>
</td>
<td><?php if($row['MemberClass'] == 0){ echo '<font color="gold">Master</font>'; }else{ echo 'Üye'; } ?></td>
<td><?php echo $row['CharLevel']; ?></td>
<td><?php echo $row['puan']; ?></td>
<td><?php echo $row['JoinDate']; ?></td>
</tr>
<?php } ?>
</table>
</div>
<script type="text/javascript">
                                    $('.guild-menu').find('ul > li > a').click(function (e) {
                                        e.preventDefault();
                                        var link = $(this);
                                        $('.guild-menu').find('ul > li > a').removeClass('active');
                                        link.addClass('active');
                                        $('#guild-info, #guild-members').addClass('hidden');
                                        $(link.attr('href')).removeClass('hidden');
                                    })
                                </script>
</div>
<?php } ?>


                     <?php 
			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}

?>	
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php include('fonksiyonlar/footer.php'); ?>