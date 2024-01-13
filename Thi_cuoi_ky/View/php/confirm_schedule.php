<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Schedule</title>
    <link rel="stylesheet" href="./css/subject.css">
</head>
<body>
    <div class="container">
        <?php
        // Check if the form data is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve and display the submitted data
            $schoolYear = $_POST['school_year'];
            $subjectId = $_POST['subject_id'];
            $teacherId = $_POST['teacher_id'];
            $weekDay = $_POST['week_day'];
            $lessons = isset($_POST['lesson']) ? $_POST['lesson'] : [];
            $notes = $_POST['notes'];

            // Include your database connection code
            include 'connectdb.php';

            // Fetch subject and teacher names
            $subjectQuery = "SELECT name FROM subjects WHERE id = $subjectId";
            $subjectResult = $conn->query($subjectQuery);
            $subjectName = ($subjectResult->num_rows > 0) ? $subjectResult->fetch_assoc()['name'] : 'Unknown Subject';

            $teacherQuery = "SELECT name FROM teachers WHERE id = $teacherId";
            $teacherResult = $conn->query($teacherQuery);
            $teacherName = ($teacherResult->num_rows > 0) ? $teacherResult->fetch_assoc()['name'] : 'Unknown Teacher';

            // Display the confirmed information
            echo '<p class="schedule-info"><strong>Năm học </strong> ' . $schoolYear . '</p>';
            echo '<p class="schedule-info"><strong>Môn học </strong> ' . $subjectName . '</p>';
            echo '<p class="schedule-info"><strong>Giáo viên </strong> ' . $teacherName . '</p>';
            echo '<p class="schedule-info"><strong>Thứ</strong> ' . $weekDay . '</p>';
            echo '<p class="schedule-info"><strong>Tiết</strong> ' . implode(', ', $lessons) . '</p>';
            echo '<p class="schedule-info"><strong>Lưu ý</strong> ' . $notes . '</p>';

            // Close the database connection
            $conn->close();
        } else {
            echo '<p>No data submitted. Please go back to the schedule registration form.</p>';
        }
        ?>
        <form action="insert_schedule.php" method="post">
            <input type="hidden" name="school_year" value="<?php echo $schoolYear; ?>">
            <input type="hidden" name="subject_id" value="<?php echo $subjectId; ?>">
            <input type="hidden" name="teacher_id" value="<?php echo $teacherId; ?>">
            <input type="hidden" name="week_day" value="<?php echo $weekDay; ?>">
            <?php
            foreach ($lessons as $lesson) {
                echo '<input type="hidden" name="lesson[]" value="' . $lesson . '">';
            }
            ?>
            <input type="hidden" name="notes" value="<?php echo $notes; ?>">
            <input class="register" type="submit" value="Đăng ký">
        </form>
        <!-- Add buttons for further actions -->
        <form action="schedules_register.php">
            <input class="re-modify" type="button" value="Sửa lại">
        </form>
    </div>

</body>
</html>
