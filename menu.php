<?php 
if (!$user->get_sesi())
{
header("location:index.php");
} 
 ?>
<ul>
	<li><a href="?page=home">Home</a></li>
	<li><a href="?page=supplier">Suplier</a></li>
    <li><a href="?page=pembeli">Pembeli</a></li>
    <li><a href="?page=barang">Barang</a></li>
	<li><a href="?page=barangmasuk">Barang Masuk</a></li>
	<li><a href="?page=barangkeluar">Barang Keluar</a></li>
	<li><a href="?page=prosesbm">Proses Barang Masuk</a></li>
	<li><a href="?page=prosesbk">Proses Barang Keluar</a></li>
    <li><a href="?page=logout">Logout</a></li>
</ul>
