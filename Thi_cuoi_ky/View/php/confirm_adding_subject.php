<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $avatar = "./avatar/" . basename($_FILES["avatar"]["name"]);
    $description = $_POST["description"];
    $school_year = $_POST["school_year"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style2.css">
    <title>Confirm Subject Information</title>
</head>
<body>
    <div class="container">
        <p>Tên môn học <?php echo $name; ?></p>
        <p>Khóa <?php echo $school_year; ?></p>
        <p>Mô tả chi tiết <?php echo $description; ?></p>
        <p>Avatar <?php echo $avatar; ?></p>

        <form action="complete.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="avatar" value="<?php echo $avatar; ?>">
            <input type="hidden" name="description" value="<?php echo $description; ?>">
            <input type="hidden" name="school_year" value="<?php echo $school_year; ?>">
            
            <button class="button-container" onclick="window.location.href='adding_subject.php'" type="button">Sửa lại</button>
            <input  class="button-container" type="submit" value="Đăng ký">
        </form>

    </div>
</body>
</html>

<?php
}
?>
