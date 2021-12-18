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
	<div class="panel-heading"><strong>Progres Civil</strong></strong></div>
	<div class="panel-body">
<table class="table table-bordered" width="100%">
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

<!-- <div class="alert alert-success" role="alert">
	<h4 class="tengah"><strong>CIVIL</strong></h4>
</div> -->
<table class="table table-bordered">
	<thead>
		<th class="tengah">SEGMENT</th>
		<th class="tengah">NAMA SEGMENT</th>
		<th class="tengah">BOBOT</th>
		<th class="tengah">SOW</th>
		<th class="tengah">PROGRESS</th>
		<th class="tengah">PRESENTASE</th>
		<th class="tengah">REMARK</th>
		<th class="tengah">KARYAWAN</th>
	</thead>
	<tbody>
<?php
$q = "SELECT * FROM civil_bobot WHERE id_proyek=$id_proyek;";
$r = mysql_query($q);
$d_cj = mysql_fetch_assoc($r);

$num_rec_per_page=5;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $num_rec_per_page;

$q = "SELECT * FROM civil_segment WHERE id_proyek=$id_proyek ORDER BY no_segment ASC
		LIMIT $start_from, $num_rec_per_page;";
$r = mysql_query($q);
while ($d = mysql_fetch_assoc($r)) {
	$sow_trenching = $d['trenching'];
	$sow_jembatan  = $d['jembatan'];
	$sow_joinbox   = $d['joinbox'];
	$sow_pulling   = $d['pulling'];
	$sow_splicing  = $d['splicing'];
	$sow_atp       = $d['atp'];
	$id_civil_segment = $d['id_civil_segment'];

	$q_update = "SELECT 
					sum(trenching_p)trenching_p,
					sum(jembatan_p)jembatan_p,
					sum(joinbox_p)joinbox_p,
					sum(pulling_p)pulling_p,
					sum(splicing_p)splicing_p,
					sum(atp_p)atp_p
				FROM civil_segment_update WHERE id_civil_segment=$id_civil_segment GROUP BY id_civil_segment;";
	$r_update = mysql_query($q_update);
	$d_update = mysql_fetch_assoc($r_update);
	$trenching_p = $d_update['trenching_p'];
	$jembatan_p = $d_update['jembatan_p'];
	$joinbox_p = $d_update['joinbox_p'];
	$pulling_p = $d_update['pulling_p'];
	$splicing_p = $d_update['splicing_p'];
	$atp_p = $d_update['atp_p'];

	//presentase
	$pre_trenching = ($trenching_p/$sow_trenching)*$d_cj['trenching'];
	if ($pre_trenching=="") {
		$pre_trenching=0;
	}

	$pre_jembatan = ($jembatan_p/$sow_jembatan)*$d_cj['jembatan'];
	if ($pre_jembatan=="") {
		$pre_jembatan=0;
	}

	$pre_joinbox = ($joinbox_p/$sow_joinbox)*$d_cj['joinbox'];
	$pre_pulling = ($pulling_p/$sow_pulling)*$d_cj['pulling'];
	$pre_splicing = ($splicing_p/$sow_splicing)*$d_cj['splicing'];
	$pre_atp = ($atp_p/$sow_atp)*$d_cj['atp'];

	$presentase = $pre_trenching + $pre_jembatan + $pre_joinbox + $pre_pulling + $pre_splicing + $pre_atp;

	$q_rm = "SELECT a.*,b.nama FROM civil_segment_update a
				LEFT JOIN user b ON a.id_user = b.id_user
				WHERE a.id_civil_segment=$id_civil_segment ORDER BY a.id_civil_segment_update DESC;";
	$r_rm = mysql_query($q_rm);
	$d_rm = mysql_fetch_assoc($r_rm);
?>
		<tr class="warning">
			<td align="center" rowspan="7"><?php echo($d['no_segment']); ?></td>
			<td><?php echo($d['nama_segment']); ?></td>
			<td></td>
			<td></td>
			<td></td>
			<td align="center"><?php echo(intval($presentase)); ?>%</td>
			<td></td>
			<td align="center" rowspan="7"><?php echo($d_rm['nama']); ?></td>
		</tr>
		<tr>
			<td>TRENCHING</td>
			<td align="center"><?php echo($d_cj['trenching']); ?>%</td>
			<td align="center"><?php echo($sow_trenching); ?></td>
			<td align="center"><?php echo($trenching_p); ?></td>
			<td align="center"><?php echo(intval($pre_trenching)); ?>%</td>
			<td align="center"><?php echo($d_rm['trenching_r']); ?></td>
		</tr>
		<tr>
			<td>JEMBATAN</td>
			<td align="center"><?php echo($d_cj['jembatan']); ?>%</td>
			<td align="center"><?php echo($sow_jembatan); ?></td>
			<td align="center"><?php echo($jembatan_p); ?></td>
			<td align="center"><?php echo(intval($pre_jembatan)); ?>%</td>
			<td align="center"><?php echo($d_rm['jembatan_r']); ?></td>
		</tr>
		<tr>
			<td>JOINTBOX</td>
			<td align="center"><?php echo($d_cj['joinbox']); ?>%</td>
			<td align="center"><?php echo($sow_joinbox); ?></td>
			<td align="center"><?php echo($joinbox_p); ?></td>
			<td align="center"><?php echo(intval($pre_joinbox)); ?>%</td>
			<td align="center"><?php echo($d_rm['joinbox_r']); ?></td>
		</tr>
		<tr>
			<td>PULLING</td>
			<td align="center"><?php echo($d_cj['pulling']); ?>%</td>
			<td align="center"><?php echo($sow_pulling); ?></td>
			<td align="center"><?php echo($pulling_p); ?></td>
			<td align="center"><?php echo(intval($pre_pulling)); ?>%</td>
			<td align="center"><?php echo($d_rm['pulling_r']); ?></td>
		</tr>
		<tr>
			<td>SPLICING</td>
			<td align="center"><?php echo($d_cj['splicing']); ?>%</td>
			<td align="center"><?php echo($sow_splicing); ?></td>
			<td align="center"><?php echo($splicing_p); ?></td>
			<td align="center"><?php echo(intval($pre_splicing)); ?>%</td>
			<td align="center"><?php echo($d_rm['splicing_r']); ?></td>
		</tr>
		<tr>
			<td>ATP</td>
			<td align="center"><?php echo($d_cj['atp']); ?>%</td>
			<td align="center"><?php echo($sow_atp); ?></td>
			<td align="center"><?php echo($atp_p); ?></td>
			<td align="center"><?php echo(intval($pre_atp)); ?>%</td>
			<td align="center"><?php echo($d_rm['atp_r']); ?></td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<?php
$sql = "SELECT * FROM civil_segment WHERE id_proyek=$id_proyek ORDER BY no_segment ASC;";
$rs_result = mysql_query($sql); //run the query
$total_records = mysql_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page); 
echo "<a href='?mod=proyek_lihat_civil&id_proyek={$_GET['id_proyek']}&page=1'>".'|<'."</a> "; // Goto 1st page  

for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='?mod=proyek_lihat_civil&id_proyek={$_GET['id_proyek']}&page=".$i."'>".$i."</a> "; 
}; 
echo "<a href='?mod=proyek_lihat_civil&id_proyek={$_GET['id_proyek']}&page=$total_pages'>".'>|'."</a> "; // Goto last page
?>