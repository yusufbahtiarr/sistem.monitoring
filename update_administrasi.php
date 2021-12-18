<?php
if ($_GET['act']=="delete") {
	$q = "DELETE FROM administrasi_update WHERE id_administrasi_update={$_GET['id_administrasi_update']};";
	mysql_query($q);
	header("Location: index.php?mod=update_administrasi&id_proyek={$_GET['id_proyek']}&id_administrasi_update={$_GET['id_administrasi_update']}");
}
elseif ($_GET['act']=="simpan") {
	$id_administrasi=$_GET['id_administrasi'];
	$id_proyek=$_GET['id_proyek'];
	$id_user=$_SESSION['id_user'];
	$abd_p=$_POST['abd_p'];
	$abd_r=$_POST['abd_r'];
	$boq_p=$_POST['boq_p'];
	$boq_r=$_POST['boq_r'];
	$dokumen_atp_p=$_POST['dokumen_atp_p'];
	$dokumen_atp_r=$_POST['dokumen_atp_r'];
	$dokumen_otdr_p=$_POST['dokumen_otdr_p'];
	$dokumen_otdr_r=$_POST['dokumen_otdr_r'];
	$dokumen_otdr_p=$_POST['dokumen_otdr_p'];
	$dokumen_otdr_r=$_POST['dokumen_otdr_r'];
	$q_update = "INSERT INTO administrasi_update(
					id_administrasi,id_proyek,id_user,
					abd_p,abd_r,abd_d,
					boq_p,boq_r,boq_d,
					dokumen_atp_p,dokumen_atp_r,dokumen_atp_d,
					dokumen_otdr_p,dokumen_otdr_r,dokumen_otdr_d,
					tgl_update
					) VALUES (
					$id_administrasi,$id_proyek,$id_user,
					$abd_p,'$abd_r','',
					$boq_p,'$boq_r','',
					$dokumen_atp_p,'$dokumen_atp_r','',
					$dokumen_otdr_p,'$dokumen_otdr_r','',
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
		$nama_file_target = "dokumen/administrasi_".$nik."_".$tgl."_abd_".$id_administrasi_update.".$ext[1]";
		if(copy($file_sementara, $nama_file_target)){
			$q_update = "UPDATE administrasi_update SET abd_d='$nama_file_target' WHERE id_administrasi_update=$id_administrasi_update;";
			mysql_query($q_update);
		}
	}
	if (isset($_FILES['boq_d'])) {
		$file_sementara = $_FILES['boq_d']['tmp_name'];
		$nama_file = $_FILES['boq_d']['name'];
		$ext = explode(".", $nama_file);
		$nama_file_target = "dokumen/administrasi_".$nik."_".$tgl."_boq_".$id_administrasi_update.".$ext[1]";
		if(copy($file_sementara, $nama_file_target)){
			$q_update = "UPDATE administrasi_update SET boq_d='$nama_file_target' WHERE id_administrasi_update=$id_administrasi_update;";
			mysql_query($q_update);
		}
	}
	if (isset($_FILES['dokumen_atp_d'])) {
		$file_sementara = $_FILES['dokumen_atp_d']['tmp_name'];
		$nama_file = $_FILES['dokumen_atp_d']['name'];
		$ext = explode(".", $nama_file);
		$nama_file_target = "dokumen/administrasi_".$nik."_".$tgl."_atp_".$id_administrasi_update.".$ext[1]";
		if(copy($file_sementara, $nama_file_target)){
			$q_update = "UPDATE administrasi_update SET dokumen_atp_d='$nama_file_target' WHERE id_administrasi_update=$id_administrasi_update;";
			mysql_query($q_update);
		}
	}
	if (isset($_FILES['dokumen_otdr_d'])) {
		$file_sementara = $_FILES['dokumen_otdr_d']['tmp_name'];
		$nama_file = $_FILES['dokumen_otdr_d']['name'];
		$ext = explode(".", $nama_file);
		$nama_file_target = "dokumen/administrasi_".$nik."_".$tgl."_otdr_".$id_administrasi_update.".$ext[1]";
		if(copy($file_sementara, $nama_file_target)){
			$q_update = "UPDATE administrasi_update SET dokumen_otdr_d='$nama_file_target' WHERE id_administrasi_update=$id_administrasi_update;";
			mysql_query($q_update);
		}
	}
}
?>
<a href="?mod=update">back</a>
<div class="panel panel-default">
	<div class="panel-heading"><strong>UPDATE ADMINISTRASI</strong></strong></div>
	<div class="panel-body">
<?php
//query nya
$q = "SELECT a.* FROM proyek a
		INNER JOIN otoritas b ON a.id_proyek=b.id_proyek
		WHERE b.id_user={$_SESSION['id_user']} AND b.administrasi=1 AND a.id_proyek={$_GET['id_proyek']};";
//eksekusi query nya & hasilnya(result) ditampung di $r
$r = mysql_query($q);
$d = mysql_fetch_assoc($r);
?>
		<table class="table table-bordered">
				<tr>
					<td align="right">OPERATOR</td>
					<td>
						<input type="text" name="operator" readonly value="<?php echo($d['operator']); ?>">
					</td>
				</tr>
				<tr>
					<td align="right">PROYEK</td>
					<td>
						<input type="text" name="proyek" readonly value="<?php echo($d['nama_proyek']); ?>">
					</td>
				</tr>
				<tr>
					<td align="right">SEGMENT</td>
					<td>
						<select id="id_administrasi" name="id_administrasi" onchange="administrasi()">
							<option></option>
<?php
$q_cs = "SELECT * FROM administrasi WHERE id_proyek={$_GET['id_proyek']};";
$r_cs = mysql_query($q_cs);
while ($d_cs = mysql_fetch_assoc($r_cs)) {
?>
							<option value="<?php echo($d_cs['id_administrasi']); ?>" <?php if($_POST['id_administrasi']==$d_cs['id_administrasi'])echo("SELECTED"); elseif($_GET['id_administrasi']==$d_cs['id_administrasi'])echo("SELECTED") ?>><?php echo($d_cs['no_segment']); ?></option>
<?php
}
?>
						</select>
						<!--<span id="nama_segment"></span>-->
					</td>
				</tr>
				<tr>
					<td align="right">Tanggal</td>
					<td><input type="text" name="tgl_mulai" readonly value="<?php echo(date('Y-m-d')); ?>"></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="button" class="btn btn-primary btn-sm" onclick="opensegment($('#id_administrasi').val());">Lihat</button></td>
				</tr>
		</table>
		<script type="text/javascript">
			function opensegment (id_administrasi) {
				document.location="index.php?mod=update_administrasi&id_proyek=<?php echo($_GET['id_proyek']); ?>&id_administrasi="+id_administrasi;
			}
		</script>
<?php
if (isset($_GET['id_administrasi'])) {
	$id_administrasi=$_GET['id_administrasi'];
	$id_proyek=$_GET['id_proyek'];
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
	<form method="POST" action="index.php?mod=update_administrasi&act=simpan&id_proyek=<?php echo($id_proyek); ?>&id_administrasi=<?php echo($id_administrasi); ?>" enctype="multipart/form-data">
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
				<td><input type="text" class="tengah" id='abd_p' name='abd_p' value="0"></td>
				<td><input type="file" id="abd_d" name="abd_d"></td>
				<td><input type="text" class="tengah" id='abd_r' name='abd_r'></td>
			</tr>
			<tr>
				<td>BOQ</td>
				<td align="right"><?php echo($d['boq']); ?></td>
				<td align="right"><?php echo($d_progress['boq']); ?></td>
				<td><input type="text" class="tengah" id='boq_p' name='boq_p' value="0"></td>
				<td><input type="file" id="boq_d" name="boq_d"></td>
				<td><input type="text" class="tengah" id='boq_r' name='boq_r'></td>
			</tr>
			<tr>
				<td>DOKUMEN ATP</td>
				<td align="right"><?php echo($d['dokumen_atp']); ?></td>
				<td align="right"><?php echo($d_progress['dokumen_atp']); ?></td>
				<td><input type="text" class="tengah" id='dokumen_atp_p' name='dokumen_atp_p' value="0"></td>
				<td><input type="file" id="dokumen_atp_d" name="dokumen_atp_d"></td>
				<td><input type="text" class="tengah" id='dokumen_atp_r' name='dokumen_atp_r'></td>
			</tr>
			<tr>
				<td>DOKUMEN OTDR</td>
				<td align="right"><?php echo($d['dokumen_otdr']); ?></td>
				<td align="right"><?php echo($d_progress['dokumen_otdr']); ?></td>
				<td><input type="text" class="tengah" id='dokumen_otdr_p' name='dokumen_otdr_p' value="0"></td>
				<td><input type="file" id="dokumen_otdr_d" name="dokumen_otdr_d"></td>
				<td><input type="text" class="tengah" id='dokumen_otdr_r' name='dokumen_otdr_r'></td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="6" align="right">
					<button type="button" class="btn btn-warning btn-sm" onclick="batal()">Batal</button>
					<button type="submit" class="btn btn-primary btn-sm">Simpan</button>
				</td>
			</tr>
		</tfoot>
	</table>
	</form>

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
				<td>
<?php
		if ($_SESSION['id_user']==$d['id_user']) {
?>
					<a href="index.php?mod=update_administrasi&id_proyek=<?php echo($id_proyek); ?>&act=delete&id_administrasi_update=<?php echo($d['id_administrasi_update']); ?>"
						onclick="return confirm('Yakin hapus data ini?');">
						<button type="button" class="btn btn-warning btn-xs" onclick="">Delete</button>
					</a>
<?php
		}
?>
				</td>
			</tr>
<?php
	}
}
?>
		</tbody>
	</table>
	</div>
</div>