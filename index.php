<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Header/style.css">
    <link rel="stylesheet" href="Instruction/instruction_style.css">
    <link rel="icon" href="Images/icon/favicon.ico" type="image/icon">
    <title>Homepage</title>
</head>
<body>
    <!-- Include header -->
    <?php
    require_once "Header/header.php";
    ?>

    <!-- Welcome title -->
    <div class="welcomeText">
        <h1 class="welcome">Welcome to the Bit Academy Workboard!</h1>
    </div>

    <!-- Grid container for instructions -->
    <div id="grid-container">
        <!-- Instruction block for submit -->
        <button class="accordion butSubmit">Instruction for Submit</button>
        <div class="instruction_submit">
            <h2 class="submit_head">Instruction of Submit</h2>
            <img class="screenshot_submit" src="Instruction/IMG/submit_screen.png" alt="screenshot">
            <p>
                An user can create a planning on this page to organize his work. That works like this: <br>
                - First the user chooses an category. <br>
                - Then chooses an subject that corresponds with the category. <br>
                - After that chooses the description and plan his planning. <br>
                - The planning will stand at the right of the screen.
            </p>
        </div>
        <!-- Instruction block for admin -->
        <button class="accordion butAdmin">Instruction for Admin</button>
        <div class="instruction_admin">
            <h2 class="admin_head">Instruction of Admin</h2>
            <img class="screenshot_admin" src="Instruction/IMG/admin_screen.png" alt="screenshot">
            <p>
                An admin can create tickets on this page for students to use. It works like this: <br>
                - First the admin creates a category or chooses an existing one. <br>
                - Then they can create a subject while a category is being selected. <br>
                - After that they can create a ticket with the following aspects: the category and subject you just made, a layer (front-end / back-end), a language that corresponds with the category, a small description of the task, deadline and a forcast time how long the student must work.
            </p>
        </div>
    </div>
</body>
<script>

    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }
</script>
</html>