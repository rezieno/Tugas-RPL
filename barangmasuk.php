<?php
include_once 'include/class.php';
include_once 'include/lib.php';

//$user = new User();
$bm = new Barangmasuk();

$iduser = $_SESSION['id'];
if (!$user->get_sesi()) {
  header("location:index.php");
}
?>
<b>DATA BARANG MASUK</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<b>DATA</b> &raquo; <a href="?page=barangmasuk_add">TAMBAH</a>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div><br />
<table class="tabholder"  border="0" cellspacing="0" cellpadding="3">
	<tr class="tabhead">
		<td width="40%">
			<form method="post" action="?page=barangmasuk" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="lihat" />
				<input name="sb" type="submit" class="button" value="Lihat Semua Data">		  
			</form>
		</td>
		<td width="60%" align="right">
			<form method="post" action="?page=barangmasuk" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="find" /><b>Cari Kode Barang &nbsp; : &nbsp;</b>		  
				<input class="tfield"  type="text" name="q" title="Masukkan kata kunci pencarian." />&nbsp;&nbsp;
				<input name="submit" type="submit" class="button" value="Cari" />
			</form>
		</td>
	</tr>
</table>
<br>
<table class="tabholder" border="0" cellspacing="1" cellpadding="0">
	<tr class="tabhead">
		<td align="left" width="30" class="tabtxt">No</td>
		<td align="left" width="30" class="tabtxt">Kode Barang</td>
        <td align="left" width="30" class="tabtxt">Jumlah Barang</td>
		<td align="right" width="30" class="tabtxt">Aksi</td>
	</tr>
<?php
//Tampilkan semua nasabah
$arrayBarangmasuk=$bm->tampilBmSemua();

//tampilkan semua lewat tombol lihat semua
if($_POST['do']=='lihat'){
$arrayBarangmasuk=$bm->tampilBmSemua();
}
//tampilkan berdasarkan filter nama
elseif($_POST['do']=='find') {
$arrayBarangmasuk=$bm->tampilBmFilter($_POST['q']);
} 

if (count($arrayBarangmasuk)) {
  foreach($arrayBarangmasuk as $data) {
?>
	<tr class="tabcont">
		<td class="tabtxt" align="left"><?php echo $c=$c+1;?>.</td>
		<td class="tabtxt" align="left"><?php echo $data['kode_brg'];?></td>
        <td class="tabtxt" align="left"><?php echo $data['jum_brg'];?></td>

		<td align="right">
			<div class="tabtxt imghref">
				<span class="dashnav">&nbsp;</span>
				<a href="?page=barangmasuk_edit&aksi=edit&kode_brg=<?php echo $data['kode_brg'];?>">
					<img src="images/ico_edit.gif" class="ico" border="0" title="Edit" />
				</a>
				<span class="dashnav">&nbsp;</span>
				<a href="?page=barangmasuk_edit&aksi=hapus&kode_brg=<?php echo $data['kode_brg'];?>">
					<img src="images/ico_del.gif" class="ico" border="0" title="Hapus" onClick="return confirm('Apakah Anda Yakin?');"/>
				</a>
			</div>
		</td>
	</tr>
<?php 
  } 
} 
else {
  echo 'Barang masuk Tidak Ada!';
}
?>
</table>
</p>
<img src="images/ico_edit.gif" border="0" title="Edit" /> = Edit Supplier &nbsp;&nbsp;			
<img src="images/ico_del.gif" border="0" title="Delete" /> = Hapus Supplier			