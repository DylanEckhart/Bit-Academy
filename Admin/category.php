<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="category_style.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Category creator</title>
</head>
<body>
<?php
require_once "../Template/header.php";
require_once "../DB/connection.php";

$conn = openConn();
?>
<div id="grid">
    <div>
        <form class="form">
            <h1 class="formTitle">Category</h1>
            <p class="inputTitle">Category</p>
            <input type="text" name="Category" class="input" placeholder="ex. PHP">
            <button name="submitCategory" class="Submit">Submit</button>
        </form>
    </div>

    <form class="form">
        <h1 class="formTitle">Ticket</h1>
        <p class="inputTitle">Category</p>
        <select name="selectCategory">
            <option value="" disabled selected hidden>Choose the Category</option>
            <?php
            $getSubjectsQuery = "select Subject from subjects";
            $setSubjects = mysqli_query($getSubjectsQuery);

            if (mysqli_num_rows())
            ?>
            <option value="test2">test</option>
            <option value="test3">test</option>
            <option value="test4">test</option>
        </select>
        <p class="inputTitle">Subject</p>
        <select name="selectSubject">
            <option value="" disabled selected hidden>Choose the subject</option>
            <option value="test2">test</option>
            <option value="test3">test</option>
            <option value="test4">test</option>
        </select>
        <p class="inputTitle">Layer</p>
        <select name="layer_chooser">
            <option value="" disabled selected hidden>Choose the layer</option>
            <option value="front-end">Front-end</option>
            <option value="back-end">Back-end</option>
        </select>
        <p class="inputTitle">Language</p>
        <input type="text" name="language" placeholder="Language">
        <p class="inputTitle">Description</p>
        <input type="text" name="Description" placeholder="Description">
        <p class="inputTitle">Forecast time</p>
        <input type="number" name="time" placeholder="How long will it take">
        <button class="popup" onclick="myFunction()">
            <span class="popuptext" id="myPopup">A Simple Popup!</span>
            Add
        </button>
    </form>

    <div>
        <form class="form">
            <h1 class="formTitle">Subject</h1>
            <p class="inputTitle">Subject</p>
            <input type="text" name="Subject" class="input" placeholder="ex. cookies">
            <button name="submitSubject" class="Submit">Submit</button>
        </form>
    </div>
</div>
</body>
<!--jscript for popup message-->
<script>
    // When the user clicks on <div>, open the popup
    function myFunction() {
        var popup = document.getElementById("myPopup");
        popup.classList.toggle("show");
    }
</script>
</html>