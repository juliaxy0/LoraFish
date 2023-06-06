
<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/addtilapiafish.php';
include_once '../objects/marinelifequery.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$fish2 = new Fish($db); //create object from marinelifequery.php

$stmt = $fish2->getfishintankE();
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
$salmon = new TilapiaFish($db);

// set doctor property values
$salmon->tankNo = $_POST['tankNo'];
$salmon->fishID = $quantity;
$salmon->fishLength = $_POST['fishLength'];
$salmon->fishWeight = $_POST['fishWeight'];
$salmon->growthRate = $_POST['growthRate'];
$salmon->dateAdded = $_POST['dateAdded'];

// create the doctor
if($salmon->createFishE()){
    $salmon_arr=array(
        "status" => true,
        "message" => "Successfully Added!",
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
        "message" => "Salmon Fish already exists!"
    );
}
print_r(json_encode($salmon_arr));

?>