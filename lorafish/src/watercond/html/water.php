<?php
require_once "database.php";

$db = new Database();
$conn = $db->getConnection();
$threshold = $db->getThreshold();
$listDate="";

//check if date selected
if (!empty($_POST['date'])) {
  $listDate = $_POST['date'];
}
else {
  $listDate = "2022-01-04";
}

//calculate aquatank condition
function calculateCondition($acidity, $oxygen, $hydrogen, $nitrate, $co2, $mercury, $hydrogenSul, $temperature) {
  $count = 0;
  if ($acidity >= 6.8 && $acidity <= 7.8) {
    $count += 1;
  }
  if ($oxygen >= 6.5 && $oxygen <= 8) {
    $count += 1;
  }
  if ($hydrogen >= 2 && $hydrogen <= 3) {
    $count += 1;
  }
  if ($nitrate >= 5 && $nitrate <= 10) {
    $count += 1;
  }
  if ($co2 >= 6 && $co2 <= 30) {
    $count += 1;
  }
  if ($mercury >= 0.0 && $mercury <= 0.01) {
    $count += 1;
  }
  if ($hydrogenSul >= 0.0 && $hydrogenSul <= 0.05) {
    $count += 1;
  }
  if ($temperature >= 23 && $temperature <= 27) {
    $count += 1;
  }
if ($count == 8) {
  return "Good";
}
  else{

    return "Bad";
  }

}

$rowsA = $db->getAquatankList("A","$listDate");
$rowsB = $db->getAquatankList("B","$listDate");
$rowsC = $db->getAquatankList("C","$listDate");
$rowsD = $db->getAquatankList("D","$listDate");
$rowsE = $db->getAquatankList("E","$listDate");

$rowsA['condition'] = calculateCondition($rowsA['acidity'], $rowsA['oxygen'], $rowsA['hydrogen'], $rowsA['nitrate'], $rowsA['carbonDioxide'], $rowsA['mercury'], $rowsA['hydrogenSulfide'], $rowsA['temperature']);
$rowsB['condition'] = calculateCondition($rowsB['acidity'], $rowsB['oxygen'], $rowsB['hydrogen'], $rowsB['nitrate'], $rowsB['carbonDioxide'], $rowsB['mercury'], $rowsB['hydrogenSulfide'], $rowsB['temperature']);
$rowsC['condition'] = calculateCondition($rowsC['acidity'], $rowsC['oxygen'], $rowsC['hydrogen'], $rowsC['nitrate'], $rowsC['carbonDioxide'], $rowsC['mercury'], $rowsC['hydrogenSulfide'], $rowsC['temperature']);
$rowsD['condition'] = calculateCondition($rowsD['acidity'], $rowsD['oxygen'], $rowsD['hydrogen'], $rowsD['nitrate'], $rowsD['carbonDioxide'], $rowsD['mercury'], $rowsD['hydrogenSulfide'], $rowsD['temperature']);
$rowsE['condition'] = calculateCondition($rowsE['acidity'], $rowsE['oxygen'], $rowsE['hydrogen'], $rowsE['nitrate'], $rowsE['carbonDioxide'], $rowsE['mercury'], $rowsE['hydrogenSulfide'], $rowsE['temperature']);

$sensorA = ['acidity'=>$db->getSensor("Water Acidity","A"),'temperature'=>$db->getSensor("Water Temperature","A"),'quality'=>$db->getSensor("Water Quality","A")];
$sensorB = ['acidity'=>$db->getSensor("Water Acidity","B"),'temperature'=>$db->getSensor("Water Temperature","B"),'quality'=>$db->getSensor("Water Quality","B")];
$sensorC = ['acidity'=>$db->getSensor("Water Acidity","C"),'temperature'=>$db->getSensor("Water Temperature","C"),'quality'=>$db->getSensor("Water Quality","C")];
$sensorD = ['acidity'=>$db->getSensor("Water Acidity","D"),'temperature'=>$db->getSensor("Water Temperature","D"),'quality'=>$db->getSensor("Water Quality","D")];
$sensorE = ['acidity'=>$db->getSensor("Water Acidity","E"),'temperature'=>$db->getSensor("Water Temperature","E"),'quality'=>$db->getSensor("Water Quality","E")];

$rowsA['sensor'] = $sensorA;
$rowsB['sensor'] = $sensorB;
$rowsC['sensor'] = $sensorC;
$rowsD['sensor'] = $sensorD;
$rowsE['sensor'] = $sensorE;

$rowsTank=[$rowsA,$rowsB,$rowsC,$rowsD,$rowsE];

// Execute the Python script
$command = escapeshellcmd('python ml.py');
$output = shell_exec($command);

// Parse the JSON output from the Python script
$predictions = json_decode($output, true);

//donut chart
  function calculateConditionPercentage(){
  $percentage = 0;
  global $rowsA, $rowsB, $rowsC, $rowsD, $rowsE;
  
    if ($rowsA['condition'] == "Good"){
      $percentage++;
    }
    if ($rowsB['condition'] == "Good"){
      $percentage++;
    }
    if ($rowsC['condition'] == "Good"){
      $percentage++;
    }
    if ($rowsD['condition'] == "Good"){
      $percentage++;
    }
    if ($rowsE['condition'] == "Good"){
      $percentage++;
    }

    return $percentage;
}

$percentageTotal = calculateConditionPercentage();

$dataPoints = array( 
	array("label"=>"Good", "symbol" => "Good","y"=> ($percentageTotal/5)*100),
	array("label"=>"Bad", "symbol" => "Bad","y"=> (((5-$percentageTotal)/5))*100)
  )
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>lora</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/lorafish.jpeg" />
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
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <!--  Main wrapper -->
    <div class="body-wrapper">
        <!doctype html>
        <html lang="en">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Manage Water Condition</title>
            <link rel="shortcut icon" type="image/png" href="../assets/images/logos/lorafish.jpeg" />
            <link rel="stylesheet" href="../assets/css/styles.min.css" />
            <link rel="stylesheet" type="text/css" href="styles2.css">
        </head>

        <style>
        #myDIV {
            border: solid 1px #ffffff;
            display: none;
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
        </style>
</body>

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
                            <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false">
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
                            <a class="sidebar-link" href="./watercond.php" aria-expanded="false">
                                <span>
                                    <i class="ti ti-cards"></i>
                                </span>
                                <span class="hide-menu">Water Condition</span>
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
</body>


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
                    <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank"
                        class="btn btn-primary">Maintenance Team</a>
                    <li class="nav-item dropdown">
                        <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../assets/images/profile/user-1.jpg" alt="" width="35" height="35"
                                class="rounded-circle">
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
                                <a href="./authentication-login.html"
                                    class="btn btn-outline-primary mx-3 mt-2 d-block">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!--  Header End -->

    <!--title, dropdown, submit button-->
    <div class="container-fluid">
        <div class="mb-4">
            <div class="row">
                <div class="d-sm-flex d-block align-items-left justify-content-between mb-9">
                    <div class="mb-1 mb-sm-0">
                        <h1 class="card-title fw-bold">Aquatank Water Condition Dashboard</h1>
                    </div>
                    <div class="col-lg-8 d-flex align-items-strech">
                        <div>
                            <form name="add" method="post" name="add" method="post" class="d-flex gap-3">
                                <select name="date" class="form-select">
                                    <option <?php if($listDate == '2022-01-04'){echo("selected");}?> value="2022-01-04">
                                        Jan 2022</option>
                                    <option <?php if($listDate == '2022-02-05'){echo("selected");}?> value="2022-02-05">
                                        Feb 2022</option>
                                    <option <?php if($listDate == '2022-03-27'){echo("selected");}?> value="2022-03-27">
                                        Mar 2022</option>
                                    <option <?php if($listDate == '2022-04-23'){echo("selected");}?> value="2022-04-23">
                                        Apr 2022</option>
                                    <option <?php if($listDate == '2022-05-10'){echo("selected");}?> value="2022-05-10">
                                        May 2022</option>
                                    <option <?php if($listDate == '2022-06-07'){echo("selected");}?> value="2022-06-07">
                                        Jun 2022</option>
                                    <option <?php if($listDate == '2022-07-21'){echo("selected");}?> value="2022-07-21">
                                        Jul 2022</option>
                                    <option <?php if($listDate == '2022-08-14'){echo("selected");}?> value="2022-08-14">
                                        Aug 2022</option>
                                    <option <?php if($listDate == '2022-09-28'){echo("selected");}?> value="2022-09-28">
                                        Sep 2022</option>
                                    <option <?php if($listDate == '2022-10-15'){echo("selected");}?> value="2022-10-15">
                                        Oct 2022</option>
                                    <option <?php if($listDate == '2022-11-11'){echo("selected");}?> value="2022-11-11">
                                        Nov 2022</option>
                                    <option <?php if($listDate == '2022-12-03'){echo("selected");}?> value="2022-12-03">
                                        Dec 2022</option>
                                </select>
                                <input type="submit" name="submit" class="btn btn-primary" value="Get Detail" />
                            </form>
                        </div>
                    </div>
                </div>

                <body>
                    <!-- aquatankchart -->
                    <div class="col-lg-4">
                        <div class="card overflow-hidden">
                            <div class="card-body p-4" style="height: 33rem;">
                                <h5 class="card-title mb-9 fw-semibold">Aquatank Status Chart</h5>
                                <div class="row align-items-center">

                                    <script>
                                    window.onload = function() {

                                        var chart = new CanvasJS.Chart("chartContainer", {
                                            theme: "light",
                                            animationEnabled: true,
                                            data: [{
                                                type: "doughnut",
                                                indexLabel: "{symbol} - {y}",
                                                yValueFormatString: "#,##0.0\"%\"",
                                                showInLegend: true,
                                                legendText: "{label} : {y}",
                                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                                            }]
                                        });

                                        chart.render();
                                    }
                                    </script>

                                    <body>
                                        <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                                        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                    </body>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- aquatank status -->
                    <div class="col-lg-4">
                        <div class="card overflow-hidden">
                            <div class="card-body p-4" style="height: 33rem;">
                                <h5 class="card-title mb-9 fw-semibold">Aquatank Status</h5>
                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">

                                        <!--table aquatank status-->
                                        <tbody>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Tank A</h6>
                                                </td>
                                                <td class="border-bottom-0 d-flex justify-content-end">
                                                    <div class="d-flex align-items-center gap-2 text-end">
                                                        <span class="badge bg-primary rounded-2 fw-semibold">
                                                            <?php 
                                      echo $rowsA['condition'];
                                      ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Tank B</h6>
                                                </td>
                                                <td class="border-bottom-0 d-flex justify-content-end">
                                                    <div class="d-flex align-items-center gap-2 text-end">
                                                        <span class="badge bg-primary rounded-2 fw-semibold">
                                                            <?php 
                                      echo $rowsB['condition'];
                                    ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Tank C</h6>
                                                </td>
                                                <td class="border-bottom-0 d-flex justify-content-end">
                                                    <div class="d-flex align-items-center gap-2 text-end">
                                                        <span class="badge bg-primary rounded-2 fw-semibold">
                                                            <?php 
                                      echo $rowsC['condition'];
                                      ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Tank D</h6>
                                                </td>
                                                <td class="border-bottom-0 d-flex justify-content-end">
                                                    <div class="d-flex align-items-center gap-2 text-end">
                                                        <span class="badge bg-primary rounded-2 fw-semibold">
                                                            <?php 
                                      echo $rowsD['condition'];
                                    ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Tank E</h6>
                                                </td>
                                                <td class="border-bottom-0 d-flex justify-content-end">
                                                    <div class="d-flex align-items-center gap-2 text-end">
                                                        <span class="badge bg-primary rounded-2 fw-semibold">
                                                            <?php 
                                      echo $rowsE['condition'];
                                    ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>

        

                <body>
                    <!--category threshold -->
                    <div class="col-lg-4">
                        <div class="card overflow-hidden">
                            <div class="card-body p-4" style="height: 33rem;">
                                <h5 class="card-title mb-9 fw-semibold">Category Threshold</h5>

                                <div class="table-responsive">
                                    <table class="table text-nowrap mb-0 align-middle">
                                      <!--table category threshold-->
                                        <tbody>
                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Acidity</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minAcidityLevel'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxAcidityLevel'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Oxygen</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minOxygenLevel'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxOxygenLevel'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Nitrate</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minNitrateLevel'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxNitrateLevel'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Hydrogen</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minHydrogenLevel'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxHydrogenLevel'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Carbon Dioxide</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minCarbonDioxide'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxCarbonDioxide'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Mercury</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minMercury'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxMercury'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Hydrogen Sulfide</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minHydrogenSulfide'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxHydrogenSulfide'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <h6 class="fw-semibold mb-0">Temperature</h6>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['minTemperature'];
                                ?>
                                                        </span>
                                                        <span>-</span>
                                                        <span class="fw-semibold mb-0">
                                                            <?php 
                                echo $threshold['maxTemperature'];
                                ?>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>

                <body>
    <!--Tank Prediction -->
<div class="col-lg-4" style="width: 100rem;">
    <div class="card overflow-hidden">
        <div class="card-body p-4" style="height: 22rem; width: 60rem;">
            <h5 class="card-title mb-9 fw-semibold">Tank Prediction</h5>

            <div class="table-responsive">
                <table class="table text-nowrap mb-0 align-middle">
                    <tbody>
                        <?php foreach ($predictions as $prediction): ?>
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tank: <?php echo $prediction['tankNo']; ?></h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-semibold mb-0">Percentage Exceedances:</span>
                                        <span class="fw-semibold mb-0"><?php echo $prediction['percentage_exceedances']; ?>%</span>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>


                <body>
                    <!-- aquatank list -->
                    <div class="col-lg-12 d-flex align-items-stretch">
                        <div class="container-fluid">
                            <div class="mb-4">
                                <h1 class="card-title fw-semibold">Aquatank List</h1>
                            </div>

                            <!--collapse-->
                            <div id="accordion">
                                <?php 
      function printCatDetail($rows, $index) {
        $thresholds = [
            'acidity' => ['min' => 6.8, 'max' => 7.8],
            'oxygen' => ['min' => 6.5, 'max' => 8],
            'nitrate' => ['min' => 5, 'max' => 10],
            'hydrogen' => ['min' => 2, 'max' => 3],
            'carbonDioxide' => ['min' => 6, 'max' => 30],
            'mercury' => ['min' => 0, 'max' => 0.01],
            'hydrogenSulfide' => ['min' => 0, 'max' => 0.01],
            'temperature' => ['min' => 23, 'max' => 27],
        ];
    
        $acidityColor = ($rows['acidity'] < $thresholds['acidity']['min'] || $rows['acidity'] > $thresholds['acidity']['max']) ? 'bg-danger' : 'bg-primary';
        $oxygenColor = ($rows['oxygen'] < $thresholds['oxygen']['min'] || $rows['oxygen'] > $thresholds['oxygen']['max']) ? 'bg-danger' : 'bg-primary';
        $nitrateColor = ($rows['nitrate'] < $thresholds['nitrate']['min'] || $rows['nitrate'] > $thresholds['nitrate']['max']) ? 'bg-danger' : 'bg-primary';
        $hydrogenColor = ($rows['hydrogen'] < $thresholds['hydrogen']['min'] || $rows['hydrogen'] > $thresholds['hydrogen']['max']) ? 'bg-danger' : 'bg-primary';
        $carbonDioxideColor = ($rows['carbonDioxide'] < $thresholds['carbonDioxide']['min'] || $rows['carbonDioxide'] > $thresholds['carbonDioxide']['max']) ? 'bg-danger' : 'bg-primary';
        $mercuryColor = ($rows['mercury'] < $thresholds['mercury']['min'] || $rows['mercury'] > $thresholds['mercury']['max']) ? 'bg-danger' : 'bg-primary';
        $hydrogenSulfideColor = ($rows['hydrogenSulfide'] < $thresholds['hydrogenSulfide']['min'] || $rows['hydrogenSulfide'] > $thresholds['hydrogenSulfide']['max']) ? 'bg-danger' : 'bg-primary';
        $temperatureColor = ($rows['temperature'] < $thresholds['temperature']['min'] || $rows['temperature'] > $thresholds['temperature']['max']) ? 'bg-danger' : 'bg-primary';
    
        print('
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center" id="headingOne" type="button" title="tengok" data-toggle="collapse" data-target="#collapse'.$index.'" aria-expanded="true" aria-controls="collapse'.$index.'">
                    <h5>Tank '.$rows['tankNo'].'
                        <span class="ms-5 badge bg-primary rounded-2 fw-semibold">
                            '.$rows['condition'].'
                        </span>
                    </h5>
                    <div>
                        <button class="btn btn-sm rounded-circle m-6" type="button" title="tengok" data-toggle="collapse" data-target="#collapse'.$index.'" aria-expanded="true" aria-controls="collapse'.$index.'">
                            <i class="fa fa-angle-down" style="font-size:24px"></i>
                        </button>
                    </div>
                </div>
    
                <div id="collapse'.$index.'" class="collapse" aria-labelledby="heading'.$index.'" data-parent="#accordion">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table text-nowrap mb-0 align-middle">
                                <thead class="text-dark fs-4">
                                    <tr>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Category</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Reading</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">View</h6>
                                        </th>
                                    </tr>
                                </thead>
                              
                                <tbody>
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Acidity</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$acidityColor.' rounded-3 fw-semibold">
                                                '.$rows['acidity'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailAcidity'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
                        
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Oxygen</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$oxygenColor.' rounded-3 fw-semibold"> 
                                                '.$rows['oxygen'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailOxygen'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
    
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Nitrate</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$nitrateColor.' rounded-3 fw-semibold">
                                                '.$rows['nitrate'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailNitrate'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
    
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Hydrogen</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$hydrogenColor.' rounded-3 fw-semibold">
                                                '.$rows['hydrogen'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailHydrogen'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
    
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Carbon Dioxide</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$carbonDioxideColor.' rounded-3 fw-semibold">
                                                '.$rows['carbonDioxide'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailCarbonDioxide'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
    
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Mercury</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$mercuryColor.' rounded-3 fw-semibold">
                                                '.$rows['mercury'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailMercury'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
    
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Hydrogen Sulfide</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$hydrogenSulfideColor.' rounded-3 fw-semibold">
                                                '.$rows['hydrogenSulfide'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailHydrogenSulfide'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
    
                                    <tr>
                                        <td class="border-bottom-0">
                                            <span class="fw-normal">Temperature</span>                          
                                        </td>
                                        <td class="border-bottom-0">
                                            <span class="badge '.$temperatureColor.' rounded-3 fw-semibold">
                                                '.$rows['temperature'].'
                                            </span>
                                        </td>
                                        <td class="border-bottom-0">
                                            <div class="d-flex align-items-center gap-2">
                                                <button class="btn btn-sm rounded-0 m-2 p-8" type="button" title="Expand" data-toggle="modal" data-target="#catDetailTemperature'.$rows['tankNo'].'">
                                                    <i class="fa fa-share-square-o" style="font-size:24px"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        ');
    
        // Add code for modals here (e.g., #catDetailAcidity, #catDetailOxygen, etc.)
    }
    

      //catDetail
      function printCatDetailModal($detail,$rows,$stringDetail,$min,$max,$string){

        global $listDate;

        if(!strcmp($detail,"HydrogenSulfide")) {
          $detail1=$detail;
          $detail2="Hydrogen Sulfide";
        }
        else if(!strcmp($detail,"CarbonDioxide")){
          $detail1=$detail;
          $detail2="Carbon Dioxide";
        }
        else{
          $detail1=$detail;
          $detail2=$detail;
        }

        echo '<div class="modal" id="catDetail'.$detail1.$rows['tankNo'].'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Category Details</h5>
                  <button type="button" class="open" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa fa-times"></i></span>
                  </button>
            </div>

                <div class="modal-body">

                  <table class="table text-nowrap mb-0 align-middle">

              <tr>
                <td class="border-bottom-0"><h5 class="fw-semibold mb-0">'.$detail2.' Level</h5></td>
                <td class="border-bottom-0">
                  <div class="d-flex align-items-center gap-2">
                  <span class="text-dark fs-5"></span>
                  </div>
                </td>
              </tr>

              <tbody>

                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">Date</h6></td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="fw-semibold mb-0">'.$listDate.'</span>
                    </div>
                  </td>
                </tr> 

              <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">TankName</h6></td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="fw-semibold mb-0">'.$rows['tankNo'].'</span>
                    </div>
                  </td>
                </tr> 

                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">Level</h6></td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="fw-semibold mb-0">'.$rows[$stringDetail].'</span>
                    </div>
                  </td>
                </tr> 

                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">Threshold</h6></td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="fw-semibold mb-0">'.$min."-".$max.'</span>
                    </div>
                  </td>
                </tr> 

                <tr>
                  <td class="border-bottom-0"><h6 class="fw-semibold mb-0">SensorName</h6></td>
                  <td class="border-bottom-0">
                    <div class="d-flex align-items-center gap-2">
                      <span class="fw-semibold mb-0">'.$string.'</span>
                    </div>
                  </td>
                </tr> 

              </tbody>
            </table>
          </div>
        </div>
      </div>
      </div>';
      }
      //tankNo,Condition,Acidity,Oxygen,Nitrate,Hydrogen,mercury,hydrogenSulfide,temperature
        $count = 0;
        foreach($rowsTank as $rowsEach){
          $count++;
          printCatDetail($rowsEach,$count);
          printCatDetailModal("Acidity",$rowsEach,'acidity',$threshold['minAcidityLevel'],$threshold['maxAcidityLevel'],$rowsEach['sensor']['acidity']['sensorID']);
          printCatDetailModal("Oxygen",$rowsEach,'oxygen',$threshold['minOxygenLevel'],$threshold['maxOxygenLevel'],$rowsEach['sensor']['quality']['sensorID']);
          printCatDetailModal("Nitrate",$rowsEach,'nitrate',$threshold['minNitrateLevel'],$threshold['maxNitrateLevel'],$rowsEach['sensor']['quality']['sensorID']);
          printCatDetailModal("Hydrogen",$rowsEach,'hydrogen',$threshold['minHydrogenLevel'],$threshold['maxHydrogenLevel'],$rowsEach['sensor']['quality']['sensorID']);
          printCatDetailModal("CarbonDioxide",$rowsEach,'carbonDioxide',$threshold['minCarbonDioxide'],$threshold['maxCarbonDioxide'],$rowsEach['sensor']['quality']['sensorID']);
          printCatDetailModal("Mercury",$rowsEach,'mercury',$threshold['minMercury'],$threshold['maxMercury'],$rowsEach['sensor']['quality']['sensorID']);
          printCatDetailModal("HydrogenSulfide",$rowsEach,'hydrogenSulfide',$threshold['minHydrogenSulfide'],$threshold['maxHydrogenSulfide'],$rowsEach['sensor']['quality']['sensorID']);
          printCatDetailModal("Temperature",$rowsEach,'temperature',$threshold['minTemperature'],$threshold['maxTemperature'],$rowsEach['sensor']['temperature']['sensorID']);
        }
      ?>

                            </div>
                        </div>
                    </div>
                </body>

                <script>
                function showPopup(popupId) {
                    var popup = document.getElementById('catDetail');
                    popup.style.display = 'block';
                }

                //close popups when clicking outside
                window.addEventListener('click', function(event) {
                    var popups = document.getElementsByClassName('catDetail');
                    for (var i = 0; i < popups.length; i++) {
                        var popup = popups[i];
                        if (event.target !== popup && !popup.contains(event.target)) {
                            popup.style.display = 'none';
                        }
                    }
                });
                </script>