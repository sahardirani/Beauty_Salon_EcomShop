<?php


function CartView()
{
    ?>
    	
<header class="fixed-menu">
  <a href="../index.php" class="logo">MAIA</a>
  <ul>
    <li>
      <a href="bodycare.php">All Products</a>
      <ul class="dropdown">
        <hr>
    </li>
  </ul>
  <?php
    headerDisplay();
  ?>
  
</header>



		
<br>
<br>
<br>
<br>
<br>
<br>
<br>
			
<div class="container" >
				<h1><b>MY BAG</b></h1>
</div>
	
   <main>
		  <div class="container">
      <section id="cart">
	 </main>
<?php



}


function profileView()   {
  ?>
      <header>
            <a href="../index.php" class="logo">MAIA</a>
            <ul>
            <li>
                <a href="bodycare.php">All Products</a>
                <ul class="dropdown">

                 
                    <hr>
            </li>
        </ul>

        </li>

                <?php
                 headerDisplay();
                ?>
          
            </header>
          
       <br>
       <br>

       <div class="content-wrapper">
   


        <div style="margin:50px; padding-top: 20px; width: 50%;">
        <div class="container-xl px-4 mt-4">
            <hr class="mt-0 mb-4">
            <div class="row">
                <div class="col-xl-4">
                    <!-- Profile picture card-->
                    <div class="card mb-4 mb-xl-0">
                        <div class="card-header">Profile : </div>
                        <div class="card-body text-center">
                            
                        </div>
                    </div>
                </div>
                <div class="col-xl-8">
                    <!-- Account details card-->
                    <div class="card mb-4">
                        <div class="card-header"></div>
                        <div class="card-body">
                            <form>
                                
                            <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" value="<?php echo $_SESSION['email']; ?>" readonly>
                                </div>

                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (first name)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputFirstName">First name</label>
                                        <input class="form-control" id="inputFirstName" type="text" placeholder="<?php echo $_SESSION['first_name']; ?>" value="<?php echo $_SESSION['first_name']; ?>">
                                      </div>
                                 </div>

                        
            
                                 <div class="col-md-6">
                                        <label class="small mb-1" for="inputLastName">Last name</label>
                                        <input class="form-control" id="inputLastName" type="text" placeholder="<?php echo $_SESSION['last_name']; ?>" value="<?php echo $_SESSION['last_name']; ?>">
                                      </div>
                                 </div>
                               
                                <div class="row gx-3 mb-3">
                                    
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputLocation">Location</label>
                                        <input class="form-control" id="inputLocation" type="text" placeholder="Enter your location" value="<?php echo $_SESSION['location']; ?>">
                                    </div>
                                </div>
                                <!-- Form Group (email address)-->
                             
                                <!-- Form Row-->
                                <div class="row gx-3 mb-3">
                                    <!-- Form Group (phone number)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPhone">Phone number</label>
                                        <input class="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number"  value="<?php echo $_SESSION['PhoneNumber']; ?>">
                                    </div>
                                    <!-- Form Group (birthday)-->
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputBirthday">Birthday</label>
                                        <input class="form-control" id="inputBirthday" type="date" name="birthday" placeholder="Enter your birthday" value="<?php echo $_SESSION['Birthdate']; ?>">
                                    </div>
                                </div>
                             

                                <button class="btn btn-primary" id="saveChanges" type="button">Update Changes</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <br>
            <button id="logoutButton" class="btn btn-primary" type="button">Log Out</button>

        </div>
      
</div>

</div>



<?php

}



function BookView()  {

?>
<header id="site-header">
<a id="Home" href="../index.php" class="btn">Home</a>

            <div class="booking-container" id="header-container">
                <h1 ><b>BOOK YOUR APPOINTMENT</b></h1>

                
            </div>
            <div>
                <img src="../images/finalbg.png" class="bg-img">
            </div>

             <div class="booking-container" id="booking-category">
        <div class="appointments clickable-div" onclick="showDiv('makeup-app')">
            <h3 class="appointments">Makeup Services</h3>
        </div>
        <div class="appointments clickable-div" onclick="showDiv('hair-app')">
            <h3 class="appointments">Hair Services</h3>
        </div>
        <div class="appointments clickable-div" onclick="showDiv('facial-app')">
            <h3 class="appointments">Facial Services</h3>
        </div>
    </div>
   

        </header>

    <div id="makeup-app" style="display: none;">
        <div class="main-wrapper">
           <h3 style="margin-left: 3%;">Book Your Makeup Appointment!</h3>
            <div class="form-wrapper">
            <form id="makeup-form"  method="POST">

                <div class="mb-5">
                  <label for="name" class="form-label"> Full Name </label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Full Name"
                    class="form-input"
                  />
                </div>
                <div class="mb-5">
                  <label for="phone" class="form-label"> Phone Number </label>
                  <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="Enter your phone number"
                    class="form-input"
                  />
                </div>
                <div class="mb-5">
                  <label for="email" class="form-label"> Email Address </label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="<?php echo $_SESSION['email']; ?>"
                    class="form-input"
                    value="<?php echo $_SESSION['email']; ?>" 
                    readonly 
                  />
                </div>
                <div class="flex flex-wrap mx-3">
                  <div class="w-full sm:w-half px-3">
                    <div class="mb-5 w-full">
                      <label for="date" class="form-label"> Date </label>
                      <input
                        type="date"
                        name="date"
                        id="date"
                        class="form-input"
                      />
                    </div>
                  </div>
                  <div class="w-full sm:w-half px-3">
                    <div class="mb-5">
                      <label for="time" class="form-label"> Time </label>
                      <input
                        type="time"
                        name="time"
                        id="time"
                        class="form-input"
                        min="09:00" max="17:00" step="900"
                        
                      />
                      
                    </div>
                  </div>
                </div>
          
                <div>
                <button id="makeup-submit" class="btn">Book Appointment</button>

                </div>
              </form>
            </div>
          </div>
    </div>


    <div id="hair-app" style="display: none;">
        <div class="main-wrapper">
           <h3 style="margin-left: 3%;">Book Your Hair Appointment!</h3>
            <div class="form-wrapper">
            <form id="hair-form"  method="POST">

                <div class="mb-5">
                  <label for="name" class="form-label"> Full Name </label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Full Name"
                    class="form-input"
                  />
                </div>
                <div class="mb-5">
                  <label for="phone" class="form-label"> Phone Number </label>
                  <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="Enter your phone number"
                    class="form-input"
                  />
                </div>
                <div class="mb-5">
                  <label for="email" class="form-label"> Email Address </label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="<?php echo $_SESSION['email']; ?>"
                    class="form-input"
                    value="<?php echo $_SESSION['email']; ?>" 
                    readonly 
                  />
                </div>
                <div class="flex flex-wrap mx-3">
                  <div class="w-full sm:w-half px-3">
                    <div class="mb-5 w-full">
                      <label for="date" class="form-label"> Date </label>
                      <input
                        type="date"
                        name="date"
                        id="date"
                        class="form-input"
                      />
                    </div>
                  </div>
                  <div class="w-full sm:w-half px-3">
                    <div class="mb-5">
                      <label for="time" class="form-label"> Time </label>
                      <input
                        type="time"
                        name="time"
                        id="time"
                        class="form-input"
                        min="09:00" max="17:00" step="1800"
                        
                      />
                    </div>
                  </div>
                </div>
          
                <div>
                <button id="hair-submit" class="btn">Book Appointment</button>

                </div>
              </form>
            </div>
          </div>
    </div>
       

    <div id="facial-app" style="display: none;">
        <div class="main-wrapper">
           <h3 style="margin-left: 3%;">Book Your Facial Appointment!</h3>
            <div class="form-wrapper">
            <form id="facial-form"   method="POST">

                <div class="mb-5">
                  <label for="name" class="form-label"> Full Name </label>
                  <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Full Name"
                    class="form-input"
                  />
                </div>
                <div class="mb-5">
                  <label for="phone" class="form-label"> Phone Number </label>
                  <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="Enter your phone number"
                    class="form-input"
                  />
                </div>
                <div class="mb-5">
                  <label for="email" class="form-label"> Email Address </label>
                  <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="<?php echo $_SESSION['email']; ?>"
                    class="form-input"
                    value="<?php echo $_SESSION['email']; ?>" 
                    readonly 
                  />
                </div>
                <div class="flex flex-wrap mx-3">
                  <div class="w-full sm:w-half px-3">
                    <div class="mb-5 w-full">
                      <label for="date" class="form-label"> Date </label>
                      <input
                        type="date"
                        name="date"
                        id="date"
                        class="form-input"
                      />
                    </div>
                  </div>
                  <div class="w-full sm:w-half px-3">
                    <div class="mb-5">
                      <label for="time" class="form-label"> Time </label>
                      <input
                        type="time"
                        name="time"
                        id="time"
                        class="form-input"
                        min="09:00" max="17:00" step="900"
                        
                      />
                    </div>
                  </div>
                </div>
          
                <div>
                <button id="facial-submit" class="btn">Book Appointment</button>

                </div>
              </form>
            </div>
          </div>
    </div>
       
       <?php


}


function ProductsView(){

?>
   <header>
            <a href="../index.php" class="logo">MAIA</a>
        <ul>
            <li>
                <a href="#" id="selected-category">All Products</a>
                <ul class="dropdown">
                <li class='ddp' value='AllProduct'>All Product<hr></li>
                    <?php
                    $result = fetchCategory();
                    foreach ($result as $category) {
                    $categoryName = $category["Category_Name"];
                    $displayName = $category["Display_Name"];
                    echo "<li class='ddp' value='$categoryName'>$displayName<hr></li>";
    }
?>

                </ul>
            </li>
        
            <?php
            headerDisplay();
            ?>
            </header>

            <section class="banner"></section>


            <!-- Add the <main> element wrapping the 'products-container' div -->
<main id="products" class="products-container">
   
</main>
<?php



}



?>