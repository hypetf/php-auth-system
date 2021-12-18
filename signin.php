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
    <h1>Sign in</h1>
    <div class="signupForm">
        <form method="POST" action="./includes/signin.inc.php">            
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required />

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required />
            
            <button type="submit" name="submit">Sign in</button>
        </form>
        <?php
            if(isset($_GET["err"])) {
                if($_GET["err"] == "emptyfields")
                    echo "<p>Please fill all fields.</p>";

                if($_GET["err"] == "connfail")
                    echo "<p>Something went wrong. Please try again later.</p>";

                if($_GET["err"] == "wrongcreds")
                    echo "<p>Wrong email or password.</p>";
            }
        ?>
    </div>
</body>
</html>