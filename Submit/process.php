<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id17762295_bitacademydb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();

$category = $_POST['subject'];
$project = $_POST['chapter'];

if (isset($_POST['submitPlan']) && !empty($category) && !empty($project)) {
    date_default_timezone_set('Europe/Amsterdam');
    $startTime = date("j - F - Y - H:i", time());
    $sql = "INSERT INTO planning (Starting_Time)
VALUES (NOW())";

    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}

if (isset($_POST['index'])) {
    for ($i = 0; $i < 3; $i++) {
        unset($_SESSION['submitPlan'][$i]);
    }
}

header("Location: index.php");
