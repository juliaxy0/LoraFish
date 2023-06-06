<?php
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
   <!-- delete Sensor -->
        <div class="modal fade" id="deleteCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Deletion Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Permanently delete <span id="itemID"></span>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="deleteExistingCart">Confirm</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>

      <!--edit cart in the modal-->
 <div class="modal fade" id="editCart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="editCartForm">
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
              <button type="button" class="btn btn-primary" id="addNewProduct">Submit</button>
            </div>
          </div>
        </div>
      </div>
    
<!-- cart -->
<div class="card" style="padding-top: 50px">
    <div class="card-body">
        <div class="row">
            <h1 style="text-align: center">Shopping Cart</h1>
            <div class="col-md-18">
                <div class="card">

                    <table class="table table-hover" id="cartDisplay" >
                        <thead>
                            <tr>
                                <th >Item ID</th>
                                <th >Item Image</th>
                                <th >Item Name</th>
                                <th >Price</th>
                                <th >Quantity</th>
                                <th >Total</th>
                                <th> Remarks</th>
                            </tr>
                        </thead>
                        <tbody >
                        <tr  >
                        </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-8" style="position: relative" >
                <div class="card" style="position: relative" >
                    <table class="table table-hover" id="totalDisplay">
                        <thead>
                            <tr>
                                <th>Total</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                                <td><strong>Subtotal: </strong></td>
                                <td>$500</td>
                            </tr>
                            <tr>
                                <td><strong>Shipping: </strong></td>
                                <td>$45</td>
                            </tr>
                            <tr >
                                <td><strong>Total: </strong></td>
                                <td  >$545</td>
                            </tr> -->
                        </tbody>
                    </table>
                    <div style="padding-bottom: 50px">
                        
                        <button class="btn btn-primary" style="background-color: green; position: absolute; right: 10px" id="addAllCart" >Check Out</button>
                    </div>
                </div>

                
            </div>
        </div>
    </div>
</div>
<!-- end cart -->

    </div>
  </div>
  
</body>

</html>

<script>
  // reading data using json
  //product cart list
  $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "../php/product/cartDisplay.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
            
               for (var i in data) {
                  response +=
                  "<tr>"+
                  
                    "<td >"+ data[i].itemID+"</td>"+
                                "<td><img src='data:image/png;base64," + data[i].picture + "' class='card-img-top' style=\"height: 120px; width: 120px\" alt='...'></td>"+
                                "<td >"+data[i].itemName+"</td>"+
                                "<td>"+data[i].price+"</td>"+
                                "<td>"+data[i].quantity+"</td>"+
                                "<td>"+data[i].total+"</td>"+
                                "<td><button class='btn btn-danger btn-sm m-2' type='button' data-toggle='modal' data-target='#deleteCart' data-cartid='"+data[i].itemID+"'><i class='ti-trash'></i></button>"+
                                "<button class='btn btn-sm m-2' style='background-color: orange' type='button' data-toggle='modal' data-target='#editCart' data-cartid='"+data[i].itemID+"'  data-itemname='"+data[i].itemName+"' data-price='"+data[i].price+"' data-quantity='"+data[i].quantity+"' ><i class='ti-pencil'></i></button></td>";
               
                    "</tr>";
              }
            //   $("#cartDisplay").append(response);
              
           
            $(response).appendTo($("#cartDisplay"));
        
              
          },
          error: function() {
              var defaultResponse = "<tr><td >Tak Keluar!!!</td></tr>";
              $(defaultResponse).appendTo($("#cartDisplay"));
          }
      });
  });

    //display total
    $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "../php/product/totalDisplay.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
              for (var i in data) {
                var subtotal = parseFloat(data[i].total_price);
                var shipping = 8.00;
                var total = subtotal + shipping;
                  response +=
                  "<tr>"+
              "<td><strong>Subtotal: </strong></td>"+
              "<td>RM"+subtotal.toFixed(2) +"</td>"+
              "</tr>"+
              "<tr>"+
              "<td><strong>Shipping: </strong></td>"+
              "<td>RM " + shipping.toFixed(2) + "</td>"+
              "</tr>"+
              "<tr >"+
              "<td><strong>Total: </strong></td>"+
              "<td>RM " + total.toFixed(2) + "</td>"+
              "</tr>";
              }
              
    
            $(response).appendTo($("#totalDisplay"));
              
          },
          error: function() {
              var defaultResponse = "<tr><td >Tak Keluar!!!</td></tr>";
              $(defaultResponse).appendTo($("#totalDisplay"));
          }
      });
  });

  //carry itemID delete
  $(document).ready(function() {
      $('#deleteCart').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var itemID = button.data('cartid'); // Extract the value from the data-value attribute
        var modal = $(this);
        modal.find('#itemID').text(itemID); // Set the value in the modal body
      });
    });

    //delete sensor
    $(document).ready(function() {
      // Define the click event for the Add Sensor button
      $('#deleteExistingCart').click(function() {
        // Get the itemID value from the modal
        var itemID = $('#itemID').text();

        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: "../php/product/deleteCart.php",
          dataType: 'json',
          data: {
            itemID: itemID,
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully deleted!");
              window.location.href = '../php/cart.php?name=<?php echo $_GET['name'] ?>';
            } else {
              alert(result['message']);
            }
          }
        });
      });
    });

    //carry itemID add
  $(document).ready(function() {
      $('#editCart').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var existingItemID = button.data('cartid'); // Extract the value from the data-itemid attribute
        var existingItemName = button.data('itemname');
        var existingPrice = button.data('price');
        var existingQuantity = button.data('quantity');
        var modal = $(this);
        modal.find('#existingItemID').val(existingItemID);
        modal.find('#existingItemName').val(existingItemName);
        modal.find('#existingPrice').val(existingPrice);
        modal.find('#existingQuantity').val(existingQuantity);
        
      });
    });

     //edit sensor
   $(document).ready(function() {
    // Define the click event for the Add Sensor button
    $('#addNewProduct').click(function() {
      // Validate the form before submitting
      if ($('#editCartForm')[0].checkValidity()) {
        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: "../php/product/updateCart.php",
          dataType: 'json',
          data: {
            existingItemID: $("#existingItemID").val(),
            existingItemName: $("#existingItemName").val(),
            existingPrice: $("#existingPrice").val(),
            existingQuantity: $("#existingQuantity").val()
           
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully Update Cart!");
              window.location.href = '../php/cart.php?name=<?php echo $_GET['name'] ?>';
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

//add new Product in analyseCost table
  $(document).ready(function() {
    // Define the click event for the Add Sensor button
    $('#addAllCart').click(function() {
      // Validate the form before submitting

        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: "../php/product/addProduct.php",
          dataType: 'json',
          data: {
            existingItemID: $("#existingItemID").val(),
            existingItemName: $("#existingItemName").val(),
            existingPrice: $("#existingPrice").val(),
            existingQuantity: $("#existingQuantity").val()
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully Added New Product Record!");
              window.location.href = '../php/payment.php?name=<?php echo $_GET['name'] ?>';
            } else {
              alert(result['message']);
            }
          }
        });
  
    });
  });
        
</script>



