<?php // untuk model database

session_start();
if(empty($_SESSION['username']) AND empty($_SESSION['password'])) {
	echo "<center>Untuk mengakses modul, Anda harus login <br> <a href=../../login.php><b>LOGIN</b></a></center>";
}

else {
	include "../../config/koneksi.php";
	
	$page	= $_GET['page']; 
	$act	= $_GET['act'];
	$table	= 'tbl_user';
	$id 	= 'user_id';
	
	/*-----------------------------------------------------------------------------
	 note: (keamanan website)
	 addslashes() 	-> untuk menambahkan blackslash (\) supaya mencegah hacker 
	 				   menginput script yg mengandung kutip ('). => (\')
	 stripslashes()	-> kebalikan dari addslashes()
	 strip_tags() 	-> untuk menghilangkan karakter html yg sengaja diinputkan.
	 htmlentities() -> untuk mengubah kode html menjadi karakter biasa
	 trim()			-> untuk menghilangkan spasi kiri dan spasi dari kata
	 -----------------------------------------------------------------------------*/
	
	// metode aksi tambah
	if ($page == 'user' AND $act == 'tambah') {	
		$user_id 	= addslashes(strip_tags($_POST['user_id']));
		$nama_user	= addslashes(strip_tags($_POST['nama_user']));
		$username	= addslashes(strip_tags($_POST['username']));
		$password	= addslashes(strip_tags($_POST['password']));
		//$password	= addslashes(strip_tags(md5($_POST['password']));
		$status		= addslashes(strip_tags($_POST['status']));
		$query = mysql_query ("
			INSERT INTO $table VALUES ('$user_id','$nama_user','$username','$password','$status')
		");
		if($query) {
			header('location:../../administrator.php?page='.$page); //redirect ke: localhost/perekamandata/administrator.php?page=user
			$_SESSION['message'] = "<span><font color=\"green\">Data berhasil ditambahkan</font></span>";
		} else {
			$_SESSION['message'] = "<script language='javascript'>window.alert('Data Gagal ditambahkan');</script>";
		}
	}

	// metode aksi edit
	elseif ($page == 'user' AND $act == 'edit') {
		$user_id 	= addslashes(strip_tags($_POST['user_id']));
		$nama_user	= addslashes(strip_tags($_POST['nama_user']));
		$username	= addslashes(strip_tags($_POST['username']));
		$password	= addslashes(strip_tags($_POST['password']));
		//$password	= addslashes(strip_tags(md5($_POST['password']));
		$status		= addslashes(strip_tags($_POST['status']));
		$query = mysql_query("
			UPDATE $table SET nama_user='$nama_user', username='$username', password='$password', status='$status'
			WHERE $id='$user_id'
		");
		if($query) {
			header('location:../../administrator.php?page='.$page);
			$_SESSION['message'] = "<span><font color=\"green\">Data berhasil diperbarui</font></span>";
		} else {
			$_SESSION['message'] = "<script language='javascript'>window.alert('Data gagal diperbarui');</script>";
		}	
	}

	// metode aksi hapus 
	elseif ($page == 'user' AND $act == 'hapus') {	
		$query = mysql_query (" DELETE FROM $table WHERE $id='$_GET[id]' ");
		if($query) {
			header('location:../../administrator.php?page='.$page);
			$_SESSION['message'] = "<span><font color=\"green\">Data berhasil dihapus</font></span>";
		} else {
			$_SESSION['message'] = "<script language='javascript'>alert('Data Gagal dihapus');</script> ";
		}
	}

}
?>