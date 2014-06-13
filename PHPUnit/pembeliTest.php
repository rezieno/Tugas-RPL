<?php
include "class.php";

class pembeliTest extends PHPUnit_Extensions_Database_TestCase {
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
		$dataset->addTable('pembeli', dirname(__FILE__) . '/files/pembeli.csv');
		return $dataset;
	}
	
	public function testTambah()
    {
		$dataSet = $this->getConnection()->createDataSet();
        $this->assertEquals(2, $this->getConnection()->getRowCount('pembeli'), "Pre-Condition");

		$beli = new pembeli();
		$beli->hapusPembeli('2');
        
        $this->assertEquals(1, $this->getConnection()->getRowCount('pembeli'), "Inserting failed");
    }
}