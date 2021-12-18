<?php
include 'dbconnection.php';
if (isset($_GET['id_proyek'])) {
	if ($_GET['act']=="ubah") {
		$id_proyek=$_GET['id_proyek'];
		$q = "UPDATE proyek SET
				nama_proyek='".$_GET['nama_proyek']."',operator='".$_GET['operator']."',tingkat_kesulitan='".$_GET['tingkat_kesulitan']."',
				tgl_mulai='".$_GET['tgl_mulai']."',status='".$_GET['status']."',tgl_akhir='".$_GET['tgl_akhir']."'
				WHERE id_proyek=$id_proyek;";
		$r = mysql_query($q);
	}
	//load
		$query = "SELECT * FROM proyek WHERE id_proyek=".$_GET['id_proyek'].";";
		$result = mysql_query($query);
		$data_proyek = mysql_fetch_assoc($result);
?>
								<div class="col-md-6" align="right">
					<table class="form">
						<tr>
							<td class="kanan">Nama Operator</td>
							<td><input type="text" class="form-control" id="operator" value="<?php echo($data_proyek['operator']); ?>"></td>
						</tr>
						<tr>
							<td class="kanan">Nama Proyek</td>
							<td><input type="text" class="form-control" id="nama_proyek" value="<?php echo($data_proyek['nama_proyek']); ?>"></td>
						</tr>
						<!-- <tr>
							<td class="kanan">Jangka Waktu</td>
							<td>
								<input type="text" id="jangka_waktu" value="<?php echo($data_proyek['jangka_waktu']); ?>">
								<select id="nama_waktu">
									<option></option>
									<option value="hari" <?php if($data_proyek['nama_waktu']=='hari') echo("SELECTED"); ?>>hari</option>
									<option value="pekan" <?php if($data_proyek['nama_waktu']=='pekan') echo("SELECTED"); ?>>pekan</option>
									<option value="bulan" <?php if($data_proyek['nama_waktu']=='bulan') echo("SELECTED"); ?>>bulan</option>
									<option value="tahun" <?php if($data_proyek['nama_waktu']=='tahun') echo("SELECTED"); ?>>tahun</option>
								</select>
							</td>
						</tr> -->
						<tr>
							<td class="kanan">Tanggal Mulai</td>
							<td><input type="text" id="tgl_mulai" class="form-control datepicker" value="<?php echo($data_proyek['tgl_mulai']); ?>"></td>
						</tr>
						<tr>
							<td class="kanan">Tanggal Akhir</td>
							<td><input type="text" id="tgl_akhir" class="form-control datepicker" value="<?php echo($data_proyek['tgl_akhir']); ?>"></td>
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table class="form">
						
						<tr>
							<td class="kanan">Status</td>
							<td>
								<select id="status" class="form-control" >
									<option></option>
									<option value="ON PROGRESS" <?php if($data_proyek['status']=='ON PROGRESS') echo("SELECTED"); ?>>ON PROGRESS</option>
									<option value="ARSIP" <?php if($data_proyek['status']=='ARSIP') echo("SELECTED"); ?>>ARSIP</option>
								</select>
							</td>
						</tr>
						
						<tr>
							<td class="kanan">Tingkat Kesulitan</td>
							<td>
								<select id="tingkat_kesulitan" class="form-control" >
									<option></option>
									<option value="MUDAH" <?php if($data_proyek['tingkat_kesulitan']=='MUDAH') echo("SELECTED"); ?>>MUDAH</option>
									<option value="SEDANG" <?php if($data_proyek['tingkat_kesulitan']=='SEDANG') echo("SELECTED"); ?>>SEDANG</option>
									<option value="SULIT" <?php if($data_proyek['tingkat_kesulitan']=='SULIT') echo("SELECTED"); ?>>SULIT</option>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<button id="btn_simpan_proyek" class="btn btn-primary btn-sm" onclick="ajaxaksi('proyek','ubah',<?php echo($id_proyek) ?>)"><span class="glyphicon glyphicon-floppy-save"></span> simpan</button>
								<img src="images/loading.gif" id="loading_img_proyek" style="display:none" />							
							</td>
						</tr>
					</table>
				</div>
<?php
}
?>