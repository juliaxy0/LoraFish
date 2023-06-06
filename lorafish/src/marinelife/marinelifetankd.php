<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/marinelifequery.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare fish object
$fish = new Fish($db); //create object from marinelifequery.php
$stmt = $fish->getfishintankD();
$num = $stmt->rowCount();


if($num>0){
    // doctors array
    $avgfishweight=array();
    $avgfishweight["fish"]=array();

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($qrow);
        $fish_item=array(
        "AllocatedTankNo" => $AllocatedTankNo,
        "AverageFishWeight" => $AverageFishWeight,
        "FishID" => $FishID,
        "FishType" => $FishType,
        "AverageFishLength" => $AverageFishLength,
        "AverageFishWeight" => $AverageFishWeight,
        "TotalFishWeight" => $TotalFishWeight,
        "Quantity" => $Quantity,
        "LastDateAdded" => $LastDateAdded,
        );
        array_push($avgfishweight["fish"], $fish_item);
    }
    echo json_encode($avgfishweight["fish"]);
}
else{
    echo json_encode(array());
}




?>