<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../Common/setup.php";




if (isset($_POST['action']) && $_POST['action'] == 'checkIfAvialble' &&  isset($_POST['Date']) && isset($_POST['Time'])  &&  isset($_POST['firstname']) 
&& isset($_POST['lastname'])  && isset($_POST['phoneNb'])   && isset($_POST['Email']) &&  isset($_POST['Service'])) {

    $date = $_POST['Date'];
    $time = $_POST['Time'];
    $name = $_POST['firstname'];
    $Lname = $_POST['lastname'];
    $phone = $_POST['phoneNb'];
    $email = $_POST['Email'];
    $ServiceCh = $_POST['Service'];

 
 
   $isAvailable =checkAvailability($date, $time,$name , $Lname, $phone, $email , $ServiceCh  ) ;
   header('Content-Type: application/json');
   echo json_encode(['isAvailable' => $isAvailable]);
   exit();

}
/**
 * 
 * @param date,time ,nameofCustomer,phone,email,service and stores it in the database
 * 
 */

function checkAvailability($date, $time,$name , $Lname, $phone, $email , $ServiceCh  ) {
    $conn = dbConnect();
    $sql = "SELECT * FROM BOOKING WHERE TIME = :time AND BOOKING_DATE = :date  and Service='$ServiceCh'  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':date', $date);
  //  $stmt->bindParam(':Service', $ServiceCh );
    $stmt->execute();

    $rowCount = $stmt->rowCount();
    
    

    if ($rowCount < 3 ){
  
        $insertOrder = "INSERT INTO BOOKING (EMAIL,FIRST_NAME , LAST_NAME,TIME,BOOKING_DATE,DATE_CREATE,STATUS,Service) VALUES 
        ( '$email', '$name', '$Lname','$time','$date' ,now(),0,'$ServiceCh')";
        $st = $conn->prepare($insertOrder);
        $st->execute();
    


}
return $rowCount < 3 ;



}

/**
 * handels the booking management system : 
 */
function update_booking_status($id) {
  try {
      $pdo = dbConnect();

      $stmt = $pdo->prepare("UPDATE BOOKING SET STATUS = 1 WHERE BOOK_ID = :id");
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);

      if ($stmt->execute()) {
          echo "success";
          exit;

      } else {
          echo "failed";
          exit;
      }
  } catch (PDOException $e) {
      error_log($e->getMessage());
      echo "error";
  }
}

if (isset($_POST['action']) && $_POST['action'] == 'update_status' && isset($_POST['id'])) {
  $id = intval($_POST['id']);
  update_booking_status($id);
} 




?>