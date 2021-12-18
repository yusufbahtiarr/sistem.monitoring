<?php
$id_proyek = $_GET['id_proyek'];

$q = "SELECT * FROM proyek WHERE id_proyek=$id_proyek";
$r = mysql_query($q);
$d = mysql_fetch_assoc($r);

$now = date("Y-m-d"); // or your date as well
$now = date_create($now);
$tgl_mulai = date_create("{$d['tgl_mulai']}");
if ($d['nama_waktu']=="tahun") {
	$days = 365 * $d['jangka_waktu'];
	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
}
elseif ($d['nama_waktu']=="bulan") {
	$days = 30 * $d['jangka_waktu'];
	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
}
elseif ($d['nama_waktu']=="minggu") {
	$days = 7 * $d['jangka_waktu'];
	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
}
elseif ($d['nama_waktu']=="hari") {
	$days = $d['jangka_waktu'];
	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
}

?>
<a href="?mod=proyek_lihat">back</a><br>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Progres Permit</strong></strong></div>
	<div class="panel-body">
<table class="form" width="100%">
	<tr>
		<td align="right">Operator</td>
		<td><?php echo($d['operator']); ?></td>
	</tr>
	<tr>
		<td align="right">Nama Proyek</td>
		<td><?php echo($d['nama_proyek']); ?></td>
	</tr>
	<tr>
		<td align="right">Tanggal Akhir</td>
		<td><?php echo($d['tgl_akhir']); ?></td>
	</tr>
	<?php
$date1=date_create("{$d['tgl_mulai']}");
$date2=date_create("{$d['tgl_akhir']}");
$diff=date_diff($now,$date2);
$sisa_waktu=$diff->format("%a hari");
?>
	<tr>
		<td align="right">Sisa Waktu</td>
		<td><?php echo($sisa_waktu); ?></td>
	</tr>

<!-- <

<?php
$tgl_akhir = strtotime(date_format($tgl_akhir,"Y-m-d"));
$now = strtotime(date_format($now,"Y-m-d"));
$sisa_waktu = $tgl_akhir - $now;
$sisa_waktu = floor($sisa_waktu/(60*60*24));
?>
	<tr>
		<td align="right">Sisa Waktu</td>
		<td><?php echo($sisa_waktu); ?> hari</td>
	</tr> -->
</table>
<br>
</table>
<br>
<br>
<!-- <br><a href="?mod=proyek_lihat">back
		</a><br>
<div class="alert alert-success" role="alert">
	<h4 class="tengah"><strong>PERMIT</strong></h4>
</div> -->
<table class="table table-bordered" id="example">
	<thead>
		<th class="center">IZIN</th>
		<th class="center">WILAYAH</th>
		<th class="center">SOW</th>
		<th class="center">PROGRESS</th>
		<th class="center">PRESENTASE</th>
		<th class="center">DOKUMEN</th>
		<th class="center">REMARK</th>
	</thead>
	<tbody>
<?php
$q = "SELECT * FROM permit WHERE id_proyek=$id_proyek;";
$r = mysql_query($q);
while ($d = mysql_fetch_assoc($r)) {
	$id_permit = $d['id_permit'];
	$q_pro = "SELECT SUM(progress)progress FROM permit_update WHERE id_permit=$id_permit GROUP BY progress;";
	$r_pro = mysql_query($q_pro);
	$d_pro = mysql_fetch_assoc($r_pro);
	$presentase = $d_pro['progress']/$d['sow']*100;

	$q_update = "SELECT * FROM permit_update WHERE id_permit=$id_permit ORDER BY id_permit_update DESC";
	$r_update = mysql_query($q_update);
	$d_update = mysql_fetch_assoc($r_update);
?>
		<tr>
			<td align="center"><?php echo($d['izin']); ?></td>
			<td align="center"><?php echo($d['wilayah']); ?></td>
			<td align="center"><?php echo($d['sow']); ?></td>
			<td align="center"><?php echo($d_pro['progress']); ?></td>
			<td align="center"><?php echo($presentase); ?>%</td>
			<td align="center">
<?php
	if ($d_update['dokumen']!='') {
?>
				<a href="<?php echo($d_update['dokumen']); ?>" download>
					<button type="button" class="btn btn-primary btn-sm">download</button>
				</a>
<?php
	}
?>
			</td>
			<td align="center"><?php echo($d_update['remark']); ?></td>
		</tr>
<?php
}
?>
	</tbody>
</table>