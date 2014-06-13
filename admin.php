<?php
error_reporting(0);
session_start();
include_once 'include/class.php';

$db = new Database();

// koneksi ke MySQL via method
$db->connectMySQL();

$user = new User();
$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
if ($_GET['page'] == 'logout')
{
$user->user_logout();
header("location:index.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Aplikasi Inventory</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="pagehandler">
		<div class="navpost">
			<div id="navigate">
				<?php include "menu.php"; ?>
			</div>
		</div>
		<div class="rbox01">&nbsp;</div>
		<div class="rbox02">
		<?php include "isi.php";?>
		</div>
		<div class="rbox03">&nbsp;</div>
		<div id="footer">
			<b>&copy; Sistem Informasi Inventory Barang - Programmed By Kelompok III RPL.</b><br />
		</div>
	</div>
</body>
</html>
