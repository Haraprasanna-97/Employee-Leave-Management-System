<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $Appname;
    ?> - Leave Application Form</title>
    <link rel="stylesheet" href="./CSS/leave_application.css">
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/alert.css">
</head>
<body>
    <?php
        include 'navbar.php';
        include 'db.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"];
            $leave_type = $_POST["leave-type"];
            $start_date = $_POST["start-date"];
            $end_date = $_POST["end-date"];
            $reason = $_POST["reason"];
            $query = "INSERT INTO `leave_applications` (`email`, `leave_type`, `start_date`, `end_date`, `reason`) VALUES ('$email', '$leave_type', '$start_date', '$end_date', '$reason');";
            if (executeQuery($query)) {
                $message = "Leave appliction submited successfully";
                include 'alert.php';
            }
            else
            {
                $message = "Failed to submit leave appliction. Please try again after some time";
                include 'alert.php';
            }
        }
    ?>
    <div class="form-container">
        <form class="leave-form" action="./leave_application.php" method = "post">
            <h2>Leave Application Form</h2>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $_COOKIE["name"] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $_COOKIE["email"] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="leave-type">Type of Leave</label>
                <select id="leave-type" name="leave-type" required>
                    <option value="" selected>-- Selct one --</option>
                    <option value="sick">Sick Leave</option>
                    <option value="casual">Casual Leave</option>
                    <option value="annual">Annual Leave</option>
                    <option value="vacation">Vacation Leave</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start-date" required>
            </div>
            <div class="form-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date" required>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Leave</label>
                <textarea id="reason" name="reason" rows="4" required></textarea>
            </div>
            <button type="submit" class="form-btn">Submit Application</button>
        </form>
    </div>
</body>
</html>