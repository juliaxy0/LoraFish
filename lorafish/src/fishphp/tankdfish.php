<?php
session_start();

// Check if the session variable is not set or empty
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to the logout page or any other desired page
    header("Location: ../../src/login/src/html/logout.php");
    exit();
} 
require "./pdo.php";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Marine Life</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <link rel="stylesheet" type="text/css" href="styles2.css">
</head>
</head>
<style>

#myDIV {
    border:solid 1px #ffffff;
    display:none;
   }

  .align-right {
        text-align: right;
        border: 0;
      }


  button:focus {
    background-color: #020E5D;
    border: 2px solid black;
  }

  .fishcircle {
  height: 250px;
  width: 250px;
  background-color: #020E5D;
  border-radius: 50%;
  margin-top: 5%;
  margin-bottom: 5%;
  display: inline-block;
  }

  .avgweightcircle {
  height: 250px;
  width: 250px;
  border: 10px solid #919191;
  border-radius: 50%;
  margin-top: 5%;
  margin-bottom: 5%;
  display: inline-block;
  }
  

  hr.new1 {
  border: 1px solid #dadada;
  }

  </style>
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="../dashboard/dash.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/lorafish.jpg" width="180" alt="" />
          </a>
          <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
            <i class="ti ti-x fs-8"></i>
          </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
          <ul id="sidebarnav">
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Home</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../dashboard/dash.php" aria-expanded="false">
                <span>
                  <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
              </a>
            </li>
            <li class="nav-small-cap">
              <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
              <span class="hide-menu">Maintenance Work</span>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../sensor/html/manageSensor.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Sensor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./tankdfish.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Marine Life</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../watercond/html/watercond.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Water Condition</span>
              </a>
            </li>
            
            <li class="sidebar-item">
              <a class="sidebar-link" href="../alarm/displayalarm.php" aria-expanded="false"> <!-- tukar href -->
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Alarm</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../analysecost/html/analysecost.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Analyse Cost</span>
              </a>
            </li>
          
            <li class="sidebar-item">
              <a class="sidebar-link" href="../shop/php/shop-resource.php" aria-expanded="false">
                <span>
                  <i class="ti ti-aperture"></i>
                </span>
                <span class="hide-menu">Shop</span>
              </a>
            </li>
          </ul>
          
        <!-- End Sidebar navigation -->
      </div>
      <!-- End Sidebar scroll-->
    </aside>
    <!--  Sidebar End -->

    <?php


include_once "../config/database.php";
$db = new Database();                  
  $conn = $db->getConnection();

  $message = null;


  if (isset($_COOKIE['email'])) {
    $email = $_COOKIE['email'];



    $stmt = $conn->prepare("SELECT * FROM USERS1 WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $users1 = $stmt->fetchAll();

    foreach ($users1 as $users1);


    $message = $users1['name'];
  } else {
    echo "Cookie not found.";
  }




  ?>


    <!--  Main wrapper -->
    <div class="body-wrapper">
      <!--  Header Start -->
      <header class="app-header">
        <nav class="navbar navbar-expand-lg navbar-light">
          <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
              <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                <i class="ti ti-menu-2"></i>
              </a>
            </li>

          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
            <div style="padding: 20px;">
                <?php
                echo $message;
                ?>
              </div>




              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">
                <?php


                if (isset($_COOKIE['category'])) {
                  $category = $_COOKIE['category'];
                  echo "$category";
                } else {
                  echo "Cookie not found.";
                }




                ?>


              </a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                  <div class="message-body">
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-user fs-6"></i>
                      <p class="mb-0 fs-3">My Profile</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-mail fs-6"></i>
                      <p class="mb-0 fs-3">My Account</p>
                    </a>
                    <a href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                      <i class="ti ti-list-check fs-6"></i>
                      <p class="mb-0 fs-3">My Task</p>
                    </a>
                    <a href="../login/src/html/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
        <!--  Row 1 -->
        <div class="row">
          <div class="col d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-0 mb-sm-0">
                    <h5 class="card-title fw-semibold" style="color: black; font-size:23px;">LoraFish Aquatank</h5>
                  </div>
                </div>
                <div class="card">
                  <div class="card-body p-4">
                    <button type="button" id="tankAButton" data-tank="A" class="btn btn-primary m-2" style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px">Tank A</button>
                    <button type="button" data-tank="B" class="btn btn-primary m-2" 
                    id="tankBButton"style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px ">Tank B</button>'
                    <button type="button" data-tank="C" class="btn btn-primary m-2"
                    id="tankCButton"style=" font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px ">Tank C</button>'
                    <button type="button" data-tank="D" class="btn btn-primary m-2"
                    id="tankDButton"style="background-color: #020E5D; border: 2px solid black; font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px ">Tank D</button>'
                    <button type="button" data-tank="E" class="btn btn-primary m-2"
                    id="tankEButton"style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px ">Tank E</button>'
                  </div>
                </div>
              </div>
            </div> 
          </div>
        </div>
        <div class="mb- mb-sm-0">
          <h5 class="card-title fw-semibold" style="font-size:23px; color: black;  padding-left: 20px; padding-bottom: 10px;">Aquatank Marine Life Detail</h5>
        </div>
        <div class="row"> <!--Start Row-->
          <div style="width:40%"> <!--First Column-->
            <div class="card w-120" style="height:450px;">
              <div>
                <div id = "fishtype" style="font-size: 21px; padding-top:8%; text-align: center;" class="mb-3">
                 <!--BACK-END-->
                </div>
                <div class=" mb-0 position-relative mb-n5">
                <div style = "text-align: center;">
                <div id =fishquantity class ="fishcircle">
                
                  <!--BACK-END-->
                
                </div>
      
                </div>     
                </div>
              </div>
            </div>
          </div>
          <div style="width:30%"> <!--Second Column-->
            <div class="card w-120" style="height:450px;">
              <div class="card-body p-4">
                <div class="mb-3">
                  <h5 class="card-title fw-semibold" style="padding-top:3%; ">Average Fish Weight</h5> <!--BACK-END-->
                </div>
                <div class=" mb-0 position-relative mb-n5">
                <div style = "text-align: center;">
                <div class ="avgweightcircle">
                  <p id="fishaverageweight"></p>
                      <!--Back-END-->
                  <p style="text-align: center; font-size: 15px; color: rgb(0, 0, 0);">grams</p>
                </div>
                <p id = totalweight></p>
                
                <!--BACK-END-->
 
                </div>
                </div>
              </div>
            </div>
          </div>
          <div style="width:30%"> <!--Third Column-->
            <div class="card w-120" style="height:450px;">
              <div class="card-body p-4">
                <div class="mb-3">
                  <h5 class="card-title fw-semibold" style="padding-top:3%; ">Average Fish Length</h5> 
                  <!--BACK-END-->
                </div>
                <div class=" mb-0 position-relative mb-n5">
                <div style = "text-align: center;">
                <div  class ="avgweightcircle">
                  
                  <p id="avgfishlength" style="text-align: center; font-size: 15px; color: rgb(0, 0, 0);"></p>
                  <p style="color:black; padding-bottom: 10%;">centimeters</p>
                
                </div>
                <p id="totallength"style="font-size: 17px;text-align: center; margin: auto; padding-top: 9%;"></p>
                
                <!--BACK-END-->
              
                </div>
                </div>
              </div>
            </div>
          </div>
        </div> <!--End Row-->
        <div class="row"> <!--SECOND ROW OF PAGE-->
          <div class="col-lg-12 d-flex align-items-stretch"> <!--First Column for 2nd Row-->
            <div class="card w-100">
              <div class="card-body p-4">
                <table class="table text-nowrap mb-3 align-middle">
                  <tbody>
                    <tr>
                      <td>
                        <h1 id ="fishquantity2" style="padding-left:2%; margin-right: 40%; font-size: 24px; font-weight: bold; color:black;">Fish Detail</h1>
                        
                        <!--BACK-END-->
                      
                      </td>
                      <td>
                        <div class="align-right">
                        <button id="addButton" onclick="redirectToCreateFish();" value="switch" type="button" class="btn btn-info m-1" style="margin-left: 60%;border-color: rgb(0, 139, 0); background-color: rgb(0, 139, 0);">Add new data</button>
                        </div>
                        </td>
                    </tr>
                  </tbody>
                  </table> <!--Table-->
                <div class="table-responsive">
                  <table class="table text-nowrap mb-0 align-middle" style="font-weight:bold; text-align: center;"> <!--Table-->
                    <thead class="text-dark fs-4" style="background-color: #eeeeee;"> <!--Table Header-->
                      <tr>
                        <th class="border-bottom-0" >
                          <h6 class="fw-semibold mb-0">No.</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Fish Length</h6>
                          <h6 class="fw-semibold mb-0">&#40cm&#41</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Fish Weight</h6>
                          <h6 class="fw-semibold mb-0">&#40g&#41</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Growth Rate</h6>
                          <h6 class="fw-semibold mb-0">&#40cm&#41</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Date Added</h6>
                        </th>
                        <th class="border-bottom-0">
                          <h6 class="fw-semibold mb-0">Update</h6>
                        </th>
                      </tr>
                    </thead> <!--End Table Header-->
                    <tbody id="tilapiadata"> 


                      <!--BACK-ENDDD-->


                    </tbody> <!--End of first Row-->
                  </table> <!--End Table-->
                </div>
              </div>
            </div>
          </div><!--End of Column for 2nd Row-->
        </div>
        <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design and Developed by Team LoraFish </p>
        </div>
      </div>
    </div>
  </div>
  <script src="script.js"></script>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>

<script>
  // reading data using json
  //sensorType
  $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "../marinelife/marinelifetankd.php",
          dataType: 'json',
          success: function(data) {

            var fishquantity = "<p id =\"fishname\" style=\"text-align: center; margin-top: 20%; margin-bottom: 0%; font-size: 65px; color: white;\">"
              + data[0].Quantity + "</p>";
              $(fishquantity).appendTo($("#fishquantity"));

              var avgfishweight = "<p style=\"text-align: center; font-weight:bold; margin-top: 30%; margin-bottom: 0%; font-size: 40px; color: rgb(0, 0, 0);\">" + data[0].AverageFishWeight + "</p>" 
              $(avgfishweight).appendTo($("#fishaverageweight"));

              var fishname = "<p id= \"dateadded\" style=\"text-align: center; font-size: 15px; color: white;\">" + data[0].FishType + " Fish</p>" 
              $(fishname).appendTo($("#fishname"));

              var fishtype = "<p style=\"font-weight: bold; color: black;\">" + data[0].FishType + " Fish</p>" 
              $(fishtype).appendTo($("#fishtype"));

              var dateAdded = "<p style=\"font-size: 17px;text-align: center; color: black; margin: auto; padding-top: 50%;\"> Last added on "
              + data[0].LastDateAdded + "</p>";
              $(dateAdded).appendTo($("#dateadded"));

              var totalweight = "<p style=\"font-size: 20px; padding-bottom:0%; padding-top: 10%;\">"
              + data[0].TotalFishWeight + "g in total</p>";
              $(totalweight).appendTo($("#totalweight"));

              var avgfishlength = "<p style=\"text-align: center; font-weight:bold; margin-top: 30%; margin-bottom: 0%; font-size: 40px; color: rgb(0, 0, 0);\">" + data[0].AverageFishLength + "</p>" 
              $(avgfishlength).appendTo($("#avgfishlength"));

              var fishquantity2 = "<p style=\"font-size: 15px; color:	#989898 ; padding-left:2%; padding-bottom: 3%; padding-top: 10%;\">"
              + data[0].Quantity + " rows</p>";
              $(fishquantity2).appendTo($("#fishquantity2"));

              var fishlastno = "<p id=\"fishID\" style=\"font-size: 15px; margin-top:3px;margin-bottom: 3px; color:#989898;\">"+ 
                  (parseInt(data[0].Quantity) + 1) + "</p>";
                  $(fishlastno).appendTo($("#fishlastno"));


          },
          error: function() {
              var defaultResponse = "<tr><td >?</td></tr>";
              $(defaultResponse).appendTo($("#fishaverageweight"));
          }
      });
  });

  $(document).ready(function() {
  $.ajax({
    type: "GET",
    url: "../marinelife/troutData.php",
    dataType: 'json',
    success: function(data) {
      var response = "";
      for (var i = 0; i < Object.keys(data).length; i++) {
        response += "<tr style=\"text-align: center;\">" +
          "<td class=\"border-bottom-0\">" +
          "<h6 class=\"fw-semibold mb-0\">" + (i + 1) + "</h6></td>" +
          "<td class=\"border-bottom-0\">" +
          "<span class=\"fw-normal\">" + data[i].fishLength + "</span></td>" +
          "<td class=\"border-bottom-0\">" +
          "<p class=\"mb-0 fw-normal\">" + data[i].fishWeight + "</p></td>" +
          "<td class=\"border-bottom-0\">" +
          "<p class=\"mb-0 fw-normal\">" + data[i].growthRate + "</p></td>" +
          "<td class=\"border-bottom-0\">" +
          "<p class=\"mb-0 fw-normal\">" + data[i].dateAdded + "</p></td>" +
          "<td class=\"border-bottom-0\">" +
          "<button type=\"button\" class=\"btn btn-info m-1\" onclick=\"location.href='updateFishD.php?fishID=" + data[i].fishID + "';\">Edit</button>" +
          "</td>" +
          "</tr>";
      }
      $(response).appendTo($("#tilapiadata"));
    },
    error: function() {
      var defaultResponse = "<tr><td>?</td></tr>";
      $(defaultResponse).appendTo($("#tilapiadata"));
    }
  });
});
        
</script>

<script>
  document.getElementById("tankAButton").addEventListener("click", function() {
    window.location.href = "tankafish.php";
  });

  document.getElementById("tankBButton").addEventListener("click", function() {
    window.location.href = "tankbfish.php";
  });
  document.getElementById("tankCButton").addEventListener("click", function() {
    window.location.href = "tankcfish.php";
  });
  document.getElementById("tankEButton").addEventListener("click", function() {
    window.location.href = "tankefish.php";
  });
  document.getElementById("tankDButton").addEventListener("click", function() {
    window.location.href = "tankdfish.php";
  });
  
  function redirectToCreateFish() {
  window.location.href = 'createfishd.php';
}
</script>

