<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="SubmitStyle.css">
    <title>Homepage</title>
</head>
<body>
<?php

require_once "../template/header.php";
session_start();

?>

<h1 id="PageName">Submit</h1><br>

<!--WARNINGBOX-->
<div class="alert">
 <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
 Select a subject and a chapter. Then select the time of when to start and when to end <br>
</div>
<!--LAST WEEK PLANNING-->
<form class="lastWeekPlanning">
    <label class="PlanningHeader" style="background-color: transparent;">Last week planning</label><br>

    <label for="finishTasks?" class="questions">Did you finish all the tasks of last week?<br></label>
    <select id="finishTasks?" name="yes/no" required>
        <option value="yes" style="background-color: transparent;">yes</option>
        <option value="no" style="background-color: transparent;">no</option>
    </select><br>
    <label class="questions">Which tasks did you do?</label><br>
        <input type="checkbox" id="first" name="first" value="first" required> <!--where the subjects go-->
        <label for="first" style="background-color: transparent;"><!--where the subjects go-->(the name of the subject)<br></label>
    <label class="questions">Is there a reason why you couldn't finish your tasks?</label><br>
    <label for=""></label><textarea name="" id="" cols="30" rows="10"></textarea>
</form>
<!--THIS WEEK PLANNING-->
<form class="thisWeekPlanning">
    <label class="PlanningHeader" style="background-color: transparent;">This week planning</label><br>
    <ul id="listOfSubjects">
        <?php
        if(isset($_SESSION['submitPlan'])){
            $ticketnummer = 1;
            foreach ($_SESSION['submitPlan'] as $key => $value){
                if($key % 3 == 0){
                    echo '<li class="listItem">';
                    echo "ticket nummer is: " . $ticketnummer . "<br>";
                    $ticketnummer++;
                }
                echo $value . "<br>";
            }
        }
        if(isset($_SESSION['endTask'])){
            foreach ($_SESSION['endTask'] as $key => $endTime){
                echo '<li class="listItem">';
                echo "Time the button was clicked: " . $endTime . "<br>";
            }
        }
        date_default_timezone_set('Europe/Amsterdam');
        echo date(" j , F, Y, H:i", time());
        ?>
    </ul>
</form>
<!--ADD SUBJECT-->
<form action="process.php" id="addToPlanning" method="post">
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
    <label for="startTime" class="label">From: <br></label>
    <input type="time" id="startTime" name="startTime"><br>
<br>
<br>
    <input type="submit" name="submitPlan" value="Submit">
    <input type="button" name="endTask" value="Stop">
</form>
</body>
</html>

<?php

?>



