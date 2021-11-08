<?php

function openConn()
{
    // Connection inputs to MySQL database
    $servername = "localhost";
//    $username = "id17762295_bitacademy";
    $username = "root";
//    $password = "Workboard-Team2";
    $password = "root";
    $databaseName = "id17762295_bitacademydb";

    // Connect to the database
    $connection = mysqli_connect($servername, $username, $password, $databaseName);

    // Check connection
//    if ($connection->connect_error) {
//        die("Connection failed: " . $connection->connect_error);
//    } else echo "Connected successfully";
    return $connection;
}