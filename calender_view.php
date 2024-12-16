<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
    include 'constants.php';
    echo $APPNAME;
    ?> - Employee Leave Calendar</title>
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/calendar.css">
    <link rel="stylesheet" href="CSS\manager_dashboard.css">
    <link rel="stylesheet" href="CSS\manager_calender.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
<body>
    <?php
        include 'navbar.php';
        $count = 1;
    ?>
    <form class = "calender-form" action="./calender_view.php" method = "post">
        <div class="form-group">
            <label for="month">Month</label>
            <select id="month" name="month" style = "width: 50%;" required>
                <option value="" selected>-- Selct month --</option>
                <?php foreach ($months as $month): ?>
                    <option value="<?php echo $count; ?>"> <?php echo "$month"; ?> </option>
                    <?php $count += 1 ?>;
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="start-date">Year</label>
            <input type="text" id="year" name="year" style = "width: 20%;" required>
            <button type = "submit" class="nav-btn">Show calender</button>
        </div>
    </form>
    <a href = "./calender_view.php" class="nav-btn" style = "text-decoration : none; width: 15%;" ">Current month</a>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_COOKIE["role"]) and $_COOKIE["role"] == "Manager"){
            $month = $_POST["month"] -1;    
            $year = $_POST["year"];
            $month_year = "$months[$month] $year";
            echo "<h3 id = 'month-year'>$month_year</h3>";
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "GET" and isset($_COOKIE["role"]) and $_COOKIE["role"] == "Manager") {
            $month = date("m") -1;
            $year = date("Y");
            $month_year = "$months[$month] $year";
            echo "<h3 id = 'month-year'>$month_year</h3>";
        }
    ?>
    <div class="calender-container">
        <?php
            include 'db.php';
            include 'Calendar.php';
            if(isset($_COOKIE["role"]) and $_COOKIE["role"] == "Manager") {
                $query = "SELECT u.name, l.start_date, l.leave_type, DATEDIFF(l.end_date, l.start_date) AS date_difference FROM user u , leave_applications l WHERE l.email = u.email AND l.status = \"Approved\";";
            }
            elseif (isset($_COOKIE["role"]) and isset($_COOKIE["email"]) and $_COOKIE["role"] == "Employee") {
                $email = $_COOKIE["email"];
                $query = "SELECT `start_date`, leave_type, DATEDIFF(end_date, start_date) AS date_difference FROM `leave_applications` WHERE email = \"$email\" AND status = \"Approved\";";
            }
            $data = executeQuery($query);
            
            if (isset($_COOKIE["role"]) and $_COOKIE["role"] == "Employee") {
                if ($_SERVER["REQUEST_METHOD"] == "POST"){
                    $month = $_POST["month"];
                    $year = $_POST["year"];
                    $calendar = new Calendar("$year-$month-1");
                    // Mark the leave
                    foreach ($data as $row) {
                        if ($_COOKIE["role"] == "Manager") {
                            $event_title = $row["leave_type"] . " leave by " . $row['name'];
                        }
                        elseif($_COOKIE["role"] == "Employee"){
                            $event_title = $row["leave_type"] . " leave";
                        }
                        $start_date = $row["start_date"];
                        $duration = $row["date_difference"];
                        $calendar->add_event($event_title, $start_date, $duration);
                    }
                    echo $calendar;
                }
                else{
                    $calendar = new Calendar();
                    // Mark the leave
                    foreach ($data as $row) {
                        if ($_COOKIE["role"] == "Manager") {
                            $event_title = $row["leave_type"] . " leave by " . $row['name'];
                        }
                        elseif($_COOKIE["role"] == "Employee"){
                            $event_title = $row["leave_type"] . " leave";
                        }
                        $start_date = $row["start_date"];
                        $duration = $row["date_difference"];
                        $calendar->add_event($event_title, $start_date, $duration);
                    }
                    echo $calendar;
                }
            }
            else {
                include "Check_Leep_year.php";
                if ($month == 1) { // If its February
                    if (isLeapYear($year)) { // If year is a leap year
                        $number_of_days = 29;
                    }
                    else {
                        $number_of_days = 28;
                    }
                }
                elseif (in_array($month, [3,5,7,9])) { // if month is April, June, September or November
                    $number_of_days = 30;
                }
                else {
                    $number_of_days = 31;
                }
                include "manager_calendar_view.php";
            }
        ?>
    </div>
    <?php 
    if (isset($_COOKIE["role"]) and $_COOKIE["role"] == "Manager") {
        echo "<p class = 'key'>Key : <i class='material-icons' style='color: green;'>check_circle</i> - Leave</p>";    
    }
    ?>
</body>
</html>
