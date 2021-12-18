<?php
$id_proyek = $_GET['id_proyek'];
$q = "SELECT * FROM proyek WHERE id_proyek=$id_proyek;";
$r = mysql_query($q);
$d = mysql_fetch_assoc($r);
?>
<a href="?mod=proyek_daftar">back</a>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Otoritas</strong></strong></div>
	<div class="panel-body">
<table class="form">
	<tr>
		<td align="right">Operator</td>
		<td><?php echo($d['operator']); ?></td>
	</tr>
	<tr>
		<td align="right">Nama Proyek</td>
		<td><?php echo($d['nama_proyek']); ?></td>
	</tr>
	<tr>
		<td align="right">Tanggal Mulai</td>
		<td><?php echo($d['tgl_mulai']); ?></td>
	</tr>
</table>

<br><br>
<table class="table table-bordered">
	<thead>
		<th>No</th>
		<th>NIK</th>
		<th>Nama</th>
		<th>Jabatan</th>
		<th>View</th>
	</thead>
	<tbody>
<?php
$q = "	SELECT a.id_user,b.nama,c.keterangan,b.nik, b.jabatan FROM otoritas a
			LEFT JOIN user b ON a.id_user=b.id_user
			LEFT JOIN akses c ON b.hak_akses=c.hak_akses
			WHERE a.id_proyek=$id_proyek;";
$r = mysql_query($q);
$no = 1;
while ($d = mysql_fetch_assoc($r)) {
?>
		<tr>
			<td><?php echo($no++); ?></td>
			<td><?php echo($d['nik']); ?></td>
			<td><?php echo($d['nama']); ?></td>
			<td><?php echo($d['jabatan']); ?></td>

			<!-- <td><?php echo($d['level']); ?></td> -->
			<td>
				<a href="?mod=karyawan&act=view&id_user=<?php echo($d['id_user']); ?>">
					<button type="button" class="btn btn-primary btn-xs">view</button>
				</a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>