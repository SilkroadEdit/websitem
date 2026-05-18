<?php include('lib/header.php'); ?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Şifre Değiştir</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Şifre Değiştir</li>
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
	
	<script type="text/javascript"> 	
	function degistirpass(){

		var passdeger = $("#passformu").serialize();
			
		$.ajax({
			type : "POST",
			data : passdeger,
			url : "sifredesajax.php",
			success : function(pure){

				if($.trim(pure) == "passbos"){
					
					swal('Başarısız!', 'Boş alanlar mevcut.', 'error');

				}else if($.trim(pure) == "passok"){
					
					swal('Başarılı!', 'Şifreniz başarılı şekilde şifreniz değiştirildi.\nYeni Şifreniz İle Giriş Yapınız', 'success');
								setTimeout("window.location = 'exit.php';", 750);					 
				}else if($.trim(pure) == "eskipass"){
					
					swal('Başarısız!', 'Eski şifreniz yanlış.', 'error');

				}else if($.trim(pure) == "alan"){
					
					swal('Başarısız!', 'Yeni şifreniz en fazla 24 en az 8 karakterden oluşması gerekir.', 'error');
					
				}else if($.trim(pure) == "newpass"){

				swal('Başarısız!', 'Yeni şifre bir biri ile uyuşmuyor.', 'error');				

				}else if($.trim(pure) == "kontrolyal"){

				swal('Başarısız!', 'Yeni şifrenizde en az 1 büyük harf bulunmak zorundadır..', 'error');	
					
				}else if($.trim(pure) == "gs"){
					
					 
					swal('Başarısız','Bilgileriniz hatalı.', 'error');										
					
				}
			}

		});

	}</script>
	                    <div class="row">
                            <div class="col-lg-8">
                                <div class="card">
                                    <div class="card-body">
  <h4 class="mt-0 header-title mb-5">Şifre Değiştir</h4>	
            <form id="passformu" onsubmit="return false;" class="form-horizontal" method="post" action="">
        <input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">        
<div class="form-group row">
                        <label for="password" class="col-sm-3 control-label">Eski Şifre</label>

                        <div class="col-sm-8">
                            <input name="eskipass" type="password" class="form-control" />
                        </div>
                    </div>
<div class="form-group row">
                        <label for="password2" class="col-sm-3 control-label">Yeni Şifre</label>

                        <div class="col-sm-8">
                            <input name="pass" type="password" class="form-control" />
                        </div>
                    </div>
<div class="form-group row">
                        <label for="password2_confirmation" class="col-sm-3 control-label">Yeni Şifre (Tekrar)</label>

                        <div class="col-sm-8">
                            <input name="repass" type="password" class="form-control" />
                        </div>
                    </div>
<div class="form-group row">
                        <label for="secret" class="col-sm-3 control-label">Gizli Yanıt</label>

                        <div class="col-sm-8">
                            <input name="gs" type="text" class="form-control"  />
                        </div>
                    </div>
              
				<input type="hidden"  name="changepw" />
                                                 <center><div class="form-group">
                                                <div>
                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="degistirpass();">
                                                        Gönder
                                                    </button>
                                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5"  onclick="window.location.replace('hesabim.php')">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </div></center>

            </form>
           
        </div>
    </div>
            </div></div><br><br><br><br><br><br>
<?php include('lib/footer.php'); ?>