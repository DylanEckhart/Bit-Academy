<?php

    // Connection inputs to MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $databasename = "bitAcademy";

    // Connection to database
    $connection = mysqli_connect($servername, $username, $password, $databasename);

    // Check if connection to the database is successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    echo "Connected successfully";

