<?php



echo "<pre>";
print_r($_POST);
echo "</pre>";



//data input output
$name = $_POST['name'];
$email = $_POST['email'];
$password = md5($_POST['password']);
$category = "Public";
$verificationToken = bin2hex(random_bytes(32));
$message = null;
$page = null;


//connectiing database and make connection
include_once "./database.php";
$db = new Database();
$conn = $db->getConnection();




//import PHPMaileer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../src/html/PHPMailer.php';
require '../../src/html/Exception.php';
require '../../src/html/SMTP.php';


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




    $message = 'Hello ' . $name . ',<br><br>' .
        'Thank you for registering with us. Please use the following verification key to verify your email address:<br><br>' .
        'Verification Key: ' . $verificationToken . '<br><br>' .
        'If you have any questions, feel free to contact us.<br><br>' .
        'Best regards,<br>' .
        'Lorafish';




    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();

    //end send email


    //start insert query

    if (isset($_POST['signUP_button'])) {


        //  echo "<pre>";
        //  print_r($_POST);
        //  echo "</pre>";

        $stmt =  $conn->prepare("INSERT INTO USERS1(name, email, password, category, verification_token) VALUES(:name, :email, :password, :category, :verification_token)");

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':verification_token', $verificationToken);

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

    echo "
    <script>
    alert('Sent Successfully');
    document.location.href = 'verifyregister.php';
    </script>
    ";
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
