<?php
session_start();

$_SESSION = array(); // clear all session variables

session_destroy(); // destroy session

header("Location: LogIN.php"); // redirect to login page
exit;

?>