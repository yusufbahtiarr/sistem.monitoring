<a href="?mod=update">back</a>
<div class="panel panel-default">
	<div class="panel-heading"><strong>UPDATE CIVIL</strong></div>
	<div class="panel-body">
<?php
//query nya
$q = "SELECT a.* FROM proyek a
		INNER JOIN otoritas b ON a.id_proyek=b.id_proyek
		WHERE b.id_user={$_SESSION['id_user']} AND b.civil=1 AND a.id_proyek={$_GET['id_proyek']};";
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
	var id_civil_segment;
	function civil_segment () {
		var val = $("#id_civil_segment").val().split("-");
		document.getElementById("nama_segment").innerHTML = val[1];
		civil_segment_get(val[0]);
	}
	function civil_segment_get (id) {
		jQuery.ajax({
			type: "GET",
			url: "update_civil_response_2.php",
			dataType:"text",
			cache:false,
			data:{
				id_proyek:"<?php echo($_GET['id_proyek']); ?>",
				id_civil_segment: id
			},
			success:function(response){
				$("#tbl_civil_segment").empty();
				$("#tbl_civil_segment").append(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	}
	function batal () {
		$("#trenching_p").empty();
		$("#trenching_r").empty();

		$("#jembatan_p").empty();
		$("#jembatan_r").empty();

		$("#joinbox_p").empty();
		$("#joinbox_r").empty();
	}
	function simpan(){
		var val = $("#id_civil_segment").val().split("-");
		jQuery.ajax({
			type: "GET",
			url: "update_civil_response_2.php",
			dataType:"text",
			cache:false,
			data:{
				act:"simpan",
				id_proyek:"<?php echo($_GET['id_proyek']); ?>",
				id_civil_segment: val[0],
				trenching_p:$("#trenching_p").val(),
				trenching_r:$("#trenching_r").val(),
				jembatan_p:$("#jembatan_p").val(),
				jembatan_r:$("#jembatan_r").val(),
				joinbox_p:$("#joinbox_p").val(),
				joinbox_r:$("#joinbox_r").val(),
				pulling_p:$("#pulling_p").val(),
				pulling_r:$("#pulling_r").val(),
				splicing_p:$("#splicing_p").val(),
				splicing_r:$("#splicing_r").val(),
				atp_p:$("#atp_p").val(),
				atp_r:$("#atp_r").val()
			},
			success:function(response){
				$("#tbl_civil_segment").empty();
				$("#tbl_civil_segment").append(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	}
	function hapus(id_civil_segment_update){
		var val = $("#id_civil_segment").val().split("-");
		var r = confirm("Yakin hapus?");
		if (r == true) {
			jQuery.ajax({
				type: "GET",
				url: "update_civil_response_2.php",
				contentType:false,
				cache:false,
				data:{
					act:"hapus",
					id_proyek:"<?php echo($_GET['id_proyek']); ?>",
					id_civil_segment: val[0],
					id_civil_segment_update:id_civil_segment_update
				},
				success:function(response){
					$("#tbl_civil_segment").empty();
					$("#tbl_civil_segment").append(response);
				},
				error:function (xhr, ajaxOptions, thrownError){
					alert(thrownError);
				}
			});
		}
	}
</script>
						<select id="id_civil_segment" name="id_civil_segment" onchange="civil_segment()">
							<option></option>
<?php
$q_cs = "SELECT * FROM civil_segment WHERE id_proyek={$_GET['id_proyek']};";
$r_cs = mysql_query($q_cs);
while ($d_cs = mysql_fetch_assoc($r_cs)) {
?>
							<option value="<?php echo($d_cs['id_civil_segment'].'-'.$d_cs['nama_segment']); ?>"><?php echo($d_cs['no_segment']); ?></option>
<?php
}
?>
						</select>
						<span id="nama_segment"></span>
					</td>
				</tr>
				<tr>
					<td align="right">Tanggal</td>
					<td><input type="text" name="tgl_mulai" readonly value="<?php echo(date('Y-m-d')); ?>"></td>
				</tr>
			</form>
		</table>
		<div id="tbl_civil_segment">
		</div>
	</div>
</div>