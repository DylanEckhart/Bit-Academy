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
    <!-- Include Header -->
    <?php
        require_once "../Header/header.php";
    ?>

    <!-- Include database connection and ticketLoad -->
    <?php
        require_once '../DB/connection.php';
        require_once 'ticketLoad.php';
    ?>

    <!-- Previous tickets of the students -->
    <div id="PrePlanning">
        <h1 id="pagetitle">Previous Plannings</h1>
        <div id="PlanningGrid">
            <div class="GridItem">
                <div class="category">
                    <div class="ticketList">
                        <p class="ticket_title">PHP</p>
                        <p class="ticket_desc">- Subject</p>
                    </div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa sapien</p>
                </div>
                <div class="deadline">
                    <p>Date:</p>
                    <p>26-10-2021</p>
                    <p>Deadline:</p>
                    <p> 25-11-2021</p>
                    <p class="deadlineFinished">Deadline finished:</p>
                    <p>Yes or No</p>
                    <span class="finishedColor"></span>
                </div>

                <div class="time">
                    <p>Scheduled time:</p>
                    <p>5 hours</p>
                    <p>Time spent:</p>
                    <p>5:30 hours</p>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
</body>
</html>