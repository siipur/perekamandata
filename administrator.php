<?php
session_start(); //aktifkan session
?>

<!DOCTYPE html>
<html>
<head>
<title>Sistem Perekaman Data Warga</title>
</head>
<body>
    <!-- header -->
	<div class="header" style="border:1px solid; padding:7px 100px">
    	<span class="">
        	<img src="assets/img/header.png" width="100%" height="220" alt="header"/>
        </span>
    </div>

    <!-- menu navigasi -->	
    <div class="menu" style="border:1px solid">
   	 	<?php include 'menu_navigasi.php'; ?>
    </div>

	<!-- content -->
    <div class="content" style="border:1px solid">
        <?php include 'content.php'; ?>
    </div>

    <!-- footer -->
    <div class="footer" align="center" style="border:1px solid">
    	<?php include 'footer.php'; ?>
    </div>

</body>
</html>
