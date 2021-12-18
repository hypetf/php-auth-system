<?php

if(isset($_POST["submit"])) {
    $currentPwd = $_POST["cPwd"];
    $newPwd1 = $_POST["newPwd1"];
    $newPwd2 = $_POST["newPwd2"];

    require_once './dbh.inc.php';
    require_once './functions.inc.php';

    if(emptyUpdatePwdFields($currentPwd, $newPwd1, $newPwd2)) {
        header("location: ../dashboard.php?err=upd4");
        exit();
    }

    if(currentPwdWrong($conn, $currentPwd)) {
        header("location: ../dashboard.php?err=upd1");
        exit();
    }

    if(pwdNoMatch($currentPwd, $newPwd1) === false) {
        header("location: ../dashboard.php?err=upd3");
        exit();
    }

    if(passwordRegex($newPwd1)) {
        header("location: ../dashboard.php?err=upd2");
        exit();
    }

    if(pwdNoMatch($newPwd1, $newPwd2)) {
        header("location: ../dashboard.php?err=upd5");
        exit();
    }

    updatePwd($conn, $newPwd2, $_SESSION["userid"]);
}
else {
    header("location: ../signin.php");
    exit();
}