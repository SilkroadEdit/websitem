<?php include('lib/header.php'); include('lib/paginiation.php');
$pgn = new Pagenation(); ?>
<?php
function sifreureteci(){
 $karakterler = "abcdefghjkmnprstuxvyz23456789ABCDEFGHJKMNPRSTUXVYZ";
 $sifre = '';
 for($i=0;$i<4;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 50};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}

$_SESSION['ykontrol_kodu']=sifreureteci();

?>
		   <div class="content-page">
		   <div class="content">
		    <div class="container-fluid">
			                 <div class="page-title-box">
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <h4 class="page-title">Maxigame TL Yükle</h4>
                                    <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="hesabım.php">Anasayfa</a></li>
                                        <li class="breadcrumb-item active">TL Yükle</li>
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
	<script type="text/javascript"> 	
	function degistirpass(){
		$('#info-content').empty();
		var passdeger = $("#passformu").serialize();
			
		$.ajax({
			type : "POST",
			data : passdeger,
			url : "../maxicard/tl_epin_yukle.php",
			success : function(pure){
			$('#info-content').html(pure);
			}

		});

	}</script>
                                </div>
                            </div>
                        </div>	
						<center>   
	                    <div class="row">
                            <div class="col-lg-7">
                                <div class="card">
                                    <div class="card-body">
				<h4 class="mt-0 header-title mb-5">Maxigame Epin Yükle</h4>	
				    <div id="info-content">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <b>Epin kart kodu</b> bölümü maxigameden aldığınız epin'in kart kodudur.<br>
					<b>Epin kart şifresi</b> bölümü maxigameden aldığınız epin'in kart şifresidir.<br>
					<b>Güvenlik kodu</b> bölümü resimdeki rakamları girmeniz gereken yerdir.<br>
                </div>
						</div>
				 <form id="passformu" onsubmit="return false;" class="form-horizontal" method="post" action="">
				<input type="hidden" name="user" value="<?php echo $_SESSION['username'] ?>" />
				<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">        
					<div class="form-group row">
                        <label for="password" class="col-sm-3 control-label">E-Pin Kart Kodu</label>
			
                        <div class="col-sm-8">
                            <input name="kartkodu" type="text" class="form-control" maxlength="40" size="40"/>
                        </div>
                    </div>
					<div class="form-group row">
                        <label for="password2" class="col-sm-3 control-label">E-Pin Kart Şifresi</label>

                        <div class="col-sm-8">
                            <input name="kartsifre" type="text" class="form-control" maxlength="40" size="40"/>
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
                        <label for="secret" class="col-sm-3 control-label">
							<div id="captchaimg" style="background-color:#000000; "><font size="5" color="gold"><?= $_SESSION['ykontrol_kodu'];?></font>
                            </div></label>

                        <div class="col-sm-8">
                            <input name="g_resim" type="text" class="form-control" placeholder="Doğrulama Kodu" maxlength="5"/>
                        </div>
                    </div>           
								<input type="hidden" name="maxigame">
                                                 <div class="form-group">
                                                <div>
 <button type="submit" class="btn btn-primary waves-effect waves-light" onclick="degistirpass();"> Gönder </button>
  <button type="reset" class="btn btn-secondary waves-effect m-l-5"  onclick="window.location.replace('hesabım.php')"> Cancel  </button>
                                                </div>
   </div></center>
											</form>
</div>  </div> 
            </div></div>
  <br><br><br><br><br><br>   
<?php include('lib/footer.php'); ?>