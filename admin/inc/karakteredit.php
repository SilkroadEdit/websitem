<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>
			<?php
						$charid = (int)htmlspecialchars($_GET['charid']);
						$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬-]/';
			$detay = $admin->link->db_conn_shard->query("SELECT * FROM _Char WHERE CharID = '$charid'");
					$row = $detay->fetchAll();
				if(empty($charid)){
		?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL=admin.php"> <?php
		exit();
				}else if(sizeof($row) == 0){
		?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL=admin.php"> <?php
		exit();
					}else{

								?>	
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter Düzenle - <?php echo $row[0]['CharName16']; ?></h3>
            </div>
            <form class="form-horizontal" method="post" id="char-update">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
					<input type="hidden" name="charname" id="charname" value="<?php echo $row[0]['CharName16']; ?>">
                <div class="box-body">
                    <div class="form-group" id="group-level">
                        <label for="level" class="col-sm-3 control-label">Level</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="level" name="level"
                                   value="<?php echo $row[0]['CurLevel']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-str">
                        <label for="str" class="col-sm-3 control-label">Strength</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="str" name="str"
                                   value="<?php echo $row[0]['Strength']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-int">
                        <label for="int" class="col-sm-3 control-label">Intellect</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="int" name="int"
                                   value="<?php echo $row[0]['Intellect']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-gold">
                        <label for="gold" class="col-sm-3 control-label">Gold</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="gold" name="gold"
                                   value="<?php echo $row[0]['RemainGold']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-skill">
                        <label for="skill" class="col-sm-3 control-label">Skill Point</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="skill" name="skill"
                                   value="<?php echo $row[0]['RemainSkillPoint']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-stat">
                        <label for="stat" class="col-sm-3 control-label">Stat Point</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="stat" name="stat"
                                   value="<?php echo $row[0]['RemainStatPoint']; ?>">
                        </div>
                    </div>

                    <div class="form-group" id="group-hwan">
                        <label for="hwan" class="col-sm-3 control-label">Rütbe</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="hwan" name="hwan"
                                   value="<?php echo $row[0]['HwanLevel']; ?>">
                        </div>
                    </div>
					<input type="hidden" name="karakterdüzenle" id="karakterdüzenle" >
                </div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php?do=karakter')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
			<script type="text/javascript">
			    $('#char-update').submit(function () {
					
        var form = $(this);
                    form.find('button[type=submit]').attr("disabled", true);		
		removeAlertBox(form);
        $.post("kontrol.php", form.serialize())
            .done(function (data) {
                try {
                    var json_obj = $.parseJSON(data);
                    swal(json_obj.name,json_obj.text,json_obj.status);
                    if (json_obj.status == 'success') {
                        setTimeout("location.reload();", 1500);
                        return true;
                    }
                } catch (e) {
                    alert('Lütfen, özel karakter kullanmayın.', 'error');
                }
              
            })
            .fail(function () {
                alert('Üzgünüz, işleminiz gerçekleştirilemedi.', 'error');

            });
		form.find('button[type=submit]').attr("disabled", false);	
        return false;
    });
</script>
        </div>
    </div>
    <div class="col-md-6">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Karakter İşlemleri</h3>
            </div>
            <div class="box-body">
			<script>
	function skill_reset(){
		removeAlertBox('#skillsıfırla');
		var deger = $("#skillsıfırla").serialize();
                    swal({
                        title: "İşlem gerçekleştirilsin mi?",
                        text: "Evete tıkladığınız taktirde işlem geri alınamaz!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Evet",
                        closeOnConfirm: false,
                        cancelButtonText: "Hayır",
                        showLoaderOnConfirm: true,
                        html: false
                    }, function () {
		$.ajax({
			type : "POST",
			data : deger,
			url : "kontrol.php",
		
			success : function(pure){

				if($.trim(pure) == "skillok"){
					
					swal('Başarılı', 'Karakterin skilleri başarıyla sıfırlandı.', 'success');
					 setTimeout("location.reload();", 2000);
				}else if($.trim(pure) == "hata"){
				swal('Başarısız', 'Üzgünüm işlem gercekleştirilemedi.','error');



				}
			}
  });

		});

	}
</script>

			<form id="skillsıfırla" onsubmit="return false;">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
			
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
					<input type="hidden" name="charname" value="<?php echo $row[0]['CharName16']; ?>" >
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Karakterin Skillerini Sıfırla</p>
                        </div>
                        <a href="#" onclick="skill_reset();" class="small-box-footer">Devam Et <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                <input type="hidden" name="kskillsıfırla" >
				</div>
				</form>
							<script>
	function stat_reset(){
		removeAlertBox('#skillsıfırla');
		var deger = $("#statsıfırla").serialize();
                    swal({
                        title: "İşlem gerçekleştirilsin mi?",
                        text: "Evete tıkladığınız taktirde işlem geri alınamaz!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Evet",
                        closeOnConfirm: false,
                        cancelButtonText: "Hayır",
                        showLoaderOnConfirm: true,
                        html: false
                    }, function () {
		$.ajax({
			type : "POST",
			data : deger,
			url : "kontrol.php",
		
			success : function(pure){

				if($.trim(pure) == "skillok"){
					
					swal('Başarılı', 'Karakterin statları başarıyla sıfırlandı.', 'success');
					 setTimeout("location.reload();", 2000);
				}else if($.trim(pure) == "hata"){
				swal('Başarısız', 'Üzgünüm işlem gercekleştirilemedi.','error');	



				}
			}
  });

		});

	}
</script>
				<form id="statsıfırla" onsubmit="return false;">
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
					<input type="hidden" name="charname" value="<?php echo $row[0]['CharName16']; ?>" >
                    <div class="small-box bg-yellow-gradient">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Karakterin Statlarını Sıfırla</p>
                        </div>
                        <a href="#" onclick="stat_reset();" class="small-box-footer">Devam Et <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                <input type="hidden" name="kstatsıfırla">
				</div>
				
				</form>
 							<script>
	function meslek_reset(){
		removeAlertBox('#mesleksıfırlas');
		var deger = $("#mesleksıfırlas").serialize();
                    swal({
                        title: "İşlem gerçekleştirilsin mi?",
                        text: "Evete tıkladığınız taktirde işlem geri alınamaz!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Evet",
                        closeOnConfirm: false,
                        cancelButtonText: "Hayır",
                        showLoaderOnConfirm: true,
                        html: false
                    }, function () {
		$.ajax({
			type : "POST",
			data : deger,
			url : "kontrol.php",
		
			success : function(pure){

				if($.trim(pure) == "skillok"){
					
					swal('Başarılı', 'Karakterin job cezası başarıyla sıfırlandı.', 'success');
					 setTimeout("location.reload();", 2000);
				}else if($.trim(pure) == "hata"){
				swal('Başarısız', 'Üzgünüm işlem gercekleştirilemedi.','error');	



				}
			}
  });

		});

	}
</script>
				<form id="mesleksıfırlas" onsubmit="return false;">
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
					<input type="hidden" name="charname" value="<?php echo $row[0]['CharID']; ?>" >
                     <div class="small-box bg-green">
                        <div class="inner">
                           <p style="font-size: 18px" class="text-center">Karakterin Job Cezasını Temizle</p>

                        </div>
                        <a href="#" onclick="meslek_reset();" class="small-box-footer">Devam Et <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                <input type="hidden" name="kmesleksıfırla">
				</div>
				
				</form>
 							<script>
	function guild_reset(){
		removeAlertBox('#mesleksıfırlas');
		var deger = $("#guildsıfırlas").serialize();
                    swal({
                        title: "İşlem gerçekleştirilsin mi?",
                        text: "Evete tıkladığınız taktirde işlem geri alınamaz!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Evet",
                        closeOnConfirm: false,
                        cancelButtonText: "Hayır",
                        showLoaderOnConfirm: true,
                        html: false
                    }, function () {
		$.ajax({
			type : "POST",
			data : deger,
			url : "kontrol.php",
		
			success : function(pure){

				if($.trim(pure) == "skillok"){
					
					swal('Başarılı', 'Karakterin guild cezası başarıyla sıfırlandı.', 'success');
					 setTimeout("location.reload();", 2000);
				}else if($.trim(pure) == "hata"){
				swal('Başarısız', 'Üzgünüm işlem gercekleştirilemedi.','error');	



				}
			}
  });

		});

	}
</script>
				<form id="guildsıfırlas" onsubmit="return false;">
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="col-lg-6 col-xs-12">
                    <!-- small box -->
					<input type="hidden" name="charname" value="<?php echo $row[0]['CharID']; ?>" >
              <div class="small-box bg-olive">
                        <div class="inner">
                            <p style="font-size: 18px" class="text-center">Karakterin Guild Cezasını Temizle</p>

                        </div>
                        <a href="#" onclick="guild_reset();" class="small-box-footer">Devam Et <i
                                    class="fa fa-arrow-circle-right"></i></a>
                    </div>
                <input type="hidden" name="kguildsıfırla">
				</div>
				
				</form>               
            </div>
      
</div> </div>

		<?php include('footer.php'); ?>
					<?php } ?>		