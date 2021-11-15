<?php
require_once "../Header/header.php";

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
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Submit</title>
    <link rel="icon" href="../Images/icon/favicon.ico" type="image/icon">
</head>
<body>

<h1 id="PageName">Submit</h1><br>

<?php
if(isset($_SESSION['approved']) && $_SESSION['approved'] == true){
    ?>
<!--WARNINGBOX-->
    <form action="process.php" id="addToPlanning" method="post">
<div class="alert" style="line-height: 20px">
    <span class="closebtn" onclick="this.parentElement.style.height='0'; this.parentElement.style.padding='0';">&#10006;</span>
    <label style="background-color: transparent; font-size: 30px" for=".alert">Preview <br> <br></label>
    <?php
    foreach ($_SESSION['submitPlan'] as $key => $value) {
        if ($key == 0) {
            echo "Category = " . $value . "<br>";
        }
        if ($key == 1) {
            echo "Subject = " . $value . "<br>";
        }
        if ($key == 2) {
            echo "Description = " . $value . "<br>";
        }
    }
    ?>
    <button id="confirmButton" type="submit" name="submitPlanConfirmed" onclick="sumbitTasks()">Confirm Plan</button>
    </div>
    </form>
<?php
}
else if (isset($_SESSION['approved']) && $_SESSION['approved'] == false) { ?>
    <span style="color: red; font-size: 20px" >
        <?php
    echo 'Niet alles ingevuld';
}
?>

<!--THIS WEEK PLANNING-->
<form class="thisWeekPlanning">
    <label class="PlanningHeader">This week planning</label><br>

    <ul id="listOfTasks">
        <li class="listItem">
            <span class="material-icons" id="deleteButton" onclick="deleteTask()">delete_outline</span>
            item1 - chapter 1 <br>Start Time: 09:30 <br>
            <button  id="Pause" onclick="return hidePauseButton()">Pause</button>
            <button id="Resume" onclick="return showPauseButton()">Resume</button>
            <button id="Stop" onclick="stopTasks()">Stop</button>
        </li>
    </ul>
</form>
<!--ADD SUBJECT-->
<form action="process.php" id="addToPlanning" method="post">
    <label for="category" class="label">Category</label>
    <select id="category" name="category">
        <option value="" disabled selected hidden>Choose the Category</option>
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
    </select>
    <label for="subject" class="label">Subject</label>
    <select id="subject" name="subject">
        <option value="" disabled selected hidden>Choose the Subject</option>
        <?php
        $sqlSubject = "SELECT * FROM subjects";
        $resultsSubjects = mysqli_query($conn, $sqlSubject);

        if (mysqli_num_rows($resultsSubjects) > 0){
            while($row = mysqli_fetch_assoc($resultsSubjects)){
                echo "<option value='" . $row["Subject"] . "'>" . $row["Subject"] . "</option>";
            }
        }
        ?>
    </select>
    <label for="description" class="label">Description</label>
    <select id="description" name="description">
        <option value="" disabled selected hidden>Choose the Discription</option>
        <?php
        $ticketdescriptionArray = array();

        $sqlDescription = "SELECT * FROM tickets";
        $resultsDescriptions = mysqli_query($conn, $sqlDescription);

        if (mysqli_num_rows($resultsDescriptions) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($resultsDescriptions)) {
                echo "<option value='" . $row["Description"] . "'>" . $row["Description"] . "</option>";
            }
        }
        ?>
    </select>
    <button id="planButton" type="submit" name="submitPlan">Plan</button>
</form>
<br>
<br>
<script>
    <!-- to hide pause button -->
    let pause = document.getElementById("Pause");
    let resume = document.getElementById("Resume");

    function showPauseButton() {
        pause.style.display = "inline";
        resume.style.display = "none";
        return false;
    }

    function hidePauseButton() {
        resume.style.display = "inline";
        pause.style.display = "none";
        return false;
    }
    function stopTasks() {
        if (confirm('Are you sure? This will move the task and move it to the history.')) {
            // Save it! OK
        } else {
            // Do nothing! Cancel
        }
        return false;
    }
    function deleteTask() {
        if (confirm('Are you sure? This will remove the task forever.')) {
            // Save it! OK
        } else {
            // Do nothing! Cancel
        }
        return false;
    }
    function pauzetask() {
        if (confirm('Are you sure? This will Pauze the task')) {
            // Save it! OK
        } else {
            // Do nothing! Cancel
    }
        return false;
    }
    function sumbitTasks(){
        (alert("Succesfully submitted"));
        }
</script>
</body>
</html>
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

?>

