<?php

    //Connect to the database
    require_once '../DB/connection.php';
    require_once 'index.php';
    $connection = openConn();

    // Load tickets
    function loadTickets($dataArray) {
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

