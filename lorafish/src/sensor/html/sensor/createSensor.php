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
$sensor->newSensorID = $_POST['newSensorID'];
$sensor->newDateAdded = $_POST['newDateAdded'];
$sensor->newStatus = $_POST['newStatus'];
$sensor->newTankNo = $_POST['newTankNo'];
$sensor->newSensorType = $_POST['newSensorType'];
$sensor->newSensorInput = $_POST['newSensorInput'];
$sensor->newInputUnit = $_POST['newInputUnit'];
$sensor->newLastServiced = $_POST['newLastServiced'];

// create the doctor
if($sensor->createSensor()){
    $sensor_arr=array(
        "status" => true,
        "message" => "Successfully Added!",
        "newSensorID" => $sensor->newSensorID,
        "newDateAdded" => $sensor->newDateAdded,
        "newStatus" => $sensor->newStatus,
        "newTankNo" => $sensor->newTankNo,
        "newSensorType" => $sensor->newSensorType,
        "newSensorInput" => $sensor->newSensorInput,
        "newInputUnit" => $sensor->newInputUnit,
        "newLastServiced" => $sensor->newLastServiced,
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