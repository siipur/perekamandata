<?php

$aksi = "modul/mod_user/aksi_user.php";

if (isset($_SESSION['message']))
	$message = $_SESSION['message'];
else 
	$message = '';

$act = (isset($_GET['act']))?$_GET['act'] : "main";
switch($act) {
	default: // Halaman list user
?>
		<div class="" style="padding:10px";>
			<legend><h2>List Data User</h2></legend>
			<button><a href='?page=user&act=tambah' class="">Tambah User</a></button> 
			<?php print($message); unset($_SESSION["message"]);?>
			<table width="100%" style="border:1px solid; margin:10px 0px" class="">
				<thead style="background-color:grey;">
					<tr>
						<th>No.</th>
						<th>id User</th>
						<th>Nama User</th>
						<th>Username</th>
						<th>Password</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
			<?php
			$query = mysql_query("SELECT * FROM tbl_user");
			$no = 1;	
			while ($row = mysql_fetch_array($query)){
				//setting warna bgcolor tbody
				if($no%2 == 1) $warna="white";
				else $warna="silver";
				echo "
				<tbody style=\"background-color:$warna\">
					<tr>
						<td>$no</td>
						<td>$row[user_id]</td>
						<td>$row[nama_user]</td>
						<td>$row[username]</td>
						<td>$row[password]</td>
						<td>$row[status]</td>
						<td>
							<a href='?page=user&act=edit&id=$row[user_id]' class='' id=''>EDIT</a> &nbsp;
							<a href='$aksi?page=user&act=hapus&id=$row[user_id]' class='' id='' onclick=\"return confirm('Yakin Akan Hapus Data $row[user_id]?')\">HAPUS</a>
						</td>
					</tr>
				</body>
				";
				$no++;
			}	
		?>
			</table>
		</div>
	<?php
	break;	
	?>

	<?php
	case "tambah": // Halaman tambah user
	?>
		<div class="" style="padding:10px";>
			<legend><h2>Formulir Tambah User</h2></legend>
			<form method="POST" action='<?php echo "$aksi?page=user&act=tambah";?>' class="" id="">
				<label>Kode User :</label>          
					<input type="text" name='user_id' class="" id="" required /><br/>
				<label>Nama User :</label>          
					<input type="text" name='nama_user' class="" id="" required /><br/>
				<label>Username :</label>          
					<input type="text" name='username' class="" id="" required /><br/>
				<label>Password :</label>          
					<input type="text" name='password' class="" id="" required /><br/>
				<label>Status (Hak Akses):</label>
					<select name="status" class="" id="" required>
						<option value="">-- Pilih status --</option>
						<option value="admininstrator">administrator</option>
						<option value="operator">operator</option>
						<option value="warga">warga</option>
					</select><br/>          
				<button type="submit" class="" id="">Simpan</button>
				<button type="reset" class="" id="">Reset</button>
				<button type="" class="" id="" onclick=self.history.back()>Batal</button>	
			</form>
		</div>
	<?php
	break;
	?>
	
	<?php
	case "edit": // Halaman edit user
		$id = $_GET['id'];
		$query = mysql_query("SELECT * FROM tbl_user WHERE user_id='$id'");
		$row = mysql_fetch_array($query);
	?>
		<div class="" style="padding:10px";>
			<legend><h2>Formulir Edit User</h2></legend>
			<form method="POST" action='<?php echo "$aksi?page=user&act=edit";?>' class="" id="">
				<label>Kode User :</label>
					<!-- <input type="hidden" name='user_id'/> -->       
					<input type="text" name='user_id' class="" id="" readonly="readonly" value='<?php echo "$row[user_id]"; ?>' /><br/>
				<label>Nama User :</label>          
					<input type="text" name='nama_user' class="" id="" value='<?php echo "$row[nama_user]"; ?>' /><br/>
				<label>Username :</label>          
					<input type="text" name='username' class="" id="" value='<?php echo "$row[username]"; ?>' /><br/>
				<label>Password :</label>          
					<input type="text" name='password' class="" id="" value='<?php echo "$row[password]"; ?>' /><br/>
				<label>Status (Hak Akses):</label>
					<select name="status" class="" id="" required>
						<option value='<?php echo "$row[status]"; ?>'><?= $row['status'];?></option>
						<option value="admininstrator">administrator</option>
						<option value="operator">operator</option>
						<option value="warga">warga</option>
					</select><br/>          
				<button type="submit" class="" id="">Update</button>
				<a href="administrator.php?page=user"class="" id="">Batal</a>
			</form>
		</div>

	<?php
	break;
	?>
	
<?php
}
?>