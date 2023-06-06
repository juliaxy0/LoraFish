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
$stmt = $cart->cartDisplay();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
    // doctors array
    $product_arr=array();
    $product_arr["cart"]=array();

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($qrow);
    
        // Extract and encode the "picture" column
        $encodedPicture = base64_encode($picture);
    
        $product_item = array(
            "itemID" => $itemID,
            "picture" => $encodedPicture,
            "itemName" => $itemName,
            "price" => $price,
            "quantity" => $quantity,
            "total" => $total,
          
        );
        array_push($product_arr["cart"], $product_item);
    }

    echo json_encode($product_arr["cart"]);
}
else{
    echo json_encode(array());
}

?>