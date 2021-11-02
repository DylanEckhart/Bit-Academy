<?php

session_start();

$category = $_POST['subject'];
$project = $_POST['chapter'];
$startTime = $_POST['startTime'];

    if (isset($_POST['submitPlan']) && !empty($_POST['startTime'])) {
        if(!isset($_SESSION['submitPlan'])){
            $_SESSION['submitPlan'] = array();
        }
        array_push($_SESSION['submitPlan'],  $category , $project, $startTime);
    }


    //if(isset($_POST['endTask']) && !empty($_SESSION["submitPlan"])){
      //  if(isset($_SESSION['endTime'])){
        //    $_SESSION['endTime'] = array();
        //}
        //$date_clicked = date('Y-m-d H:i:s');
        //array_push($_SESSION['endTime'], $date_clicked);
    //}
header("Location: index.php");









