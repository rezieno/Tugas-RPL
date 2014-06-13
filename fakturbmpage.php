<?php
include_once 'include/class.php';
include_once 'include/lib.php';

$user = new User();
$pinjam = new Pinjaman();

$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
?>
<b>DATA PINJAMAN</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<b>DATA</b> &raquo; <a href="?page=pinjaman_add&aksi=tambah">TAMBAH</a>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<br />
<table class="tabholder"  border="0" cellspacing="0" cellpadding="3">
	<tr class="tabhead">
		<td width="40%">
			<form method="post" action="?page=pinjaman_mgr" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="lihat" />
				<input name="sb" type="submit" class="button" value="Lihat Semua Data">		  
			</form>
		</td>
		<td width="60%" align="right">
			<form method="post" action="?page=pinjaman_mgr" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="find" /><b>Cari Nomor Pinjaman &nbsp; : &nbsp;</b>		  
				<input class="tfield"  type="text" name="q" title="Masukkan kata kunci pencarian." />&nbsp;&nbsp;
				<input name="submit" type="submit" class="button" value="Cari" />
			</form>
		</td>
	</tr>
</table>
<br>
<table class="tabholder" border="0" cellspacing="1" cellpadding="0">
	<tr class="tabhead">
		<td align="center" width="30" class="tabtxt">No</td>
		<td align="center" class="tabtxt">No. Pinjaman</td>
		<td align="center" class="tabtxt">Nama Nasabah</td>
		<td align="center" class="tabtxt">Tgl. Pinjam</td>
    <td align="center" class="tabtxt">Pokok Pinjaman</td>
    <td align="center" class="tabtxt">Bunga</td>
		<td align="center" class="tabtxt">Lama Pinjaman</td>
		<td align="center" class="tabtxt">Biaya Angsuran</td>
		<td align="center" class="tabtxt">Jatuh Tempo</td>
		<td align="center" width="70" class="tabtxt">Aksi</td>
	</tr>
<?php
//Tampilkan semua data pinjaman
$arrayPinjam=$pinjam->tampilPinjaman();

//tampilkan semua lewat tombol lihat semua
if($_POST['do']=='lihat'){
$arrayPinjam=$pinjam->tampilPinjaman();
}
//tampilkan berdasarkan filter nama
elseif($_POST['do']=='find') {
$arrayPinjam=$pinjam->tampilPinjamanFilter($_POST['q']);
} 

if (count($arrayPinjam))
{
foreach($arrayPinjam as $data)
{
?>
	<tr class="tabcont">
		<td class="tabtxt" align="center"><?php echo $c=$c+1; ?></td>
		<td class="tabtxt"><?php echo $data['no']; ?> </td>
    <td class="tabtxt"><?php echo $pinjam->ambilNama($data['id']); ?></td>
		<td class="tabtxt"><?php echo tgl_eng_to_ind($data['tgl']);?></td>
		<td class="tabtxt"><?php echo format_angka($data['pokok']); ?> </td>
    <td class="tabtxt"><?php echo $data['bunga']."&nbsp;%";?></td>
		<td class="tabtxt"><?php echo $data['lama']."&nbsp;Bulan";?></td>
    <td class="tabtxt"><?php echo format_angka($data['angsuran']);?></td>
		<td class="tabtxt"><?php echo $pinjam->jatuhTempo($data['id']);?></td>
		<td align="left">
			<div align="center" class="tabtxt imghref">
			<span class="dashnav"></span>
				<a href="?page=lihat_angsuran&nopinjam=<?php echo $data['no'];?>">
					<img src="images/lihat.ico" class="ico" border="0" title="Lihat" />
				</a>
			<span class="dashnav"></span>
				<a href="?page=input_angsuran&nopinjam=<?php echo $data['no'];?>">
					<img src="images/bayar.ico" class="ico" border="0" title="Bayar" />
				</a>
				<span class="dashnav"></span>
				<a href="?page=pinjaman_add&aksi=hapus&nopim=<?php echo $data['no'];?>">
					<img src="images/ico_del.gif" class="ico" border="0" title="Hapus"  onClick="return confirm('Apakah Anda Yakin?');"/>
				</a>
			</div>
		</td>
	</tr>
<?php
}
}
else {
echo 'Nomor Pinjaman Tidak Ada !';
}
 ?>
</table>
</p>
<img src="images/lihat.ico" border="0" title="Bayar" /> = Lihat Data Angsuran	
<img src="images/bayar.ico" border="0" title="Bayar" /> = Bayar Angsuran	
<img src="images/ico_del.gif" border="0" title="Delete" /> = Hapus Pinjaman			