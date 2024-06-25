<?php
require_once 'Common/Menu.php';
require_once '../../BackEnd/Common/setup.php' ;
require_once '../FE/Controllers/dashBoard.php';
require_once '../FE/Views/AccountViewer.php';

authenticationCustomers();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="author">
	<title>Cart</title>

	
	<link rel="stylesheet" href="../css/style.css">
	<link rel="stylesheet" href="../css/demo.css">
	<link rel="stylesheet" href="../css/header.css">
	<style>
		.fixed-menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 9999;
}
#cart {
  margin-top: 100px;
  z-index: 9998;
}
header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #fff;
  z-index: 999;
}

</style>


</head>

<body>




  <?php CartView(); ?> 
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<?php CartManagment(); ?>




</body>
</html>