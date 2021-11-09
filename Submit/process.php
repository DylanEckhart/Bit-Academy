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

if (isset($_POST['submitPlan'])) {
    if(!isset($_SESSION['submitPlan'])){
        $_SESSION['submitPlan'] = array();
    }
    $category = $_POST['subject'];
    $project = $_POST['chapter'];
    date_default_timezone_set('Europe/Amsterdam');
    $startTime = date("j - F - Y - H:i", time());
    array_push($_SESSION['submitPlan'],  $category , $project, $startTime);
    $sql = "INSERT INTO planning (Chapter, Subject , Starting_Time)
VALUES ('$category', '$project', NOW())";

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
