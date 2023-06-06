<?php


session_start();

// Check if the session variable is not set or empty
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to the logout page or any other desired page
    header("Location: ../../src/login/src/html/logout.php");
    exit();
} 

require_once "./config/pdo.php";

$_GET['name'] = 'userid';
?>

<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LoraFish</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />
    <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebarmenu.js"></script>
    <script src="../assets/js/app.min.js"></script>
    <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>

    <!-- add -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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

      /* size donut chart */
      #sensorStatusChart {
        width: 200px;
        height: 200px;
      }

      /* dashboard column */
      .custom-column {
        height: 300px;
      }
</style>
  </style>

  <body>
    <!-- Modal -->
      <!-- Add Sensor -->
      <div class="modal fade" id="addSensor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add a New Sensor</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="addSensorForm">
                <div class="form-group">
                  <label for="sensorID" class="col-form-label">Sensor ID:</label>
                  <input type="text" class="form-control" id="newSensorID" name="sensorID" required>
                </div>
                <div class="form-group">
                  <label for="dateAdded" class="col-form-label">Date Added:</label>
                  <input type="date" class="form-control" id="newDateAdded" name="dateAdded" required>
                </div>
                <div class="form-group">
                  <label for="status" class="col-form-label">Sensor Status:</label>
                  <select id="newStatus" class="form-control" name="status" required>
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tankNo" class="col-form-label">Tank Number:</label>
                  <input type="text" class="form-control" id="newTankNo" name="tankNo" required>
                </div>   
                <div class="form-group">
                  <label for="sensorType" class="col-form-label">Sensor Type:</label>
                  <input type="text" class="form-control" id="newSensorType" name="sensorType" required>
                </div>
                <div class="form-group">
                  <label for="sensorInput" class="col-form-label">Sensor Input:</label>
                  <input type="text" class="form-control" id="newSensorInput" name="sensorInput" required>
                </div>
                <div class="form-group">
                  <label for="inputUnit" class="col-form-label">Input Unit:</label>
                  <input type="text" class="form-control" id="newInputUnit" name="inputUnit" required>
                </div>
                <div class="form-group">
                  <label for="lastServiced" class="col-form-label">Last Serviced:</label>
                  <input type="date" class="form-control" id="newLastServiced" name="lastServiced" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="newAddSensor">Add Sensor</button>
            </div>
          </div>
        </div>
      </div>

      <!-- edit Sensor -->
      <div class="modal fade" id="editSensorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Sensor Details</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            <form id="updateSensorForm">
                <div class="form-group">
                  <label for="sensorID" class="col-form-label">Sensor ID:</label>
                  <input type="text" class="form-control" id="existingSensorID" name="sensorID" readonly>
                </div>
                <div class="form-group">
                  <label for="status" class="col-form-label">Sensor Status:</label>
                  <select id="existingStatus" class="form-control" name="status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="tankNo" class="col-form-label">Tank Number:</label>
                  <input type="text" class="form-control" id="existingTankNo" name="tankNo" required>
                </div>   
                <div class="form-group">
                  <label for="sensorType" class="col-form-label">Sensor Type:</label>
                  <input type="text" class="form-control" id="existingSensorType" name="sensorType" required>
                </div>
                <div class="form-group">
                  <label for="sensorInput" class="col-form-label">Sensor Input:</label>
                  <input type="text" class="form-control" id="existingSensorInput" name="sensorInput" required>
                </div>
                <div class="form-group">
                  <label for="inputUnit" class="col-form-label">Input Unit:</label>
                  <input type="text" class="form-control" id="existingInputUnit" name="inputUnit" required>
                </div>
                <div class="form-group">
                  <label for="lastServiced" class="col-form-label">Last Serviced:</label>
                  <input type="date" class="form-control" id="existingLastServiced" name="lastServiced" required>
                </div>
              </form>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="updateExistingSensor">Save</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- delete Sensor -->
      <div class="modal fade" id="deleteSensorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Deletion Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Permanently delete <span id="sensorID"></span>?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" id="deleteExistingSensor">Confirm</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End of modals -->


    <?php

 include_once "./config/database.php";
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
          <a href="../../dashboard/dash.php" class="text-nowrap logo-img">
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
              <a class="sidebar-link" href="./manageSensor.php" aria-expanded="false">
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
              <a class="sidebar-link" href="../../analysecost/html/analysecost.php" aria-expanded="false">
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
                    <a href="../../login/src/html/logout.php" class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!--  Header End -->

        <!-- Dashboard atas -->
        <div class="container-fluid" style="max-width:1900px;">
          <div class="mb-4">
            <h class="card-title fw-semibold">Manage Sensor</h3>
          </div>
          <div class="row">
            <!-- Sensor Status -->
            <div class="col-lg-3"  >
              <div class="card overflow-hidden" style="height: 330px">
                <div class="card-body p-1">
                  <h5 class="card-title  fw-semibold" style=" margin-top: 25px; margin-left: 15px;">Sensor Status</h5>
                  <div id="totalSensors" style='font-size: 13px;margin-top: 10px; margin-left: 15px; margin-bottom: 20px;'></div>
                  <div class="row align-items-center">
                    <!-- chart dynamic here -->
                  <canvas id="sensorStatusChart" ></canvas> 
                  </div>
                </div>
              </div>
            </div>
            <!-- Sensor Type -->
            <div class="col-lg-3">
              <div class="card overflow-hidden" style="height: 330px">
                <div class="card-body p-1">
                  <h5 class="card-title fw-semibold" style=" margin-top: 25px; margin-left: 15px;">Sensor Type</h5>
                </div>
                <div class="table-responsive">
                  <table id="sensorTypeTable" class="table text-nowrap mb-0 align-middle">
                    <tbody>
                      <!-- Table rows will be dynamically added here -->
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

            <!-- Number of Sensor -->
            <div class="col-lg-3">
              <div class="card overflow-hidden" style="height: 330px">
                <div class="card-body p-1">
                  <h5 class="card-title  fw-semibold" style=" margin-top: 25px; margin-left: 15px;">Number of Sensor</h5>
                </div>
                <div class="table-responsive">
                  <table id="noSensor" class="table text-nowrap mb-0 align-middle">
                    <tbody>
                      <!-- Table rows will be dynamically added here -->         
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <!-- Sensor Maintenance -->
            <div class="col-lg-3">
              <div class="card overflow-hidden" style="height: 330px">
                <div class="card-body p-1">
                  <h5 class="card-title fw-semibold" style=" margin-top: 25px; margin-left: 15px;" >Requiring Maintenance</h5>
                </div>
                <div class="table-responsive">
                  <table id="sensorMain" class="table text-nowrap mb-0 align-middle">
                    <tbody>
                      <!-- Table rows will be dynamically added here -->                 
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End of Dashboard -->

          <!-- Sensor List -->
          <div class="row">
            <div class="mb-1">
              <h class="card-title fw-semibold">Sensor List</h3>
              <button class="btn btn-warning btn-sm rounded-circle m-6" type="button" title="add" data-toggle="modal" data-target="#addSensor"><i class="fa fa-plus"></i></button>
              <div class="table-responsive">
                <table id="sensorByTank" class="table text-nowrap mb-0 align-middle">
                    <thead>
                        <tr>
                          <th style='font-size: 14px;'>Tank No</th>
                          <th style='font-size: 14px;'>Sensor ID</th>
                          <th style='font-size: 14px;'>Date Added</th>
                          <th style='font-size: 14px;'>Status</th>
                          <th style='font-size: 14px;'>Sensor Type</th>
                          <th style='font-size: 14px;'>Sensor Input</th>
                          <th style='font-size: 14px;'>Input Unit</th>
                          <th style='font-size: 14px;'>Last Serviced</th>
                          <th style='font-size: 14px;'>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>

<script>
  // reading data using json

  // sensorStatus
  $(document).ready(function() {
      $.ajax({
          type: 'GET',
          url: './sensor/sensorStatus.php',
          dataType: 'json',
          success: function(data) {
              var activeCount = data.activeSensors;
              var inactiveCount = data.inactiveSensors;
              var totalSensors = parseInt(activeCount) + parseInt(inactiveCount);

              // Display total number of existing sensors
              $('#totalSensors').text('Total Sensors: ' + totalSensors);

              var chartData = {
                  labels: ['Active', 'Inactive'],
                  datasets: [{
                      data: [activeCount, inactiveCount],
                      backgroundColor: ['#36A2EB', '#FF6384'],
                      hoverBackgroundColor: ['#36A2EB', '#FF6384']
                  }]
              };

              var chartOptions = {
                  responsive: true,
                  maintainAspectRatio: false,
                  cutoutPercentage: 70,
              };

              var chartCtx = document.getElementById('sensorStatusChart').getContext('2d');
              new Chart(chartCtx, {
                  type: 'doughnut',
                  data: chartData,
                  options: chartOptions
              });
          },
          error: function() {
              $('#sensorStatusChart').html('Unable to retrieve sensor data.');
          }
      });
  });

  //sensorType
  $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "./sensor/sensorType.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
              for (var i in data) {
                  response += "<tr>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0' style='font-size: 12px;'>" + data[i].sensorType + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-semibold mb-0' style='font-size: 12px;' >" + data[i].sensorCount + "</p></td>" +
                      "</tr>";
              }
              $(response).appendTo($("#sensorTypeTable"));
          },
          error: function() {
              var defaultResponse = "<tr><td >?</td></tr>";
              $(defaultResponse).appendTo($("#sensorTypeTable"));
          }
      });
  });

  //noSensor
  $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "./sensor/noSensor.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
              for (var i in data) {
                  response += "<tr>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0' style='font-size: 12px;'>Tank  " + data[i].tankNo + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-semibold mb-0' style='font-size: 12px;'>" + data[i].sensorCount + "</p></td>" +
                      "</tr>";
              }
              $(response).appendTo($("#noSensor"));
          },
          error: function() {
              var defaultResponse = "<tr><td >?</td></tr>";
              $(defaultResponse).appendTo($("#noSensor"));
          }
      });
  });

    //sensorMain
    $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "./sensor/sensorMain.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
              for (var i in data) {
                  response += "<tr>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0' style='font-size: 12px;'>" + data[i].sensorID + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-semibold mb-0 style='font-size: 12px;''>" + data[i].lastServiced + "</p></td>" +
                      "</tr>";
              }
              $(response).appendTo($("#sensorMain"));
          },
          error: function() {
              var defaultResponse = "<tr><td >?</td></tr>";
              $(defaultResponse).appendTo($("#sensorMain"));
          }
      });
  });
      
  //sensor by tank
    $(document).ready(function(){
      $.ajax({
          type: "GET",
          url: "./sensor/sensorTank.php",
          dataType: 'json',
          success: function(data) {
              var response = "";
              for (var i in data) {
                response += "<tr class=''>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0' style='font-size: 13px;' >" + data[i].tankNo + "</p></td>" +
                      "<td class='border-bottom-0' >" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].sensorID + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].dateAdded + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].status + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].sensorType + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].sensorInput + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].inputUnit + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<p class='fw-normal mb-0'  style='font-size: 13px;'>" + data[i].lastServiced + "</p></td>" +
                      "<td class='border-bottom-0'>" +
                      "<button class='btn btn-success btn-sm m-2' type='button' data-toggle='modal' data-target='#editSensorModal' data-sensorid='"+data[i].sensorID+
                      "' data-tankNo='"+data[i].tankNo+"' data-dateAdded='"+data[i].dateAdded+"' data-status='"+data[i].status+"' data-sensorType='"+data[i].sensorType+
                      "' data-sensorInput='"+data[i].sensorInput+"' data-inputUnit='"+data[i].inputUnit+"' data-lastServiced='"+data[i].lastServiced+"'><i class='fa fa-edit'></i></button>"+
                      "<button class='btn btn-danger btn-sm m-2' type='button' data-toggle='modal' data-target='#deleteSensorModal' data-sensorid='"+data[i].sensorID+"'><i class='fa fa-trash'></i></button>"+
                      "</tr>";
              }
              $(response).appendTo($("#sensorByTank"));
          },
          error: function() {
              var defaultResponse = "<tr><td >?</td></tr>";
              $(defaultResponse).appendTo($("#sensorByTank"));
          }
      });
  });

  //add sensor
  $(document).ready(function() {
    // Define the click event for the Add Sensor button
    $('#newAddSensor').click(function() {
      // Validate the form before submitting
      if ($('#addSensorForm')[0].checkValidity()) {
        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: './sensor/createSensor.php',
          dataType: 'json',
          data: {
            newSensorID: $("#newSensorID").val(),
            newDateAdded: $("#newDateAdded").val(),
            newStatus: $("#newStatus").val(),
            newTankNo: $("#newTankNo").val(),
            newSensorType: $("#newSensorType").val(),
            newSensorInput: $("#newSensorInput").val(),
            newInputUnit: $("#newInputUnit").val(),
            newLastServiced: $("#newLastServiced").val()
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully Added New Sensor!");
              window.location.href = './manageSensor.php?name=<?php echo $_GET['name'] ?>';
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

    //carry sensorID delete
    $(document).ready(function() {
      $('#deleteSensorModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var sensorID = button.data('sensorid'); // Extract the value from the data-value attribute
        var modal = $(this);
        modal.find('#sensorID').text(sensorID); // Set the value in the modal body
      });
    });

    //delete sensor
    $(document).ready(function() {
      // Define the click event for the Add Sensor button
      $('#deleteExistingSensor').click(function() {
        // Get the sensorID value from the modal
        var existingSensorID = $('#sensorID').text();

        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: './sensor/deleteSensor.php',
          dataType: 'json',
          data: {
            existingSensorID: existingSensorID,
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully deleted Sensor!");
              window.location.href = './manageSensor.php?name=<?php echo $_GET['name'] ?>';
            } else {
              alert(result['message']);
            }
          }
        });
      });
    });

    //carry sensorID edit
    $(document).ready(function() {
      $('#editSensorModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var existingSensorID = button.data('sensorid'); // Extract the value from the data-sensorid attribute
        var existingTankNo = button.data('tankno');
        var existingDateAdded = button.data('dateadded');
        var existingStatus = button.data('status');
        var existingSensorType = button.data('sensortype');
        var existingSensorInput = button.data('sensorinput');
        var existingInputUnit = button.data('inputunit');
        var existingLastServiced = button.data('lastserviced');
        var modal = $(this);
        modal.find('#existingSensorID').val(existingSensorID);
        modal.find('#existingTankNo').val(existingTankNo);
        modal.find('#existingDateAdded').val(existingDateAdded);
        modal.find('#existingStatus').val(existingStatus);
        modal.find('#existingSensorType').val(existingSensorType);
        modal.find('#existingSensorInput').val(existingSensorInput);
        modal.find('#existingInputUnit').val(existingInputUnit);
        modal.find('#existingLastServiced').val(existingLastServiced);
      });
    });

    //edit sensor
   $(document).ready(function() {
    // Define the click event for the Add Sensor button
    $('#updateExistingSensor').click(function() {
      // Validate the form before submitting
      if ($('#updateSensorForm')[0].checkValidity()) {
        // Perform the AJAX request
        $.ajax({
          type: "POST",
          url: './sensor/updateSensor.php',
          dataType: 'json',
          data: {
            existingSensorID: $("#existingSensorID").val(),
            existingTankNo: $("#existingTankNo").val(),
            existingStatus: $("#existingStatus").val(),
            existingSensorType: $("#existingSensorType").val(),
            existingSensorInput: $("#existingSensorInput").val(),
            existingInputUnit: $("#existingInputUnit").val(),
            existingLastServiced: $("#existingLastServiced").val()
          },
          error: function(result) {
            alert(result.responseText);
          },
          success: function(result) {
            if (result['status'] == true) {
              alert("Successfully Updated Sensor!");
              window.location.href = './manageSensor.php?name=<?php echo $_GET['name'] ?>';
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