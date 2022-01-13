<?php
require_once "../Header/header.php";
require_once "process.php";

//$servername = "localhost";
//$username = "root";
//$password = "";
//$dbname = "id17762295_bitacademydb";
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
require_once "../DB/connection.php";

$conn = openConn();

//GET DATA FROM PLANNING DATABASE
$sqlActivePlanning = "SELECT idplanning, categories_and_subjects_subjects_Subject, Description, Layer, Language, Start_Time, Deadline, Forcast_Time, TimeSpent, isFinished 
FROM tickets
INNER JOIN plannings
ON tickets.Description = plannings.tickets_Description
where IsFinished = 0";

$resultActiveplannings = mysqli_query($conn, $sqlActivePlanning);
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
if (isset($_SESSION['approved']) && $_SESSION['approved'] == true) {
    ?>
    <!--PREVIEW-->
    <form method="post">
        <div class="alert" id="previewPlanning" style="line-height: 20px">
            <span class="closebtn" onclick="closePreview(); this.style.height='0';">&#10006;</span>
            <label style="background-color: transparent; font-size: 30px" for=".alert">Preview <br> <br></label>
            <?php
            foreach ($_SESSION['submitPlan'] as $key => $value) {
                if ($key == 0) {
                    echo "<strong>CATEGORY</strong> = " . $value . "<br>";
                }
                if ($key == 1) {
                    echo "<strong>SUBJECT</strong> = " . $value . "<br>";
                }
                if ($key == 2) {
                    echo "<strong>DESCRIPTION</strong> = " . $value . "<br>";
                }
            }
            ?>
            <button id="confirmButton" type="button" name="prototype" onclick="showPopupSubmit();">Confirm Plan</button>
        </div>
    </form>
    <?php
} elseif (isset($_SESSION['approved']) && $_SESSION['approved'] == false) {
    echo '<span style="color: red; font-size: 20px">';
    echo 'Niet alles ingevuld';
    echo '</span>';
}

echo '<form class="thisWeekPlanning" method="post">';
?>
<label class="PlanningHeader">This week planning</label><br>
<ul id="listOfTasks">
    <?php
    //THIS WEEK PLANNING
    if (mysqli_num_rows($resultActiveplannings) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($resultActiveplannings)) {
            echo "<li class='listItem'>";
            $_SESSION["ticketsArray"][] = $row;
            //ECHO ALL DATA IN TABLE
            //CATEGORIE AND SUBJECT VALUES
            echo $row['categories_and_subjects_subjects_Subject'] . "<br>";
            //DESCRIPTION, LAYER, LANGUAGE VALUES
            echo "Description : " . $row['Description'] . "<br>";
            echo "Layer : " . $row['Layer'] . "<br>";
            echo "Language : " . $row['Language'] . "<br>";
            //STARTING TIME, DEADLINE, FORECAST TIME VALUES
            echo "Start Time : " . $row['Start_Time'] . "<br>";
            echo "Deadline : " . $row['Deadline'] . "<br>";
            echo "Forcast Time : " . $row['Forcast_Time'] . " hours" . "<br>";
            echo
            "<button  id='Pause' type='button' onclick='return hidePauseButton()'>Pause</button>";
            echo
            "<button  id='Resume' type='button' onclick='return showPauseButton()'>Resume</button>";
            ?>
            <?php
            echo
                "<button id='Stop' value='" . $row["idplanning"] . "' name='finishFase1' type='submit'>Stop</button>";
            echo
                "<button id='deleteButton' type='submit' name='deleteFase1' value='" . $row["idplanning"] . "'>
                         <span class='material-icons' onclick='' id='deleteText'>delete_outline</span>
                            </button>";
            ?>
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
            while ($row = mysqli_fetch_assoc($resultsCategories)) {
                echo "<option value='" . $row["Category"] . "'>" . $row["Category"] . "</option>";
            }
        }

        ?>
    </select>
    <label for="subject" class="label">Subject</label>
    <select id="subject" name="subject">
        <option value="" disabled selected hidden>Choose the Subject</option>
        <?php
        $sqlSubject = "SELECT * FROM categories_and_subjects";
        $resultsSubjects = mysqli_query($conn, $sqlSubject);

        if (mysqli_num_rows($resultsSubjects) > 0) {
            while ($row = mysqli_fetch_assoc($resultsSubjects)) {
                echo "<option value='" . $row["subjects_Subject"] . "'>" . $row["subjects_Subject"] . "</option>";
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
            while ($row = mysqli_fetch_assoc($resultsDescriptions)) {
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
    <!--POP-UP SUBMIT-->
    <div class="pop-up" id="popup">
        <label style="background-color: transparent; font-size: 30px" for=".pop-up" id="popupText">
            <br></label>
        <button id="yesButton" type="submit" name="submitPlanConfirmed">Yes</button>
        <button id="noButton" type="submit" name="NO" onclick="closePopup();">No</button>
    </div>
</form>
<form method="post">
    <!--POP-UP DELETE-->
    <div class="pop-up" id="popup">
        <label style="background-color: transparent; font-size: 30px" for=".pop-up" id="popupText">Are you sure you want
            to delete this
            ticket? <br></label>
        <button id="yesButton" type="submit" name="Delete">Yes</button>
        <button id="noButton" type="submit" name="NO" onclick="closePopup()">No</button>
    </div>
</form>
<form method="post">
    <!--POP-UP FINISH-->
    <div class="pop-up" id="popup">
        <label style="background-color: transparent; font-size: 30px" for=".pop-up" id="popupText">Are you sure you want
            to delete this
            ticket? <br></label>
        <button id="yesButton" type="submit" name="Finish">Yes</button>
        <button id="noButton" type="submit" name="NO" onclick="closePopup()">No</button>
    </div>
</form>

<script>
    <!-- to hide pause button -->
    // doesn't work as a class'
    let resume = document.getElementById("Resume");
    let pause = document.getElementById("Pause");
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

    function sumbitTasks() {
        (alert("Succesfully submitted"));
    }

    function closePreview() {
        preview.parentElement.style.height = '0';
        preview.parentElement.style.padding = '0';
    }

    function showPopupSubmit() {

        yesbutton.name = "submitPlanConfirmed";

        popupText.innerHTML = "Are you sure you want to submit this ticket? ";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";
    }

    function showPopup() {
        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";

        /* height to content /
        / padding to 20px /
        / opacity to 100% */
    }

    function closePopup() {
        popup.style.height = "unset";
        popup.style.width = "0";
        popup.style.padding = "0";
        popup.style.opacity = "0";

    }

    function showPopupDelete() {

        yesbutton.name = "Delete";
        popupText.innerHTML = "Are you sure you want to delete this ticket? ";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";

        /* height to content /
        / padding to 20px /
        / opacity to 100% */
    }

    function showPopupFinished() {

        yesbutton.name = "finish";
        popupText.innerHTML = "Are you sure you are done with your ticket?";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";

        /* height to content /
        / padding to 20px /
        / opacity to 100% */
    }

</script>
<?php
if (isset($_SESSION["id"])) {
    if ($_SESSION["id"] != null) {
        echo "<script type='text/javascript'>showPopupDelete()</script>";
    }
}
if (isset($_SESSION["idFinished"])) {
    if ($_SESSION["idFinished"] != null) {
        echo "<script type='text/javascript'>showPopupFinished()</script>";
    }
}
?>
</body>
</html>