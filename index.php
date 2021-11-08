<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Header/style.css">
    <title>Homepage</title>
</head>
<body>
<?php
    require_once "Header/header.php";
?>

<h1 id="PageName">Submit</h1><br>

<!--WARNINGBOX-->
<div class="alert">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Select a subject and a chapter. Then select the time of when to start and when to end <br>
</div>
<!--THIS WEEK PLANNING-->
<form class="thisWeekPlanning">
    <label class="PlanningHeader" style="background-color: transparent;">This week planning</label><br>

    <ul id="listOfSubjects">
        <li class="listItem">item1 - chapter 1 <br> 09:30 - 16:00</li>
        <li class="listItem">item2 - chapter 3 <br> 09:30 - 16:00</li>
    </ul>
</form>
<!--ADD SUBJECT-->
<form action="index.php" id="addToPlanning">
    <label for="subject" class="label">Subject</label><br>
    <select id="subject" name="subject">
        <option value="test1">test 1</option>
        <option value="test2">test 2</option>
        <option value="test3">test 3</option>
    </select><br>
    <label for="chapter" class="label">Chapter</label><br>
    <select id="chapter" name="chapter">
        <option value="test1">test 1</option>
        <option value="test2">test 2</option>
        <option value="test3">test 3</option>
    </select><br>
</form>
<br>
<br>
<button>Plan</button>




</body>
</html>