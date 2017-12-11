<?php // untuk model database

session_start();
if(empty($_SESSION['username']) AND empty($_SESSION['password'])) {
	echo "<center>Untuk mengakses modul, Anda harus login <br> <a href=../../login.php><b>LOGIN</b></a></center>";
}

else {
	include "../../config/koneksi.php";
	include "../../config/fungsi_upload.php";
	
	$page	= $_GET['page']; 
	$act	= $_GET['act'];
	$table	= 'tbl_ktp';
	$id 	= 'nik';
	
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
	if ($page == 'warga' AND $act == 'tambah') {	
		$nik		= addslashes(strip_tags($_POST['nik']));
		$nama 		= addslashes(strip_tags($_POST['nama_lengkap']));
		$kelahiran	= addslashes(strip_tags($_POST['tempat_lahir']));
		$tgllahir	= $_POST['tanggal_lahir'];
		$jenkel		= $_POST['jenis_kelamin'];
		$goldarah	= $_POST['golongan_darah'];
		$alamat		= addslashes(strip_tags($_POST['alamat_lengkap']));
		$agama		= $_POST['agama'];
		$status		= addslashes(strip_tags($_POST['status_kawin']));
		$kerjaan	= addslashes(strip_tags($_POST['pekerjaan']));
		$warganegara= addslashes(strip_tags($_POST['kewarganegaraan']));

		# konfigurasi untuk upload foto 
		$lokasi_file 	= $_FILES['foto']['tmp_name'];
		$nama_foto 		= $_FILES['foto']['name'];
		$tipe_file 		= $_FILES['foto']['type'];
		$nama_foto_unik = rand(00000,99999)."_".$nama_foto;
		$target_dir		= "../../uploads/img/"; //target: localhost/perekamandata/uploads/img/
		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
			echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
					window.location=('../../administrator.php?page=warga')</script>";
		}
		else {
			if(is_uploaded_file($lokasi_file)) {
				move_uploaded_file ($lokasi_file, $target_dir . $nama_foto_unik);
			}
		}
		
		$query = mysql_query ("
			INSERT INTO $table VALUES 
			('$nik','$nama','$kelahiran','$tgllahir','$jenkel','$goldarah',
			'$alamat','$agama','$status','$kerjaan','$warganegara','$nama_foto_unik')
		");

		if($query) {
			header('location:../../administrator.php?page='.$page); //redirect ke: localhost/perekamandata/administrator.php?page=warga
			$_SESSION['message'] = "<span><font color='green'>Data berhasil ditambahkan</font></span>";
		} else {
			$_SESSION['message'] = "<script language='javascript'>window.alert('Data Gagal ditambahkan');</script>";
		}
	}

	// metode aksi edit
	elseif ($page == 'warga' AND $act == 'edit') {
		$nik 		= addslashes(strip_tags($_POST['nik']));
		$nama 		= addslashes(strip_tags($_POST['nama_lengkap']));
		$kelahiran	= addslashes(strip_tags($_POST['tempat_lahir']));
		$tgllahir	= $_POST['tanggal_lahir'];
		$jenkel		= $_POST['jenis_kelamin'];
		$goldarah	= $_POST['golongan_darah'];
		$alamat		= addslashes(strip_tags($_POST['alamat_lengkap']));
		$agama		= $_POST['agama'];
		$status		= addslashes(strip_tags($_POST['status_kawin']));
		$kerjaan	= addslashes(strip_tags($_POST['pekerjaan']));
		$warganegara= addslashes(strip_tags($_POST['kewarganegaraan']));

		# konfigurasi untuk upload foto 
		$lokasi_file 	= $_FILES['foto']['tmp_name'];
		$nama_foto 		= $_FILES['foto']['name'];
		$tipe_file 		= $_FILES['foto']['type'];
		$nama_foto_unik = rand(00000,99999)."_".$nama_foto;
		$target_dir		= "../../uploads/img/"; //target: localhost/perekamandata/uploads/img/
		
		$query = mysql_query("
				UPDATE $table SET 
				nama_lengkap='$nama', tempat_lahir='$kelahiran', tanggal_lahir='$tgllahir', jenis_kelamin='$jenkel',
				golongan_darah='$goldarah', alamat_lengkap='$alamat', agama='$agama', status_kawin='$status',
				pekerjaan='$kerjaan', kewarganegaraan='$warganegara'
				WHERE $id='$nik'
		");

		if (!empty($lokasi_file)) {
			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
				echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
						window.location=('../../administrator.php?page=warga')</script>";
			}
			else {
				if(is_uploaded_file($lokasi_file)) {
					move_uploaded_file ($lokasi_file, $target_dir . $nama_foto_unik);
				}
				$query=mysql_query("UPDATE $table SET foto='$nama_foto_unik' WHERE $id='$nik'");
			}
		}

		if($query) {
			header('location:../../administrator.php?page='.$page);
			$_SESSION['message'] = "<span><font color=\"green\">Data berhasil diperbarui</font></span>";
		} else {
			$_SESSION['message'] = "<script language='javascript'>window.alert('Data gagal diperbarui');</script>";
		}	
	}

	// metode aksi hapus 
	elseif ($page == 'warga' AND $act == 'hapus') {	
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