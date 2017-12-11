<?php

	// panggil fungsi validasi xss dan injection
	require_once('fungsi_validasi.php');

	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "db_rekam";
	// Koneksi dan memilih database di server
	mysql_connect($server,$username,$password) or die("Koneksi ke database server gagal" .mysql_error());
	mysql_select_db($database) or die("Database tidak bisa dibuka" .mysql_error());

	// buat variabel untuk validasi dari file fungsi_validasi.php
	$val = new validasi;

?>
