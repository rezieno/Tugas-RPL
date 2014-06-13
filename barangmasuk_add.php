<?php
include_once 'include/class.php';
include_once 'include/lib.php';

// instance objek user
$user = new User();

// instance objek nsb
$bm = new Barangmasuk();

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
		if(formZ.kode_brg.value=='0'){
			alert('Kode Barang tidak boleh kosong.');
			formZ.kode_brg.focus();
			return false;
		}
		if(formZ.jum_brg.value==''){
			alert('Jumlah barang tidak boleh kosong.');
			formZ.jum_brg.focus();
			return false;
		}
	
	}
</script>

<b>Barang Masuk</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=barangmasuk">DATA</a> &raquo; <b>TAMBAH BARANG MASUK</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="barangmasuk" action="?page=barangmasuk_add" method="post" onsubmit="return checkForm(this)">
			
			
		<tr>
			<td width="15%"><div class="tabtxt">Nama Barang</div></td>
			<td "2%"><div class="tabtxt">:</div></td>
			<td width="83%">
			<select name="kode_brg" class="tfield_a">
			<option value="0" selected="selected">Pilih Nama Barang</option>
			<?php
			//Tampilkan combo nama nasabah
			$arrayNamabrg=$bm->comboAmbilbarang();
			foreach($arrayNamabrg as $databarang)
			{
			?>
				<option value="<?php  echo $databarang['kode_brg']; ?>"><?php  echo $databarang['nama_brg']; ?></option>
			<?php } ?>		
			</select>	
			</td>
		</tr>
			
		<tr>
			<td valign="top"><div class="tabtxt">Jumlah Barang</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="jum_brg" type="number" style="width:50px" class="tfield" >
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
	// tambah data nasabah via method
	$bm->tambahDataBm($_POST['kode_brg'],$_POST['jum_brg']);
    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=barangmasuk">'; 	
  }
?>
