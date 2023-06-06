<?php // include database and object files


session_start();

// Check if the session variable is not set or empty
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to the logout page or any other desired page
    header("Location: ../../src/login/src/html/logout.php");
    exit();
} 


include_once '../html/database.php';
include_once '../object/historyobject.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

function getPurchasedHistory($selectedTank){
  global $db; // Use the global database connection

  // Prepare the SQL query
  $sql = "SELECT ItemName, UnitPrice, Quantity, TankNo, SupplierID FROM analysecost";

  if (!empty($selectedTank)) {
      // Add condition for the selected tank
      $sql .= " WHERE TankNo = :tankNo";
  }

  $stmt = $db->prepare($sql);

  if (!empty($selectedTank)) {
      $stmt->bindParam(':tankNo', $selectedTank);
  }

  $stmt->execute();

  $purchasedHistory = array();

  if ($stmt->rowCount() > 0){
      // Store data in the purchased history array
      while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $itemname = $row["ItemName"];
          $unitprice = $row["UnitPrice"];
          $quantity = $row["Quantity"];
          $tankno = $row["TankNo"];
          $supplierID = $row["SupplierID"];

          $purchasedHistory[] = array(
              "ItemName" => $itemname,
              "UnitPrice" => $unitprice,
              "Quantity" => $quantity,
              "TankNo" => $tankno,
              "SupplierID" => $supplierID
          );
      }
  }

    return $purchasedHistory;
}

// Check if a tank is selected
if (isset($_GET['tank'])) {
  $selectedTank = $_GET['tank'];
  $purchasedHistory = getPurchasedHistory($selectedTank);
} else {
  $selectedTank = "";
  $purchasedHistory = getPurchasedHistory($selectedTank);
}






?>


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LoRaFish</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/lorafish.jpeg" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>
<!-- <style>

#myDIV {
    border:solid 1px #ffffff;
    display:none;
   }

  .align-right {
        text-align: right;
        border: 0;
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

  </style> -->
<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="../../dashboard/dash.php" class="text-nowrap logo-img">
            <img src="../assets/images/logos/lorafish.jpeg" width="180" alt="" />
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
              <a class="sidebar-link" href="../../dashboard/dash.php" aria-expanded="false">
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
              <a class="sidebar-link" href="../../sensor/html/manageSensor.php" aria-expanded="false">
                <span>
                  <i class="ti ti-article"></i>
                </span>
                <span class="hide-menu">Sensor</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../fishphp/tankafish.php" aria-expanded="false">
                <span>
                  <i class="ti ti-alert-circle"></i>
                </span>
                <span class="hide-menu">Marine Life</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../watercond/html/watercond.php" aria-expanded="false">
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Water Condition</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../alarm/displayalarm.php" aria-expanded="false"> <!-- tukar href -->
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Alarm</span>
              </a>
            </li>
            <li class="sidebar-item">
              <a class="sidebar-link" href="../html/analysecost.php" aria-expanded="false">
                <span>
                  <i class="ti ti-file-description"></i>
                </span>
                <span class="hide-menu">Analyse Cost</span>
              </a>
            </li>
          
            <li class="sidebar-item">
              <a class="sidebar-link" href="../../shop/php/shop-resource.php" aria-expanded="false">
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
               if (isset($_COOKIE['email'])) {
                $email = $_COOKIE['email'];
            
            
            
                $stmt = $db->prepare("SELECT * FROM USERS1 WHERE email = :email");
                $stmt->bindParam(':email', $email);
                $stmt->execute();
                $users1 = $stmt->fetchAll();
            
                foreach ($users1 as $users1);
            
            
                echo $users1['name'];
              } else {
                echo "Cookie not found.";
              }
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
                    <a href="../../login/src/html/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
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
                                <h5 class="card-title fw-semibold" style="color: black; font-size:23px;">
                                    LoraFish Aquatank</h5>
                            </div>
                        </div>
                        <div class>
                            <div class="card-body p-4">
                              <form action="" method="GET">
                              <button onclick="showAllTanks()" class="btn btn-primary m-1" style="position:absolute; right:20px; top:20px">All Tanks</button>
                                <button type="submit" name="tank" value="A" class="btn btn-primary m-2"
                                    style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px">Tank
                                    A</button>
                                <button type="submit" name="tank" value="B" class="btn btn-primary m-2"
                                    style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px">Tank
                                    B</button>'
                                <button type="submit" name="tank" value="C" class="btn btn-primary m-2"
                                    style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px">Tank
                                    C</button>
                                <button type="submit" name="tank" value="D" class="btn btn-primary m-2"
                                    style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px">Tank
                                    D</button>
                                <button type="submit" name="tank" value="E" class="btn btn-primary m-2"
                                    style="font-size:20px; padding: 35px 60px;text-align: center; margin: 4px 2px">Tank
                                    E</button>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Purchased History<?php if (!empty($selectedTank)) { echo "for Tank ".$selectedTank; } ?></h5>
                    <form action="summary.php">
                    <button type="submit" class="btn btn-primary m-1" style="position: absolute; right:15px; top:15px">Summary</button>
                    </form>
                    <div class="table-responsive">
                        <table class="table text-nowrap mb-0 align-middle">
                            <thead class="text-dark fs-4">
                                <tr>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Item Name</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Unit Price (RM)</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Quantity</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Tank No</h6>
                                    </th>
                                    <th class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0">Supplier ID</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                       <?php foreach ($purchasedHistory as $purchase) { ?>
                                <tr>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0"><?php echo $purchase["ItemName"]; ?></h6>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-1"><?php echo $purchase["UnitPrice"]; ?></h6>
                                          <span class="fw-normal"></span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <p class="mb-0 fw-normal"><?php echo $purchase["Quantity"]; ?></p>
                                    </td>
                                    <td class="border-bottom-0">
                                        <div class="d-flex align-items-center gap-2">
                                          <span class="badge bg-primary rounded-3 fw-semibold"><?php echo $purchase["TankNo"]; ?></span>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <h6 class="fw-semibold mb-0 fs-4"><?php echo $purchase["SupplierID"]; ?></h6>
                                    </td>
                                </tr>
                        <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
      <!--Body content end-->
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

</body>

</html>