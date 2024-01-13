<?php
// Include your database connection code
include 'connectdb.php';

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted data
    $schoolYear = $_POST['school_year'] ?? '';
    $subjectId = $_POST['subject_id'] ?? '';
    $teacherId = $_POST['teacher_id'] ?? '';
    $weekDay = $_POST['week_day'] ?? '';
    $lessons = isset($_POST['lesson']) ? implode(', ', $_POST['lesson']) : '';
    $notes = $_POST['notes'] ?? '';

    // Modify the insert query to include subject and teacher names
    $insertQuery = "INSERT INTO schedules (school_year, subject_id, teacher_id, week_day, lession, notes, updated, created)
                    VALUES ('$schoolYear', $subjectId, $teacherId, '$weekDay', '$lessons', '$notes', NOW(), NOW())";

    if ($conn->query($insertQuery) === TRUE) {
        echo '';
    } else {
        echo '<p>Error inserting schedule: ' . $conn->error . '</p>';
    }

    // Close the database connection
    $conn->close();
} else {
    echo '<p>No data submitted. Please go back to the schedule registration form.</p>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete_Schedule</title>
</head>
<body>
    <div class="container">
        <h3>Bạn đã đăng ký thành công thời khóa biểu</h3>
        <a href="home.php" style="text-decoration: underline;">Trở về trang chủ</a>
    </div>
</body>
</html>
