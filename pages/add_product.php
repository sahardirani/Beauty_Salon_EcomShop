<?php
require_once '../BackEnd/Common/setup.php';



// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $product_name = $_POST["product_name"];
  $product_quantity = $_POST["product_quantity"];
  $product_category = $_POST["product_category"];
  $product_price = $_POST["product_price"];
  $product_image_tmp = $_FILES["product_image"]["tmp_name"];
  $filename_parts = pathinfo($_FILES["product_image"]["name"]);
  $file_extension = $filename_parts["extension"];
  $unique_id = uniqid();
  $product_image_name = $unique_id . "." . $file_extension;

  // Read the contents of the image file into a variable
  $product_image_data = file_get_contents($product_image_tmp);


  $sale_percentage = isset($_POST["product_sale_percentage"]) ? $_POST["product_sale_percentage"] : 0;

  // Insert the product into the database
  $conn = dbConnect();
  $sql = "INSERT INTO PRODUCT (PRODUCT_NAME, PRODUCT_QUANTITY, PRODUCT_CATEGORY, PRICE, IMAGE, SALE)
          VALUES (?, ?, ?, ?, ?,?)";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(1, $product_name);
  $stmt->bindParam(2, $product_quantity);
  $stmt->bindParam(3, $product_category);
  $stmt->bindParam(4, $product_price);
  $stmt->bindParam(5, $product_image_data, PDO::PARAM_LOB);
  $stmt->bindParam(6, $sale_percentage);
  $stmt->execute();
  
 }





?>


