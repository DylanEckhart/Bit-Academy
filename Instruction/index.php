<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="../Header/style.css">
    <link rel="stylesheet" href="instruction_style.css">
    <link rel="icon" href="../Images/icon/favicon.ico" type="image/icon">
    <title>Homepage</title>
</head>
<body>
    <!-- Include header -->
    <?php
    require_once "../Header/header.php";
    ?>

    <!-- Welcome title -->
    <div class="welcomeText">
        <h1 class="welcome">Welcome to the Bit Academy Workboard!</h1>
    </div>

    <!-- Grid container for instructions -->
    <div id="grid-container">
        <!-- Instruction block for submit -->
        <div class="instruction_submit">
            <h2 class="submit_head">Instruction of Submit</h2>
            <img class="screenshot_submit" src="IMG/submit_screen.png" alt="screenshot">
            <p>
                A student can create a planning on this page to organize their work. It works like this: <br>
                - First the student chooses a category. <br>
                - Then chooses a subject that corresponds with the category. <br>
                - After that the student chooses the description and adds it to their planning. <br>
                - The ticket will display at the right side of the screen under This Week Planning.
            </p>
        </div>
        <!-- Instruction block for admin -->
        <div class="instruction_admin">
            <h2 class="admin_head">Instruction of Admin</h2>
            <img class="screenshot_admin" src="IMG/admin_screen.png" alt="screenshot">
            <p>
                An admin can create tickets on this page for students to use. It works like this: <br>
                - First the admin creates a category or chooses an existing one. <br>
                - Then they can create a subject while a category is being selected. <br>
                - After that they can create a ticket with the following aspects: the category and subject you just made, a layer (front-end / back-end), a language that corresponds with the category, a small description of the task, deadline and a forcast time how long the student must work.
            </p>
        </div>
    </div>
</body>
</html>