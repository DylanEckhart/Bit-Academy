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

            if (sizeof($dataArray) > 0) {
                foreach ($dataArray as $planning) {
                    // Display category and subject
                    echo "<div class='GridItem'>";
                    echo "<div class='category'>";
                    echo "<div class='ticketList'>";
                    echo '<p class="ticket_title">' . $planning["categories_Category"] . ' - </p>';
                    echo '<p class="ticket_title">' . $planning["categories_and_subjects_subjects_Subject"] . '</p>';
                    echo "</div>";

                    // Display description
                    echo "<p>" . $planning['Description'] . "</p>";
                    echo "</div>";

                    // Display date, deadline and bool
                    echo "<div class='deadline'>";
                    echo "<p>Date:</p>";
                    echo "<p>" . $planning['Stop_Time'] . "</p>";
                    echo "<p>Deadline:</p>";
                    echo "<p>" . $planning['Deadline'] . "</p>";
                    echo '<p class="deadlineFinished">Deadline finished:</p>';
                    echo '<p>' . ($planning["deadlineFinished"] ? "Yes" : "No") . '</p>';

                    // Set color bar
                    if ($planning["deadlineFinished"]) {
                        echo '<span class="finishedColorYes"></span>';
                    } else {
                        echo '<span class="finishedColorNo"></span>';
                    }
                    echo "</div>";

                    // Display time
                    echo "<div class='time'>";
                    echo '<p>Forcast time:</p>';
                    echo '<p>' . $planning["Forcast_Time"] . '</p>';
                    echo '<p>Time spent:</p>';
                    echo '<p>' . $planning["TimeSpent"] . '</p>';
                    echo '<p>Finished in time:</p>';
                    echo '<p>' . ($planning["finishedInTime"] ? "Yes" : "No") . '</p>';

                    // Set colorbar
                    if ($planning["finishedInTime"]) {
                        echo '<span class="finishedColorYes"></span>';
                    } else {
                        echo '<span class="finishedColorNo"></span>';
                    }
                    echo "</div>";
                    echo "</div>";
                }
            }
        ?>
    </div>
</div>
</body>
</html>