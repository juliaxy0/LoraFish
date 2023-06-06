<?php




session_start();

// Check if the session variable is not set or empty
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    // Redirect to the logout page or any other desired page
    header("Location: ../../src/login/src/html/logout.php");
    exit();
} 


// Include database and object files
include_once '../html/database.php';
include_once '../object/historyobject.php';

// Get database connection
$database = new Database();
$db = $database->getConnection();

// Create an instance of the AnalyseCost object
$analyseCost = new AnalyseCost($db);

// Fetch data from the analysecost table
$data = $analyseCost->getAllData();

//Calculate Total Purchased
$totalPurchased = $analyseCost->getTotalPurchased();

//Calculate Total Item
$totalItem = $analyseCost->getTotalItem();

//Calculate Monthly Spend for the current month
$currentMonthSpend = $analyseCost->getMonthlySpend(date('Y-m'));

// Initialize an array to store monthly spend data
$monthlySpendData = array();

// Iterate through the result set
foreach ($data as $row) {
  $datePurchased = $row['DatePurchased'];
  $unitPrice = $row['UnitPrice'];
  $quantity = $row['Quantity'];

  // Calculate the month and year from the DatePurchased
  $month = date('F', strtotime($datePurchased));
  $year = date('Y', strtotime($datePurchased));

  // Create a unique key for the month and year
  $key = $month . ' ' . $year;

  // If the key doesn't exist in the array, initialize the monthly spend value
  if (!isset($monthlySpendData[$key])) {
      $monthlySpendData[$key] = 0;
  }

  // Add the unit price to the monthly spend value
  $monthlySpendData[$key] += ($unitPrice * $quantity);
}

// Output the monthly spend data (for testing purposes)
echo json_encode($monthlySpendData);
?>

<!doctype html>
<html lang="en">

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LoRaFish</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/lorafish.jpeg" />
  <link rel="stylesheet" href="../assets/css/styles.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <!-- Sidebar Start -->
    <aside class="left-sidebar">
      <!-- Sidebar scroll-->
      <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
        <a href="./index.html" class="text-nowrap logo-img">
            <img src="../assets/images/logos/lorafish.jpeg" width="180" alt="" /> <!-- tukar directory -->
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
              <a class="sidebar-link" href="./index.html" aria-expanded="false"> <!-- tukar href -->
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
              <a class="sidebar-link" href="./ui-buttons.html" aria-expanded="false"> <!-- tukar href -->
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
              <a class="sidebar-link" href="./ui-card.html" aria-expanded="false"> <!-- tukar href -->
                <span>
                  <i class="ti ti-cards"></i>
                </span>
                <span class="hide-menu">Water Condition</span>
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
              <a class="sidebar-link" href="./sample-page.html" aria-expanded="false"> <!-- tukar href -->
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
              <a href="https://adminmart.com/product/modernize-free-bootstrap-admin-dashboard/" target="_blank" class="btn btn-primary">Maintenance Team</a>
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
        <!--  Row 1 -->
        <div class="row">
    <div class="col-12">
        <h5 class="fw-semibold" style="color: black; font-size: 23px;">Summary</h5>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4>Total Purchased</h4>
                <h4>RM <?php echo $totalPurchased; ?></h4>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4>Total Item</h4>
                <h4><?php echo $totalItem; ?></h4>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <div class="card-body">
                <h4>Monthly Spend</h4>
                <h4>RM <?php echo $currentMonthSpend; ?></h4>
            </div>
        </div>
    </div>
</div>


        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Purchased History</h5>
                    <form action="analysecost.php">
                    <button type="submit" class="btn btn-primary m-1" style="position: absolute; right:15px; top:15px">Back</button>
                    </form>
                    <h5 class="card-title fw-semibold mb-4">Monthly Spend</h5>
                    <canvas id="monthlySpendChart"></canvas>
                          <script>
  // Get the canvas element
  var ctx = document.getElementById('monthlySpendChart').getContext('2d');

  // Create the chart
  var chart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?php echo json_encode(array_keys($monthlySpendData)); ?>,
      datasets: [{
        label: 'Monthly Spend',
        data: <?php echo json_encode(array_values($monthlySpendData)); ?>,
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
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