<?php

class AnalyseCost{

    // database connection and table name
    private $db;

    // object properties
    public $ItemID;
    public $ItemName;
    public $UnitPrice;
    public $Quantity;
    public $TankNo;
    public $SupplierID;
    public $DatePurchased;

    // constructor with $db as database connection
    public function __construct($db){
        $this->db = $db;
    }

    public function getAllData() {
        // Code to fetch and return all data from the analysecost table
        // You can use your existing SQL query or modify it as needed
        $sql = "SELECT * FROM analysecost";
        $statement = $this->db->query($sql);

        // Fetch and return the data
        $data = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    // Get total purchased amount
    public function getTotalPurchased() {
        $query = "SELECT SUM(UnitPrice * Quantity) AS TotalPurchased FROM analysecost" ;
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalPurchased = $row['TotalPurchased'];

        return $totalPurchased;
    }

    // Get total item count
    public function getTotalItem() {
        $query = "SELECT SUM(Quantity) AS TotalItem FROM analysecost";
        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalItem = $row['TotalItem'];

        return $totalItem;
    }

    // Get monthly spend for a given month
    public function getMonthlySpend($month) {
        $query = "SELECT IFNULL(SUM(UnitPrice * Quantity), 0) AS MonthlySpend FROM analysecost WHERE DATE_FORMAT(DatePurchased, '%Y-%m') = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(1, $month);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $monthlySpend = number_format($row['MonthlySpend'], 2, '.', '');

        return $monthlySpend;
    }
}
?>