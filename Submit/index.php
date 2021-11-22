<?php
require_once "../Header/header.php";
require_once "process.php";

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
    <!--PREVIEW-->
    <form method="post">
        <div class="alert" id="previewPlanning" style="line-height: 20px">
            <span class="closebtn" onclick="closePreview(); this.style.height='0';">&#10006;</span>
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
            <button id="confirmButton" type="button" name="prototype" onclick="showPopupSubmit();">Confirm Plan</button>
        </div>
    </form>
    <?php
}
elseif (isset($_SESSION['approved']) && $_SESSION['approved'] == false) { ?>
<span style="color: red; font-size: 20px" >
        <?php
        echo 'Niet alles ingevuld';
        }
        ?>

<!--THIS WEEK PLANNING-->
<form class="thisWeekPlanning">
    <label class="PlanningHeader">This Week Planning</label><br>
    <ul id="listOfTasks">
            <?php
            //GET DATA FROM PLANNING DATABASE
            $sqlActivePlanning = "SELECT categories_and_subjects_subjects_Subject, Description, Layer, Language, Start_Time, Deadline, Forcast_Time, TimeSpent  
FROM tickets
INNER JOIN plannings
ON tickets.Description = plannings.tickets_Description
where IsFinished = 0";
            $resultActiveplannings =  mysqli_query($conn, $sqlActivePlanning);
            if (mysqli_num_rows($resultActiveplannings) > 0) {
                // output data of each row
                while($row = mysqli_fetch_assoc($resultActiveplannings)) {
                    //ECHO ALL DATA IN TABLE
                    ?>
                    <li class="listItem">
                        <?php
                        //CATEGORIE AND SUBJECT VALUES
                        echo $row['categories_and_subjects_subjects_Subject'] . "<br>";
                        //DESCRIPTION, LAYER, LANGUAGE VALUES
                echo "Description : " . $row['Description'] . "<br>";
                        echo "Layer : " . $row['Layer'] . "<br>";
                        echo "Language : " . $row['Language'] . "<br>";
                        //STARTING TIME, DEADLINE, FORECAST TIME VALUES
                    echo "Start Time : " . $row['Start_Time'] . "<br>";
                        echo "Deadline : " . $row['Deadline'] . "<br>";
                        echo "Forcast Time : " . $row['Forcast_Time'] . "<br>";
                        //TIME SPEND VALUE
                        echo "Time Spend : " . $row['TimeSpent'] . "<br>";
        ?>
                        <button  class="Pause" type="button" onclick="return hidePauseButton()">Pause</button>
            <button class="Resume" type="button" onclick="return showPauseButton()">Resume</button>
            <button id="Stop" type="button" onclick="">Stop</button>
                         <span class="material-icons" id="deleteButton" onclick="showPopupDelete();">delete_outline</span>
                    </li>
        <?php
                }
            }
            ?>
    </ul>
</form>
    <!--ADD SUBJECT-->
<form id="addToPlanning" method="post">
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
        <option value="" disabled selected hidden>Choose the Description</option>
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
    <form method="post">
        <!--POP-UP-->
        <div class="pop-up" id="popup">
            <label style="background-color: transparent; font-size: 30px" for=".pop-up" id="popupText"><br></label>
            <button id="yesButton" type="submit" name="submitPlanConfirmed">Yes</button>
            <button id="noButton" type="submit" name="NO" onclick="closePopup();">No</button>
        </div>
    </form>
<script>
    <!-- to hide pause button -->
    // doesn't work as a class'
    let pause = document.getElementsByClassName("Pause");
    let resume = document.getElementsByClassName("Resume");
    let popup = document.getElementById("popup");
    let preview = document.getElementById("previewPlanning");
    let popupText = document.getElementById("popupText");
    let yesbutton = document.getElementById("yesButton");

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
    function closePreview(){
        preview.parentElement.style.height='0';
        preview.parentElement.style.padding='0';

    }
    function showPopupSubmit(){

        yesbutton.name = "submitPlanConfirmed";

        popupText.innerHTML = "Are you sure you want to submit? ";

        popup.style.height="content";
        popup.style.width="50vw";
        popup.style.padding="20px";
        popup.style.opacity="100%";

        /* height to content /
        / padding to 20px /
        / opacity to 100% */
    }
    function closePopup(){
        popup.style.height="unset";
        popup.style.width="0";
        popup.style.padding="0";
        popup.style.opacity="0";

    }
    function showPopupDelete(){

        yesbutton.name = "deleteTaskConfirmed";
        popupText.innerHTML = "Are you sure you want to delete this ticket? ";

        popup.style.height="content";
        popup.style.width="50vw";
        popup.style.padding="20px";
        popup.style.opacity="100%";

        /* height to content /
        / padding to 20px /
        / opacity to 100% */
    }

</script>
</body>
</html>