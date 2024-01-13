
<?php
// Start or resume the session
session_start();

// Check if the user is logged in, if not, redirect to login.php
if (!isset($_SESSION['login_id'])) {
    header("Location: login.php");
    exit();
}

// Get the user's login_id from the session
$login_id = $_SESSION['login_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/style.css" rel="stylesheet">
    <title>Home</title>
</head>
<body>
<p>Tên login: <?php echo $login_id; ?> </p>
<p>Thời gian login: <span id="loginTime"></span></p>
<table>
    <tr>
        <td>Phòng học</td>
        <td>Giáo viên</td>
        <td>Môn học</td>
        <td>Thời khóa biểu</td>
    </tr>
    <tr>
        <td>Tìm kiếm</td>
        <td><a href="teacher_searching.html">Tìm kiếm</a></td>
        <td><a href="list_subject.php">Tìm kiếm</a></td>
        <td><a href="schedule_seaching.html">Tìm kiếm</a></td>
    </tr>
    <tr>
        <td>Thêm mới</td>
        <td>Thêm mới</td>
        <td><a href="adding_subject.php">Thêm mới</a></td>
        <td><a href="schedule_register.php">Thêm mới</a></td>
    </tr>
</table>

</body>
<script>
    function formatDateTime() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');

        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}`;
        return formattedDateTime;
    }
    document.getElementById('loginTime').textContent = formatDateTime();
</script>
</html>
