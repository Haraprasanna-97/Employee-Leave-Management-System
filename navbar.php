<header class="sticky-navbar">
    <nav>
        <ul class="nav-list">
            <li><a href="./index.php">Home</a></li>
            <?php
                if(isset($_COOKIE["role"])) {
                    if ($_COOKIE["role"] == "Employee") {
                        echo "<li><a href='./my_applications.php'>Leave applications</a></li>";
                        echo "<li><a href='./my_leave_balances.php'>Leave balances</a></li>";
                        echo "<li><a href='./calender_view.php'>Calendar</a></li>";
                        echo "<li><a href='./leave_application.php'>Fill leave application</a></li>";
                    }
                    elseif ($_COOKIE["role"] == "Manager") {
                        echo "<li><a href='./pending_applications.php'>Pending</a></li>";
                        echo "<li><a href='./aproved_applications.php'>Approved</a></li>";
                        echo "<li><a href='./denied_applications.php'>Denied</a></li>";
                        echo "<li><a href='./employee_leave_balances.php'>Leave balances</a></li>";
                        echo "<li><a href='./calender_view.php'>Calendar</a></li>";
                    }
                }
            ?>
        </ul>
        <?php
            if (isset($_COOKIE["state"]) and $_COOKIE["state"] == "loggedin") {
                echo "<div class='user-info'>
                <div class='user-details'>
                    <span class='username'>" . $_COOKIE["name"] . "</span>
                    <span class='role'>" . $_COOKIE['role'] . "</span>
                </div>
                <button class='logout-btn'><a href='./logout.php'>Logout</a></button>
            </div>";
            }
            else {
                echo "<button class='login-btn'><a href='./login_register.php'>Login/Register</a></button>";
            }
            ?>
    </nav>
</header>