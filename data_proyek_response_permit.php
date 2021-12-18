<?php
include 'dbconnection.php';
if (isset($_GET['id_proyek'])) {
	if ($_GET['act']=="tambah") {
		$q = "INSERT INTO permit
				(id_proyek,izin,wilayah,sow)
				VALUES
				('".$_GET['id_proyek']."','".$_GET['izin']."','".$_GET['wilayah']."','".$_GET['sow']."');";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="hapus") {
		$id_permit=$_GET['id_permit'];
		$q = "DELETE FROM permit WHERE id_permit=$id_permit;";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="ubah") {
		$id_permit=$_GET['id_permit'];
		$q = "UPDATE permit SET
				izin='".$_GET['izin']."',wilayah='".$_GET['wilayah']."',sow='".$_GET['sow']."'
				WHERE id_permit=$id_permit;";
		$r = mysql_query($q);
	}
	//load
?>
							<tr class="active">
								<td><input type="text" class="form-control" id="izin"></td>
								<td><input type="text" class="form-control" id="wilayah"></td>
								<td><input type="text" class="form-control" id="sow"></td>
								<td>
									<button type="button" id="btn_tambah_permit" class="btn btn-primary btn-sm form-control" onclick="ajaxaksi('permit','simpan',0)">
										<span class="glyphicon glyphicon-save"></span> buat
									</button>
									<img src="images/loading.gif" id="loading_img_permit" style="display:none" />
								</td>
							</tr>
							<tr>
								<td colspan="4"></td>
							</tr>
<?php
	$query = "SELECT * FROM permit WHERE id_proyek=".$_GET['id_proyek'].";";
	$result = mysql_query($query);
	while ($data_permit = mysql_fetch_assoc($result)) {
		$id_permit=$data_permit['id_permit'];
?>
							<tr id="permit_show__<?php echo($id_permit); ?>">
								<td><?php echo($data_permit['izin']); ?></td>
								<td><?php echo($data_permit['wilayah']); ?></td>
								<td><?php echo($data_permit['sow']); ?></td>
								<td>
									<button type="button" class="btn btn-warning btn-sm" onclick="$('#permit_show__<?php echo($id_permit); ?>').hide();$('#permit_input__<?php echo($id_permit); ?>').show();"><span class="glyphicon glyphicon-pencil"></span> edit</button>
									<button type="button" class="btn btn-danger btn-sm" onclick="ajaxaksi('permit','hapus',<?php echo($id_permit); ?>)"><span class="glyphicon glyphicon-remove"></span> hapus</button>
								</td>
							</tr>
							<tr id="permit_input__<?php echo($id_permit); ?>" style="display:none">
								<td><input type="text" class="form-control" id="izin__<?php echo($id_permit); ?>" value="<?php echo($data_permit['izin']); ?>"></td>
								<td><input type="text" class="form-control" id="wilayah__<?php echo($id_permit); ?>" value="<?php echo($data_permit['wilayah']); ?>"></td>
								<td><input type="text" class="form-control" id="sow__<?php echo($id_permit); ?>" value="<?php echo($data_permit['sow']); ?>"></td>
								<td>
									<button type="button" id="btn_ubah_permit" class="btn btn-primary btn-sm" onclick="ajaxaksi('permit','ubah',<?php echo($id_permit); ?>)"><span class="glyphicon glyphicon-floppy-save"></span> simpan</button>
									<img src="images/loading.gif" id="loading_img_permit_ubah" style="display:none" />
									<button type="button" class="btn btn-default btn-sm" onclick="$('#permit_show__<?php echo($id_permit); ?>').show();$('#permit_input__<?php echo($id_permit); ?>').hide();"><span class="glyphicon glyphicon-ban-circle"></span> cancel</button>
								</td>
							</tr>
<?php
	}
?>
<?php
}
?>
