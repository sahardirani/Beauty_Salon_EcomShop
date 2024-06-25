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
    <link rel="stylesheet" href="../css/stylebooking.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Booking</title>
    <script>
     
    </script>
</head>

<body>


<?php BookView(); ?>


       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
       
<?php bookinfDash(); ?>
      

    </body>

</html>