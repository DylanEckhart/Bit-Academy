<?php
//DATABASE CONNECTION VARIABLES
//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "id17762295_bitacademydb";
//CREATE DATABASECONNECTION
//$conn = new mysqli($servername, $username, $password, $dbname);
require_once "../DB/connection.php";

$conn = openConn();

//CHECK DATABASE CONNECTION
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//STARTING A LIVE SESSION
session_start();

//SETTING TIME ZONE
date_default_timezone_set('Europe/Amsterdam');
$startTime = date("j - F - Y - H:i", time());

//SHOW PREVIEW AFTER SUBMIT PLAN BUTTON
if (isset($_POST['submitPlan'])) {
    if (!empty($_POST['category']) && !empty($_POST['subject']) && !empty($_POST['description'])) {
        $category = $_POST['category'];
        $subject = $_POST['subject'];
        $description = $_POST['description'];
        $_SESSION["category"] = $_POST['category'];
        $_SESSION["subject"] = $_POST['subject'];
        $_SESSION["description"] = $_POST['description'];
        $_SESSION['approved'] = true;
        $_SESSION['submitPlan'] = array();
        array_push($_SESSION['submitPlan'], $category, $subject, $description);
    } else {
        $_SESSION['approved'] = false;
    }
}

//DELETE SPECIFIK PLANNING
if (isset($_POST["deleteFase1"])) {
    $_SESSION["id"] = $_POST["deleteFase1"];
}

if (isset($_POST["Delete"])) {
    $deleteQuery = "DELETE FROM plannings WHERE idplanning = '" . $_SESSION["id"] . "'";
    mysqli_query($conn, $deleteQuery);
    unset($_SESSION["id"]);
}

if (isset($_POST["NO"])) {
    unset($_SESSION["id"]);

    unset($_SESSION["idFinished"]);
}

//SAVE USERINPUT IN DATABASE
if (isset($_POST['submitPlanConfirmed'])) {
    $description = $_SESSION["description"];
    $insertPlanningIntoPlannings = "insert into plannings (tickets_Description) values ('$description')";
    mysqli_query($conn, $insertPlanningIntoPlannings);
    header("location: index.php");
}

//FINISH PLANNING
if (isset($_POST["finishFase1"])) {
    $_SESSION["idFinished"] = $_POST["finishFase1"];
}

if (isset($_POST["finish"])) {
    $finishTicketQuery = "UPDATE plannings SET isFinished = '1'  WHERE idplanning ='" . $_SESSION["idFinished"] . "'";
    mysqli_query($conn, $finishTicketQuery);
    unset($_SESSION['idFinished']);
}

//CLOSE PREVIEW AFTER USERINPUT SAVED INTO DATABASE
if (isset($_POST['submitPlanConfirmed'])) {
    unset($_SESSION['approved']);
    unset($_SESSION['submitPlan']);
}