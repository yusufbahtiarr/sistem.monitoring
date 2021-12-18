<div class="panel panel-default">
	<div class="panel-heading"><strong>LIHAT PROGRES</strong></div>
	<div class="panel-body">
		<table id="example" class="table table-bordered">
			<thead>
				<th align="center">OPERATOR</th>
				<th align="center">NAMA PROYEK</th>
				<th align="center">CIVIL</th>
				<th align="center">PERMIT</th>
				<th align="center">ADMINISTRASI</th>
			</thead>
			<tbody>
<?php
$q = "SELECT * FROM proyek WHERE status='ON PROGRESS' ORDER BY tgl_mulai DESC;;";
$r = mysql_query($q);
$no = 1;
while ($d = mysql_fetch_assoc($r)) {
?>
				<tr>
					<td><?php echo($d['operator']); ?></td>
					<td><?php echo($d['nama_proyek']); ?></td>
					<td align="center">
						<a href="?mod=proyek_lihat_civil&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button class="btn btn-info btn-sm">View</button>
						</a>
					</td>
					<td align="center">
						<a href="?mod=proyek_lihat_permit&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button class="btn btn-info btn-sm">View</button>
						</a>
					</td>
					<td align="center">
						<a href="?mod=proyek_lihat_administrasi&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button class="btn btn-info btn-sm">View</button>
						</a>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
	</div>
</div>