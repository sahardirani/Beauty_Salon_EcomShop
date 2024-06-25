<!DOCTYPE html>
<html>
<head>
    <title>Verification Process</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        #demo_form {
            text-align: center;
            background-color: #f1f1f1;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #demo_button {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border: none;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            border-radius: 5px;
        }

        #demo_button:hover {
            background-color: #45a049;
        }

        .code-input {
            width: 40px;
            height: 40px;
            text-align: center;
            margin: 0 5px;
            font-size: 1.2rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #timer {
            font-size: 0.9rem;
            color: #666;
            margin-top: 1rem;
        }

        .submit-button {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border: none;
            background-color: #2196F3;
            color: white;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 1rem;
        }

        .submit-button:hover {
            background-color: #1a8fe3;
        }
    </style>
</head>
<body>
    <form id="demo_form">
        <input type="hidden" name="action" value="verifyOTP">
        <input type="hidden" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
        <input type="hidden" name="firstName" id="firstName" value="<?php echo htmlspecialchars($_POST['firstName']); ?>">
        <input type="number" name="code[]" class="code-input" maxlength="1" min="0" max="9">
        <input type="number" name="code[]" class="code-input" maxlength="1" min="0" max="9">
        <input type="number" name="code[]" class="code-input" maxlength="1" min="0" max="9">
        <input type="number" name="code[]" class="code-input" maxlength="1" min="0" max="9">
        <input type="number" name="code[]" class="code-input" maxlength="1" min="0" max="9">
        <input type="number" name="code[]" class="code-input" maxlength="1" min="0" max="9">
        <br>
        <br>
         
        <input type="submit" value="Submit" class="submit-button">
        <br>

        <br>
        <input type="button" name="demo_button" id="demo_button" value="Press Me to Send Mail" disabled />
       <div id="timer"></div>

        <br>
        <br>
        <input type="button" value="Go to dashboard" class="dashboard submit-button" id="dashboard_button" style="display: none;" onclick="goToProfile()">



    
    </form>
   
    <script>
        $(document).ready(function() {
            var countdown = 10; // Countdown timer in seconds

            // Start countdown timer
            function startCountdown() {
                if (countdown > 0) {
                    $('#timer').text('Please wait ' + countdown + ' seconds before pressing again.');
                    countdown--;
                    setTimeout(startCountdown, 1000);
                } else {
                    $('#timer').text('');
                    $('#demo_button').prop('disabled', false);
                    countdown = 60;
                }
            }

            // Disable button, send data to sendMail.php, and start countdown on click
            $('#demo_button').click(function() {
                $(this).prop('disabled', true);

                var email = $('#email').val(); 
                var firstName = $('#firstName').val();
console.log("test ajax");
                $.ajax({
                    type: "POST",

                    url: 'sendMail.php',//"http://localhost:8888/Admin%20/Project/BE/sendMail.php",//"https://mostafafatayri.000webhostapp.com/sendMail.php",
                    data: { email: email, firstName: firstName },
                    success: function(response) {
                        alert("Mail sent successfully");
                        startCountdown();
                    },
                    error: function() {
                        alert("Error occurred while sending data.");
                        $('#demo_button').prop('disabled', false);
                    }
                });
            } );

            // Start the countdown immediately on page load
            startCountdown();

            // Handle verification form submission
          /**   $('#verification_form').submit(function(e) {
                e.preventDefault();
                var code = '';
                $('.code-input').each(function() {
                    code += $(this).val();
                });

                               // Send the entered code for verification
                $.ajax({
                    type: "POST",
                    url: "https://yourwebsite.com/check_code.php",
                    data: { code: code, email: email },
                    success: function(response) {
                        if (response == "success") {
                            alert("Verification successful!");
                            // Redirect to another page or display success message
                            window.location.href = "https://yourwebsite.com/success_page.php";
                        } else {
                            alert("Invalid code. Please try again.");
                        }
                    },
                    error: function() {
                        alert("Error occurred while verifying the code.");
                    }
                });
            });**/
        });

 $(document).ready(function() {
            // Add the rest of your JavaScript/jQuery code here

            // Limit input to one digit
            $(".code-input").on("input", function() {
                if ($(this).val().length > 1) {
                    $(this).val($(this).val().slice(0, 1));
                }
            });
            $("#demo_form").submit(function(e) {
    e.preventDefault();

    var formData = $(this).serialize();

    $.ajax({
    type: "POST",
    url: 'Users.php',//"http://localhost:8888/Admin%20/Project/BE/Users.php", //"verify.php",
    data: formData,
    success: function(response) {
        var result = JSON.parse(response);
        console.log(result);
        if (result.status === "success") {
            // Log in user and store user data in session
            $.ajax({
                type: "POST",
                url: "logIn.php", // A new PHP file to handle session creation
                data: { 
                    action:'AutoMateLog',
                    email: result.userData.EMAIL,
                    password: result.userData.PASSWORD
                },
                success: function(response) {
                    console.log(response);
                    alert("Verified and logged in successfully");
                    // window.location.href = ""; // Redirect to user's dashboard
                    document.getElementById("dashboard_button").style.display = "block";

                },
                error: function() {
                    alert("Error occurred while logging in.");
                }
            });
        } else if (result.status === "mismatch") {
            alert("Code mismatch");
        } else {
            alert("Error occurred");
        }
    },
    error: function() {
        alert("Error occurred while sending data.");
    }
});


});

             


        });


function goToProfile() {
  window.location.href = "../pages/profile.php";
}


    </script>
</body>
</html>




