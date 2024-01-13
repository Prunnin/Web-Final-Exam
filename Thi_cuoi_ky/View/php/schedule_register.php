<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Registration</title>
    <link rel="stylesheet" href="./css/subject.css">
</head>
<body>

    <?php
    // Include your database connection code
    include 'connectdb.php';

    // Fetch subjects from the database for the subject selectbox
    $subjectQuery = "SELECT id, name FROM subjects";
    $subjectResult = $conn->query($subjectQuery);

    // Fetch teachers from the database for the teacher selectbox
    $teacherQuery = "SELECT id, name FROM teachers";
    $teacherResult = $conn->query($teacherQuery);
    ?>
    <div class="container"> 
    <form action="confirm_schedule.php" method="post">
        <label for="school_year">Năm học</label>
        <select name="school_year" class="option">
            <option value="Năm 1">Năm 1</option>
            <option value="Năm 2">Năm 2</option>
            <option value="Năm 3">Năm 3</option>
            <option value="Năm 4">Năm 4</option>
        </select><br>

        <label for="subject_id">Môn học</label>
        <select name="subject_id" class="option">
            <?php
            while ($subject = $subjectResult->fetch_assoc()) {
                echo '<option value="' . $subject['id'] . '">' . $subject['name'] . '</option>';
            }
            ?>
        </select><br>

        <label for="teacher_id">Giáo viên</label>
        <select name="teacher_id" class="option">
            <?php
            while ($teacher = $teacherResult->fetch_assoc()) {
                echo '<option value="' . $teacher['id'] . '">' . $teacher['name'] . '</option>';
            }
            ?>
        </select><br>

        <label for="week_day">Thứ</label>
        <select name="week_day" class="option">
            <option value=""></option>
            <option value="Thứ 2">Thứ 2</option>
            <option value="Thứ 3">Thứ 3</option>
            <option value="Thứ 4">Thứ 4</option>
            <option value="Thứ 5">Thứ 5</option>
            <option value="Thứ 6">Thứ 6</option>
            <option value="Thứ 7">Thứ 7</option>
            <option value="Chủ Nhật">Chủ Nhật</option>
        </select><br>

        <label for="lesson" class="lession">Tiết học</label><br>
        <?php
        // Display checkboxes for lessons 1 to 10
        echo '<div class="optionLession" style="display: inline-block; flex-direction: row;">';

            for ($i = 1; $i <= 10; $i++) {
                echo '<label style="margin-right: 10px;"><input type="checkbox" name="lesson[]" value="' . $i . '"> Tiết ' . $i . '</label>';
            }

        echo '</div>';
        ?>
        <br>
        <label for="notes" >Chú ý </label>
        <textarea class="option" name="notes" rows="4"></textarea><br>

        <input type="submit" class="button-container" value="Xác nhận">
    </form>
    </div>
    <script src="./javascript/subject.js"></script>
    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
