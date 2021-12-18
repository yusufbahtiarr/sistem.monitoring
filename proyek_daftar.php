<form action="?mod=proyek_daftar" method="POST">
	<div class="panel panel-default">
	<div class="panel-heading"><strong>Cari Proyek </strong></div>
	<div class="panel-body">
	<table class="form">
		<tr>
			<td>Tahun Proyek</td>
			<td><input type="text" name="thn_proyek" value="<?php echo($_POST['thn_proyek']); ?>"></td>
		</tr>
		<tr>
			<td>Operator</td>
			<td><input type="text" name="operator" value="<?php echo($_POST['operator']); ?>"></td>
		</tr>
		<tr>
			<td>Proyek</td>
			<td><input type="text" name="proyek" value="<?php echo($_POST['proyek']); ?>"></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<select name="status">
					<option></option>
					<option value="ON_PROGRESS" <?php if($_POST['status']=="ON_PROGRESS") echo("SELECTED"); ?>>ON PROGRESS</option>
					<option value="ARSIP" <?php if($_POST['status']=="ARSIP") echo("SELECTED"); ?>>ARSIP</option>
				</select>
			</td>
		</tr>
		<tr>
			<td></td>
			<td><button type="submit" class="btn btn-primary btn-sm">Cari</button></td>
		</tr>
	</table>
</form>
<br><br>
<?php
if (isset($_POST['thn_proyek']) && isset($_POST['operator']) && isset($_POST['proyek']) && isset($_POST['status'])) {
?>
<table class="table table-bordered" >
	<thead>
		<th class="tengah">NO</th>
		<th class="tengah">Operator</th>
		<th class="tengah">Nama Proyek</th>
		<th class="tengah">Status</th>
		<th class="tengah">Civil<br>Progres</th>
		<th class="tengah">Permit<br>Progres</th>
		<th class="tengah">Administrasi<br>Progres</th>
		<th class="tengah">Detail</th>
	</thead>
	<tbody>
<?php
	$tgl_awal = $_POST['thn_proyek']."-01-01";
	$tgl_akhir = $_POST['thn_proyek']."-12-31";
	$proyek = $_POST['proyek'];
	$operator = $_POST['operator'];
	$status = $_POST['status'];
	$q = "SELECT * FROM proyek WHERE operator LIKE '%$operator%' AND nama_proyek LIKE '%$proyek%' AND status LIKE '%$status%' ";
	if ($_POST['thn_proyek']!="") {
		$q.=" AND (tgl_mulai>='$tgl_mulai' AND tgl_mulai<='$tgl_akhir')";
	}
	$q.=";";
	$r = mysql_query($q);
	$no = 1;
	while ($d = mysql_fetch_assoc($r)) {
?>
		<tr>
			<td align="center"><?php echo $no++; ?></td>
			<td align="center"><?php echo $d['operator']; ?></td>
			<td align="center"><?php echo $d['nama_proyek']; ?></td>
			<td align="center"><?php echo $d['status']; ?></td>
			<td align="center">
						<a href="?mod=proyek_lihat_civil&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button type="button" class="btn btn-info btn-xs">View</button>
						</a>
					</td>
					<td align="center">
						<a href="?mod=proyek_lihat_permit&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button type="button" class="btn btn-info btn-xs">View</button>
						</a>
					</td>
					<td align="center">
						<a href="?mod=proyek_lihat_administrasi&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button type="button" class="btn btn-info btn-xs">View</button>
						</a>
					</td>
			<td align="center">
				<a href="?mod=proyek_daftar_karyawan&id_proyek=<?php echo($d['id_proyek']); ?>">
					<button type="button" class="btn btn-primary btn-xs">view</button>
				</a>
			</td>
			</tr>
<?php
	}
}
?>
	</tbody>
</table>