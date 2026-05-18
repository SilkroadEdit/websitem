<?php 
session_start();
if (!isset($_SESSION['gamemasterlogin']) || $_SESSION['gamemasterlogin'] != "yesmasterlogin" ){

die("<a href='index.php'>Öncellikle giriş yapmalısınız! </a>" );

}
define("ADMIN",true);
			
?>

<!doctype html>
<html lang="en">

<head>
     <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel | Vsro Panel </title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="plugins/sweetalert/sweetalert.css">
    <link rel="stylesheet" href="assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="assets/css/skins/skin-blue.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="assets/css/custom.css">
    <script src="plugins/jQuery/jQuery-2.2.0.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

		<?php 
		
			require_once "inc/default.php";
		 
	  ?>

</body>
</html>