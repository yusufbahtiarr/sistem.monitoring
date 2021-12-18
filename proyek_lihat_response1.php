<?php
error_reporting(0);
include 'dbconnection.php';
if (isset($_POST['act'])) {
	if ($_POST['act']=="pilih_operator") {
		$operator = $_POST['operator'];
		$q = "SELECT id_proyek,nama_proyek FROM proyek WHERE operator='$operator' ORDER BY nama_proyek ASC;";
		$r = mysql_query($q);
		$response = array();
		while ($d = mysql_fetch_assoc($r)) {
			$response[]=$d;
		}
		echo(json_encode($response));
	}
	elseif ($_POST['act']=="pilih_nama_proyek") {
		$id_proyek = $_POST['id_proyek'];
		$q = "SELECT *  FROM proyek WHERE operator='$operator' ORDER BY nama_proyek ASC;";
		$r = mysql_query($q);
		$response = array();
		while ($d = mysql_fetch_assoc($r)) {
			$response[]=$d;
		}
		echo(json_encode($response));
	}
}
?>