<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <h2>Subject List</h2>

    <?php
    // Include your database connection code
    include 'connectdb.php';

    // Function to handle delete action
    function handleDelete($subjectId) {
        global $conn;

        $deleteQuery = "DELETE FROM subjects WHERE id = $subjectId";
        if ($conn->query($deleteQuery) === TRUE) {
            echo '<p>Subject deleted successfully.</p>';
        } else {
            echo '<p>Error deleting subject: ' . $conn->error . '</p>';
        }
    }

    // Fetch subjects from the database
    $query = "SELECT * FROM subjects";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>Name</th>';
        echo '<th>Avatar</th>';
        echo '<th>Description</th>';
        echo '<th>School Year</th>';
        echo '<th>Action</th>';
        echo '</tr>';

        while ($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id'] . '</td>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['avatar'] . '</td>';
            echo '<td>' . $row['description'] . '</td>';
            echo '<td>' . $row['school_year'] . '</td>';

            // Action buttons
            echo '<td class="action-buttons">';
            echo '<form action="modify_subject.php" method="post">';
            echo '<input type="hidden" name="subject_id" value="' . $row['id'] . '">';
            echo '<input type="submit" value="Sửa">';
            echo '</form>';

            echo '<form method="post">';
            echo '<input type="hidden" name="subject_id" value="' . $row['id'] . '">';
            echo '<input type="submit" name="delete" value="Xóa">';
            echo '</form>';
            echo '</td>';

            echo '</tr>';
        }

        echo '</table>';
    } else {
        echo '<p>No subjects found.</p>';
    }

    // Handle delete action
    if (isset($_POST['delete'])) {
        $subjectIdToDelete = $_POST['subject_id'];
        handleDelete($subjectIdToDelete);
    }

    // Close the database connection
    $conn->close();
    ?>
</body>
</html>
