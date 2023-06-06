<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/addtilapiafish.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$catfish = new TilapiaFish($db);

// tilapia
$catfish->tankNo = $_POST['tankNo'];
$catfish->fishID = $_POST['fishID'];
$catfish->fishLength = $_POST['fishLength'];
$catfish->fishWeight = $_POST['fishWeight'];
$catfish->growthRate = $_POST['growthRate'];
$catfish->dateAdded = $_POST['dateAdded'];

// create the doctor
if($catfish->updateFishB()){
    $catfish_arr=array(
        "status" => true,
        "message" => "Successfully Updated!",
        "tankNo" => $catfish->tankNo,
        "fishID" => $catfish->fishID,
        "fishLength" => $catfish->fishLength,
        "fishWeight" => $catfish->fishWeight,
        "growthRate" => $catfish->growthRate,
        "dateAdded" => $catfish->dateAdded,
    );
}
else{
    $catfish_arr=array(
        "status" => false,
        "message" => "Fish already exists!"
    );
}
print_r(json_encode($catfish_arr));


