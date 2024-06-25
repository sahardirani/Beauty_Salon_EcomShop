
<?php

session_start();

if (isset($_SESSION['user_id']) || isset($_SESSION['email']) || isset($_SESSION['first_name']) || isset($_SESSION['last_name'])) {
 header('Location: profile.php');

}
else {
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Salon</title>
    <link rel="stylesheet" href="../css/log.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>

    <div class="wrapper">
        <div class="title-text">
            <div class="title login">
                Login Form
            </div>
            <div class="title signup">
                Signup Form
            </div>
        </div>
        <div class="form-container">
            <div class="slide-controls">

                <input type="radio" name="slide" id="login" checked>
                <input type="radio" name="slide" id="signup">
                <label for="login" class="slide login">Login</label>
                <label for="signup" class="slide signup">Signup</label>



                <div class="slider-tab"></div>
            </div>

            <div class="form-inner">


                <form class="login" onsubmit="return LogIn()" action="../BE/logIn.php" method="POST">

                    <div class="field">
                        <input type="email" placeholder="Email Address" id="Log-email"  name ="Log-email" required>
                    </div>

                    <div class="field">
                        <input type="password" placeholder="Password"  name="Log-password"  id="Log-password" required>
                    </div>

                    <div class="pass-link">
                        <a href="#">Forgot password?</a>
                    </div>

                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Login">
                    </div>

                    <div class="signup-link">
                        Not a member? <a href="">Signup now</a>
                    </div>

                </form>


                <form class="signup" id="signup-form" onsubmit="return submitForm() " action="../BE/signup.php"
                    method="POST">

                    <div class="field">
                        <input type="email" placeholder="Email Address" id="SignEmail" name="email">
                    </div>

                    <div class="field">
                        <input type="text" placeholder="First Name" id="SignName" name="firstName">
                    </div>

                    <div class="field">
                        <input type="text" placeholder="Last  Name" id="SignLast" name="lastName">
                    </div>



                    <div class="field">
                        <input type="password" placeholder="Password" id="SignPass" name="password">
                    </div>


                    <div class="field">
                        <input type="password" placeholder="Confirm password" id="SignConf" name="confirmPassword">
                    </div>


                    
                    <div class="field">
                        <input type="tel" placeholder="Phone Number" id="phone_number" name="phone_number" >
                    </div>



                    <div class="field">
                        <input type="date" placeholder="Date of birth" id="SignDate" name="dateOfBirth">
                    </div>


                    <div class="field btn">
                        <div class="btn-layer"></div>
                        <input type="submit" value="Signup">
                    </div>


                </form>
            </div>



        </div>
    </div>









    <script src="../Javascript/app.js"></script>
</body>

</html>

<?php 
}

?>