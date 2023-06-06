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
$cart->existingItemName = $_POST['existingItemName'];
$cart->existingPrice = $_POST['existingPrice'];
$cart->existingQuantity = $_POST['existingQuantity'];

// create the doctor
if($cart->addProduct()){
    $cart_arr=array(
        "status" => true,
        "message" => "Successfully Added!",
        "existingItemID" => $cart->existingItemID,
        "existingItemName" => $cart->existingItemName,
        "existingPrice" => $cart->existingPrice,
        "existingQuantity" => $cart->existingQuantity
       
    );
}
else{
    $cart_arr=array(
        "status" => false,
        "message" => "Product already exists!"
    );
}
print_r(json_encode($cart_arr));
?>
