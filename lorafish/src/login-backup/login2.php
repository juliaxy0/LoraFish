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
    <?php

    include_once "./database.php";
    $db = new Database();
    $conn = $db->getConnection();

    $message = null;


    if (isset($_POST['signIN_button'])) {




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


        if (!isset($users1['password'])) {

            $message = "nopassword";
        } else 
        if ($password == $users1['password']) {
            if ($_POST['category'] == $users1['category']) {
                header("location: ../dashboard/dash.php");
            } else $message = "wrongcategory";
        } else $message = "wrongpassword";
    }


    ?>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-6 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">



                                <div class="row">
                                    <div class="col-4">
                                        <h2>Welcome to LoraFish</h2>
                                    </div>
                                    <div class="col d-flex align-items-end">
                                        <h1>Sign In</h1>
                                    </div>
                                </div>

                                <?php

                                if (isset($_POST['signIN_button'])) {

                                    if ($message == "NO") {

                                        echo '<div class="alert alert-success" role="alert">';
                                        echo 'Successful register! ';
                                        echo '<a href="login2.php" class="btn btn-link">Let\'s Sign in</a>';
                                        echo '</div>';
                                    } else 
                                        if ($message == "nopassword") {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo ' The email address you provided is not registered in our system. Please ensure you have entered the correct email address or consider signing up for an account.';
                                        echo '</div>';
                                    } else 
                                            if ($message == "wrongpassword") {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo 'Please enter correct password';
                                        echo '</div>';
                                    } else 
                                            if ($message == "wrongcategory") {
                                        echo '<div class="alert alert-danger" role="alert">';
                                        echo 'Please select correct category';
                                        echo '</div>';
                                    }
                                }

                                ?>
                                <form action="login2.php" method="POST">

                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                    </div>

                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Login as a?</label>

                                        <select name="category" class="form-select" id="category">
                                            <option value="Public">Public</option>
                                            <option value="Management">Management</option>
                                            <option value="Maintenance">Maintenance</option>
                                            <option value="Purchaser">Purchaser</option>
                                        </select>

                                    </div>


                                    <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign In" name="signIN_button">
                                    <div class="d-flex align-items-center justify-content-center">

                                        <p class="fs-4 mb-0 fw-bold">Don't have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="./register.php">Sign Up</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a  class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="./assets/images/backgrounds/imagelogin1.png" style="width: 64%;" alt="">
                                </a>


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