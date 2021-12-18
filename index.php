<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Sistem Monitoring</title>

	<!-- JQuery -->
	<link href="css/jquery-ui.css" rel="stylesheet">
	<script type="text/javascript" src="js/jquery-1.11.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui.js"></script>
	
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/signin.css">
	<script type="text/javascript" src="js/chart.min.js"></script>

	<!-- BOOTSTRAP -->
	<link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="plugin/bootstrap/css/bootstrap-clockpicker.min.css">
	<script type="text/javascript" src="plugin/bootstrap/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="plugin/bootstrap/js/bootstrap-clockpicker.min.js"></script>

	<!-- DATATABLE -->
	<link rel="stylesheet" type="text/css" href="plugin/datatables/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="plugin/datatables/css/jquery.dataTables_themeroller.css">
	<script type="text/javascript" src="plugin/datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript">
		$(document).ready( function () {
			$('#example').DataTable({
				'iDisplayLength': 50
			});
			$( ".datepicker" ).datepicker({
				'dateFormat' : 'yy-mm-dd',
				beforeShow: function (input, inst) {
					var rect = input.getBoundingClientRect();
					setTimeout(function () {
						inst.dpDiv.css({ top: rect.top + 40, left: rect.left + 0 });
					}, 0);
				}
			});
		} );
	</script>

<?php
error_reporting(0);
session_start();
include 'dbconnection.php';
?>
</head>
<body>
<div class="kepala">
	<div class="row">
		<div class="col-md-6">
			<img height="85" src="images/logo.png">
		</div>
		<!--<div class="col-md-6 kanan">
			<h6>Kampus A: Jl. Arteri Pondok Indah No. 11 Kebayoran Lama - Jakarta Selatan</h6>
			<h6>Kampus B: Jl. H. Jampang No. 91, Jatimulya - Bekasi</h6>
			<h4>INFO LINE : (021) 739 8393</h4>
		</div>-->
	</div>
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<!--<a class="navbar-brand" href="#">Sistem Persebaran Mahasiswa</a>-->
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php include 'navigasi.php'; ?>
			</div>
		</div>
	</nav>
</div>
<div class="container badan">
	<?php include 'modul.php'; ?>
</div>
</body>
</html>