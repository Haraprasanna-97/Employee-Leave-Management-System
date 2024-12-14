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
                            if ($role == "Employee") {
                                $message = "Login successful . Click <a href = './my_applications.php' >here</a> to your applications page";
                            }
                            elseif ($role == "Manager") {
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
            <form class="login-form" action="./login.php" method = "post">
                <div class="form-group">
                    <label for="login-email">Email (Required)</label>
                    <input type="text" id="login-email" name="email" class="email" required>
                    <p id="login-error-message"></p>
                </div>
                <div class="form-group">
                    <label for="login-password">Password (Required)</label>
                    <div class="input-superimposed">
                        <input type="password" id="login-password" name="password" required>
                        <button id="show-hide-btn"><i id = "show-hide-icon" class="material-icons">visibility</i></button>
                    </div>
                    <p id="login-password-message"></p>
                </div>
                <input type="hidden" name="relevence" value = "login">
                <button type="submit" class="form-btn" id="login-btn">Login</button>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('login-email').addEventListener('input', loginValidateEmail);
        document.getElementById('login-password').addEventListener('input', loginValidatePassword);
        document.getElementById('show-hide-btn').addEventListener('click', toggleLoginPasswordVisibility);
    </script>
</body>
</html>