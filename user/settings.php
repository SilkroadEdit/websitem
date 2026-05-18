<?php include('lib/header.php'); ?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Genel Ayarlar</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Genel Ayarlar</li>
                                    </ol>


                                </div>
                                <div class="col-sm-6">

                                    <div class="float-right d-none d-md-block">
                                        <div class="dropdown">
                   
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="#">Action</a>
                                                <a class="dropdown-item" href="#">Another action</a>
                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="#">Separated link</a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
					<?php
		$jidim = $_SESSION['JID'];
		$query = $users->link->db_conn_pann->query("SELECT *,(select detayk from panel..gm_settings) as gm1,(select jobk from panel..gm_settings) as gm2,(select goldk from panel..gm_settings) as gm3 FROM user_settings where jid = '$jidim'");
		$row = $query->fetchAll();

			?>
	<script>
		function kurtarcar(){
		
		var bugdeger = $("#bugkurtars").serialize();
			
		$.ajax({
			type : "POST",
			data : bugdeger,
			url : "fonks.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
					swal('Başarısız', 'Eksik bir veri bulundu lütfen sayfayı yenileyip tekrardan deneyin.','error');
					
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Genel ayarlarınız başarıyla düzenlendi .','success');
					
								setTimeout("window.location = 'settings.php';", 1900);					 
				}else if($.trim(pure) == "bugkpass"){

				swal('Başarısız', 'Bilinmedik bir hata oluştu lütfen yetkiliye danışın.','error');
					
				}
			}

		});

	}
	</script>
	                    <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
  <h4 class="mt-0 header-title mb-5">Genel Ayarlar</h4>	
   <?php if($row[0]['gm1']==0 && $row[0]['gm2']==0 && $row[0]['gm3']==0){ }else{ ?>
	           <form class="form-horizontal" id="bugkurtars" onsubmit="return false;"  method="post" action="">
			   <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <input type="hidden" name="jid" value="<?php echo $_SESSION['JID'] ?>" />
<?php if($row[0]["gm1"] == 1){ ?>
<div class="form-group row">
                   <label for="example-text-input" class="col-sm-5 col-form-label">Item Statları :</label>

                                <div class="col-sm-5">
									
                                    <label class="control-label" for="0-status">Durum</label>
								
                                    <select class="form-control" name="deger1"
                                            id="0-status">
                                       <option value="0" <?php if($row[0]['detay'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                            Kapalı
                                        </option>
                                        <option value="1" <?php if($row[0]['detay'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                            A&ccedil;ık
                                        </option>
                                    </select>
								
                                </div>
                            </div>
								<?php }else{ echo ''; } ?>
										<?php if($row[0]["gm2"] == 1){ ?>
<div class="form-group row">
                   <label for="example-text-input" class="col-sm-5 col-form-label">Job Adı :</label>							


                                <div class="col-sm-5">
								
                                    <label class="control-label" for="1-status">Durum</label>
                                    <select class="form-control" name="deger2"
                                            id="1-status">
                                        <option value="0" <?php if($row[0]['job'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                            Kapalı
                                        </option>
                                        <option value="1" <?php if($row[0]['job'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                            A&ccedil;ık
                                        </option>
                                    </select>
									
                                </div>
                            </div>
<?php }else{ echo ''; } ?>
	<?php if($row[0]["gm3"] == 1){ ?>
<div class="form-group row">
                   <label for="example-text-input" class="col-sm-5 col-form-label">Char Gold :</label>							


                                <div class="col-sm-5">
							
                                    <label class="control-label" for="2-status">Durum</label>
                                    <select class="form-control" name="deger3"
                                            id="2-status">
                                        <option value="0" <?php if($row[0]['gold'] == 0){ echo 'selected'; }else{ echo ''; } ?>>
                                            Kapalı
                                        </option>
                                        <option value="1" <?php if($row[0]['gold'] == 1){ echo 'selected'; }else{ echo ''; } ?>>
                                            A&ccedil;ık
                                        </option>
                                    </select>
									
                                </div>
                            </div>
							<?php }else{ echo ''; } ?>
							
					<input type="hidden" name="settings"/>
                                          
                                                 <center><div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="kurtarcar();">
                                                        Gönder
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5"  onclick="window.location.replace('hesabim.php')">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div></center>
   </form><?php }  ?>

        </div>
    </div>
    </div>
<div class="col-lg-6">
            <div class="box-body">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    Buradan hesabınıza özel ayarlar yapabilirsiniz. Örneğin; Item Statlarını kapadığınızda karakter
                    bilgileri sayfasında itemlerinizin statlarını gizleyebilirsiniz. Ayarlar hesabınıza bağlı ve tüm
                    karakterleriniz için ortaktır. Bir ayar yaptığınız taktirde o ayar hesabınızdaki tüm karakterler
                    için gerçerli olacaktır.
                </div>
            </div>
        </div>
    </div>
            </div><br><br><br><br><br><br>
<?php include('lib/footer.php'); ?>
