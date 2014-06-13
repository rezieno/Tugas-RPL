<?php 
include_once 'include/class.php';
include_once 'include/lib.php';

// instansiasi objek user
$user = new User();
// instansiasi objek nsb
$pbk = new ProsesBk();
$bk = new Barangkeluar();
$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
$no_faktur = $_GET['no_faktur'];
$id_pembeli=$pbk->bacaDataProsesBk('kode_pembeli', $no_faktur);

// proses hapus data
if (isset($_GET['aksi']))
{
	if ($_GET['aksi'] == 'hapus')
	{
		// baca no_faktur dari parameter no_faktur nasabah yang akan dihapus
		$no_faktur = $_GET['no_faktur'];
		// proses hapus data nasabah berdasarkan id_detail via method
		$pbk->hapusProsesBK($no_faktur);	
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=prosesbk">'; 
	}

	// proses edit data
	else if ($_GET['aksi'] == 'edit')
	{
		// baca id_detail nasabah yang akan diedit
		$no_faktur = $_GET['no_faktur'];
		// menampilkan form edit data
		// untuk menampilkan data detil data, gunakan method bacaDataProsesBm()
?>
<link rel="stylesheet" href="kalender/calendar.css" type="text/css">
<script type="text/javascript" src="kalender/calendar.js"></script>
<script type="text/javascript" src="kalender/calendar2.js"></script>

<b>PROSES BARANG KELUAR</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=prosesbk">DATA</a> &raquo; <b>EDIT PROSES BARANG KELUAR</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
	<form name="prosesbk" action="?page=prosesbk_edit&aksi=update" method="post" onsubmit="return checkForm(this)">
		<tr>
			<td width="15%"><div class="tabtxt">No faktur</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
		   <input name="no_faktur" style="width:100px" type="textfield" class="tfield"  value="<?php echo $pbk->bacaDataProsesBk('no_faktur', $no_faktur); ?>" readonly>
			</td>
    </tr>        
      <tr>
			<td width="15%"><div class="tabtxt">Kode Pembeli</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="kode_pembeli" style="width:200px" type="textfield" class="tfield" value="<?php echo $pbk->bacaDataProsesBk('kode_pembeli', $no_faktur); ?>"readonly>
			</td>
		</tr>
		<tr>
			<td><div class="tabtxt">Nama Pembeli</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="nama_pembeli" type="textfield" class="tfield" readonly="readonly" value="<?php echo $pbk->Tampilinfopem('nama_pembeli',$id_pembeli);?>"/></td>
			
		</tr>
		  <tr>
			<td><div class="tabtxt">Alamat Pembeli</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="alamat" type="textfield" class="tfield" readonly="readonly" value="<?php echo $pbk->Tampilinfopem('alamat',$id_pembeli);?>"/></td>
			
		</tr>
		
		<tr>
			<td valign="top"><div class="tabtxt">Tanggal Transver</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td>
				<input name="tgl_trans" type="date" style="width:200px" class="tfield" value="<?php echo $pbk->bacaDataProsesBk('tgl_trans', $no_faktur); ?>"readonly>
			</td>
		</tr>
	
		
		<tr>
			<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="Proses">&nbsp;&nbsp;
				<input type="button" class="button" value="Batal" onclick=self.history.back()>
				</td>
		</tr>
	</form>
</table>

<table class="tabholder" border="0" cellspacing="1" cellpadding="0">
	<tr class="tabhead">
		<td align="left" width="30" class="tabtxt">No</td>
		<td align="left" width="30" class="tabtxt">Kode Barang</td>
        <td align="left" width="30" class="tabtxt">Jumlah Barang</td>
	</tr>
<?php
//Tampilkan semua nasabah
$arrayBarangkeluar=$bk->tampilBkSemua();

//tampilkan semua lewat tombol lihat semua
if($_POST['do']=='lihat'){
$arrayBarangkeluar=$bk->tampilBkSemua();
}
//tampilkan berdasarkan filter nama
elseif($_POST['do']=='find') {
$arrayBarangkeluar=$bk->tampilBkFilter($_POST['q']);
} 

if (count($arrayBarangkeluar)) {
  foreach($arrayBarangkeluar as $data) {
?>
	<tr class="tabcont">
		<td class="tabtxt" align="left"><?php echo $c=$c+1;?>.</td>
		<td class="tabtxt" align="left"><?php echo $data['kode_brg'];?></td>
        <td class="tabtxt" align="left"><?php echo $data['jum_brg'];?></td>
	</tr>
<?php 
  } 
} 
else {
  echo 'Barang keluar Tidak Ada!';
}
?>
</table>


<?php
	}
	else if ($_GET['aksi'] == 'update') {
		// update data Proses Barang Keluar via method
		$pbk->updateDataProsesBk($_POST['no_faktur'], $_POST['kode_pembeli'], $_POST['tgl_trans'], $_POST['kode_brg'], $_POST['jum_brg']);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=prosesbk">'; 
	} 
}
?>