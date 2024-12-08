<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Leave Calendar</title>
    <link rel="stylesheet" href="CSS\calender.css">
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php
        include 'navbar.php';
        include 'db.php';

        $currentMonth = isset($_GET['month']) ? $_GET['month'] : date('n') - 1;
        $currentYear = isset($_GET['year']) ? $_GET['year'] : date('Y');
        $months = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
        $monthName = $months[$currentMonth];
        $prevMonth = $currentMonth == 0 ? 11 : $currentMonth - 1;
        $nextMonth = $currentMonth == 11 ? 0 : $currentMonth + 1;
        $prevYear = $currentMonth == 0 ? $currentYear - 1 : $currentYear;
        $nextYear = $currentMonth == 11 ? $currentYear + 1 : $currentYear;
        if($_COOKIE["role"] and $_COOKIE["role"] == "Manager") {
            $query = "SELECT u.name, l.start_date, l.end_date, l.leave_type FROM user u , leave_applications l WHERE l.email = u.email AND status = \"Approved\";";
        }
        elseif ($_COOKIE["role"] and $_COOKIE["role"] == "Employee") {
            $email = $_COOKIE["email"];
            $query = "SELECT `start_date`, `end_date`, leave_type FROM `leave_applications` WHERE email = \"$email\" AND status = \"Approved\";";
        }
        $data = executeQuery($query);
    ?>
    <div class="calendar-container">
        <div class="calendar-header">
            <button class="nav-btn" onclick="window.location.href='?month=<?php echo $prevMonth; ?>&year=<?php echo $prevYear; ?>'">&lt;</button>
            <h2 id="month-year"><?php echo "$monthName $currentYear"; ?></h2>
            <button class="nav-btn" onclick="window.location.href='?month=<?php echo $nextMonth; ?>&year=<?php echo $nextYear; ?>'">&gt;</button>
        </div>
        <table class="calendar">
            <thead>
                <tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thu</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>
            </thead>
            <tbody id="calendar-body">
                <?php
                $firstDay = date('w', strtotime("$currentYear-$currentMonth-01"));
                $daysInMonth = date('t', strtotime("$currentYear-$currentMonth-01"));

                $date = 1;
                for ($i = 0; $i < 6; $i++) {
                    echo "<tr>";
                    for ($j = 0; $j < 7; $j++) {
                        if ($i == 0 && $j < $firstDay) {
                            echo "<td></td>";
                        } elseif ($date > $daysInMonth) {
                            break;
                        } else {
                            echo "<td>$date";
                            // Making the aproved leave 
                            foreach ($data as $row) {
                                $start = $row["start_date"];
                                $end = $row["end_date"];
                                
                                $month = $currentMonth + 1;
                                $checkDateStr = "$currentYear-$month-$date";
                                $checkDate = DateTime::createFromFormat('Y-m-d', $checkDateStr);
                                $startDate = DateTime::createFromFormat('Y-m-d', $start);
                                $endDate = DateTime::createFromFormat('Y-m-d', $end);
                                if ($checkDate >= $startDate && $checkDate <= $endDate) {
                                    if ($_COOKIE["role"] == "Manager") {
                                        echo "<div class='leave'>" . $row["leave_type"] . " leave by " . $row['name'] . "</div>";
                                    }
                                    elseif($_COOKIE["role"] == "Employee"){
                                        echo "<div class='leave'>" . $row["leave_type"] . " leave</div>";
                                    }
                                }
                            }
                            echo "</td>";
                            $date++;
                        }
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
