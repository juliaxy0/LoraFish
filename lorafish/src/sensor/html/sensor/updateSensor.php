<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/sensorData.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare sensor object
$sensor = new Sensor($db);

// set doctor property values
$sensor->existingSensorID = $_POST['existingSensorID'];
$sensor->existingTankNo = $_POST['existingTankNo'];
$sensor->existingStatus = $_POST['existingStatus'];
$sensor->existingSensorType = $_POST['existingSensorType'];
$sensor->existingSensorInput = $_POST['existingSensorInput'];
$sensor->existingInputUnit = $_POST['existingInputUnit'];
$sensor->existingLastServiced = $_POST['existingLastServiced'];

// create the doctor
if($sensor->updateSensor()){
    $sensor_arr=array(
        "status" => true,
        "message" => "Successfully updated!",
        "existingSensorID" => $sensor->existingSensorID,
        "existingTankNo" => $sensor->existingTankNo,
        "existingStatus" => $sensor->existingStatus,
        "existingSensorType" => $sensor->existingSensorType,
        "existingSensorInput" => $sensor->existingSensorInput,
        "existingInputUnit" => $sensor->existingInputUnit,
        "existingLastServiced" => $sensor->existingLastServiced,
    );
}
else{
    $sensor_arr=array(
        "status" => false,
        "message" => "Sensor already exist",
    );
}
print_r(json_encode($sensor_arr));

?>