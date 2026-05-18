<?php
include ('lib/reg_users.php');
$_SESSION['_token'] = sha1(md5(rand(00000, 99999)));
 ?>
<?php if(!isset($_SESSION['guardf'])){
		
		
	?>
<!DOCTYPE html>
<html lang="en">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
          <title>Kullanıcı Paneli | Giriş</title>
        <meta content="Admin Dashboard" name="description">
        <meta content="Themesbrand" name="author">
        <link rel="shortcut icon" href="assets/images/favicon.ico">
		<link rel="stylesheet" href="public/plugins/sweetalert/sweetalert.css">
        <link href="public/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="public/assets/css/metismenu.min.css" rel="stylesheet" type="text/css">
        <link href="public/assets/css/icons.css" rel="stylesheet" type="text/css">
        <link href="public/assets/css/style.css" rel="stylesheet" type="text/css">
    </head>

    <body> <div class="home-btn d-none d-sm-block">
            <a href="/" class="text-dark"><font color="white"><i class="fas fa-home h2"></i></font></a>
        </div>
        
        <div class="wrapper-page">

            <div class="card overflow-hidden account-card mx-3">
                
                <div class="bg-primary p-4 text-white text-center position-relative">
                    <h4 class="font-20 m-b-5">Hoşgeldin !</h4>
                    <p class="text-white-50 mb-4">Kullanıcı paneline erişebilmek için öncellikle giriş yapmalısınz.</p>
                    <a href="/" class="logo logo-admin"><font color="white"><b>K</b>P</font></a>
                </div>
                <div class="account-card-content"> 
<script type="text/javascript" > 	function useryap(){

		var deger = $("#userformu").serialize();
			
		$.ajax({
			type : "POST",
			data : deger,
			url : "pure.php",
			success : function(pure){

				if($.trim(pure) == "loginbos"){
					 
					swal('Başarısız!', 'Boş alanlar mevcut.', 'error');

				}else if($.trim(pure) == "girisok"){
					 
					setTimeout(function() {swal({title: "BAŞARILI",text: "Giriş Başarılı User Panele Yönlendiriliyorsunuz",type: "success",timer:2000}, function() {window.location = "hesabim.php";});}, 3);
				}else if($.trim(pure) == "hata"){
					 
					swal('Başarısız!', 'Kullanıcı Adı Yada Şifreniz Yanlış.', 'error');

				}
			}

		});

	}</script>
                    <form class="form-horizontal m-t-30" id="userformu" onsubmit="return false;">
<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Enter username">
                        </div>

                        <div class="form-group">
                            <label for="userpassword">Password</label>
                            <input type="password" class="form-control" name="pass" placeholder="Enter password">
                        </div>

                        <div class="form-group row m-t-20">
                            <div class="col-sm-6">
                                <div class="custom-control custom-checkbox">
                        <input type="hidden" name="login">
                                </div>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button class="btn btn-primary w-md waves-effect waves-light" type="submit" onclick="useryap();">Giriş Yap</button>
                            </div>
                        </div>

                        <div class="form-group m-t-10 mb-0 row">
                            <div class="col-12 m-t-20">
                                <a href="/lostpassword.php"><i class="mdi mdi-lock"></i> Şifrenizimi Unuttunuz?</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
<br><br><br><br><br><br>


        </div>
        <!-- end wrapper-page -->

 <!-- jQuery  -->
        <script src="public/assets/js/jquery.min.js"></script>
        <script src="public/assets/js/bootstrap.bundle.min.js"></script>
        <script src="public/assets/js/metisMenu.min.js"></script>
        <script src="public/assets/js/jquery.slimscroll.js"></script>
        <script src="public/assets/js/waves.min.js"></script>
         <!-- countdown -->
         <script src="public/plugins/countdown/jquery.countdown.min.js"></script>
        <script src="public/assets/pages/countdown.int.js"></script>
<script src="public/plugins/sweetalert/sweetalert.min.js"></script>
        <!-- App js -->
        <script src="public/assets/js/app.js"></script>

    </body>


</html>

<?php }else {
		

	echo'<META HTTP-EQUIV="Refresh" CONTENT="0;URL=hesabim.php">'; } ?>


