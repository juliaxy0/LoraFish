<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare sensor object
$cart = new Product($db);

// set doctor property values
$cart->existingItemID = $_POST['existingItemID'];
// $cart->existingPicture = $_POST['existingPicture'];
// $cart->existingItemName = $_POST['existingItemName'];
// $cart->existingPrice = $_POST['existingPrice'];
$cart->existingQuantity = $_POST['existingQuantity'];

// create the doctor
if($cart->update()){
    $cart_arr=array(
        "status" => true,
        "message" => "Successfully updated!",
        "existingItemID" => $cart->existingItemID,
        // "existingItemName" => $cart->existingItemName,
        // "existingPrice" => $cart->existingPrice,
        "existingQuantity" => $cart->existingQuantity,

    );
}
else{
    $cart_arr=array(
        "status" => false,
        "message" => "Cart already exist",
    );
}
print_r(json_encode($cart_arr));

?>