<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../Common/setup.php';

if (isset($_GET['category']) && isset($_POST['action']) && $_POST['action'] == 'FetchAllProducts') {
    $category = $_GET['category'];
   // $products = FetchAllProducts($category);
echo"hii";
   // echo json_encode($products);
}

function FetchAllProducts($category) {

    $conn = dbConnect();
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
    
    

if (isset($_POST['action']) && $_POST['action'] == 'AddCategoryTodatabase' && isset($_POST['Category_Name']) && isset($_POST['Display_Name']) ) {
    // Retrieve form data
    $categoryName = $_POST['Category_Name'];
    $displayName = $_POST['Display_Name'];

    AddCategory($categoryName, $displayName);
}

function AddCategory($categoryName, $displayName) {
    $conn = dbConnect();
    
    // Prepare the SQL statement using placeholders
    $query = "INSERT INTO PRODUCT_CATEGORY (Category_Name, Display_Name) VALUES (:categoryName, :displayName)";
    $stmt = $conn->prepare($query);

    // Bind the parameters to the placeholders
    $stmt->bindParam(':categoryName', $categoryName, PDO::PARAM_STR);
    $stmt->bindParam(':displayName', $displayName, PDO::PARAM_STR);

    // Execute the SQL statement
    if ($stmt->execute()) {
        echo "Added successfully";
    } else {
        echo "Error";
    }
}





if (isset($_POST['action']) && $_POST['action'] == 'add_product' && isset($_POST['product_name']) && isset($_POST['product_quantity']) && isset($_POST['product_category']) 
     && isset($_POST['product_price'])  ) {
    
        $product_name = $_POST["product_name"];
        $product_quantity = $_POST["product_quantity"];
        $product_category = $_POST["product_category"];
        $product_price = $_POST["product_price"];
        $productDescription = $_POST["productDescription"];

        $product_image_tmp = $_FILES["product_image"]["tmp_name"];
        $filename_parts = pathinfo($_FILES["product_image"]["name"]);
        $file_extension = $filename_parts["extension"];
        $unique_id = uniqid();
        $product_image_name = $unique_id . "." . $file_extension;
        $product_image_data = file_get_contents($product_image_tmp);

        
        $sale_percentage = isset($_POST["product_sale_percentage"]) ? $_POST["product_sale_percentage"] : 0;
       
        addProduct($product_name , $product_quantity ,$product_category, $product_price , $product_image_data , $sale_percentage,$productDescription );
    }
    

  
    function addProduct($product_name , $product_quantity ,$product_category, $product_price , $product_image_data , $sale_percentage ,$productDescription)
    {

        

    $EndPrice = (1 - ($sale_percentage / 100)) * $product_price;

    $conn = dbConnect();
    $sql = "INSERT INTO PRODUCT (PRODUCT_NAME, PRODUCT_QUANTITY, PRODUCT_CATEGORY, PRICE, IMAGE, SALE,EndPrice,Description)
            VALUES (?, ?, ?, ?, ?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $product_name);
    $stmt->bindParam(2, $product_quantity);
    $stmt->bindParam(3, $product_category);
    $stmt->bindParam(4, $product_price);
    $stmt->bindParam(5, $product_image_data, PDO::PARAM_LOB);
    $stmt->bindParam(6, $sale_percentage);

    if($sale_percentage==0){
        $stmt->bindParam(7,$product_price );
    }
    else {
        $stmt->bindParam(7, $EndPrice); 
    }

    $stmt->bindParam(8, $productDescription );
    $stmt->execute();
    



    
   }
  


  function deleteProduct($productId) {
    $conn = dbConnect();
    $sql = "DELETE FROM PRODUCT WHERE PRODUCT_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $productId);
    $stmt->execute();
    echo"done ";
  }


  if (isset($_POST['action']) && $_POST['action'] == 'search_product' && isset($_POST['search_product_id'])) {
    $productId = $_POST['search_product_id'];
    $product = getProductByID($productId);
    echo json_encode($product);
}

function getProductByID($productId) {
    $conn = dbConnect();
    //return "hello";
   try {
        $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :product_id";
        $statement = $conn->prepare($query);
        $statement->bindParam(':product_id', $productId);
        $statement->execute();
        $product = $statement->fetch(PDO::FETCH_ASSOC);

        $product["IMAGE"] = base64_encode($product["IMAGE"]);



        return $product;
    } catch (PDOException $e) {
        echo "Error fetching product: " . $e->getMessage();
        return null;
    }
}



if (isset($_POST['action']) && $_POST['action'] == 'update_Product') {
   
    $EndPrice = 0;
   // echo"okay just a test";
    $conn = dbConnect();
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productCategory = $_POST['product_category'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $sale = $_POST['sale'];

    if($sale==0){
        $EndPrice=$price ;
    }
    else {
        $EndPrice= (1 - ($sale / 100)) * $price;
    }

    $stmt = $conn->prepare("UPDATE PRODUCT SET PRODUCT_NAME='$productName', PRODUCT_CATEGORY='$productCategory', PRICE='$price ', PRODUCT_QUANTITY='$quantity', SALE='$sale', EndPrice='$EndPrice' WHERE PRODUCT_ID='$productId' ");
    $stmt->execute();
    echo"success";

}






?>
