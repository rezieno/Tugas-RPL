<?php
include_once 'include/class.php';
include_once 'include/lib.php';

//$user = new User();
$pbm = new ProsesBm();

$iduser = $_SESSION['id'];
if (!$user->get_sesi()) {
  header("location:index.php");
}
?>
<b>DATA PROSES BARANG MASUK</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<b>DATA</b> &raquo; <a href="?page=prosesbm_add">TAMBAH</a>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div><br />
<table class="tabholder"  border="0" cellspacing="0" cellpadding="3">
	<tr class="tabhead">
		<td width="40%">
			<form method="post" action="?page=prosesbm" onsubmit="if(this.q.value)return true;else return false;">
				<input type="hidden" name="do" value="lihat" />
				<input name="sb" type="submit" class="button" value="Lihat Semua Data">		  
			</form>
		</td>
		<td width="60%" align="right">
			<form method="post" action="?page=prosesbm" onsubmit="if(this.q.value)return true;else return false;">
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
		<td align="left" width="30" class="tabtxt">Kode Suplier</td>
		<td align="left" width="30" class="tabtxt">Nama Supplier</td>
		<td align="left" width="30" class="tabtxt">Alamat Supplier</td>
        <td align="left" width="30" class="tabtxt">Tanggal Transfer</td>
		<td align="right" width="30" class="tabtxt">Aksi</td>
	</tr>
<?php
//Tampilkan semua nasabah
$arrayProsesBm=$pbm->tampilProsesBmSemua();

//tampilkan semua lewat tombol lihat semua
if($_POST['do']=='lihat'){
$arrayProsesBm=$pbm->tampilProsesBmSemua();
}
//tampilkan berdasarkan filter nama
elseif($_POST['do']=='find') {
$arrayProsesBm=$pbm->tampilProsesBmFilter($_POST['q']);
} 

if (count($arrayProsesBm)) {
  foreach($arrayProsesBm as $data) {
?>
	<tr class="tabcont">
		<td class="tabtxt" align="left"><?php echo $c=$c+1;?>.</td>
        <td class="tabtxt"><?php echo $data['no_faktur'] ?></td>
		<td class="tabtxt"><?php echo $data['kode_sup'];?></td>
		<td class="tabtxt"><?php echo $pbm->ambilNama($data['kode_sup']); ?></td>
		<td class="tabtxt"><?php echo $pbm->ambilAlamat($data['kode_sup']); ?></td>
        <td class="tabtxt"><?php echo $data['tg_trans'];?></td>

		<td align="right">
			<div class="tabtxt imghref">
				<span class="dashnav">&nbsp;</span>
				<a href="?page=prosesbm_edit&aksi=edit&no_faktur=<?php echo $data['no_faktur'];?>">
					<img src="images/lihat.png" class="ico" border="0" title="Edit" />
				</a>
				
				<span class="dashnav">&nbsp;</span>
				<a href="?page=prosesbm_edit&aksi=edit&no_faktur=<?php echo $data['no_faktur'];?>">
					<img src="images/faktur.ico" class="ico" border="0" title="Edit" />
				</a>
				<span class="dashnav">&nbsp;</span>
				<a href="?page=prosesbm_edit&aksi=hapus&no_faktur=<?php echo $data['no_faktur'];?>">
					<img src="images/ico_del.gif" class="ico" border="0" title="Hapus" onClick="return confirm('Apakah Anda Yakin?');"/>
				</a>
			</div>
		</td>
		

	</tr>
<?php 
  } 
} 
else {
  echo 'Proses Barang masuk Tidak Ada!';
}
?>
</table>
</p>
<img src="images/ico_edit.gif" border="0" title="Edit" /> = Edit Supplier &nbsp;&nbsp;			
<img src="images/ico_del.gif" border="0" title="Delete" /> = Hapus Supplier			