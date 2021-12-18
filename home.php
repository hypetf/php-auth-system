<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css" />
    <title>ws-practice 3</title>
</head>
<body>
    <?php include_once './navbar.php' ?>
    <?php require_once './includes/dbh.inc.php';?>
    <?php
        if(isset($_SESSION["userName"]))
            echo "<h1>Home Page - Hello " . $_SESSION["userName"] . "</h1>";
        else {
            echo "<h1>Home Page</h1>";
        }
    ?>
    <div class="container">
        <div class="box"></div>
        <div class="box"></div>
        <div class="box"></div>
    </div>
</body>
</html>