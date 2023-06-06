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
    
    $_POST['email'] = 'ali@gmail.com';
    $stmt =  $conn->prepare("SELECT * FROM USERS WHERE :email");
    //$stmt->bindParam(':email', $$_POST['email']);
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->execute();
    $tests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $stmt->execute();
    $users = $stmt->fetchAll();
    foreach ($users as $users) {
       echo $users["password"];
    }
    // echo "df";
    //require('./database.php');
    //$p = Database::getConnection()->prepare('SELECT * FROM users');
    //echo "df";
    if (isset($_POST['signIN_button'])) {
        //echo "df";
        //echo $_POST['name'];

        include_once "./database.php";

        $db = new Database();
        $conn = $db->getConnection();

        $userid = rand(1111, 9999);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $category = "public";

        $stmt =  $conn->prepare("INSERT INTO USERS(userid, name, email, password, category) VALUES(:userid, :name, :email, :password, :category)");

        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
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
                                        <h1>Sign Ip</h1>
                                    </div>
                                </div>
                                <form action="register.php" method="POST">
                                    <div class="mb-3">
                                        <label for="exampleInputtext1" class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputtext1" aria-describedby="textHelp">
                                    </div>
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
                                            <option value="admin">Admin</option>
                                            <option value="management">Management</option>
                                            <option value="maintenance">Maintenance</option>
                                            <option value="purchaser">Purchaser</option>
                                        </select>

                                    </div>

                                    <input type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" value="Sign In" name="signIN_button">
                                    <div class="d-flex align-items-center justify-content-center">

                                        <p class="fs-4 mb-0 fw-bold">Don't have an Account?</p>
                                        <a class="text-primary fw-bold ms-2" href="./register.html">Sign Up</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/backgrounds/imagelogin1.png" style="width: 58%;" alt="">
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