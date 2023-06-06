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


    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require '../../src/html/PHPMailer.php';
    require '../../src/html/Exception.php';
    require '../../src/html/SMTP.php';



    function sendemail_verify($email, $verification_token)
    {

        //   echo "
        //   <script>
        //  alert('Sent Successfullyssss" . $email . $reset_token . "');

        //   </script>
        //  ";

        //echo $reset_token;

        $test = true;

        if (isset($test)) {
            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {



                //Server settings
                //  $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();
                $mail->SMTPDebug = 2;                                 //Send using SMTP
                $mail->Mailer = "smtp";
                $mail->Host = "ssl://smtp.gmail.com";                //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'lorafishofficial@gmail.com';                     //SMTP username
                $mail->Password   = 'izhrcufenrtxgxqi';                               //SMTP password
                $mail->SMTPSecure = 'ssl';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('lorafishofficial@gmail.com');
                $mail->addAddress($email);     //Add a recipient

                $message = 'Hello,<br><br>' .
                    'Thank you for registering to our system. Please use the following verification key to verify your email address:<br><br>' .
                    'Verification Key: ' . $verification_token . '<br><br>' .
                    'If you have any questions, feel free to contact us.<br><br>' .
                    'Best regards,<br>' .
                    'Lorafish';




                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Verify email address';
                $mail->Body    = $message;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();




                // SMTP transaction code here
                // ...

                // Enable error reporting again if needed
                //error_reporting(E_ALL);
                echo "
                <script>
                alert('Sent Successfully');
                document.location.href = 'verifyregister.php';
                </script>
                ";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    }

    if (isset($_POST['signUP_button'])) {


        //  echo "<pre>";
        //  print_r($_POST);
        //  echo "</pre>";

        // Generate a unique verification token
        $verification_token = bin2hex(random_bytes(32));

        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        $category = "Public";






        $stmt =  $conn->prepare("INSERT INTO USERS1(name, email, password, category, verification_token) VALUES(:name, :email, :password, :category, :verification_token)");

        //        $stmt->bindParam(':userid', $userid);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':verification_token', $verification_token);


        // $message = "Success";
        try {
            $stmt->execute();
            echo "complete";
            sendemail_verify($email, $verification_token);
        } catch (PDOException $e) {

            echo "Update failed: " . $e->getMessage();
            if (strpos($e->getMessage(), "Integrity constraint violation: 1062") !== false) {
                $message = "unsuccess";
            } else {
                echo "Other error occurred.";
            }
        }
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
                                <a class="text-nowrap logo-img text-center d-block py-3 w-100">
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