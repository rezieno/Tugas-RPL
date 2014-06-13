<?php
include_once 'include/class.php';
include_once 'include/lib.php';

$user = new User();
$angsur = new Angsuran();

$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
$nopim = $_GET['nopinjam'];
//ambil data nasabah berdasarkan nomor pinjam
$id_nsb=$angsur->tampilPinjamAngsur('id',$nopim);
?>

<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<b>LIHAT DATA PEMBAYARAN ANGSURAN</b> 
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<br />
<table class="tabholder"  border="0" cellspacing="0" cellpadding="3">
<tr class="tabhead">
		<td align="left" width="100" class="tabtxt">No. Pinjaman</td>
		<td align="left" width="30" class="tabtxt">:</td>
		<td align="left" class="tabtxt"><?php echo $angsur->tampilPinjamAngsur('nopim',$nopim); ?></td>
		<td align="left" width="100" class="tabtxt">Nama Nasabah</td>
		<td align="left" width="30" class="tabtxt">:</td>
		<td align="left" class="tabtxt"><?php echo $angsur->tampilPinjamNasabah('nama',$id_nsb); ?></td>
	</tr>
</table>
<br>
<table class="tabholder" border="0" cellspacing="1" cellpadding="0">
	<tr class="tabhead">
		<td align="center" class="tabtxt">Angsuran </td>
		<td align="center" class="tabtxt">Tgl. Bayar Angsuran</td>
		<td align="center" class="tabtxt">Tgl. Jatuh Tempo</td>
        <td align="center" class="tabtxt">Biaya Angsuran </td>
		<td align="center" class="tabtxt">Denda/Hari </td>
        <td align="center" class="tabtxt">Kena Denda</td>
		<td align="center" class="tabtxt">Total Pembayaran</td>
		<td align="center" class="tabtxt">Sisa Angsuran/Kali</td>
	</tr>
<?php
//Tampilkan Angsuran yang sudah terbayar per nasabah
$arrayAngNasabah=$angsur->tampilPerNasabah($nopim);
if (count($arrayAngNasabah))
{
foreach($arrayAngNasabah as $data)
{
?>
	<tr class="tabcont">
		<td class="tabtxt" align="center"><?php echo $data['ags_ke']; ?></td>
		<td class="tabtxt"><?php echo tgl_eng_to_ind($data['tgl']);?></td>
		<td class="tabtxt"><?php echo tgl_eng_to_ind($data['tgl_tempo']); ?> </td>
    <td class="tabtxt"><?php echo format_angka($angsur->tampilPinjamAngsur('angsuran',$nopim)); ?></td>
		<td class="tabtxt"><?php echo $data['telat'];?></td>
		<td class="tabtxt"><?php echo format_angka($data['denda']);?></td>
    <td class="tabtxt"><?php echo format_angka($angsur->tampilPinjamAngsur('angsuran',$nopim)+$data['denda']);?></td>
		<td class="tabtxt"><?php echo $angsur->tampilPinjamAngsur('lama',$nopim)-$data['ags_ke'];?></td>
	</tr>
<?php
} 
}?>
</table>