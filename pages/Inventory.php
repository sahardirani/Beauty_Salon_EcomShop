<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../BackEnd/Common/setup.php';

authentication();
$page = 'Invetory';
role($page);


?>
<!DOCTYPE html>
<html>

<head>
<!--  <link rel="stylesheet" href="../css/tables.css">-->
    <link rel="stylesheet" href="../css/style.css"> 
    <style>

table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
}

img {
    width: 50px;
    height: auto;
}
.Delete {
  background-color: red; 
  font-size: 0.7em;  
  border-radius: 5px;"
}
    </style>
    <title>Booking</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="row1 header1" >
<?php DisplayHeader(); ?>     
</div>


      <br>
      <br>

    <h1>Inventory Management</h1>
    <select id="product_category" name="product_category" required>
        
        <?php
        $result = fetchCategory();
        foreach($result as $category  ){
         echo "<option value=\"" . $category["Category_Name"] . "\">" . $category["Display_Name"]. "</option>";}
        ?>
    </select>
    <table>
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Sale %</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
      
        </tbody>
    </table>


 
       <script>
       
        $(document).ready(function () {
  $("#product_category")
    .on("change", function () {
      console.log("changed");
      // Get the selected category
      const selectedCategory = $(this).val();


      // Send an AJAX request to fetch the products based on the selected category
      
      $.ajax({
        url: "../BackEnd/Models/InvSwitch.php",//"http://localhost:8888/Admin%20/pages/activity.php",
        type: "POST",
        data: { category: selectedCategory },
        dataType: "json",
        success: function (products) {
          // Update the table content
          let tableContent = "";
          products.forEach((product) => {
            const imageData = product.IMAGE ? "data:image/jpeg;base64," + product.IMAGE : "";

            tableContent += `<tr data-product-id="${product.PRODUCT_ID}">
              <td>${product.PRODUCT_ID}</td>
              <td>${product.PRODUCT_NAME}</td>
              <td>${product.PRODUCT_QUANTITY}</td>
              <td>${product.EndPrice}</td>
              <td>${product.SALE}</td>
              <td><img src="${imageData}" alt="" /></td>
              <td><button class="Delete" data-product-id="${product.PRODUCT_ID}">Delete</button></td>

            </tr>`;
          });

          $("table tbody").html(tableContent);
        },
      });
    })
    .trigger("change"); // Trigger the change event


});


$(document).on('click', '.Delete', function() {
 // const productId = $(this).data('productid');
 const productId = $(this).data('product-id');
 console.log("id : "+productId );

  $.ajax({
    url: '../BackEnd/Models/InvSwitch.php',//'http://localhost:8888/Admin%20/BackEnd/Models/Products.php',
    type: 'POST',
    data: {
      action: 'delete_product',
      product_id: productId
    },
    success: function() {
      alert('Product deleted successfully');
      console.log(productId);
      $(`tr[data-product-id='${productId}']`).remove();
     // location.reload(); // Refresh the page after deleting the product
    },
    error: function() {
      alert('Error deleting product');
    }
  });
});



</script>

</body>
</html>