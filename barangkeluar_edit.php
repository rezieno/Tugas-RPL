<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$bk = new Barangkeluar();

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
		// baca id_detail dari parameter id_detail nasabah yang akan dihapus
		$kode_brg = $_GET['kode_brg'];
		// proses hapus data nasabah berdasarkan id_detail via method
		$bk->hapusBk($kode_brg);	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=barangkeluar">'; 
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca id_detail nasabah yang akan diedit
		$kode_brg = $_GET['kode_brg'];
		// menampilkan form edit nasabah
		// untuk menampilkan data detil nasabah, gunakan method bacaDataNasabah()
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>
<script>
	function checkForm(formZ){
		if(formZ.kode_brg.value==''){
			alert('Kode Barang tidak boleh kosong.');
			formZ.nama_sup.focus();
			return false;
		}
		if(formZ.jum_brg.value==''){
			alert('Jumlah barang tidak boleh kosong.');
			formZ.jum_brg.focus();
			return false;
		}
	
	}
</script>
<b>BARANG KELUAR</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=barangkeluar">DATA</a> &raquo; <b>EDIT BARANG KELUAR</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="barangkeluar" action="?page=barangkeluar_edit&aksi=update" method="post" onsubmit="return checkForm(this)"> 
      <tr>
			<td width="15%"><div class="tabtxt">Kode Barang</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="kode_brg" style="width:200px" type="textfield" class="tfield" value="<?php echo $bk->bacaDataBk('kode_brg', $kode_brg); ?>">
			</td>
		</tr>
		<tr>
			<td valign="top"><div class="tabtxt">Jumlah Barang</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="jum_brg" style="width:200px" class="tfield" type="number" value="<?php echo $bk->bacaDataBk('jum_brg', $kode_brg); ?>">
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
		$bk->updateDataBk($_POST['kode_brg'], $_POST['jum_brg']);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=barangkeluar">'; 
	} 
}
?>