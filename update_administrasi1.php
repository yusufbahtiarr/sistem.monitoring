<div class="panel panel-default">
	<div class="panel-heading"><strong>UPDATE ADMINISTRASI</strong></div>
	<div class="panel-body">
<?php
//query nya
$q = "SELECT a.* FROM proyek a
		INNER JOIN otoritas b ON a.id_proyek=b.id_proyek
		WHERE b.id_user={$_SESSION['id_user']} AND b.administrasi=1 AND a.id_proyek={$_GET['id_proyek']};";
//eksekusi query nya & hasilnya(result) ditampung di $r
$r = mysql_query($q);
$d = mysql_fetch_assoc($r);
?>
		<table class="table table-bordered">
			<form method="POST" action="?mod=update_civil&id_proyek=<?php echo($_GET['id_proyek']); ?>">
				<tr>
					<td align="right">OPERATOR</td>
					<td>
						<input type="text" name="operator" readonly value="<?php echo($d['operator']); ?>">
					</td>
				</tr>
				<tr>
					<td align="right">PROYEK</td>
					<td>
						<input type="text" name="proyek" readonly value="<?php echo($d['nama_proyek']); ?>">
					</td>
				</tr>
				<tr>
					<td align="right">SEGMENT</td>
					<td>
<script type="text/javascript">
	function administrasi () {
		var val = $("#id_administrasi").val().split("-");
		//document.getElementById("nama_segment").innerHTML = val[1];
		administrasi_get(val[0]);
	}
	function administrasi_get (id) {
		jQuery.ajax({
			type: "GET",
			url: "update_administrasi_response.php",
			dataType:"text",
			cache:false,
			data:{
				id_proyek:"<?php echo($_GET['id_proyek']); ?>",
				id_administrasi: id,
				id_user: "<?php echo($_SESSION['id_user']); ?>"
			},
			success:function(response){
				$("#tbl_administrasi").empty();
				$("#tbl_administrasi").append(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	}
	function batal () {
		$("#abd_p").empty();
		$("#abd_d").empty();
		$("#abd_r").empty();
		$("#boq_p").empty();
		$("#boq_d").empty();
		$("#boq_r").empty();
		$("#dokumen_atp_p").empty();
		$("#dokumen_atp_d").empty();
		$("#dokumen_atp_r").empty();
		$("#dokumen_otdr_p").empty();
		$("#dokumen_otdr_d").empty();
		$("#dokumen_otdr_r").empty();
	}
	function simpan(){
		var val = $("#id_administrasi").val().split("-");
		alert("update_administrasi_response.php?act=simpan&id_proyek=<?php echo($_GET['id_proyek']); ?>&id_user=<?php echo($_SESSION['id_user']); ?>&id_administrasi="+val[0]);
		jQuery.ajax({
			type: "POST",
			url: "update_administrasi_response.php?act=simpan&id_proyek=<?php echo($_GET['id_proyek']); ?>&id_user=<?php echo($_SESSION['id_user']); ?>&id_administrasi="+val[0],
			contentType:false,
			cache:false,
			data:{
				act:"simpan",
				id_proyek:"<?php echo($_GET['id_proyek']); ?>",
				id_administrasi: val[0],
				abd_p: $("#abd_p").val(),
				abd_d: $("#abd_d").val(),
				abd_r: $("#abd_r").val(),
				boq_p: $("#boq_p").val(),
				boq_d: $("#boq_d").val(),
				boq_r: $("#boq_r").val(),
				dokumen_atp_p: $("#dokumen_atp_p").val(),
				dokumen_atp_d: $("#dokumen_atp_d").val(),
				dokumen_atp_r: $("#dokumen_atp_r").val(),
				dokumen_otdr_p: $("#dokumen_otdr_p").val(),
				dokumen_otdr_d: $("#dokumen_otdr_d").val(),
				dokumen_otdr_r: $("#dokumen_otdr_r").val()
			},
			success:function(response){
				$("#tbl_administrasi").empty();
				$("#tbl_administrasi").append(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	}
	function hapus(id_administrasi_update){
		var val = $("#id_administrasi").val().split("-");
		var r = confirm("Yakin hapus?");
		if (r == true) {
			jQuery.ajax({
				type: "GET",
				url: "update_administrasi_response.php",
				contentType:false,
				cache:false,
				data:{
					act:"hapus",
					id_proyek:"<?php echo($_GET['id_proyek']); ?>",
					id_administrasi: val[0],
					id_administrasi_update:id_administrasi_update
				},
				success:function(response){
					$("#tbl_administrasi").empty();
					$("#tbl_administrasi").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	}
</script>
						<select id="id_administrasi" name="id_administrasi" onchange="administrasi()">
							<option></option>
<?php
$q_cs = "SELECT * FROM administrasi WHERE id_proyek={$_GET['id_proyek']};";
$r_cs = mysql_query($q_cs);
while ($d_cs = mysql_fetch_assoc($r_cs)) {
?>
							<option value="<?php echo($d_cs['id_administrasi']); ?>"><?php echo($d_cs['no_segment']); ?></option>
<?php
}
?>
						</select>
						<!--<span id="nama_segment"></span>-->
					</td>
				</tr>
				<tr>
					<td align="right">Tanggal</td>
					<td><input type="text" name="tgl_mulai" readonly value="<?php echo(date('Y-m-d')); ?>"></td>
				</tr>
			</form>
		</table>
		<div id="tbl_administrasi">
		</div>
	</div>
</div>