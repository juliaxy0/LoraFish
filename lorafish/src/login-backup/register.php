<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modernize Free</title>
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
    // echo "df";
    //require('./database.php');
    //$p = Database::getConnection()->prepare('SELECT * FROM users');
    //echo "df";

    include_once "./database.php";

    $db = new Database();
    $conn = $db->getConnection();

    $message = null;
    $page = null;
    if (isset($_POST['signUP_button'])) {
        //echo "df";
        //echo $_POST['name'];



        //$userid = rand(1111, 9999);
        // $userid = 4444;
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $category = "Public";

        $stmt =  $conn->prepare("INSERT INTO USERS1(name, email, password, category) VALUES(:name, :email, :password, :category)");

        //        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':category', $category);
        //   $stmt->execute();


        // $message = "Success";
        try {
            $stmt->execute();
            $message = "success";
        } catch (PDOException $e) {

            //  echo "Update failed: djdjd" . $e->getMessage();
            if (strpos($e->getMessage(), "Integrity constraint violation: 1062") !== false) {
                $message = "unsuccess";
            } else {
                echo "Other error occurred.";
            }
        }
    }

    // $userid = 3333;
    // $name = "ali";
    //  $email = "ali@gmail.com";
    //  $password = "dhdhdh";
    //  $category = "public";


    // include_once "./database.php";
    //                  $db = new Database();
    //                 $conn = $db->getConnection();

    //                 $stmt =  $conn->prepare("INSERT INTO USERS(userid, name, email, password, category) VALUES(:userid, :name, :email, :password, :category)");

    //             $stmt->bindParam(':userid', $userid);
    //             $stmt->bindParam(':name', $name);
    //             $stmt->bindParam(':email', $email);
    //             $stmt->bindParam(':password', $password);
    //             $stmt->bindParam(':category', $category);
    //             $stmt->execute();
    ?>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-6 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <!--  <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                </a>-->


                                <div class="row">
                                    <div class="col-4">
                                        <h2>Welcome to LoraFish</h2>
                                    </div>
                                    <div class="col d-flex align-items-end">
                                        <h1>Sign Up</h1>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php

                                    if (isset($_POST['signUP_button'])) {

                                        if ($message == "success") {

                                            echo '<div class="alert alert-success" role="alert">';
                                            echo 'Successful register! ';
                                            echo '<a href="login2.php" class="btn btn-link">Let\'s Sign in</a>';
                                            echo '</div>';
                                        } else {
                                            if ($message == "unsuccess") {
                                                echo '<div class="alert alert-danger" role="alert">';
                                                echo 'Your email address is already been registered. Proceed to sign in.';
                                                echo '</div>';
                                            }
                                        }
                                    };

                                    ?>
                                </div>
                                <form action="register.php" method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control <?php echo isset($_POST['name']) && empty($_POST['name']) ? 'is-invalid' : ''; ?>" id="exampleInputtext1" aria-describedby="textHelp" required>
                                        <?php if (isset($_POST['name']) && empty($_POST['name'])) : ?>
                                            <small class="text-danger">This field is required.</small>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    </div>
                                    <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" required>

                                    </div>

                                    <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign Up as a Public" name="signUP_button">
                                    <div class="d-flex align-items-center justify-content-center">

                                        <p class="fs-4 mb-0 fw-bold">Already have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="./login2.php">Sign In</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="./assets/images/backgrounds/imagelogin1.png" style="width: 63%;" alt="">
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