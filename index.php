<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Pre_Planning_Style.css">
    <title>Previous Plannings</title>
    <link rel="icon" href="images/icon/favicon.ico" type="image/icon">
</head>
<body>
<header>
    <img src="images/logo.png" alt="Logo" id="logo">
    <ul id="header">
        <li class="navbar"><a href="">login</a></li>
        <li class="navbar"><a href="">register</a></li>
        <li class="navbar"><a href="">profile</a></li>
    </ul>
</header>
<?php
require_once 'connection.php';
?>

<!--pre-plannings of the student-->
<div id="PrePlanning">
    <h1 id="pagetitle">Previous Plannings</h1>
    <div id="PlanningGrid">
        <div class="GridItem">
            <div class="category">
                <ul class="ticketList">
                    <li><p class="ticket_title">PHP</p></li>
                    <li><p class="ticket_desc">- Subject</p></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa
                    sapien</p>
            </div>
            <div name="deadline" class="deadline">
                <p>Date:</p>
                <p>26-10-2021</p>
                <p>Deadline:</p>
                <p> 25-11-2021</p>
                <p>Deadline finished:</p>
                <p class="deadlineFinished">yes or no</p>
                <span class="finishedColor"></span>
            </div>

            <div name="time" class="time">
                <p>Scheduled time:</p>
                <p>5 hours</p>
                <p>Time spent:</p>
                <p>5:30 hours</p>
            </div>
        </div>

        <div class="GridItem">
            <div class="category">
                <ul class="ticketList">
                    <li><p class="ticket_title">PHP</p></li>
                    <li><p class="ticket_desc">- Subject</p></li>
                </ul>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque massa sapien</p>
            </div>
            <div class="deadline">
                <p>Date:</p>
                <p>26-10-2021</p>
                <p>Deadline:</p>
                <p> 25-11-2021</p>
                <p>Deadline finished:</p>
                <p>yes or no</p>
            </div>

            <div class="time2">
                <p>Scheduled time:</p>
                <p>5 hours</p>
                <p>Time spent:</p>
                <p>5:30 hours</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>