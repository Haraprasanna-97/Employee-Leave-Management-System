<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $APPNAME;
    ?> - Register/Login</title>
    <link rel="stylesheet" href="./CSS/login_register.css">
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/alert.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <script src = "./Javascript/validation.js"></script>
    <?php
        include 'navbar.php';
        include "db.php";
    ?>
    <div class="form-container">
        <div class="form-box">
            <h2>Register</h2>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST"  and $_POST["relevence"] == "register") {
                    $name = $_POST["name"];
                    $role = $_POST["role"];
                    $email = $_POST["email"];
                    // Check if user is not rgistered
                    $qurry = "SELECT email FROM `user`WHERE email = '$email';";
                    if (count(executeQuery($qurry)) == 0) {
                        // Perform user registration
                        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                        $qurry = "INSERT INTO `user` (`name`, `email`, `password`, `role`) VALUES ('$name', '$email', '$password', '$role');";
                        if (executeQuery($qurry)) {
                            $message = "Registration successful. Please fill in the <a href = './login.php'>login</a form";
                            include "alert.php";
                        }
                        else {
                            $message = "Failed to register. Please try again layter";
                            include "alert.php";
                        }
                    }
                    else {
                        $message = "You have already registered";
                        include "alert.php";
                    }
                }
            ?>
            <form class="register-form" action="./register.php" method = "post">
                <div class="form-group">
                    <label for="register-name">Name (Required)</label>
                    <input type="text" id="register-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="register-role">Role (Required)</label>
                    <div class="role-selection">
                        <input type="radio" id="role-employee" name="role" value="Employee" required>
                        <label for="role-employee">Employee</label>
                        <input type="radio" id="role-manager" name="role" value="Manager" required>
                        <label for="role-manager">Manager</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-email">Email (Required)</label>
                    <input type="text" id="register-email" name="email" class="email" required>
                    <p id="register-error-message"></p>
                </div>
                <div class="form-group">
                    <label for="register-password">Password (Required)</label>
                    <div class="input-superimposed">
                        <input type="password" id="register-password" name="password" required>
                        <button id="show-hide-btn"><i id = "show-hide-icon" class="material-icons">visibility</i></button>
                    </div>
                    <p id="register-password-message"></p>
                </div>
                <input type="hidden" name="relevence" value = "register">
                <button type="submit" class="form-btn" id="register-btn">Register</button>
            </form>
        </div>
    <script>
        document.getElementById('register-email').addEventListener('input', registerValidateEmail);
        document.getElementById('register-password').addEventListener('input', registerValidatePassword);
        document.getElementById('show-hide-btn').addEventListener('click', toggleRegisterPasswordVisibility);
    </script>
</body>
</html>