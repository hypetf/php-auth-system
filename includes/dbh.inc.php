<?php
    $serverName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "wspractice3";

    $conn = mysqli_connect($serverName, $dbUserName, $dbPassword, $dbName);

    if(!$conn)
        die("Conection to SQL Database failed: " . mysqli_connect_error());