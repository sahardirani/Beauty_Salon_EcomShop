<?php

require_once 'setup.php';

//echo'test';
function FetchAllProducts5($category) {
    $conn = dbConnect();
  //  echo'test34';
    if ($category == "AllProduct") {
        $Query = "SELECT * FROM PRODUCT";
    } else {
        $Query = "SELECT * FROM PRODUCT WHERE PRODUCT_CATEGORY='$category'";
    }

    $stmt = $conn->prepare($Query);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Encode image data in base64
    foreach ($products as &$product) {
        $product["IMAGE"] = base64_encode($product["IMAGE"]);
    }

    return $products;
}


if (isset($_GET['category'])) {
    $category = $_GET['category'];
    $products = FetchAllProducts5($category);

    echo json_encode($products);
}


?>