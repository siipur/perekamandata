<?php

include "config/fungsi_indotgl.php";
include "config/fungsi_paging.php";
$aksi = "modul/mod_warga/aksi_warga.php";

if (isset($_SESSION['message']))
	$message = $_SESSION['message'];
else 
	$message = '';

$act = (isset($_GET['act']))?$_GET['act'] : "main";
switch($act) {
	default: // Halaman list warga
?>
		<div class="" style="padding:10px";>

			<legend><h2>List Data KTP Warga</h2></legend>
			<button><a href='?page=warga&act=tambah' class="">Tambah KTP Warga</a></button> 
			<?php print($message); unset($_SESSION["message"]);?>
			<form method='get' action="<?php echo $_SERVER['PHP_SELF'];?>" style="float:right">
				<button><a href='?page=warga' class="">Reset Pencarian</a></button> 
				<input type="hidden" name='page' value='warga'>
                <input type="text" class="" placeholder="&nbsp;cari data" name='kata'>
                <button type="submit" class="">Cari</button>
	   		</form>
	   		<div style="clearfix"></div>

			<table width="100%" style="border:1px solid; margin:10px 0px" class="">
				<thead style="background-color:grey;">
					<tr>
						<th>No.</th>
						<th>NIK</th>
						<th>Nama lengkap</th>
						<th>Tempat, tanggal lahir</th>
						<th>Jenis kelamin</th>
						<th>Agama</th>
						<th>Status perkawinan</th>
						<th>Pekerjaan</th>
						<th>Kewarganegaraan</th>
						<th>Aksi</th>
					</tr>
				</thead>
				
				<?php	
				
				################### config pagination A
				$batas=5;
				$p= new Paging;
				$posisi=$p->cariposisi($batas);

				################### algoritma pencarian berdasarkan input
					if (!empty($_GET['kata'])){
						$query = mysql_query("SELECT * FROM tbl_ktp WHERE 
							nik LIKE '%$_GET[kata]%' OR nama_lengkap LIKE '%$_GET[kata]%' OR tempat_lahir LIKE '%$_GET[kata]%' OR
							jenis_kelamin LIKE '%$_GET[kata]%' OR agama LIKE '%$_GET[kata]%' OR status_kawin LIKE '%$_GET[kata]%' OR
							pekerjaan LIKE '%$_GET[kata]%' OR kewarganegaraan LIKE '%$_GET[kata]%' ORDER BY nik 
							limit $posisi,$batas
						");
						$query_paging	= mysql_query("SELECT * FROM tbl_ktp WHERE 
							nik LIKE '%$_GET[kata]%' OR nama_lengkap LIKE '%$_GET[kata]%' OR tempat_lahir LIKE '%$_GET[kata]%' OR
							jenis_kelamin LIKE '%$_GET[kata]%' OR agama LIKE '%$_GET[kata]%' OR status_kawin LIKE '%$_GET[kata]%' OR
							pekerjaan LIKE '%$_GET[kata]%' OR kewarganegaraan LIKE '%$_GET[kata]%' ORDER BY nik
						");
					} else{ //jika pencarian sesuai
						$query 		= mysql_query("SELECT * FROM tbl_ktp ORDER BY nik limit $posisi,$batas");
						$query_paging	= mysql_query("SELECT * FROM tbl_ktp ORDER BY nik");
					}

				#################### config pagination B
				$jmldata	= mysql_num_rows($query_paging);
				$jmlhalaman = $p->jumlahHalaman($jmldata, $batas);
				$link_halaman= $p->navHalaman($_GET['halaman'],$jmlhalaman);

				$no = $posisi+1;
				while ($row = mysql_fetch_array($query)){
					//setting warna bgcolor tbody
					if($no%2 == 1) $warna="white";
					else $warna="silver";
				?>

				<tbody style="background-color:<?php echo $warna;?>">
					<tr>
						<td><?= $no++ ;?></td> 
						<td><?= $row['nik'] ;?></td>
						<td><?= $row['nama_lengkap'] ;?></td>
						<td><?= $row['tempat_lahir'] ;?>,&nbsp;<?= date_str($row['tanggal_lahir']) ;?></td>
						<td><?= $row['jenis_kelamin'] ;?></td>
						<td><?= $row['agama'] ;?></td>
						<td><?= $row['status_kawin'] ;?></td>
						<td><?= $row['pekerjaan'] ;?></td>
						<td><?= $row['kewarganegaraan'] ;?></td>
						<td>
							<a href="?page=warga&act=edit&id=<?=$row['nik'];?>" class="" id="">EDIT</a> &nbsp;
							<a href="?page=warga&act=detail&id=<?=$row['nik'];?>" class='' id=''>Lihat Detail</a> &nbsp;
							<a href="<?php echo $aksi;?>?page=warga&act=hapus&id=<?=$row['nik'];?>" class='' id='' onclick="return confirm('Yakin Akan Hapus Data <?=$row['nik'];?> ?')">HAPUS</a>
						</td>
					</tr>
				</body>

				<?php
				}
				?>
			</table>
			<?php
			echo "<p>$link_halaman</p>";  //cetak link pagination
			?>
		</div>

	<?php
	break;	
	?>

	<?php
	case "tambah": // Halaman tambah warga
	?>
		<div class="" style="padding:10px";>
			<legend><h2>Formulir Tambah Data Warga</h2></legend>
			<form method="POST" action='<?php echo "$aksi?page=warga&act=tambah";?>' enctype='multipart/form-data' class="" id="">
				<label>NIK :</label><br/>
					<input type="text" name='nik' class="" id="" required /><br/>
				<label>Nama Lengkap :</label><br/>          
					<input type="text" name='nama_lengkap' class="" id="" required /><br/>
				<label>Tempat Lahir :</label><br/>     
					<input type="text" name='tempat_lahir' class="" id="" required /><br/>
				<label>Tanggal Lahir :</label><br/>      
					<input type="date" name='tanggal_lahir' class="" id="" required /><br/>
				<label>Jenis Kelamin :</label> <br/>         
					<input type="radio" name='jenis_kelamin' value="Laki-laki" class="" id="" /> Laki-Laki
					<input type="radio" name='jenis_kelamin' value="Perempuan" class="" id="" /> Perempuan<br/>
				<label>Golongan darah :</label> <br/>         
					<input type="text" name='golongan_darah' class="" id="" required /><br/>
				<label>Alamat Lengkap :</label> <br/>         
					<textarea name='alamat_lengkap' cols="30" rows="5" class="" id=""/></textarea><br/>
				<label>Agama :</label><br/>         
					<select name="agama" required>
						<option value="">-- Pilih Agama --</option>
						<option value="islam">ISLAM</option>
						<option value="budha">BUDHA</option>
						<option value="hindu">HINDU</option>
						<option value="kristen">KRISTEN</option>
						<option value="katolik">KATOLIK</option>
					</select><br/>
				<label>Status Perkawinan :</label><br/>
					<input type="text" name='status_kawin' class="" id="" required /><br/>
				<label>Pekerjaan :</label><br/>
					<input type="text" name='pekerjaan' class="" id="" required /><br/>
				<label>Kewarganegaraan :</label><br/>
					<input type="text" name='kewarganegaraan' class="" id="" required /><br/>
				<label>Foto :</label><br/>
					<input type="file" name='foto' class="" id=""/><br/><br/>
				<button type="submit" class="" id="">Simpan</button>
				<button type="reset" class="" id="">Reset</button>
				<button type="" class="" id="" onclick=self.history.back()>Batal</button>	
			</form>
		</div>
	<?php
	break;
	?>
	
	<?php
	case "edit": // Halaman edit warga
		$id = $_GET['id'];
		$query = mysql_query("SELECT * FROM tbl_ktp WHERE nik='$id'");
		$row = mysql_fetch_array($query);
	?>
		<div class="" style="padding:10px";>
			<legend><h2>Formulir Edit KTP Warga</h2></legend>
			<form method="POST" action='<?php echo "$aksi?page=warga&act=edit";?>' enctype='multipart/form-data' class="" id="">
				<label>NIK :</label><br/>
					<input type="text" name='nik' class="" id="" value='<?php echo "$row[nik]"; ?>' readonly="readonly"/><br/>
				<label>Nama Lengkap :</label><br/>          
					<input type="text" name='nama_lengkap' value='<?php echo "$row[nama_lengkap]";?>' class="" id="" required /><br/>
				<label>Tempat Lahir :</label><br/>     
					<input type="text" name='tempat_lahir' value='<?php echo "$row[tempat_lahir]";?>' class="" id="" required /><br/>
				<label>Tanggal Lahir :</label><br/>      
					<input type="date" name='tanggal_lahir' value='<?php echo "$row[tanggal_lahir]";?>' class="" id="" required /><br/>
				<label>Jenis Kelamin :</label> <br/>         
					<input type="radio" name='jenis_kelamin' value="Laki-laki" <?php if($row['jenis_kelamin']=='Laki-laki'){echo "checked";} ?> class="" id="" /> Laki-Laki
					<input type="radio" name='jenis_kelamin' value="Perempuan" <?php if($row['jenis_kelamin']=='Perempuan'){echo "checked";} ?> class="" id="" /> Perempuan<br/>
				<label>Golongan darah :</label> <br/>         
					<input type="text" name='golongan_darah' value='<?php echo "$row[golongan_darah]";?>' class="" id=""/><br/>
				<label>Alamat Lengkap :</label> <br/>         
					<textarea name='alamat_lengkap' class="" id="" cols="30" rows="5"/><?php echo "$row[alamat_lengkap]";?></textarea><br/>
				<label>Agama :</label><br/>         
					<select name="agama" required>
						<option value='<?php echo "$row[agama]";?>' selected><?php echo "$row[agama]";?></option>
						<option value="islam">ISLAM</option>
						<option value="budha">BUDHA</option>
						<option value="hindu">HINDU</option>
						<option value="kristen">KRISTEN</option>
						<option value="katolik">KATOLIK</option>
					</select><br/>
				<label>Status Perkawinan :</label><br/>
					<input type="text" name='status_kawin' value='<?php echo "$row[status_kawin]";?>' class="" id="" required /><br/>
				<label>Pekerjaan :</label><br/>
					<input type="text" name='pekerjaan' value='<?php echo "$row[pekerjaan]";?>' class="" id="" required /><br/>
				<label>Kewarganegaraan :</label><br/>
					<input type="text" name='kewarganegaraan' value='<?php echo "$row[kewarganegaraan]";?>' class="" id="" required /><br/>
				
				<label>Foto :</label><br/>
					<img src="uploads/img/<?php print_r($row['foto']);?>" width="150px" height="200px" alt="foto profile"/><br/>
					Ganti Foto <input type="file" name='foto' class="" id=""/><br/><br/>

				<button type="submit" class="" id="">Update</button>
				<a href="administrator.php?page=warga"class="" id="">Batal</a>
			</form>
		</div>

	<?php
	break;
	?>

	<?php
	case "detail"; //Halaman lihat detail
		$id = $_GET['id'];
		$query = mysql_query("SELECT * FROM tbl_ktp WHERE nik='$id'");
		$row = mysql_fetch_array($query);
	?>
		<div class="" style="padding:10px";>
			<legend><h2>Informasi detail</h2></legend>
			<table width="100%" style="border:1px solid; margin:10px 0px; padding:7px" class="">
				<tr><td>NIK</td><td>:</td><td><?= $row['nik'] ;?></td></tr>
				<tr><td>Nama lengkap</td><td>:</td><td><?= $row['nama_lengkap'] ;?></td></tr>
				<tr><td>Tempat lahir</td><td>:</td><td><?= $row['tempat_lahir'] ;?></td></tr>
				<tr><td>Tanggal lahir</td><td>:</td><td><?= date_str($row['tanggal_lahir']) ;?></td></tr>
				<tr><td>Jenis kelamin</td><td>:</td><td><?= $row['jenis_kelamin'] ;?></td></tr>
				<tr><td>Golongan darah</td><td>:</td><td><?= $row['golongan_darah'] ;?></td></tr>
				<tr><td>Alamat lengkap</td><td>:</td><td><?= $row['alamat_lengkap'] ;?></td></tr>
				<tr><td>Agama</td><td>:</td><td><?= $row['agama'] ;?></td></tr>
				<tr><td>Status perkawinan</td><td>:</td><td><?= $row['status_kawin'] ;?></td></tr>
				<tr><td>Pekerjaan</td><td>:</td><td><?= $row['pekerjaan'] ;?></td></tr>
				<tr><td>Kewarganegaraan</td><td>:</td><td><?= $row['kewarganegaraan'] ;?></td></tr>
				<tr><td>Foto Profile</td><td>:</td>
					<td>
						<img src="uploads/img/<?php echo $row['foto'];?>" width="150px" height="200px" alt="foto profile"/><br/>
					</td>
				</tr>		
			</table>
			<button class="" id="" onclick=self.history.back()>Kembali</button>
			<button><a href="modul/mod_warga/cetak.php?&id=<?=$id;?>" target='_blank'>Cetak</a></button>
		</div>

	<?php 
	break;
	?>

<?php
}
?>