<?php
// Include the database connection code
include('connectdb.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from login form
    $login_id = isset($_POST['login_id']) ? $_POST['login_id'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if username is empty
    if (empty($login_id)) {
        echo " Hãy nhập login id.";
        exit();
    }

    // Check if username has at least 4 characters
    if (strlen($login_id) < 4) {
        echo " Hãy nhập login id tối thiểu 4 ký tự.";
    }

    // Check if password is empty
    if (empty($password)) {
        echo " Hãy nhập mật khẩu.";
    }

    // Check if password has at least 6 characters
    if (strlen($password) < 6) {
        echo " Hãy nhập mật khẩu tối thiểu 6 ký tự."; 
    }

    // Prevent SQL injection
    $login_id = mysqli_real_escape_string($conn, $login_id);
    $password = mysqli_real_escape_string($conn, $password);

    // Query to check if the user exists
    $query = "SELECT * FROM admins WHERE login_id = '$login_id' AND password = '$password' AND actived_flag = 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // User exists, login successful
        session_start();
        $_SESSION['login_id'] = $login_id; // Store user's login_id in the session for later use
        header("Location: home.php"); // Redirect to the home page or any other page you want
        exit();
    } else {
        // User does not exist or incorrect credentials
        echo " login id và password không đúng.";
    }

    // Close the database connection when done
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="./css/style.css" rel="stylesheet">
</head>

<body>

    <div class="container">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="account" class="username">Người dùng </label>
            <input type="text" id="account" name="login_id" class="entering" required><br><br>
            <span id="accountError" class="error-message"></span><br>

            <label for="password" class="password">Password </label>
            <input type="password" id="password" name="password" class="entering" required><br><br>
            <span id="passwordError" class="error-message"></span><br>

            <div class="forgot-password">
                <a href="request.html">Quên password</a>
            </div>

            <button type="submit" class="button-container"> Đăng nhập </button>

        </form>
    </div>

    </body>
</html>
