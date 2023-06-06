<?php
class TilapiaFish{

    // database connection and table name
    private $conn;
    private $table_name = "tilapia";
    private $table_name2 = "persons_fishWeight";

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


    // create doctor
    function createFish() {
        if ($this->isAlreadyExist()) {
            return false;
        }
    
        // query to insert record
        $query = "INSERT INTO tilapia (tankNo, fishID, fishLength, fishWeight, growthRate, dateAdded)
        VALUES ('".$this->tankNo."', '".$this->fishID."','".$this->fishLength."',
        '".$this->fishWeight."','".$this->growthRate."','".$this->dateAdded."'); ";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // execute query
        if ($stmt->execute()) {
            $this->id = $this->conn->lastInsertId();
    
            // Update marinelifedata
            $updateQuery1 = "UPDATE marinelifedata
            SET quantity = quantity + 1
            WHERE AllocatedTankNo = 'A';";
            $stmt1 = $this->conn->prepare($updateQuery1);
            $stmt1->execute();
    
            $updateQuery2 = "UPDATE marinelifedata
            SET TotalFishWeight = TotalFishWeight  + '".$this->fishWeight."'
            WHERE AllocatedTankNo = 'A';";
            $stmt2 = $this->conn->prepare($updateQuery2);
            $stmt2->execute();
    
            $updateQuery3 = "UPDATE marinelifedata
            SET LastDateAdded = '".$this->dateAdded."'
            WHERE AllocatedTankNo = 'A';";
            $stmt3 = $this->conn->prepare($updateQuery3);
            $stmt3->execute();
    
            $updateQuery4 = "UPDATE marinelifedata
            SET AverageFishWeight = 
            (SELECT AVG(fishWeight) 
            FROM tilapia) 
            WHERE AllocatedTankNo = 'A';";
            $stmt4 = $this->conn->prepare($updateQuery4);
            $stmt4->execute();
    
            $updateQuery5 = "UPDATE marinelifedata
            SET AverageFishLength = 
            (SELECT AVG(fishLength) 
            FROM tilapia) 
            WHERE AllocatedTankNo = 'A';";
            $stmt5 = $this->conn->prepare($updateQuery5);
            $stmt5->execute();
    
            return true;
        }
    
        return false;
    }

            // update fish
            function updateFishA() {
                // query to update record
                $query = "UPDATE tilapia
                        SET
                            fishLength='".$this->fishLength."',
                            fishWeight='".$this->fishWeight."',
                            growthRate='".$this->growthRate."',
                            dateAdded='".$this->dateAdded."'
                        WHERE
                            fishID='".$this->fishID."'";

                // prepare query
                $stmt = $this->conn->prepare($query);
                // execute query
                if ($stmt->execute()) {
            
                    $updateQuery2 = "UPDATE marinelifedata
                    SET TotalFishWeight = (
                    SELECT SUM(fishWeight) 
                    FROM tilapia) 
                    WHERE AllocatedTankNo = 'A';";
                    $stmt2 = $this->conn->prepare($updateQuery2);
                    $stmt2->execute();
            
                    $updateQuery3 = "UPDATE marinelifedata
                    SET LastDateAdded ='".$this->dateAdded."'
                    WHERE AllocatedTankNo = 'A';";
                    $stmt3 = $this->conn->prepare($updateQuery3);
                    $stmt3->execute();
            
                    $updateQuery4 = "UPDATE marinelifedata
                    SET AverageFishWeight = 
                    (SELECT AVG(fishWeight) 
                    FROM tilapia) 
                    WHERE AllocatedTankNo = 'A';";
                    $stmt4 = $this->conn->prepare($updateQuery4);
                    $stmt4->execute();
            
                    $updateQuery5 = "UPDATE marinelifedata
                    SET AverageFishLength = 
                    (SELECT AVG(fishLength) 
                    FROM tilapia) 
                    WHERE AllocatedTankNo = 'A';";
                    $stmt5 = $this->conn->prepare($updateQuery5);
                    $stmt5->execute();
            
                    return true;
                }
            
                return false;
            }


                    function createFishB() {
            if ($this->isAlreadyExist()) {
                return false;
            }

            // query to insert record
            $query = "INSERT INTO catfish (tankNo, fishID, fishLength, fishWeight, growthRate, dateAdded)
            VALUES ('".$this->tankNo."', '".$this->fishID."','".$this->fishLength."',
            '".$this->fishWeight."','".$this->growthRate."','".$this->dateAdded."'); ";

            // prepare query
            $stmt = $this->conn->prepare($query);

            // execute query
            if ($stmt->execute()) {
                $this->id = $this->conn->lastInsertId();

                // Update marinelifedata
                $updateQuery1 = "UPDATE marinelifedata
                SET quantity = quantity + 1
                WHERE AllocatedTankNo = 'B';";
                $stmt1 = $this->conn->prepare($updateQuery1);
                $stmt1->execute();

                $updateQuery2 = "UPDATE marinelifedata
                SET TotalFishWeight = TotalFishWeight  + '".$this->fishWeight."'
                WHERE AllocatedTankNo = 'B';";
                $stmt2 = $this->conn->prepare($updateQuery2);
                $stmt2->execute();

                $updateQuery3 = "UPDATE marinelifedata
                SET LastDateAdded = '".$this->dateAdded."'
                WHERE AllocatedTankNo = 'B';";
                $stmt3 = $this->conn->prepare($updateQuery3);
                $stmt3->execute();

                $updateQuery4 = "UPDATE marinelifedata
                SET AverageFishWeight = 
                (SELECT AVG(fishWeight) 
                FROM catfish) 
                WHERE AllocatedTankNo = 'B';";
                $stmt4 = $this->conn->prepare($updateQuery4);
                $stmt4->execute();

                $updateQuery5 = "UPDATE marinelifedata
                SET AverageFishLength = 
                (SELECT AVG(fishLength) 
                FROM catfish) 
                WHERE AllocatedTankNo = 'B';";
                $stmt5 = $this->conn->prepare($updateQuery5);
                $stmt5->execute();

                return true;
            }

            return false;
        }

                    // update fish
                    function updateFishB() {
                        // query to update record
                        $query = "UPDATE catfish
                                SET
                                    fishLength='".$this->fishLength."',
                                    fishWeight='".$this->fishWeight."',
                                    growthRate='".$this->growthRate."',
                                    dateAdded='".$this->dateAdded."'
                                WHERE
                                    fishID='".$this->fishID."'";
        
                        // prepare query
                        $stmt = $this->conn->prepare($query);
                        // execute query
                        if ($stmt->execute()) {
        
                            $updateQuery2 = "UPDATE marinelifedata
                            SET TotalFishWeight = (
                            SELECT SUM(fishWeight) 
                            FROM catfish) 
                            WHERE AllocatedTankNo = 'B';";
                            $stmt2 = $this->conn->prepare($updateQuery2);
                            $stmt2->execute();
            
                            $updateQuery3 = "UPDATE marinelifedata
                            SET LastDateAdded =  '".$this->dateAdded."'
                            WHERE AllocatedTankNo = 'B';";
                            $stmt3 = $this->conn->prepare($updateQuery3);
                            $stmt3->execute();
            
                            $updateQuery4 = "UPDATE marinelifedata
                            SET AverageFishWeight = 
                            (SELECT AVG(fishWeight) 
                            FROM catfish) 
                            WHERE AllocatedTankNo = 'B';";
                            $stmt4 = $this->conn->prepare($updateQuery4);
                            $stmt4->execute();
            
                            $updateQuery5 = "UPDATE marinelifedata
                            SET AverageFishLength = 
                            (SELECT AVG(fishLength) 
                            FROM catfish) 
                            WHERE AllocatedTankNo = 'B';";
                            $stmt5 = $this->conn->prepare($updateQuery5);
                            $stmt5->execute();
            
                            return true;
                        }
            
                        return false;
                    }




                    function createFishC() {
                        if ($this->isAlreadyExist()) {
                            return false;
                        }
                    
                        // query to insert record
                        $query = "INSERT INTO salmon (tankNo, fishID, fishLength, fishWeight, growthRate, dateAdded)
                        VALUES ('".$this->tankNo."', '".$this->fishID."','".$this->fishLength."',
                        '".$this->fishWeight."','".$this->growthRate."','".$this->dateAdded."'); ";
                    
                        // prepare query
                        $stmt = $this->conn->prepare($query);
                    
                        // execute query
                        if ($stmt->execute()) {
                            $this->id = $this->conn->lastInsertId();
                    
                            // Update marinelifedata
                            $updateQuery1 = "UPDATE marinelifedata
                            SET quantity = quantity + 1
                            WHERE AllocatedTankNo = 'C';";
                            $stmt1 = $this->conn->prepare($updateQuery1);
                            $stmt1->execute();
                    
                            $updateQuery2 = "UPDATE marinelifedata
                            SET TotalFishWeight = TotalFishWeight  + '".$this->fishWeight."'
                            WHERE AllocatedTankNo = 'C';";
                            $stmt2 = $this->conn->prepare($updateQuery2);
                            $stmt2->execute();
                    
                            $updateQuery3 = "UPDATE marinelifedata
                            SET LastDateAdded = '".$this->dateAdded."'
                            WHERE AllocatedTankNo = 'C';";
                            $stmt3 = $this->conn->prepare($updateQuery3);
                            $stmt3->execute();
                    
                            $updateQuery4 = "UPDATE marinelifedata
                            SET AverageFishWeight = 
                            (SELECT AVG(fishWeight) 
                            FROM salmon) 
                            WHERE AllocatedTankNo = 'C';";
                            $stmt4 = $this->conn->prepare($updateQuery4);
                            $stmt4->execute();
                    
                            $updateQuery5 = "UPDATE marinelifedata
                            SET AverageFishLength = 
                            (SELECT AVG(fishLength) 
                            FROM salmon) 
                            WHERE AllocatedTankNo = 'C';";
                            $stmt5 = $this->conn->prepare($updateQuery5);
                            $stmt5->execute();
                    
                            return true;
                        }
                    
                        return false;
                    }
                            // update fish
                            function updateFishC() {
                                // query to update record
                                $query = "UPDATE salmon
                                        SET
                                            fishLength='".$this->fishLength."',
                                            fishWeight='".$this->fishWeight."',
                                            growthRate='".$this->growthRate."',
                                            dateAdded='".$this->dateAdded."'
                                        WHERE
                                            fishID='".$this->fishID."'";
                
                                // prepare query
                                $stmt = $this->conn->prepare($query);
                                // execute query
                                if ($stmt->execute()) {
                            
                                    $updateQuery2 = "UPDATE marinelifedata
                                    SET TotalFishWeight = (
                                    SELECT SUM(fishWeight) 
                                    FROM salmon) 
                                    WHERE AllocatedTankNo = 'C';";
                                    $stmt2 = $this->conn->prepare($updateQuery2);
                                    $stmt2->execute();
                            
                                    $updateQuery3 = "UPDATE marinelifedata
                                    SET LastDateAdded = '".$this->dateAdded."'
                                    WHERE AllocatedTankNo = 'C';";
                                    $stmt3 = $this->conn->prepare($updateQuery3);
                                    $stmt3->execute();
                            
                                    $updateQuery4 = "UPDATE marinelifedata
                                    SET AverageFishWeight = 
                                    (SELECT AVG(fishWeight) 
                                    FROM salmon) 
                                    WHERE AllocatedTankNo = 'C';";
                                    $stmt4 = $this->conn->prepare($updateQuery4);
                                    $stmt4->execute();
                            
                                    $updateQuery5 = "UPDATE marinelifedata
                                    SET AverageFishLength = 
                                    (SELECT AVG(fishLength) 
                                    FROM salmon) 
                                    WHERE AllocatedTankNo = 'C';";
                                    $stmt5 = $this->conn->prepare($updateQuery5);
                                    $stmt5->execute();
                            
                                    return true;
                                }
                            
                                return false;
                            }
        





                            function createFishD() {
                                if ($this->isAlreadyExist()) {
                                    return false;
                                }
                            
                                // query to insert record
                                $query = "INSERT INTO trout (tankNo, fishID, fishLength, fishWeight, growthRate, dateAdded)
                                VALUES ('".$this->tankNo."', '".$this->fishID."','".$this->fishLength."',
                                '".$this->fishWeight."','".$this->growthRate."','".$this->dateAdded."'); ";
                            
                                // prepare query
                                $stmt = $this->conn->prepare($query);
                            
                                // execute query
                                if ($stmt->execute()) {
                                    $this->id = $this->conn->lastInsertId();
                            
                                    // Update marinelifedata
                                    $updateQuery1 = "UPDATE marinelifedata
                                    SET quantity = quantity + 1
                                    WHERE AllocatedTankNo = 'D';";
                                    $stmt1 = $this->conn->prepare($updateQuery1);
                                    $stmt1->execute();
                            
                                    $updateQuery2 = "UPDATE marinelifedata
                                    SET TotalFishWeight = TotalFishWeight  + '".$this->fishWeight."'
                                    WHERE AllocatedTankNo = 'D';";
                                    $stmt2 = $this->conn->prepare($updateQuery2);
                                    $stmt2->execute();
                            
                                    $updateQuery3 = "UPDATE marinelifedata
                                    SET LastDateAdded = '".$this->dateAdded."'
                                    WHERE AllocatedTankNo = 'D';";
                                    $stmt3 = $this->conn->prepare($updateQuery3);
                                    $stmt3->execute();
                            
                                    $updateQuery4 = "UPDATE marinelifedata
                                    SET AverageFishWeight = 
                                    (SELECT AVG(fishWeight) 
                                    FROM trout) 
                                    WHERE AllocatedTankNo = 'D';";
                                    $stmt4 = $this->conn->prepare($updateQuery4);
                                    $stmt4->execute();
                            
                                    $updateQuery5 = "UPDATE marinelifedata
                                    SET AverageFishLength = 
                                    (SELECT AVG(fishLength) 
                                    FROM trout) 
                                    WHERE AllocatedTankNo = 'D';";
                                    $stmt5 = $this->conn->prepare($updateQuery5);
                                    $stmt5->execute();
                            
                                    return true;
                                }
                            
                                return false;
                            }
                            
                        
                                    // update fish
                                    function updateFishD() {
                                        // query to update record in trout table
                                        $troutQuery = "UPDATE trout
                                                        SET
                                                            fishLength='".$this->fishLength."',
                                                            fishWeight='".$this->fishWeight."',
                                                            growthRate='".$this->growthRate."',
                                                            dateAdded='".$this->dateAdded."'
                                                        WHERE
                                                            fishID='".$this->fishID."'";
                                        
                                        // prepare and execute the query for trout table
                                        $stmt = $this->conn->prepare($troutQuery);
                                        if ($stmt->execute()) {
                                            // update marinelifedata table
                                            $updateQuery2 = "UPDATE marinelifedata
                                                            SET TotalFishWeight = (
                                                            SELECT SUM(fishWeight) 
                                                            FROM trout) 
                                                            WHERE AllocatedTankNo = 'D';";
                                            $stmt2 = $this->conn->prepare($updateQuery2);
                                            $stmt2->execute();
                                            
                                            $updateQuery3 = "UPDATE marinelifedata
                                                            SET LastDateAdded = '".$this->dateAdded."'
                                                            WHERE AllocatedTankNo = 'D';";
                                            $stmt3 = $this->conn->prepare($updateQuery3);
                                            $stmt3->execute();
                                            
                                            $updateQuery4 = "UPDATE marinelifedata
                                                            SET AverageFishWeight = 
                                                            (SELECT AVG(fishWeight) 
                                                            FROM trout) 
                                                            WHERE AllocatedTankNo = 'D';";
                                            $stmt4 = $this->conn->prepare($updateQuery4);
                                            $stmt4->execute();
                                            
                                            $updateQuery5 = "UPDATE marinelifedata
                                                            SET AverageFishLength = 
                                                            (SELECT AVG(fishLength) 
                                                            FROM trout) 
                                                            WHERE AllocatedTankNo = 'D';";
                                            $stmt5 = $this->conn->prepare($updateQuery5);
                                            $stmt5->execute();
                                            
                                            return true;
                                        }
                                        
                                        return false;
                                    }
                                    



                                    function createFishE() {
                                        if ($this->isAlreadyExist()) {
                                            return false;
                                        }
                                    
                                        // query to insert record
                                        $query = "INSERT INTO tuna (tankNo, fishID, fishLength, fishWeight, growthRate, dateAdded)
                                        VALUES ('".$this->tankNo."', '".$this->fishID."','".$this->fishLength."',
                                        '".$this->fishWeight."','".$this->growthRate."','".$this->dateAdded."'); ";
                                    
                                        // prepare query
                                        $stmt = $this->conn->prepare($query);
                                    
                                        // execute query
                                        if ($stmt->execute()) {
                                            $this->id = $this->conn->lastInsertId();
                                    
                                            // Update marinelifedata
                                            $updateQuery1 = "UPDATE marinelifedata
                                            SET quantity = quantity + 1
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt1 = $this->conn->prepare($updateQuery1);
                                            $stmt1->execute();
                                    
                                            $updateQuery2 = "UPDATE marinelifedata
                                            SET TotalFishWeight = TotalFishWeight  + '".$this->fishWeight."'
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt2 = $this->conn->prepare($updateQuery2);
                                            $stmt2->execute();
                                    
                                            $updateQuery3 = "UPDATE marinelifedata
                                            SET LastDateAdded = '".$this->dateAdded."'
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt3 = $this->conn->prepare($updateQuery3);
                                            $stmt3->execute();
                                    
                                            $updateQuery4 = "UPDATE marinelifedata
                                            SET AverageFishWeight = 
                                            (SELECT AVG(fishWeight) 
                                            FROM tuna) 
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt4 = $this->conn->prepare($updateQuery4);
                                            $stmt4->execute();
                                    
                                            $updateQuery5 = "UPDATE marinelifedata
                                            SET AverageFishLength = 
                                            (SELECT AVG(fishLength) 
                                            FROM tuna) 
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt5 = $this->conn->prepare($updateQuery5);
                                            $stmt5->execute();
                                    
                                            return true;
                                        }
                                    
                                        return false;
                                    }
                                    
                                
                                            // update fish
                                            function updateFishE() {
                                                // query to update record
                                                $query = "UPDATE tuna
                                                        SET
                                                            fishLength='".$this->fishLength."',
                                                            fishWeight='".$this->fishWeight."',
                                                            growthRate='".$this->growthRate."',
                                                            dateAdded='".$this->dateAdded."'
                                                        WHERE
                                                            fishID='".$this->fishID."'";
                                
                                                // prepare query
                                                $stmt = $this->conn->prepare($query);


                                                // execute query
                                               if ($stmt->execute()) {
                            
                                                $updateQuery2 = "UPDATE marinelifedata
                                                SET TotalFishWeight = (
                                                SELECT SUM(fishWeight) 
                                                FROM tuna) 
                                                WHERE AllocatedTankNo = 'E';";
                                                $stmt2 = $this->conn->prepare($updateQuery2);
                                                $stmt2->execute();
                                    
                                            $updateQuery3 = "UPDATE marinelifedata
                                            SET LastDateAdded = '".$this->dateAdded."'
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt3 = $this->conn->prepare($updateQuery3);
                                            $stmt3->execute();
                                    
                                            $updateQuery4 = "UPDATE marinelifedata
                                            SET AverageFishWeight = 
                                            (SELECT AVG(fishWeight) 
                                            FROM tuna) 
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt4 = $this->conn->prepare($updateQuery4);
                                            $stmt4->execute();
                                    
                                            $updateQuery5 = "UPDATE marinelifedata
                                            SET AverageFishLength = 
                                            (SELECT AVG(fishLength) 
                                            FROM tuna) 
                                            WHERE AllocatedTankNo = 'E';";
                                            $stmt5 = $this->conn->prepare($updateQuery5);
                                            $stmt5->execute();
                                    
                                            return true;
                                        }
                                    
                                        return false;
                                            }
        



    // delete doctor
    function delete(){

        // query to insert record
        $query = "

        DELETE FROM CHOOSEANS WHERE tankNo = '".$this->tankNo."';
        DELETE FROM ANSWERS WHERE tankNo = '".$this->tankNo."';
        DELETE FROM ".$this->table_name." WHERE tankNo= '".$this->tankNo."'";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM tilapia WHERE
                fishID='".$this->fishID."'";

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