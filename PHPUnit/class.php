<?php
class Database {
	// properti
	private $dbHost="localhost";
	private $dbUser="root";
	private $dbPass="";
	private $dbName="kkcosmetic";
	protected $conn;
	
	// method koneksi mysql
	function connectMySQL() {
		$this->conn = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		mysql_select_db($this->dbName) or die ("Database Tidak Ditemukan di Server"); 
	}
	//conn = $this->connectMySQL();
}

class User {
// Proses Login
	function cek_login($user, $password) {
		$password = md5($password);
		$result = mysql_query("SELECT * FROM user WHERE nama_user='$user' AND pass='$password'");
		$user_data = mysql_fetch_array($result);
		$no_rows = mysql_num_rows($result);
		if ($no_rows == 1) {
			$_SESSION['login'] = TRUE;
			$_SESSION['id'] = $user_data['id'];
			return TRUE;
		}
		else {
		  return FALSE;
		}
	}
	
	// Ambil Sesi 
	function get_sesi() {
		return $_SESSION['login'];
	}
	
	// Logout 
	function user_logout() {
		$_SESSION['login'] = FALSE;
		session_destroy();
	}
}	

class Supplier extends Database
{
	// method tampil data supplier	
	function tampilSupplierSemua() {
		$query = mysql_query("SELECT * FROM supplier ORDER BY kode_sup");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data supplier
	function tampilSupplierFilter($keyword) {
		$query = mysql_query("SELECT * FROM supplier WHERE nama_sup LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data supplier 
	function bacaDataSupplier($field, $kode_sup) {
		$query = mysql_query("SELECT * FROM supplier WHERE kode_sup = '$kode_sup'");
		$data=mysql_fetch_array($query);
	    if ($field == 'kode_sup') return $data['kode_sup'];
		else if ($field == 'nama_sup') return $data['nama_sup'];
		else if ($field == 'alamat_sup') return $data['alamat_sup'];
		else if ($field == 'telp_sup') return $data['telp_sup'];
	}
	
	// method untuk proses update data supplier
	function updateDataSupplier($kode_sup, $nama_sup,  $alamat_sup, $telp_sup) {
		$query = mysql_query("UPDATE supplier SET
				  nama_sup = '$nama_sup',alamat_sup = '$alamat_sup', telp_sup = '$telp_sup'
				  WHERE kode_sup = '$kode_sup'");
		echo "Data Supplier sudah di update";	
	}
	
	// method menghapus data supplier
	function hapusSupplier($kode_sup) {
		$query = mysql_query("DELETE FROM supplier WHERE kode_sup = '$kode_sup'");
		echo "Data Supplier ".$kode_sup." sudah di hapus";
	}
	
	// method untuk proses tambah data supplier
	function tambahDataSupplier($kode_sup, $nama_sup, $alamat_sup, $telp_sup) {
		$this->connectMySQL();
		$query = "INSERT INTO supplier (kode_sup, nama_sup, alamat_sup, telp_sup)
		          VALUES ('$kode_sup', '$nama_sup', '$alamat_sup', '$telp_sup')";
		$hasil = mysql_query($query);
	}
}

class pembeli extends Database
{
		// method tampil data pembeli	
	function tampilPembeliSemua() {
		$query = mysql_query("SELECT * FROM pembeli ORDER BY kode_pembeli");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data pembeli
	function tampilPembeliFilter($keyword) {
		$query = mysql_query("SELECT * FROM pembeli WHERE nama_pembeli LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data pembeli
	function bacaDataPembeli($field, $kode_pembeli)
	{
		$query = mysql_query("SELECT * FROM pembeli where kode_pembeli = '$kode_pembeli'");
		$data=mysql_fetch_array($query);
	    if ($field == 'kode_pembeli') return $data['kode_pembeli'];
		else if ($field == 'nama_pembeli') return $data['nama_pembeli'];
		else if ($field == 'alamat') return $data['alamat'];
		else if ($field == 'telp') return $data['telp'];
	}

	// method untuk proses update data pembeli
	function updateDataPembeli($kode_pembeli, $nama_pembeli,$alamat,$telp )
	{
		$query = mysql_query("UPDATE pembeli SET
				  nama_pembeli = '$nama_pembeli',alamat = '$alamat',telp = '$telp' WHERE kode_pembeli = '$kode_pembeli'");
		echo "Data pembeli sudah diupdate";	
	}
	
	// method menghapus data pembeli
	function hapusPembeli($kode_pembeli)
	{
		$this->connectMySQL();
		$query = "DELETE FROM pembeli WHERE kode_pembeli = '$kode_pembeli'";
		mysql_query($query);
	}
	
	// method untuk proses tambah data pembeli
	function tambahDataPembeli($kode_pembeli,$nama_pembeli,$alamat,$telp)
	{		
		$query = "INSERT INTO pembeli (kode_pembeli,nama_pembeli,alamat,telp) VALUES ('$kode_pembeli','$nama_pembeli','$alamat','$telp')";
		$hasil = mysql_query($conn, $query);
	}
}

class barang extends Database
{
		// method tampil data barang	
	function tampilBarangSemua() {
		$query = mysql_query("SELECT * FROM barang ORDER BY kode_brg");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data barang
	function tampilBarangFilter($keyword) {
		$query = mysql_query("SELECT * FROM barang WHERE nama_brg LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data barang
	function bacaDataBarang($field, $kode_brg)
	{
		$query = mysql_query("SELECT * FROM barang where kode_brg = '$kode_brg'");
		$data=mysql_fetch_array($query);
	    if ($field == 'kode_brg') return $data['kode_brg'];
		else if ($field == 'nama_brg') return $data['nama_brg'];
		else if ($field == 'harga_satuan') return $data['harga_satuan'];
		else if ($field == 'stok_brg') return $data['stok_brg'];
	}

	// method untuk proses update data barang
	function updateDataBarang($kode_brg, $nama_brg,$harga_satuan,$stok_brg)
	{
		$query = mysql_query("UPDATE barang SET
				  nama_brg = '$nama_brg',harga_satuan = '$harga_satuan', stok_brg = '$stok_brg' WHERE kode_brg = '$kode_brg'");
		echo "Data barang sudah diupdate";	
	}
	
	// method menghapus data barang
	function hapusBarang($kode_brg)
	{
		$this->connectMySQL();
		$query = "DELETE FROM barang WHERE kode_brg = '$kode_brg'";
		mysql_query($query);
		echo "Data kode barang  ".$kode_brg." sudah dihapus";
	}
	
	// method untuk proses tambah data barang
	function tambahDataBarang($kode_brg)
	{
		$this->connectMySQL();
		$query = "INSERT INTO barang (kode_brg,nama_brg,harga_satuan,stok_brg) VALUES ('$kode_brg','$nama_brg','$harga_satuan','$stok_brg')";
		$hasil = mysql_query($query);
	}
}

class Barangmasuk extends Database
{
	// method tampil data supplier	
	function tampilBmSemua() {
		$query = mysql_query("SELECT * FROM temp_brgmasuk ORDER BY id_detail");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data supplier
	function tampilBmFilter($keyword) {
		$query = mysql_query("SELECT * FROM temp_brgmasuk WHERE id_detail LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data supplier 
	function bacaDataBm($field, $id_detail) {
		$query = mysql_query("SELECT * FROM temp_brgmasuk WHERE id_detail = '$id_detail'");
		$data=mysql_fetch_array($query);
	    if ($field == 'id_detail') return $data['id_detail'];
		else if ($field == 'kode_brg') return $data['kode_brg'];
		else if ($field == 'jum_brg') return $data['jum_brg'];
	}
	
	// method untuk proses update data supplier
	function updateDataBm($id_detail, $kode_brg,  $jum_brg) {
		$query = mysql_query("UPDATE temp_brgmasuk SET
				  kode_brg = '$kode_brg',jum_brg = '$jum_brg'
				  WHERE id_detail = '$id_detail'");
		echo "Data barang masuk sudah di update";	
	}
	
	// method menghapus data supplier
	function hapusBm($id_detail) {
		$this->connectMySQL();
		$query = mysql_query("DELETE FROM temp_brgmasuk WHERE id_detail = '$id_detail'");
		echo "Data Barang masuk ".$kode_sup." sudah di hapus";
	}
	
	// method untuk proses tambah data supplier
	function tambahDataBm($id_detail, $kode_brg, $jum_brg) {
		$query = "INSERT INTO temp_brgmasuk (id_detail, kode_brg, jum_brg)
		          VALUES ('$id_detail', '$kode_brg', '$jum_brg')";
		$hasil = mysql_query($query);
	}
}

class ProsesBm {
	// method tampil data supplier	
	function tampilProsesBmSemua() {
		$query = mysql_query("SELECT * FROM brg_masuk ORDER BY no_faktur");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data supplier
	function tampilProsesBmFilter($keyword) {
		$query = mysql_query("SELECT * FROM brg_masuk WHERE no_faktur LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data supplier 
	function bacaDataProsesBm($field, $no_faktur) {
		$query = mysql_query("SELECT * FROM brg_masuk WHERE no_faktur = '$no_faktur'");
		$data=mysql_fetch_array($query);
	    if ($field == 'no_faktur') return $data['no_faktur'];
		else if ($field == 'kode_sup') return $data['kode_sup'];
		else if ($field == 'tg_trans') return $data['tg_trans'];
	}
	
	// method untuk proses update data supplier
	function updateDataProsesBm($no_faktur, $kode_sup,  $tg_trans) {
		$query = mysql_query("UPDATE brg_masuk SET
				  kode_sup = '$kode_sup',tg_trans = '$tg_trans'
				  WHERE no_faktur = '$no_faktur'");
		echo "Data Proses barang masuk sudah di update";	
	}
	
	// method menghapus data supplier
	function hapusProsesBm($no_faktur) {
		$query = mysql_query("DELETE FROM brg_masuk WHERE no_faktur = '$no_faktur'");
		echo "Data Proses Barang masuk ".$no_faktur." sudah di hapus";
	}
	
	// method untuk proses tambah data supplier
	function tambahDataProsesBm($no_faktur, $kode_sup, $tg_trans) {
		$query = "INSERT INTO brg_masuk (no_faktur, kode_sup, tg_trans)
		          VALUES ('$no_faktur', '$kode_sup', '$tg_trans')";
		$hasil = mysql_query($query);
	}
}

class Barangkeluar {
	// method tampil data supplier	
	function tampilBkSemua() {
		$query = mysql_query("SELECT * FROM temp_brgkeluar ORDER BY id_detail");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data supplier
	function tampilBkFilter($keyword) {
		$query = mysql_query("SELECT * FROM temp_brgkeluar WHERE id_detail LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data supplier 
	function bacaDataBk($field, $id_detail) {
		$query = mysql_query("SELECT * FROM temp_brgkeluar WHERE id_detail = '$id_detail'");
		$data=mysql_fetch_array($query);
	    if ($field == 'id_detail') return $data['id_detail'];
		else if ($field == 'kode_brg') return $data['kode_brg'];
		else if ($field == 'jum_brg') return $data['jum_brg'];
	}
	
	// method untuk proses update data supplier
	function updateDataBk($id_detail, $kode_brg,  $jum_brg) {
		$query = mysql_query("UPDATE temp_brgkeluar SET
				  kode_brg = '$kode_brg',jum_brg = '$jum_brg'
				  WHERE id_detail = '$id_detail'");
		echo "Data barang keluar sudah di update";	
	}
	
	// method menghapus data supplier
	function hapusBk($id_detail) {
		$query = mysql_query("DELETE FROM temp_brgkeluar WHERE id_detail = '$id_detail'");
		echo "Data Barang keluar ".$kode_sup." sudah di hapus";
	}
	
	// method untuk proses tambah data supplier
	function tambahDataBk($id_detail, $kode_brg, $jum_brg) {
		$query = "INSERT INTO temp_brgkeluar (id_detail, kode_brg, jum_brg)
		          VALUES ('$id_detail', '$kode_brg', '$jum_brg')";
		$hasil = mysql_query($query);
	}
}

class ProsesBk {
	// method tampil data supplier	
	function tampilProsesBkSemua() {
		$query = mysql_query("SELECT * FROM brg_keluar ORDER BY no_faktur");
		while($row=mysql_fetch_array($query))
		  $data[]=$row;
	    return $data;
	}
	
	// method filter data supplier
	function tampilProsesBkFilter($keyword) {
		$query = mysql_query("SELECT * FROM brg_keluar WHERE no_faktur LIKE '%$keyword%'");
		
		  while($row=mysql_fetch_array($query)) 
		    $data[]=$row;
		    return $data;
	  	
		
	}
	
	// method mengambil data supplier 
	function bacaDataProsesBk($field, $no_faktur) {
		$query = mysql_query("SELECT * FROM brg_keluar WHERE no_faktur = '$no_faktur'");
		$data=mysql_fetch_array($query);
	    if ($field == 'no_faktur') return $data['no_faktur'];
		else if ($field == 'kode_pembeli') return $data['kode_pembeli'];
		else if ($field == 'tgl_trans') return $data['tgl_trans'];
	}
	
	// method untuk proses update data supplier
	function updateDataProsesBk($no_faktur, $kode_pembeli,$tgl_trans) {
		$query = mysql_query("UPDATE brg_keluar SET
				  kode_pembeli = '$kode_pembeli',tgl_trans = '$tgl_trans'
				  WHERE no_faktur = '$no_faktur'");
		echo "Data Proses barang keluar sudah di update";	
	}
	
	// method menghapus data supplier
	function hapusProsesBk($no_faktur) {
		$query = mysql_query("DELETE FROM brg_keluar WHERE no_faktur = '$no_faktur'");
		echo "Data Proses Barang keluar ".$kode_sup." sudah di hapus";
	}
	
	// method untuk proses tambah data supplier
	function tambahDataProsesBk($no_faktur, $kode_pembeli, $tgl_trans) {
		$query = "INSERT INTO brg_keluar (no_faktur, kode_pembeli, tgl_trans)
		          VALUES ('$no_faktur', '$kode_pembeli', '$tgl_trans')";
		$hasil = mysql_query($query);
	}
}





