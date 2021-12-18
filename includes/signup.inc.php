<?php

if(isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $pwd1 = $_POST["pwd1"];
    $pwd2 = $_POST["pwd2"];

    require_once "./dbh.inc.php";
    require_once "./functions.inc.php";

    if(emptyInputFields($username, $email, $pwd1, $pwd2)) {
        header("location: ../signup.php?err=emptyfields");
        exit();
    }

    if(usernameRegex($username)) {
        header("location: ../signup.php?err=invalidusername");
        exit();
    }

    if(emailRegex($email)) {
        header("location: ../signup.php?err=invalidemail");
        exit();
    }

    if(emailExists($conn, $email)) {
        header("location: ../signup.php?err=emailexists");
        exit();
    }

    if(passwordRegex($pwd1)) {
        header("location: ../signup.php?err=pwdnosecure");
        exit();
    }

    if(pwdNoMatch($pwd1, $pwd2)) {
        header("location: ../signup.php?err=pwdnomatch");
        exit();
    }

    createUser($conn, $username, $email, $pwd2);
}
else {
    header("location: ../signup.php");
    exit();
}