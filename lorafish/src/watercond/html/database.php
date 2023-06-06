<?php
class Database{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "lorafishdb";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=3306;dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

     // read aquatank list
     function getAquatankList($tankNo, $listDate){

        // query
        $query = "SELECT * FROM watercondition WHERE tankNo = '".$tankNo."' AND date = '".$listDate."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        $rows = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rows;
    }
    
    // read sensor status
    function getThreshold(){

    // select all query
    $query = "SELECT * FROM alarm";

    // prepare query statement
    $stmt = $this->conn->prepare($query);

    // execute query
    $stmt->execute();

    $threshold = $stmt->fetch(PDO::FETCH_ASSOC);

    return $threshold;

    }

      // read sensor status
      function getSensor($sensorType, $tankNo){

        // select all query
        $query = "SELECT * FROM manageSensor WHERE sensorType = :sensorType AND tankNo = :tankNo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":sensorType", $sensorType);
        $stmt->bindParam(":tankNo", $tankNo);

        // prepare query statement
    
        // execute query
        $stmt->execute();
    
        $sensor = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $sensor;
        }

        // read alarm
      function getAlarm($tankNo){

        // select all query
        $query = "SELECT * FROM alarm WHERE tankNo = :tankNo";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":tankNo", $tankNo);

        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        $alarm = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $alarm;
        }

}
?>