<?php include ("fonksiyonlar/header.tpl"); ?>	
<?php include("fonksiyonlar/sol.tpl"); ?>
<?php $id = (int)htmlspecialchars($_GET['q']);

	include('fonksiyonlar/item_stats.class.php');
	#Resim İmage Başlangıc
			function filtering ($string) {
				
				$find[] = ".ddj"; $replace[] = ".PNG";
				$find[] = "\\"; $replace[] = "/";
				return str_replace($find, $replace, $string);
			}#END
			

			
?>
<?php 

$dosyaAdi = "char".$id.".txt";
$cache = "cache/".$dosyaAdi;
$sure = $rowayar[0]['charinfo'];

	if (time() - $sure < filemtime($cache)){
		readfile($cache);
	}else {
		
		unlink($cache);
		ob_start();
  ?>
<?php
						
						$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬-]/';
		$detay = $users->link->db_conn_shard->query("SELECT * FROM _Char WHERE CharID = '$id'");
					$row = $detay->fetchAll(); $charid = $row[0]["CharID"];
		$sett = $users->link->db_conn_shard->query("select (select SUM(MOB_EU_KERBEROS) + SUM(MOB_CH_TIGERWOMAN) + SUM(MOB_KK_ISYUTARU) 
+ SUM(MOB_TK_BONELORD) + SUM(MOB_AM_IVY) + SUM(MOB_JUPITER_THE_EARTH1) + 
SUM(MOB_RM_TAHOMET) + SUM(MOB_JUPITER_JUPITER) + SUM(MOB_OA_URUCHI) + SUM(MOB_JUPITER_YUNO) +
SUM(MOB_SD_ISIS) + SUM(MOB_JUPITER_DARK_DOG) + SUM(MOB_JUPITER_BABILION) + SUM(MOB_TQ_WHITESNAKE) +
SUM(MOB_JUPITER_BAAL) + SUM(MOB_SD_ANUBIS) + SUM(MOB_SD_HEOERIS) + SUM(MOB_SD_SETH) +
SUM(MOB_RM_ROC) + SUM(MOB_SD_SELKIS) + SUM(MOB_SD_NEITH)  from Panel.dbo.UniqueRanking O WHERE O.CharID = '$charid') as toplam,(			(
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
					inventory.CharID = '$charid'
					and item.RefItemID != 0
					and inventory.ItemID != 0
					and refObjChar.ReqLevel1 != 0
					and inventory.Slot between 0
					and 12
			) ) as puan,detay,job,gold,(select detaygm from panel..gm_settings) as detaygm,(select jobgm from panel..gm_settings) as gm2,(select goldgm from panel..gm_settings) as gm3 from _Char inner join _User on _User.CharID=_Char.CharID inner join Panel..user_settings on user_settings.jid=_User.UserJID where _User.CharID='$id'");
		$settings = $sett->fetch(PDO::FETCH_ASSOC);	
					
				if(empty($id)){
					header('Location:index.php');
				}else if(sizeof($row) == 0){
					header('Location:index.php');
					}else{
						$guildid = $row[0]["GuildID"];
						$guild = $users->link->db_conn_shard->query("SELECT * from _Guild WHERE ID = '$guildid' ");
						$guildim = $guild ->fetchAll();
						$metin = $row[0]["CharName16"];
								?>
<div id="content">
<div class="haberBoxBg">
<div class="haberBox">
<h3><?= $dils['char1']; ?></h3>
<br>
<div class="charinfo">
<div class="lonca-profil-ad">
<div class="karakter-detay"><span class="karakter-adi"><?php echo $row[0]['CharName16'];?></span></div>
<div class="karakter-seviye">
<div class="seviye"><span><?php echo $row[0]['CurLevel'];?></span></div>
<span class="seviye-span">Level :</span></div>
<div class="clear"></div>
</div>
<div class="char-top-wrapper">
<div class="char-info pull-left">
<div class="char-img pull-left">
<img src="/media/images/char/<?php echo $row[0]['RefObjID'];?>.gif" alt />
</div>
<div class="char-info-list pull-right">
<ul class="list-unstyled">
<li>
<span class="text-bold">Karakter:</span>
<span class="text-danger"><?php echo $row[0]['CharName16'];?></span>
</li>
<li>
<span class="text-bold">Guild:</span>
<span class="text-danger"><a class="text-danger" href="guildinfo.php?q=<?php echo $guildim[0]["ID"]; ?>"><?php if($guildim[0]['Name'] == dummy){ echo '<a id="dumb-button" onclick="return false;"><span class="text-danger">yok</span></a>'; }else{ echo $guildim[0]['Name']; } ?></a></span>
</li>
<li>
<span class="text-bold">Level:</span>
<span class="text-danger"><?php echo $row[0]['CurLevel'];?></span>
</li>
<li>
<span class="text-bold">Strength:</span>
<span class="text-danger"><?php echo $row[0]['Strength'];?></span>
</li>
<li>
<span class="text-bold">Intellect:</span>
<span class="text-danger"><?php echo $row[0]['Intellect'];?></span>
</li>
<li>
<span class="text-bold">Gold:</span>
<span class="text-danger"><?php if($settings["gm3"] == 1){ if($settings["gold"] == 1){ echo wordwrap($row[0]["RemainGold"], 3, '.', TRUE); }else{ echo'K. tarafından kısıtlandı'; } }else{ echo'Y. tarafından kısıtlandı'; } ?></span>
</li>
<li>
<span class="text-bold">Inventory Size:</span>
<span class="text-danger"><?php echo $row[0]["InventorySize"]; ?></span>
</li>
<?php 
	$charid = $row[0]["CharID"];																										 
	$rank = $users->link->db_conn_shard->query("select * from _CharTriJob where CharID = '$charid'");
	$row1 = $rank ->fetchAll();
	?>	
<li>
<span class="text-bold">Job:</span>
<span class="text-danger"><?php if($row1[0]['JobType'] == 1){ echo '<img src="/media/images/trader.jpg" style="margin: 0 3px -2px 0;" alt=""/>'; }else if($row1[0]['JobType'] == 2){ echo '<img src="/media/images/thief.jpg" style="margin: 0 3px -2px 0;" alt=""/>'; }else if($row1[0]['JobType'] == 3){ echo '<img src="/media/images/hunter.jpg" style="margin: 0 3px -2px 0;" alt=""/>'; }else{ echo ' Yok'; } ?></span>
</li>
<?php if(empty($row[0]["NickName16"])){ ?>
			<?php }else{ ?>	
<li>
<span class="text-bold">Job Nick:</span>
<span class="text-danger"><?php if($settings["gm2"] == 1){ if($settings["job"] == 1){ echo $row[0]["NickName16"]; 	}else{	echo'K. tarafından kısıtlandı'; }	}else{	echo'Y. tarafından kısıtlandı'; }?></span>
</li>
<li>
<span class="text-bold">Job Level:</span>
<span class="text-danger"><?php echo $row1[0]["Level"]; ?></span>
</li><?php } ?>
<?php if(empty($settings["Point"])){ ?>
	<?php }else{ ?>
<li>
<span class="text-bold">Unique Point:</span>
<span class="text-danger"><?php echo $settings["Point"]; ?></span>
</li><?php } ?>
<li>
<span class="text-bold">Item Point:</span>
<span class="text-danger"><?php echo $settings["puan"]; ?></span>
</li>
</ul>
</div>
<div class="clearfix"></div>
</div>
<div id="idInventorySet" class="bg-equipment pull-right">
<?php 
		$item = $users->link->db_conn_shard->query("select (case Slot
			WHEN 6 THEN 1
			WHEN 7 THEN 2
			WHEN 0 THEN 3
			WHEN 2 THEN 4
			WHEN 1 THEN 5
			WHEN 3 THEN 6
			WHEN 4 THEN 7
			WHEN 5 THEN 8
			WHEN 10 THEN 9
			WHEN 9 THEN 10
			WHEN 12 THEN 11
			WHEN 11 THEN 12
		ELSE 100 END ) as Slot, CH.CharName16, INV.CharID, INV.ItemID,  IT.OptLevel,REFC.Link,IT.MagParamNum,IT.Variance,IT.ID64, REFC.NameStrID128, IT.RefItemID,IT.Data,   REFC.ReqLevel1, REFC.AssocFileIcon128, REFC.CodeName128 From _Inventory As INV 
					Right Join _Items As IT On INV.ItemID = IT.ID64
					
					Right Join _RefObjCommon As REFC On REFC.ID = IT.RefItemID
					Right Join _Char As CH On CH.CharID = INV.CharID

					Where CH.CharName16 = '$metin' And INV.Slot in(0,1,2,3,4,5,6,7,9,10,11,12) and CodeName128 not like '%TRADE%'
					and CodeName128 not like '%thief%' and Slot not like '100'
					Order By Slot Asc");
	$rank = 1;

	foreach ($item as $row){ ;
		//Degerler Başlangıc
$ItemSID = $row['ItemID'];

$deger1111 = $row['CodeName128'];

	//Degerler Bitiş
//İnv Slot Class Başlangıc
	 if($row['Slot'] == 1){ $sıra = '6 left weapon'; 
	}else if($row['Slot'] == 2){ $sıra = '7 right shield'; 
	}else if($row['Slot'] == 3){ $sıra = '0 left head'; 
	}else if($row['Slot'] == 4){ $sıra = '2 right shoulder'; 
	}else if($row['Slot'] == 5){ $sıra = '1 left chest'; 
	}else if($row['Slot'] == 6){ $sıra = '3 right hands'; 
	}else if($row['Slot'] == 7){ $sıra = '4 left legs'; 
	}else if($row['Slot'] == 8){ $sıra = '5 right foot'; 
	}else if($row['Slot'] == 9){ $sıra = '9 left earring'; 
	}else if($row['Slot'] == 10){ $sıra = '10 right necklace'; 
	}else if($row['Slot'] == 11){ $sıra = '11 left lring'; 
	}else if($row['Slot'] == 12){ $sıra = '12 right rring';
	
	}else{ $sıra = ''; }
	//İnv Slot Class Bitiş
	//OptLevel Başlangıc
	 if($row['OptLevel'] == 0){ $deger141 = ''; 
	}else{ $deger141 = "(+".$deger141.") "; }
	//OptLevel Bitiş
	//İnv İmg Başlangıc
	if(file_exists("./media/images/equipment/".filtering($row['AssocFileIcon128']))) {
		$img = "./media/images/equipment/".filtering($row['AssocFileIcon128']);
	} else {
		$img = "./media/images/equipment/icon_default.PNG";
			}//İnv İmg Bitiş
			if(strstr($row['CodeName128'], "RARE")) { $rare = ' <span class="qinfo"></span> <span class="plus"></span>'; 
			} else {
			$rare = "";
			}
?>
<div class="slots <?php echo ''.$sıra.''; ?>">
<div class="itemslot">
<div class="image" <?php  if($deger1111 != "DUMMY_OBJECT"){ ?> style="background:url(<?php echo ''.$img.'' ; ?>) no-repeat; background-size: 34px 34px;" data-itemInfo="1"<?PHP }else{?>  <?php } ?>>
<?php echo ''.$rare.''; ?>
</div>
</div>
<?php  if($deger1111 != "DUMMY_OBJECT"){ ?>
<div class="itemInfo">
<img src="/media/images/equipment/com_itemsign.PNG" class="imageclear">
<?php include ('fonksiyonlar/iteminfo.php') ; ?>
</div>
<?PHP }else{?>
    
	 <?php } ?>
	  </div> 
 <?php } ?>

<button id="idShowAvatar" class="btn-equip-avatar"></button>
<?php include 'fonksiyonlar/iteminfoAvatar.php'; ?>
<div class="clear"></div>
<script type="text/javascript">
                                        jQuery('#idShowAvatar').click(function () {
                                            jQuery('#idInventorySet').addClass('hidden');
                                            jQuery('#idInventoryAvatar').removeClass('hidden');
                                        });
                                        jQuery('#idShowSet').click(function () {
                                            jQuery('#idInventoryAvatar').addClass('hidden');
                                            jQuery('#idInventorySet').removeClass('hidden');
                                        });

                                        function itemInfo() {
                                            jQuery(document).tooltip({
                                                items: "[data-itemInfo], [title]",
                                                position: {my: "left+5 center", at: "right center"},
                                                content: function () {
                                                    var element = jQuery(this);
                                                    if (jQuery(this).prop("tagName").toUpperCase() == 'IFRAME') {
                                                        return;
                                                    }
                                                    if (element.is("[data-itemInfo]")) {
                                                        if (element.parent().parent().find('.itemInfo').html() == '') {
                                                            return;
                                                        }
                                                        return element.parent().parent().find('.itemInfo').html();
                                                    }
                                                    if (element.is("[title]")) {
                                                        return element.attr("title");
                                                    }
                                                }
                                            });
                                        }

                                        jQuery(document).ready(function () {
                                            itemInfo();
                                        });
                                    </script>
</div>
<div class="char-info-menu">
<ul>
<li><a href="#char-unique"><?= $dils['char2']; ?></a></li>
<li><a href="#char-last-unique"><?= $dils['char3']; ?></a></li>
<li><a href="#char-global"><?= $dils['char4']; ?></a></li>
</ul>
</div>
<br>
<div id="char-unique" class="char-unique-result">
<table>
<tr>
<td>
<?= $dils['char5']; ?>
</td>
<td><?php echo $settings["toplam"]; ?></td>
</tr>
</table>
<table>
<tr>
<td>
Kesilen Uniqueler
</td>
</tr>
<table>
 <?php 
	$playerrank = $users->link->db_conn_logger->query("SELECT TOP(10)

	B.CharID, A.CharName, A.UniqueID, A.[Date], A.Type, B.HwanLevel, C.CodeName128, D.MobName

	FROM 

	PureLogger.dbo._UniqueLogger A
	
	JOIN _MobName D ON D.MobID = A.UniqueID
	LEFT JOIN SRO_VT_SHARD.dbo._Char B ON B.CharName16 = A.CharName Collate Turkish_CI_AS
	LEFT JOIN SRO_VT_SHARD.dbo._RefObjCommon C ON C.ID = B.RefObjID
	where CharName = '$metin'
	ORDER BY A.[Date] DESC");
	foreach($playerrank as $row){
				$detay = $row['Date'];
		$datey = date('d.m.Y  H:i:s', strtotime($detay));
	?>
	
<tr>
                        <td class="text-left">
                            <span class="text-danger"><?php echo $datey;?></span> »
                            <span class="text-primary"><?php echo $row['MobName'];?></span> ,
               		
               <b class="text-success">
                                       <?php echo $row['CharName']; ?>                                   </b>
									   Tarafından Kesildi
                                                    </td>
            
            </tr>
			
			<?php } ?>  
</table>
</div>
<div id="char-last-unique" class="char-last-unique-result hidden">
<table>
<?php 
	$playerrank = $users->link->db_conn_logger->query("SELECT TOP(10)

	B.CharID, A.CharName, A.UniqueID, A.[Date], A.Type, B.HwanLevel, C.CodeName128, D.MobName

	FROM 

	PureLogger.dbo._UniqueLogger A
	
	JOIN _MobName D ON D.MobID = A.UniqueID
	LEFT JOIN SRO_VT_SHARD.dbo._Char B ON B.CharName16 = A.CharName Collate Turkish_CI_AS
	LEFT JOIN SRO_VT_SHARD.dbo._RefObjCommon C ON C.ID = B.RefObjID
	where CharName = '$metin'
	ORDER BY A.[Date] DESC");
	foreach($playerrank as $row){
				$detay = $row['Date'];
		$datey = date('d.m.Y  H:i:s', strtotime($detay));
	?>
	
<tr class="first">
                        <td class="text-left">
                            <span class="text-danger"><?php echo $datey;?></span> »
                            <span class="text-primary"><?php echo $row['MobName'];?></span> ,
               		
               <b class="text-success">
                                       <?php echo $row['CharName']; ?>                                   </b>
									   Tarafından Kesildi
                                                    </td>
            
            </tr>
			
			<?php } ?>  
</table>
</div>
<div id="char-global" class="char-global-result hidden">
<table>
<?php 
												$player = $users->link->db_conn_logger->query("select top 10 * from _LogGlobal where CharName = '$metin' order by Date desc");
												$rank = 1;

											foreach($player as $row){ 						$detay = $row['Date'];
		$datey = date('d.m.Y  H:i:s', strtotime($detay)); ?>

<tr>
			 <td class="text-left">
             <span class="text-danger"><?php echo $datey; ?></span> »
               		
            <span style="color: #d9c34e;"><?php echo $row['Msg'];?></span>
             </td>
            </tr>
											

	<?php } ?> 
</table>
</div>
<script type="text/javascript">
                                    $('.char-info-menu').find('ul > li > a').click(function (e) {
                                        e.preventDefault();
                                        var link = $(this);
                                        $('.char-info-menu').find('ul > li > a').removeClass('active');
                                        link.addClass('active');
                                        $('#char-unique, #char-last-unique, #char-global').addClass('hidden');
                                        $(link.attr('href')).removeClass('hidden');
                                    })
                                </script>
</div>
</div>
</div>
</div>
</div>
<div class="clear"></div>
</div>
<?php } ?>   

                     <?php 
			$ac = fopen($cache, "w+");
			fwrite($ac, ob_get_contents());
			fclose($ac);
		
		ob_end_flush();
		
		
	}

?>	
<?php include('fonksiyonlar/footer.php'); ?>