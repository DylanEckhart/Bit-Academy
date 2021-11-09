<?php
require_once "../template/header.php";
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="SubmitStyle.css">
    <title>Homepage</title>
</head>
<body>

<h1 id="PageName">Submit</h1><br>

<!--WARNINGBOX-->
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Select a subject and a chapter. Then select the time of when to start and when to end <br>
</div>
<!--THIS WEEK PLANNING-->
<form action="process.php" id="PlanningOvervieuw" method="post" class="thisWeekPlanning">
    <label class="PlanningHeader" style="background-color: transparent;">This week planning</label><br>
    <ul id="listOfSubjects">
        <?php
        $ticketnummer = 1;
        if(isset($_SESSION['submitPlan'])){
            foreach ($_SESSION['submitPlan'] as $key => $value){
                if($key % 3 == 0){
                    echo '<li class="listItem">';
                    echo "ticket nummer is: " . $ticketnummer . "<br>";
                    $ticketnummer++;
                }
                echo $value . "<br>";

                if($key % 3 == 2){
                    ?>
                    <input type="submit" name="pauzeButton" value="Pauze" class="pauzeButton">
                    <input type="submit" name="endTask" value="Finish Task" class="FinishTaskButton">

                    <?php

                }
            }
        }
        ?>
    </ul>
</form>
<!--ADD SUBJECT-->
<form action="process.php" id="addToPlanning" method="post">
    <br>
    <br>
    <label for="subject" class="label">Subject</label><br>
    <select id="subject" name="subject">
        <option value="test1"> test 1</option>
        <option value="test2"> test 2</option>
        <option value="test3"> test 3</option>
    </select><br>
    <label for="chapter" class="label">Chapter</label><br>
    <select id="chapter" name="chapter">
        <option value="test1"> test 1</option>
        <option value="test2"> test 2</option>
        <option value="test3"> test 3</option>
    </select><br>

    <br>
    <br>
    <input type="submit" name="submitPlan" value="Submit Task" id="generalButton">
</form>
</body>
</html>



