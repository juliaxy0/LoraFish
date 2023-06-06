<?php

class Fish{

    // database connection and table name
    private $conn;

    // object properties
    public $tankNo;
    public $fishID;
    public $fishLength;
    public $fishWeight;
    public $growthRate;
    public $dateAdded;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function getTilapiaData(){

        // select all query
        $query = "SELECT * FROM tilapia;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getCatfishData(){

        // select all query
        $query = "SELECT * FROM catfish;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getSalmonData(){

        // select all query
        $query = "SELECT * FROM salmon;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getTroutData(){

        // select all query
        $query = "SELECT * FROM trout;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getTunaData(){

        // select all query
        $query = "SELECT * FROM tuna;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }



    function getLastNo(){

        // select all query
        $query = "SELECT COUNT(*)
        FROM tilapia;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }


    function getLastNoB(){

        // select all query
        $query = "SELECT COUNT(*)
        FROM catfish;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getLastNoC(){

        // select all query
        $query = "SELECT COUNT(*)
        FROM salmon;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getLastNoD(){

        // select all query
        $query = "SELECT COUNT(*)
        FROM trout;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function getLastNoE(){

        // select all query
        $query = "SELECT COUNT(*)
        FROM tuna;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

}