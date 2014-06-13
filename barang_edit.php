<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$brg = new Barang();

$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}

// proses hapus data
if (isset($_GET['aksi']))
{
	if ($_GET['aksi'] == 'hapus')
	{
		// baca kode_brg dari parameter kode_brg barang yang akan dihapus
		$kode_brg = $_GET['kode_brg'];
		// proses hapus data barang berdasarkan kode_brg via method
		$brg->hapusBarang($kode_brg);	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=barang">'; 
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca kode_brg barang yang akan diedit
		$kode_brg = $_GET['kode_brg'];
		// menampilkan form edit nasabah
		// untuk menampilkan data detil nasabah, gunakan method bacaDataNasabah()
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
				<a href="?page=barang">DATA</a> &raquo; <b>EDIT BARANG</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="barang" action="?page=barang_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">Kode Barang</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		   <input name="kode_brg" style="width:100px" type="textfield" class="tfield"  value="<?php echo $brg->bacaDataBarang('kode_brg', $kode_brg); ?>" readonly>
			</td>
    </tr>        
      <tr>
			<td width="15%"><div class="tabtxt">Nama Barang</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="nama_brg" style="width:200px" type="textfield" class="tfield" value="<?php echo $brg->bacaDataBarang('nama_brg', $kode_brg); ?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="tabtxt">Harga Satuan</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="harga_satuan" type="number" style="width:200px" class="tfield" value="<?php echo $brg->bacaDataBarang('harga_satuan', $kode_brg); ?>">
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">Stok Barang</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="stok_brg" type="number" style="width:200px" type="textfield" class="tfield" value="<?php echo $brg->bacaDataBarang('stok_brg', $kode_brg); ?>">
			</td>
		</tr>
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="Update">&nbsp;&nbsp;
				<input type="button" class="button" value="Batal" onclick=self.history.back()>
				</td>
		</tr>
	</form>
</table>
<?php
	}
	else if ($_GET['aksi'] == 'update') {
		// update data barang via method
		$brg->updateDataBarang($_POST['kode_brg'], $_POST['nama_brg'], $_POST['harga_satuan'], $_POST['stok_brg']);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=barang">'; 
	} 
}
?>