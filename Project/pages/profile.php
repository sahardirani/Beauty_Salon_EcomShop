<?php
require_once 'Common/Menu.php';
require_once '../../BackEnd/Common/setup.php' ;
require_once '../FE/Controllers/dashBoard.php';
require_once '../FE/Views/AccountViewer.php';

authenticationCustomers();
session_start();
?>
<html>
    <head>
      
        
        <link rel="stylesheet" href="../css/mystylesheet.css?v=1.1">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="../css/profileLook.css?v=1.1">

        <title>Profile</title>
      


        
    </head>



    <?php profileView(); ?>
    <?php profileControllers(); ?>



    </body>
    
</html>





