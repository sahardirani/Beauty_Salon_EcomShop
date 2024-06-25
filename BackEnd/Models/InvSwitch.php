<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once  'Products.php';

if (isset($_POST['category'])) {
    $category = $_POST['category'];

    $products = FetchAllProducts($category);
    // echo $products[0]['PRODUCT_NAME'];
  
    $json = json_encode($products);
if ($json === false) {
    echo "JSON encoding error: " . json_last_error_msg();
} else {
    echo $json;
}
    exit();
}


// Switch for deleting the Product :
if (isset($_POST['action']) && $_POST['action'] == 'delete_product' && isset($_POST['product_id'])) {
        $productId = $_POST['product_id'];
        //echo"test";
        deleteProduct($productId);
}

if (isset($_POST['action']) && $_POST['action'] == 'search_product' && isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];
    echo"test";
    //getProductByID($productId);
}



?>
