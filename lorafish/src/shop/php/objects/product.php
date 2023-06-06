<?php
class Product{

    // database connection and table name
    public $conn;
    private $table_name = "product";
    private $table_name2 = "cart";
    

    // object properties
    public $itemID;
    public $itemName;
    public $price;
    public $picture;
    public $description;
    public $review;
    public $quantity;


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    // display product
    function displayProduct(){

        // select all query
        $query = "SELECT itemID, picture, itemName, ROUND(price, 2) AS price FROM product;";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

        // display cart product
        function cartDisplay(){

            // select all query
            $query = "SELECT p.itemID, p.picture, p.itemName, ROUND(p.price, 2) AS price , c.quantity, ROUND((p.price * c.quantity), 2) AS  total FROM product p JOIN cart c ON p.itemID = c.itemID;";
            $query1= "SELECT SUM(ROUND((p.price * c.quantity), 2)) AS total_price FROM product p JOIN cart c ON p.itemID = c.itemID;";
    
            // prepare query statement
            $stmt = $this->conn->prepare($query);
            $stmt1 = $this->conn->prepare($query1);
    
            // execute query
            $stmt->execute();
    
            return $stmt;
        }
        // display cart product
        function totalDisplay(){

            // select all query
           
            $query= "SELECT SUM(ROUND((p.price * c.quantity), 2)) AS total_price FROM product p JOIN cart c ON p.itemID = c.itemID;";
    
            // prepare query statement
            $stmt = $this->conn->prepare($query);
          
    
            // execute query
            $stmt->execute();
    
            return $stmt;
        }

    // get single product
    function read_single(){

        // select all query
        $query = "SELECT
                    'itemName', 'price', 'description', 'review'  
                FROM
                    product 
                WHERE
                    itemID= '".$this->itemID."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();
        return $stmt;
    }

    // insert cart
    function create(){

        if($this->isAlreadyExist()){
            return false;
        }

        // query to insert record
        $query = "INSERT INTO  cart (itemID, quantity)
                  VALUES
                        ('".$this->existingItemID."', '".$this->existingQuantity."')";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

        // insert product history
        function addProduct(){

            if($this->isAlreadyExist()){
                return alert("Product already in the cart");
            }
    
            // query to insert record
            $query = "INSERT INTO  analysecost (ItemID, ItemName, UnitPrice, Quantity, TankNo, SupplierID)
                      VALUES
                            ('".$this->existingItemID."','".$this->existingItemName."','".$this->existingPrice."', '".$this->existingQuantity."', 'A', '1001')";
    
            // prepare query
            $stmt = $this->conn->prepare($query);
    
            // execute query
            if($stmt->execute()){
                return true;
            }
            return false;
        }

    // update cart
    function update(){

        // query to insert record
        $query = "UPDATE
                    cart
                SET
                    quantity='".$this->existingQuantity."'
                WHERE
                    itemID='".$this->existingItemID."'";

        // prepare query
        $stmt = $this->conn->prepare($query);
        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // delete cart
    function delete(){

        // query to insert record
        $query = "DELETE FROM
                    cart
                WHERE
                    itemID= '".$this->itemID."'";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        if($stmt->execute()){
            return true;
        }
        return false;
    }

    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                cart
            WHERE
                itemID='".$this->existingItemID."'";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        if($stmt->rowCount() > 0){
            return true;
        }
        else{
            return false;
        }
    }
}