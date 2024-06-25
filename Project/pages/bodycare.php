<?php
require_once '../../BackEnd/Common/setup.php';
require_once 'Common/Menu.php';
require_once '../FE/Controllers/dashBoard.php';
require_once '../FE/Views/AccountViewer.php';
?>

<html>
    <head>
    <head>
    <link rel="stylesheet" href="../css/mystylesheet.css?v=1.1">
     <link rel="stylesheet" href="../css/Products.css?v=1.1">
   <style>
   
  
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Body Care</title>
    </head>
    <body>  
     



    <?php ProductsView();?>


    <?php  productsControlles(); ?>




    </body>
</html>



