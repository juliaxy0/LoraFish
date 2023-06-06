<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/sensorData.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare sensor object
$sensor = new Sensor($db);

// query function
$stmt = $sensor->sensorMain();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    // doctors array
    $sensor_arr=array();
    $sensor_arr["sensor"]=array();

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($qrow);
        $sensor_item=array(
            "tankNo" => $tankNo,
            "sensorID" => $sensorID,
            "dateAdded" => $dateAdded,
            "status" => $status,
            "sensorType" => $sensorType,
            "sensorInput" => $sensorInput,
            "inputUnit" => $inputUnit,
            "lastServiced" => $lastServiced,
        );
        array_push($sensor_arr["sensor"], $sensor_item);
    }

    echo json_encode($sensor_arr["sensor"]);
}
else{
    echo json_encode(array());
}
?>