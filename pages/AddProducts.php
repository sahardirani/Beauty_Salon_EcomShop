<?php
//require_once 'Common/function.php';
require_once '../BackEnd/Common/setup.php';
require_once '../FE/Controls/AdminActions.php';
authentication();
$page = 'Add';
role($page);

?>
<html>
    <head>
     <link rel="stylesheet" href="../css/style.css"> 
     <link rel="stylesheet" href="../css/products.css"> 
     <title>
     </title>
      <!-- Include jQuery if it's not already included -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    </head>
    <body>
    <div class="row1 header1" >
<?php DisplayHeader(); ?>     
</div>


       <br>
       <br>
       
<h2>Add Products:</h2>


<div class="container">

<form id="addProductForm" method='POST' enctype="multipart/form-data">
<input type="hidden" name="action" value="add_product">

    <div style="display: flex; flex-direction: column; align-items: center;">
      <div style="width: 100%;">
        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>
      </div>

      <div style="width: 100%;">
        <label for="product_quantity">Product Quantity:</label>
        <input type="number" id="product_quantity" name="product_quantity" required>
      </div>
      <div style="width: 100%;">
        <label for="productDescription">Product Description:</label>
        <input type="text" id="productDescription" name="productDescription" required>
      </div>

      <div style="width: 100%;">
        <label for="product_category">Product Category:</label>
    <select id="product_category" name="product_category" required>
        <?php
        $result = fetchCategory();
        foreach($result as $category  ){
         echo "<option value=\"" . $category["Category_Name"] . "\">" . $category["Display_Name"]. "</option>";}
        ?>
    </select>
      </div>

      <div style="width: 100%;">
        <label for="product_price">Product Price:</label>
        <input type="number" id="product_price" name="product_price" required>
      </div>

      <div style="width: 100%;">
        <label for="product_sale">Sale:</label>
        <div class="sale-label">
          <input type="radio" id="sale_yes" name="sale" value="yes" onclick="showSalePercentage()">
          <label for="sale_yes">Yes</label>
        </div>


        <div class="sale-label">
          <input type="radio" id="sale_no" name="sale" value="no" checked onclick="hideSalePercentage()">
          <label for="sale_no">No</label>
        </div>
      </div>

     <!-- ... -->
      <div class="sale-input" id="product_sale_percentage_input">
     <label for="product_sale_percentage">Sale Percentage:</label>
     <input type="number" id="product_sale_percentage" name="product_sale_percentage" min="0" max="100" value="0">
     </div>
<!-- ... -->
 

      <div style="width: 100%;">
        <label for="product_image">Product Image:</label>
        <input type="file" id="product_image" name="product_image" required>
      </div>
    </div>

    <input type="submit" value="Add Product" class='butn'>
  </form>


  


  
</div>

<h2>Add Category:</h2>

<!--<div class="container">-->
        <form id="CategoryForm" method="POST">
            <div style="display: flex; flex-direction: column; align-items: center;">
                <div style="width: 100%;">
                    <label for="Category_Name">Category_Name:</label>
                    <input type="text" id="Category_Name" name="Category_Name" required>
                </div>
                <div style="width: 100%;">
                    <label for="Display_Name">Display_Name:</label>
                    <input type="text" id="Display_Name" name="Display_Name" required>
                </div>
                <input type="submit" value="Add Category" class="butn">
            </div>
        </form>
  <!--  </div> -->

  <h2>Fetch Product Details: </h2>

<form id="SearchProduct" method="POST">
  <div style="display: flex; flex-direction: column; align-items: center;">
    <div style="width: 100%;">
      <label for="ID_product">Product_ID:</label>
      <input type="number" id="search_product_id" name="search_product_id" placeholder="Enter product ID">
    </div>
    <input type="submit" value="Search" class="butn">
  </div>
</form>

<div id="product-details"></div>





<?php productManagment();?>

</body>
</html>