<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="category_style.css" rel="stylesheet">
<!--    <link href="../style.css" rel="stylesheet">-->
    <title>Category creator</title>
    <link rel="icon" href="../images/icon/favicon.ico" type="image/icon">
</head>
<body>
<?php
require_once "../Header/header.php";
require_once "../DB/connection.php";

session_start();

$conn = openConn();

$_SESSION["selectedCategory"] = null;

$categoriesArray = array();
$subjectsArray = array();
$subjectsCategoriesArray = array();

$getSubjectsQuery = "select * from subjects";
$setSubjects = mysqli_query($conn, $getSubjectsQuery);

$getCategoryQuery = "select * from categories";
$setCategories = mysqli_query($conn, $getCategoryQuery);

if (isset($_POST["selectCategory"])) {
    $_SESSION["selectedCategory"] = $_POST["selectCategory"];

    $getSubjectsWithCategories = "select * from categories_and_subjects where categories_Category = '" . $_SESSION["selectedCategory"] . "'";
    $setSubjectsAndCategories = mysqli_query($conn, $getSubjectsWithCategories);

    while ($row = mysqli_fetch_assoc($setSubjectsAndCategories)) {
        $subjectsCategoriesArray[] = $row;
    }
}

if (isset($_POST["submitCategory"])) {
    addCategoryIntoDB($conn);
    header("Refresh:0.5");
}

if (isset($_POST["submitSubject"])) {
    addSubjectIntoDB($conn);
    header("Refresh:0.5");
}

if (isset($_POST["submitTicket"])) {
    addTicketIntoDB($conn);
}

while ($row = mysqli_fetch_assoc($setCategories)) {
    $categoriesArray[] = $row;
}

while ($row = mysqli_fetch_assoc($setSubjects)) {
    $subjectsArray[] = $row;
}

function addCategoryIntoDB($conn)
{
    $addCategory = $_POST["category"];
    $insertCategory = "insert into categories (Category) values ('$addCategory')";
    if ($addCategory != null) {
        mysqli_query($conn, $insertCategory);
    }
}

function addSubjectIntoDB($conn)
{
    $addSubject = $_POST["subject"];
    $addCategoryForSubject = $_POST["selectCategoryForSubject"];
    $insertSubjectSQL = "insert into subjects (Subject) values ('$addSubject')";
    $insertSubjectAndCategorySQL = "insert into categories_and_subjects (subjects_Subject, categories_Category) VALUES ('$addSubject', '$addCategoryForSubject')";
    if ($addSubject != null && $addCategoryForSubject != null) {
        mysqli_query($conn, $insertSubjectSQL);
        mysqli_query($conn, $insertSubjectAndCategorySQL);
    }
}

function addTicketIntoDB($conn)
{
    $getCategory = $_POST["selectCategory"];
    $getSubject = $_POST["selectSubject"];
    $getLayer = $_POST["layerChooser"];
    $getLanguage = $_POST["language"];
    $getDescription = $_POST["description"];
    $getDeadline = $_POST["deadline"];
    $getTime = $_POST["time"];

//    $insertTicketSQL = "insert into tickets (Description )";

    if ($getCategory != null && $getSubject != null && $getLayer != null && $getLanguage != null && $getDescription != null && $getDeadline != null && $getTime != null) {

    }
}

function showExistingCategory($categoriesArray)
{
    if (sizeof($categoriesArray) > 0) {
        foreach ($categoriesArray as $category) {
            echo "<div>" . $category["Category"] . "</div>";
        }
    } else echo "There are no Categories yet";
}

function showExistingSubjects($subjectArray)
{
    if (sizeof($subjectArray) > 0) {
        foreach ($subjectArray as $subject) {
            echo "<div>" . $subject["Subject"] . "</div>";
        }
    } else echo "There are no Subjects yet";
}

function showCategoriesInOptionForTickets($categoriesArray)
{
    if (sizeof($categoriesArray) > 0) {
        foreach ($categoriesArray as $category) {
            if ($category["Category"] === $_SESSION["selectedCategory"]) {
                echo '<option value="' . $category["Category"] . '" selected>' . $category["Category"] . '</option>';
            } else {
                echo '<option value="' . $category["Category"] . '">' . $category["Category"] . '</option>';
            }
        }
    } else echo "<option>There are no categories yet</option>";
}

function showCategoriesInOption($categoriesArray)
{
    if (sizeof($categoriesArray) > 0) {
        foreach ($categoriesArray as $category) {
            echo '<option value="' . $category["Category"] . '">' . $category["Category"] . '</option>';
        }
    } else echo "<option>There are no categories yet</option>";
}

function showSubjectsInOption($setSubjectAndCategories)
{
    if (sizeof($setSubjectAndCategories) > 0) {
        foreach ($setSubjectAndCategories as $subject) {
            echo '<option value="' . $subject["subjects_Subject"] . '">' . $subject["subjects_Subject"] . '</option>';
        }
    } elseif ($_SESSION["selectedCategory"] === null) {
        echo "<option disabled hidden selected>First choose a category</option>";
    } else echo "<option disabled hidden selected>There are no subjects for this category</option>";
}


?>
<div id="grid">
    <!-- here you can make a category-->
    <div>
        <form class="form" id="formCategory" method="post">
            <h1 class="formTitle">Category</h1>
            <p class="inputTitle">Category</p>
            <input type="text" name="category" class="input" placeholder="ex. PHP">
            <button name="submitCategory" class="Submit">Submit</button>
        </form>
    </div>
    <!--End of category-->

    <!--here you can make the ticket-->
    <form class="form" id="formTicket" method="post">
        <h1 class="formTitle">Ticket</h1>
        <p class="inputTitle">Category</p>
        <select name="selectCategory" id="categorySelection" onchange="this.form.submit()">
            <option value="" disabled selected hidden>Choose the Category</option>
            <?php
            showCategoriesInOptionForTickets($categoriesArray);
            ?>
        </select>
        <p class="inputTitle">Subject</p>
        <select name="selectSubject">
            <option value="" disabled selected hidden>Choose the subject</option>
            <?php
            showSubjectsInOption($subjectsCategoriesArray);
            ?>
        </select>
        <p class="inputTitle">Layer</p>
        <select name="layerChooser">
            <option value="" disabled selected hidden>Choose the layer</option>
            <option value="front-end">Front-end</option>
            <option value="back-end">Back-end</option>
            <option value="both">Front-end and Back-end</option>
        </select>
        <p class="inputTitle">Language</p>
        <input type="text" name="language" placeholder="Language">
        <p class="inputTitle">Description</p>
        <input type="text" name="description" placeholder="Description">
        <p class="inputTitle">Deadline</p>
        <input type="date" name="deadline">
        <p class="inputTitle">Forecast time</p>
        <input type="number" name="time" placeholder="How long will it take">
        <button class="Submit" name="submitTicket" onclick="myFunction()">Add</button>
    </form>
    <!-- end of where you can make the ticket-->

    <!-- here you can make a subject-->
    <div>
        <form class="form" id="formSubject" method="post">
            <h1 class="formTitle">Subject</h1>
            <p class="inputTitle">Category</p>
            <select name="selectCategoryForSubject">
                <option value="" disabled selected hidden>Choose a Category</option>
                <?php
                showCategoriesInOption($categoriesArray);
                ?>
            </select>
            <p class="inputTitle">Subject</p>
            <input type="text" name="subject" class="input" placeholder="ex. cookies">
            <button name="submitSubject" class="Submit">Submit</button>
        </form>
    </div>
    <!--end of where you can make a subject-->

    <!-- Start list of existing category's and subjects  -->
    <div class="listGrid">
        <div class="container">
            <p id="existingtitle">Category's</p>
            <div class="existingList">
                <?php
                showExistingCategory($categoriesArray);
                ?>
            </div>
        </div>

        <div class="container">
            <p id="existingtitle">Subject's</p>
            <div class="existingList">
                <?php
                showExistingSubjects($subjectsArray);
                ?>
            </div>
        </div>
    </div>
    <!-- End list of existing category's and subjects  -->
</div>
</body>

<!--jscript for popup message-->
<script>
    function myFunction() {
        var userPreference;

        if (confirm("Do you want to save changes?") === true) {
            userPreference = "Data saved successfully!";
        } else {
            userPreference = "Save Canceled!";
        }

        document.getElementById("msg").innerHTML = userPreference;
    }
</script>
</html>