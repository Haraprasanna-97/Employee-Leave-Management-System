<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $Appname;
    ?> - Logout Page</title>
    <link rel="stylesheet" href="./CSS/logout.css">
    <link rel="stylesheet" href="./CSS/home.css">    
</head>
<body>
    <?php
        setcookie("state", "");
        setcookie("name", "");
        setcookie("email", "");
        setcookie("role", "");
        include 'navbar.php'
    ?>
    <div class="logout-container">
        <div class="logout-message">
            <h1>You have been logged out.</h1>
            <a href="login_register.php" class="login-link">Login / Register</a>
        </div>
    </div>
</body>
</html>
