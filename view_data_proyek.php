<?php
switch ($_GET['form']) {
	case 'detil':
		$id_proyek = $_GET['id_proyek'];
?>
<style type="text/css">
.input_container {
	height: 30px;
	float: left;
}
.input_container ul {
	border: 1px solid #eaeaea;
	position: absolute;
	z-index: 9;
	background: #f3f3f3;
	list-style: none;
}
.input_container ul li {
	padding: 2px;
}
.input_container ul li:hover {
	background: #eaeaea;
}
#list_karyawan {
	display: none;
}
</style>
<script type="text/javascript">
	function ajaxaksi (bagian,aksi,id) {
		if (bagian=="proyek"&&aksi=="ubah") {
			$("#btn_simpan_proyek").hide();
			$("#loading_img_proyek").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response.php?act=ubah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					operator:$("#operator").val(),
					nama_proyek:$("#nama_proyek").val(),
					jangka_waktu:$("#jangka_waktu").val(),
					nama_waktu:$("#nama_waktu").val(),
					tgl_mulai:$("#tgl_mulai").val(),
					status:$("#status").val()
				},
				success:function(response){
					$("#data_proyek").empty();
					$("#data_proyek").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
		else if (bagian=="civil_bobot"&&aksi=="ubah") {
			$("#btn_civil_bobot_ubah").hide();
			$("#loading_img_civil_bobot_ubah").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_civil_bobot.php?act=ubah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					id_civil_bobot:id,
					trenching:$("#civil_bobot_trenching").val(),
					jembatan:$("#civil_bobot_jembatan").val(),
					joinbox:$("#civil_bobot_joinbox").val(),
					pulling:$("#civil_bobot_pulling").val(),
					splicing:$("#civil_bobot_splicing").val(),
					atp:$("#civil_bobot_atp").val()
				},
				success:function(response){
					$("#tbody_civil_bobot").empty();
					$("#tbody_civil_bobot").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
		else if (bagian=="civil_segment"&&aksi=="simpan") {
			$("#btn_tambah_civil_segment").hide();
			$("#loading_img_civil_segment").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_civil_segment.php?act=tambah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					no_segment:$("#no_segment").val(),
					nama_segment:$("#nama_segment").val(),
					sow_m:$("#sow_m").val(),
					trenching:$("#trenching").val(),
					jembatan:$("#jembatan").val(),
					joinbox:$("#joinbox").val(),
					pulling:$("#pulling").val(),
					splicing:$("#splicing").val(),
					atp:$("#atp").val()
				},
				success:function(response){
					$("#tbody_civil_segment").empty();
					$("#tbody_civil_segment").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
		else if (bagian=="civil_segment"&&aksi=="ubah") {
			$("#btn_civil_segment_ubah__"+id).hide();
			$("#loading_img_civil_segment_ubah__"+id).show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_civil_segment.php?act=ubah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					id_civil_segment:id,
					no_segment:$("#no_segment__"+id).val(),
					nama_segment:$("#nama_segment__"+id).val(),
					sow_m:$("#sow_m__"+id).val(),
					trenching:$("#trenching__"+id).val(),
					jembatan:$("#jembatan__"+id).val(),
					joinbox:$("#joinbox__"+id).val(),
					pulling:$("#pulling__"+id).val(),
					splicing:$("#splicing__"+id).val(),
					atp:$("#atp__"+id).val()
				},
				success:function(response){
					$("#tbody_civil_segment").empty();
					$("#tbody_civil_segment").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
		else if(bagian=="civil_segment"&&aksi=="hapus"){
			var konfirmasi = confirm("Yakin hapus?");
			if (konfirmasi) {
				jQuery.ajax({
					type: "GET",
					url: "data_proyek_response_civil_segment.php?act=hapus&id_proyek=<?php echo($id_proyek); ?>",
					dataType:"text",
					cache:false,
					data:{
						id_civil_segment:id
					},
					success:function(response){
						$("#tbody_civil_segment").empty();
						$("#tbody_civil_segment").append(response);
					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError);
					}
				});
			}
		}
		else if (bagian=="permit"&&aksi=="simpan") {
			$("#btn_tambah_permit").hide();
			$("#loading_img_permit").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_permit.php?act=tambah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					izin:$("#izin").val(),
					wilayah:$("#wilayah").val(),
					sow:$("#sow").val()
				},
				success:function(response){
					$("#tbody_permit").empty();
					$("#tbody_permit").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
		else if (bagian=="permit"&&aksi=="ubah") {
			$("#btn_ubah_permit").hide();
			$("#loading_img_permit_ubah").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_permit.php?act=ubah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					id_permit:id,
					izin:$("#izin__"+id).val(),
					wilayah:$("#wilayah__"+id).val(),
					sow:$("#sow__"+id).val()
				},
				success:function(response){
					$("#tbody_permit").empty();
					$("#tbody_permit").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
		else if(bagian=="permit"&&aksi=="hapus"){
			var konfirmasi = confirm("Yakin hapus?");
			if (konfirmasi) {
				jQuery.ajax({
					type: "GET",
					url: "data_proyek_response_permit.php?act=hapus&id_proyek=<?php echo($id_proyek); ?>",
					dataType:"text",
					cache:false,
					data:{
						id_permit:id
					},
					success:function(response){
						$("#tbody_permit").empty();
						$("#tbody_permit").append(response);
					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError);
					}
				});
			}
		}
		else if (bagian=="administrasi"&&aksi=="simpan") {
			$("#btn_tambah_administrasi").hide();
			$("#loading_img_administrasi").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_administrasi.php?act=tambah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					no_segment:$("#no_segment_adm").val(),
					abd:$("#abd").val(),
					boq:$("#boq").val(),
					dokumen_atp:$("#dokumen_atp").val(),
					dokumen_otdr:$("#dokumen_otdr").val()
				},
				success:function(response){
					$("#tbody_administrasi").empty();
					$("#tbody_administrasi").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("#btn_tambah_administrasi").show();
					$("#loading_img_administrasi").hide();
					alert(thrownError);
				}
			});
		}
		else if (bagian=="administrasi"&&aksi=="ubah") {
			$("#btn_ubah_administrasi").hide();
			$("#loading_img_administrasi_ubah").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_administrasi.php?act=ubah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					id_administrasi:id,
					no_segment:$("#no_segment_adm__"+id).val(),
					abd:$("#abd__"+id).val(),
					boq:$("#boq__"+id).val(),
					dokumen_atp:$("#dokumen_atp__"+id).val(),
					dokumen_otdr:$("#dokumen_otdr__"+id).val()
				},
				success:function(response){
					$("#tbody_administrasi").empty();
					$("#tbody_administrasi").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("#btn_tambah_administrasi").show();
					$("#loading_img_administrasi").hide();
					alert(thrownError);
				}
			});
		}
		else if(bagian=="administrasi"&&aksi=="hapus"){
			var konfirmasi = confirm("Yakin hapus?");
			if (konfirmasi) {
				jQuery.ajax({
					type: "GET",
					url: "data_proyek_response_administrasi.php?act=hapus&id_proyek=<?php echo($id_proyek); ?>",
					dataType:"text",
					cache:false,
					data:{
						id_administrasi:id
					},
					success:function(response){
						$("#tbody_administrasi").empty();
						$("#tbody_administrasi").append(response);
					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError);
					}
				});
			}
		}

		else if (bagian=="otoritas"&&aksi=="simpan") {
			$("#btn_tambah_otoritas").hide();
			$("#loading_img_otoritas").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_otoritas.php?act=tambah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					id_user:$("#oto_id_user__0").val(),
					civil:$("#oto_civil__0").val(),
					permit:$("#oto_permit__0").val(),
					administrasi:$("#oto_administrasi__0").val()
				},
				success:function(response){
					$("#tbody_otoritas").empty();
					$("#tbody_otoritas").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("#btn_tambah_otoritas").show();
					$("#loading_img_otoritas").hide();
					alert(thrownError);
				}
			});
		}
		else if (bagian=="otoritas"&&aksi=="ubah") {
			$("#btn_tambah_otoritas").hide();
			$("#loading_img_otoritas").show();
			jQuery.ajax({
				type: "GET",
				url: "data_proyek_response_otoritas.php?act=ubah&id_proyek=<?php echo($id_proyek); ?>",
				dataType:"text",
				cache:false,
				data:{
					id_otoritas:id,
					id_user:$("#oto_id_user__"+id).val(),
					civil:$("#oto_civil__"+id).val(),
					permit:$("#oto_permit__"+id).val(),
					administrasi:$("#oto_administrasi__"+id).val()
				},
				success:function(response){
					$("#tbody_otoritas").empty();
					$("#tbody_otoritas").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					$("#btn_tambah_otoritas").show();
					$("#loading_img_otoritas").hide();
					alert(thrownError);
				}
			});
		}
		else if (bagian=="otoritas" && aksi=="search") {
			//alert($("#oto_nik__"+id).val());
			var keyword = $("#oto_nik__"+id).val();
			if (keyword.length >= 0) {
				jQuery.ajax({
					type: "GET",
					url: "autocomplete_karyawan.php?",
					dataType:"text",
					cache:false,
					data:{
						id:id,
						nik:keyword
					},
					success:function(response){
						$("#list_karyawan__"+id).show();
						$("#list_karyawan__"+id).html(response);
					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError);
					}
				});
			}
			else{
				$("#list_karyawan__"+id).hide();
			}
		}
		else if(bagian=="otoritas"&&aksi=="hapus"){
			var konfirmasi = confirm("Yakin hapus?");
			if (konfirmasi) {
				jQuery.ajax({
					type: "GET",
					url: "data_proyek_response_otoritas.php?act=hapus&id_proyek=<?php echo($id_proyek); ?>",
					dataType:"text",
					cache:false,
					data:{
						id_otoritas:id
					},
					success:function(response){
						$("#tbody_otoritas").empty();
						$("#tbody_otoritas").append(response);
					},
					error:function (xhr, ajaxOptions, thrownError){
						alert(thrownError);
					}
				});
			}
		}
	}

	function set_item (items) {
		var item = items.split('-');
		$("#oto_id_user__"+item[0]).val(item[1]);
		$("#oto_nik__"+item[0]).val(item[2]);
		$("#oto_nama_karyawan__"+item[0]).val(item[3]);
		$("#oto_jabatan__"+item[0]).val(item[4]);
		$("#list_karyawan__"+item[0]).hide();
	}

</script>
<div class="panel panel-default">
	<div class="panel-heading"><strong>DATA PROYEK</strong> - Detil</div>
	<div class="panel-body">
			<div class="row" id="data_proyek">
<?php
		$query = "SELECT * FROM proyek WHERE id_proyek=$id_proyek;";
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
						<tr>
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
						</tr>
					</table>
				</div>
				<div class="col-md-6">
					<table class="form">
						<tr>
							<td class="kanan">Tanggal Mulai</td>
							<td><input type="text" id="tgl_mulai" class="form-control datepicker" value="<?php echo($data_proyek['tgl_mulai']); ?>"></td>
						</tr>
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
							<td></td>
							<td>
								<button id="btn_simpan_proyek" class="btn btn-primary btn-sm" onclick="ajaxaksi('proyek','ubah',<?php echo($id_proyek) ?>)"><span class="glyphicon glyphicon-floppy-save"></span> simpan</button>
								<img src="images/loading.gif" id="loading_img_proyek" style="display:none" />							
							</td>
						</tr>
					</table>
				</div>
			</div>
			</table>
			<hr>
			<div class="panel panel-success">
				<div class="panel-heading" align="center">CIVIL</div>
				<div class="panel-body lebihkecil">
					<table class="table table-bordered">
						<thead>
							<td align="center"><strong>Jenis</strong></td>
							<td align="center">TRENCHING</td>
							<td align="center">JEMBATAN</td>
							<td align="center">JOINBOX</td>
							<td align="center">PULLING</td>
							<td align="center">SPLICING</td>
							<td align="center">ATP</td>
							<td></td>
						</thead>
						<tbody id="tbody_civil_bobot">
<?php
		$query = "SELECT * FROM civil_bobot WHERE id_proyek=".$id_proyek.";";
		$result = mysql_query($query);
		$data_civil_bobot = mysql_fetch_assoc($result);
?>
							<tr id="civil_bobot_show">
								<td width="6%" align="center"><strong>Bobot</strong></td>
								<td width="13%" align="center"><?php echo($data_civil_bobot['trenching']); ?>%</td>
								<td width="13%" align="center"><?php echo($data_civil_bobot['jembatan']); ?>%</td>
								<td width="13%" align="center"><?php echo($data_civil_bobot['joinbox']); ?>%</td>
								<td width="13%" align="center"><?php echo($data_civil_bobot['pulling']); ?>%</td>
								<td width="13%" align="center"><?php echo($data_civil_bobot['splicing']); ?>%</td>
								<td width="13%" align="center"><?php echo($data_civil_bobot['atp']); ?>%</td>
								<td width="16%"><button type="button" class="bth btn-warning btn-sm" onclick="$('#civil_bobot_show').hide();$('#civil_bobot_input').show();"><span class="glyphicon glyphicon-pencil"></span> Edit</button></td>
							</tr>
							<tr id="civil_bobot_input" style="display:none">
								<td width="6%" align="center"><strong>Bobot</strong></td>
								<td width="13%" align="center"><input type="text" class="kanan" id="civil_bobot_trenching" size="1" value="<?php echo($data_civil_bobot['trenching']); ?>">%</td>
								<td width="13%" align="center"><input type="text" class="kanan" id="civil_bobot_jembatan" size="1" value="<?php echo($data_civil_bobot['jembatan']); ?>">%</td>
								<td width="13%" align="center"><input type="text" class="kanan" id="civil_bobot_joinbox" size="1" value="<?php echo($data_civil_bobot['joinbox']); ?>">%</td>
								<td width="13%" align="center"><input type="text" class="kanan" id="civil_bobot_pulling" size="1" value="<?php echo($data_civil_bobot['pulling']); ?>">%</td>
								<td width="13%" align="center"><input type="text" class="kanan" id="civil_bobot_splicing" size="1" value="<?php echo($data_civil_bobot['splicing']); ?>">%</td>
								<td width="13%" align="center"><input type="text" class="kanan" id="civil_bobot_atp" size="1" value="<?php echo($data_civil_bobot['atp']); ?>">%</td>
								<td width="16%" align="center">
									<button type="button" class="bth btn-primary btn-sm" onclick="ajaxaksi('civil_bobot','ubah',<?php echo($data_civil_bobot['id_civil_bobot']); ?>)"><span class="glyphicon glyphicon-save"></span> Simpan</button>
									<img src="images/loading.gif" id="loading_img_civil_segment" style="display:none" />
									<button type="button" class="bth btn-default btn-sm" onclick="$('#civil_bobot_show').show();$('#civil_bobot_input').hide();"> Cancel</button>
								</td>
							</tr>
						</tbody>
					</table>
					<br>
					<table class="table table-bordered">
						<thead>
							<th width="8%" class="tengah">SEGMENT</th>
							<th width="27%" class="tengah">NAMA SEGMENT</th>
							<th width="8%" class="tengah">SOW (M)</th>
							<th width="8%" class="tengah">TRENCHING</th>
							<th width="8%" class="tengah">JEMBATAN</th>
							<th width="8%" class="tengah">JOINBOX</th>
							<th width="8%" class="tengah">PULLING</th>
							<th width="8%" class="tengah">SPLICING</th>
							<th width="8%" class="tengah">ATP</th>
							<th width="19%" class="tengah"></th>
						</thead>
						<tbody id="tbody_civil_segment">
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
							<tr class="">
								<td colspan="10"></td>
							</tr>
<?php
			$query = "SELECT * FROM civil_segment WHERE id_proyek=".$id_proyek." ORDER BY no_segment;";
			$result = mysql_query($query);
			while ($data_civil_segment = mysql_fetch_assoc($result)) {
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
									<button type="button" class="btn btn-warning btn-sm" title="edit" onclick="$('#civil_segment_show__<?php echo($id_civil_segment); ?>').hide();$('#civil_segment_input__<?php echo($id_civil_segment); ?>').show();"><span class="glyphicon glyphicon-pencil"></span></button>
									<button type="button" class="btn btn-danger btn-sm" title="hapus" onclick="ajaxaksi('civil_segment','hapus',<?php echo($id_civil_segment); ?>)"><span class="glyphicon glyphicon-remove"></span></button>
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
									<button type="button" id="btn_civil_segment_ubah__<?php echo($id_civil_segment); ?>" title="simpan" class="btn btn-primary btn-sm"
										onclick="ajaxaksi('civil_segment','ubah',<?php echo($id_civil_segment); ?>)">
										<span class="glyphicon glyphicon-floppy-save"></span>
									</button>
									<button type="button" class="btn btn-default btn-sm" title="cancel" onclick="$('#civil_segment_show__<?php echo($id_civil_segment); ?>').show();$('#civil_segment_input__<?php echo($id_civil_segment); ?>').hide();"><span class="glyphicon glyphicon-ban-circle"></span></button>
									<img src="images/loading.gif" id="loading_img_civil_segment_ubah__<?php echo($id_civil_segment); ?>" style="display:none" />
								</td>
							</tr>
<?php
			}
?>
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="panel panel-success">
				<div class="panel-heading" align="center">PERMIT</div>
				<div class="panel-body lebihkecil">
					<table class="table table-bordered">
						<thead>
							<th align="center">IZIN</th>
							<th align="center">WILAYAH</th>
							<th align="center">SOW</th>
							<th align="center"></th>
						</thead>
						<tbody id="tbody_permit">
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
			$query = "SELECT * FROM permit WHERE id_proyek=".$id_proyek.";";
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
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="panel panel-success">
				<div class="panel-heading" align="center">ADMINISTRASI</div>
				<div class="panel-body lebihkecil">
					<table class="table table-bordered">
						<thead>
							<th width="180" align="center">SEGMENT</th>
							<th width="180" align="center">abd</th>
							<th width="180" align="center">BOQ</th>
							<th width="180" align="center">DOKUMEN ATP</th>
							<th width="180" align="center">DOKUMEN OTDR</th>
							<th align="center"></th>
						</thead>
						<tbody id="tbody_administrasi">
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
			$query = "SELECT * FROM administrasi WHERE id_proyek=".$id_proyek.";";
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
?>
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="panel panel-success">
				<div class="panel-heading" align="center">OTORITAS UPDATE</div>
				<div class="panel-body lebihkecil">
					<table class="table table-bordered">
						<thead>
							<th align="center">NIK</th>
							<th align="center">NAMA KARYAWAN</th>
							<th align="center">JABATAN</th>
							<th align="center">CIVIL</th>
							<th align="center">PERMIT</th>
							<th align="center">ADMINISTRASI</th>
							<th align="center"></th>
						</thead>
						<tbody id="tbody_otoritas">
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
			$query = "SELECT a.*,b.nik,b.nama,c.keterangan FROM otoritas a
						LEFT JOIN user b ON a.id_user = b.id_user
						LEFT JOIN akses c ON b.hak_akses = c.hak_akses
						WHERE a.id_proyek=".$id_proyek.";";
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
									<input type="hidden" id="oto_id_user__<?php echo($id_otoritas); ?>">
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
?>
						</tbody>
					</table>
				</div>
			</div>
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
			$query = "INSERT INTO civil_bobot (id_proyek) VALUES ($id_proyek);";
			mysql_query($query);
?>
<script type="text/javascript">
	alert("Tambah data proyek berhasil tersimpan");
	document.location="index.php?mod=data_proyek&form=detil&id_proyek=<?php echo($id_proyek); ?>";
</script>
<?php
		}
		else{
?>
<script type="text/javascript">
	alert("Tambah data proyek gagal");
	document.location="index.php?mod=data_proyek&form=<?php echo($id_proyek); ?>";
</script>
<?php
		}
		break;

	default:
?>
<script type="text/javascript">
	$('#myModal').on('shown.bs.modal', function () {
		$('#myInput').focus()
	})
</script>
<div class="panel panel-default">
	<div class="panel-heading"><strong>DATA PROYEK</strong></div>
	<div class="panel-body">
	<!-- 	<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">
			<span class="glyphicon glyphicon-plus"></span> Tambah Data Proyek
		</button>
		<br><br><br> -->
		<form action="?mod=view_data_proyek&act=filter" method="POST">
			<table class="form">
				<tr>
					<td class="kanan">STATUS</td>
					<td>
						<select name="status">
							<option value=""></option>
							<option value="ON PROGRESS">ON PROGRESS</option>
							<option value="ARSIP">ARSIP</option>
						</select>
						<button type="submit" class="btn btn-default btn-sm" name="act" title="filter" value="filter"><span class="glyphicon glyphicon-filter"></span></button>
					</td>
				</tr>
			</table>
		</form>
		<br>
		<table class="table table-bordered" id="example" width="100%">
			<thead>
				<th class="tengah">OPERATOR</th>
				<th class="tengah">NAMA PROYEK</th>
				<th class="tengah">TOOL</th>
			</thead>
			<tbody>
<?php
	$query = "SELECT * FROM proyek ";
	if ($_GET['act']=="filter") {
		$query.=" WHERE status='".$_POST['status']."';";
	}
	$result = mysql_query($query);
	while ($data=mysql_fetch_assoc($result)) {
?>
				<tr>
					<td><?php echo($data['operator']); ?></td>
					<td><?php echo($data['nama_proyek']); ?></td>
					<td width="180px">
						<a href="?mod=proyek_daftar_karyawan&id_proyek=<?php echo($d['id_proyek']); ?>">
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Data Proyek</h4>
			</div>
			<form action="?mod=data_proyek&form=insert" method="POST">
			<div class="modal-body">
				<table class="form" width="100%">
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
					<td><input type="text" name="tgl_mulai" class="datepicker"></td>
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
			</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Save</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php
		break;
}
?>	