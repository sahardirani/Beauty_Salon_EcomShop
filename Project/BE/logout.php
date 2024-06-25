<?php
require_once "../../BackEnd/Common/setup.php";
session_start();

$conn = dbConnect();

// retrieve the sessionId from the POST data
$sess = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
/*if (!$sess) {
  
}
*/
// update the previous cart record with the new session ID
$updateCart = "UPDATE PreviousCart SET PreviousSession = :sess WHERE CustomerEmail = :customerEmail";
$st = $conn->prepare($updateCart);
$st->bindValue(':sess', $sess, PDO::PARAM_STR);
$st->bindValue(':customerEmail', $_SESSION['email'], PDO::PARAM_STR);
$st->execute();

// destroy the session
$_SESSION = array();
session_destroy();

ob_start();
header('Location: ../index.php');
ob_end_flush();
exit();
?>

