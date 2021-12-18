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
$date1=date_create("{$d['tgl_mulai']}");
$date2=date_create("{$d['tgl_akhir']}");
$diff=date_diff($now,$date2);
$sisa_waktu=$diff->format("%a hari");

?>
<a href="?mod=proyek_lihat">back</a><br>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Progres Administrasi</strong></strong></div>
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
<!-- <a href="?mod=proyek_lihat">back
		</a><br>
<div class="alert alert-success" role="alert">
	<h4 class="tengah"><strong>ADMINISTRASI</strong></h4>
</div> -->
<table class="table table-bordered">
	<thead>
		<th class="tengah">SEGMENT</th>
		<th class="tengah">JENIS</th>
		<th class="tengah">SOW</th>
		<th class="tengah">PROGRESS</th>
		<th class="tengah">PRESENTASE</th>
		<th class="tengah">DOKUMEN</th>
		<th class="tengah">REMARK</th>
	</thead>
	<tbody>
<?php
$num_rec_per_page=5;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $num_rec_per_page;

$q = "SELECT * FROM administrasi WHERE id_proyek=$id_proyek
		LIMIT $start_from, $num_rec_per_page;";
$r = mysql_query($q);
while ($d = mysql_fetch_assoc($r)) {
	$id_administrasi = $d['id_administrasi'];

	$q_pro = "SELECT
					SUM(abd_p)abd_p,
					SUM(boq_p)boq_p,
					SUM(dokumen_atp_p)dokumen_atp_p,
					SUM(dokumen_otdr_p)dokumen_otdr_p
				FROM administrasi_update WHERE id_administrasi=$id_administrasi
				GROUP BY id_administrasi;";
	$r_pro = mysql_query($q_pro);
	$d_pro = mysql_fetch_assoc($r_pro);

	$q_re = "SELECT * FROM administrasi_update WHERE id_administrasi=$id_administrasi ORDER BY id_administrasi_update DESC;";
	$r_re = mysql_query($q_re);
	$d_re = mysql_fetch_assoc($r_re);
?>
		<tr>
			<td align="center" rowspan="4"><?php echo($d['no_segment']); ?></td>
			<td align="center">ABD</td>
			<td align="center"><?php echo($d['abd']); ?></td>
			<td align="center"><?php echo($d_pro['abd_p']); ?></td>
			<td align="center"><?php echo($d_pro['abd_p']/$d['abd']*100); ?>%</td>
			<td align="center">
<?php
	if ($d_re['abd_d']!="") {
?>
				<a href="<?php echo($d_re['abd_d']); ?>" download>
					<button type="button" class="btn btn-primary btn-sm">download</button>
				</a>
<?php
	}
?>
			</td>
			<td align="center"><?php echo($d_re['abd_r']); ?></td>
		</tr>
		<tr>
			<td align="center">BOQ</td>
			<td align="center"><?php echo($d['boq']); ?></td>
			<td align="center"><?php echo($d_pro['boq_p']); ?></td>
			<td align="center"><?php echo($d_pro['boq_p']/$d['boq']*100); ?>%</td>
			<td align="center">
<?php
	if ($d_re['boq_d']!="") {
?>
				<a href="<?php echo($d_re['boq_d']); ?>" download>
					<button type="button" class="btn btn-primary btn-sm">download</button>
				</a>
<?php
	}
?>
			</td>
			<td align="center"><?php echo($d_re['boq_r']); ?></td>
		</tr>
		<tr>
			<td align="center">Dokumen ATP</td>
			<td align="center"><?php echo($d['dokumen_atp']); ?></td>
			<td align="center"><?php echo($d_pro['dokumen_atp_p']); ?></td>
			<td align="center"><?php echo($d_pro['dokumen_atp_p']/$d['dokumen_atp']*100); ?>%</td>
			<td align="center">
<?php
	if ($d_re['dokumen_atp_d']!="") {
?>
				<a href="<?php echo($d_re['dokumen_atp_d']); ?>" download>
					<button type="button" class="btn btn-primary btn-sm">download</button>
				</a>
<?php
	}
?>
			</td>
			<td align="center"><?php echo($d_re['dokumen_atp_r']); ?></td>
		</tr>
		<tr>
			<td align="center">Dokumen OTDR</td>
			<td align="center"><?php echo($d['dokumen_otdr']); ?></td>
			<td align="center"><?php echo($d_pro['dokumen_otdr_p']); ?></td>
			<td align="center"><?php echo($d_pro['dokumen_otdr_p']/$d['dokumen_otdr']*100); ?>%</td>
			<td align="center">
<?php
	if ($d_re['dokumen_otdr_d']!="") {
?>
				<a href="<?php echo($d_re['dokumen_otdr_d']); ?>" download>
					<button type="button" class="btn btn-primary btn-sm">download</button>
				</a>
<?php
	}
?>
			</td>
			<td align="center"><?php echo($d_re['dokumen_otdr_r']); ?></td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<?php
$sql = "SELECT * FROM administrasi WHERE id_proyek=$id_proyek;";
$rs_result = mysql_query($sql); //run the query
$total_records = mysql_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
echo "<a href='?mod=proyek_lihat_administrasi&id_proyek={$_GET['id_proyek']}&page=1'>".'|<'."</a> "; // Goto 1st page  

for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?mod=proyek_lihat_administrasi&id_proyek={$_GET['id_proyek']}&page=".$i."'>".$i."</a> "; 
}; 
echo "<a href='?mod=proyek_lihat_administrasi&id_proyek={$_GET['id_proyek']}&page=$total_pages'>".'>|'."</a> "; // Goto last page
?>