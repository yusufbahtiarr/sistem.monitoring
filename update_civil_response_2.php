<script type="text/javascript" src="plugin/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('#example').DataTable({
			'iDisplayLength': 5
		});
	} );
</script>
<?php
error_reporting(0);
session_start();
include 'dbconnection.php';
if (isset($_GET['id_proyek']) && isset($_GET['id_civil_segment'])) {
	$id_proyek = $_GET['id_proyek'];
	$id_civil_segment = $_GET['id_civil_segment'];
	if ($_GET['act']=='simpan') {
		$id_civil_segment=$_GET['id_civil_segment'];
		$id_proyek=$_GET['id_proyek'];
		$trenching_p=$_GET['trenching_p'];
		$trenching_r=$_GET['trenching_r'];
		$jembatan_p=$_GET['jembatan_p'];
		$jembatan_r=$_GET['jembatan_r'];
		$joinbox_p=$_GET['joinbox_p'];
		$joinbox_r=$_GET['joinbox_r'];
		$pulling_p=$_GET['pulling_p'];
		$pulling_r=$_GET['pulling_r'];
		$splicing_p=$_GET['splicing_p'];
		$splicing_r=$_GET['splicing_r'];
		$atp_p=$_GET['atp_p'];
		$atp_r=$_GET['atp_r'];
		$id_user=$_SESSION['id_user'];
		$q_update = "INSERT INTO civil_segment_update(
						id_civil_segment,id_proyek,
						trenching_p,trenching_r,
						jembatan_p,jembatan_r,
						joinbox_p,joinbox_r,
						pulling_p,pulling_r,
						splicing_p,splicing_r,
						atp_p,atp_r,tgl_update,id_user
						) VALUES (
						$id_civil_segment,$id_proyek,
						$trenching_p,'$trenching_r',
						$jembatan_p,'$jembatan_r',
						$joinbox_p,'$joinbox_r',
						$pulling_p,'$pulling_r',
						$splicing_p,'$splicing_r',
						$atp_p,'$atp_r',now(),$id_user
						)";
		mysql_query($q_update);
	}
	elseif ($_GET['act']=='hapus') {
		$id_civil_segment_update = $_GET['id_civil_segment_update'];
		$q_dlt = "DELETE FROM civil_segment_update WHERE id_civil_segment_update=$id_civil_segment_update;";
		mysql_query($q_dlt);
	}

	$q = "SELECT * FROM civil_segment WHERE id_civil_segment=$id_civil_segment;";
	$r = mysql_query($q);
	$d = mysql_fetch_assoc($r);

	$q1 = "SELECT
			SUM(trenching_p)trenching,
			SUM(jembatan_p)jembatan,
			SUM(joinbox_p)joinbox,
			SUM(pulling_p)pulling,
			SUM(splicing_p)splicing,
			SUM(atp_p)atp
			FROM civil_segment_update WHERE id_civil_segment=$id_civil_segment";
	$r = mysql_query($q1);
	$d_progress = mysql_fetch_assoc($r);
?>
	<table class="table table-bordered">
		<thead>
			<th align="center">ITEM</th>
			<th align="center">SOW</th>
			<th align="center">PROGRESS</th>
			<th align="center">UPDATE</th>
			<th align="center">REMARK</th>
		</thead>
		<tbody>
			<tr>
				<td>TRENCHING</td>
				<td align="right"><?php echo($d['trenching']); ?></td>
				<td align="right"><?php echo($d_progress['trenching']); ?></td>
				<td><input type="text" class="tengah" id='trenching_p' value="0"></td>
				<td><input type="text" class="tengah" id='trenching_r'></td>
			</tr>
			<tr>
				<td>JEMBATAN</td>
				<td align="right"><?php echo($d['jembatan']); ?></td>
				<td align="right"><?php echo($d_progress['jembatan']); ?></td>
				<td><input type="text" class="tengah" id='jembatan_p' value="0"></td>
				<td><input type="text" class="tengah" id='jembatan_r'></td>
			</tr>
			<tr>
				<td>JOINTBOX</td>
				<td align="right"><?php echo($d['joinbox']); ?></td>
				<td align="right"><?php echo($d_progress['joinbox']); ?></td>
				<td><input type="text" class="tengah" id='joinbox_p' value="0"></td>
				<td><input type="text" class="tengah" id='joinbox_r'></td>
			</tr>
			<tr>
				<td>PULLING</td>
				<td align="right"><?php echo($d['pulling']); ?></td>
				<td align="right"><?php echo($d_progress['pulling']); ?></td>
				<td><input type="text" class="tengah" id='pulling_p' value="0"></td>
				<td><input type="text" class="tengah" id='pulling_r'></td>
			</tr>
			<tr>
				<td>SPLICING</td>
				<td align="right"><?php echo($d['splicing']); ?></td>
				<td align="right"><?php echo($d_progress['splicing']); ?></td>
				<td><input type="text" class="tengah" id='splicing_p' value="0"></td>
				<td><input type="text" class="tengah" id='splicing_r'></td>
			</tr>
			<tr>
				<td>ATP</td>
				<td align="right"><?php echo($d['atp']); ?></td>
				<td align="right"><?php echo($d_progress['atp']); ?></td>
				<td><input type="text" class="tengah" id='atp_p' value="0"></td>
				<td><input type="text" class="tengah" id='atp_r'></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="5" align="right">
					<button type="button" class="btn btn-warning btn-sm" onclick="batal()">Batal</button>
					<button type="button" class="btn btn-primary btn-sm" onclick="simpan()">Simpan</button>
				</td>
			</tr>
		</tfoot>
	</table>

	<br><br>
	<strong>History - Progress</strong>
	<br><br>
	<table class="table table-bordered" id="example">
		<thead>
			<th align="center">No</th>
			<th align="center">Nama Karyawan</th>
			<th align="center">Segment</th>
			<th align="center">Trenching</th>
			<th align="center">Jembatan</th>
			<th align="center">Jointbox</th>
			<th align="center">Pulling</th>
			<th align="center">Splicing</th>
			<th align="center">ATP</th>
			<th align="center">Tgl. Update</th>
			<th align="center"></th>
		</thead>
		<tbody>
<?php
	$q = "SELECT a.*,b.no_segment, c.nama FROM
				civil_segment_update a
				INNER JOIN
					civil_segment b
					ON a.id_civil_segment=b.id_civil_segment
				INNER JOIN
					user c
					ON a.id_user=c.id_user
				WHERE a.id_proyek=$id_proyek";
	$r = mysql_query($q);
	$no = 1;
	while ($d = mysql_fetch_assoc($r)) {
?>
			<tr>
				<td align="center"><?php echo($no++); ?></td>
				<td align="center"><?php echo($d['nama']); ?></td>
				<td align="center"><?php echo($d['no_segment']); ?></td>
				<td align="center"><?php echo($d['trenching_p']); ?></td>
				<td align="center"><?php echo($d['jembatan_p']); ?></td>
				<td align="center"><?php echo($d['joinbox_p']); ?></td>
				<td align="center"><?php echo($d['pulling_p']); ?></td>
				<td align="center"><?php echo($d['splicing_p']); ?></td>
				<td align="center"><?php echo($d['atp_p']); ?></td>
				<td align="center"><?php echo($d['tgl_update']); ?></td>
<?php
		if ($_SESSION['id_user']==$d['id_user']) {
?>
				<td><button type="button" class="btn btn-warning btn-xs" onclick="hapus(<?php echo($d['id_civil_segment_update']); ?>);">Delete</button></td>
<?php
		}
		else{
?>
				<td>-</td>
<?php
		}
?>
			</tr>
<?php
	}
?>
		</tbody>
	</table>
<?php
}
?>