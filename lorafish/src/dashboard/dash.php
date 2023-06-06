<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LoRaFish</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/lorafish.jpeg" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <link href="../assets/css/themify-icons.css" rel="stylesheet"> <!--for icons-->

    <!-- add -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>


<?php

session_start();

// Check if the session variable is not set or empty
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to the logout page or any other desired page
    header("Location: ../../src/login/src/html/logout.php");
    exit();
} 

include_once "./database.php";
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



  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./dash.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/lorafish.jpg" width="180" alt="" /> <!-- tukar directory -->
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
              <a class="sidebar-link" href="./dash.php" aria-expanded="false"> <!-- tukar href -->
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
              <a class="sidebar-link" href="../sensor/html/manageSensor.php" aria-expanded="false"> <!-- tukar href -->
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Sensor</span>
              </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="../fishphp/tankafish.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Marine Life</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../watercond/html/watercond.php" aria-expanded="false"> <!-- tukar href -->
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
              <a class="sidebar-link" href="../shop/php/shop-resource.php" aria-expanded="false"> <!-- tukar href -->
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
      <div class="container-fluid" style="max-width: 1900px;">
        <!--  Row 1 -->
        <!-- <div class="row" > -->
            <div class="col-lg-10 d-flex align-items-stretch" style="width: 100%; margin:0; left: 50%; right: 50%;">
            <div class="card" style="width: 100%; height: 100%;">
              <div class="card-body p-7">
                <div class="mb-4">
                  <h5 class="card-title fw-semibold">Water Quality Dashboard</h5>
                </div>
                <iframe title="LoraFishDB" width="1700" height="1000" src="https://app.powerbi.com/view?r=eyJrIjoiNTI0ZmFkY2QtZmEyYS00YTAxLWI1MzEtODcwMTY5N2ZkMzQ0IiwidCI6IjFmNTUxYWViLTdlYTEtNDcyYy05YWMwLTA5ZGU5YmYzMzA1MSIsImMiOjEwfQ%3D%3D&pageName=ReportSection" frameborder="0" allowFullScreen="true"></iframe>
                    
                </div>
            </div>
          </div>
        <!-- </div>  -->
    </div>
      </body>

</html>