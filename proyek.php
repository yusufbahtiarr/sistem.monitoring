<?php
switch ($_GET['form']) {
	case 'add':
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong>DATA PROYEK</strong> - Tambah</div>
	<div class="panel-body">
		<form action="?mod=proyek&form=insert" method="POST">
			<table class="form">
				<tr>
					<td class="kanan">Nama Operator</td>
					<td><input type="text" name="operator"></td>
				</tr>
				<tr>
					<td class="kanan">Nama Proyek</td>
					<td><input type="text" name="nama_proyek"></td>
				</tr>
				<tr>
					<td class="kanan">Jangka Waktu</td>
					<td>
						<input type="text" name="jangka_waktu">
						<select name="nama_waktu">
							<option></option>
							<option value="hari">hari</option>
							<option value="pekan">pekan</option>
							<option value="bulan">bulan</option>
							<option value="tahun">tahun</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="kanan">Tanggal Mulai</td>
					<td><input type="text" name="tgl_mulai" id="datepicker"></td>
				</tr>
				<tr>
					<td class="kanan">Status</td>
					<td>
						<select name="status">
							<option></option>
							<option value="ON PROGRESS">ON PROGRESS</option>
							<option value="ARSIP">ARSIP</option>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><button class="btn btn-primary">Simpan & Proses Selanjutnya</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>
<?php
		break;

	case 'insert':
		$query = "INSERT INTO proyek
					(operator,nama_proyek,jangka_waktu,nama_waktu,tgl_mulai,status) VALUES
					('".$_POST['operator']."','".$_POST['nama_proyek']."','".$_POST['jangka_waktu']."','".$_POST['nama_waktu']."','".$_POST['tgl_mulai']."','".$_POST['status']."');";
		$result = mysql_query($query);
		$id_proyek = mysql_insert_id();
		if ($result) {
			$query = "INSERT INTO civil_bobot(id_proyek,trenching,jembatan,joinbox,pulling,splicing,atp) VALUES
						(".$id_proyek.",0,0,0,0,0,0);";
			mysql_query($query);
			$query = "INSERT INTO civil_segment(
						id_proyek,no_segment,nama_segment,sow_m,trenching,jembatan,joinbox,pulling,splicing,atp
						) VALUES (
						".$id_proyek.",1,'','','','','','','',''
						);";
			mysql_query($query);
			$query = "INSERT INTO permit(
						id_proyek,izin,wilayah,sow,url_dokumen
						) VALUES (
						".$id_proyek.",'','',0,''
						);";
			mysql_query($query);
			$query = "INSERT INTO administrasi (
						id_proyek,no_segment,adb,boq,dokumen_atp,dokumen_otdr
						) VALUES (
						".$id_proyek.",'','','','',''
						);";
			mysql_query($query);
?>
<script type="text/javascript">
	alert("Tambah data proyek berhasil tersimpan");
	document.location="index.php?mod=proyek&form=detil&id_proyek=<?php echo($id_proyek); ?>";
</script>
<?php
		}
		else{
?>
<script type="text/javascript">
	alert("Tambah data proyek gagal");
	document.location="index.php?mod=proyek&form=<?php echo($id_proyek); ?>";
</script>
<?php
		}
		break;

	case 'detil':
		$id_proyek = $_GET['id_proyek'];
		$query = "SELECT * FROM proyek;";
		$result = mysql_query($query);
		$data_proyek = mysql_fetch_assoc($result);
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong>DATA PROYEK</strong> - Detil</div>
	<div class="panel-body">
		<form action="?mod=proyek&form=edit" method="POST">
			<table class="form">
				<tr>
					<td class="kanan">Nama Operator</td>
					<td><input type="text" name="operator" value="<?php echo($data_proyek['operator']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan">Nama Proyek</td>
					<td><input type="text" name="nama_proyek" value="<?php echo($data_proyek['nama_proyek']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan">Jangka Waktu</td>
					<td>
						<input type="text" name="jangka_waktu" value="<?php echo($data_proyek['jangka_waktu']); ?>">
						<select name="nama_waktu">
							<option></option>
							<option value="hari" <?php if($data_proyek['nama_waktu']=='hari') echo("SELECTED"); ?>>hari</option>
							<option value="pekan" <?php if($data_proyek['nama_waktu']=='pekan') echo("SELECTED"); ?>>pekan</option>
							<option value="bulan" <?php if($data_proyek['nama_waktu']=='bulan') echo("SELECTED"); ?>>bulan</option>
							<option value="tahun" <?php if($data_proyek['nama_waktu']=='tahun') echo("SELECTED"); ?>>tahun</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="kanan">Tanggal Mulai</td>
					<td><input type="text" name="tgl_mulai" id="datepicker" value="<?php echo($data_proyek['tgl_mulai']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan">Status</td>
					<td>
						<select name="status">
							<option></option>
							<option value="ON PROGRESS" <?php if($data_proyek['status']=='ON PROGRESS') echo("SELECTED"); ?>>ON PROGRESS</option>
							<option value="ARSIP" <?php if($data_proyek['status']=='ARSIP') echo("SELECTED"); ?>>ARSIP</option>
						</select>
					</td>
				</tr>
			</table>
			<hr>
			<div class="panel panel-success">
				<div class="panel-heading">CIVIL</div>
				<div class="panel-body">
					<table class="table-bordered lebihkecil">
						<thead>
							<th class="kanan">Jenis</th>
							<th>Bobot</th>
						</thead>
		<?php
					$query = "SELECT * FROM civil_bobot WHERE id_proyek=".$id_proyek.";";
					$result = mysql_query($query);
					$data_civil_bobot = mysql_fetch_assoc($result);
		?>
						<tbody>
							<tr><td class="kanan">TRENCHING</td><td><input type="text" class="kanan" name="trenching" size="1" value="<?php echo($data_civil_bobot['trenching']); ?>"></td></tr>
							<tr><td>JEMBATAN</td><td><input type="text" class="kanan form-control" name="jembatan" size="1" value="<?php echo($data_civil_bobot['jembatan']); ?>"></td></tr>
							<tr><td>JOINBOX</td><td><input type="text" class="kanan" name="joinbox" size="1" value="<?php echo($data_civil_bobot['joinbox']); ?>"></td></tr>
							<tr><td>PULLING</td><td><input type="text" class="kanan" name="pulling" size="1" value="<?php echo($data_civil_bobot['pulling']); ?>"></td></tr>
							<tr><td>SPLICING</td><td><input type="text" class="kanan" name="splicing" size="1" value="<?php echo($data_civil_bobot['splicing']); ?>"></td></tr>
							<tr><td>ATP</td><td><input type="text" class="kanan" name="atp" size="1" value="<?php echo($data_civil_bobot['atp']); ?>"></td></tr>
						</tbody>
					</table>
					<br>
					<button type="submit" name="act" value="add_civil_segment" class="btn btn-success btn-sm">+</button>
					<table class="table table-bordered lebihkecil">
						<thead>
							<th class="tengah">SEGMENT</th>
							<th class="tengah">NAMA SEGMENT</th>
							<th class="tengah">SOW (M)</th>
							<th class="tengah">TRENCHING</th>
							<th class="tengah">JEMBATAN</th>
							<th class="tengah">JOINBOX</th>
							<th class="tengah">PULLING</th>
							<th class="tengah">SPLICING</th>
							<th class="tengah">ATP</th>
						</thead>
						<tbody>
<?php
			$query = "SELECT * FROM civil_segment WHERE id_proyek=".$id_proyek.";";
			$result = mysql_query($query);
			while ($data_civil_segment = mysql_fetch_assoc($result)) {
?>
							<tr>
								<td><input type="text" class="form-control kanan" name="trenching" size="1" value="<?php echo($data_civil_segment['no_segment']); ?>"></td>
								<td><input type="text" class="form-control kanan" name="trenching" size="1" value="<?php echo($data_civil_segment['nama_segment']); ?>"></td>
								<td><?php echo($data_civil_segment['sow_m']); ?></td>
								<td><?php echo($data_civil_segment['trenching']); ?></td>
								<td><?php echo($data_civil_segment['jembatan']); ?></td>
								<td><?php echo($data_civil_segment['joinbox']); ?></td>
								<td><?php echo($data_civil_segment['pulling']); ?></td>
								<td><?php echo($data_civil_segment['splicing']); ?></td>
								<td><?php echo($data_civil_segment['atp']); ?></td>
							</tr>
<?php
			}
?>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
		break;

	default:
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong>DATA PROYEK</strong></div>
	<div class="panel-body">
		<a href="?mod=proyek&form=add"><button class="btn btn-success">Tambah Proyek</button></a>
		<br><br>
		<form action="?mod=proyek&act=filter"></form>
		<table class="form">
			<tr>
				<td class="kanan">STATUS</td>
				<td>
					<select name="status">
						<option value=""></option>
						<option value="ON PROGRESS">ON PROGRESS</option>
						<option value="ARSIP">ARSIP</option>
					</select>
					<button type="submit" class="btn btn-default btn-sm" name="act" value="filter"><span class="glyphicon glyphicon-filter"></span></button>
				</td>
			</tr>
		</table>
		<table class="table table-bordered lebihkecil" id="example" width="100%">
			<thead>
				<th class="tengah">OPERATOR</th>
				<th class="tengah">NAMA PROYEK</th>
				<th class="tengah">TOOL</th>
			</thead>
			<tbody>
<?php
	$query = "SELECT * FROM proyek ";
	if ($_GET['act']=="filter") {
		$query.=" WHERE status='".$_GET['status']."';";
	}
	$result = mysql_query($query);
	while ($data=mysql_fetch_assoc($result)) {
?>
				<tr>
					<td><?php echo($data['operator']); ?></td>
					<td><?php echo($data['nama_proyek']); ?></td>
					<td width="180px">
						<a href="?mod=proyek&form=detil&id_proyek=<?php echo($data['id_proyek']); ?>" title="detil">
							<button class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-tasks"></span></button>
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
<?php
		break;
}
?>	