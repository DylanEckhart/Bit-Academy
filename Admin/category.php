<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="category_style.css" rel="stylesheet">
    <title>Category creator</title>
    <link rel="icon" href="../Images/icon/favicon.ico" type="image/icon">
</head>
<body>
<?php
require_once "../Header/header.php";
require_once "../DB/connection.php";

session_start();

$conn = openConn();

$categoriesArray = array();
$subjectsArray = array();
$subjectsCategoriesArray = array();
$subjectWithSelectedCategoryArray = array();

if (isset($_SESSION["selectedExistingCategory"])) {
    $getSubjectsQuery = "select * from categories_and_subjects where categories_Category = '" . $_SESSION["selectedExistingCategory"] . "'";
} else {
    $getSubjectsQuery = "select * from categories_and_subjects";
}

$setSubjects = mysqli_query($conn, $getSubjectsQuery);

$getCategoryQuery = "select * from categories";
$setCategories = mysqli_query($conn, $getCategoryQuery);

while ($row = mysqli_fetch_assoc($setCategories)) {
    $categoriesArray[] = $row;
}

while ($row = mysqli_fetch_assoc($setSubjects)) {
    $subjectsArray[] = $row;
}

if (sizeof($categoriesArray) > 0) {
    foreach ($categoriesArray as $category) {
        $category = str_replace(" ", "_", $category);
        if (isset($_POST[$category["Category"]])) {
            $_SESSION["selectedExistingCategory"] = $_POST[$category["Category"]];

            $getSubjectsWithSelectedCategory = "select * from categories_and_subjects where categories_Category = '" . $_SESSION["selectedExistingCategory"] . "'";
            $setSubjectsWithSelectedCategory = mysqli_query($conn, $getSubjectsWithSelectedCategory);

            while ($row = mysqli_fetch_assoc($setSubjectsWithSelectedCategory)) {
                $subjectWithSelectedCategoryArray[] = $row;
            }
            header("Refresh:0.1");
        }
    }
}

if (sizeof($subjectsArray) > 0) {
    foreach ($subjectsArray as $subject) {
        $subject = str_replace(" ", "_", $subject);
        if (isset($_POST[$subject["subjects_Subject"]])) {
            $_SESSION["selectedExistingSubject"] = $_POST[$subject["subjects_Subject"]];
        }
    }
}

if (!isset($_SESSION["selectedExistingCategory"])) {
    $_SESSION["selectedExistingCategory"] = null;
}

if (!isset($_SESSION["selectedExistingSubject"])) {
    $_SESSION["selectedExistingSubject"] = null;
}

if (isset($_POST["selectCategory"])) {
    $_SESSION["selectedCategory"] = $_POST["selectCategory"];

    $getSubjectsWithCategories = "select * from categories_and_subjects where categories_Category = '" . $_SESSION["selectedCategory"] . "'";
    $setSubjectsAndCategories = mysqli_query($conn, $getSubjectsWithCategories);

    while ($row = mysqli_fetch_assoc($setSubjectsAndCategories)) {
        $subjectsCategoriesArray[] = $row;
    }
}

if (isset($_POST["NO"])) {
    unset($_SESSION["createCategory"]);

    unset($_SESSION["createSubject"]);

    unset($_SESSION["selectedCategoryForTicket"]);
    unset($_SESSION["selectedSubjectForTicket"]);
    unset($_SESSION["layerForTicket"]);
    unset($_SESSION["languageForTicket"]);
    unset($_SESSION["descForTicket"]);
    unset($_SESSION["deadlineForTicket"]);
    unset($_SESSION["timeForTicket"]);

    unset($_SESSION["deleteCategory"]);
    unset($_SESSION["deleteSubject"]);
}

if (isset($_POST["submitCategoryPOPUP"])) {
    addCategoryIntoDB($conn);
    unset($_SESSION["createCategory"]);
    header("Refresh:0");
}

if (isset($_POST["submitCategory"])) {
    $_SESSION["createCategory"] = $_POST["category"];
}

if (isset($_POST["submitSubjectPOPUP"])) {
    addSubjectIntoDB($conn);
    unset($_SESSION["createSubject"]);
    header("Refresh:0");
}

if (isset($_POST["submitSubject"])) {
    $_SESSION["createSubject"] = $_POST["subject"];
    $_SESSION["selectedCategoryForSubject"] = $_POST["selectCategoryForSubject"];
}

if (isset($_POST["submitTicketPOPUP"])) {
    addTicketIntoDB($conn);

    unset($_SESSION["selectedCategoryForTicket"]);
    unset($_SESSION["selectedSubjectForTicket"]);
    unset($_SESSION["layerForTicket"]);
    unset($_SESSION["languageForTicket"]);
    unset($_SESSION["descForTicket"]);
    unset($_SESSION["deadlineForTicket"]);
    unset($_SESSION["timeForTicket"]);
}

if (isset($_POST["submitTicket"])) {
    $_SESSION["selectedCategoryForTicket"] = $_POST["selectCategory"];
    $_SESSION["selectedSubjectForTicket"] = $_POST["selectSubject"];
    $_SESSION["layerForTicket"] = $_POST["layerChooser"];
    $_SESSION["languageForTicket"] = $_POST["language"];
    $_SESSION["descForTicket"] = $_POST["description"];
    $_SESSION["deadlineForTicket"] = $_POST["deadline"];
    $_SESSION["timeForTicket"] = $_POST["time"];

}

if (isset($_POST["deleteSubject"])) {
    $_SESSION["deleteSubject"] = true;
}

if (isset($_SESSION["selectedExistingSubject"])) {
    if (isset($_POST["deleteSubPOPUP"])) {
        deleteSubject($_SESSION["selectedExistingSubject"], $conn);
        unset($_SESSION["deleteSubject"]);
    }
}

if (isset($_POST["deleteCategory"])) {
    $_SESSION["deleteCategory"] = true;
}

if (isset($_SESSION["selectedExistingCategory"])) {
    if (isset($_POST["deleteCatPOPUP"])) {
        deleteCategorie($_SESSION["selectedExistingCategory"], $conn);
        unset($_SESSION["deleteCategory"]);
    }
}

function addCategoryIntoDB($conn)
{
    $insertCategory = "insert into categories (Category) values ('" . $_SESSION["createCategory"] . "')";
    if ($_SESSION["createCategory"] != null) {
        mysqli_query($conn, $insertCategory);
    }
}

function addSubjectIntoDB($conn)
{
    $addSubject = $_SESSION["createSubject"];
    $addCategoryForSubject = $_SESSION["selectedCategoryForSubject"];
    $insertSubjectSQL = "insert into subjects (Subject) values ('$addSubject')";
    $insertSubjectAndCategorySQL = "insert into categories_and_subjects (subjects_Subject, categories_Category) VALUES ('$addSubject', '$addCategoryForSubject')";
    if ($addSubject != null && $addCategoryForSubject != null) {
        mysqli_query($conn, $insertSubjectSQL);
        mysqli_query($conn, $insertSubjectAndCategorySQL);
    }
}

function addTicketIntoDB($conn)
{
    if (isset($_SESSION["selectedCategoryForTicket"]) && isset($_SESSION["selectedSubjectForTicket"]) && isset($_SESSION["layerForTicket"]) && isset($_SESSION["languageForTicket"])
        && isset($_SESSION["descForTicket"]) && isset($_SESSION["deadlineForTicket"]) && isset($_SESSION["timeForTicket"])) {
        $getCategory = $_SESSION["selectedCategoryForTicket"];
        $getSubject = $_SESSION["selectedSubjectForTicket"];
        $getLayer = $_SESSION["layerForTicket"];
        $getLanguage = $_SESSION["languageForTicket"];
        $getDescription = $_SESSION["descForTicket"];
        $getDeadline = $_SESSION["deadlineForTicket"];
        $getTime = $_SESSION["timeForTicket"];

        $insertTicketSQL = "insert into tickets (Description, Layer, `Forcast_Time`, Deadline, categories_and_subjects_subjects_Subject, Language) 
                        values ('$getDescription', '$getLayer', '$getTime', '$getDeadline', '$getSubject', '$getLanguage')";

        if ($getCategory != null && $getSubject != null && $getLayer != null && $getLanguage != null && $getDescription != null && $getDeadline != null && $getTime != null) {
            mysqli_query($conn, $insertTicketSQL);
        } else {
            echo false;
        }
    }
}

function showExistingCategory($categoriesArray)
{
    if (sizeof($categoriesArray) > 0) {
        foreach ($categoriesArray as $category) {
            echo "<button id='existingButton' name='" . $category["Category"] . "' value='" . $category["Category"] . "' onclick='this.form.submit()'>" . $category["Category"] . "</button>";
        }
    } else echo "<div>There are no Categories yet</div>";
}

function showExistingSubjects($subjectArray, $selectedCategory)
{
    if (isset($selectedCategory)) {
        if (sizeof($subjectArray) > 0) {
            foreach ($subjectArray as $subject) {
                echo "<button id='existingButton' name='" . $subject["subjects_Subject"] . "' value='" . $subject["subjects_Subject"] . "' onclick='this.form.submit()'>" . $subject["subjects_Subject"] . "</button>";
            }
        } else echo "<div>There are no subjects for this category yet</div>";
    } elseif (sizeof($subjectArray) > 0) {
        foreach ($subjectArray as $subject) {

            echo "<button id='existingButton' name='" . $subject["subjects_Subject"] . "' value='" . $subject["subjects_Subject"] . "' onclick='this.form.submit()'>" . $subject["subjects_Subject"] . "</button>";

        }
    } else echo "<div>There are no Subjects yet</div>";
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
    } else echo "<option disabled hidden selected>There are no categories yet</option>";
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

function deleteSubject($selectedSubject, $conn)
{
    $deleteSubjectFromCategoriesAndSubjects = "DELETE FROM `categories_and_subjects` WHERE `categories_and_subjects` . `subjects_Subject` =  '" . $selectedSubject . "'";
    $deleteSubjectFromTickets = "DELETE FROM tickets WHERE categories_and_subjects_subjects_Subject = '" . $selectedSubject . "'";
    $deleteSubjectFromSubjects = "DELETE FROM `subjects` WHERE `subjects` . `Subject` = '" . $selectedSubject . "'";
    mysqli_query($conn, $deleteSubjectFromCategoriesAndSubjects);
    mysqli_query($conn, $deleteSubjectFromTickets);
    if (!mysqli_query($conn, $deleteSubjectFromSubjects)) {
        echo "<script>alert('This subject can not be deleted because there is an existing planning with it')</script>";
    }
    header("Refresh:0.1");
}

function deleteCategorie($selectedCategory, $conn)
{
    $getSubjectWithSelectedCategroies = "select subjects_Subject from categories_and_subjects where categories_Category = '" . $selectedCategory . "'";
    $setsubjectsFromSelectedCategory = mysqli_query($conn, $getSubjectWithSelectedCategroies);
    while ($row = mysqli_fetch_assoc($setsubjectsFromSelectedCategory)) {
        $subjectsFromSelectedCategory[] = $row;
    }

    foreach ($subjectsFromSelectedCategory as $subject) {
        $deleteCategoryFromTickets = "DELETE FROM tickets where categories_and_subjects_subjects_Subject = '" . $subject["subjects_Subject"] . "'";
        mysqli_query($conn, $deleteCategoryFromTickets);
    }

    $deleteCategoryFromCategories = "DELETE FROM `categories` WHERE `categories` . `Category` = '" . $selectedCategory . "'";
    $deleteCategoryFromCategoriesAndSubjects = "DELETE FROM `categories_and_subjects` WHERE `categories_and_subjects` . `categories_Category` = '" . $selectedCategory . "'";
    mysqli_query($conn, $deleteCategoryFromCategoriesAndSubjects);
    if (!mysqli_query($conn, $deleteCategoryFromCategories)) {
        echo "<script>alert('This category can not be deleted because there is an existing planning with it')</script>";
    }
    header("Refresh:0.1");
}

function showSelectedSubject($selectedSubject)
{
    if (isset($selectedSubject)) {
        echo $selectedSubject;
    } else {
        echo "None";
    }
}

function showSelectedCategory($selectedCategory)
{
    if (isset($selectedCategory)) {
        echo $selectedCategory;
    } else {
        echo "None";
    }
}

function unsetSelectedCategory($categoriesArray)
{
    if (isset($_SESSION["selectedExistingCategory"])) {
        if (!array_search($_SESSION["selectedExistingCategory"], array_column($categoriesArray, "Category"))) {
            $_SESSION["selectedExistingCategory"] = null;
        }
    }
}

function unsetSelectedSubject($subjectsArray)
{
    if (isset($_SESSION["selectedExistingSubject"])) {
        if (!array_search($_SESSION["selectedExistingSubject"], array_column($subjectsArray, "subjects_Subject"))) {
            $_SESSION["selectedExistingSubject"] = null;
        }
    }
}

unsetSelectedCategory($categoriesArray);
unsetSelectedSubject($subjectsArray);

?>
<div id="body">
    <div id="grid">
        <!-- here you can make a category-->
        <div>
            <form class="form" id="formCategory" method="post">
                <h1 class="formTitle">Create Category</h1>
                <p class="inputTitle">Category</p>
                <input type="text" name="category" class="input" placeholder="ex. PHP" required>
                <button class="Submit" name="submitCategory">Submit</button>
            </form>
        </div>
        <!--End of category-->

        <!--here you can make the ticket-->
        <form class="form" id="formTicket" method="post">
            <h1 class="formTitle">Ticket</h1>
            <p class="inputTitle">Category</p>
            <select name="selectCategory" id="categorySelection" onchange="this.form.submit()" required>
                <option value="" disabled selected hidden>Choose the Category</option>
                <?php
                showCategoriesInOptionForTickets($categoriesArray);
                ?>
            </select>
            <p class="inputTitle">Subject</p>
            <select name="selectSubject" required>
                <option value="" disabled selected hidden>Choose the subject</option>
                <?php
                showSubjectsInOption($subjectsCategoriesArray);
                ?>
            </select>
            <p class="inputTitle">Layer</p>
            <select name="layerChooser" required>
                <option value="" disabled selected hidden>Choose the layer</option>
                <option value="front-end">Front-end</option>
                <option value="back-end">Back-end</option>
                <option value="front-end_back-end">Front-end and Back-end</option>
            </select>
            <p class="inputTitle">Language</p>
            <input type="text" name="language" placeholder="Language" required>
            <p class="inputTitle">Description</p>
            <input type="text" name="description" placeholder="Description" required>
            <p class="inputTitle">Deadline</p>
            <input type="date" name="deadline" required>
            <p class="inputTitle">Forecast time</p>
            <input type="number" name="time" placeholder="How long will it take" required>
            <button class="Submit" name="submitTicket">Add</button>
        </form>
        <!-- end of where you can make the ticket-->

        <!-- here you can make a subject-->
        <div>
            <form class="form" id="formSubject" method="post">
                <h1 class="formTitle">Create subject</h1>
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
            <div class="container" id="existingCategories">
                <p id="existingtitle">Category's</p>
                <form class="existingForm" method="post">
                    <div class="existingList">
                        <?php
                        showExistingCategory($categoriesArray);
                        ?>
                    </div>
                    <button class="delete" name="deleteCategory">Delete Category</button>
                </form>
            </div>

            <div class="container" id="SelectedCatAndSub">
                <div class="listContainer" id="selectedCategory">
                    <p id="existingtitle" class="selectedTitle">Selected Category</p>
                    <div class="selectedList">
                        <?php
                        showSelectedCategory($_SESSION["selectedExistingCategory"]);
                        ?>
                    </div>
                </div>
                <div class="listContainer" id="selectedSubject">
                    <p id="existingtitle" class="selectedTitle">Selected Subject</p>
                    <div class="selectedList">
                        <?php
                        showSelectedSubject($_SESSION["selectedExistingSubject"]);
                        ?>
                    </div>
                </div>
            </div>

            <div class="container" id="existingSubject">
                <p id="existingtitle">Subject's</p>
                <form class="existingForm" method="post">
                    <div class="existingList">
                        <?php
                        showExistingSubjects($subjectsArray, $_SESSION["selectedExistingCategory"]);
                        ?>
                    </div>
                    <button class="delete" name="deleteSubject">Delete Subject</button>
                </form>
            </div>
        </div>
        <!-- End list of existing category's and subjects  -->
    </div>
</div>

<!-- POP-UP -->
<form method="post">
    <!--POP-UP-->
    <div class="pop-up" id="popup">
        <label style="background-color: transparent; font-size: 30px" for=".pop-up" id="popupText"><br></label>
        <button id="yesButton" type="submit">Yes</button>
        <button id="noButton" type="submit" name="NO" onclick="closePopup();">No</button>
    </div>
</form>
<!--jscript for popup message-->
<script>
    let popup = document.getElementById("popup");
    let popupText = document.getElementById("popupText");
    let yesbutton = document.getElementById("yesButton");

    function showPopupCreaCat() {

        yesbutton.setAttribute("name", "submitCategoryPOPUP");
        yesbutton.name = "submitCategoryPOPUP";

        popupText.innerHTML = "Are your sure you want to create this category? <br>";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";
        return false;
    }

    function showPopupCreaSub() {

        yesbutton.setAttribute("name", "submitSubjectPOPUP");
        yesbutton.name = "submitSubjectPOPUP";

        popupText.innerHTML = "Are your sure you want to create this subject? <br>";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";
        return false;
    }

    function showPopupCreaTic() {

        yesbutton.setAttribute("name", "submitTicketPOPUP");
        yesbutton.name = "submitTicketPOPUP";

        popupText.innerHTML = "Are your sure you want to create this Ticket? <br>";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";
        return false;
    }

    function showPopupDelCat() {

        yesbutton.setAttribute("name", "deleteCatPOPUP");
        yesbutton.name = "deleteCatPOPUP";

        popupText.innerHTML = "Are your sure you want to delete this category? By doing this you will remove all the tickets and subjects belonging to this category <br>";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";
        return false;
    }

    function showPopupDelSub() {

        yesbutton.setAttribute("name", "deleteSubPOPUP");
        yesbutton.name = "deleteSubPOPUP";

        popupText.innerHTML = "Are your sure you want to delete this subject? <br>";

        popup.style.height = "content";
        popup.style.width = "50vw";
        popup.style.padding = "20px";
        popup.style.opacity = "100%";
        return false;
    }

    function closePopup() {
        popup.style.height = "unset";
        popup.style.width = "0";
        popup.style.padding = "0";
        popup.style.opacity = "0";
    }
</script>
<?php
if (isset($_SESSION["createCategory"])) {
    if ($_SESSION["createCategory"] != null) {
        echo "<script type='text/javascript'>showPopupCreaCat()</script>";
    }
}

if (isset($_SESSION["createSubject"])) {
    if ($_SESSION["createSubject"] != null) {
        echo "<script type='text/javascript'>showPopupCreaSub()</script>";
    }
}

if (isset($_SESSION["selectedCategoryForTicket"]) && isset($_SESSION["selectedSubjectForTicket"]) && isset($_SESSION["layerForTicket"]) && isset($_SESSION["languageForTicket"])
    && isset($_SESSION["descForTicket"]) && isset($_SESSION["deadlineForTicket"]) && isset($_SESSION["timeForTicket"])) {
    if ($_SESSION["selectedCategoryForTicket"] != null && $_SESSION["selectedSubjectForTicket"] != null && $_SESSION["layerForTicket"] != null && $_SESSION["languageForTicket"] !=
        null && $_SESSION["descForTicket"] != null && $_SESSION["deadlineForTicket"] != null && $_SESSION["timeForTicket"] != null) {
        echo "<script type='text/javascript'>showPopupCreaTic()</script>";
    }
}

if (isset($_SESSION["deleteCategory"])) {
    if ($_SESSION["deleteCategory"] != null) {
        echo "<script type='text/javascript'>showPopupDelCat()</script>";
    }
}

if (isset($_SESSION["deleteSubject"])) {
    if ($_SESSION["deleteSubject"] != null) {
        echo "<script type='text/javascript'>showPopupDelSub()</script>";
    }
}
?>
</body>
</html>