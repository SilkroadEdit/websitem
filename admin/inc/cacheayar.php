<?php echo !defined("ADMIN") ? die("Hacking?"): null; ?>
  <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Önbellek Ayarları</h3>
                <div class="box-tools">
    
                </div>
            </div>

			<script src="plugins/sweetalert/sweetalert.min.js"></script>
			<script>
	function itemver(){
		removeAlertBox('#itemformu');
		var deger = $("#itemformu").serialize();
			
		$.ajax({
			type : "POST",
			data : deger,
			url : "kontrol.php",
		
			success : function(pure){

				if($.trim(pure) == "bos"){
					
				appendAlertBox('#itemformu', 'error', 'Boş alanlar mevcut.');
				}else if($.trim(pure) == "itemok"){
					
					swal('Başarılı', 'cache ayarları başarıyla güncellendi.', 'success');
					 setTimeout("window.location = 'admin.php?do=cacheayar';", 2000);
				}else if($.trim(pure) == "hata"){
				appendAlertBox('#itemformu', 'error', 'Beklenmedik bir hata oluştu.');	



				}
			}

		});

	}
</script>
		<?php

		$query = $admin->link->db_conn_pann->query("SELECT * FROM onbellek_ayarları where id = 1");
		$result = $query->fetchAll();
		foreach($result as $row){
			?>
	
	
		<form id="itemformu" onsubmit="return false;" action="" method="post" class="form-horizontal">
		<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
               <div class="box-body">
                    <div class="form-group" id="group-news">
                        <label for="news" class="col-sm-3 control-label">İndirmeler</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="news" name="news"
                                   value="<?php echo $row['news']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-faqs">
                        <label for="faqs" class="col-sm-3 control-label">Kale Bilgi Ve Haberler</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="faqs" name="faqs"
                                   value="<?php echo $row['faqs']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-downloads">
                        <label for="downloads" class="col-sm-3 control-label">Mini Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="downloads" name="downloads"
                                   value="<?php echo $row['downloads']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-guild_rank">
                        <label for="guild_rank" class="col-sm-3 control-label">Guild Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="guild_rank" name="guild_rank"
                                   value="<?php echo $row['guild_rank']; ?>">
                        </div>
                    </div>

                    <div class="form-group" id="group-player_rank">
                        <label for="player_rank" class="col-sm-3 control-label">Player Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="player_rank" name="player_rank"
                                   value="<?php echo $row['player_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-honor_rank">
                        <label for="honor_rank" class="col-sm-3 control-label">Union Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="union_rank" name="union_rank"
                                   value="<?php echo $row['union_rank']; ?>">
                        </div>
                    </div>					
                    <div class="form-group" id="group-honor_rank">
                        <label for="honor_rank" class="col-sm-3 control-label">Honor Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="honor_rank" name="honor_rank"
                                   value="<?php echo $row['honor_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-thief_rank">
                        <label for="thief_rank" class="col-sm-3 control-label">Thief Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="thief_rank" name="thief_rank"
                                   value="<?php echo $row['thief_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-trader_rank">
                        <label for="trader_rank" class="col-sm-3 control-label">Trader Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="trader_rank" name="trader_rank"
                                   value="<?php echo $row['trader_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-hunter_rank">
                        <label for="hunter_rank" class="col-sm-3 control-label">Hunter Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="hunter_rank" name="hunter_rank"
                                   value="<?php echo $row['hunter_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-unique_rank">
                        <label for="unique_rank" class="col-sm-3 control-label">Unique Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="unique_rank" name="unique_rank"
                                   value="<?php echo $row['unique_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-pvp_rank">
                        <label for="pvp_rank" class="col-sm-3 control-label">PvP Rank</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="pvp_rank" name="pvp_rank"
                                   value="<?php echo $row['pvp_rank']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-charinfo">
                        <label for="charinfo" class="col-sm-3 control-label">Karakter Bilgileri</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="charinfo" name="charinfo"
                                   value="<?php echo $row['charinfo']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-guildinfo">
                        <label for="guildinfo" class="col-sm-3 control-label">Guild Bilgileri</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="guildinfo" name="guildinfo"
                                   value="<?php echo $row['guildinfo']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-guildinfo">
                        <label for="guildinfo" class="col-sm-3 control-label">Union Bilgileri</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="unioninfo" name="unioninfo"
                                   value="<?php echo $row['unioninfo']; ?>">
                        </div>
                    </div>         

<input type="hidden" name="cache_ayar">
				<footer>
				<div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php')">Vazgeç
                    </button>
     <button type="submit" onclick="itemver();" class="btn btn-info pull-right">Gönder</button>
               
                </div>
				
            </form>
</div></div></div>
        <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Bilgiler</h3>
            </div>
      <div class="box-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Cache sistemi verilerinizi önbelleğe alarak veritabanı ve site performansınıza katkı sağlamaktadır.
                    Kullanıcılar sitenize istekte bulunduğunda sistem veritabanınızdaki verileri önbelleğe alır ve daha
                    sonraki isteklerde tekrar veritabanınıza bağlanmak yerine verileri önbellekten alarak
                    kullanıcılarınıza sunar. Sol taraftan sizin belirlediğiniz verilerin önbellekte saklanma süresi
                    dolduğunda
                    yukardaki işlem tekrar gerçekleşir.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Sol tarafta önbelleğe almak istediğiniz kısımlar bulunmaktadır. Önbelleği aktif etmek için sağ
                    kısımlarına <b>saniye</b> olarak saklanma sürelerini yazmalısınız. Örneğin; Haberler'e 3600
                    yazarsanız haberleriniz 60 dakika önbellekte saklanır ve anlık olarak yenilenmez.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Önbelleği kapatmak için süreyi 0 olarak belirlemeniz yeterlidir.
                </div>
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Player Rank ve Guild Rank en az 3600 saniye yani 60 dakika, Karakter ve Guild Bilgileri ise en az 14400 saniye yani 240 dakika
                    belirlenmesi tavsiye edilmektedir. Diğer kısımları tercihinize bağlı olarak
                    belirleyebilirsiniz.
                </div>
            </div>

        </div>
</div>
	<?php include('footer.php'); ?>
		<?php } ?>
		