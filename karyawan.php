<?php
if ($_GET['act']=="add") {
	$q = "SELECT * FROM user WHERE nik='".$_GET['nik']."'";
	$r = mysql_query($q);
	$row = mysql_num_rows($r);
	if ($row==0) {
		$query = "INSERT INTO user (nik,nama,hak_akses,password) VALUES
				('".$_GET['nik']."','".$_GET['nama']."','".$_GET['hak_akses']."','".$_GET['nik']."')";
		$result = mysql_query($query);
		$id_user = mysql_insert_id();
		if ($result) {
?>
<script type="text/javascript">
	alert("data berhasil tersimpan");
	document.location="index.php?mod=karyawan&act=edit&id_user=" + <?php echo($id_user); ?> ;
</script>
<?php
		}
		else{
?>
<script type="text/javascript">
	alert("data gagal tersimpan");
	document.location="index.php?mod=karyawan";
</script>
<?php
		}
	}
	else{
?>
<script type="text/javascript">
	alert("data gagal tersimpan karena duplikat NIK");
	document.location="index.php?mod=karyawan";
</script>
<?php
	}
}
elseif ($_GET['act']=="delete") {
	$query = "DELETE FROM user WHERE id_user=".$_GET['id_user'];
	$result = mysql_query($query);
	if ($result) {
?>
<script type="text/javascript">
	alert("data berhasil terhapus");
	document.location="index.php?mod=karyawan";
</script>
<?php
	}
	else{
?>
<script type="text/javascript">
	alert("data gagal terhapus");
	document.location="index.php?mod=karyawan";
</script>
<?php
	}
}
elseif ($_GET['act']=="update") {
	$target_dir = "foto/";
	$filename = basename($_FILES["fileToUpload"]["name"]);
	$temp = explode(".",$filename);
	$id_user = $_GET['id_user'];
	$newfilename = $id_user . '.' . end($temp);
	$target_file = $target_dir . $newfilename;
	$txtFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check file size
	/*if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Maaf, ukuran file terlalu besar.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($txtFileType != "txt") {
		echo "Maaf, hanya file .txt yang bisa diupload";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Maaf, file anda tidak terupload.";
	// if everything is ok, try to upload file
	} else {*/
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
?>
<script type="text/javascript">
	alert("upload foto berhasil");
</script>
<?php
	}
	$query = "UPDATE user SET nik='".$_POST['nik']."', nama='".$_POST['nama']."', nm_belakang='".$_POST['nm_belakang']."', hak_akses='".$_POST['hak_akses']."', password='".$_POST['password']."', hp='".$_POST['hp']."', email='".$_POST['email']."', jabatan='".$_POST['jabatan']."' WHERE id_user=".$id_user;
	mysql_query($query);
?>
<script type="text/javascript">
	document.location="index.php?mod=karyawan&page=edit&id_user=" + <?php echo($_GET['id_user']); ?> ;
</script>
<?php
	
}
elseif ($_GET['act']=="edit") {
	$query = "SELECT * FROM user WHERE id_user=".$_GET['id_user'];
	$result = mysql_query($query);
	$data = mysql_fetch_assoc($result);	
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Edit User </strong></div>
	<div class="panel-body">
		<form action="index.php?mod=karyawan&act=update&id_user=<?php echo($_GET['id_user']); ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id_user" value="<?php echo($id_user); ?>">
			<table class="form">
				<tr>
					<td class="kanan" width="300px">Foto</td>
					<td>
<?php
	if (file_exists("foto/".$data['id_user'].".jpg")){
?>
						<img src="foto/<?php echo($data['id_user']); ?>.jpg" height="100px"><br>
<?php
	}
?>
						<input type="file" name="fileToUpload" accept=".jpg" id="fileToUpload">format: *.jpg
					</td>
				</tr>
				<tr>
					<td class="kanan" width="300px">NIK</td>
					<td><input type="text" name="nik" value="<?php echo($data['nik']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan" width="300px">Nama Depan</td>
					<td><input type="text" name="nama" value="<?php echo($data['nama']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan" width="300px">Nama Belakang</td>
					<td><input type="text" name="nm_belakang" value="<?php echo($data['nm_belakang']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan">Hak Akses</td>
					<td>
						<select name="hak_akses">
							<option></option>
<?php
	$query_jabatan = "SELECT * FROM akses;";
	$result_jabatan = mysql_query($query_jabatan);
	while ($data_jabatan=mysql_fetch_assoc($result_jabatan)) {
?>
							<option value="<?php echo($data_jabatan['hak_akses']); ?>" <?php if($data_jabatan['hak_akses']==$data['hak_akses']) echo("SELECTED"); ?>><?php echo($data_jabatan['keterangan']); ?></option>
<?php
	}
?>
						</select>
					</td>
				</tr>
				<tr>
					<td class="kanan" width="300px">Password</td>
					<td><input type="text" name="password" value="<?php echo($data['password']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan" width="300px">No. HP</td>
					<td><input type="text" name="hp" value="<?php echo($data['hp']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan" width="300px">email</td>
					<td><input type="text" name="email" value="<?php echo($data['email']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan" width="300px">Jabatan</td>
					<td><input type="text" name="jabatan" value="<?php echo($data['jabatan']); ?>"></td>
				</tr>
				<tr>
					<td></td>
					<td>
					<a href="?mod=karyawan">
					<button type="button" class="btn btn-danger btn">Batal</button>
					<button type="submit" class="btn btn-primary" name="act" value="update"><span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span>Simpan</button>				
					</td>
				</tr>
			</table>
		</form>
<?php
}
elseif ($_GET['act']=="view") {
	$id_user=$_GET['id_user'];
	$q = "SELECT * FROM user a
			INNER JOIN akses b ON a.hak_akses=b.hak_akses
			WHERE a.id_user=$id_user;";
	$r = mysql_query($q);
	$d = mysql_fetch_assoc($r);
?>
<a href="?mod=karyawan">back</a><br>
<div class="panel panel-default">
	<div class="panel-heading"><strong>View Profile </strong></div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-3">
				<img src="foto/<?php echo($id_user); ?>.jpg" width="150" class="pull-right">
			</div>
			<div class="col-md-9">
				<table class="table table-bordered">
					<tr>
						<td align="right">Nama</td>
						<td><?php echo($d['nama']."  ".$d['nm_belakang']); ?></td>
					</tr>
					<tr>
						<td align="right">Nik</td>
						<td><?php echo($d['nik']); ?></td>
					</tr>
					<tr>
						<td align="right">Hp</td>
						<td><?php echo($d['hp']); ?></td>
					</tr>
					<tr>
						<td align="right">Email</td>
						<td><?php echo($d['email']); ?></td>
					</tr>
					<tr>
						<td align="right">Jabatan</td>
						<td><?php echo($d['jabatan']); ?></td>
					</tr>
					<tr>
						<td align="right">Hak Akses</td>
						<td><?php echo($d['keterangan']); ?></td>
					</tr>
				</table>
			</div>
		</div>
		<br>
		<div class="panel panel-success">
			<div class="panel-heading tengah"><strong>Rekam Jejak</strong></div>
			<div class="panel-body">
				<table class="table table-bordered" id="example">
					<thead>
						<th align="center">NO</th>
						<th align="center">OPERATOR</th>
						<th align="center">PROYEK</th>
					</thead>
					<tbody>
<?php
	$q = "SELECT a.operator,a.nama_proyek FROM proyek a INNER JOIN otoritas b ON a.id_proyek=b.id_proyek WHERE b.id_user=$id_user;";
	$r = mysql_query($q);
	$no = 1;
	while ($d = mysql_fetch_assoc($r)) {
?>
						<tr>
							<td align="center"><?php echo($no++); ?></td>
							<td><?php echo($d['operator']); ?></td>
							<td><?php echo($d['nama_proyek']); ?></td>
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
}
else{
?>
<div class="panel panel-default">
	<div class="panel-heading"><strong>Data User </strong></div>
	<div class="panel-body">
<?php
if ($_SESSION['hak_akses']=='1') {
?>
		<form action="index.php" method="GET">
			<input type="hidden" name="mod" value="karyawan">
			<table class="form">
				<tr>
					<td class="kanan">NIK</td>
					<td><input type="text" name="nik" value="<?php echo($_GET['nik']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan">Nama</td>
					<td><input type="text" name="nama" value="<?php echo($_GET['nama']); ?>"></td>
				</tr>
				<tr>
					<td class="kanan">Hak Akses</td>
					<td>
						<select name="hak_akses">
							<option></option>
<?php
	$query_jabatan = "SELECT * FROM akses;";
	$result_jabatan = mysql_query($query_jabatan);
	while ($data_jabatan=mysql_fetch_assoc($result_jabatan)) {
?>
							<option value="<?php echo($data_jabatan['hak_akses']); ?>" <?php if($data_jabatan['hak_akses']==$_GET['hak_akses']) echo("SELECTED"); ?>><?php echo($data_jabatan['keterangan']); ?></option>
<?php
	}
?>
						</select>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<!-- <button type="submit" class="btn btn-primary" name="act" value="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span> Cari</button> -->
						<button type="submit" class="btn btn-success" name="act" value="add"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Tambah User</button>
					</td>
				</tr>
			</table>
		</form>
		<br /><br />
<?php
	}
?>
		<table class="table table-bordered lebihkecil" id="example" width="100%">
			<thead>
				<th class="tengah">NIK</th>
				<th class="tengah">Nama</th>
				<th class="tengah">No. HP</th>
				<th class="tengah">Email</th>
				<th class="tengah">Jabatan</th>
				<!-- <th class="tengah">Hak Akses</th> -->
				<th class="tengah">Tools</th>
			</thead>
			<tbody>
<?php
	$query = "SELECT a.*,b.keterangan FROM user a
	LEFT JOIN akses b ON a.hak_akses=b.hak_akses ";
	if ($_GET['act']=="search") {
		$query.="WHERE a.nik LIKE '%".$_GET['nik']."%' AND a.nama LIKE '%".$_GET['nama']."%' AND a.hak_akses LIKE '%".$_GET['hak_akses']."%' ;";
	}
	$result = mysql_query($query);
	while ($data=mysql_fetch_assoc($result)) {
?>
				<tr>
					<td><?php echo($data['nik']); ?></td>
					<td><?php echo($data['nama']); ?></td>
					<td><?php echo($data['hp']); ?></td>
					<td><?php echo($data['email']); ?></td>
					<td><?php echo($data['jabatan']); ?></td>
					<!-- <td><?php echo($data['keterangan']); ?></td> -->
					<td width="180px">
						<form action="index.php" method="GET">
							<input type="hidden" name="mod" value="karyawan">
							<input type="hidden" name="id_user" value="<?php echo($data['id_user']); ?>">
							<button type="sumbit" class="btn btn-info btn-xs" name="act" value="view">
								<span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span> View
							</button>
<?php
if ($_SESSION['hak_akses']=='1') {
?>
							<button type="sumbit" class="btn btn-warning btn-xs" name="act" value="edit">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Edit
							</button>
							<button type="sumbit" class="btn btn-danger btn-xs" onclick="return confirm('Anda yakin menghapus data dengan NIK <?php echo $data['nik'] ?> ?')" name="act" value="delete">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
							</button>
<?php
}
?>
						</form>
					</td>
				</tr>
<?php
	}
?>
			</tbody>
		</table>
	</div>
</div>
<?php
}
?>