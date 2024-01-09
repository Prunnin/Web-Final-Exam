<?php
include 'connectdb.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form
    $login_id = $_POST['account'];
    $password = $_POST['password'];

    // Validate login credentials
    $sql = "SELECT * FROM admins WHERE login_id = '$login_id' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login successful
        echo json_encode(["success" => true]);
    } else {
        // Login failed
        echo json_encode(["success" => false, "message" => "Invalid login credentials"]);
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    
    <div class="container">
        <form>
            <label for="account" class="username">Người dùng </label>
            <input type="textbox" id="account" name="account" class="entering" required><br><br>
            <span id="accountError" class="error-message"></span><br>
            
            <label for="password" class="password">Password </label>
            <input type="password" id="password" name="password" class="entering" required><br><br>
            <span id="passwordError" class="error-message"></span><br>

            <div class="forgot-password">
                <a href="request.html">Quên password</a>
            </div>
            
            <button class="button-container" onclick="validateForm()"> Đăng nhập </button>

        </form>
    </div>

    <script src="/javascript/login.js"></script>
</body>
</html>
