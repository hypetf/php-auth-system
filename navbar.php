<?php
    session_start();
?>

<div class="navbar">
    <?php
        if(isset($_SESSION["userEmail"])) {
            echo "<a href=\"./home.php\">Home</a>";
            echo "<a href=\"./dashboard.php\">Dashboard</a>";
            echo "<a href=\"./includes/signout.inc.php\">Log out</a>";
        }
        else {
            echo "<a href=\"./home.php\">Home</a>";
            echo "<a href=\"./signin.php\">Sign in</a>";
            echo "<a href=\"./signup.php\">Sign up</a>";
        }
    ?>
</div>