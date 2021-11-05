<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="catagory_style.css" rel="stylesheet">
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
            <h1 class="formTitle">Make a new catagory</h1>
            <p class="inputTitle">Subject</p>
            <input type="text" name="Subject" class="input" placeholder="ex. PHP">
            <button name="submitSubject" class="Submit">Submit</button>
        </form>
    </div>

    <form class="form">
        <h1 class="formTitle">Make a new subject</h1>
        <p class="inputTitle">subject</p>
        <select name="selectSubject">
            <option value="" disabled selected hidden>choose the subject</option>
            <?php
            $getSubjectsQuery = "select Subject from subjects";
            $setSubjects = mysqli_query($getSubjectsQuery);

            if (mysqli_num_rows())
            ?>
            <option value="test2">test</option>
            <option value="test3">test</option>
            <option value="test4">test</option>
        </select>
        <p class="inputTitle">layer</p>
        <select name="endchooser">
            <option value="" disabled selected hidden>choose the layer</option>
            <option value="front-end">Front-end</option>
            <option value="back-end">Back-end</option>
        </select>
        <p class="inputTitle">Language</p>
        <input type="text" name="language" placeholder="language">
        <p class="inputTitle">description</p>
        <input type="text" name="description" placeholder="description">
        <p class="inputTitle">Forecast time</p>
        <input type="number" name="time" placeholder="how long will it take">
        <button class="Submit">Add</button>
    </form>
</div>
</body>
</html>