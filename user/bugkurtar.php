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
                                        <li class="breadcrumb-item active">Karakter Kurtarma</li>
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
	
	<script>
		function kurtarcar(){

		var bugdeger = $("#bugkurtars").serialize();
			
		$.ajax({
			type : "POST",
			data : bugdeger,
			url : "fonks.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
					
					
					 swal('Başarısız','Boş alanlar mevcut.','error');
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Karakter kurtarma işlemi başarılı şekilde yapıldı .','success');
					
								setTimeout("window.location = 'bugkurtar.php';", 1900);					 
				}else if($.trim(pure) == "bugkpass"){

					swal('Başarısız','Hesap Şifreniz Yanlış.','error');

				}else if($.trim(pure) == "karaktersiz"){

					swal('Başarısız','Karakter seninmi acaba ?','error');
					
				}else if($.trim(pure) == "models"){

				swal('Başarısız','Karakter job modundayken kurtarma işlemi yapılamaz.','error');				
					
				}else if($.trim(pure) == "gs"){
	 
				swal('Başarısız','Bilgileriniz hatalı.','error');									
					
				}else if($.trim(pure) == "bugkapalı"){
					swal('Başarısız','Karakter Kurtarma Şuan Kapalıdır.','error');
					
					
				}
			}

		});

	}
	</script>
                    <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
  <h4 class="mt-0 header-title mb-5">Karakter Bug Kurtar</h4>	
	           <form id="bugkurtars" onsubmit="return false;"  method="post" action="">
	<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
<div class="form-group row">
                   <label for="example-text-input" class="col-sm-3 col-form-label">Karakter</label>

                        <div class="col-sm-8">
                           <select name="charname" class="form-control" >
						   <option value="0">Karakter Seçin </option>
		<?php
		$karakterler_class = $users->get_jid();
		foreach($users->get_jid() as $karakterler){
			echo "<option value='".$karakterler['CharName16']."'>".$karakterler['CharName16']."</option>";
		}
		?>
		 </select>
                       
                    </div>
                </div>
				<input type="hidden" name="bugkurtar"/>
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


            </form>
          
		  
		  			    </div> </div>
    </div>
<div class="col-lg-6">

            <div class="box-body">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Karakter Bug'dan Kurtarma Hakkında Bilgi :</b> Bug'dan kurtarma işlemi ücretsizdir. Karakter job modun'dayken bug'dan kurtarma işlemi yapılamaz.
                    Eğer bu işlemde sorun yaşarsanız oyun yetkilisine bildiriniz.
                </div>
            </div>
        </div>
    </div>
       <br><br><br><br><br><br><br><br><br><br> 
<?php include('lib/footer.php'); ?>