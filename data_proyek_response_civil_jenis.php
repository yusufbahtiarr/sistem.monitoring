<?php
include 'dbconnection.php';
if (isset($_GET['id_proyek'])) {
	if ($_GET['act']=="ubah") {
		$id_civil_bobot=$_GET['id_civil_bobot'];
		$q = "UPDATE civil_bobot SET
				trenching='".$_GET['trenching']."',jembatan='".$_GET['jembatan']."',joinbox='".$_GET['joinbox']."',
				pulling='".$_GET['pulling']."',splicing='".$_GET['splicing']."',atp='".$_GET['atp']."'
				WHERE id_civil_bobot='".$_GET['id_civil_bobot']."';
				";
		$r = mysql_query($q);
	}
	//load
	$query = "SELECT * FROM civil_bobot WHERE id_proyek=".$_GET['id_proyek'].";";
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
<?php
}
?>