<?php


function addUsers(){
?>

<script>
  $(document).ready(function() {
  $('input[type=checkbox]').on('change', function() {
    var userId = $(this).data('id');
    var isActive = $(this).is(':checked') ? 1 : 0;
   // console.log(isActive);

    $.ajax({
      url: '../BackEnd/Common/setup.php',
      method: 'POST',
      data: {
        action:'User_activity',
        user_id: userId,
        activity: isActive
      },
      dataType: "json",
      success: function(response) {
        if (response.status === "success") {
            alert("Updated successfully");
          }
        else {
            if (response.message) {
              alert(response.message);
              
            }
        }
      


      },


      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  });
});
</script>

<?php



}


function productManagment()  {
    ?>

<script>

$(document).ready(function() {
  $('#SearchProduct').submit(function(e) {
    e.preventDefault(); // Prevent form submission

    // Get the product ID entered by the user
    const searchProductId = $('#search_product_id').val();

    // Send an AJAX request to fetch the product details
    $.ajax({
      url: '../BackEnd/Models/Products.php', // Replace this with the URL to your PHP script
      type: 'POST',
      data: {
        action: 'search_product',
        search_product_id: searchProductId
      },
      dataType: 'json', // Add this line to indicate the expected response type
      success: function(product) {
        // Update the UI with the product details
        const imageData = product.IMAGE ? "data:image/jpeg;base64," + product.IMAGE : "";
        const productDetails = `<div>
          <p><strong>Product ID:</strong> ${product.PRODUCT_ID}</p>
          <label for="product_name_fetch"><strong>Product Name:</strong></label>
          <input type="text" id="product_name_fetch" name="product_name_fetch" value="${product.PRODUCT_NAME}"><br>


          <label for="product_category"><strong>Category:</strong></label>
          <input type="text" id="product_category" name="product_category" value="${product.PRODUCT_CATEGORY}"><br>

          <label for="price"><strong>Price:</strong></label>
          <input type="text" id="price" name="price" value="${product.PRICE}"><br>

          <label for="quantity"><strong>Quantity:</strong></label>
          <input type="text" id="quantity" name="quantity" value="${product.PRODUCT_QUANTITY}"><br>

          <label for="Sale"><strong>Sale:</strong></label>
          <input type="number" id="Sale" name="quantity" value="${product.SALE}" min="0" max ="100"><br>

          <p><strong>Image:<br></strong> <img src="${imageData}" alt="" class="product-image"></p>

          <input type="button" value="Update" class="update-product">
        </div>`;

        $('#product-details').html(productDetails);
        $('#Sale').on('input', function() {
         const maxValue = 100;
         if ($(this).val() > maxValue) {
           $(this).val(maxValue);}});

        // Add the event listener for the "Update" button
        $('.update-product').click(function() {
          // Get the updated product details from the input fields
          const productId = $('#search_product_id').val();
          const productName = $('#product_name_fetch').val();
          const productCategory = $('#product_category').val();
          const price = $('#price').val();
          const quantity = $('#quantity').val();
          const sale = $('#Sale').val();


          console.log(productId );
          console.log(productName);
          console.log(productCategory);
          console.log(price  );
          console.log(quantity);


          // Send an AJAX request to update the product details in the database
          $.ajax({
            url: '../BackEnd/Models/Products.php', 
            type: 'POST',
            data: {
              action: 'update_Product',
              product_id: productId,
              product_name: productName,
              product_category: productCategory,
              price: price,
              quantity: quantity,
              sale:sale
            },
            success: function() {
              alert('Product updated successfully');
            },
            error: function(jqXHR, textStatus, errorThrown) {
              alert('Error updating product');
              console.log(errorThrown);
            }
          });
        });
      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error fetching product details');
        console.log(errorThrown);
      }
    });
  });
 

});






$(document).ready(function () {
    $("#CategoryForm").on("submit", function (event) {
        event.preventDefault();

        let formData = $(this).serializeArray();
        formData.push({ name: "action", value: "AddCategoryTodatabase" });

        $.ajax({
            type: "POST",
            url:     "../BackEnd/Models/Products.php",//"http://localhost:8888/Admin%20/pages/Common/function.php", 
            data: formData,
            success: function (response) {
               alert(response);
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
               alert(`Error: ${textStatus}, ${errorThrown}`);
            }
        });
    });
});



///
   function showSalePercentage() {
        document.getElementById("product_sale_percentage_input").style.display = "block";
        document.getElementById("product_sale_percentage").required = true;
    }

    function hideSalePercentage() {
        document.getElementById("product_sale_percentage_input").style.display = "none";
        document.getElementById("product_sale_percentage").required = false;
        document.getElementById("product_sale_percentage").value = 0;
    }

    // Add event listener to the form submit event
    $("#addProductForm").on("submit", function (e) {
        // Prevent the default form submission
        e.preventDefault();

        // Create a FormData object from the form
        var formData = new FormData(this);

        // Use AJAX to submit the form data
        
        $.ajax({
            url: "../BackEnd/Models/Products.php",//"http://localhost:8888/Admin%20/pages/add_product.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false, 
            success: function (response) {
                // Handle successful form submission
                alert("Product added successfully");
                console.log("Success:", response);
                clearForm() ;
                
            },
            error: function () {
                // Handle error in form submission
                console.log("Error");
                // You can display an error message, etc.
            }
        });
    });

    function clearForm() {
  document.getElementById("addProductForm").reset();
  hideSalePercentage()
}

</script>
<?php

}

function FuilfullCenter()  {
    ?>
     <script>
       

       $(document).ready(function () {
    // Send an AJAX request to fetch the products based on the selected category
    $.ajax({
        url: "../BackEnd/Models/Fulfuil.php",
        type: "POST",
        data: { 
            action:"orders"
        },
        dataType: "json",
        success: function (products) {
            // Update the table content
            let tableContent = "";
            products.forEach((product) => {
                tableContent += `
                <tr data-order-id="${product.OrderID}">
                    <td>${product.OrderID}</td>
                    <td>${product.CustomerID}</td>
                    <td><button data-order-id="${product.OrderID}" data-cart-data="${encodeURIComponent(product.CartData)}" class="butn updateStatusBtn View">View</button></td>
                    <td>${product.Location}</td>
                    <td>${product.CustomerNumber}</td>
                    <td>${product.Cost} €</td>
                    <td><button data-order-id="${product.OrderID}" class="butn updateStatusBtn Delete">Packed</button></td>
                </tr>`;
            });
            $("table tbody").html(tableContent);
        }
    });
});

$(document).on('click', '.View', function() {
    const orderID = $(this).data('orderId');
    const cartData = decodeURIComponent($(this).data('cartData'));
    console.log(cartData);
    window.location.href = `ViewCart.php?order_id=${orderID}&cart_data=${encodeURIComponent(cartData)}`;
});




$(document).on('click', '.Delete', function() {
    const orderID = $(this).data('orderId'); // Use camelCase here
    console.log("id : " + orderID);

    $.ajax({
    url: '../BackEnd/Models/Fulfuil.php',//'http://localhost:8888/Admin%20/BackEnd/Models/Products.php',
    type: 'POST',
    data: {
      action: 'Done',
      id: orderID
    },
    success: function() {
      alert('Order Fulfuilled Successfully');
    //  deleteRow(button[0]);
      $(`tr[data-order-id='${orderID}']`).remove();
     // location.reload(); // Refresh the page after deleting the product
    },
    error: function() {
      alert('Error deleting product');
    }
  });

});

 






</script>
<?php

}



?>