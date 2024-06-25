<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../BackEnd/Common/setup.php';
require_once '../FE/Controls/AdminActions.php';

//require_once '../BackEnd/Models/Fulfuil.php';
authentication();
$page = 'transaction';
role($page);


?>
<!DOCTYPE html>
<html>

<head>
<!--  <link rel="stylesheet" href="../css/tables.css">-->
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/tables.css"> 
    <style>


.Delete {
  background-color: red; 
  font-size: 0.7em;  
  border-radius: 5px;"
}
    </style>
    <title>Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="row1 header1" >
<?php DisplayHeader(); ?>     
</div>


      <br>
      <br>

    <h1>Fulfillment Center</h1>
    
    <table>
        <thead>
            <tr>
                <th>Order</th>
                <th>CustomerID</th>
                <th>Cart</th>
                <th>Location</th>
                <th>Number</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
      
        </tbody>
    </table>


 
      <?php FuilfullCenter();?>


</body>
</html>