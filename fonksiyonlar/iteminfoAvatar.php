<div class="equip-suit-slot">
<div class="itemslot">
<div class="image">
</div>
</div>
<div class="itemInfo">
<span style="font-weight: bold;"><img src="/media/images/equipment/com_itemsign.PNG" class="imageclear"> </img></span></br></br> </div>
</div>
</div>
<div id="idInventoryAvatar" class="bg-equipment-avatar pull-right hidden">
<div class="avatar-margin">
<?php 
		$item = $users->link->db_conn_shard->query("select (case Slot
			WHEN 2 THEN 1
			WHEN 3 THEN 2
			WHEN 0 THEN 3
			WHEN 1 THEN 4
			WHEN 4 THEN 5


		ELSE 100 END ) as  Slot, CH.CharName16, INV.CharID, INV.ItemID,  IT.OptLevel,REFC.Link,IT.MagParamNum,IT.Variance,IT.ID64, REFC.NameStrID128, IT.RefItemID,IT.Data,   REFC.ReqLevel1, REFC.AssocFileIcon128, REFC.CodeName128 From _InventoryForAvatar As INV 
					Right Join _Items As IT On INV.ItemID = IT.ID64
					
					Right Join _RefObjCommon As REFC On REFC.ID = IT.RefItemID
					Right Join _Char As CH On CH.CharID = INV.CharID

					Where CH.CharName16 = '$metin' And INV.Slot in(0,1,2,3,4) and CodeName128 not like '%TRADE%'
					and CodeName128 not like '%thief%' and Slot not like '100'
					Order By Slot Asc");
	$rank = 1;

	foreach ($item as $row){ ;
		
$ItemSID = $row['ItemID'];

$deger1111 = $row['CodeName128'];

	//Degerler Bitiş
//İnv Slot Class Başlangıc
	 if($row['Slot'] == 1){ $sıra = 'slots 0 left hat'; 
	}else if($row['Slot'] == 2){ $sıra = 'slots 1 right flag'; 
	}else if($row['Slot'] == 3){ $sıra = 'slots 2 left dress'; 
	}else if($row['Slot'] == 4){ $sıra = 'slots 3 right attach'; 
	}else if($row['Slot'] == 5){ $sıra = 'slots 4 left spec'; 
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
<div class="image" <?php  if($deger1111 != "DUMMY_OBJECT"){ ?> style="background:url(<?php echo ''.$img.'' ; ?>) no-repeat; background-size: 34px 34px;" data-itemInfo="1" <?PHP }else{?>  <?php } ?>>
<?php echo ''.$rare.''; ?>
</div>
</div>
<?php  if($deger1111 != "DUMMY_OBJECT"){ ?>
<div class="itemInfo">
<span style="color:#00eaff;font-weight: bold;"><img src="/media/images/equipment/com_itemsign.PNG" class="imageclear">
<?php include 'avatarblue.php'; ?>
</div>
<?PHP }else{?>
    
	 <?php } ?>
</div>
<?php } ?>

<button id="idShowSet" class="btn-equip-set"></button>
<div class="equip-suit-slot">
<div class="itemslot">
<div class="image">
</div>
</div>
<div class="itemInfo">
<span style="font-weight: bold;"><img src="/media/images/equipment/com_itemsign.PNG" class="imageclear"> </img></span></br></br> </div>
</div>
</div>
</div>