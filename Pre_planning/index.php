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
        <div class="GridItem">
            <div class="category">
                <div class="ticketList">
                    <?php
                        // Query to select data from database
                        $getDataQuery = "SELECT idplanning, categories_and_subjects_subjects_Subject, Description, Layer, Language, Start_Time, Deadline, Forcast_Time, TimeSpent, categories_Category, deadlineFinished, finishedInTime 
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

                        // Display category and subject
                        if (sizeof($dataArray) > 0) {
                            foreach ($dataArray as $category) {
                                echo '<p class="ticket_title">' . $category["categories_Category"] . ' - </p>';
                                echo '<p class="ticket_title">' . $category["categories_and_subjects_subjects_Subject"] . '</p>';

                            }
                        } else echo "<option disabled hidden selected>There are no categories yet</option>";
                    ?>
                </div>
                <!-- Display description -->
                <?php
                    if (sizeof($dataArray) > 0 ) {
                        foreach ($dataArray as $description) {
                            echo '<p>' . $description["Description"] . '</p>';
                        }
                    }
                ?>
            </div>

            <div class="deadline">
            <!-- Display date, deadline and deadline finished -->
                <?php
                    if (sizeof($dataArray) > 0) {
                        foreach ($dataArray as $deadline) {
                            echo '<p>Date:</p>';
                            echo '<p>' . $deadline["Start_Time"] . '</p>';
                            echo '<p>Deadline:</p>';
                            echo '<p>' . $deadline["Deadline"] . '</p>';
                            echo '<p class="deadlineFinished">Deadline finished:</p>';
                            echo '<p>' . ($deadline["deadlineFinished"] ? "Yes" : "No") . '</p>';
                        }
                    }
                ?>
                <span class="finishedColor"></span>
            </div>

            <div class="time">
                <!-- Display forcast time and time spent -->
                <?php
                    if (sizeof($dataArray) > 0) {
                        foreach ($dataArray as $time) {
                            echo '<p>Forcast time:</p>';
                            echo '<p>' . $time["Forcast_Time"] . '</p>';
                            echo '<p>Time spent:</p>';
                            echo '<p>' . $time["TimeSpent"] . '</p>';
                            echo '<p>Finished in time:</p>';
                            echo '<p>' . ($time["finishedInTime"] ? "Yes" : "No") . '</p>';
                        }
                    }
                ?>
                <span class="finishedColor"></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>