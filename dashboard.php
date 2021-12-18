<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css" />
    <title>WS - Dashboard</title>
</head>
<body>
    <?php
        include_once './navbar.php';
        if(!isset($_SESSION["userEmail"])) {
            header("location: ./signin.php");
            exit();
        }
    ?>
    <div class="dashboard">
        <?php
            if(isset($_SESSION["userName"]))
                echo "<h1>dashboard - Hello " . $_SESSION["userName"] . "</h1>";
        ?>

        <div class="updatePwd">
            <h2>Update password</h2>
            <form method="POST" action="./includes/updatePwd.inc.php">
                <label for="cPwd">Current password</label>
                <input type="password" name="cPwd" id="cPwd" required />
                <label for="newPwd">New password</label>
                <input type="password" name="newPwd1" id="newPwd1"  />
                <label for="newPwd2">Confirm new password</label>
                <input type="password" name="newPwd2" id="newPwd2"  />

                <button type="submit" name="submit">Update</button>
            </form>
            <?php
                if(isset($_GET["err"])) {
                    if($_GET["err"] == "connfail")
                        echo "<p>Something went wrong. Please try again later.</p>";
                    
                    if($_GET["err"] == "upd1")
                        echo "<p>Wrong Current Password.</p>";

                    if($_GET["err"] == "upd2")
                        echo "<p>The new password is not secure enough.</p>";

                    if($_GET["err"] == "upd3")
                        echo "<p>The new password cannot be the same as the old one.</p>";
                    
                    if($_GET["err"] == "upd4")
                        echo "<p>Please fill all the fields.</p>";                       

                    if($_GET["err"] == "upd5")
                        echo "<p>The new passwords do not match.</p>";  
                    
                    if($_GET["err"] == "upd0")
                        echo "<p>Password updated.</p>";       
                }
            ?>
        </div>

        <div class="delAccount">
            <h2>Delete account</h2>
            <form method="POST" action="./includes/deleteAccount.inc.php">
                <label for="pwd">Password</label>
                <input type="password" name="pwd" id="pwd" required />
                <label for="Cpwd">Confirm password</label>
                <input type="password" name="Cpwd" id="Cpwd" required />

                <button type="submit" name="submit" id="btnRed">Delete</button>
            </form>
            <?php
                if(isset($_GET["err"])) {
                    if($_GET["err"] == "connfail")
                        echo "<p>Something went wrong. Please try again later.</p>";

                    if($_GET["err"] == "del1")
                        echo "<p>Please fill all the fields.</p>";

                    if($_GET["err"] == "del3")
                        echo "<p>Wrong Current Password.</p>";
                    
                    if($_GET["err"] == "del2")
                        echo "<p>Passwords do not match.</p>";
                }
            ?>
        </div>
    </div>
</body>
</html>