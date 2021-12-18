<?php
error_reporting(0);
include 'dbconnection.php';
session_start();
if ((isset($_GET['id_proyek']) && isset($_GET['id_administrasi']))||((isset($_POST['id_proyek']) && isset($_POST['id_administrasi'])))) {
	$id_proyek = $_GET['id_proyek'];
	$id_administrasi = $_GET['id_administrasi'];
	if ($_POST['act']=='simpan') {
		$id_administrasi=$_POST['id_administrasi'];
		$id_proyek=$_POST['id_proyek'];
		$id_user=$_POST['id_user'];
		$abd_p=$_POST['abd_p'];
		$abd_r=$_POST['abd_r'];
		$dir = "dokumen/";

		if (isset($_FILES['abd_d']['type'])) {
			$abd_d = $dir."adm_".$id_proyek."_".$id_user."_".date('Ymd_His').$_FILES['abd_d']['type'];
			move_uploaded_file($_FILES['abd_d']['tmp_name'], $abd_d);
		}else $abd_d = "";
		
		$boq_p=$_POST['boq_p'];
		$boq_r=$_POST['boq_r'];
		if (isset($_FILES['boq_d']['type'])) {
			$boq_d = $dir."adm_".$id_proyek."_".$id_user."_".date('Ymd_His').$_FILES['boq_d']['type'];
			move_uploaded_file($_FILES['boq_d']['tmp_name'], $boq_d);
		}else $boq_d = "";
		
		$dokumen_atp_p=$_POST['dokumen_atp_p'];
		$dokumen_atp_r=$_POST['dokumen_atp_r'];
		if (isset($_FILES['dokumen_atp_d']['type'])) {
			$dokumen_atp_d = $dir."adm_".$id_proyek."_".$id_user."_".date('Ymd_His').$_FILES['dokumen_atp_d']['type'];
			move_uploaded_file($_FILES['dokumen_atp_d']['tmp_name'], $dokumen_atp_d);
		}else $dokumen_atp_d = "";


		$dokumen_otdr_p=$_POST['dokumen_otdr_p'];
		$dokumen_otdr_r=$_POST['dokumen_otdr_r'];
		if (isset($_FILES['dokumen_otdr_d']['type'])) {
			$dokumen_otdr_d = $dir."adm_".$id_proyek."_".$id_user."_".date('Ymd_His').$_FILES['dokumen_otdr_d']['type'];
			move_uploaded_file($_FILES['dokumen_otdr_d']['tmp_name'], $dokumen_otdr);
		}else $dokumen_otdr_d = "";

		$q_update = "INSERT INTO administrasi_update(
						id_administrasi,id_proyek,id_user,
						abd_p,abd_r,abd_d,
						boq_p,boq_r,boq_d,
						dokumen_atp_p,dokumen_atp_r,dokumen_atp_d,
						dokumen_otdr_p,dokumen_otdr_r,dokumen_otdr_d,
						tgl_update
						) VALUES (
						$id_administrasi,$id_proyek,$id_user,
						$abd_p,'$abd_r','$abd_d',
						$boq_p,'$boq_r','$boq_d',
						$dokumen_atp_p,'$dokumen_atp_r','$dokumen_atp_d',
						$dokumen_otdr_p,'$dokumen_otdr_r','$dokumen_otdr_d',
						now()
						);";
		mysql_query($q_update);

		$id_administrasi_update = mysql_insert_id();
		$nik = $_SESSION['nik'];
		$tgl = date("Ymd");
		
		if (isset($_FILES['abd_d'])) {
			$file_sementara = $_FILES['abd_d']['tmp_name'];
			$nama_file = $_FILES['abd_d']['name'];
			$ext = explode(".", $nama_file);
			$nama_file_target = "dokumen/administrasi_".$nik."_".$tgl."_".$id_administrasi_update.".$ext[1]";
			if(copy($file_sementara, $nama_file_target)){
				$q_update = "UPDATE administrasi_update SET abd_d='$nama_file_target' WHERE id_administrasi_update=$id_administrasi_update;";
				mysql_query($q_update);
			}
		}
	}
	elseif ($_GET['act']=='hapus') {
		$id_administrasi_update=$_GET['id_administrasi_update'];
		$q_dlt = "DELETE FROM administrasi_update WHERE id_administrasi_update=$id_administrasi_update";
		mysql_query($q_dlt);
	}

	$q = "SELECT * FROM administrasi WHERE id_administrasi=$id_administrasi;";
	$r = mysql_query($q);
	$d = mysql_fetch_assoc($r);

	$q1 = "SELECT
			SUM(abd_p)abd,
			SUM(boq_p)boq,
			SUM(dokumen_atp_p)dokumen_atp,
			SUM(dokumen_otdr_p)dokumen_otdr
			FROM administrasi_update WHERE id_administrasi=$id_administrasi";
	$r = mysql_query($q1);
	$d_progress = mysql_fetch_assoc($r);
?>
	<table class="table table-bordered">
		<thead>
			<th align="center">ITEM</th>
			<th align="center">SOW</th>
			<th align="center">PROGRESS</th>
			<th align="center">UPDATE</th>
			<th align="center">DOKUMEN</th>
			<th align="center">REMARK</th>
		</thead>
		<tbody>
			<tr>
				<td>ABD</td>
				<td align="right"><?php echo($d['abd']); ?></td>
				<td align="right"><?php echo($d_progress['abd']); ?></td>
				<td><input type="text" class="tengah" id='abd_p' value="0"></td>
				<td><input type="file" id="abd_d" name="abd_d"></td>
				<td><input type="text" class="tengah" id='abd_r'></td>
			</tr>
			<tr>
				<td>BOQ</td>
				<td align="right"><?php echo($d['boq']); ?></td>
				<td align="right"><?php echo($d_progress['boq']); ?></td>
				<td><input type="text" class="tengah" id='boq_p' value="0"></td>
				<td><input type="file" id="boq_d" name="boq_d"></td>
				<td><input type="text" class="tengah" id='boq_r'></td>
			</tr>
			<tr>
				<td>DOKUMEN ATP</td>
				<td align="right"><?php echo($d['dokumen_atp']); ?></td>
				<td align="right"><?php echo($d_progress['dokumen_atp']); ?></td>
				<td><input type="text" class="tengah" id='dokumen_atp_p' value="0"></td>
				<td><input type="file" id="dokumen_atp_d" name="dokumen_atp_d"></td>
				<td><input type="text" class="tengah" id='dokumen_atp_r'></td>
			</tr>
			<tr>
				<td>DOKUMEN OTDR</td>
				<td align="right"><?php echo($d['dokumen_otdr']); ?></td>
				<td align="right"><?php echo($d_progress['dokumen_otdr']); ?></td>
				<td><input type="text" class="tengah" id='dokumen_otdr_p' value="0"></td>
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
	<strong>History - Progress</strong>
	<table class="table table-bordered">
		<thead>
			<th align="center">Nama Karyawan</th>
			<th align="center">Segment</th>
			<th align="center">ABD</th>
			<th align="center">BOQ</th>
			<th align="center">Dokumen ATP</th>
			<th align="center">Dokumen OTDR</th>
			<th align="center">Tgl. Update</th>
			<th align="center"></th>
		</thead>
		<tbody>
<?php
	$q = "SELECT a.*,b.no_segment,c.nama FROM administrasi_update a
			INNER JOIN administrasi b
				ON a.id_administrasi=b.id_administrasi
			INNER JOIN user c
				ON a.id_user=c.id_user
			WHERE a.id_proyek=$id_proyek";
	$r = mysql_query($q);
	while ($d = mysql_fetch_assoc($r)) {
?>
			<tr>
				<td align="center"><?php echo($d['nama']); ?></td>
				<td align="center"><?php echo($d['no_segment']); ?></td>
				<td align="center"><?php echo($d['abd_p']); ?></td>
				<td align="center"><?php echo($d['boq_p']); ?></td>
				<td align="center"><?php echo($d['dokumen_atp_p']); ?></td>
				<td align="center"><?php echo($d['dokumen_otdr_p']); ?></td>
				<td align="center"><?php echo($d['tgl_update']); ?></td>
<?php
		if ($_SESSION['id_user']==$d['id_user']) {
?>
				<td><button type="button" class="btn btn-warning btn-xs" onclick="hapus(<?php echo($d['id_administrasi_update']); ?>);">Delete</button></td>
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