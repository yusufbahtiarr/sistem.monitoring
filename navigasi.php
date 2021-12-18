<?php
//error_reporting(0);
//session_start();
$mod = $_GET['mod'];
switch ($_SESSION['hak_akses']) {
	case '1':
?>
	<ul class="nav navbar-nav">
		<li <?php if ($mod=="") echo('class="active"'); ?> >
		<a href="?mod=">Beranda</a></li>
        <li><a href="?mod=proyek_lihat">Progres</a><!--
				<li><a href="?mod=arsip">Arsip</a></li>
			-->        </li>
	<!--
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Karyawan <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="?mod=cari_karyawan">Cari Karyawan</a></li>
			</ul>
		</li>
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Update <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="?mod=update_civil">Civil</a></li>
				<li><a href="?mod=update_permit">Permit</a></li>
				<li><a href="?mod=update_administrasi">Administrasi</a></li>
			</ul>
		</li>
	-->
		<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Admin <span class="caret"></span></a>
			<ul class="dropdown-menu" role="menu">
				<li><a href="?mod=karyawan">Data User</a></li>
				<li><a href="?mod=data_proyek">Data Proyek</a></li>
			</ul>
		</li>
	</ul>
	<form class="navbar-form navbar-right" role="search" method="POST">
		<a href="?mod=view_karyawan&id_user=<?php echo($_SESSION['id_user']); ?>&act=view">
			<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo($_SESSION['nama']); ?></button>
		</a>
		<a href="logout.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button></a>
	</form>
<?php
		break;

	case '2':
?>
	<ul class="nav navbar-nav">
		<li class="active"><a href="?mod=">Beranda</a></li>
	</ul>
	<ul class="nav navbar-nav">
	    <li><a href="?mod=proyek_lihat">Progres</a></li>
     	<li><a href="?mod=update">Update</a></li>
     	<li class="nav navbar-nav"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cari <span class="caret"></span></a>
	    <ul class="dropdown-menu" role="menu">
	      <li><a href="?mod=view_karyawan">User</a></li>
	      <li><a href="?mod=proyek_daftar"> Proyek</a></li>
        </ul>
      </li>
	</ul>
	<form class="navbar-form navbar-right" role="search" method="POST">
		<a href="?mod=view_karyawan&id_user=<?php echo($_SESSION['id_user']); ?>&act=view">
			<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo($_SESSION['nama']); ?></button>
		</a>
		<a href="logout.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button></a>
	</form>
<?php
		break;
	case '3':

?>
	<ul class="nav navbar-nav">
		<li class="active"><a href="?mod=">Beranda</a></li>
		<li><a href="?mod=proyek_lihat">Progres</a></li>
		<li class="nav navbar-nav"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Cari <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="?mod=view_karyawan">User</a></li>
            <li><a href="?mod=proyek_daftar">Proyek</a></li>
          </ul>
		</li>
		
	</ul>
	<form class="navbar-form navbar-right" role="search" method="POST" action="?mod=">
		<a href="?mod=view_karyawan&id_user=<?php echo($_SESSION['id_user']); ?>&act=view">
			<button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><?php echo($_SESSION['nama']); ?></button>
		</a>
		<a href="logout.php"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></button></a>
</form>
<?php
}
?>
