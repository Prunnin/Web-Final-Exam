<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Modify</title>
    <link rel="stylesheet" href="./css/style2.css">
</head>
<body>
    <div class="container"> 
        <?php
        // Include your database connection code
        include 'connectdb.php';

        // Function to handle delete action
        function handleUpdate($subjectId, $name, $avatar, $description, $schoolYear) {
            global $conn;

            // Update subject details in the database
            $updateQuery = "UPDATE subjects SET name='$name', avatar='$avatar', description='$description', school_year='$schoolYear' WHERE id=$subjectId";

            if ($conn->query($updateQuery) === TRUE) {
                echo '';
            } else {
                echo '<p>Error updating subject: ' . $conn->error . '</p>';
            }
        }

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get data from the form
            $subjectId = $_POST['subject_id'];
            $name = $_POST['name'];
            $avatar = $_FILES['avatar']['name']; // Assuming you have file upload handling in place
            $description = $_POST['description'];
            $schoolYear = $_POST['school_year'];

            // Display the updated information
            echo '<p class="username">Tên môn học ' . $name . '</p>';
            echo '<p class="username">Khóa ' . $schoolYear . '</p>';
            echo '<p class="username">Mô tả chi tiết ' . $description . '</p>';
            echo '<p class="username">Avatar ' . $avatar . '</p>';

            // Display buttons for further actions
            ?>
            <form action="modify_subject.php" method="post">
                <input type="hidden" name="subject_id" value="<?php echo $subjectId; ?>">
                <input type="submit" class="button-container" value="Sửa lại">
            </form>

            <form action="complete.php" method="get">
                <input type="submit" class="button-container" value="Sửa">
            </form>
            <?php

            // Handle the update action
            handleUpdate($subjectId, $name, $avatar, $description, $schoolYear);
        } else {
            echo '<p>Invalid request. Please go back to the list.</p>';
        }
    ?>
    </div>
