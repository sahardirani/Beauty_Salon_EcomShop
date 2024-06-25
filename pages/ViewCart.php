<?php
//require_once 'Common/Menu.php';



$order_id = isset($_GET['order_id']) ? $_GET['order_id'] : '';
$cart_data = isset($_GET['cart_data']) ? urldecode($_GET['cart_data']) : '';


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<meta name="author">
	<title>Cart</title>

	
	<link rel="stylesheet" href="../Project/css/style.css">
	<link rel="stylesheet" href="../Project/css/demo.css">
	<link rel="stylesheet" href="../Project/css/header.css">
	<style>
		.fixed-menu {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 9999;
}
#cart {
  margin-top: 100px;
  z-index: 9998;
}
header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background-color: #fff;
  z-index: 999;
}

</style>


</head>

<body>

	
<header class="fixed-menu">
  <a href="" class="logo">MAIA</a>
  <ul>
    <li>
      <a href="transaction.php">Back</a>
      <ul class="dropdown">
        <hr>
    </li>
  </ul>
 
  
</header>



		
<br>
<br>
<br>
<br>
<br>
<br>
<br>
			<div class="container" >
				<h1><b>BAG</b></h1>
			</div>
	<main>




	

		<div class="container">

		<section id="cart" data-cart="<?php echo htmlspecialchars($cart_data); ?>">

			

	</main>




	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	

	<script>





var prices = {};
$(document).ready(function () {
  var cartElement = document.getElementById("cart");
  var cartData = JSON.parse(cartElement.dataset.cart);
  // Rest of the code
  console.log(cartData );

  if (cartData ) {
  console.log("prepare ajax");
  $.ajax({
    type: 'POST',
    url: '../Project/BE/CartManagment.php',
    data: {
      action:'displayCart',
      cart: cartData 
    },
    success: function(response) {
      // Handle the response from CartManagement.php
      console.log("test ajax");

      // Parse the JSON response
      var products = JSON.parse(response);

      // Loop through the products and display them
	  var subtotal =0;
      for (var i = 0; i < products.length; i++) {
        var product = products[i];
		var sumPrice =product.EndPrice*product.PRODUCT_QUANTITY;
		subtotal =subtotal+sumPrice;
		prices[product.PRODUCT_ID] = product.EndPrice; // add key-value pair for product price
        var html = `
          <article class="product" id=${product.PRODUCT_ID}>
            <header>
              <a class="remove">
                <img src="data:image/jpeg;base64,${product.IMAGE}" alt="${product.PRODUCT_NAME}" class="cart">
                <h3>Remove product</h3>
              </a>
            </header>
            <div class="content">
              <h1>${product.PRODUCT_NAME}</h1>
            
            </div>
            <footer class="content">
              <span class="qt-minus">-</span>
              <span class="qt">${product.PRODUCT_QUANTITY}</span>
              <span class="qt-plus">+</span>
              <h2 class="full-price">${product.EndPrice}€</h2>
              <h2 class="price">${sumPrice}€</h2>
            </footer>
          </article>
        `;
        $('#cart').append(html);
      }
	  var tax = parseInt(subtotal * 0.05);
	  var endTotal= tax+subtotal;
	  TotalPrice = endTotal;
	  var footer = `
	  <footer id="site-footer">
			<div class="container clearfix">

				<div class="left">
					<h2 class="subtotal">Subtotal: <span>${subtotal}</span>€</h2>
					<h3 class="tax">Taxes (5%): <span>${tax}</span>€</h3>
					<h3 class="shipping">Shipping: <span>5.00</span>€</h3>
				</div>

				<div class="right">
					<h1 class="total">Total: <span>${endTotal}</span>€</h1>
					
				</div>

			</div>
		</footer> 
        `;
        $('#cart').append(footer);



	}});
	




    }
  });












		</script>


</body>

</html>
<?php

?>