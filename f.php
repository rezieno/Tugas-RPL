<?php
//koneksi ke database
$host = "localhost";
$user = "root";
$pass = "";
$dbnm = "kkcosmetic";
 
$conn = mysql_connect($host, $user, $pass);
if ($conn) {
	$open = mysql_select_db($dbnm);
	if (!$open) {
		die ("Database tidak dapat dibuka karena ".mysql_error());
	}
} else {
	die ("Server MySQL tidak terhubung karena ".mysql_error());
}
//akhir koneksi
 
#ambil data di tabel dan masukkan ke array
$query = "SELECT * FROM barang ORDER BY kode_brg";
$sql = mysql_query ($query);
$data = array();
while ($row = mysql_fetch_assoc($sql)) {
	array_push($data, $row);
}

#sertakan library FPDF dan bentuk objek
require('pdf_js.php');

class PDF_AutoPrint extends PDF_JavaScript
{
function AutoPrint($dialog=false)
{
	//Open the print dialog or start printing immediately on the standard printer
	$param=($dialog ? 'true' : 'false');
	$script="print($param);";
	$this->IncludeJS($script);
}

function AutoPrintToPrinter($server, $printer, $dialog=false)
{
	//Print on a shared printer (requires at least Acrobat 6)
	$script = "var pp = getPrintParams();";
	if($dialog)
		$script .= "pp.interactive = pp.constants.interactionLevel.full;";
	else
		$script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
	$script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
	$script .= "print(pp);";
	$this->IncludeJS($script);
}
}	
 
#setting judul laporan dan header tabel
$judul = "LAPORAN SISTEM INFORMASI PERSEDIAAN BARANG";
$header = array(
		array("label"=>"KODE BARANG", "length"=>30, "align"=>"L"),
		array("label"=>"NAMA BARANG", "length"=>50, "align"=>"L"),
		array("label"=>"HARGA SATUAN", "length"=>80, "align"=>"L"),
		array("label"=>"STOK BARANG", "length"=>30, "align"=>"L")
	);
	

	

$pdf = new PDF_AutoPrint();
$pdf->AddPage();
$tgl = date('d-M-Y');


 
#tampilkan judul laporan
$pdf->SetFont('Arial','B','16');


$pdf->Cell(0,20, $judul, '0', 1, 'C');

 
#buat header tabel
$pdf->SetFont('Arial','','10');
$pdf->SetFillColor(255,0,0);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128,0,0);
foreach ($header as $kolom) {
	$pdf->Cell($kolom['length'], 5, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();


 
#tampilkan data tabelnya
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill=false;
foreach ($data as $baris) {
	$i = 0;
	foreach ($baris as $cell) {
		$pdf->Cell($header[$i]['length'], 5, $cell, 1, '0', $kolom['align'], $fill);
		$i++;
	}
	$fill = !$fill;
	$pdf->Ln();
}
$pdf->text(160,5,"Tanggal Dicetak , ".$tgl);
$pdf->Image('.\images\kk.jpg',5,0,20);
#output file PDF
$pdf->AutoPrint(true);
$pdf->Output();


?>