<?php

require_once '../BackEnd/Common/setup.php';

   
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    
    $conn = dbConnect();
    $query = "INSERT INTO ADMIN_USERS (USERNAME,PASSWORD,ROLE,ACTIVITY) VALUES ('$username',PASSWORD('$password'),'$role',1)";
   // echo$query ;
    $stmt = $conn->prepare($query);
    $stmt->execute();


    echo"Account Created Successfully\n";

    echo" <a href='CreateUser.php'>go  back   </a> "





?>
