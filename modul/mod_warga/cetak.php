<?php
 
require_once("../../third_party/dompdf/dompdf_config.inc.php");
define('DOMPDF_ENABLE_AUTOLOAD', false);

include "../../config/koneksi.php";
include "../../config/fungsi_indotgl.php";

$id = $_GET['id'];
$query = mysql_query("SELECT * FROM tbl_ktp WHERE nik='$id'");
$row = mysql_fetch_array($query);

$nik 			= $id;
$nama_lengkap	= $row['nama_lengkap'];
$tempat_lahir	= $row['tempat_lahir'];
$tanggal_lahir	= date_str($row['tanggal_lahir']);
$jenis_kelamin	= $row['jenis_kelamin'];
$golongan_darah	= $row['golongan_darah'];
$alamat 		= $row['alamat_lengkap'];
$agama 			= $row['agama'];
$status_kawin	= $row['status_kawin'];
$pekerjaan 		= $row['pekerjaan'];
$warganegara	= $row['kewarganegaraan'];
$foto 			= $row['foto'];

$html =
'<html>'.
'<head>'.
'<title>cetak data warga</title>'.
'<style type=\"text/css\" rel=\"stylesheet\">'.
'.data table {border-collapse:collapse;width:100%;} .data table, .data th, .data td {border:1px solid;}'.
'.data th {background-color: silver;}h3{text-align:center;}'.
'</style>'.
'</head>'.
'<body>'.
'<header>
		<table>
		<tr><td><img src="../../assets/img/header.png" width="280px" height="80px"alt="logo" /></td>
		<td><small><b>Aplikasi Pendataan Warga</b><br/>
		<br/>
		Jl. Rumah Masa Depan, Indonesia<br/>
		Telp :  +6285719858022, Email   :  didi.songhopur@gmail.com</small></td></tr>
		</table>
</header>'.
'<hr/>'.
'<div class="" style="padding:10px";>

	<legend><h2>Informasi detail</h2></legend>
	<table width="100%" style="border:1px solid; margin:10px 0px; padding:7px" class="">
		<tr><td>NIK</td><td>:</td><td>'.$nik.'</td></tr>
		<tr><td>Nama lengkap</td><td>:</td><td>'.$nama_lengkap.'</td></tr>
		<tr><td>Tempat lahir</td><td>:</td><td> '.$tempat_lahir.' </td></tr>
		<tr><td>Tanggal lahir</td><td>:</td><td> '.$tanggal_lahir.' </td></tr>
		<tr><td>Jenis kelamin</td><td>:</td><td> '.$jenis_kelamin.'</td></tr>
		<tr><td>Golongan darah</td><td>:</td><td> '.$golongan_darah.' </td></tr>
		<tr><td>Alamat lengkap</td><td>:</td><td> '.$alamat.' </td></tr>
		<tr><td>Agama</td><td>:</td><td> '.$agama.' </td></tr>
		<tr><td>Status perkawinan</td><td>:</td><td> '.$status_kawin.'</td></tr>
		<tr><td>Pekerjaan</td><td>:</td><td> '.$pekerjaan.' </td></tr>
		<tr><td>Kewarganegaraan</td><td>:</td><td> '.$warganegara.'</td></tr>		
		<tr><td>Foto Profile</td><td>:</td><td><img src="../../uploads/img/'.$foto.'" width="150px" height="200px" alt="foto profile"/></td></tr>
	</table>
</div>'.

'</body></html>';
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream('biodata_detail_'.$nik.'.pdf', array("Attachment"=>0));

/*
Class PdfGenerator{
	public function generate($html,$filename) {
		define('DOMPDF_ENABLE_AUTOLOAD', false);
		require_once(APPPATH . 'third_party/dompdf/dompdf_config.inc.php');
		$dompdf = new DOMPDF('L','cm'.'A4');
		$dompdf->load_html($html);
		$dompdf->render();
		$dompdf->stream($filename.'.pdf',array("Attachment"=>0));
	}
}
*/
 
?>