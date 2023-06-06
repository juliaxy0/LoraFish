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
 
  <link rel="stylesheet" href="../assets/css/payment-style.css"/>
  
</head>

<body>
<?php
 include_once 'template.php';
 ?>
        
      
<!--Body content start-->

<div class="container" style="padding-top: 100px;">


    <form action="">
  
        <div class="row">
        <h1 style="text-align: center">Payment Info</h1>
            <div class="col">
       
                <h3 class="title">billing address</h3>

                <div class="inputBox">
    <span>full name :</span>
    <input type="text" placeholder="john deo" required>
</div>
<div class="inputBox">
    <span>email :</span>
    <input type="email" placeholder="example@example.com" required>
</div>
<div class="inputBox">
    <span>address :</span>
    <input type="text" placeholder="room - street - locality" required>
</div>
<div class="inputBox">
    <span>city :</span>
    <input type="text" placeholder="mumbai" required>
</div>

<div class="flex">
    <div class="inputBox">
        <span>state :</span>
        <input type="text" placeholder="india" required>
    </div>
    <div class="inputBox">
        <span>zip code :</span>
        <input type="text" placeholder="123 456" required>
    </div>
</div>

</div>

<div class="col">

    <h3 class="title">payment</h3>

    <div class="inputBox">
        <span>cards accepted :</span>
        <img src="../assets/images/logos/card.png" alt="">
    </div>
    <div class="inputBox">
        <span>name on card :</span>
        <input type="text" placeholder="mr. john deo" required>
    </div>
    <div class="inputBox">
        <span>credit card number :</span>
        <input type="number" placeholder="1111-2222-3333-4444" required>
    </div>
    <div class="inputBox">
        <span>exp month :</span>
        <input type="text" placeholder="january" required>
    </div>

    <div class="flex">
        <div class="inputBox">
            <span>exp year :</span>
            <input type="number" placeholder="2022" required>
        </div>
        <div class="inputBox">
            <span>CVV :</span>
            <input type="text" placeholder="1234" required>
        </div>
    </div>

</div>

</div>

<div style="text-align: center">
    <a href="shop-resource.php" class="btn btn-primary" style="background-color: #11999e;" onclick="submitForm(event)">Done</a>
</div>
    </form>

</div>  
      <!--Body content end-->
    </div>
  </div>
 

</body>

</html>

<script>
    function submitForm(event) {
        // Prevent the default form submission
        event.preventDefault();

        // Check if all the required fields are filled
        var forms = document.getElementsByTagName('input');
        var isFormValid = true;
        for (var i = 0; i < forms.length; i++) {
            if (forms[i].hasAttribute('required') && forms[i].value === '') {
                isFormValid = false;
                break;
            }
        }

        // Display alert and redirect if the form is valid
        if (isFormValid) {
            alert('Product successfully recorded!');
            window.location.href = 'shop-resource.php';
        } else {
            alert('Please fill in all the required fields.');
        }
    }
</script>

