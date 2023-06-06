
<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/addtilapiafish.php';
include_once '../objects/marinelifequery.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$fish2 = new Fish($db); //create object from marinelifequery.php

$stmt = $fish2->getfishintankB();
$num = $stmt->rowCount();


// check if more than 0 record found
if($num>0){
    // doctors array

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($qrow);
        $updatedQuantity = $Quantity + 1; // Add 1 to the current Quantity
        $quantity = 'F_S' . $updatedQuantity;
    }
    echo json_encode($quantity);
}
else{
    echo json_encode(array());
}


// prepare doctor object
$tilapia = new TilapiaFish($db);

// set doctor property values
$tilapia->tankNo = $_POST['tankNo'];
$tilapia->fishID = $quantity;
$tilapia->fishLength = $_POST['fishLength'];
$tilapia->fishWeight = $_POST['fishWeight'];
$tilapia->growthRate = $_POST['growthRate'];
$tilapia->dateAdded = $_POST['dateAdded'];

// create the doctor
if($tilapia->createFishB()){
    $tilapia_arr=array(
        "status" => true,
        "message" => "Successfully Added!",
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
        "message" => "Tilapia already exists!"
    );
}
print_r(json_encode($tilapia_arr));

?>