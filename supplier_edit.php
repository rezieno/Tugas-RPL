<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$sup = new Supplier();

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
		// baca kode_sup dari parameter kode_sup nasabah yang akan dihapus
		$kode_sup = $_GET['kode_sup'];
		// proses hapus data nasabah berdasarkan kode_sup via method
		$sup->hapusSupplier($kode_sup);	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=supplier">'; 
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca kode_sup nasabah yang akan diedit
		$kode_sup = $_GET['kode_sup'];
		// menampilkan form edit nasabah
		// untuk menampilkan data detil nasabah, gunakan method bacaDataNasabah()
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.nama_sup.value==''){
			alert('Nama Supplier tidak boleh kosong.');
			formZ.nama_sup.focus();
			return false;
		}
		if(formZ.alamat_sup.value==''){
			alert('Alamat tidak boleh kosong.');
			formZ.alamat_sup.focus();
			return false;
		}
		
		if(formZ.telp_sup.value==''){
			alert('Telpon tidak boleh kosong.');
			formZ.telp_sup.focus();
			return false;
		}
	}
</script>
<b>SUPPLIER</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=supplier">DATA</a> &raquo; <b>EDIT SUPPLIER</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="supplier" action="?page=supplier_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">Kode Supplier</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		   <input name="kode_sup" style="width:100px" type="textfield" class="tfield"  value="<?php echo $sup->bacaDataSupplier('kode_sup', $kode_sup); ?>" readonly>
			</td>
    </tr>        
      <tr>
			<td width="15%"><div class="tabtxt">Nama Supplier</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="nama_sup" style="width:200px" type="textfield" class="tfield" value="<?php echo $sup->bacaDataSupplier('nama_sup', $kode_sup); ?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="tabtxt">Alamat Supplier</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<textarea name="alamat_sup" style="width:200px" class="tfield" rows="4"><?php echo $sup->bacaDataSupplier('alamat_sup', $kode_sup); ?></textarea>
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">Telpon</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="telp_sup" type="number" style="width:200px" type="textfield" class="tfield" value="<?php echo $sup->bacaDataSupplier('telp_sup', $kode_sup); ?>">
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
		// update data nasabah via method
		$sup->updateDataSupplier($_POST['kode_sup'], $_POST['nama_sup'], $_POST['alamat_sup'], $_POST['telp_sup']);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=supplier">'; 
	} 
}
?>