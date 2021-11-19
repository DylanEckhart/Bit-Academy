<?php

    //Connect to the database
    require_once '../DB/connection.php';
    $connection = openConn();

    $sqlget = "SELECT * FROM plannings";
    $sqldata = mysqli_query($connection, $sqlget) or die('Cant connect or display data');

    while($row = mysqli_fetch_array($sqldata, MYSQLI_ASSOC)) {

    }
