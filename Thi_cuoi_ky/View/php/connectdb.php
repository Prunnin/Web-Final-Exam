<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "schedule_management";

    $conn = new mysqli($servername, $username, $password, $database);

    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection

    if (!$conn) {

        die("Connection failed: " . mysqli_connect_error());

    }
    // echo "Connected successfully";
    mysqli_close($conn);
?>