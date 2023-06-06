<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Alarm</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
          <a href="./index.html" class="text-nowrap logo-img">
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
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
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
            <li class="nav-item">
              <a class="nav-link nav-icon-hover" href="javascript:void(0)">
                <i class="ti ti-bell-ringing"></i>
                <div class="notification bg-primary rounded-circle"></div>
              </a>
            </li>
          </ul>
          <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Download Free</a>
              <li class="nav-item dropdown">
                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle" />
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

      <!--  manage alarm form -->

      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Alarm</h5>
            <div class="card">

              <div class="card-body">

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                  <a class="btn btn-primary" href="managealarm.php" role="button">Manage</a>
                </div>
                <div class="table-responsive">
                  <table class="table table-borderless mb-0">
                    <thead>
                      <tr>

                        <th scope="col">Tank No</th>
                        <th scope="col">Acidity Level (ph)</th>
                        <th scope="col">Oxygen Level (mg/L)</th>
                        <th scope="col">Hydrogen Level (mg/L)</th>
                        <th scope="col">Nitrate Level (mg/L)</th>
                        <th scope="col">Carbon Dioxide Level (mg/L)</th>
                        <th scope="col">Temperature Level (°C)</th>

                      </tr>
                    </thead>
                    <tbody>

                      <?php

                      

                      include_once "./database.php";
                      $db = new Database();
                      $conn = $db->getConnection();

                      $stmt =  $conn->prepare("SELECT * FROM ALARM");
                      $B = 'B';
                   //   $stmt->bindParam(':TNK', $B);
                      $stmt->execute();
                      $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);
                //      echo "<pre>";
                //      print_r($tests);
                //      echo "</pre>";

                      $stmt->execute();
                        $alarm = $stmt->fetchAll();
                        foreach($alarm as $alarm)
                        {
                          echo 
                          "<tr>
                          <td>" . $alarm['tankNo'] . "</td>
                          <td>" . number_format($alarm["minAcidityLevel"], 1) . " - " . number_format($alarm["maxAcidityLevel"], 1) . "</td>
                          <td>" . number_format($alarm["minOxygenLevel"], 1) . " - " . number_format($alarm["maxOxygenLevel"], 1) . "</td>
                                                                  <td>" . number_format($alarm["minHydrogenLevel"], 1) . " - " . number_format($alarm["maxHydrogenLevel"], 1) . "</td>
                                                                  <td>" . number_format($alarm["minNitrateLevel"], 1) . " - " . number_format($alarm["maxNitrateLevel"], 1) . "</td>
                                                                  <td>" . number_format($alarm["minCarbonDioxide"], 1) . " - " . number_format($alarm["maxCarbonDioxide"], 1) . "</td>
                                                                  <td>" . number_format($alarm["minTemperature"], 1) . " - " . number_format($alarm["maxTemperature"], 1) . "</td>
                          
                          
                          </tr>";
                 //         echo $alarm['tankNo'];
                        }

                        

                //      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                //      echo $row['tankNo'];
                      
                //      $B = "B";

                 //     $stmt = $conn->query("SELECT * FROM users WHERE tankNo = :TNK");
                //      $stmt->bindParam(':TNK', $B);
                //      $row = $stmt->fetch(PDO::FETCH_ASSOC);
                 //       echo $row['tankNo'] . "<br />\n";
                      



               //        $servername = "localhost:3306";
                //       $username = "root";
               //        $password = "";
               //        $database = "lorafishdb";

               //        $connection = new mysqli($servername, $username, $password, $database);

               //       if ($connection->connect_error) {
               //         die("Connection failed: " . $connection->connect_error);
               //       }

               //       $sql = "SELECT * FROM ALARM";
               //       $result = $connection->query($sql);

               //       if (!$result) {
               //         die("Invalid query: " . $connection->error);
               //       }

                //      while ($row = $result->fetch_assoc()) {
                //        echo "<tr>

               //                                                 <td>" . $row["tankNo"] . "</td>
               //                                                 <td>" . number_format($row["maxAcidityLevel"], 1) . " - " . number_format($row["minAcidityLevel"], 1) . "</td>
               //                                                 <td>" . number_format($row["maxOxygenLevel"], 1) . " - " . number_format($row["minOxygenLevel"], 1) . "</td>
               //                                                 <td>" . number_format($row["maxHydrogenLevel"], 1) . " - " . number_format($row["minHydrogenLevel"], 1) . "</td>
               //                                                 <td>" . number_format($row["maxNitrateLevel"], 1) . " - " . number_format($row["minNitrateLevel"], 1) . "</td>
               //                                                 <td>" . number_format($row["maxCarbonDioxideLevel"], 1) . " - " . number_format($row["minCarbonDioxideLevel"], 1) . "</td>
               //                                                 <td>" . number_format($row["maxTemperatureLevel"], 1) . " - " . number_format($row["minTemperatureLevel"], 1) . "</td>


               //                                             </tr>";
               //       }
                      ?>


                    </tbody>
                  </table>
                </div>

              </div>
            </div>

          </div>
        </div>
      </div>

      <div class="container-fluid">
        <!--  Row 1 -->


        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">
            Design and Developed by
            <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a>
            Distributed by <a href="https://themewagon.com">ThemeWagon</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>
  <script src="../assets/js/dashboard.js"></script>
</body>

</html>