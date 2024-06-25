<?php
//echo"hello";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../../BackEnd/Common/setup.php";


require_once "resendMail.php";

$email = $_POST['email'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];

$BirthDate = $_POST['dateOfBirth'];

$phoneNumber=$_POST['phone_number'];

$conn = dbConnect();

$check = "Select * From USERS_TABLE Where EMAIL='$email' ";
$st = $conn->prepare($check);
$st->execute();
$row_count = $st->rowCount();

if ($row_count > 0) {
    // echo "Error: Email already exists in database";
    exit();
} else {

    $query = "INSERT INTO USERS_TABLE (EMAIL,FIRST_NAME,LAST_NAME,PASSWORD,Phone_Number,DATE_CREATE,MODIFICATION_DATE,ACTIVITY,VERIFIED,Date_Of_Birth) VALUES ('$email','$firstName','$lastName',PASSWORD('$password'),'$phoneNumber',NOW(),NOW(),1,FALSE,'$BirthDate')";
    $stmt = $conn->prepare($query);
    $stmt->execute();


    $query2 = "INSERT INTO PreviousCart (CustomerEmail,PreviousSession) VALUES ('$email','0')";
    $stmt2 = $conn->prepare($query2);
    $stmt2->execute();


   // sendMail($email, $firstName);

    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Redirecting</title>
    </head>
    <body>
        <form id="redirectForm" action="resendMail.php" method="POST" style="display:none;">
            <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
            <input type="hidden" name="firstName" value="' . htmlspecialchars($firstName) . '">
        </form>
        <script>
            document.getElementById("redirectForm").submit();
        </script>
    </body>
    </html>
    ';
}

?>



