<?php
error_reporting(0);
include 'dbconnection.php';
session_start();
if (isset($_GET['id_proyek'])) {
	$id_proyek = $_GET['id_proyek'];
	$id_permit = $_GET['id_permit'];
	$id_user=$_GET['id_user'];
	if ($_GET['act']=='simpan') {
		$q = "SELECT * FROM permit WHERE id_proyek=$id_proyek";
		$r = mysql_query($r);
		while ($d = mysql_fetch_assoc($r)) {
			$id_permit = $d['id_permit'];
			$progress = $_GET['progress__'.$id_permit];
			$remark = $_GET['remark__'.$id_permit];
			if (isset($_FILES['dokumen__'.$id_permit]['type'])) {
				$dokumen = $dir."permit_".$id_proyek."_".$id_permit."_".$id_user."_".date('Ymd_His').$_FILES['dokumen__'.$id_permit]]['type'];
				move_uploaded_file($_FILES['dokumen__'.$id_permit]['name'], "$dokumen");
			}else $boq_d = "";
			if ($progress!="" || $remark != "" || $dokumen!="") {
				$q_update = "INSERT INTO permit_update(
								id_permit,id_proyek,id_user,
								progress,remark,dokumen,tgl_update
								) VALUES (
								$id_permit,$id_proyek,$id_user,
								$progress,'$remark','$dokumen',now()
							);";
				mysql_query($q_update);
			}
		}
	}
?>
	<table class="table table-bordered">
		<thead>
			<th align="center">IZIN</th>
			<th align="center">WILAYAH</th>
			<th align="center">SOW</th>
			<th align="center">PROGRESS</th>
			<th align="center">UPDATE</th>
			<th align="center">DOKUMEN</th>
			<th align="center">REMARK</th>
		</thead>
		<tbody>
<?php
		$q = "SELECT * FROM permit WHERE id_proyek=$id_proyek;";
		$r = mysql_query($q);
		while ($d = mysql_fetch_assoc($r)) {
			$q1 = "SELECT sum(sum)progress
					FROM permit_update WHERE id_permit={$d['id_permit']}";
			$r =  mysql_query($q1);
			$d_progress = mysql_fetch_assoc($r);
?>
			<tr>
				<td><?php echo($d['izin']); ?></td>
				<td><?php echo($d['wilayah']); ?></td>
				<td><?php echo($d['sow']); ?></td>
			</tr>
<?php
		}
?>
			<tr>
				<td>ABD</td>
				<td align="right"><?php echo($d['abd']); ?></td>
				<td align="right"><?php echo($d_progress['abd']); ?></td>
				<td><input type="text" class="tengah" id='abd_p'></td>
				<td><input type="file" id="abd_d" name="abd_d"></td>
				<td><input type="text" class="tengah" id='abd_r'></td>
			</tr>
			<tr>
				<td>BOQ</td>
				<td align="right"><?php echo($d['boq']); ?></td>
				<td align="right"><?php echo($d_progress['boq']); ?></td>
				<td><input type="text" class="tengah" id='boq_p'></td>
				<td><input type="file" id="boq_d" name="boq_d"></td>
				<td><input type="text" class="tengah" id='boq_r'></td>
			</tr>
			<tr>
				<td>DOKUMEN ATP</td>
				<td align="right"><?php echo($d['dokumen_atp']); ?></td>
				<td align="right"><?php echo($d_progress['dokumen_atp']); ?></td>
				<td><input type="text" class="tengah" id='dokumen_atp_p'></td>
				<td><input type="file" id="dokumen_atp_d" name="dokumen_atp_d"></td>
				<td><input type="text" class="tengah" id='dokumen_atp_r'></td>
			</tr>
			<tr>
				<td>DOKUMEN OTDR</td>
				<td align="right"><?php echo($d['dokumen_otdr']); ?></td>
				<td align="right"><?php echo($d_progress['dokumen_otdr']); ?></td>
				<td><input type="text" class="tengah" id='dokumen_otdr_p'></td>
				<td><input type="file" id="dokumen_otdr_d" name="dokumen_otdr_d"></td>
				<td><input type="text" class="tengah" id='dokumen_otdr_r'></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6" align="right">
					<button type="button" class="btn btn-warning btn-sm" onclick="batal()">Batal</button>
					<button type="button" class="btn btn-primary btn-sm" onclick="simpan()">Simpan</button>
				</td>
			</tr>
		</tfoot>
	</table>

	<br><br>
	<strong>History</strong>
	<table class="table table-bordered">
		<thead>
			<th align="center">ABD Pr.</th>
			<th align="center">ABD Upload</th>
			<th align="center">ABD Re.</th>
			<th align="center">BOQ Pr.</th>
			<th align="center">BOQ Upload</th>
			<th align="center">BOQ Re.</th>
			<th align="center">Dok. ATP Pr</th>
			<th align="center">Dok. ATP Upload</th>
			<th align="center">Dok. ATP Re.</th>
			<th align="center">Dok. OTDR Pr</th>
			<th align="center">Dok. OTDR Upload</th>
			<th align="center">Dok. OTDR Re.</th>
			<th align="center">Tgl. Update</th>
		</thead>
		<tbody>
<?php
	$q = "SELECT a.*,b.no_segment FROM permit_update a INNER JOIN permit b ON a.id_permit=b.id_permit WHERE a.id_proyek=$id_proyek";
	$r = mysql_query($q);
	while ($d = mysql_fetch_assoc($r)) {
?>
			<tr>
				<td align="center"><?php echo($d['abd_p']); ?></td>
				<td align="center"><a href="<?php echo($d['abd_d']); ?>"></a></td>
				<td align="center"><?php echo($d['abd_r']); ?></td>
				<td align="center"><?php echo($d['boq_p']); ?></td>
				<td align="center"><a href="<?php echo($d['boq_d']); ?>"></a></td>
				<td align="center"><?php echo($d['boq_r']); ?></td>
				<td align="center"><?php echo($d['dokumen_atp_p']); ?></td>
				<td align="center"><a href="<?php echo($d['dokumen_atp_d']); ?>"></a></td>
				<td align="center"><?php echo($d['dokumen_atp_r']); ?></td>
				<td align="center"><?php echo($d['dokumen_otdr_p']); ?></td>
				<td align="center"><a href="<?php echo($d['dokumen_otdr_d']); ?>"></a></td>
				<td align="center"><?php echo($d['dokumen_otdr_r']); ?></td>
				<td align="center"><?php echo($d['tgl_update']); ?></td>
			</tr>
<?php
	}
?>
		</tbody>
	</table>
<?php
}
?>