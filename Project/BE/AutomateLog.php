<?php
session_start();

if (isset($_POST['userData'])) {
    $userDataJson = $_POST['userData'];
    $userData = json_decode($userDataJson, true); // Convert JSON string to an associative array

    // Store user data in session variables
      $_SESSION['user_id'] = $userData['ID'];
      $_SESSION['email'] = $userData['EMAIL'];
      $_SESSION['first_name'] = $userData['FIRST_NAME'];
      $_SESSION['last_name'] = $userData['LAST_NAME'];
      $_SESSION['Birthdate'] = $userData['Date_Of_Birth'];
      $_SESSION['PhoneNumber']=  $userData["Phone_Number"];

print_r( $userDataJson);
    echo "User data stored in session successfully.";
} else {
    echo "error";
}

?>
