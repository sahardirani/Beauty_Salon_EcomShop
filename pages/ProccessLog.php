<?php

include "../BackEnd/Common/setup.php"; 

   
    $username = $_POST['username'];
    $password = $_POST['password'];


    $conn = dbConnect();

    $query = "Select ID,ROLE,USERNAME FROM  ADMIN_USERS  WHERE USERNAME='$username' AND PASSWORD=PASSWORD('$password') AND ACTIVITY=1";
    

    $stmt = $conn->prepare($query);
    $stmt->execute();


    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        session_start();
        $_SESSION['ROLE'] = $result['ROLE'];
        $_SESSION['USERNAME'] = $result['USERNAME'];
        $_SESSION['ID'] = $result['ID'];
        $_SESSION['IS_LOGGED'] = TRUE;
        $_SESSION['LAST_ACTIVITY'] = time(); 

        // Set the session timeout to 30 minutes
      

        header('Location: HomePage.php');
    } else {
        // Login failed
        header('Location: login.php?error=1');
    }



?>