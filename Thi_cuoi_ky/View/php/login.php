<?php
include('connectdb.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from login form
    $login_id = isset($_POST['login_id']) ? $_POST['login_id'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Check if both login_id and password are provided
    if (empty($login_id) || empty($password)) {
        echo "Please provide both login ID and password.";
        exit();
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
        echo "login id và password không đúng";
    }
}

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
    <script src="/javascript/login.js"></script>
</html>
