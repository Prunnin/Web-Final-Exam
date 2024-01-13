<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Schedules</title>
    <link rel="stylesheet" href="./css/subject.css"> <!-- Include your CSS file if needed -->
    <script>
        function confirmDelete(id) {
            var result = confirm("Are you sure you want to delete the schedule?");
            if (result) {
                // If the user clicks OK, submit the delete form
                document.getElementById('delete_form_' + id).submit();
            }
        }
    </script>
</head>
<body>
    <?php
    // Include your database connection code
    include 'connectdb.php';

    // Initialize variables for search values
    $searchSchoolYear = '';
    $searchSubject = '';
    $searchTeacher = '';

    // Check if the search form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted search values
        $searchSchoolYear = $_POST['search_school_year'] ?? '';
        $searchSubject = $_POST['search_subject'] ?? '';
        $searchTeacher = $_POST['search_teacher'] ?? '';
    }

    // Build the search query
    $searchQuery = "SELECT s.id, s.school_year, su.name AS subject_name, t.name AS teacher_name, s.week_day, s.lession, s.notes
                    FROM schedules s
                    JOIN subjects su ON s.subject_id = su.id
                    JOIN teachers t ON s.teacher_id = t.id
                    WHERE (s.school_year LIKE '%$searchSchoolYear%'
                        OR su.name LIKE '%$searchSubject%'
                        OR t.name LIKE '%$searchTeacher%')";

    $searchResult = $conn->query($searchQuery);
    ?>

    <div class="container">
        <h2>List of Schedules</h2>

        <!-- Search form -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="search_school_year">Search by School Year:</label>
            <input type="text" name="search_school_year" value="<?php echo $searchSchoolYear; ?>">
            
            <label for="search_subject">Search by Subject:</label>
            <input type="text" name="search_subject" value="<?php echo $searchSubject; ?>">

            <label for="search_teacher">Search by Teacher:</label>
            <input type="text" name="search_teacher" value="<?php echo $searchTeacher; ?>">

            <input type="submit" value="Search">
        </form>

        <!-- Display the number of records found -->
        <p>Number of records found: <?php echo $searchResult->num_rows; ?></p>

        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>School Year</th>
                    <th>Subject</th>
                    <th>Teacher</th>
                    <th>Week Day</th>
                    <th>Lesson</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Display schedules with action buttons
                while ($schedule = $searchResult->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $schedule['id'] . '</td>';
                    echo '<td>' . $schedule['school_year'] . '</td>';
                    echo '<td>' . $schedule['subject_name'] . '</td>';
                    echo '<td>' . $schedule['teacher_name'] . '</td>';
                    echo '<td>' . $schedule['week_day'] . '</td>';
                    echo '<td>' . $schedule['lession'] . '</td>';
                    echo '<td>' . $schedule['notes'] . '</td>';
                    echo '<td>';
                    echo '<form id="delete_form_' . $schedule['id'] . '" action="' . $_SERVER['PHP_SELF'] . '" method="post" style="display:inline;">';
                    echo '<input type="hidden" name="delete_id" value="' . $schedule['id'] . '">';
                    echo '<input type="button" value="Delete" onclick="confirmDelete(' . $schedule['id'] . ');">';
                    echo '</form>';
                    echo ' | ';
                    echo '<a href="update_schedule.php?id=' . $schedule['id'] . '">Update</a>';
                    echo '</td>';
                    echo '</tr>';
                }

                // Check if the delete form is submitted
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
                    $deleteId = $_POST['delete_id'];

                    // Delete the schedule from the 'schedules' table
                    $deleteQuery = "DELETE FROM schedules WHERE id = $deleteId";

                    if ($conn->query($deleteQuery) === TRUE) {
                        echo '<p>Schedule deleted successfully.</p>';
                        // Refresh the page after deletion
                        echo '<meta http-equiv="refresh" content="0">';
                    } else {
                        echo '<p>Error deleting schedule: ' . $conn->error . '</p>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
