<?php

if(isset($_POST["submit"])) {
    $email = $_POST["email"];
    $pwd = $_POST["password"];

    require_once './dbh.inc.php';
    require_once './functions.inc.php';

    if(emptyLoginFields($email, $pwd)) {
        header("location: ../signin.php?err=emptyfields");
        exit();
    }

    loginUser($conn, $email, $pwd);
}
else {
    header("location: ../signin.php");
    exit();
}