<?php include('lib/header.php'); ?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Özel İşlemler</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Stat Ve Skill Reset</li>
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
		<?php 				$p_test = $users->link->db_conn_pann->query("select * from SpecialFiyat");
				$marketitem = $p_test->fetchAll(); ?>
				<?php if($marketitem[0]['stattl'] == 0){ $tl1 = ''.$marketitem[0]['statsilk'].'	Silk'; }else{ $tl1 = ''.$marketitem[0]['stattl'].'	TL '; } ?>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
  <h4 class="mt-0 header-title mb-5">Stat Sıfırlama &emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;İşlem ücreti : <?php echo''.$tl1.''; ?></h4>

	<script>
		function sıfırlastat(){
	
		var bugdeger = $("#statsıfırlas").serialize();
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
			data : bugdeger,
			url : "fonks.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
					
					
					 swal('Başarısız', 'Boş alanlar mevcut.','error');
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Stat sıfırlama işlemi başarılı şekilde yapıldı .','success');
					
								setTimeout("window.location = 'ozel.php';", 1900);					 
				}else if($.trim(pure) == "bugkpass"){
					 swal('Başarısız', 'Hesap Şifreniz Yanlış.','error');
				

				}else if($.trim(pure) == "karaktersiz"){
					 swal('Başarısız', 'Karakter seninmi acaba ?','error');
				
					
				}else if($.trim(pure) == "models"){
				swal('Başarısız', 'Karakter oyundayken stat sıfırlama işlemi yapılamaz.','error');
						
					
				}else if($.trim(pure) == "gs"){
					
				swal('Başarısız', 'Yetersiz Bakiye.','error');		 
													
					
				}else if($.trim(pure) == "statkapalı"){
					
					swal('Başarısız', 'Stat Sıfırlama Şuan Kapalıdır..','error');	
					
					}
			}
  });

		});

	}
	</script>
<form  id="statsıfırlas" onsubmit="return false;"  method="post" action="">
     <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
			<div class="form-group row">
                   <label for="example-text-input" class="col-sm-3 col-form-label">Karakter</label>

                        <div class="col-sm-8">
                           <select name="charname" class="form-control" >
						   <option value="0">Karakter Seçin</option>
		<?php
		$karakterler_class = $users->get_jid();
		foreach($users->get_jid() as $karakterler){
			echo "<option value='".$karakterler['CharName16']."'>".$karakterler['CharName16']."</option>";
		}
		?>
		 </select>
                        </div>
                    </div>
                </div>
				<input type="hidden" name="statsıfırla"/>
                                                 <center><div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="sıfırlastat();">
                                                        Gönder
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5"  onclick="window.location.replace('hesabım.php')">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div></center>


            </form>
			
 </div>
                                    </div>
                                </div>
      


				<?php if($marketitem[0]['skilltl'] == 0){ $tl12 = ''.$marketitem[0]['skillsilk'].'	Silk'; }else{ $tl12 = ''.$marketitem[0]['skilltl'].'	TL '; } ?>
                 
                  
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">

                                        <h4 class="mt-0 header-title mb-5">Skill Sıfırlama &emsp;&emsp;&emsp;&emsp; &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;İşlem ücreti : <?php echo''.$tl12.''; ?></h4>
     
	
	<script>
		function sıfırlaskils(){
		
		var bugdeger = $("#skillsıfırlas").serialize();
			
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
			data : bugdeger,
			url : "fonks.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
					
					
					 swal('Başarısız', 'Boş alanlar mevcut.','error');
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Skill sıfırlama işlemi başarılı şekilde yapıldı .','success');
					
								setTimeout("window.location = 'ozel.php';", 1900);					 
				}else if($.trim(pure) == "bugkpass"){
					 swal('Başarısız', 'Hesap Şifreniz Yanlış.','error');
				

				}else if($.trim(pure) == "karaktersiz"){
					 swal('Başarısız', 'Karakter seninmi acaba ?','error');
				
					
				}else if($.trim(pure) == "models"){
				swal('Başarısız', 'Karakter oyundayken Skill sıfırlama işlemi yapılamaz.','error');
						
					
				}else if($.trim(pure) == "gs"){
					
				swal('Başarısız', 'Yetersiz Bakiye.','error');		 
													
					
				}else if($.trim(pure) == "skillkapalı"){
					
					swal('Başarısız', 'Skill Sıfırlama Şuan Kapalıdır..','error');	
					
					}
			}
  });

		});

	}
	</script>
		 <form id="skillsıfırlas" onsubmit="return false;"  method="post" action="">
			<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                  <div class="form-group row">
                   <label for="example-text-input" class="col-sm-3 col-form-label">Karakter</label>

                        <div class="col-sm-8">
                           <select name="charname1" class="form-control" >
						   <option value="0">Karakter Seçin</option>
		<?php
		$karakterler_class = $users->get_jid();
		foreach($users->get_jid() as $karakterler){
			echo "<option value='".$karakterler['CharName16']."'>".$karakterler['CharName16']."</option>";
		}
		?>
		 </select>
                        </div>
                    </div>
            
				<input type="hidden" name="skillsıfırla"/>
                                                 <center><div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="sıfırlaskils();">
                                                        Gönder
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5"  onclick="window.location.replace('hesabım.php')">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div></center>         

            </form>
                                    </div>
                                </div>
                            </div>
                        </div><center>
  <div class="col-md-6">

            <div class="box-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Stat Ve Skill Sıfırlama Hakkında Bilgi :</b> Karakter oyunda online durumdayken stat ve skill sıfırlama işlemi yapılamaz.
                    Eğer bu işlemde sorun yaşarsanız oyun yetkilisine bildiriniz.
                </div>
            </div>
        </div></center>
    </div><br><br><br><br><br><br>
<?php include('lib/footer.php'); ?>