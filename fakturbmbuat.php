<?php
include_once 'include/class.php';
include_once 'include/lib.php';

$user = new User();
$bf = new Buatfaktur();

$iduser = $_SESSION['id'];
if (!$user->get_sesi())
{
header("location:index.php");
}
$no_faktur = $_GET['no_faktur'];
//ambil data nasabah berdasarkan nomor pinjam
$kode_sup=$bf->tampilFakturmasuk('kode_sup',$no_faktur);
?>
<b>Faktur Barang Masuk</b>
<div class="subnav">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td><img src="images/tabdata01.gif" /></td>
			<td class="tabsubnav">
				<a href="?page=prosesbm">DATA</a> &raquo; <b>FAKTUR BARANG MASUK</b>
			</td>
			<td><img src="images/tabdata03.gif" /></td>
		</tr>
	</table>
</div>		
<table width="100%"  border="0" cellspacing="0" cellpadding="3">
		<form action="?page=fakturbmbuat" method="post" name="postform">
		<input type="hidden" value="<?php echo $bf->tampilInfosupplier('kode_sup',$kode_sup); ?>" name="kode_sup"/>
        <input type="hidden" value="<?php echo $bf->tampilFakturmasuk('no_faktur',$no_faktur); ?>" name="no_faktur"/>
 		
		<tr>
			<td valign="top"><div class="tabtxt">Tanggal</div></td>
			<td valign="top"><div class="tabtxt">:</div></td>
			<td><input name="tgl_trans" type="date" style="width:200px" class="tfield" value="<?php echo $bf->bacaDatafakturbm('tgl_trans', $no_faktur); ?>"></td>
		</tr>
		<tr>
			<td width="15%"><div class="tabtxt">Kode Suplier</div></td>
			<td width="2%"><div class="tabtxt">:</div></td>
			<td width="83%">
				<input name="kode_sup" style="width:200px" type="textfield" class="tfield" value="<?php echo $bf->bacaDatafakturbm('kode_sup', $kode_sup); ?>">
			</td>
		</tr>
		
        <tr>
			<td><div class="tabtxt">Nama Supplier</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="nama_sup" type="textfield" class="tfield" readonly="readonly" value="<?php echo $bf->tampilInfosupplier('nama_sup',$id_nsb);?>"/></td>
		</tr>
         <tr>
			<td><div class="tabtxt">Alamat</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><textarea name="alamat" style="width:200px" class="tfield" rows="3" /><?php echo $bf->tampilInfosupplier('alamat',$id_nsb); ?></textarea></td>
		</tr>
        <tr>
			<td><div class="tabtxt">Pokok Pinjaman</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="pokok" type="textfield" class="tfield" readonly="readonly" value="<?php echo $bf->tampilFakturmasuk('pokok',$nopim);?>"/></td>
		</tr>
          <tr>
			<td><div class="tabtxt">Lama Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="lama" type="textfield" class="tfield" readonly="readonly" value=<?php echo $bf->tampilFakturmasuk('lama',$nopim)."&nbsp;Kali";?> /></td>
		</tr>
          <tr>
			<td><div class="tabtxt">Bunga</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="bunga" type="textfield" class="tfield" readonly="readonly" value=<?php echo $bf->tampilFakturmasuk('bunga',$nopim)."&nbsp;%";?> /></td>
		</tr>
       
<tr>
			<td><div class="tabtxt">Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="angsuran" type="textfield" class="tfield" readonly="readonly" value="<?php echo $bf->tampilFakturmasuk('angsuran',$nopim);?>"/></td>
		</tr>
<?php       
 	
	//cari angsuran ke berapa lewat method cariAngsur()
	$angsuranke=$angsur->cariAngsuran($nopim);
 	
	//mencari berapa sisa angsuran
	$lamapinj = $bf->tampilFakturmasuk('lama',$nopim);
	$sisaangsuran=$angsur->cariSisaAngsur($lamapinj,$angsuranke);

	//pencarian apakah nasabah terkena denda atau tidak
	$tglpinjam=$angsur->tampilFakturmasuk('tgl',$nopim);
	$tempo_tgl = substr($tglpinjam,8,2);
	$tempo_bln= substr($tglpinjam,5,2);
	$tempo_thn =substr($tglpinjam,0,4);
	
	$angsuran = $bf->tampilFakturmasuk('angsuran',$nopim);
	$cekDendaTempo = $bf->cekDenda($angsuranke,$tempo_bln,$tempo_tgl,$tempo_thn,$angsuran);
	//set value array 0 (value $tglp_tempo) pada method cekDenda() 
	$tgltempo=$cekDendaTempo[0];
	
	//set value array 1 (value $haridenda) pada method cekDenda()
	$haridenda=$cekDendaTempo[1];
	
	//set value array 2 (value $jml_denda) pada method cekDenda()
	$jumlahdenda=$cekDendaTempo[2];
	
	//hitung total bayar
	$totalbayar=$angsur->hitungTotal($angsuran,$jumlahdenda);

?>
    <tr>
			<td><div class="tabtxt">Pembayaran Angsuran Ke -</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="ags_ke" type="textfield" class="tfield" readonly="readonly" value="<?php echo $angsuranke;?>"/></td>
</tr>    
    <tr>
			<td><div class="tabtxt">Sisa Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="sisa_ags" type="textfield" class="tfield" readonly="readonly" value=<?php echo $sisaangsuran."&nbsp;Kali";?> /></td>
</tr> 
 <tr>
			<td><div class="tabtxt">Tanggal Jatuh Tempo</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input  style="width:200px" name="tempo" type="textfield" class="tfield" readonly="readonly" value="<?php echo $tgltempo ;?>" /></td>
</tr>   
    <tr>
			<td><div class="tabtxt">Denda</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="denda" type="textfield" class="tfield" readonly="readonly" value=<?php echo $haridenda."&nbsp;Hari";?> /></td>
</tr>   
    <tr>
			<td><div class="tabtxt">Jumlah Denda</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="jml_denda" type="textfield" class="tfield" readonly="readonly" value="<?php echo $jumlahdenda;?>"/></td>
</tr> 
<tr>
			<td><div class="tabtxt">Total Bayar Angsuran</div></td>
			<td><div class="tabtxt">:</div></td>
			<td><input style="width:200px" name="tobay" type="textfield" class="tfield" readonly="readonly" value="<?php echo $totalbayar;?>"/></td>
</tr> 
<tr>
<td colspan="2">&nbsp;</td>
			<td>
				<input name="submit" type="submit" class="button" value="Simpan" >&nbsp;&nbsp;
				<input type="button" class="button" value="Batal" onclick=self.history.back()>
			</td>
		</tr>
		</form>
	</table>

<?php
	if($_POST['submit']){
	$kode_sup=$_POST['id_nasabah'];
	$tgl=$_POST['tgl'];
	$telat=$_POST['denda'];
	$jml_denda=$_POST['jml_denda'];
	$no_faktur=$_POST['no_pinjam'];
	$lm_angsur=$_POST['lama'];
	$ags_ke=$_POST['ags_ke'];
	$tempo = tgl_ind_to_eng($_POST['tempo']);
	$tgl_eng=substr($tgl,6,4)."-".substr($tgl,3,2)."-".substr($tgl,0,2);
	// tambah data angsuran via method
	//cek apakah angsuran sudah lunas atau belum
	if($lm_angsur-$ags_ke>0){
		$bf->simpanAngsuran($tgl_eng, $tempo, $ags_ke, $telat, $jml_denda, $no_faktur, $kode_sup);
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=?page=pinjaman_mgr">'; 
	}else {
	$bf->simpanAngsuran($tgl_eng, $tempo, $ags_ke, $telat, $jml_denda, $no_faktur, $kode_sup);
	$bf->updateAngsuran($no_pinjam);
	}
	
}
?>