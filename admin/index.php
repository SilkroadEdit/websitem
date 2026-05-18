<?php
session_start();
$_SESSION['_token'] = sha1(md5(rand(00000, 99999)));
 ?>
<!DOCTYPE html>
<html>
<head>
<?php if(!isset($_SESSION['loginadmin'])){
		
		
	?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | Giriş</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
	<link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/css/AdminLogin.css">
    <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>Admin</b> Panel</a>
    </div>
    <div class="login-box-body">
        <p class="login-box-msg">Panele erişebilmek için lütfen giriş yapın</p>
<script type="text/javascript" >
		function adminyap(){
		removeAlertBox('#login-form');
		var deger = $("#login-form").serialize();
			
		$.ajax({
			type : "POST",
			data : deger,
			url : "adminpure.php",
			success : function(pure){

				if($.trim(pure) == "loginbos"){
					 
					appendAlertBox('#login-form', 'error', 'Lütfen tüm alanları doldurunuz.');

				}else if($.trim(pure) == "girisok"){
					swal('Başarılı', 'Başarılı şekilde giriş yaptınız yönlendiriliyorsunuz.', 'success');
					 setTimeout("window.location = 'admin.php';", 750);
				}else if($.trim(pure) == "hata"){
					appendAlertBox('#login-form', 'error', 'Kullanıcı adı yada şifreniz yanlış.'); 

				}else if($.trim(pure) == "ipadres"){
					appendAlertBox('#login-form', 'error', 'İp adresiniz kayıtlardakiyle uyuşmuyor..'); 

				}
			}

		});

	}</script>
        <form id="login-form" onsubmit="return false;" method="post">
<input type="hidden" name="_token" value="<?php echo $_SESSION['_token']; ?>">

            <div class="form-group has-feedback" id="group-username">
                <input type="text" class="form-control" name="username" placeholder="Kullanıcı Adı">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback" id="group-password">
                <input type="password" class="form-control" name="pass" placeholder="Şifre">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
			<input type="hidden" name="login"/>
            <div class="row">
                <div class="col-xs-4 col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat" onclick="adminyap();">Giriş Yap</button>
                </div>
            </div>
        </form>

    </div>
</div>
<?php }else {
		

	echo'<META HTTP-EQUIV="Refresh" CONTENT="0;URL=admin.php">'; } ?>

<script src="plugins/sweetalert/sweetalert.min.js"></script>
<script src="assets/js/custom.js"></script>
</body>
</html>
