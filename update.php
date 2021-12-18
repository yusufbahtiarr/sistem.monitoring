<div class="panel panel-default">
	<div class="panel-heading"><strong>UPDATE PROGRES</strong></div>
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
$q = "SELECT a.*,b.civil,b.permit,b.administrasi FROM proyek a
		INNER JOIN otoritas b ON a.id_proyek=b.id_proyek
		WHERE a.status='ON PROGRESS'
			AND b.id_user={$_SESSION['id_user']}
			AND (b.civil='1' OR b.permit='1' OR b.administrasi='1')
			ORDER BY a.tgl_mulai DESC;";
$r = mysql_query($q);
$no = 1;
while ($d = mysql_fetch_assoc($r)) {
?>
				<tr>
					<td><?php echo($d['operator']); ?></td>
					<td><?php echo($d['nama_proyek']); ?></td>
					<td align="center">
						<?php if($d['civil']=='1'){ ?>
						<a href="?mod=update_civil&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button class="btn btn-primary btn-sm">YES</button>
						</a>
						<?php } else{ echo('NO'); } ?>
					</td>
					<td align="center">
						<?php if($d['permit']=='1'){ ?>
						<a href="?mod=update_permit&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button class="btn btn-primary btn-sm">YES</button>
						</a>
						<?php } else{ echo('NO'); } ?>
					</td>
					<td align="center">
						<?php if($d['administrasi']=='1'){ ?>
						<a href="?mod=update_administrasi&id_proyek=<?php echo($d['id_proyek']); ?>">
							<button class="btn btn-primary btn-sm">YES</button>
						</a>
						<?php } else{ echo('NO'); } ?>
					</td>
				</tr>
<?php
}
?>
			</tbody>
		</table>
	</div>
</div>