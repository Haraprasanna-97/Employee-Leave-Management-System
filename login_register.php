<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register</title>
    <link rel="stylesheet" href="./CSS/login_register.css">
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php include 'navbar.php'; ?>
    <div class="form-container">
        <div class="form-box">
            <h2>Login</h2>
            <form class="login-form">
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" id="login-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required>
                </div>
                <button type="submit" class="form-btn">Login</button>
            </form>
        </div>
        <div class="form-box">
            <h2>Register</h2>
            <form class="register-form">
                <div class="form-group">
                    <label for="register-username">Username</label>
                    <input type="text" id="register-username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" required>
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
                <button type="submit" class="form-btn">Register</button>
            </form>
        </div>
    </div>
</body>
</html>
