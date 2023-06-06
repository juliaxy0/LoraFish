<?php
session_start();
require_once "./pdo.php";
include_once '../config/database.php';

$stmt = $pdo->prepare("SELECT tankNo, fishID, fishLength, fishWeight, growthRate, dateAdded FROM trout WHERE fishID = :fishID");
$stmt->bindParam(':fishID', $_GET['fishID']);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $tankNo = $row["tankNo"];
    $fishID = $row["fishID"];
    $fishLength = $row["fishLength"];
    $fishWeight = $row["fishWeight"];
    $growthRate = $row["growthRate"];
    $dateAdded = $row["dateAdded"];
} else {
    // Handle the case when no row is found with the provided fishID
    // For example, you can redirect the user to an error page or display a message
}
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
          <a href="./tankafish.php" class="text-nowrap logo-img">
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
              <a class="sidebar-link" href="./index.html" aria-expanded="false">
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
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Sensor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./createfishc.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Marine Life</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Water Condition</span>
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
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
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
              <a href="" target="_blank" class="btn btn-primary">Maintenance Team</a>
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
                    <a href="./authentication-login.html" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->
      <div class="container-fluid">
      <div class="row"> <!--SECOND ROW OF PAGE-->
          <div class="col-lg-12 d-flex align-items-stretch"> <!--First Column for 2nd Row-->
            <div class="card w-100">
              <div class="card-body p-4">
              <div class="card overflow-hidden rounded-2">
              <div class="position-relative">
                <div class="card-body pt-3 p-4" style="background-color: #ffffff;">
                  <h1 style="padding-bottom:2%; padding-top:1%; font-size: 22px; font-weight: bold; color:rgb(0, 0, 0);">Add New Marine Life Data</h1>

                   <!-- form start -->
                   <form role="form">
                      <div class="box-body">
                        <div class="form-group">
                        <label for="ans2" style="font-weight: 600; color:black; padding-top:0px; padding-bottom:8px;">Tank Number</label>
                          <input type="text" class="form-control" id="tankNo" name="tankNo" style="color:black; margin-bottom:15px;" placeholder="A/B/C/D/E">
                          <label for="ans2" style="font-weight: 600; color:black; padding-top:7px; padding-bottom:8px;">Fish Length</label>
                          <input type="text" class="form-control" id="fishLength" name="fishLength" style="color:black; margin-bottom:15px;" placeholder="Centimeters (cm)">
                          <label for="ans3" style="font-weight: 600; color:black; padding-bottom:8px;">Fish Weight</label>
                          <input type="text" class="form-control" id="fishWeight" name="fishWeight" style="color:black; margin-bottom:15px;" placeholder="Grams (g)">
                          <label for="ans3" style="font-weight: 600; color:black; padding-bottom:8px;">Growth Rate</label>
                          <input type="text" class="form-control" id="growthRate" name="growthRate" style="color:black; margin-bottom:15px;" placeholder="(cm/day)">
                          <label for="ans3" style="font-weight: 600; color:black; padding-bottom:8px;">Date Added</label>
                          <input type="text" class="form-control" id="dateAdded" name="dateAdded"  style="color:black; margin-bottom:15px;" placeholder="YYYY-MM-DD">                        
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" style="margin-top:7px; background-color:green; border-color:green;" onClick="AddFish()" value="Submit"></input>
                        <input type="button" class="btn btn-primary" style="margin-left: 7px; margin-top:7px; color: green; background-color: #c9bc0000; border-color:green;" onclick="redirectToIndex();"  value="Cancel"></input>
                      </div>
                    </form>

                </div>
              </div>
            </div>

              </div>
              </div>
            </div>
          </div><!--End of Column for 2nd Row-->  
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
  function AddFish(){

        $.ajax(
        {
            type: "POST",
            url: '../marinelife/createtroutfish.php',
            dataType: 'json',
            data: {
                tankNo: $("#tankNo").val(),
                fishID:'',
                fishLength: $("#fishLength").val(),
                fishWeight: $("#fishWeight").val(),
                growthRate: $("#growthRate").val(),
                dateAdded: $("#dateAdded").val(),

            },
            error: function (result) {
                alert("Successfully Added New Fish!");
                window.location.href = '../fishphp/tankdfish.php';
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Successfully Added New Fish!");
                    window.location.href = '../fishphp/tankdfish.php';
                }
                else {
                    alert(result['message']);
                    window.location.href = '../fishphp/tankdfish.php';
                }
            }
        });
    }
</script>

<script>
function redirectToIndex() {
  window.location.href = '../fishphp/tankdfish.php';
}
</script>