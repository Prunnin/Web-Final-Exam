<?php
include 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $avatar = $_POST["avatar"];
    $description = $_POST["description"];
    $school_year = $_POST["school_year"];

    $insert_query = "INSERT INTO subjects (name, avatar, description, school_year, updated, created) 
                     VALUES ('$name', '$avatar', '$description', '$school_year', NOW(), NOW())";

    if ($conn->query($insert_query) === TRUE) {
        echo "";
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete</title>
</head>
<body>
    <div class="container">
        <h3>Bạn đã đăng ký thành công môn học</h3>
        <a href="home.php" style="text-decoration: underline;">Trở về trang chủ</a>
    </div>
</body>
</html>