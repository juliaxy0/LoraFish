<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/tilapiafish.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare fish object
$fish = new Fish($db); //create object from tilapiafish.php



// query function
$stmt = $fish->getTunaData();

$num = $stmt->rowCount();

// check if more than 0 record found


if($num>0){
    // doctors array
    $tilapia=array();
    $tilapia["fish"]=array();

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($qrow);
        $fish_item=array(
        "tankNo" => $tankNo,
        "fishID" => $fishID,
        "fishLength" => $fishLength,
        "fishWeight" => $fishWeight,
        "growthRate" => $growthRate,
        "dateAdded" => $dateAdded,
        );
        array_push($tilapia["fish"], $fish_item);
    }
    echo json_encode($tilapia["fish"]);
}
else{
    echo json_encode(array());
}


?>