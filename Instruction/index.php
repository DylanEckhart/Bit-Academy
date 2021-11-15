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

    <!-- Welcome title and text -->
    <div class="welcomeText">
        <h1 class="welcome">Welcome to the Bit Academy Workboard!</h1>
    </div>

    <!-- Grid container for instructions -->
    <div id="grid-container">
        <!-- Instruction block for submit -->
        <div class="instruction_submit">
            <h2 class="submit_head">Instruction of Submit</h2>
            <img class="screenshot_submit" src="IMG/admin_screen.png" alt="screenshot">
            <p>
                
            </p>
        </div>

        <!-- Instruction block for admin -->
        <div class="instruction_admin">
            <h2 class="admin_head">Instruction of Admin</h2>
            <img class="screenshot_admin" src="IMG/admin_screen.png" alt="screenshot">
            <p>
                An admin can create tickets on this page for students to use. That works like this: <br>
                - First the admin creates an category or chooses an existing one. <br>
                - Then he creates an subject following the category or chooses one. <br>
                - After that he creates a ticket with the following aspects: the category and subject you just made, a layer (front-end / back-end), a language                 that corresponds with the category, a small description of the task, deadline and a forcast time how long the student must work.
            </p>
        </div>
    </div>
</body>
</html>