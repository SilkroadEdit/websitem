<?php include('lib/header.php'); ?>
<?php
function sifreureteci(){
 $karakterler = "abcdefghjkmnprstuxvyz23456789ABCDEFGHJKMNPRSTUXVYZ";
 $sifre = '';
 for($i=0;$i<6;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 50};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}

$_SESSION['captcha']=sifreureteci();

?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Bildirim Yolla</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabim.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">Bildirim Yolla</li>
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
                    <div class="col-lg-12">
                        <div class="card">
           <div class="card-body">
                                        <h4 class="mt-0 header-title mb-5">Bildirim Yolla</h4>
<script src="//cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>	<script>
function appendAlertBox(selector, type, message) {
    $(selector).prepend('<div id="alertBox" class="alert alert-' + type + '">' + message + '</div>')
}

function removeAlertBox(selector) {
    $(selector).find('#alertBox').remove();
}
		function kurtarcar(){
		CKEDITOR.instances.ticket.updateElement();
		var bugdeger = $("#bugkurtars").serialize();
			
		$.ajax({
			type : "POST",
			data : bugdeger,
			url : "fonks.php",
			success : function(pure){

				if($.trim(pure) == "bosalankur"){
				swal('Başarısız', 'Boş alanlar mevcut.','error');
				
				}else if($.trim(pure) == "bugkrtok"){
					swal('Başarılı', 'Bildirim başarılı şekilde iletildi .','success');
					
								setTimeout("window.location = 'bildirim.php';", 1900);		
													
				}else if($.trim(pure) == "bugkpass"){
				
					swal('Başarısız', 'Güvenlik kodu hatalı .','error');
				}else if($.trim(pure) == "kapalı"){
				
					swal('Başarısız', 'Bildirim bölümü kapalıdır .','error');					
				}else if($.trim(pure) == "hane"){
				
				swal('Başarısız', 'Mesaj en az 25 haneden oluşabilir.','error');		
				}
			}

		});

	}
	</script>
	            <!-- CK Editor -->

	           <form class="form-horizontal" id="bugkurtars" onsubmit="return false;"  method="post" action="">			
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                <div class="box-body">
                  <div class="form-group row">
                   <label for="example-text-input" class="col-sm-2 col-form-label">Konu</label>

                        <div class="col-sm-8">
                            <input type="text" class="form-control"  name="Title">
                        </div>
                    </div>
                  <div class="form-group row">
                   <label for="example-text-input" class="col-sm-2 col-form-label">Kategori</label>

                        <div class="col-sm-8">
                            <select class="form-control" name="Category">
                                <option value="Oyun Sorunları">Oyun Sorunları</option>
                                <option value="Web Sorunları">Web Sorunları</option>
                                <option value="Ödeme Bildirimi">&Ouml;deme Bildirimi</option>
                                <option value="Diğer">Diğer</option>
                            </select>
                        </div>
                    </div>
                  <div class="form-group row">
                   <label for="example-text-input" class="col-sm-2 col-form-label">Mesaj</label>

                        <div class="col-sm-8">
                            <textarea class="ckeditor" class="form-control" name="ticket" ></textarea>
                        </div>
                    </div>
					                  <div class="form-group row">
									  <style>
font {
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -o-user-select: none;
  user-select: none;
}
</style>
                   <label >
				   <div id="captchaimg" style="background-color:#000000; "><font size="7" color="gold"><center><?= $_SESSION['captcha'];?></center></font>
                            </div> </label >
				 

                        <div class="col-sm-5">
                           <input type="text" class="form-control input-lg"  name="captcha" placeholder="G&uuml;venlik Kodu">
                        </div>
                    </div>
                <input type="hidden" name="tickets" >
                
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
                      

                    </div>
                </div>
            </form>
               

        </div>
    </div>
            </div>
    </div>    </div><br><br><br><br><br>
<?php include('lib/footer.php'); ?>