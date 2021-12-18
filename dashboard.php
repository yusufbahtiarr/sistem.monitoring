<!--<img src="images/permit.png">:permit &nbsp &nbsp &nbsp <img src="images/civil.png">:civil &nbsp &nbsp &nbsp <img src="images/administrasi.png">:administrasi &nbsp &nbsp &nbsp <img src="images/waktu.png">:waktu terpakai
-->

<div class="tengah">
	<h3><strong>GLOBAL REPORT</strong></h3>
	<br>
</div>
<?php 
$q = "SELECT * FROM proyek WHERE status='ON PROGRESS';";
$r_proyek = mysql_query($q);
$i=1;
while ($d_proyek = mysql_fetch_assoc($r_proyek)) {
	$id_proyek=$d_proyek['id_proyek'];
	$nama_proyek.="'".$d_proyek["nama_proyek"]."',";
	$tingkat_kesulitan.="'".$d_proyek["tingkat_kesulitan"]."',";
	//permit
	$q = "SELECT * FROM permit WHERE id_proyek=$id_proyek;";
	$r_permit = mysql_query($q);
	$presentase=0;
	$no=0;
	while ($d_permit = mysql_fetch_assoc($r_permit)) {
		$id_permit = $d_permit['id_permit'];
		$q_pro = "SELECT SUM(progress)progress FROM permit_update WHERE id_permit=$id_permit GROUP BY progress;";
		$r_pro = mysql_query($q_pro);
		$d_pro = mysql_fetch_assoc($r_pro);
		$presentase += $d_pro['progress']/$d_permit['sow']*100;
		$no++;
	}
	$permit.="'".$presentase/$no."',";

	//civil
	$q = "SELECT * FROM civil_bobot WHERE id_proyek=$id_proyek;";
	$r_cj = mysql_query($q);
	$d_cj = mysql_fetch_assoc($r_cj);

	$q = "SELECT * FROM civil_segment WHERE id_proyek=$id_proyek ORDER BY no_segment ASC;";
	$r_cs = mysql_query($q);
	$presentase=0;
	$no=0;
	while ($d_cs = mysql_fetch_assoc($r_cs)) {
		$sow_trenching = $d_cs['trenching'];
		$sow_jembatan	= $d_cs['jembatan'];
		$sow_joinbox	 = $d_cs['joinbox'];
		$sow_pulling	 = $d_cs['pulling'];
		$sow_splicing	= $d_cs['splicing'];
		$sow_atp			 = $d_cs['atp'];
		$id_civil_segment = $d_cs['id_civil_segment'];

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

		$presentase += $pre_trenching + $pre_jembatan + $pre_joinbox + $pre_pulling + $pre_splicing + $pre_atp;
		$no++;
	}
	$civil.="'".intval($presentase/$no)."',";

	//administrasi
	$q = "SELECT * FROM administrasi WHERE id_proyek=$id_proyek;";
	$r_adm = mysql_query($q);
	$presentase=0;
	$no=0;
	while ($d_adm = mysql_fetch_assoc($r_adm)) {
		$id_administrasi = $d_adm['id_administrasi'];
		$q_pro = "SELECT
						SUM(abd_p)abd_p,
						SUM(boq_p)boq_p,
						SUM(dokumen_atp_p)dokumen_atp_p,
						SUM(dokumen_otdr_p)dokumen_otdr_p
					FROM administrasi_update WHERE id_administrasi=$id_administrasi
					GROUP BY id_administrasi;";
		$r_pro = mysql_query($q_pro);
		$d_pro = mysql_fetch_assoc($r_pro);
		$presentase += (($d_pro['abd_p']/$d_adm['abd']*100) + ($d_pro['boq_p']/$d_adm['boq']*100) + ($d_pro['dokumen_atp_p']/$d_adm['dokumen_atp']*100) + ($d_pro['dokumen_otdr_p']/$d['dokumen_otdr']*100))/4;
		$no++;
	}
	$adm.="'".intval($presentase/$no)."',";

	//hari
	$now = date("Y-m-d"); // or your date as well
	$now = date_create($now);
	$tgl_mulai = date_create("{$d_proyek['tgl_mulai']}");
	$tgl_akhir = date_create("{$d_proyek['tgl_akhir']}");
	$r_waktu_terpakai=date_diff($now,$tgl_mulai);
	$r_waktu_tersisa=date_diff($now,$tgl_akhir);
	$r_waktu_proyek=date_diff($tgl_mulai,$tgl_akhir);
		$waktu_terpakai=$r_waktu_terpakai->format("%a");
		$waktu_tersisa=$r_waktu_tersisa->format("%a");
		$waktu_proyek=$r_waktu_proyek->format("%a");
			$waktu_tersisa_arr[]=$waktu_tersisa;
			$waktu_terpakai_arr[]=$waktu_terpakai;
			$waktu_terpakai_arr[]=$waktu_proyek;

	// if ($d_proyek['nama_waktu']=="tahun") {
	// 	$days = 365 * $d_proyek['jangka_waktu'];
	// 	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
	// }
	// elseif ($d_proyek['nama_waktu']=="bulan") {
	// 	$days = 30 * $d_proyek['jangka_waktu'];
	// 	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
	// }
	// elseif ($d_proyek['nama_waktu']=="minggu") {
	// 	$days = 7 * $d_proyek['jangka_waktu'];
	// 	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
	// }
	// elseif ($d_proyek['nama_waktu']=="hari") {
	// 	$days = $d_proyek['jangka_waktu'];
	// 	$tgl_akhir = date_add($tgl_mulai,date_interval_create_from_date_string("$days days"));
	// }
	// $tgl_akhir = strtotime(date_format($tgl_akhir,"Y-m-d"));
	// $now = strtotime(date_format($now,"Y-m-d"));
	// $sisa_waktu = $tgl_akhir - $now;
	// $sisa_waktu = floor($sisa_waktu/(60*60*24));

	

	$presentase = $waktu_tersisa/$waktu_proyek * 100;
	if ($presentase<0) {
		$presentase=0;
	}
	$hit_hari.="'".intval(100-$presentase)."',";
}
?>
<!-- chart option -->
<canvas id="canvas" height="80" width="300"></canvas> 
<script type="text/javascript">;
var barChartData = {
	labels: [<?php echo($nama_proyek); ?>],
	datasets: [
		//permit
		{
			fillColor : "rgba(230, 126, 34, 5)",
			strokeColor : "rgba(230, 126, 34, 0.8)",
			highlightFill : "rgba(230, 126, 34, 0.9)",
			highlightStroke : "rgba(230, 126, 34, 1)",
			data: [<?php echo($permit); ?>]
		},
		//civil
		{
			fillColor : "rgba(127, 140, 141, 5)",
			strokeColor : "rgba(127, 140, 141, 0.8)",
			highlightFill : "rgba(127, 140, 141, 0.9)",
			highlightStroke : "rgba(127, 140, 141, 1)",
			data: [<?php echo($civil); ?>]
		},
		//administrasi
		{
			fillColor : "rgba(241, 196, 15, 5)",
			strokeColor : "rgba(241, 196, 15, 0.8)",
			highlightFill : "rgba(241, 196, 15, 0.9)",
			highlightStroke : "rgba(241, 196, 15, 1)",
			data: [<?php echo($adm); ?>]
		},
		//hari
		{
			fillColor : "rgba(41, 128, 185, 5)",
			strokeColor : "rgba(41, 128, 185, 0.8)",
			highlightFill : "rgba(41, 128, 185, 0.9)",
			highlightStroke : "rgba(41, 128, 185, 1)",
			data: [<?php echo($hit_hari); ?>]
		},
	]
}
window.onload = function(){
	var ctx = document.getElementById("canvas").getContext("2d");
	window.myBar = new Chart(ctx).Bar(barChartData, {
		responsive : true
	});
}
</script>

<br><br>

<?php
$nama_proyek_arr = explode(",", str_replace("'","",$nama_proyek));
$permit_arr = explode(",", str_replace("'","",$permit));
$civil_arr = explode(",", str_replace("'","",$civil));
$adm_arr = explode(",", str_replace("'","",$adm));
$hit_hari_arr = explode(",", str_replace("'","",$hit_hari));
$tingkat_kesulitan_rr = explode(",", str_replace("'","",$tingkat_kesulitan));



?>

<table class="table table-bordered">
	<thead>
		<th></th>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<th><?php echo($nama_proyek_arr[$i]); ?></th>
<?php
	}
?>
	</thead>
	<tbody>
		<tr>
			<td><img src="images/permit.png"> permit</td>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<td><?php echo($permit_arr[$i]); ?>%</td>
<?php
	}
?>
		</tr>
		<tr>
			<td><img src="images/civil.png"> civil</td>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<td><?php echo($civil_arr[$i]); ?>%</td>
<?php
	}
?>
		</tr>
		<tr>
			<td><img src="images/administrasi.png"> administrasi</td>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<td><?php echo($adm_arr[$i]); ?>%</td>
<?php
	}
?>
		</tr>
		<tr>
			<td><img src="images/waktu.png"> waktu terpakai(%)</td>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<td><?php echo($hit_hari_arr[$i]); ?>%</td>
<?php
	}
?>
		</tr>
<tr>
			<td><!-- <img src="images/waktu.png"> --> sisa waktu </td>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<td><?php echo($waktu_tersisa_arr[$i]); ?> hari</td>
<?php
	}
?>
		</tr>
		<tr>
			<td><!-- <img src="images/waktu.png"> --> tingkat kesulitan </td>
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) { 
?>
		<td class="
		<?php
			if ($tingkat_kesulitan_rr[$i]=='SEDANG') {
				echo('alert alert-info');
			}
			else if ($tingkat_kesulitan_rr[$i]=='SULIT') {
				echo('alert alert-danger');
			}
			else if ($tingkat_kesulitan_rr[$i]=='MUDAH') {
				echo('alert alert-success');
			}
		?>
		"><?php echo($tingkat_kesulitan_rr[$i]); ?></td>
<?php
	}
?>
		</tr>
	</tbody>
</table>


<br><br>
<div class="panel panel-danger">
	<div class="panel-heading" align="center"><h4><strong>PERINGATAN !!! PROYEK PRIORITAS</strong></h4></div>
	<div class="panel-body">
<?php
	$pjg = count($nama_proyek_arr);
	for ($i=0; $i<$pjg-1; $i++) {
		if ($hit_hari_arr[$i]>=80) {
?>
		<div class="alert alert-danger" role="alert">
<?php
			 echo("PROYEK <strong>" . $nama_proyek_arr[$i] . "</strong> WAKTU TERSISA HANYA TINGGAL <strong>" . (100-$hit_hari_arr[$i]) . "%</strong> "."HARAP DI PRIORITASKAN" );
?>

<!-- echo("PROYEK <strong>" . $nama_proyek_arr[$i] . "</strong> SISA WAKTU KURANG DARI <strong>" . (100-$hit_hari_arr[$i]) . "%</strong> (<strong>" . ($sisa_waktu_arr[$i]) . " HARI</strong>)" );
?> -->
	<!-- 	</div>
<?php
		}
	}
?>
	</div>
</div>
 --> 

