<?php
include_once 'include/class.php';
include_once 'include/lib.php';

// instance objek user
$user = new User();

// instance objek nsb
$pbk = new ProsesBk();

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
		if(formZ.no_faktur.value==''){
			alert('No Faktur tidak boleh kosong.');
			formZ.no_faktur.focus();
			return false;
		}
		if(formZ.kode_pembeli.value==''){
			alert('Kode Pembeli tidak boleh kosong.');
			formZ.kode_pembeli.focus();
			return false;
		}
        if(formZ.tgl_trans.value==''){
			alert('Tanggal Transver tidak boleh kosong.');
			formZ.tgl_trans.focus();
			return false;
		}
	
	}
</script>

<b>Proses Barang Keluar</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=prosesbk">DATA</a> &raquo; <b>TAMBAH PROSES BARANG KELUAR</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="prosesbk" action="?page=prosesbk_add" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">No Faktur</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		  <input name="no_faktur" style="width:100px" type="textfield" class="tfield" value="<?php echo kdauto("brg_keluar"); ?>" readonly>
			</td>
    </tr>          
			<tr>
			<td><div class="tabtxt">Nama Pembeli</div></td>
			<td><div class="tabtxt">:</div></td>
			<td>
			<select name="kode_pembeli" class="tfield_a">
			<option value="0" selected="selected">Pilih Nama Pembeli</option>
			<?php
			//Tampilkan combo nama nasabah
			$arrayNamapem=$pbk->comboAmbilpem();
			foreach($arrayNamapem as $datapem)
			{
			?>
				<option value="<?php  echo $datapem['kode_pembeli']; ?>"><?php  echo $datapem['nama_pembeli']; ?></option>
			<?php } ?>
			
			</select>	
			</td>
		</tr>
	
		<tr>
			<td valign="top"><div class="tabtxt">Tanggal Transfer</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="tgl_trans" type="date" style="width:200px" class="tfield">
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
	$pbk->tambahDataProsesBk($_POST['no_faktur'],$_POST['kode_pembeli'],$_POST['tgl_trans']);
  echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=prosesbk">'; 
  }
?>
