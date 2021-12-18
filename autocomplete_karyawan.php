<?php
include 'dbconnection.php';
$q = "SELECT a.*,b.keterangan FROM user a INNER JOIN akses b ON a.hak_akses=b.hak_akses WHERE a.nik LIKE '%".$_GET['nik']."%';";
$r = mysql_query($q);
while ($d=mysql_fetch_assoc($r)) {
	$id_user = $d['id_user'];
	$nik = $d['nik'];
	$nama = $d['nama'];
	$keterangan = $d['keterangan'];
	$set_item = $_GET['id']."-".$id_user."-".$nik."-".$nama."-".$keterangan;
	$show =  $nik." - ".$nama." - ".$keterangan;
?>
<li>
	<button type="button" onclick="set_item('<?php echo ($set_item); ?>')" class="btn btn-default btn-xs form-control"><?php echo($show); ?></button>
</li>
<?php
}
?>