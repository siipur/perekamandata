<?php

include "config/koneksi.php";

//fungsi security dari inject
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

//mulai pengecekan
$usr 		= anti_injection($_POST['username']);
$pwd 		= anti_injection($_POST['password']);
//$pwd		= anti_injection(md5($_POST['password']));


if (!ctype_alnum($usr) OR !ctype_alnum($pwd)){
?>
	<script>
		alert('login tidak bisa di injeksi.');
		window.location.href='login.php';
	</script>
<?php
}else{
	$data	= mysql_query("SELECT * FROM tbl_user WHERE username='$usr' AND password='$pwd'");
	$cek	= mysql_num_rows($data);
	if ($cek > 0){
	  	$row = mysql_fetch_array($data);
	  	//buat session untuk keperluan login
	  	session_start();
		  	//$_SESSION[user_id]      = $row['user_id'];
		  	$_SESSION['nama_user']    = $row['nama_user'];
			$_SESSION['username']     = $row['username'];
			$_SESSION['password']     = $row['password'];
			$_SESSION['status']       = $row['status'];
		header('location:administrator.php?page=home');
	}else{
	?>
	    <script>
		alert('Maaf, Username atau password salah.');
		window.location.href='index.php';
		</script>
	<?php
	}
}

?>
