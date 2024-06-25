<?php


function profileControllers(){
    ?>
   <script> 
let sessionId = sessionStorage.getItem('sessionId');
console.log(sessionId);
if (!sessionId) {
  sessionId = generateSessionId();
  sessionStorage.setItem('sessionId', sessionId);
}

// check if the flag exists in local storage
let cartLoaded = localStorage.getItem('cartLoaded');
if (cartLoaded) {
  console.log('cart already loaded');
  loadCart();
} else {

    localStorage.setItem('cartLoaded', true);
    // set the session value in sessionStorage
    sessionStorage.setItem('PreviousSession', '<?php echo $_SESSION['CartSession']; ?>');
    // get the session value from sessionStorage
    let cartSession = sessionStorage.getItem('PreviousSession');
    // print the session value to the console
    console.log("Previous : "+cartSession);
   if(cartSession ==0){
    $.ajax({
    url: '../BE/CartManagment.php',
    type: 'POST',
    dataType: 'json',
    data: {
         action:'InsertCart',
         id: '<?php echo $_SESSION['user_id']; ?>', 
         session_id: sessionId
         },
         success: function(data) {
         console.log(data.success);
         console.log(data.message);
         loadCart() ;},
    error: function(xhr, status, error) {
      console.error(error);
    } });
   }else {

    
    console.log("entered");
    $.ajax({
    url: '../BE/CartManagment.php',
    type: 'POST',
    dataType: 'json',
    data: {
      action: 'GetCart',
      id: '<?php echo $_SESSION['user_id']; ?>',
      session_id: cartSession
    },
    success: function(data) {
      console.log(data.success);
      console.log(data.message);

      if (data.cartData && Object.keys(data.cartData).length > 0) {
        localStorage.setItem('cart', JSON.stringify(data.cartData));
        loadCart();
      }
      
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}

}






function loadCart() {
    const cart = localStorage.getItem('cart');
    if (cart) {
        return JSON.parse(cart);
    } else {
        return {};
    }

}






// Save Cart : 
function saveCart(cart) {
  $.ajax({
    type: 'POST',
    url: '../BE/CartManagment.php',
    data: { 
        action: 'SaveCart',

        id: '<?php echo $_SESSION['user_id']; ?>', 
        session_id: sessionId,
        cart: JSON.stringify(cart) 
    },
    success: function(response) {
      console.log(response);
    },
    error: function(xhr, status, error) {
      console.error(error);
    }
  });
}





function clearCart() {
    localStorage.removeItem('cart');
    localStorage.removeItem('cartLoaded');
 
}








    
//
function generateSessionId() {
  let timestamp = new Date().getTime();
  let randomNum = Math.floor(Math.random() * 1000000);
  console.log(`${timestamp}-${randomNum}`);
  return `${timestamp}-${randomNum}`;
}




 document.getElementById('logoutButton').addEventListener('click', function() {
  
  
  saveCart(loadCart());  
  let sessionId = sessionStorage.getItem('sessionId');
  sessionStorage.removeItem('sessionId');

  $.ajax({
    url: '../BE/logout.php',
    type: 'POST',
    data: {sessionId: sessionId},
    success: function(response) {
    // add to refresh the page
    clearCart(); 
   location.reload();
    }
  });
});


  document.getElementById('saveChanges').addEventListener('click', function() {
  updateProfile();
});

function updateProfile() {
  const firstName = document.getElementById('inputFirstName').value;
  const lastName = document.getElementById('inputLastName').value;
  const location = document.getElementById('inputLocation').value;
  const phoneNumber = document.getElementById('inputPhone').value;
  const birthday = document.getElementById('inputBirthday').value;

  $.ajax({
    url: '../BE/Users.php',
    type: 'POST',
    data: {
      action: 'update_profile',
      firstName: firstName,
      lastName: lastName,
      location: location,
      phoneNumber: phoneNumber,
      birthday: birthday
    },
    dataType: 'json', // Add this line to indicate the expected response type
    success: function(response) {
      // Handle response here, e.g., show a success message
      console.log("Profile updated successfully");
    },
    error: function(xhr, status, error) {
      // Handle any errors that occurred during the request
      console.error("Error updating profile:", error);
    }
  });

}
</script>
<?php

}

/**
 * this function  is resposible of taking care of the functions related to cart , update , delete , buy 
 */
function CartManagment(){
?>


<script>
		var TotalPrice =0;
		var prices = {};
$(document).ready(function() {
  // Get the cart data from local storage
  var cartData = JSON.parse(localStorage.getItem('cart'));
  var modifiedCart = {};

  for (var productId in cartData) {

  var quantity = cartData[productId];
  
  modifiedCart[productId] = { 'quantity': quantity };


}


//console.log(cartData.length);
// If the cart is not empty, send an Ajax request to CartManagement.php
if (cartData ) {
  console.log("prepare ajax");
  $.ajax({
    type: 'POST',
    url: '../BE/CartManagment.php',
    data: {
      action:'displayCart',
      cart: modifiedCart 
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
		var sumPrice = product.EndPrice*product.PRODUCT_QUANTITY;
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
              <h1>${product.Description}</h1>
            
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
					<a class="btn">Checkout</a>
				</div>

			</div>
		</footer> 
        `;
        $('#cart').append(footer);


    }
  });
}
});

// check Out :
$(document).on("click", ".btn", function() {
  // Get the location and number from the user
  
  var location = '<?php echo $_SESSION['location']; ?>';

  if(location=="" || location=="Enter ur location inorder to order "){

	alert("Enter your Location from the Customer Portal in order to do this transaction");
  }else{
	let sessionId = sessionStorage.getItem('sessionId');
   console.log(location);

   var cartData = JSON.parse(localStorage.getItem('cart'));
   var modifiedCart = {};
   for (var productId in cartData) {
   var quantity = cartData[productId];
   modifiedCart[productId] = { 'quantity': quantity }; }
  console.log("check out price : "+TotalPrice);
   $.ajax({
    type: 'POST',
    url: '../BE/CartManagment.php',
    data: {
      action: 'checkOut',
      location: location,
	  id: '<?php echo $_SESSION['user_id']; ?>', 
	  phoneNumber:"<?php echo $_SESSION['PhoneNumber']; ?>",
	  session_id: sessionId,
	  cart: JSON.stringify(modifiedCart) ,
	  TotalMoney:TotalPrice 

    },
	success: function(response) {
     alert("Order placed. Thank u for ordering with Us <3");
	 localStorage.removeItem('cart');

	 window.location.href = window.location.href;

	}
   });


}


});







$(document).on("click", "#cart .remove", function() {
	var productId = $(this).closest("article").attr("id");
console.log(productId);

// Get the cart data from local storage
var cartData = JSON.parse(localStorage.getItem('cart'));

// Loop through the cart items
for (var item in cartData) {
  if (cartData.hasOwnProperty(item)) {
    if (item == productId) {
      // Remove the item from the cart
      delete cartData[item];
      break;
    }
  }

 
}

// Update the cart data in local storage
localStorage.setItem('cart', JSON.stringify(cartData));
updateTotalPrice();
// Remove the <article> element from the cart display
var articleElement = $(this).closest("article");
articleElement.remove();
});


$(document).on("click", "#cart .qt-minus", function() {
  var productId = $(this).closest("article").attr("id");
  var cartData = JSON.parse(localStorage.getItem('cart'));

  // Decrease the quantity of the product in the local storage
  cartData[productId] = cartData[productId] - 1;

  // Update the displayed quantity on the page
  $(this).siblings(".qt").text(cartData[productId]);

  // Update the price of the product
  var productPrice = prices[productId];
  var totalPrice = productPrice * cartData[productId];
  $(this).siblings(".price").text(totalPrice.toFixed(2) + "€");

  // Update the total price on the page
  

  // Update the local storage with the new cart data
  localStorage.setItem('cart', JSON.stringify(cartData));
  updateTotalPrice();
});

$(document).on("click", "#cart .qt-plus", function() {
  var productId = $(this).closest("article").attr("id");
  var cartData = JSON.parse(localStorage.getItem('cart'));

  // Increase the quantity of the product in the local storage
  cartData[productId] = cartData[productId] + 1;

  // Update the displayed quantity on the page
  $(this).siblings(".qt").text(cartData[productId]);

  // Update the price of the product
  var productPrice = prices[productId];
  var totalPrice = productPrice * cartData[productId];
  $(this).siblings(".price").text(totalPrice.toFixed(2) + "€");

  // Update the total price on the page
 

  // Update the local storage with the new cart data
  localStorage.setItem('cart', JSON.stringify(cartData));
  updateTotalPrice();
});

function updateTotalPrice() {
  var cartData = JSON.parse(localStorage.getItem('cart'));
  var totalPrice = 0;

  // Calculate the total price from the cart data and prices array
  for (var productId in cartData) {
	console.log("test");
    var quantity = cartData[productId];
    var price = prices[productId];

	console.log("Quantity : "+quantity);
	console.log("price : "+price);
    totalPrice += quantity * price;
  }
  console.log(totalPrice);
  TotalPrice = totalPrice*1.05 ;
  // Update the displayed total price on the page
  $(".subtotal span").text(totalPrice.toFixed(2));
  $(".tax span").text((totalPrice * 0.05).toFixed(2));
  $(".total span").text((totalPrice * 1.05).toFixed(2));
}

</script>

<?php





}


function bookinfDash(){
  ?>
   <script>

function showDiv(divId) {
        const divIds = ['makeup-app', 'hair-app', 'facial-app'];
        divIds.forEach((id) => {
          document.getElementById(id).style.display = (id === divId) ? 'block' : 'none';
        });
      }
  $(document).ready(function () {
    $('#makeup-submit, #hair-submit, #facial-submit').on('click', function (event) {
      event.preventDefault();
      const service = $(this).attr('id').split('-')[0];
      const form = $(`#${service}-form`);
      const formElements = form.serializeArray();

      let customerData = {};

      formElements.forEach(function (element) {
        customerData[element.name] = element.value;
      });
      var fullName = customerData['name'];
      var nameParts = fullName.split(' ');
      
      var firstName = nameParts[0];
      var lastName = nameParts.length > 1 ? nameParts.slice(1).join(' ') : '';

      var phone =  customerData['phone'];
      var time = customerData['time'];
      var date = customerData['date'];
      var email = customerData['email'];

    //  console.log("Customer's Email:", customerData['email']);

       $.ajax({
        url: '../../BackEnd/Models/BookMangment.php',
        type: 'POST',
        data: form.serialize(),
        dataType: 'json',
        data:{
          action : 'checkIfAvialble',
          firstname : firstName ,
          lastname: lastName,
          phoneNb:phone ,
          Time: time,
          Date: date,
          Email:email,
          Service:service 
        },
        success: function (response) {
          
          if(response.isAvailable)
          alert("Booked");
          else 
          alert("Capacity Overflow")
          
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.error(`Error: ${textStatus}, ${errorThrown}`);
        },
      });
    });
  });

</script>
<?php
}




function productsControlles()  
{
  ?>
  
  <script type="text/javascript">
                window.addEventListener("scroll", function(){
                var header = document.querySelector("header");
                header.classList.toggle("sticky", window.scrollY > 0);
                })

                $(document).ready(function() {
            $(".ddp").on("click", function() {
                let categoryName = $(this).attr("value");
                let displayName = $(this).text();

                // Update the main menu item text
                $("#selected-category").text(displayName);

                fetchProducts(categoryName);
            });

            // Trigger the click event for the 'AllProduct' category by default
            $(".ddp[value='AllProduct']").trigger("click");
        });

        function fetchProducts(category) {
        
    $.ajax({
        url: "../../BackEnd/Common/fetch_products.php",//"http://localhost:8888/Admin%20/pages/Common/fetch_products.php",
        data: {
          action :'FetchAllProducts',
           category: category 
          },
        dataType: "json",
        success: function(data) {
            let productsHTML = "";
            data.forEach(product => {
                // Check if there's a sale on the product
                const hasSale = product.SALE > 0;
                const displayPrice = hasSale ?  (product.PRICE * (1 - product.SALE / 100)).toFixed(0) : product.PRICE;

                // Remove the <main> element from the productsHTML
                productsHTML += `
                <div class="card">
                <div class="image">
                       <img src="data:image/jpeg;base64,${product.IMAGE}" alt="${product.PRODUCT_NAME}">
                </div>
                <div class="caption"> <!-- Move the caption div outside the image div -->
                <span>${product.Description}</span>
               
                
                `;
                

                if (hasSale) {
                    productsHTML += `<p><b><del>$${product.PRICE}</del></b><b> $${displayPrice}</b></p>`;
                } else {
                    productsHTML += `<p><b>$${displayPrice}</b></p>`;
                }

                productsHTML += `
                <input type="number" hidden id="quantity-${product.PRODUCT_ID}" value="1" min="1" style="width: 60px; margin-right: 10px;">
                <button class="add-to-cart" data-product-id="${product.PRODUCT_ID}">Add to cart</button>
    
                    </div>
                </div>
                `;
            });
            $("#products").html(productsHTML);
        }
    });
}



    /// load it 
    
    function loadCart() {
    const cart = localStorage.getItem('cart');
    console.log(cart);
    if (cart) {
        return JSON.parse(cart);
    } else {
        return {};
    }
}

function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}


$(document).on("click", ".add-to-cart", function() {
    const productId = $(this).data("product-id");
    const quantityInput = $(`#quantity-${productId}`);
    const quantity = parseInt(quantityInput.val());

    alert("Added to Cart!!");

    // Load the cart from local storage
    const cart = loadCart();

    // Update the product quantity in the cart
    if (cart[productId]) {
        cart[productId] += quantity;
        console.log("added quantity");
        console.log( cart[productId] );
    } else {
        cart[productId] = quantity;
        console.log("added ");
    }

    // Save the updated cart to local storage
    saveCart(cart);

    console.log(`Product ID: ${productId}, Quantity: ${quantity}`);

    // Reset the quantity input value to 1
    quantityInput.val(1);
});







            </script>
            <?php
}



?>