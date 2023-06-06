<?php

class Sensor{

    // database connection and table name
    private $conn;

    // object properties
    public $sensorID;
    public $dateAdded;
    public $status;
    public $tankNo;
    public $sensorType;
    public $sensorInput;
    public $inputUnit;
    public $lastServiced;

    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // read sensor status
    function sensorStatus() {
        // Select query to retrieve active and inactive sensor counts
        $query = "SELECT
            SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) AS activeSensors,
            SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) AS inactiveSensors
            FROM manageSensor";

        try {
            // Prepare query statement
            $stmt = $this->conn->prepare($query);
            // Execute query
            $stmt->execute();

            // Fetch the result
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return $result;
        } catch (PDOException $e) {
            // Handle any database errors
            // You can log the error or return an error message as per your requirement
            return array('activeSensors' => 0, 'inactiveSensors' => 0);
        }
    }


    // read sensor type
    function sensorType()
    {
        // Select all query
        $query = "SELECT sensorType, COUNT(*) AS sensorCount
                FROM manageSensor
                GROUP BY sensorType
                LIMIT 5";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        // Return the data as JSON
        return $stmt;
    }



    // read no of sensor
    function noSensor(){

        // select all query
        $query = "SELECT tankNo, COUNT(*) AS sensorCount
        FROM manageSensor
        GROUP BY tankNo
        ORDER BY tankNo ASC
        LIMIT 5";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // read maintenance date
    function sensorMain(){

        // select all query
        $query = "SELECT tankNo, sensorID, dateAdded, status, sensorType, sensorInput, inputUnit, lastServiced
        FROM manageSensor
        ORDER BY lastServiced ASC
        LIMIT 5";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
        }

    // Read all sensors by tank
    function getSensorsByTank() {
        // Select query to retrieve sensor data grouped by tank
        $query = "SELECT tankNo, sensorID, dateAdded,
        CASE
            WHEN status = 0 THEN 'Inactive'
            WHEN status = 1 THEN 'Active'
        END AS status,
        sensorType, sensorInput, inputUnit, lastServiced
    FROM manageSensor
    ORDER BY tankNo, sensorID;
    SELECT tankNo, sensorID, dateAdded,
        CASE
            WHEN status = 0 THEN 'Inactive'
            WHEN status = 1 THEN 'Active'
        END AS status,
        sensorType, sensorInput, inputUnit, lastServiced
    FROM manageSensor
    ORDER BY tankNo, sensorID";

        // Prepare query statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        // // Fetch all rows
        // $sensors = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stmt;
    }

    // Add sensor
    function createSensor(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO manageSensor (sensorID, dateAdded, status, tankNo, sensorType, sensorInput, inputUnit, lastServiced)
                    VALUES ('".$this->newSensorID."', '".$this->newDateAdded."','".$this->newStatus."',
                    '".$this->newTankNo."','".$this->newSensorType."','".$this->newSensorInput."',
                    '".$this->newInputUnit."','".$this->newLastServiced."')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

        // Read a sensors 
        function getASensor() {
            // Select query to retrieve sensor data grouped by tank
            $query = "SELECT tankNo, sensorID, dateAdded,
            CASE
                WHEN status = 0 THEN 'Inactive'
                WHEN status = 1 THEN 'Active'
            END AS status,
            sensorType, sensorInput, inputUnit, lastServiced
            FROM manageSensor
            WHERE sensorID = '".$this->existingSensorID."';
            ";
    
            // Prepare query statement
            $stmt = $this->conn->prepare($query);
    
            // Execute query
            $stmt->execute();
    
            return $stmt;
        }

    // update sensor
    function updateSensor(){

        // query to insert record
        $query = "UPDATE manageSensor
                    SET
                    tankNo = '".$this->existingTankNo."',
                    status = '".$this->existingStatus."',
                    sensorType = '".$this->existingSensorType."',
                    sensorInput = '".$this->existingSensorInput."',
                    inputUnit = '".$this->existingInputUnit."',
                    lastServiced = '".$this->existingLastServiced."'
                    WHERE sensorID = '".$this->existingSensorID."'";
        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete sensor
    function deleteSensor(){

        // query to insert record
        $query = "DELETE FROM manageSensor
        WHERE sensorID = '".$this->existingSensorID."';
        ";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }


    //check if exist
    function isAlreadyExist(){
        $query = "SELECT * FROM manageSensor WHERE
                sensorID = '".$this->newSensorID."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
