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

    <?php
    include_once "./database.php";
    $db = new Database();
    $conn = $db->getConnection();



    $message = null;

    //   $tank = $_POST['tankno'];
    if (isset($_POST['tankno'])) {
        $stmt =  $conn->prepare("SELECT * FROM ALARM WHERE tankNo = :tankNo");
        $stmt->bindParam(':tankNo', $_POST['tankno']);

        $stmt->execute();
        $alarm = $stmt->fetchAll();

        foreach ($alarm as $alarm) {
            //    echo $alarm['tankNo'];
        }
    }

    //$_POST['minacid'];

    if (isset($_POST['update_button'])) {

        //   echo $_POST['tank'];
        //   echo $_POST['minacidity'];
        //    echo $_POST['maxacidity'];
        //   echo $_POST['minoxygen'];
        //   echo $_POST['maxoxygen'];
        //   echo $_POST['minhydrogen'];
        //   echo $_POST['maxhydrogen'];
        //   echo $_POST['minnitrate'];
        //  echo $_POST['maxnitrate'];
        //   echo $_POST['mincarbondioxide'];
        //   echo $_POST['maxcarbondioxide'];
        //    echo $_POST['mintemperature'];
        //    echo $_POST['maxtemperature'];

        //   $id = '2';
        //   $data = "333";

        //   $data1 = [
        //       ':id' => $id,
        //       'data' => $data,
        //   ];
        //   $sql = "UPDATE test SET 'data'=:date WHERE id=:id";
        //   $stmt = $conn->prepare($sql);
        //   $stmt->execute($data1);

        //   $tableName = "alarm";
        //   $columnToUpdate = "minAcidityLevel";
        //   $newValue = $_POST['maxacidity'];
        //   $conditionColumn = "tankNo";
        //   $conditionValue = $_POST['tank'];



        //   $tableName = "alarm";
        //   $columnToUpdate = "maxTemperatureLevel";
        //   $newValue = $_POST['maxtemperature'];
        //   $conditionColumn = "tankNo";
        //   $conditionValue = $_POST['tank'];

        ///   $sql = "UPDATE $tableName SET $columnToUpdate = :newValue WHERE $conditionColumn = :conditionValue";
        //   $stmt = $conn->prepare($sql);
        //  $stmt->bindParam(':newValue', $newValue);
        //   $stmt->bindParam(':conditionValue', $conditionValue);



        $sql = "UPDATE alarm
          SET minAcidityLevel = :minacidity , maxAcidityLevel= :maxacidity, minOxygenLevel = :minoxygen , maxOxygenLevel= :maxoxygen, 
         minHydrogenLevel = :minhydrogen , maxHydrogenLevel = :maxhydrogen, minNitrateLevel = :minnitrate,  maxNitrateLevel= :maxnitrate, 
         minCarbonDioxideLevel = :mincarbondioxide , maxCarbonDioxideLevel= :maxcarbondioxide, minTemperatureLevel = :mintemperature , 
         maxTemperatureLevel= :maxtemperature
          WHERE tankNo = :tankNo";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':tankNo', $_POST['tank']);

        $stmt->bindParam(':minacidity', $_POST['minacidity']);
        $stmt->bindParam(':maxacidity', $_POST['maxacidity']);

        $stmt->bindParam(':minoxygen', $_POST['minoxygen']);
        $stmt->bindParam(':maxoxygen', $_POST['maxoxygen']);

        $stmt->bindParam(':minhydrogen', $_POST['minhydrogen']);
        $stmt->bindParam(':maxhydrogen', $_POST['maxhydrogen']);

        $stmt->bindParam(':minnitrate', $_POST['maxnitrate']);
        $stmt->bindParam(':maxnitrate', $_POST['minnitrate']);

        $stmt->bindParam(':mincarbondioxide', $_POST['mincarbondioxide']);
        $stmt->bindParam(':maxcarbondioxide', $_POST['maxcarbondioxide']);

        $stmt->bindParam(':mintemperature', $_POST['mintemperature']);
        $stmt->bindParam(':maxtemperature', $_POST['maxtemperature']);


        try {
            $stmt->execute();
            //  echo "Update successful!";
            $message = "Update successful!";
        } catch (PDOException $e) {
            echo "Update failed: " . $e->getMessage();
        }
    }

    if (isset($er)) {
        if (isset($_POST['update_button'])) {

            $stmt =  $conn->prepare("UPDATE alarm
            SET minAcidityLevel = :minacidity , maxAcidityLevel= :maxacidity, minOxygenLevel = :minoxygen , maxOxygenLevel= :maxoxygen, minHydrogenLevel = :minhydrogen, maxHydrogenLevel = :maxhydrogen , minNitrateLevel= :minnitrate, maxNitrateLevel= :maxnitrate, minCarbonDioxidenLevel = :mincarbondioxide , maxCarbonDioxideLevel= :maxcarbondioxide, minTemperatureLevel = :mintemperature , maxTemperatureLevel= :maxtemperature,
            WHERE tankNo = :tankNo;");

            $stmt->bindParam(':tankNo', $_POST['tank']);

            $stmt->bindParam(':minacidity', $_POST['minacidity']);
            $stmt->bindParam(':maxacidity', $_POST['maxacidity']);

            $stmt->bindParam(':minoxygen', $_POST['minoxygen']);
            $stmt->bindParam(':maxoxygen', $_POST['maxoxygen']);

            $stmt->bindParam(':minhydrogen', $_POST['minhydrogen']);
            $stmt->bindParam(':maxhydrogen', $_POST['maxhydrogen']);

            $stmt->bindParam(':minnitrate', $_POST['maxnitrate']);
            $stmt->bindParam(':maxnitrate', $_POST['minnitrate']);

            $stmt->bindParam(':mincarbondioxide', $_POST['mincarbondioxide']);
            $stmt->bindParam(':maxcarbondioxide', $_POST['maxcarbondioxide']);

            $stmt->bindParam(':mintemperature', $_POST['mintemperature']);
            $stmt->bindParam(':maxtemperature', $_POST['maxtemperature']);

            $stmt->execute();
        }
    }






    ?>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-between">
                    <a href="./index.html" class="text-nowrap logo-img">
                        <img src="../assets/images/logos/dark-logo.svg" width="180" alt="" />
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
                            <span class="hide-menu">UI COMPONENTS</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./displayalarm.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Alarm</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-article"></i>
                                </span>
                                <span class="hide-menu">Buttons</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-alerts.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-alert-circle"></i>
                                </span>
                                <span class="hide-menu">Alerts</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-card.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Card</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-forms.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-file-description"></i>
                                </span>
                                <span class="hide-menu">Forms</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./ui-typography.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-typography"></i>
                                </span>
                                <span class="hide-menu">Typography</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">AUTH</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-login.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-login"></i>
                                </span>
                                <span class="hide-menu">Login</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./authentication-register.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-user-plus"></i>
                                </span>
                                <span class="hide-menu">Register</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">EXTRA</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./icon-tabler.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-mood-happy"></i>
                                </span>
                                <span class="hide-menu">Icons</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="./sample-page.html" aria-expanded="false">
                                <span>
                                    <i class="ti ti-aperture"></i>
                                </span>
                                <span class="hide-menu">Sample Page</span>
                            </a>
                        </li>
                    </ul>
                    <div class="unlimited-access hide-menu bg-light-primary position-relative mb-7 mt-5 rounded">
                        <div class="d-flex">
                            <div class="unlimited-access-title me-3">
                                <h6 class="fw-semibold fs-4 mb-6 text-dark w-85">
                                    Upgrade to pro
                                </h6>
                                <a href="https://adminmart.com/product/modernize-bootstrap-5-admin-template/" target="_blank" class="btn btn-primary fs-2 fw-semibold lh-sm">Buy Pro</a>
                            </div>
                            <div class="unlimited-access-img">
                                <img src="../assets/images/backgrounds/rocket.png" alt="" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </nav>
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

                        <div class="rol">
                            <div class="col-6">
                                <h5 class="card-title fw-semibold mb-4">Alarm</h5>


                            </div>




                            <div class="col">

                                <?php

                                if (isset($_POST['update_button'])) {
                                    if ($_POST['tank'] == 'N') {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo 'Please enter Tank No!';
                                        echo '</div>';
                                    } else {
                                        if ($message == true) {
                                            echo '<div class="alert alert-success" role="alert">';
                                            echo 'Update is successful!';
                                            echo '</div>';
                                        }
                                    }
                                }

                                ?>



                            </div>
                        </div>





                        <div class="card">
                            <div class="card-body">

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tank No</label>
                                    <div class="col-sm-7">
                                        <div class="dropdown">



                                            <form action="manage3.php" method="POST">
                                                <button class="btn btn-secondary dropdown-toggle" style="width: 157px" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <?php


                                                    if (!isset($_POST['tankno'])) {
                                                        echo "Tank No";
                                                    } else
                                                        echo $_POST['tankno'];


                                                    ?>


                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><button class="dropdown-item" type="submit" name="tankno" value="A">A</button></li>
                                                    <li><button class="dropdown-item" type="submit" name="tankno" value="B">B</button></li>
                                                    <li><button class="dropdown-item" type="submit" name="tankno" value="C">C</button></li>
                                                    <li><button class="dropdown-item" type="submit" name="tankno" value="D">D</button></li>
                                                    <li><button class="dropdown-item" type="submit" name="tankno" value="E">E</button></li>

                                                </ul>









                                        </div>
                                    </div>
                                    <div class="col">
                                        <input type="text" name="tank" step="any" class="form-control" id="minOxygen" style="width: 85px; display: none;" value="<?php if (!isset($alarm['tankNo'])) {
                                                                                                                                                                        echo "N";
                                                                                                                                                                    } else
                                                                                                                                                                        echo $alarm['tankNo'];
                                                                                                                                                                    ?>" />

                                    </div>



                                </div>

                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxacidity" class="form-label">Parameters</label>
                                </div>
                                <div class="col-3">
                                    <label for="minmaxacidity" class="form-label">Minimum</label>
                                </div>
                                <div class="col-3">
                                    <label for="minmaxacidity" class="form-label">Maximum</label>
                                </div>
                            </div>


                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxacidity" class="form-label">Acidity Level (pH)</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="minacidity" step="any" class="form-control" id="minAcid" style="width: 85px" value="<?php echo number_format($alarm["minAcidityLevel"], 1) ?>" />
                                </div>
                                <div class="col-3">
                                    <input type="number" name="maxacidity" step="any" class="form-control" id="maxAcid" style="width: 85px" value="<?php echo number_format($alarm["maxAcidityLevel"], 1) ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxoxygen" class="form-label">Oxygen Level (mg/L)</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="minoxygen" step="any" class="form-control" id="minOxygen" style="width: 85px" value="<?php echo number_format($alarm["minOxygenLevel"], 1) ?>" />
                                </div>
                                <div class="col-3">
                                    <input type="number" name="maxoxygen" step="any" class="form-control" id="maxOxygen" style="width: 85px" value="<?php echo number_format($alarm["maxOxygenLevel"], 1) ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxhydrogen" class="form-label">Hydrogen Level (mg/L)</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="minhydrogen" step="any" class="form-control" id="minHydrogen" style="width: 85px" value="<?php echo number_format($alarm["minHydrogenLevel"], 1) ?>" />
                                </div>
                                <div class="col-3">
                                    <input type="number" name="maxhydrogen" step="any" class="form-control" id="maxHydrogen" style="width: 85px" value="<?php echo number_format($alarm["maxHydrogenLevel"], 1) ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxnitrate" class="form-label">Nitrate Level (mg/L)</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="minnitrate" step="any" class="form-control" id="minNitrate" style="width: 85px" value="<?php echo number_format($alarm["minNitrateLevel"], 1) ?>" />
                                </div>
                                <div class="col-3">
                                    <input type="number" name="maxnitrate" step="any" class="form-control" id="maxNitrate" style="width: 85px" value="<?php echo number_format($alarm["maxNitrateLevel"], 1) ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxcarbondioxide" class="form-label">Carbon Dioxide Level (mg/L)</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="mincarbondioxide" step="any" class="form-control" id="minCarbonDioxide" style="width: 85px" value="<?php echo number_format($alarm["minCarbonDioxideLevel"], 1) ?>" />
                                </div>
                                <div class="col-3">
                                    <input type="number" name="maxcarbondioxide" step="any" class="form-control" id="maxCarbonDioxide" style="width: 85px" value="<?php echo number_format($alarm["maxCarbonDioxideLevel"], 1) ?>" />
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label for="minmaxtemperature" class="form-label">Temperature Level (°C)</label>
                                </div>
                                <div class="col-3">
                                    <input type="number" name="mintemperature" step="any" class="form-control" id="minTemperature" style="width: 85px" value="<?php echo number_format($alarm["minTemperatureLevel"], 1) ?>" />
                                </div>
                                <div class="col-3">
                                    <input type="number" name="maxtemperature" step="any" class="form-control" id="maxTemperature" style="width: 85px" value="<?php echo number_format($alarm["maxTemperatureLevel"], 1) ?>" />
                                </div>

                                <div class="container">
                                    <a class="btn btn-primary me-md-2 float-start" href="displayalarm.php" role="button">Back</a>
                                    <button class="btn btn-primary me-md-2 float-end" name="update_button" type="submit">Update</button>
                                </div>



                            </div>
                            </form>
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