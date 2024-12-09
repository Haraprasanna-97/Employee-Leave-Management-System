<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo "$APPNAME";
    ?> - My leave balances</title>
    <link rel="stylesheet" href="CSS\manager_dashboard.css">
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php
        include 'navbar.php';
        include 'db.php';
        $email = $_COOKIE["email"];
        $query = "SELECT leave_type, SUM(DATEDIFF(end_date, start_date) + 1) AS leave_balance FROM leave_applications WHERE email = '$email' AND status = 'Approved' GROUP BY email, leave_type;";
        $data = executeQuery($query);
    ?>
    <div class="table-wrapper">
        <div class="table-container">
            <table class="styled-table">
            <caption>My leave balances</caption>
                <thead>
                    <tr>
                        <th>Leave type</th>
                        <th>Leave balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $row) {
                            echo "<tr>
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