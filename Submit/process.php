<?php
//DATABASE CONNECTION VARIABLES
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id17762295_bitacademydb";
//CREATE DATABASECONNECTION
$conn = new mysqli($servername, $username, $password, $dbname);

//CHECK DATABASE CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//STARTING A LIVE SESSION
session_start();

//DECLARING GLOBAL VARIABLES
$category = $_POST['category'];
$subject = $_POST['subject'];
$description = $_POST['description'];
$_SESSION['approved'] = false;

//SHOW PREVIEW AFTER SUBMIT PLAN BUTTON
if(isset($_POST['submitPlan']) && !empty($_POST['category']) && !empty($_POST['subject']) && !empty($_POST['description'])){
    $_SESSION['approved'] = true;
}
else {
    echo "vul alles in";
}

//SAVE USERINPUT IN SESSION
$_SESSION['submitPlan'] = array();
if (isset($_POST['submitPlan'])) {
    array_push($_SESSION['submitPlan'], $category , $subject, $description);
}

//PUSH USERINPUT INTO DATABASE
if (isset($_POST['submitPlan']) && !empty($category) && !empty($project) && !empty($description)) {
        $_SESSION['submitPlan'] = array();
        date_default_timezone_set('Europe/Amsterdam');
        $startTime = date("j - F - Y - H:i", time());
        $sql = "INSERT INTO plannings (Starting_Time)
VALUES (NOW())";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }

header("Location: index.php");


