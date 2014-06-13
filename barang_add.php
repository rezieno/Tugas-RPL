<?php
include_once 'include/class.php';
include_once 'include/lib.php';

// instance objek user
$user = new User();

// instance objek nsb
$brg = new Barang();

$iduser = $_SESSION['id'];
if (!$user->get_sesi()) {
  header("location:index.php");
}
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.nama_brg.value==''){
			alert('Nama Barang tidak boleh kosong.');
			formZ.nama_brg.focus();
			return false;
		}
		
		if(formZ.harga_satuan.value==''){
			alert('Harga Barang tidak boleh kosong.');
			formZ.harga_satuan.focus();
			return false;
		}
		
		if(formZ.stok_brg.value==''){
			alert('Stok Barang tidak boleh kosong.');
			formZ.stok_brg.focus();
			return false;
		}
	}
</script>

<b>BARANG</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=barang">DATA</a> &raquo; <b>TAMBAH BARANG</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="barang" action="?page=barang_add" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">Kode Barang</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		  <input name="kode_brg" style="width:100px" type="textfield" class="tfield" value="<?php echo kdauto("barang"); ?>" readonly>
			</td>
    </tr>          
    <tr>
			<td width="15%"><div class="tabtxt">NAMA BARANG</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="nama_brg" style="width:200px" type="textfield" class="tfield">
			</td>
		</tr>
	
		<tr>
			<td valign="top"><div class="tabtxt">HARGA SATUAN</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="harga_satuan" type="number" style="width:200px" class="tfield">
			</td>
		</tr>
   
		<tr>
			<td><div class="tabtxt">Stok Barang</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="stok_brg" type="number" style="width:200px"  class="tfield">
			</td>
		</tr>
		
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="Simpan">&nbsp;&nbsp;
				<input type="button" class="button" value="Batal" onclick=self.history.back()>
			</td>
		</tr>
	</form>
</table>
<?php
	if($_POST['submit']){
	// tambah data barang via method
	$brg->tambahDataBarang($_POST['kode_brg'],$_POST['nama_brg'],$_POST['harga_satuan'],$_POST['stok_brg']);
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=barang">'; 
  }
?>
