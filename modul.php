<?php

//error_reporting(0);
//session_start();
$nik = $_SESSION['nik'];
$nama = $_SESSION['nama'];
$hak_akses = $_SESSION['hak_akses'];
$mod = $_GET['mod'];

//admin
if ($mod == 'karyawan') {
	include 'karyawan.php';
}
elseif ($mod == 'data_proyek' && $hak_akses == '1') {
	include 'data_proyek.php';
}
elseif ($mod == 'proyek_lihat' && $hak_akses != ''){
	include 'proyek_lihat.php';
}
elseif ($mod == 'proyek_lihat_civil' && $hak_akses != ''){
	include 'proyek_lihat_civil.php';
}
elseif ($mod == 'proyek_lihat_permit' && $hak_akses != ''){
	include 'proyek_lihat_permit.php';
}
elseif ($mod == 'proyek_lihat_administrasi' && $hak_akses != ''){
	include 'proyek_lihat_administrasi.php';
}
elseif ($mod == 'proyek_daftar' && $hak_akses != ''){
	include 'proyek_daftar.php';
}
elseif ($mod == 'proyek_daftar_karyawan' && $hak_akses != ''){
	include 'proyek_daftar_karyawan.php';
}
elseif ($mod == 'proyek_arsip' && $hak_akses != ''){
	include 'proyek_arsip.php';
}
elseif ($mod == 'update' && $hak_akses != ''){
	include 'update.php';
}
elseif ($mod == 'update_civil' && $hak_akses != ''){
	include 'update_civil.php';
}
elseif ($mod == 'update_permit' && $hak_akses != ''){
	include 'update_permit.php';
}
elseif ($mod == 'update_administrasi' && $hak_akses != ''){
	include 'update_administrasi.php';
}
elseif ($mod == 'view_data_proyek' && $hak_akses != ''){
	include 'view_data_proyek.php';
}
elseif ($mod == 'view_karyawan' && $hak_akses != ''){
	include 'view_karyawan.php';
}
elseif ($hak_akses != '') {
?>
<p>
	Hi <strong><?php echo $nama; ?></strong>
	, Selamat Datang di Sistem Monitoring Progress.
	Silahkan pilih menu pada navigasi di atas.
</p>
<br><br>
<?php include 'peringatan.php';?>
<?php
include 'dashboard.php';
}
else{
	include 'login.php';
}
// elseif{
// 	include 'peringatan.php';
// }
?>
