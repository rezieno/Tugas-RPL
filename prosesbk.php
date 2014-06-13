<?php
include_once 'include/class.php';
include_once 'include/lib.php';

//$user = new User();
$pbk = new ProsesBk();

$iduser = $_SESSION['id'];
if (!$user->get_sesi()) {
  header("location:index.php");
}
?>
<b>DATA PROSES BARANG KELUAR</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<b>DATA</b> &raquo; <a href="?page=prosesbk_add">TAMBAH</a>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div><br />
<table class="tabholder"  border="0" cellspacing="0" cellpadding="3">
	<tr class="tabhead">
		<td width="40%">
			<form method="post" action="?page=prosesbk" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="lihat" />
				<input name="sb" type="submit" class="button" value="Lihat Semua Data">		  
			</form>
		</td>
		<td width="60%" align="right">
			<form method="post" action="?page=prosesbk" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="find" /><b>Cari No. Faktur &nbsp; : &nbsp;</b>		  
				<input class="tfield"  type="text" name="q" title="Masukkan kata kunci pencarian." />&nbsp;&nbsp;
				<input name="submit" type="submit" class="button" value="Cari" />
			</form>
		</td>
	</tr>
</table>
<br>
<table class="tabholder" border="0" cellspacing="1" cellpadding="0">
	<tr class="tabhead">
		<td align="left" width="30" class="tabtxt">No</td>
		<td align="left" width="30" class="tabtxt">No. Faktur</td>
		<td align="left" width="30" class="tabtxt">Kode Pembeli</td>
		<td align="left" width="30" class="tabtxt">Nama Pembeli</td>
		<td align="left" width="30" class="tabtxt">Alamat Pembeli</td>
        <td align="left" width="30" class="tabtxt">Tanggal Transfer</td>
		<td align="right" width="30" class="tabtxt">Aksi</td>
	</tr>
<?php
//Tampilkan semua nasabah
$arrayProsesBk=$pbk->tampilProsesBkSemua();

//tampilkan semua lewat tombol lihat semua
if($_POST['do']=='lihat'){
$arrayProsesBk=$pbk->tampilProsesBkSemua();
}
//tampilkan berdasarkan filter nama
elseif($_POST['do']=='find') {
$arrayProsesBk=$pbk->tampilProsesBkFilter($_POST['q']);
} 

if (count($arrayProsesBk)) {
  foreach($arrayProsesBk as $data) {
?>
	<tr class="tabcont">
		<td class="tabtxt" align="left"><?php echo $c=$c+1;?>.</td>
        <td class="tabtxt"><?php echo $data['no_faktur'] ?></td>
		<td class="tabtxt"><?php echo $data['kode_pembeli'];?></td>
		<td class="tabtxt"><?php echo $pbk->ambilNama($data['kode_pembeli']); ?></td>
		<td class="tabtxt"><?php echo $pbk->ambilAlamat($data['kode_pembeli']); ?></td>
        <td class="tabtxt"><?php echo $data['tgl_trans'];?></td>

		<td align="right">
			<div class="tabtxt imghref">
				<span class="dashnav"></span>
				<a href="?page=prosesbm_edit&aksi=edit&no_faktur=<?php echo $data['no_faktur'];?>">
					<img src="images/lihat.png" class="ico" border="0" title="Edit" />
				</a>
				<span class="dashnav"></span>
				<a href="?page=prosesbk_edit&aksi=edit&no_faktur=<?php echo $data['no_faktur'];?>">
					<img src="images/faktur.ico" class="ico" border="0" title="Edit" />
				</a>
				<span class="dashnav"></span>
				<a href="?page=prosesbk_edit&aksi=hapus&no_faktur=<?php echo $data['no_faktur'];?>">
					<img src="images/ico_del.gif" class="ico" border="0" title="Hapus" onClick="return confirm('Apakah Anda Yakin?');"/>
				</a>
			</div>
		</td>
	</tr>
<?php 
  } 
} 
else {
  echo 'Proses Barang keluar Tidak Ada!';
}
?>
</table>
</p>
<img src="images/ico_edit.gif" border="0" title="Edit" /> = Edit Pembeli &nbsp;&nbsp;			
<img src="images/ico_del.gif" border="0" title="Delete" /> = Hapus Pembeli			