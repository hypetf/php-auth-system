<?php

function emptyInputFields($username, $email, $pwd1, $pwd2) {
    if(empty($username) || empty($email) || empty($pwd1) || empty($pwd2))
        return true;
    else
        false;
}

function emptyLoginFields($email, $pwd) {
    if(empty($email) || empty($pwd))
        return true;
    else
        return false;
}

function emptyUpdatePwdFields($currentPwd, $newPwd1, $newPwd2) {
    if(empty($currentPwd) || empty($newPwd1) || empty($newPwd2))
        return true;
    else
        return false;
}

function usernameRegex($username) {
    if(!preg_match("/^[a-zA-Z]*$/", $username))
        return true;
    else
        return false;
}

function emailRegex($email) {
    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        return true;
    else
        return false;
}

function passwordRegex($password) {
    if(!preg_match("/^[a-zA-Z0-9]*$/", $password) || strlen($password) < 8)
        return true;
    else
        return false;
}

function pwdNoMatch($pwd1, $pwd2) {
    if($pwd1 !== $pwd2)
        return true;
    else
        return false;
}

function pwdNoSecure($pwd1) {
    if(strlen($pwd1) < 8 || !preg_match("#[0-9]#", $pwd1) || !preg_match("#[a-z]#", $pwd1) || !preg_match("#[A-Z]#", $pwd1))
        return true;
    else
        return false;
}

function emailExists($conn, $email) {
    $sql = "SELECT * FROM users WHERE userEmail = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?err=connfail");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $res = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($res))
        return $row;
    else
        return false;

    mysqli_stmt_close($stmt);
}

function createUser($conn, $username, $email, $pwd) {
    $sql = "INSERT INTO users (userName, userEmail, userPwd) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?err=connfail");
        exit();
    }

    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../signup.php?err=none");
}

function loginUser($conn, $email, $pwd) {
    $user = emailExists($conn, $email);
    if($user === false) {
        header("location: ../signin.php?err=wrongcreds");
        exit();
    }

    $pwdHashed = $user["userPwd"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if($checkPwd === false) {
        header("location: ../signin.php?err=wrongcreds");
        exit();
    }
    else if($checkPwd === true) {
        session_start();
        $_SESSION["userid"] = $user["userid"];
        $_SESSION["userEmail"] = $user["userEmail"];
        $_SESSION["userName"] = $user["userName"];
        header("location: ../dashboard.php");
        exit();
    }
}


function currentPwdWrong($conn, $currentPwd) {
    session_start();
    $email = $_SESSION["userEmail"];
    $user = emailExists($conn, $email);
    if($user === false) {
        header("location: ../signin.php");
        exit();
    }
    
    $pwdHashed = $user["userPwd"];
    $checkPwd = password_verify($currentPwd, $pwdHashed);

    if($checkPwd === false)
        return true;
    else
        return false;
}

function updatePwd($conn, $newPwd2, $userId) {
    $sql = "UPDATE users SET userPwd=? WHERE userid=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?err=connfail");
        exit();
    }
    $id = $userId;
    $hashedPwd = password_hash($newPwd2, PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt, "si", $hashedPwd, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../dashboard.php?err=upd0");
}

function deleteAccount($conn, $userid) {
    $sql = "DELETE FROM users WHERE userid=?;";
    mysqli_query($conn, $sql);
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return true;
}