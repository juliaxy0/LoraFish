<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/addtilapiafish.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$salmon = new TilapiaFish($db);

// tilapia
$salmon->tankNo = $_POST['tankNo'];
$salmon->fishID = $_POST['fishID'];
$salmon->fishLength = $_POST['fishLength'];
$salmon->fishWeight = $_POST['fishWeight'];
$salmon->growthRate = $_POST['growthRate'];
$salmon->dateAdded = $_POST['dateAdded'];

// create the doctor
if($salmon->updateFishC()){
    $salmon_arr=array(
        "status" => true,
        "message" => "Successfully Updated!",
        "tankNo" => $salmon->tankNo,
        "fishID" => $salmon->fishID,
        "fishLength" => $salmon->fishLength,
        "fishWeight" => $salmon->fishWeight,
        "growthRate" => $salmon->growthRate,
        "dateAdded" => $salmon->dateAdded,
    );
}
else{
    $salmon_arr=array(
        "status" => false,
        "message" => "Fish already exists!"
    );
}
print_r(json_encode($salmon_arr));


