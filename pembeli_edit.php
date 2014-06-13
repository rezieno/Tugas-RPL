<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$beli = new pembeli();

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
		// baca kode_pembeli dari parameter kode_pembeli pembeli yang akan dihapus
		$kode_pembeli = $_GET['kode_pembeli'];
		// proses hapus data pembeli berdasarkan kode_pembeli via method
		$beli->hapusPembeli($kode_pembeli);	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pembeli">'; 
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca kode_pembeli pembeli yang akan diedit
		$kode_pembeli = $_GET['kode_pembeli'];
		// menampilkan form edit pembeli
		// untuk menampilkan data detil pembeli, gunakan method bacaDataPembeli()
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.nama_pembeli.value==''){
			alert('Nama Pembeli tidak boleh kosong.');
			formZ.nama_pembeli.focus();
			return false;
		}
		if(formZ.alamat.value==''){
			alert('Alamat tidak boleh kosong.');
			formZ.alamat.focus();
			return false;
		}
		
		if(formZ.telp.value==''){
			alert('Telpon tidak boleh kosong.');
			formZ.telp.focus();
			return false;
		}
	}
</script>
<b>PEMBELI</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=pembeli">DATA</a> &raquo; <b>EDIT PEMBELI</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="pembeli" action="?page=pembeli_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">Kode Pembeli</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		   <input name="kode_pembeli" style="width:100px" type="textfield" class="tfield"  value="<?php echo $beli->bacaDataPembeli('kode_pembeli', $kode_pembeli); ?>" readonly>
			</td>
    </tr>        
      <tr>
			<td width="15%"><div class="tabtxt">Nama Pembeli</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="nama_pembeli" style="width:200px" type="textfield" class="tfield" value="<?php echo $beli->bacaDataPembeli('nama_pembeli', $kode_pembeli); ?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="tabtxt">Alamat Pembeli</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<textarea name="alamat" style="width:200px" class="tfield" rows="4"><?php echo $beli->bacaDataPembeli('alamat', $kode_pembeli); ?></textarea>
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">Telpon</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="telp" type="number" style="width:200px" type="textfield" class="tfield" value="<?php echo $beli->bacaDataPembeli('telp', $kode_pembeli); ?>">
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
		// update data pembeli via method
		$beli->updateDataPembeli($_POST['kode_pembeli'], $_POST['nama_pembeli'], $_POST['alamat'], $_POST['telp']);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pembeli">'; 
	} 
}
?>