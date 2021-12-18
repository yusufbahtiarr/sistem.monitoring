<script type="text/javascript">
function proyek (operator) {
	if (operator != "") {
		jQuery.ajax({
			type: "POST",
			url: "proyek_lihat_response.php",
			cache:false,
			data:{
				act:"pilih_operator",
				operator:operator
			},
			dataType:"json",
			success:function(response){
				proyek_render(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	}
}
function proyek_render (response) {
	var result;
	for (var i = 0; i < response.length; i++) {
		result +=	"<option value='"+response[i]["id_proyek"]+"'>"
					+ response[i]["nama_proyek"]
					+"</option>";
	}
	$("#nama_proyek").empty();
	$("#nama_proyek").append("<option></option>");
	$("#nama_proyek").append(result);
}

function detil_proyek (id_proyek) {
	/*if (id_proyek != "") {
		jQuery.ajax({
			type: "POST",
			url: "proyek_lihat_response.php",
			cache:false,
			data:{
				act:"pilih_nama_proyek",
				id_proyek:id_proyek
			},
			dataType:"json",
			success:function(response){
				proyek_render(response);
			},
			error:function (xhr, ajaxOptions, thrownError){
				alert(thrownError);
			}
		});
	}
	*/
}
function detil_proyek_render (response){

}
</script>
<div class="jumbotron">
	<div class="row">
		<div class="col-md-6">
			<table class="form">
				<tr>
					<td align="right">Operator</td>
					<td align="left">
						<select id="operator" onchange="proyek(this.value);">
							<option></option>
<?php
$q = "SELECT DISTINCT operator FROM proyek ORDER BY operator;";
$r = mysql_query($q);
while ($d = mysql_fetch_assoc($r)) {
	$operator = $d['operator'];
?>
	<option value="<?php echo($operator); ?>"><?php echo($operator); ?></option>
<?php
}
?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right">Nama Proyek</td>
					<td>
						<select id="nama_proyek" onchange="detil_proyek(this.value)">
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>