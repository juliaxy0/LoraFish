<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/sensorData.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$sensor = new Sensor($db);

// set doctor property values
$sensor->existingSensorID = $_POST['existingSensorID'];

// remove the doctor
if($sensor->deleteSensor()){
    $sensor_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $sensor_arr=array(
        "status" => false,
        "message" => "Sensor Cannot be deleted!"
    );
}
print_r(json_encode($sensor_arr));
?>