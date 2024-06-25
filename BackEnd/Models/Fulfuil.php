<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../Common/setup.php";



if (isset($_POST['action']) && $_POST['action'] == 'orders') {
  $orders = checkOrders();
  // You may want to return or output the data in a specific format (e.g., JSON)
  header('Content-Type: application/json');
  echo json_encode($orders);
  exit;
}

function checkOrders() {
  $conn = dbConnect();
  $sql = "SELECT * FROM Orders WHERE Fulfilled = 0";
  $stmt = $conn->prepare($sql);
  $stmt->execute();

  $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

  return $orders;
}

function updateOrderStatus($id) {
  try {
      $pdo = dbConnect();

      $stmt = $pdo->prepare("UPDATE Orders SET Fulfilled = 1 WHERE OrderID = :id");
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

if (isset($_POST['action']) && $_POST['action'] == 'Done' && isset($_POST['id'])) {
  $id = $_POST['id'];
  updateOrderStatus($id);
}








?>