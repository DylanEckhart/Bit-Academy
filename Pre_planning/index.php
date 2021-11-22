<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Pre_Planning_Style.css">
    <link rel="stylesheet" href="../Header/style.css">
    <link rel="icon" href="../Images/icon/favicon.ico" type="image/icon">
    <title>Previous Plannings</title>
</head>
<body>
<!-- Include PHP files -->
<?php
    // Header
    require_once "../Header/header.php";

    // Database connection and variable
    require_once '../DB/connection.php';
    $connection = openConn();

    // Action
    require_once 'ticketLoad.php';
?>

<!-- Website Title -->
<div id="PrePlanning">
    <h1 id="pagetitle">Previous Plannings</h1>
    <!-- Planning tickets of the student -->
    <div id="PlanningGrid">
        <?php
            // Query to select data from database
            $getDataQuery = "SELECT idplanning, categories_and_subjects_subjects_Subject, Description, Layer, Language, Start_Time, Stop_Time, Deadline, Forcast_Time, TimeSpent, categories_Category, deadlineFinished, finishedInTime 
                             FROM tickets 
                             INNER JOIN categories_and_subjects 
                             ON tickets.categories_and_subjects_subjects_Subject = categories_and_subjects.subjects_Subject 
                             INNER JOIN plannings 
                             ON tickets.Description = plannings.tickets_Description 
                             WHERE IsFinished = 1";

            // Get query results
            $setData = mysqli_query($connection, $getDataQuery);

            while ($row = mysqli_fetch_assoc($setData)) {
                $dataArray[] = $row;
            }

            // Display tickets
            if (sizeof($dataArray) > 0) {
                loadTickets($dataArray);
            }
        ?>
    </div>
</div>
</body>
</html>