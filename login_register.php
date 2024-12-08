<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $Appname;
    ?> - Register/Login</title>
    <link rel="stylesheet" href="./CSS/login_register.css">
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/alert.css">
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
                            $message = "Registration successful. Please fill in the login form";
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
            <form class="register-form" action="./login_register.php" method = "post">
                <div class="form-group">
                    <label for="register-name">Name</label>
                    <input type="text" id="register-name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="register-role">Role</label>
                    <div class="role-selection">
                        <input type="radio" id="role-employee" name="role" value="employee" required>
                        <label for="role-employee">Employee</label>
                        <input type="radio" id="role-manager" name="role" value="manager" required>
                        <label for="role-manager">Manager</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="register-email">Email</label>
                    <input type="text" id="register-email" name="email" class="email" required>
                    <p id="register-error-message"></p>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" required>
                    <p id="register-password-message"></p>
                </div>
                <input type="hidden" name="relevence" value = "register">
                <button type="submit" class="form-btn" id="register-btn">Register</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Login</h2>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["relevence"] == "login") {
                    $email = $_POST["email"];
                    $qurry = "SELECT name, role, password FROM `user` WHERE email = '$email';";
                    $data = executeQuery($qurry);
                    if (is_array($data) and count($data) > 0) {
                        $name = $data[0]["name"];
                        $role = $data[0]["role"];
                        $hashed_password = $data[0]["password"];
                        if (password_verify($_POST["password"], $hashed_password)) {
                            // password matches
                            if ($role == "employee") {
                                $message = "Login successful . Click <a href = './my_applications.php' >here</a> to your applications page";
                            }
                            elseif ($role == "manager") {
                                $message = "Login successful . Click <a href = './pending_applications.php' >here</a> to go to your dashboard";
                            }
                            setcookie("state", "loggedin");
                            setcookie("name", $name);
                            setcookie("email", $email);
                            setcookie("role", $role);
                            include "alert.php";
                        } else {
                            // Password doesn't match
                            $message = "Invald email or password. Please try again";
                            include "alert.php";
                        }
                    } else {
                        // No data retrived from Database
                        $message = "Invald email or password. Please try again";
                        include "alert.php";
                    }
                }
            ?>
            <form class="login-form" action="./login_register.php" method = "post">
                <div class="form-group">
                    <label for="login-email">Email</label>
                    <input type="text" id="login-email" name="email" class="email" required>
                    <p id="login-error-message"></p>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required>
                    <p id="login-password-message"></p>
                </div>
                <input type="hidden" name="relevence" value = "login">
                <button type="submit" class="form-btn" id="login-btn">Login</button>
            </form>
        </div>
    </div>

    <script>
    document.getElementById('register-email').addEventListener('input', registerValidateEmail);
    document.getElementById('login-email').addEventListener('input', loginValidateEmail);
    document.getElementById('register-password').addEventListener('input', registerValidatePassword);
    document.getElementById('login-password').addEventListener('input', loginValidatePassword);
</script>
</body>
</html>
