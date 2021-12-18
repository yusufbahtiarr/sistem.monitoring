<?php
include 'dbconnection.php';
if (isset($_GET['id_proyek'])) {
	if ($_GET['act']=="tambah") {
		$q = "INSERT INTO otoritas
				(id_proyek,id_user,civil,permit,administrasi)
				VALUES
				('".$_GET['id_proyek']."','".$_GET['id_user']."','".$_GET['civil']."','".$_GET['permit']."','".$_GET['administrasi']."');";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="hapus") {
		$id_otoritas=$_GET['id_otoritas'];
		$q = "DELETE FROM otoritas WHERE id_otoritas=$id_otoritas;";
		$r = mysql_query($q);
	}
	elseif ($_GET['act']=="ubah") {
		$id_otoritas=$_GET['id_otoritas'];
		$q = "UPDATE otoritas SET
				id_user='".$_GET['id_user']."',civil='".$_GET['civil']."',permit='".$_GET['permit']."',administrasi='".$_GET['administrasi']."'
				WHERE id_otoritas=$id_otoritas;";
		$r = mysql_query($q);
	}
	//load
?>
							<tr class="active">
								<td>
									<div class="input_container">
										<input type="text" class="form-control" id="oto_nik__0" onkeyup="ajaxaksi('otoritas','search',0)">
										<ul id="list_karyawan__0"></ul>
									</div>
									<input type="hidden" id="oto_id_user__0">
								</td>
								<td><input type="text" class="form-control" id="oto_nama_karyawan__0" readonly></td>
								<td><input type="text" class="form-control" id="oto_jabatan__0" readonly></td>
								<td align="center">
									<select id="oto_civil__0" class="form-control">
										<option value="0" selected>NO</option>
										<option value="1">YES</option>
									</select>
								</td>
								<td align="center">
									<select id="oto_permit__0" class="form-control">
										<option value="0" selected>NO</option>
										<option value="1">YES</option>
									</select>
								</td>
								<td align="center">
									<select id="oto_administrasi__0" class="form-control">
										<option value="0" selected>NO</option>
										<option value="1">YES</option>
									</select>
								</td>
								<td>
									<button type="button" id="btn_tambah_otoritas" class="btn btn-primary btn-sm form-control" onclick="ajaxaksi('otoritas','simpan',0)">
										<span class="glyphicon glyphicon-save"></span> buat
									</button>
									<img src="images/loading.gif" id="loading_img_permit" style="display:none" />
								</td>
							</tr>
							<tr class="">
								<td colspan="7"></td>
							</tr>
<?php
	$query = "SELECT a.*,b.nama,b.nik,c.keterangan FROM otoritas a
				LEFT JOIN user b ON a.id_user = b.id_user
				LEFT JOIN akses c ON b.hak_akses = c.hak_akses
				WHERE a.id_proyek=".$_GET['id_proyek'].";";
	$result = mysql_query($query);
	while ($data_oto = mysql_fetch_assoc($result)) {
		$id_otoritas=$data_oto['id_otoritas'];
?>
							<tr id="otoritas_show__<?php echo($id_otoritas); ?>">
								<td><?php echo($data_oto['nik']); ?></td>
								<td><?php echo($data_oto['nama']); ?></td>
								<td><?php echo($data_oto['keterangan']); ?></td>
								<td align="center"><?php if($data_oto['civil']=="1") echo("YES"); else echo("NO"); ?></td>
								<td align="center"><?php if($data_oto['permit']=="1") echo("YES"); else echo("NO"); ?></td>
								<td align="center"><?php if($data_oto['administrasi']=="1") echo("YES"); else echo("NO"); ?></td>
								<td>
									<button type="button" title="edit" class="btn btn-warning btn-sm" onclick="$('#otoritas_show__<?php echo($id_otoritas); ?>').hide();$('#otoritas_input__<?php echo($id_otoritas); ?>').show()"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" title="hapus" class="btn btn-danger btn-sm" onclick="ajaxaksi('otoritas','hapus',<?php echo($id_otoritas); ?>)"><span class="glyphicon glyphicon-remove"></span></button>
								</td>
							</tr>
							<tr id="otoritas_input__<?php echo($id_otoritas); ?>" style="display:none">
								<td>
									<div class="input_container">
										<input type="text" class="form-control" id="oto_nik__<?php echo($id_otoritas); ?>" onkeyup="ajaxaksi('otoritas','search',<?php echo($id_otoritas); ?>)" value="<?php echo($data_oto['nik']); ?>">
										<ul id="list_karyawan__<?php echo($id_otoritas); ?>"></ul>
									</div>
									<input type="text" id="oto_id_user__<?php echo($id_otoritas); ?>" value="<?php echo($data_oto['id_user']); ?>">
								</td>
								<td><input type="text" class="form-control" id="oto_nama_karyawan__<?php echo($id_otoritas); ?>" readonly value="<?php echo($data_oto['nama']); ?>"></td>
								<td><input type="text" class="form-control" id="oto_jabatan__<?php echo($id_otoritas); ?>" readonly value="<?php echo($data_oto['keterangan']); ?>"></td>
								<td align="center">
									<select id="oto_civil__<?php echo($id_otoritas); ?>" class="form-control">
										<option value="0">NO</option>
										<option value="1" <?php if($data_oto['civil']=='1') echo("selected"); ?>>YES</option>
									</select>
								</td>
								<td align="center">
									<select id="oto_permit__<?php echo($id_otoritas); ?>" class="form-control">
										<option value="0">NO</option>
										<option value="1" <?php if($data_oto['permit']=='1') echo("selected"); ?>>YES</option>
									</select>
								</td>
								<td align="center">
									<select id="oto_administrasi__<?php echo($id_otoritas); ?>" class="form-control">
										<option value="0">NO</option>
										<option value="1" <?php if($data_oto['administrasi']=='1') echo("selected"); ?>>YES</option>
									</select>
								</td>
								<td>
									<button type="button" title="simpan" class="btn btn-primary btn-sm" onclick="ajaxaksi('otoritas','ubah',<?php echo($id_otoritas); ?>)"><span class="glyphicon glyphicon-floppy-save"></span></button>
									<button type="button" title="cancel" class="btn btn-default btn-sm" onclick="$('#otoritas_show__<?php echo($id_otoritas); ?>').show();$('#otoritas_input__<?php echo($id_otoritas); ?>').hide()"><span class="glyphicon glyphicon-ban-circle"></span></button>
								</td>
							</tr>
<?php
	}
}
?>