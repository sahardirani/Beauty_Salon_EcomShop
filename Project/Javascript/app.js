const loginText = document.querySelector(".title-text .login");
const loginForm = document.querySelector("form.login");
const loginBtn = document.querySelector("label.login");
const signupBtn = document.querySelector("label.signup");
const signupLink = document.querySelector("form .signup-link a");
signupBtn.onclick = (() => {
    loginForm.style.marginLeft = "-50%";
    loginText.style.marginLeft = "-50%";
});
loginBtn.onclick = (() => {
    loginForm.style.marginLeft = "0%";
    loginText.style.marginLeft = "0%";
});
signupLink.onclick = (() => {
    signupBtn.click();
    return false;
});


function submitForm() {
    // get the form elements
    const email = document.getElementById("SignEmail");
    const name = document.getElementById("SignName");
    const last = document.getElementById("SignLast");
    const password = document.getElementById("SignPass");
    const confirm = document.getElementById("SignConf");
    const date = document.getElementById("SignDate");


    var upper = 0;
    var notchar = 0;
    var other = 0;

    pass = password.value;
    for (let i = 0; i < password.value.length; i++) {

        if (!isNaN(pass[i])) {
            console.log("number" + pass[i]);
            notchar += 1

        }
        else if (pass[i] == pass[i].toUpperCase()) {
            console.log("char" + pass[i]);
            upper += 1;
        }
        else {
            console.log(pass[i]);
            other += 1
        }

    }


    if (email.value == "" || name.value == "" || last.value == "" || password.value == "" || confirm.value == "" || date.value == "") {
        alert("Please fill in all the fields.");
        return false;
    } else if (password.value != confirm.value) {
        alert("Passwords do not match.");
        return false;
    }
    else if ((password.value == name.value) || (password.value == last.value)) {
        alert("Passwords should not be as name or last name ");
        return false;
    }
    else if (password.value.length < 8) {

        alert("Strong password must contain 8 characters");
        return false;
    }
    else if ((upper == 0) || (notchar == 0) || (other == 0)) {
        alert("A Strong password should incloud 1 upper character, 1 number , and a random character")
        return false;
    }
    else {
        // conditions are met, submit the form to the PHP file


        return true;
    }
}

function LogIn() {

    var email = document.getElementById("Log-email").value;

    var password = document.getElementById("Log-password").value;


    if ((email == "") || (password == "")) {
        alert("Please enter ur email and password to log in");
        return false;
    }
    if (password.length < 8) {
        alert("password is incorrect");
        return false;
    }

    return true




}
