<?php
include 'dbconnection.php';
if (isset($_GET['id_proyek'])) {
	if ($_GET['act']=="tambah") {
		$q = "INSERT INTO administrasi
				(id_proyek,no_segment,abd,boq,dokumen_atp,dokumen_otdr)
				VALUES
				('".$_GET['id_proyek']."','".$_GET['no_segment']."','".$_GET['abd']."','".$_GET['boq']."','".$_GET['dokumen_atp']."','".$_GET['dokumen_otdr']."');";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="hapus") {
		$id_administrasi=$_GET['id_administrasi'];
		$q = "DELETE FROM administrasi WHERE id_administrasi=$id_administrasi;";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="ubah") {
		$id_administrasi=$_GET['id_administrasi'];
		$q = "UPDATE administrasi SET
				no_segment='".$_GET['no_segment']."',abd='".$_GET['abd']."',boq='".$_GET['boq']."',
				dokumen_atp='".$_GET['dokumen_atp']."',dokumen_otdr='".$_GET['dokumen_otdr']."'
				WHERE id_administrasi=$id_administrasi;";
		$r = mysql_query($q);
	}
	//load
?>
<tr class="active">
								<td><input type="text" class="form-control" id="no_segment_adm"></td>
								<td><input type="text" class="form-control" id="abd"></td>
								<td><input type="text" class="form-control" id="boq"></td>
								<td><input type="text" class="form-control" id="dokumen_atp"></td>
								<td><input type="text" class="form-control" id="dokumen_otdr"></td>
								<td>
									<button type="button" id="btn_tambah_administrasi" class="btn btn-primary btn-sm form-control" onclick="ajaxaksi('administrasi','simpan',0)">
										<span class="glyphicon glyphicon-save"></span> buat
									</button>
									<img src="images/loading.gif" id="loading_img_administrasi" style="display:none" />
								</td>
							</tr>
							<tr>
								<td colspan="6"></td>
							</tr>
<?php
	$query = "SELECT * FROM administrasi WHERE id_proyek=".$_GET['id_proyek'].";";
	$result = mysql_query($query);
	while ($data_administrasi = mysql_fetch_assoc($result)) {
		$id_administrasi=$data_administrasi['id_administrasi'];
?>
							<tr id="administrasi_show__<?php echo($id_administrasi); ?>">
								<td><?php echo($data_administrasi['no_segment']); ?></td>
								<td><?php echo($data_administrasi['abd']); ?></td>
								<td><?php echo($data_administrasi['boq']); ?></td>
								<td><?php echo($data_administrasi['dokumen_atp']); ?></td>
								<td><?php echo($data_administrasi['dokumen_otdr']); ?></td>
								<td>
									<button type="button" class="btn btn-warning btn-sm" onclick="$('#administrasi_show__<?php echo($id_administrasi); ?>').hide();$('#administrasi_input__<?php echo($id_administrasi); ?>').show()"><span class="glyphicon glyphicon-pencil"></span> edit</button>
									<button type="button" class="btn btn-danger btn-sm" onclick="ajaxaksi('administrasi','hapus',<?php echo($id_administrasi); ?>)"><span class="glyphicon glyphicon-remove"></span> hapus</button>
								</td>
							</tr>
							<tr id="administrasi_input__<?php echo($id_administrasi); ?>" style="display:none">
								<td><input type="text" class="form-control" id="no_segment_adm__<?php echo($id_administrasi); ?>" value="<?php echo($data_administrasi['no_segment']); ?>"></td>
								<td><input type="text" class="form-control" id="abd__<?php echo($id_administrasi); ?>" value="<?php echo($data_administrasi['abd']); ?>"></td>
								<td><input type="text" class="form-control" id="boq__<?php echo($id_administrasi); ?>" value="<?php echo($data_administrasi['boq']); ?>"></td>
								<td><input type="text" class="form-control" id="dokumen_atp__<?php echo($id_administrasi); ?>" value="<?php echo($data_administrasi['dokumen_atp']); ?>"></td>
								<td><input type="text" class="form-control" id="dokumen_otdr__<?php echo($id_administrasi); ?>" value="<?php echo($data_administrasi['dokumen_otdr']); ?>"></td>
								<td>
									<button type="button" class="btn btn-primary btn-sm" onclick="ajaxaksi('administrasi','ubah',<?php echo($id_administrasi); ?>)"><span class="glyphicon glyphicon-floppy-save"></span> simpan</button>
									<button type="button" class="btn btn-default btn-sm" onclick="$('#administrasi_show__<?php echo($id_administrasi); ?>').show();$('#administrasi_input__<?php echo($id_administrasi); ?>').hide()"><span class="glyphicon glyphicon-ban-circle"></span> cancel</button>
								</td>
							</tr>
<?php
	}
}
?>