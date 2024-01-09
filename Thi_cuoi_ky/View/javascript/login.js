document.addEventListener("DOMContentLoaded", function() {
    var loginButton = document.querySelector(".button-container");
    if (loginButton) {
        loginButton.addEventListener("click", function(event) {
            event.preventDefault();
            validateForm();
        });
    }
});

function validateForm() {
    var account = document.getElementById("account").value;
    var password = document.getElementById("password").value;
    var accountError = document.getElementById("accountError");
    var passwordError = document.getElementById("passwordError");

    accountError.innerHTML = "";
    passwordError.innerHTML = "";

    if (account === "") {
        accountError.innerHTML = "Hãy nhập login id";
        return false;
    } else if (account.length < 4) {
        accountError.innerHTML = "Hãy nhập id tối thiểu 4 kí tự";
        return false;
    }

    if (password === "") {
        passwordError.innerHTML = "Hãy nhập password";
        return false;
    } else if (password.length < 6) {
        passwordError.innerHTML = "Hãy nhập password tối thiểu 6 kí tự";
        return false;
    }

    // AJAX request
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
                // Redirect to home page
                window.location.href = "home.html";
            } else {
                // Display error message
                passwordError.innerHTML = response.message;
            }
        }
    };
    xhr.send("login_id=" + account + "&password=" + password);
}
