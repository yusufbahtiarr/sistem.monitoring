<?php

switch ($_GET['form']) {
	case 'cobalogin':
		$nik = $_POST['nik'];
		$password = $_POST['password'];
		$hak_akses = $_POST['hak_akses'];

		if ($nik != "" && $password != "") {
			$query = "SELECT * FROM user WHERE nik='$nik' AND password='$password';";
			//echo($query);
			$sql = mysql_query($query);
			$rows = mysql_num_rows($sql);
			if ($rows == 1) {
				$data = mysql_fetch_assoc($sql);
				$_SESSION['id_user'] = $data['id_user'];
				$_SESSION['nik'] = $data['nik'];
				$_SESSION['nama'] = $data['nama'];
				$_SESSION['hak_akses'] = $data['hak_akses'];
				header('Location: ?do=Signin&kode=1');
			}
			else{
				header('Location: ?do=Signin&kode=2');
			}
		}
		else{
			header('Location: ?do=Signin&kode=2');
		}
		break;
	
	default:
?>
<style type="text/css">
	body{
		background-image: url("images/background login.jpg");
		background-size: 100%;
	}
	.panel-login{
		width: 350px;
		margin-left: auto;
		margin-right: auto;
	}
</style>
<br><br><br><br><br>
<form method="POST" action="index.php?form=cobalogin">
	<div class="panel-login">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Login</h3>
			</div>
			<div class="panel-body">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">
						<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
					</span>
					<input type="text" name="nik" class="form-control" placeholder="NIK" aria-describedby="basic-addon1">
				</div>
				<br />
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">
						<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
					</span>
					<input type="password" name="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1">
				</div>
<?php
			if ($_GET['kode']==2) {
?>
				<br />
				<div class="alert alert-danger" role="alert">NIK atau Password <strong> Salah</strong></div>
<?php
			}
?>
			</div>
			<div class="panel-footer tengah">
				<button type="submit" class="btn btn-primary btn-xs">Masuk</button>
				<button type="button" class="btn btn-danger btn-xs">Batal</button>
			</div>
		</div>
	</div>
</form>
<?php
		break;
}

?>