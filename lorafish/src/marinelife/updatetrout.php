<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/addtilapiafish.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$trout = new TilapiaFish($db);

// tilapia
$trout->tankNo = $_POST['tankNo'];
$trout->fishID = $_POST['fishID'];
$trout->fishLength = $_POST['fishLength'];
$trout->fishWeight = $_POST['fishWeight'];
$trout->growthRate = $_POST['growthRate'];
$trout->dateAdded = $_POST['dateAdded'];

// create the doctor
if($trout->updateFishD()){
    $trout_arr=array(
        "status" => true,
        "message" => "Successfully Updated!",
        "tankNo" => $trout->tankNo,
        "fishID" => $trout->fishID,
        "fishLength" => $trout->fishLength,
        "fishWeight" => $trout->fishWeight,
        "growthRate" => $trout->growthRate,
        "dateAdded" => $trout->dateAdded,
    );
}
else{
    $trout_arr=array(
        "status" => false,
        "message" => "Fish already exists!"
    );
}
print_r(json_encode($trout_arr));


