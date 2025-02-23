<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        ECHO $APPNAME;
    ?> - Logout Page</title>
    <link rel="stylesheet" href="CSS/logout.css">
</head>
<body>
    <?php
        setcookie("state", "");
        setcookie("name", "");
        setcookie("email", "");
        setcookie("role", "");
    ?>
    <div class="logout-container">
        <div class="logout-message">
            <h1>You have been logged out.</h1>
            <a href="./login.php" class="login-link">Login</a>
            <a href="./register.php" class="login-link">Register</a>
            <a href="./index.php" class="login-link">Home</a>
        </div>
    </div>
</body>
</html>
