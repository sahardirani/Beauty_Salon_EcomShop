<?php
require_once 'Common/Menu.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/mystylesheet.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <title>Sale</title>
    </head>
    <body>  
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

            
            <section class="banner"></section>
          
          
          <script type="text/javascript">
                window.addEventListener("scroll", function(){
                var header = document.querySelector("header");
                header.classList.toggle("sticky", window.scrollY > 0);
                })
            </script>
            
    </body>
</html>