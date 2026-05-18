<?PHP echo !defined("ADMIN") ? die("Hacking?"): null; ?>
			<?php
						$guildid = (int)htmlspecialchars($_GET['guildid']);
						$no ='/[çÇıİğĞüÜöÖŞş\'^£$%&*()}{@#~?><>,;|=+¬-]/';
			$detay = $admin->link->db_conn_shard->query("SELECT * FROM _Guild WHERE ID = '$guildid'");
					$row = $detay->fetchAll();
				if(empty($guildid)){
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
                <h3 class="box-title">Guild Düzenle - <?php echo $row[0]['Name']; ?></h3>
            </div>
            <form class="form-horizontal" method="post" id="guild-update">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden" name="guildname" id="guildname" value="<?php echo $row[0]['Name']; ?>">

                <div class="box-body">
                    <div class="form-group" id="group-level">
                        <label for="level" class="col-sm-3 control-label">Level</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="level" name="level"
                                   value="<?php echo $row[0]['Lvl']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-gatheredsp">
                        <label for="gatheredsp" class="col-sm-3 control-label">Bağışlanan GP</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="gatheredsp" name="gatheredsp"
                                   value="<?php echo $row[0]['GatheredSP']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-gold">
                        <label for="gold" class="col-sm-3 control-label">Kasadaki Gold</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="gold" name="gold"
                                   value="<?php echo $row[0]['Gold']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-title">
                        <label for="title" class="col-sm-3 control-label">Guild Başlık</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="title" name="title"
                                   value="<?php echo $row[0]['MasterCommentTitle']; ?>">
                        </div>
                    </div>
                    <div class="form-group" id="group-content">
                        <label for="content" class="col-sm-3 control-label">Guild İçerik</label>

                        <div class="col-sm-8">
                            <textarea class="form-control" id="content"
                                      name="content" value="<?php echo $row[0]['MasterComment']; ?>"></textarea>
                        </div>
                    </div>
					<input type="hidden" name="guildüzenle" id="guildüzenle" >
					</div>
                <div class="box-footer">
                    <button type="reset" class="btn btn-default"
                            onclick="window.location.replace('admin.php?do=guild')">Vazgeç
                    </button>
                    <button type="submit" class="btn btn-info pull-right">Gönder</button>
                </div>
            </form>
			<script type="text/javascript">
			    $('#guild-update').submit(function () {
					
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
            <h3 class="box-title">Guild Üyeleri
                <small></small>
            </h3>
        </div>
        <div class="box-body" id="search-content">
            <div class="table-responsive">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>#</th>
            <th>Character</th>
            <th>Race</th>
            <th>Level</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
		
							<?php 	
		$sayfada = 10;
		$toplam_icerik = $admin->toplam_icerik4($guildid);
	    $toplam_sayfa = ceil($toplam_icerik / $sayfada);
		//echo $toplam_sayfa;
			
		$getfonk =(int)isset($_GET["page"]) ? $_GET["page"] : 1;
		if(!(int)$getfonk){
		   $getfonk = 1;
		}
		if ($getfonk > $toplam_sayfa){
			$getfonk = $toplam_sayfa;
		}
		$page = $getfonk * $sayfada; 
		if($getfonk != "1")
		{
		$page2 = $page - $sayfada;
		}else {
		$page2 = "0";
		}
		//SUBSTRING(tarih,0,10)
		
		$blogg = $admin->link->db_conn_shard->prepare("
		SELECT  * FROM
		(SELECT ROW_NUMBER() OVER (ORDER BY GuildID asc) AS Row, * from _GuildMember where GuildID = '$guildid') AS blog
		WHERE blog.row between (".$page2." + 1) and ".$page."");
		
		$blogg -> execute();
		//print_r($blogg);
		

		  foreach($blogg as $row){
 ?>
                    <tr>
                <td><?php echo $row['Row']; ?></td>
                <td><?php echo $row['CharName']; ?></td>
                <td><?php if($row['RefObjID'] <= 1932){ echo 'China'; } else{ echo 'European'; } ?></td>
                <td><?php echo $row['CharLevel']; ?></td>
                <td>
                    <div class="btn-group btn-group-xs">
                        <button class="btn btn-xs btn-info" title="Düzenle"
                                onclick="window.location.href = 'admin.php?do=karakteredit&charid=<?php echo $row['CharID']; ?>';">
                            <i class="glyphicon glyphicon-edit"></i>
                        </button>
                    </div>
                </td>
            </tr>
		  <?php } ?>
                </tbody>
    </table>
</div>
<div class="row">
    <div class="col-sm-12">
              <ul class="pagination" id="pager">
<?php $pgn->Pagination($getfonk, $toplam_sayfa);?>
		  </ul>
         </div>
</div>
        </div>
        <script type="text/javascript">
            function switchPage(page) {
                overOverLayer();
                $('#search-content').load("faqs.php?pagemembers=" + page,'&guildid=<?php echo ''.$guildid.''; ?>', function (response, status, xhr) {
                    if (status != "success") {
                        swal({
                            title: 'Opps...',
                            text: xhr.statusText,
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                    overOverLayerClose();
                });
            }
        </script>

      
</div> </div>

		<?php include('footer.php'); ?>
					<?php } ?>		