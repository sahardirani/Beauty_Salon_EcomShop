<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once "../../BackEnd/Common/setup.php";
session_start();

class UserController
{
    private $conn;

    public function __construct()
    {
        $this->conn = dbConnect();
    }
    public function verifyOTP($email, $firstName, $code)
    {
        $Select = "Select OTP FROM OTP_requests  WHERE EMAIL='$email' ";
        $See = $this->conn->prepare($Select);
        $See->execute();
        $rowCount =  $See->rowCount();
    
        if (!empty($email) && !empty($firstName) ) {
            $row = $See->fetch();
            $fetchedOTP = $row['OTP'];
            $submittedCode = $code;

          //  echo "Fetched OTP: " . $fetchedOTP . "\n";
          //  echo "Submitted code: " . $submittedCode . "\n";
            
            if (($rowCount > 0) && ($fetchedOTP == $submittedCode)) {
                $UpdateOTP = "UPDATE USERS_TABLE SET Verified = TRUE WHERE EMAIL='$email' ";
                $OTP_ST = $this->conn->prepare($UpdateOTP); // <-- Fix here
                $OTP_ST->execute();
    
                // Get user data
                $getUser = "SELECT * FROM USERS_TABLE WHERE EMAIL='$email' ";
                $getUserST = $this->conn->prepare($getUser); // <-- Fix here
                $getUserST->execute();
                $userData = $getUserST->fetch(PDO::FETCH_ASSOC);
    
                return $userData; // return user data
            } else {
                return false;
            }
        } else {
            echo "error";
        }
    }
    public function updateProfile($userId, $firstName, $lastName, $location, $phoneNumber, $birthday)
    {
        $query = "UPDATE USERS_TABLE SET FIRST_NAME = :firstName, LAST_NAME = :lastName, PHONE_NUMBER = :phoneNumber, DATE_OF_BIRTH = :birthday WHERE ID = :userId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':userId', $userId);

        $result = $stmt->execute();

           
      

    $getLocation = "SELECT * FROM Customer_address WHERE CustomerID='$userId'";
    $getUserLocationST = $this->conn->prepare($getLocation);
    $getUserLocationST->execute();
    $rowCount = $getUserLocationST->rowCount();
    $locationData = $getUserLocationST->fetch(PDO::FETCH_ASSOC);

    if ($rowCount > 0) {
        $query2 = "UPDATE Customer_Address SET Location = :location WHERE CustomerID = :user";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':location', $location);
        $stmt2->bindParam(':user', $userId);
        $result2 = $stmt2->execute();

        $_SESSION['location'] = $location;
    } else {
        $query2 = "INSERT INTO Customer_Address (CustomerID, Location) VALUES (:userId, :location)";
        $stmt2 = $this->conn->prepare($query2);
        $stmt2->bindParam(':userId', $userId);
        $stmt2->bindParam(':location', $location);
        $stmt2->execute();

        $_SESSION['location'] = $location;
    }






    if ($result) {
        $_SESSION['first_name'] = $firstName;
        $_SESSION['last_name'] = $lastName;
        $_SESSION['Birthdate'] = $birthday;
        $_SESSION['PhoneNumber'] = $phoneNumber;
        return "Profile updated successfully";
    } else {
        return "Error updating profile";
    }





    }
    

    public function sendMail($email, $firstName)
    {
        $conn = dbConnect();
        $random_number = mt_rand(100000, 999999);
    
        $checkOTP = "Select * From OTP_requests Where EMAIL='$email' ";
        $stOTP = $conn->prepare($checkOTP);
        $stOTP->execute();
        $row_countOTP = $stOTP->rowCount();
        if ($row_countOTP > 0) {
            $UpdateOTP = "UPDATE OTP_requests SET OTP = '$random_number'  WHERE EMAIL='$email' ";
            $OTP_ST = $conn->prepare($UpdateOTP);
            $OTP_ST->execute();
        } else {
            $query2 = "INSERT INTO OTP_requests (EMAIL,OTP) VALUES ('$email','$random_number')";
            $stmt2 = $conn->prepare($query2);
            $stmt2->execute();
        }
    
        $to = $email;
        $subject = "Verify Your Email Address";
        $message = "Hello " . $firstName . ",\n\n" .
            "Thank you for signing up for our website. To complete your registration, please click on the following link and enter the verification code: " .
            "Please enter this Code for this Email: " . $email . " code= " . $random_number . "\n\n" .
            "If you did not sign up for our website, please ignore this email.\n\n" .
            "Best regards,\n" .
            "Mostafa fatayri";
    
        $headers = "From: mostafafatayri@yahoo.com";
    
        echo"going";
        mail($to, $subject, $message, $headers);
        echo"recieved";

    }

    public function registerUser($email, $firstName, $lastName, $password, $confirmPassword)
    {
        

        $check = "Select * From USERS_TABLE Where EMAIL='$email' ";
        $st = $conn->prepare($check);
        $st->execute();
        $row_count = $st->rowCount();
        
        if ($row_count > 0) {
            // echo "Error: Email already exists in database";
            exit();
        } else {
            $query = "INSERT INTO USERS_TABLE (EMAIL,FIRST_NAME,LAST_NAME,PASSWORD,DATE_CREATE,MODIFICATION_DATE,ACTIVITY,VERIFIED) VALUES ('$email','$firstName','$lastName',PASSWORD('$password'),NOW(),NOW(),1,FALSE)";
            $stmt = $conn->prepare($query);
            $stmt->execute();
        
           // sendMail($email, $firstName);
        
            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Redirecting</title>
            </head>
            <body>
                <form id="redirectForm" action="resendMail.php" method="POST" style="display:none;">
                    <input type="hidden" name="email" value="' . htmlspecialchars($email) . '">
                    <input type="hidden" name="firstName" value="' . htmlspecialchars($firstName) . '">
                </form>
                <script>
                    document.getElementById("redirectForm").submit();
                </script>
            </body>
            </html>
            ';
        }


    }
}

$controller = new UserController();

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'verifyOTP':
    //  echo"Suiii";
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $code = isset($_POST['code']) ? $_POST['code'] : array();
    $mergedCode = implode("", $code);
   // echo$mergedCode;
  
   $result = $controller->verifyOTP($email, $firstName,  $mergedCode );
   if ($result) {
    // Verification successful, return status and user data
    echo json_encode(array('status' => 'success', 'userData' => $result));
   } else {
    //print_r(  $result);
    echo json_encode(array('status' => 'mismatch'));
    }

        break;

    case 'update_profile':
            $userId = $_SESSION['user_id'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $location = $_POST['location'];
            $phoneNumber = $_POST['phoneNumber'];
            $birthday = $_POST['birthday'];
            $result = $controller->updateProfile($userId, $firstName, $lastName, $location, $phoneNumber, $birthday);
         
          /*  echo $userId ;
            echo $firstName  ;
            echo $lastName ;
            echo $location  ;
            echo $phoneNumber ;

            echo  $birthday  ;
            echo $phoneNumber ;
*/

            
           echo json_encode(array('status' => $result));
          //  echo"arrived";
            break;

    case 'sendMail':
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
        $controller->sendMail($email, $firstName);
        break;
    case 'registerUser':
        $email = $_POST['email'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $controller->registerUser($email, $firstName, $lastName, $password, $confirmPassword);
        break;
    default:
        echo "Invalid action";
        break;
}


?>



