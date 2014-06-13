<?php
include_once 'include/class.php';
$user = new User();
if (!$user->get_sesi()){
	header("location:index.php");
}
	$page=htmlentities($_GET['page']);
	$halaman="$page.php";

if(!file_exists($halaman) || empty($page)){
		include "home.php";
	}else{
		include "$halaman";
}
?>
