<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/addtilapiafish.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$tilapia = new TilapiaFish($db);

// tilapia
$tilapia->tankNo = $_POST['tankNo'];
$tilapia->fishID = $_POST['fishID'];
$tilapia->fishLength = $_POST['fishLength'];
$tilapia->fishWeight = $_POST['fishWeight'];
$tilapia->growthRate = $_POST['growthRate'];
$tilapia->dateAdded = $_POST['dateAdded'];

// create the doctor
if($tilapia->updateFishA()){
    $tilapia_arr=array(
        "status" => true,
        "message" => "Successfully Updated!",
        "tankNo" => $tilapia->tankNo,
        "fishID" => $tilapia->fishID,
        "fishLength" => $tilapia->fishLength,
        "fishWeight" => $tilapia->fishWeight,
        "growthRate" => $tilapia->growthRate,
        "dateAdded" => $tilapia->dateAdded,
    );
}
else{
    $tilapia_arr=array(
        "status" => false,
        "message" => "Fish already exists!"
    );
}
print_r(json_encode($tilapia_arr));


