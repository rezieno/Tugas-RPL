<?php
include_once 'include/class.php';
include_once 'include/lib.php';

// instance objek user
$user = new User();

// instance objek nsb
$sup = new Supplier();

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
		if(formZ.nama_sup.value==''){
			alert('Nama Nasabah tidak boleh kosong.');
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
				<a href="?page=supplier">DATA</a> &raquo; <b>TAMBAH SUPPLIER</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="supplier" action="?page=supplier_add" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">Kode Supplier</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		  <input name="kode_sup" style="width:100px" type="textfield" class="tfield" value="<?php echo kdauto("supplier"); ?>" readonly>
			</td>
    </tr>          
    <tr>
			<td width="15%"><div class="tabtxt">Nama SUPPLIER</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="nama_sup" style="width:200px" type="textfield" class="tfield">
			</td>
		</tr>
	
		<tr>
			<td valign="top"><div class="tabtxt">Alamat Supplier</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<textarea name="alamat_sup" style="width:200px" class="tfield" rows="4"></textarea>
			</td>
		</tr>
   
		<tr>
			<td><div class="tabtxt">Telp Supplier</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
				<input name="telp_sup" style="width:200px" type="number" class="tfield">
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
	$sup->tambahDataSupplier($_POST['kode_sup'],$_POST['nama_sup'],$_POST['alamat_sup'],$_POST['telp_sup']);
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=supplier">'; 
  }
?>
