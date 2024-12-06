<header class="sticky-navbar">
    <nav>
        <ul class="nav-list">
            <li><a href="/Employee Leave Management System">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#services">Services</a></li>
            <li><a href="#contact">Contact</a></li>
            <?php
                if(isset($_COOKIE["state"])) {
                    echo "<li><a href='./leave_application.php'>Fill leave application</a></li>";
                }
            ?>

        </ul>
        <button class="login-btn"><a href="login_register.php">Login/Register</a></button>
    </nav>
</header>