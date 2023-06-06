<?php

class Fish{

    // database connection and table name
    private $conn;

    // object properties
    public $AllocatedTankNo;
    public $FishID;
    public $FishType;
    public $AverageFishLength;
    public $AverageFishWeight;
    public $TotalFishWeight;
    public $Quantity;
    public $LastDateAdded;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read fish status
    function getfishintankA(){

        // select all query
        $query = "SELECT *
        FROM marinelifedata
        WHERE AllocatedTankNo = 'A';";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getfishintankB(){

        // select all query
        $query = "SELECT *
        FROM marinelifedata
        WHERE AllocatedTankNo = 'B';";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function getfishintankC(){

        // select all query
        $query = "SELECT *
        FROM marinelifedata
        WHERE AllocatedTankNo = 'C';";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function getfishintankD(){

        // select all query
        $query = "SELECT *
        FROM marinelifedata
        WHERE AllocatedTankNo = 'D';";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    
    function getfishintankE(){

        // select all query
        $query = "SELECT *
        FROM marinelifedata
        WHERE AllocatedTankNo = 'E';";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


}
