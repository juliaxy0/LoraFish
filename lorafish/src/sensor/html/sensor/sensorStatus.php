<?php

// Include database and object files
include_once '../config/database.php';
include_once '../objects/sensorData.php';

// Create a database instance
$database = new Database();
$db = $database->getConnection();

// Create a sensor instance
$sensor = new Sensor($db);

// Get sensor status data
$data = $sensor->sensorStatus();

// Prepare the response data
$response = array();

if ($data) {
    $response['activeSensors'] = $data['activeSensors'];
    $response['inactiveSensors'] = $data['inactiveSensors'];
} else {
    $response['activeSensors'] = 0;
    $response['inactiveSensors'] = 0;
}

// Set the response header as JSON
header('Content-Type: application/json');

// Return the response as JSON string
echo json_encode($response);
?>
