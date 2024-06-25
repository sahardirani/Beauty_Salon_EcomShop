<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../BackEnd/Common/setup.php";

function sendMail($email, $firstName)
{
    $conn = dbConnect();
    $random_number = mt_rand(100000, 999999);

    $checkOTP = "Select * From OTP_requests Where EMAIL='$email' ";
    $stOTP = $conn->prepare($checkOTP);
    $stOTP->execute();
    $row_countOTP = $stOTP->rowCount();
    if ($row_countOTP > 0) {
        $UpdateOTP = "UPDATE OTP_requests SET OTP = '$random_number'  WHERE EMAIL='$email' ";
        $OTP_ST = $conn->prepare($UpdateOTP);
        $OTP_ST->execute();
    } else {
        $query2 = "INSERT INTO OTP_requests (EMAIL,OTP) VALUES ('$email','$random_number')";
        $stmt2 = $conn->prepare($query2);
        $stmt2->execute();
    }

    $to = $email;
    $subject = "Verify Your Email Address";
    $message = "Hello " . $firstName . ",\n\n" .
        "Thank you for signing up for our website. To complete your registration, please click on the following link and enter the verification code: " .
        "Please enter this Code for this Email: " . $email . " code= " . $random_number . "\n\n" .
        "If you did not sign up for our website, please ignore this email.\n\n" .
        "Best regards,\n" .
        "Mostafa fatayri";

    $headers = "From: mostafafatayri@yahoo.com";

    echo"going";
  if(mail($to, $subject, $message, $headers)){

    echo"\nrecieved";
  }
   else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
   }
}




//$email = isset($_POST['email']);
//$firstName = isset($_POST['firstName']);


if (isset($_POST['email']) && isset($_POST['firstName']) ){
sendMail($_POST['email'], $_POST['firstName']);


}



?>