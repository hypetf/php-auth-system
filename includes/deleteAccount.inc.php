<?php

if(isset($_POST["submit"])) {
    $pwd = $_POST["pwd"];
    $cPwd = $_POST["Cpwd"];
    
    require_once './dbh.inc.php';
    require_once './functions.inc.php';

    if(emptyLoginFields($pwd, $cPwd)) {
        header("location: ../dashboard.php?err=del1");
        exit();
    }

    if(currentPwdWrong($conn, $cPwd)) {
        header("location: ../dashboard.php?err=del2");
        exit();
    }

    if(pwdNoMatch($pwd, $cPwd) === true) {
        header("location: ../dashboard.php?err=del3");
        exit();
    }

    if(deleteAccount($conn, $_SESSION["userid"])) {
        session_start();
        session_unset();
        session_destroy();
        header("location: ../signin.php?err=UserDeleted");
        exit();
    }
}