<?php

if (isset($_POST['simpan'])) {
	$id_user = $_SESSION['id_user'];
	$id_proyek=$_GET['id_proyek'];
	$q = "SELECT id_permit FROM permit WHERE id_proyek=$id_proyek";
	$r = mysql_query($q);
	while ($d = mysql_fetch_assoc($r)) {
		if ($_POST['update__'.$d['id_permit']]!="") {
			$q = "INSERT INTO permit_update
						(id_permit,id_proyek,progress,remark,dokumen,tgl_update,id_user)
					VALUE
						({$d['id_permit']},$id_proyek,'".$_POST['update__'.$d['id_permit']]."','".$_POST['remark__'.$d['id_permit']]."','',now(),$id_user);";
			mysql_query($q);
			if (isset($_FILES['dokumen__'.$d['id_permit']])) {
				$id_permit_update = mysql_insert_id();
				$nik = $_SESSION['nik'];
				$tgl = date("Ymd");
				$file_sementara = $_FILES['dokumen__'.$d['id_permit']]['tmp_name'];
				$nama_file = $_FILES['dokumen__'.$d['id_permit']]['name'];
				$ext = explode(".", $nama_file);
				$nama_file_target = "dokumen/permit_".$nik."_".$tgl."_".$id_permit_update.".$ext[1]";
				if(copy($file_sementara, $nama_file_target)){
					$q_update = "UPDATE permit_update SET dokumen='$nama_file_target' WHERE id_permit_update=$id_permit_update;";
					mysql_query($q_update);
				}
			}
		}
	}
}

elseif ($_GET['act']=="hapus" && isset($_GET['id_permit_update'])) {
	$id_permit_update = $_GET['id_permit_update'];
	$q = "DELETE FROM permit_update WHERE id_permit_update=$id_permit_update;";
	mysql_query($q);
	header("location: index.php?mod=update_permit&id_proyek={$_GET['id_proyek']}");
}

?>
<a href="?mod=update">back</a>
<div class="panel panel-default">
	<div class="panel-heading"><strong>UPDATE PERMIT</strong></div>
	<div class="panel-body">
<?php
//query nya
$q = "SELECT a.* FROM proyek a
		INNER JOIN otoritas b ON a.id_proyek=b.id_proyek
		WHERE b.id_user={$_SESSION['id_user']} AND b.permit=1 AND a.id_proyek={$_GET['id_proyek']};";
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
					<!--<span id="nama_segment"></span>-->
				</td>
			</tr>
			<tr>
				<td align="right">Tanggal</td>
				<td><input type="text" name="tgl_mulai" readonly value="<?php echo(date('Y-m-d')); ?>"></td>
			</tr>
		</table>

		<form method="POST" action="?mod=update_permit&id_proyek=<?php echo($_GET['id_proyek']); ?>" enctype="multipart/form-data">
			<table class="table table-bordered">
				<thead>
					<th>IZIN</th>
					<th>WILAYAH</th>
					<th>SOW</th>
					<th>PROGRESS</th>
					<th>UPDATE</th>
					<th>DOKUMEN</th>
					<th>REMARK</th>
				</thead>
				<tbody>
<?php
$q = "SELECT a.*,b.progress FROM permit a
		LEFT JOIN
			(SELECT id_permit,sum(progress)progress FROM permit_update GROUP BY id_permit) b
			ON a.id_permit=b.id_permit
		WHERE a.id_proyek={$_GET['id_proyek']};";
$r = mysql_query($q);
while ($d = mysql_fetch_assoc($r)) {
?>
				<tr>
					<td><?php echo($d['izin']); ?></td>
					<td><?php echo($d['wilayah']); ?></td>
					<td><?php echo($d['sow']); ?></td>
					<td><?php echo($d['progress']); ?></td>
					<td><input type="text" name="update__<?php echo($d['id_permit']); ?>"></td>
					<td><input type="file" name="dokumen__<?php echo($d['id_permit']); ?>"></td>
					<td><input type="text" name="remark__<?php echo($d['id_permit']); ?>"></td>
				</tr>
<?php
}
?>
				</tbody>
			</table>
			<div class="pull-right">
				<button type="submit" name="simpan" value="1" class="btn btn-sm btn-primary">Simpan</button>
			</div>
		</form>
		<br><br>
		<strong>History</strong>
		<table class="table table-bordered">
			<thead>
				<th>KARYAWAN</th>
				<th>IZIN</th>
				<th>WILAYAH</th>
				<th>UPDATE</th>
				<!-- <th>DOKUMEN</th> -->
				<th>TGL UPDATE</th>
				<th>TOOLS</th>
			</thead>
			<tbody>
<?php
$q = "SELECT a.*,b.izin,b.wilayah,c.nama FROM permit_update a
	LEFT JOIN permit b ON a.id_permit=b.id_permit
	LEFT JOIN user c ON a.id_user=c.id_user
	WHERE a.id_proyek={$_GET['id_proyek']}";
$r = mysql_query($q);
while ($d = mysql_fetch_assoc($r)) {
?>
				<tr>
					<td><?php echo($d['nama']) ?></td>
					<td><?php echo($d['izin']) ?></td>
					<td><?php echo($d['wilayah']) ?></td>
					<td><?php echo($d['progress']) ?></td>
					<!-- <td><?php echo($d['dokumen']) ?></td> -->
					<td><?php echo($d['tgl_update']) ?></td>
					<td>
<?php
	if ($_SESSION['id_user']==$d['id_user']) {
?>
						<a href="?mod=update_permit&id_proyek=<?php echo($_GET['id_proyek']); ?>&act=hapus&id_permit_update=<?php echo($d['id_permit_update']); ?>"
							onclick="return confirm('Yakin hapus?');">
							<button type="button" class="btn btn-danger btn-xs">delete</button>
						</a>
<?php
	}
?>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
	</div>
</div>
