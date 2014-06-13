<?php
include "class.php";

class barangTest extends PHPUnit_Extensions_Database_TestCase {
	protected $conn = null;

	public function getConnection() {
		if (is_null($this->conn)) {
			$pdo = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
			$this->conn = $this->createDefaultDBConnection($pdo);
		}
		return $this->conn;
	}

	public function setUp()
	{
		$this->getConnection()->getConnection()->query("set foreign_key_checks=0");
		parent::setUp();
		$this->getConnection()->getConnection()->query("set foreign_key_checks=1");
	}
	
	public function getDataSet() {
		$dataset = new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
		$dataset->addTable('barang', dirname(__FILE__) . '/files/barang.csv');
		return $dataset;
	}
	
	public function testTambah()
    {
		$dataSet = $this->getConnection()->createDataSet();
        $this->assertEquals(2, $this->getConnection()->getRowCount('barang'), "Pre-Condition");

		$barang = new barang();
		$barang->hapusBarang('2');
        
        $this->assertEquals(1, $this->getConnection()->getRowCount('barang'), "Inserting failed");
    }
}