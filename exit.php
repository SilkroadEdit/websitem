<?php 
ob_start();
session_start();
session_destroy();
header('Location:index.php');
ob_end_flush();
?>
?> <META HTTP-EQUIV="Refresh" CONTENT="0;URL=/index.php"> <?php
