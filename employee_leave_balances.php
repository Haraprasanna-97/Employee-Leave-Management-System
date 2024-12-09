<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo "$APPNAME - $DASHBOARD_NAME";
    ?> </title>
    <link rel="stylesheet" href="CSS\manager_dashboard.css">
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php
        include 'navbar.php';
        include 'db.php';
        $query = "SELECT u.name, l.leave_type, SUM(DATEDIFF(l.end_date, l.start_date) + 1) AS leave_balance FROM user u, leave_applications l WHERE u.email = l.email AND l.status = 'Approved' GROUP BY l.email, l.leave_type;";
        $data = executeQuery($query);
    ?>
    <div class="table-wrapper">
        <div class="table-container">
            <table class="styled-table">
            <caption>Leave balances</caption>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Leave type</th>
                        <th>Leave balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $row) {
                            echo "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["leave_type"] . "</td>
                            <td>" . $row["leave_balance"] . " days</td>
                        </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>