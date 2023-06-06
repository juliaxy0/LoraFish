<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare doctor object
$cart = new Product($db);

// set doctor property values
$cart->itemID = $_POST['itemID'];

// remove the doctor
if($cart->delete()){
    $cart_arr=array(
        "status" => true,
        "message" => "Successfully Removed!"
    );
}
else{
    $cart_arr=array(
        "status" => false,
        "message" => "Cart Cannot be deleted!"
    );
}
print_r(json_encode($cart_arr));
?>
