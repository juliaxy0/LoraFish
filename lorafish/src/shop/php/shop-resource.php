<?php

// session_start();

// // Check if the session variable is not set or empty
// if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
//     // Redirect to the logout page or any other desired page
//     header("Location: ../../src/login/src/html/logout.php");
//     exit();
// } 

require_once './config/pdo.php';
$_GET['name'] = 'itemID';

 ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LoRaFish</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/lorafish.png" />

</head>

<body>
 <?php
 include_once 'template.php';
 ?>
 <!--add product to cart modal-->
 <div class="modal fade" id="addNewCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="addCartForm">
                <div class="form-group">
                  <label for="itemID" class="col-form-label">Item ID:</label>
                  <input type="text" class="form-control" id="existingItemID" name="itemID" readonly>

                <div class="form-group">
                <label for="itemName" class="col-form-label">Item Name:</label>
                  <input type="text" class="form-control" id="existingItemName" name="itemName" readonly>
                </div>
                </div>
                <div class="form-group">
                <label for="price" class="col-form-label">Price:</label>
                  <input type="text" class="form-control" id="existingPrice" name="price" readonly>
                </div>
                <div class="form-group">
  <label for="quantity" class="col-form-label">Quantity:</label>
  <div class="input-group">
    <span class="input-group-btn">
      <!-- <button type="button" class="btn btn-secondary" onclick="decrementQuantity()">-</button> -->
    </span>
    <input type="number" class="form-control" id="existingQuantity" name="quantity" min="1" required>
    <span class="input-group-btn">
      <!-- <button type="button" class="btn btn-secondary" onclick="incrementQuantity()">+</button> -->
    </span>
  </div>
</div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="addNewProduct">Add To Cart</button>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid" >
        
        <div class="input-group rounded" style="padding-bottom: 20px">
          
          <div class="dropdown" style="padding-right: 20px;"> 
            <button style="background-color: #11999e"class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">All</a>
              <a class="dropdown-item" href="#">Chemical Substances</a>
              <a class="dropdown-item" href="#">Sensor</a>
            </div>
          </div>
          <input  type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
          <span class="input-group-text border-0" id="search-addon"   >
            <i class="ti-search fs-6"></i>
          </span>
        </div>
<!--Body content start-->
<main > 
<div class="card" >
<div class="card-body p-4"  >
<div class="row" id="display" >
</div>
</div>

</div>
    <!-- <div class="card">
      <div class="card-body p-4"  >
        <div class="row" >
          <div class="col-lg-3">
            <div class="card" id="display">
              <img  src="../assets/images/products/ammonia.jpg" class="card-img-top" alt="...">
              <div class="card-body" id="display">
                <h5 class="card-title">Ammonia Sulphate</h5>
                <p class="card-text">RM34.50</p>
                <a href="cart.php" class="btn btn-primary" style="background-color: #11999e; text-align: center;">Add To Cart</a>
                
              </div>
            </div>
          </div>
          
        </div>
      
      </div>
    </div> -->


          
         
        </div>
      </div>
      <!--Body content end-->
    </div>
  </div>


  </main>
</body>

</html>

<script>
  // reading data using json
  //read list of product
  $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "../php/product/displayProduct.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
              for (var i in data) {
                  response +=
          "<div class=\"col-lg-3\">"+
            "<div class=\"card\" >"+
            
            // "<a href=\"product-detail.php?itemID=" + data[i].itemID + "\">"+
            "<img src='data:image/png;base64," + data[i].picture + "' class='card-img-top' style=\"height: 300px\" alt='...'></a>" +
              "<div class=\"card-body\" id=\"display\">"+ 
              "<h5 class='card-title'>" + data[i].itemName + "</h5>" +
              "<p class='card-text'>RM " + data[i].price + "</p>" +
              "<button class='btn btn-success btn-sm m-2' style='background-color: #11999e' type='button' data-toggle='modal' data-target='#addNewCart' data-itemid='"+data[i].itemID+"'  data-itemname='"+data[i].itemName+"' data-price='"+data[i].price+"' >Add To Cart</button>"+
                // "<a href=\"cart.php\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#addNewProduct\" style=\"background-color: #11999e; text-align: center;\">Add To Cart</a>"+
                
              "</div>"+
            "</div>"+
          "</div>";
              }
              // $("#display").append(response);
              $(response).appendTo($("#display"));
          },
          error: function() {
              var defaultResponse = "<tr><td >Tak Keluar!!!</td></tr>";
              $(defaultResponse).appendTo($("#display"));
          }
      });
  });

  //carry itemID add
  $(document).ready(function() {
      $('#addNewCart').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var existingItemID = button.data('itemid'); // Extract the value from the data-itemid attribute
        var existingItemName = button.data('itemname');
        var existingPrice = button.data('price');
        // var existingQuantity = button.data('quantity');
        var modal = $(this);
        modal.find('#existingItemID').val(existingItemID);
        modal.find('#existingItemName').val(existingItemName);
        modal.find('#existingPrice').val(existingPrice);
        // modal.find('#existingQuantity').val(existingQuantity);
        
      });
    });

     //add new product to cart
  $(document).ready(function() {
    // Define the click event for the Add Sensor button
    $('#addNewProduct').click(function() {
      // Validate the form before submitting
      if ($('#addCartForm')[0].checkValidity()) {
        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: "../php/product/addCart.php",
          dataType: 'json',
          data: {
            existingItemID: $("#existingItemID").val(),
            existingQuantity: $("#existingQuantity").val()
            
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully Add To Cart!");
              window.location.href = '../php/shop-resource.php?name=<?php echo $_GET['name'] ?>';
            } else {
              alert(result['message']);
            }
          }
        });
      } else {
        // Display an error message or take any other action
        alert("Please fill in all required fields.");
      }
    });
  });


        
</script>