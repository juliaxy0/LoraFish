<?php

// Function to check if a reading exceeds the safe limit
function isUnsafe($reading, $safeMin, $safeMax) {
    return $reading < $safeMin || $reading > $safeMax;
}

// Function to load and deploy your machine learning model
function loadModel() {
    // Add your code here to load and deploy your machine learning model
    // Example: 
    // $model = your_model_loading_and_deployment_code();
    // For demonstration purposes, we'll return a mock model
    $model = [
        'parameter1' => 0.8,
        'parameter2' => 0.5,
        // Add other parameters here
    ];
    return $model;
}

// Assuming you have retrieved the readings from the database and stored them in variables
$rowsA = [
    'acidity' => 7.2,
    'oxygen' => 4.8,
    'nitrate' => 8.5,
    'hydrogen' => 2.2,
    'carbonDioxide' => 25.3,
    'mercury' => 0.008,
    'hydrogenSulfide' => 0.006,
    'temperature' => 25.5,
];

// Define the safe limits for each parameter
$aciditySafeMin = 6.8;
$aciditySafeMax = 7.8;
$oxygenSafeMin = 6.5;
$oxygenSafeMax = 8.0;
$nitrateSafeMin = 5.0;
$nitrateSafeMax = 10.0;
$hydrogenSafeMin = 2.0;
$hydrogenSafeMax = 3.0;
$carbonDioxideSafeMin = 6.0;
$carbonDioxideSafeMax = 30.0;
$mercurySafeMin = 0.0;
$mercurySafeMax = 0.01;
$hydrogenSulfideSafeMin = 0.0;
$hydrogenSulfideSafeMax = 0.01;
$temperatureSafeMin = 23.0;
$temperatureSafeMax = 27.0;

// Load the machine learning model
$model = loadModel();

// Check if any of the readings exceed the safe limits
$isUnsafeReading = false;

if (isUnsafe($rowsA['acidity'], $aciditySafeMin, $aciditySafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['oxygen'], $oxygenSafeMin, $oxygenSafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['nitrate'], $nitrateSafeMin, $nitrateSafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['hydrogen'], $hydrogenSafeMin, $hydrogenSafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['carbonDioxide'], $carbonDioxideSafeMin, $carbonDioxideSafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['mercury'], $mercurySafeMin, $mercurySafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['hydrogenSulfide'], $hydrogenSulfideSafeMin, $hydrogenSulfideSafeMax)) {
    $isUnsafeReading = true;
}

if (isUnsafe($rowsA['temperature'], $temperatureSafeMin, $temperatureSafeMax)) {
    $isUnsafeReading = true;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Water Quality Dashboard</title>
    <!-- Add your CSS and JavaScript dependencies here -->
</head>
<body>
    <div class="card">
        <?php if ($isUnsafeReading): ?>
        <div class="alert alert-danger" role="alert">
            Warning: One or more readings have exceeded the safe limits!
        </div>
        <?php endif; ?>

        <div class="card-header d-flex justify-content-between align-items-center" id="headingOne" type="button" title="tengok" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
            <h5>Tank A
                <span class="ms-5 badge bg-primary rounded-2 fw-semibold">
                    <?php echo $rowsA['condition']; ?>
                </span>
            </h5>
            <div>
                <button class="btn btn-sm rounded-circle m-6" type="button" title="tengok" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    <i class="fa fa-angle-down" style="font-size:24px"></i>
                </button>
            </div>
        </div>

        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
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
                                    <h6 class="fw-semibold mb-0">Safe Limit</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Acidity</td>
                                <td><?php echo $rowsA['acidity']; ?></td>
                                <td><?php echo $aciditySafeMin . ' - ' . $aciditySafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Oxygen</td>
                                <td><?php echo $rowsA['oxygen']; ?></td>
                                <td><?php echo $oxygenSafeMin . ' - ' . $oxygenSafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Nitrate</td>
                                <td><?php echo $rowsA['nitrate']; ?></td>
                                <td><?php echo $nitrateSafeMin . ' - ' . $nitrateSafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Hydrogen</td>
                                <td><?php echo $rowsA['hydrogen']; ?></td>
                                <td><?php echo $hydrogenSafeMin . ' - ' . $hydrogenSafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Carbon Dioxide</td>
                                <td><?php echo $rowsA['carbonDioxide']; ?></td>
                                <td><?php echo $carbonDioxideSafeMin . ' - ' . $carbonDioxideSafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Mercury</td>
                                <td><?php echo $rowsA['mercury']; ?></td>
                                <td><?php echo $mercurySafeMin . ' - ' . $mercurySafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Hydrogen Sulfide</td>
                                <td><?php echo $rowsA['hydrogenSulfide']; ?></td>
                                <td><?php echo $hydrogenSulfideSafeMin . ' - ' . $hydrogenSulfideSafeMax; ?></td>
                            </tr>
                            <tr>
                                <td>Temperature</td>
                                <td><?php echo $rowsA['temperature']; ?></td>
                                <td><?php echo $temperatureSafeMin . ' - ' . $temperatureSafeMax; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add your additional HTML, CSS, and JavaScript code here -->

</body>
</html>
