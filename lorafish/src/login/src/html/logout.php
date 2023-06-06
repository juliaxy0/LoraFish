<?php
// Destroy the session
session_start();
// echo $_SESSION['email'];

if (session_status() === PHP_SESSION_ACTIVE) {
    // Session is active
    // Call session_destroy() to end the session
    session_destroy();
    echo "Session has been destroyed.";
} else {
    echo "No active session found.";
}


    include_once "./database.php";
    $db = new Database();
    $conn = $db->getConnection();

    $message = null;

    // Function to set a cookie
    function setCookieValue($name, $value, $expire)
    {
        setcookie($name, $value, $expire, "/");
    }


    if (isset($_POST['signIN_button'])) {
        echo "rt";

        echo "<pre>";
        print_r($_POST);
        echo "</pre>";




        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $stmt = $conn->prepare(
            "SELECT * FROM USERS1 WHERE email = :email"
        );
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $users1 = $stmt->fetchAll();
        foreach ($users1 as $users1); {
        }






        if (true) {
            if (!isset($users1['password'])) {

                $message = "nopassword";
            } else if (!isset($users1['isverify'])) {
                $message = "noverify";
            } else 
            if ($password == $users1['password']) {
                if ($_POST['category'] == $users1['category']) {
                    // Set a cookie after successful sign-in
                    setCookieValue("email", $email, time() + (86400 * 30)); // Cookie expires in 30 days
                    setCookieValue("category", $_POST['category'], time() + (86400 * 30)); // Cookie expires in 30 days





                    header("location: displayalarm.php");
                } else $message = "wrongcategory";
            } else $message = "wrongpassword";
        }
    }



?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link rel="shortcut icon" type="image/png" href="../assets/images/logos/favicon.png" />
    <link rel="stylesheet" href="../assets/css/styles.min.css" />

    <style>
        .container-fluid,
        .row {
            height: 100%;
        }

        .d-flex {
            min-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .align-items-end {
            align-items: flex-end;
        }
    </style>
</head>

<body>
   

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">

                    <div class="col-md-6 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">

                                <div style="display: flex; justify-content: center; align-items: center; ">
                                    <h2>Thank you for using LoraFish!</h2>
                                </div>


                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/backgrounds/imagelogin1.png" style="width: 58%;" alt="">
                                </a>

                                <div style="display: flex; justify-content: center; align-items: center; ">
                                    <p class="fs-4 mb-0 fw-bold">Return to <a class="text-primary fw-bold " href="./login2.php">Sign In page</a></p>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>