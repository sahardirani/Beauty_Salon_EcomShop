<?php


/**
 * Admin header page 
 */
function DisplayHeader(){
    ?> 
        <div class="row header " >
            <div id="dropdown">
                <span><i class='icon'></i>MENU</span>            
                <div class="dropdown-content">
                    <ul>
                        <a href="HomePage.php">
                        <li class="dropdown-item">
                            Home 
                        </li>
                        </a>

                        <a href="CreateUser.php">
                        <li class="dropdown-item">
                        Manage Users
                        </li>
                        </a>
                        <a href="AddProducts.php">
                        <li class="dropdown-item">
                           Manage Products
                        </li>
                        </a>
                        <a href="Bookings.php">
                        <li class="dropdown-item">
                            View Booking
                        </li>
                        </a>



                        <a href="transaction.php">
                        <li class="dropdown-item">
                            Orders
                        </li>
                        </a>

                        <a href="Inventory.php">
                        <li class="dropdown-item">
                            View Inventory
                        </li>
                        </a>

                        <a href="LogOut.php">
                        <li class="dropdown-item">
                            log out
                        </li>
                        </a>
                    </ul>
                </div>
              </div>           
        <?php
}

/**
 * DataBase Connection 
 */
function dbConnect(){
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'Users';
    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //  echo'connected';
       return $conn;
    } catch(PDOException $e) {
  // echo'not connected';
   return null;
    }
}

/**
 *  authentication for admin users 
 */
function authentication(){

    session_start();

    $timeout_duration = 3600; // 30 minutes in seconds
    if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
        session_unset();
        session_destroy();
        header('Location: LogIN.php?timeout=1'); // Redirect to login page with timeout message
    }
   



    if(!isset($_SESSION['ROLE']) || !isset($_SESSION['USERNAME']) || !isset($_SESSION['IS_LOGGED']) ) {
    header("Location: LogIN.php");
    exit();
}


}
/**
 * Note that this function can be modifiedand to  have a better architecture , a proposed solution is to have the roles and the access 
 * granteted options stored in a database , where we will have a function to get roles that can access a specific page and a getUserRole() method and
 * and compare it with what we have -->(so we need to have a loop (to loop over the access acceptance of a role ) and an if statement to check it  )
 * thus this will lead into the idea of scaling the admin page to dont need to change much in the code Base and to do this thing we have it as a 
 * configration 
 */

function role($page){

    if($page=='Booking'){
    
        if ($_SESSION['ROLE'] == 'shopper') {
            echo "<script>alert('You don\'t have access to this page.'); window.location.href = 'Homepage.php';</script>";
            exit;
        }
    
       
    }
    if ($page == 'CreateUsers') {
        if ($_SESSION['ROLE'] != 'executive') {
            echo "<script>alert(\"You don't have access to this page. Only executives can add users. Your role is {$_SESSION['ROLE']}\"); window.location.href = 'Homepage.php';</script>";
            exit;
        }
    }
    if ($page == 'Add') {
        if ($_SESSION['ROLE'] == 'receptionist') {
            echo "<script>alert(\"You don't have access to this page. Only executives can add users. Your role is {$_SESSION['ROLE']}\"); window.location.href = 'Homepage.php';</script>";
            exit;
        }
    }
    if ($page == 'Invetory') {
        if ($_SESSION['ROLE'] == 'receptionist') {
            echo "<script>alert(\"You don't have access to this page. Only executives can add users. Your role is {$_SESSION['ROLE']}\"); window.location.href = 'Homepage.php';</script>";
            exit;
        }
    }
    
    
}

/**
 * Set up all the admin users in one place 
 */

function AdminUsers(){
    $conn =  dbConnect();
    $query = "SELECT ID, USERNAME, ACTIVITY FROM ADMIN_USERS; ";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    
 return $data;
 }
 
 /**
  * dynamic fetch category 
  */
 function fetchCategory(){

    $conn = dbConnect();
    $sql = "SELECT Display_Name, Category_Name FROM PRODUCT_CATEGORY";
    
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo"test";
    return $images;
    }


if (isset($_POST['action']) && $_POST['action'] == 'User_activity' && isset($_POST['user_id'])  && isset($_POST['activity'])    ) {
    
    $id = intval($_POST['id']);
    $activity = intval($_POST['activity']);
    Activity_Check($id ,$activity );
  
} 

function Activity_Check($user_id,$activity){


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['user_id']) && isset($_POST['activity'])) {
          session_start();   
          $userId = $_POST['user_id'];
          $isActive = $_POST['activity'];
          
       
          if( $userId==$_SESSION['ID']){
           
              echo json_encode(['status' => 'error', 'message' => 'Can not do operation on an opened Account. And the status will stay active']);
              exit;
          }
          else if($userId!=$_SESSION['ID']){
      
          // Update the user's activity status in the database
          $conn = dbConnect();
          $stmt = $conn->prepare("UPDATE ADMIN_USERS SET ACTIVITY = ? WHERE ID = ?");
          $stmt->execute([$isActive, $userId]);
      
          echo json_encode(['status' => 'success']);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid parameters']);
      }
        }
      } else {
      echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
      }
      
      
    }
    

    function authenticationCustomers() {

        session_start();
    
        $timeout_duration = 3600; // 30 minutes in seconds
        if (isset($_SESSION['LAST_ACTIVITY_Customer']) && (time() - $_SESSION['LAST_ACTIVITY_Customer']) > $timeout_duration) {
            session_unset();
            session_destroy();
           // header('Location: LogIN.php?timeout=1'); // Redirect to login page with timeout message
        }

        if(!isset($_SESSION['email']) || !isset($_SESSION['first_name']) || !isset($_SESSION['IS_LOGGED_Customer']) ) {
            header("Location: ../../Project/pages/Loggin.php");
            exit();
        }
        
    
    
    
        
    
    
    }
    





?>
