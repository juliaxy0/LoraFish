<?php

// include database and object files
include_once '../config/database.php';
include_once '../objects/product.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare sensor object
$product = new Product($db);

// query function
$stmt = $product->displayProduct();
$num = $stmt->rowCount();
// check if more than 0 record found
if($num>0){
    // doctors array
    $product_arr=array();
    $product_arr["product"]=array();

    while ($qrow = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($qrow);

        // Extract and encode the "picture" column
    $encodedPicture = base64_encode($picture);

        $product_item=array(
            "itemID" => $itemID,
            "picture" => $encodedPicture,
            "itemName" => $itemName,
            "price" => $price,
        );
        array_push($product_arr["product"], $product_item);
    }

    echo json_encode($product_arr["product"]);
}
else{
    echo json_encode(array());
}
?>