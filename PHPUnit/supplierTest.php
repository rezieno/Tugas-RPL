<?php
include "class.php";

class supplierTest extends PHPUnit_Extensions_Database_TestCase {
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
		$dataset->addTable('supplier', dirname(__FILE__) . '/files/supplier.csv');
		return $dataset;
	}
	
	public function testTambah()
    {
		$dataSet = $this->getConnection()->createDataSet();
        $this->assertEquals(6, $this->getConnection()->getRowCount('supplier'), "Pre-Condition");

		$Supplier = new Supplier();
		$Supplier->tambahDataSupplier('7','syaiful afdhal','lumin','98097786');
        
        $this->assertEquals(7, $this->getConnection()->getRowCount('supplier'), "Inserting failed");
    }
}