<?php

include "config/koneksi.php";

$halaman = $_GET['page'];

if ($halaman=='home'){
	echo "<h2>Selamat Datang</h2>";
	echo "Hai, <b>$_SESSION[username]</b> Selamat datang  di Sistem Informasi Koperasi";
	echo "Anda login sebagai: <strong><i>$_SESSION[status]</i></strong>";
	echo ("<p>halaman ini sengaja dibuat dengan sederhana untuk fokus belajar mengenai logika pada pemprograman PHP</p>");	
	echo "<p>Silahkan pilih menu yang telah disediakan!</p>";
}
elseif ($halaman=='user'){
    include "modul/mod_user/user.php";
}
elseif ($halaman=='warga'){
   include "modul/mod_warga/warga.php";
}
else{
  echo "<b>Maaf yang Anda Cari Tidak Ada dikarenakan Modul Belum Dibuat</b>";
}

?>
