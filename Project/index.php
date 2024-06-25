<?php
require_once 'pages/Common/Menu.php';
?>

<html>

<head>
    <link rel="stylesheet" href="css/mystylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title></title>
    <style>
        .containerTest {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    padding: 20px;
    
    margin: 0 auto;
}

.box {
    flex: 1 1 300px; /* This will make the boxes responsive */
    box-sizing: border-box;
    margin: 10px;
    padding: 20px;
    text-align: center;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.3); /* A simple box shadow */
}

.box1 {
    background-color:#69707a; /* Light red */
}

.box2 {
    background-color: #69707a; /* Light blue */
}

            .picture-container {
  display: flex;
  justify-content: center;
}

.picture {
  width: 33.33%;
  padding: 10px;
  box-sizing: border-box;
}

.picture img {
  width: 100%;
  height: 300px;
}

        </style>
</head>

<body>



    <header>
        <a href="#" class="logo">MAIA</a>

        <ul>
            <li>
                <a href="pages/bodycare.php">All Products</a>
                <ul class="dropdown">

                    <!--  <li><a href="bodycare.php" class="ddp">Body Care</a>-->
                    
            </li>
        </ul>



        <?php
           headerDisplayIndex();
            ?>
    </header>

    <section class="banner"></section>
    <script type="text/javascript">
        window.addEventListener("scroll", function () {
            var header = document.querySelector("header");
            header.classList.toggle("sticky", window.scrollY > 0);
        })
    </script>


  





    <div style="padding: 20px;"></div>




    <img src="images/img2.jpg" class="img-banner" width="1263" alt="mmtuts banner">
        <div style="padding: 20px;"></div>
       
        <div class="cdiv">ABOUT US</div>
        <div class="asdiv">
            Welcome to our exquisite beauty center, where indulgence and relaxation await you.
            Step into a haven of tranquility and be pampered from head to toe by our team of 
            skilled beauty professionals. Our state-of-the-art facility is designed to provide
            a luxurious and rejuvenating experience, with serene ambiance, soft lighting, and
            soothing music that instantly transports you to a world of serenity. Our beauty center 
            offers a wide range of services tailored to enhance your natural beauty, from revitalizing 
            facials to expert hair and makeup application. 
            Our experienced and attentive staff uses premium products and advanced techniques to 
            deliver results that exceed your expectations. Unwind in our beauty center, where you
            can relax while being taken care of, or enjoy a cup of aromatic tea in our cozy 
            lounge. Whether you're looking for a rejuvenating escape, a bridal makeover, or simply 
            some well-deserved pampering, our beauty center is your ultimate destination for a blissful 
            and transformative experience. Come, treat yourself, and let us enhance your inner and outer beauty.
        </div>
        <div class="cdiv">Services</div>
        <div class="container" >
            <div >Hair Services: Hair services may include haircuts, coloring, highlights, balayage, ombre, perms, straightening, and more. Hair stylists may also offer consultations to help clients choose a hairstyle that complements their face shape, hair texture, and personal style.</div>
            <div >Makeup Services: Makeup services may include makeup application for special events, weddings, proms, or photoshoots. Makeup artists may also offer lessons and tutorials on how to apply makeup, choose colors, and create specific looks.</div>
            <div >Skincare Services: Skincare services may include facials, peels, microdermabrasion, dermaplaning, acne treatments, and more. Skincare professionals may also provide consultations to help clients identify their skin type, address specific concerns, and choose products that work for them.</div>
        </div>
        <div class="cdiv">WHERE ARE WE LOCATED?</div>
        <div class="asdiv">
            Our beauty center is proud to have established a strong presence in the beauty industry with
            the opening of three branches in strategic locations in lebanon that are: Beirut, South Lebanon, and Shouf.
             Our multiple branches allow us to reach a wider customer base and offer our exceptional beauty services to more clients.
            Each of our branches is equipped with state-of-the-art facilities and equipment, 
            along with highly trained and skilled professionals who are dedicated to providing 
            the best possible services. We strive to create a welcoming and comfortable atmosphere
            in each of our branches, ensuring that our clients feel relaxed and rejuvenated 
            during and after their treatments. We are committed to delivering quality beauty 
            services across all of our branches, and we look forward to welcoming you to one of 
            our locations.
        </div>


        <div class="cdiv">GALLERY</div>
        <div class="picture-container">
            <div class="picture">
                <img src="images/MG4.png" alt="Picture 1">
            </div>
            <div class="picture">
                <img src="images/MG2.png" alt="Picture 2">
            </div>
            <div class="picture">
                <img src="images/MG5.png" alt="Picture 3">
            </div>
        </div>

        <style>
            .picture-container {
  display: flex;
  justify-content: center;
}

.picture {
  width: 33.33%;
  padding: 10px;
  box-sizing: border-box;
}

.picture img {
  width: 100%;
  height: 300px;
}

            </style>

        <div class="cdiv">FEEDBACK</div>

        <div class="container" >
            <div >"Staff members are very professional and friendly with customers.
                They have a good understanding of the products and services offered and are able
                to answer any questions or concerns."</div>
            <div >"The quality of service provided by the beauty center is top-notch. 
                I feel satisfied with the results of your treatments and services,
                 and the center should is committed to providing quality services consistently."</div>
            <div >"The atmosphere and ambiance of the beauty center is veryrelaxing and comfortable.
                I feel that I am in a calm and peaceful environment where I 
                can unwind and enjoy the treatments."</div>
        </div>
       

        
        
        </main>
        

</body>

</html>