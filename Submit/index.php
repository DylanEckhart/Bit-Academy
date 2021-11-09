<?php
require_once "../template/header.php";


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "id17762295_bitacademydb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

        if(isset($_POST['submitPlan'])){
            $sql = "SELECT plannings_idplanning,  FROM MyGuests";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                }
            } else {
                echo "0 results";
            }
            $conn->close();

        }

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
    <label for="category" class="label">Category</label><br>
    <select id="category" name="category">
        <?php
        $sqlCategory = "SELECT * FROM categories";
        $resultsCategories = mysqli_query($conn, $sqlCategory);

        if (mysqli_num_rows($resultsCategories) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($resultsCategories)) {
                echo "<option value='" . $row["Category"] . "'>" . $row["Category"] . "</option>";
            }
        }
        ?>
    </select><br>
    <label for="subject" class="label">Subject</label><br>
    <select id="subject" name="subject">
        <?php
        $sqlSubject = "SELECT * FROM subjects";
        $resultsSubjects = mysqli_query($conn, $sqlSubject);

        if (mysqli_num_rows($resultsSubjects) > 0){
            while($row = mysqli_fetch_assoc($resultsSubjects)){
                echo "<option value='" . $row["Subject"] . "'>" . $row["Subject"] . "</option>";
            }
        }

        ?>
    </select><br>
    <label for="preview" class="label">Description</label><br>
    <select id="preview" name="preview">
        <?php
        $sqlDescription = "SELECT description FROM tickets";
        $resultsDescriptions = mysqli_query($conn, $sqlDescription);

        if (mysqli_num_rows($resultsDescriptions) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($resultsDescriptions)) {
                echo "<option value='" . $row["Description"] . "'>" . $row["Description"] . "</option>";
            }
        }
        ?>
    </select><br>
    <br>
    <br>
    <input type="submit" name="submitPlan" value="Submit Task" id="generalButton">
</form>
</body>
</html>



