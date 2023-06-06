<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare sensor object
$cart = new Product($db);

// query function
$stmt = $cart->totalDisplay();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // doctors array
    $cart_arr=array();
    $cart_arr["total"]=array();

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($qrow);
    
        $cart_item = array(
            "total_price" => $total_price,

          
        );
        array_push($cart_arr["total"], $cart_item);
    }

    echo json_encode($cart_arr["total"]);
}
else{
    echo json_encode(array());
}
?>