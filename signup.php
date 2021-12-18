<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./main.css" />
    <title>WS - Sign up</title>
</head>
<body>
    <?php
        include_once './navbar.php';
        if(isset($_SESSION["userEmail"])) {
            header("location: ./dashboard.php");
            exit();
        }
    ?>
    <h1>Sign up</h1>
    <div class="signupForm">
        <form method="POST" action="./includes/signup.inc.php">
            <label for="username">Your Name</label>
            <input type="text" maxlength="12" name="username" id="username" required />
            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required />

            <label for="pwd1">Password</label>
            <input type="password" name="pwd1" id="pwd1" required />

            <label for="pwd2">Confirm Password</label>
            <input type="password" name="pwd2" id="pwd2" required />

            <button type="submit" name="submit">Sign up</button>
        </form>
        <?php
            if(isset($_GET["err"])) {
                if($_GET["err"] == "emptyfields")
                    echo "<p>Please fill all fields.</p>";

                if($_GET["err"] == "connfail")
                    echo "<p>Something went wrong. Please try again later.</p>";

                if($_GET["err"] == "invalidusername")
                    echo "<p>Username can only have letters.</p>";

                if($_GET["err"] == "invalidemail")
                    echo "<p>Email format is not valid.</p>";

                if($_GET["err"] == "pwdnomatch")
                    echo "<p>Passwords do not match.</p>";

                if($_GET["err"] == "pwdnosecure")
                    echo "<p>Passwords must contain at least one capital letter, one lowercase letter and one number. Minimum length is 8 characters.</p>";

                if($_GET["err"] == "emailexists")
                    echo "<p>An user with this email already exists.</p>";
                
                if($_GET["err"] == "none")
                    echo "<p>Sucessfully signed up.</p>";
            }
        ?>
    </div>
</body>
</html>