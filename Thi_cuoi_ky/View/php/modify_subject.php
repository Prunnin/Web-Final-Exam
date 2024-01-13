<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style2.css">
    <title>Modify Subject</title>
</head>
<body>
    <?php
    // Include your database connection code
    include 'connectdb.php';

    // Check if subject_id is set
    if (isset($_POST['subject_id'])) {
        $subjectId = $_POST['subject_id'];

        // Fetch subject details from the database
        $query = "SELECT * FROM subjects WHERE id = $subjectId";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Display the form with current subject details
            ?>
        <div id="notification" class="notification"></div>
        <div class="container"> 
            <form action="confirm_modify.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="subject_id" value="<?php echo $row['id']; ?>">

                <label for="name">Tên môn học </label>
                <input type="text" name="name" class="entering" value="<?php echo $row['name']; ?>" required><br>


                <label for="school_year">Khóa </label>
                <select name="school_year" class="selectOption " style="margin-left: 159px;" required>
                    <option value="">Chọn khóa học:</option> 
                    <option value="Năm 1" <?php echo ($row['school_year'] == 'Năm 1') ? 'selected' : ''; ?>>Year 1</option>
                    <option value="Năm 2" <?php echo ($row['school_year'] == 'Năm 2') ? 'selected' : ''; ?>>Year 2</option>
                    <option value="Năm 3" <?php echo ($row['school_year'] == 'Năm 3') ? 'selected' : ''; ?>>Year 3</option>
                    <option value="Năm 4" <?php echo ($row['school_year'] == 'Năm 4') ? 'selected' : ''; ?>>Year 4</option>
                </select><br>

                <label for="description">Mô tả chi tiết </label>
                <textarea name="description" class="entering" rows="4" required><?php echo $row['description']; ?></textarea><br>

                <label for="avatar">Avatar</label> <?php echo $row['avatar']; ?>
                <input type="file" name="avatar" accept="image/*" required><br>

                <input type="submit" class="button-container" value="Xác nhận">
            </form>
        </div>
            <?php
        } else {
            echo '<p>Subject not found.</p>';
        }
    } else {
        echo '<p>Invalid request. Please go back to the list.</p>';
    }

    // Close the database connection
    $conn->close();
    ?>
    <script src="./javascript/modifysubject.js"></script>
</body>
</html>
