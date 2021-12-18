<tr class="active">
	<td><input type="text" class="form-control tengah" id="no_segment"></td>
	<td><input type="text" class="form-control tengah" id="nama_segment"></td>
	<td><input type="text" class="form-control tengah" id="sow_m"></td>
	<td><input type="text" class="form-control tengah" id="trenching"></td>
	<td><input type="text" class="form-control tengah" id="jembatan"></td>
	<td><input type="text" class="form-control tengah" id="joinbox"></td>
	<td><input type="text" class="form-control tengah" id="pulling"></td>
	<td><input type="text" class="form-control tengah" id="splicing"></td>
	<td><input type="text" class="form-control tengah" id="atp"></td>
	<td>
	<button type="button" id="btn_tambah_civil_segment" class="btn btn-primary btn-sm form-control" onclick="ajaxaksi('civil_segment','simpan',0)" data-dismiss="modal">
			<span class="glyphicon glyphicon-save"></span> buat
		</button>
		<img src="images/loading.gif" id="loading_img_civil_segment" style="display:none" />
	</td>
</tr>
<?php
include 'dbconnection.php';
if (isset($_GET['id_proyek'])) {
	if ($_GET['act']=="tambah") {
		$q = "INSERT INTO civil_segment
				(id_proyek,no_segment,
				nama_segment,sow_m,trenching,
				jembatan,joinbox,pulling,
				splicing,atp)
				VALUES
				('".$_GET['id_proyek']."','".$_GET['no_segment']."',
				'".$_GET['nama_segment']."','".$_GET['sow_m']."','".$_GET['trenching']."',
				'".$_GET['jembatan']."','".$_GET['joinbox']."','".$_GET['pulling']."',
				'".$_GET['splicing']."','".$_GET['atp']."');";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="hapus") {
		$id_civil_segment=$_GET['id_civil_segment'];
		$q = "DELETE FROM civil_segment WHERE id_civil_segment=$id_civil_segment;";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="ubah") {
		$id_civil_segment=$_GET['id_civil_segment'];
		$q = "UPDATE civil_segment SET
				no_segment='".$_GET['no_segment']."',
				nama_segment='".$_GET['nama_segment']."',
				sow_m='".$_GET['sow_m']."',
				trenching='".$_GET['trenching']."',
				jembatan='".$_GET['jembatan']."',
				joinbox='".$_GET['joinbox']."',
				pulling='".$_GET['pulling']."',
				splicing='".$_GET['splicing']."',
				atp='".$_GET['atp']."'
				WHERE id_civil_segment=$id_civil_segment;";
		$r = mysql_query($q);
	}
	//load
	$q = "SELECT * FROM civil_segment WHERE id_proyek=".$_GET['id_proyek']." ORDER BY no_segment;";
	$r = mysql_query($q);
	while ($data_civil_segment = mysql_fetch_assoc($r)) {
		$id_civil_segment=$data_civil_segment['id_civil_segment'];
?>
<tr id="civil_segment_show__<?php echo($id_civil_segment); ?>">
	<td align="center"><?php echo($data_civil_segment['no_segment']); ?></td>
	<td align="center"><?php echo($data_civil_segment['nama_segment']); ?></td>
	<td align="center"><?php echo($data_civil_segment['sow_m']); ?></td>
	<td align="center"><?php echo($data_civil_segment['trenching']); ?></td>
	<td align="center"><?php echo($data_civil_segment['jembatan']); ?></td>
	<td align="center"><?php echo($data_civil_segment['joinbox']); ?></td>
	<td align="center"><?php echo($data_civil_segment['pulling']); ?></td>
	<td align="center"><?php echo($data_civil_segment['splicing']); ?></td>
	<td align="center"><?php echo($data_civil_segment['atp']); ?></td>
	<td>
		<button type="button" class="btn btn-warning btn-xs" title="edit" onclick="$('#civil_segment_show__<?php echo($id_civil_segment); ?>').hide();$('#civil_segment_input__<?php echo($id_civil_segment); ?>').show();"><span class="glyphicon glyphicon-pencil"></span></button>
		<button type="button" class="btn btn-danger btn-xs" title="hapus" onclick="ajaxaksi('civil_segment','hapus',<?php echo($id_civil_segment); ?>)"><span class="glyphicon glyphicon-remove"></span></button>
	</td>
</tr>
<tr id="civil_segment_input__<?php echo($id_civil_segment); ?>" style="display:none">
	<td><input type="text" class="form-control tengah" id="no_segment__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['no_segment']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="nama_segment__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['nama_segment']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="sow_m__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['sow_m']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="trenching__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['trenching']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="jembatan__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['jembatan']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="joinbox__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['joinbox']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="pulling__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['pulling']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="splicing__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['splicing']); ?>"></td>
	<td><input type="text" class="form-control tengah" id="atp__<?php echo($id_civil_segment); ?>" size="1" value="<?php echo($data_civil_segment['atp']); ?>"></td>
	<td>
		<button type="button" id="btn_civil_segment_ubah__<?php echo($id_civil_segment); ?>" title="simpan" class="btn btn-primary btn-sm form-control"
			onclick="ajaxaksi('civil_segment','ubah',<?php echo($id_civil_segment); ?>)">
			<span class="glyphicon glyphicon-floppy-save"></span>
		</button>
		<img src="images/loading.gif" id="loading_img_civil_segment_ubah__<?php echo($id_civil_segment); ?>" style="display:none" />
	</td>
</tr>
<?php
	}
}
?>
