<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "../../BackEnd/Common/setup.php";

$conn = dbConnect();

// Check if the action is 'login'
if (isset($_POST['action']) && $_POST['action'] == 'AutoMateLog') {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $condition = "password = '$pass'";
} else {
    echo "test";
    $email = $_POST['Log-email'];
    $pass = $_POST['Log-password'];
    $condition = "password = Password('$pass')";
}

$sql = "SELECT * FROM USERS_TABLE WHERE email = '$email' AND $condition";
echo $sql;
$st = $conn->prepare($sql);
$st->execute();
$row_count = $st->rowCount();
echo $row_count;
if ($row_count > 0) {


    $getUser = "SELECT * FROM USERS_TABLE WHERE EMAIL='$email' ";
    $getUserST = $conn->prepare($getUser);
    $getUserST->execute();
    $userData = $getUserST->fetch(PDO::FETCH_ASSOC);


    $getPreviousSession = "SELECT * FROM PreviousCart WHERE CustomerEmail = '$email'";

    $getPreviousSessionSt = $conn->prepare($getPreviousSession);
    $getPreviousSessionSt->execute();
    $SessionData = $getPreviousSessionSt->fetch(PDO::FETCH_ASSOC);





    session_start();
    $_SESSION['user_id'] = $userData['ID'];
    $_SESSION['email'] = $userData['EMAIL'];
    $_SESSION['first_name'] = $userData['FIRST_NAME'];
    $_SESSION['last_name'] = $userData['LAST_NAME'];
    $_SESSION['Birthdate'] = $userData['Date_Of_Birth'];
    $_SESSION['PhoneNumber'] = $userData["Phone_Number"];
    $_SESSION['CartSession'] =  $SessionData["PreviousSession"];



    $getLocation = "SELECT * FROM Customer_address WHERE CustomerID='{$_SESSION['user_id']}' ";
    $getUserLocationST = $conn->prepare($getLocation);
    $getUserLocationST->execute();
    $rowCount = $getUserLocationST->rowCount();
    $locationData = $getUserLocationST->fetch(PDO::FETCH_ASSOC);

    if ($rowCount > 0) {
        $_SESSION['location'] = $locationData['Location'];
    } else {
        $_SESSION['location'] = "Enter ur location inorder to order ";
    }

    $_SESSION['IS_LOGGED_Customer'] = TRUE;
    $_SESSION['LAST_ACTIVITY_Customer'] = time();

    header('Location: ../pages/profile.php');
} else {
    header('Location: ../index.php');
    return false;
}

?>
