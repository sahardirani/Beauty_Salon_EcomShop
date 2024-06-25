<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../../BackEnd/Common/setup.php";

$conn = dbConnect();

// Check if the action is 'InsertCart'
if (isset($_POST['action']) && $_POST['action'] == 'InsertCart' && isset($_POST['id']) && isset($_POST['session_id'])) {
    $id= $_POST['id'];
    $session_id = $_POST['session_id'];
    InsertNewCart($id, $session_id, $conn);
}

function InsertNewCart($id, $session_id, $conn) {
    // Insert the empty cart into the database
    $insertCart = "INSERT INTO Carts (SessionID, CustomerID, CartData) VALUES ('$session_id', '$id', '')";
    $st = $conn->prepare($insertCart);
    $st->execute();
   /// echo'success';
    echo json_encode(array('success' => true, 'message' => 'Cart inserted successfully'));
        
    exit;
}






if (isset($_POST['action']) && $_POST['action'] == 'SaveCart' && isset($_POST['cart']) && isset($_POST['session_id']) &&  isset($_POST['id']) ) {
    $cart= $_POST['cart'];
    $id= $_POST['id'];
    $session_id = $_POST['session_id'];



    SaveOldCart($id, $session_id, $conn,$cart);
}

function SaveOldCart($id, $session_id, $conn, $cart) {

    // Insert the empty cart into the database
    $insertCart = "INSERT INTO Carts (SessionID, CustomerID, CartData) VALUES ('$session_id', '$id', '$cart')";

    $st = $conn->prepare($insertCart);
    $st->execute();
   /// echo'success';
   echo json_encode(array('success' => true, 'message' => 'Cart inserted successfully'));

        
    exit;
}





if (isset($_POST['action']) && $_POST['action'] == 'GetCart' && isset($_POST['id']) && isset($_POST['session_id'])) {
    $id = $_POST['id'];
    $session_id = $_POST['session_id'];
    $cartData = GetCart($id, $session_id, $conn);
    echo json_encode(array('success' => true, 'message' => 'Cart retrieved successfully', 'cartData' => $cartData));
    exit;
}

function GetCart($id, $session_id, $conn) {
    // Get the cart data from the database
    $getCart = "SELECT CartData FROM Carts WHERE CustomerID = '$id' AND SessionID = '$session_id'";
    $st = $conn->prepare($getCart);
    $st->execute();
    $row = $st->fetch(PDO::FETCH_ASSOC);
    $cartData = json_decode($row['CartData'], true);
    return $cartData;
}




if (isset($_POST['action']) && $_POST['action'] == 'displayCart' &&   isset($_POST['cart'])) {
   
    $cartData = $_POST['cart'];
   displayCartInfo($cartData);
  // print_r( $cartData );
    
}
function displayCartInfo($cartData) {
    
    $conn = dbConnect();
    $cart = $cartData;
    $products = array();

    foreach ($cartData as $productId => $productData) {

        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :product_id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':product_id', $productId);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        $product["IMAGE"] = base64_encode($product["IMAGE"]);
        $product["PRODUCT_QUANTITY"]=$productData['quantity'];
        $products[] = $product;
    }

    echo json_encode($products);
}



if (isset($_POST['action']) && $_POST['action'] == 'checkOut' &&
    isset($_POST['cart']) && isset($_POST['location']) &&
    isset($_POST['session_id']) && isset($_POST['phoneNumber']) &&
    isset($_POST['id']) &&  isset($_POST['TotalMoney'])) {
    
    // Assign the values to variables
    $cart = $_POST['cart'];
    $location = $_POST['location'];
    $sessionId = $_POST['session_id'];
    $phoneNumber = $_POST['phoneNumber'];
    $customerID = $_POST['id'];
    $Money = $_POST['TotalMoney'];

    // Pass the variables to the function
    CheckOut($cart, $location, $sessionId, $phoneNumber, $customerID,$Money ,$conn);

    echo "catched";
}

function CheckOut($cart, $location, $sessionId, $phoneNumber, $customerID,$Money, $conn) {
    
   
    $insertOrder = "INSERT INTO Orders (CustomerID,CartData,Location,CustomerNumber,Fulfilled,sessionID,Cost) VALUES 
    ( '$customerID' , '$cart', '$location','$phoneNumber',0 ,'$sessionId','$Money')";
    $st = $conn->prepare($insertOrder);
    $st->execute();

    echo"inserted";




}









?>
