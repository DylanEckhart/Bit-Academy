<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <link href="category_style.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <title>Category creator</title>
</head>
<body>
<?php
require_once "../Template/header.php";
require_once "../DB/connection.php";

//$conn = openConn();
//
//$getSubjectQuery = "select Subject from subjects";
//$setSubjects = mysqli_query($conn, $getSubjectQuery);
//
////$getCategoryQuery = "select Category from categories";
////$setCategories = mysqli_query($conn, $getCategoryQuery);
//
//function addCategoryIntoDB($conn)
//{
//    $addCategory = $_POST["category"];
////    $insertCategory = "insert into categories (Category) values ('$addCategory')";
////    if ($addCategory != null) {
////    mysqli_query($conn, $insertCategory);
////    }
//}
//
//function addSubjectIntoDB($conn)
//{
//    $addSubject = $_POST["subject"];
//    $insertSubjectSQL = "insert into subjects (Subject) values ('$addSubject')";
//    if ($addSubject != null) {
//        mysqli_query($conn, $insertSubjectSQL);
//    }
//}
//
//function addTicketIntoDB($conn) {
//    $getCategory = $_POST["selectCategory"];
//    $getSubject = $_POST["selectSubject"];
//    $getLayer = $_POST["layer_chooser"];
//    $getLanguage = $_POST["language"];
//    $getDescription = $_POST["description"];
//    $getDeadline = $_POST["deadline"];
//    $getTime = $_POST["time"];
//
////    $insertTicketSQL = "insert into tickets (Description )";
//
////    if ($getCategory != null && $getSubject != null && $getLayer != null && $getLanguage != null && $getDescription != null && $getDeadline != null && $getTime != null) {
////
////    }
//}
//
//function showExistingCategory($setCategories)
//{
////    if (mysqli_num_rows($setCategories) > 0) {
////        while ($row = mysqli_fetch_assoc($setCategories)) {
////            echo "<div>" . $row["Category"] . "</div>";
////        }
////    }
//}
//
//function showExistingSubjects($setSubjects)
//{
//    if (mysqli_num_rows($setSubjects) > 0) {
//        while ($row = mysqli_fetch_assoc($setSubjects)) {
//            echo "<div>" . $row["Subject"] . "</div>";
//        }
//    }
//}
//
//if (isset($_POST["submitCategory"])) {
//    addCategoryIntoDB($conn);
//}
//
//if (isset($_POST["submitSubject"])) {
//    addSubjectIntoDB($conn);
//}
//
//if (isset($_POST["submitTicket"])) {
//    addTicketIntoDB($conn);
//}
//

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
        <select name="selectCategory">
            <option value="" disabled selected hidden>Choose the Category</option>
            <?php
            //            if (mysqli_num_rows($setCategories) > 0) {
            //                while ($row = mysqli_fetch_assoc($setCategories)) {
            //                    echo '<option value="' . $row["Category"] . '">' . $row["Category"] . '</option>';
            //                }
            //            }
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
        <input type="text" name="description" placeholder="Description">
        <p class="inputTitle">Deadline</p>
        <input type="date" name="deadline">
        <p class="inputTitle">Forecast time</p>
        <input type="number" name="time" placeholder="How long will it take">
        <button class="popup" name="submitTicket" onclick="myFunction()">Add</button>
    </form>
    <!-- end of where you can make the ticket-->

    <!-- here you can make a subject-->
    <div>
        <form class="form" id="formSubject" method="post">
            <h1 class="formTitle">Subject</h1>
            <p class="inputTitle">Category</p>
            <select name="selectCategory">
                <option value="" disabled selected hidden>Choose a Category</option>
                <option value="test1">test1</option>
                <option value="test2">test2</option>
                <option value="test3">test3</option>
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
            <div id="existingList">
                <div>mobile development</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
            </div>
        </div>

        <div class="container">
            <p id="existingtitle">Subject's</p>
            <div id="existingList">
                <div>Mobile Development</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
                <div>php</div>
                <div>html</div>
                <div>javascript</div>
                <div>mobile</div>
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

        if (confirm("Do you want to save changes?") == true) {
            userPreference = "Data saved successfully!";
        } else {
            userPreference = "Save Canceled!";
        }

        document.getElementById("msg").innerHTML = userPreference;
    }
</script>
</html>
