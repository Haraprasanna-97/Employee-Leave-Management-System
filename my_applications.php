<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $APPNAME;
    ?> - My application</title>
    <link rel="stylesheet" href="CSS\manager_dashboard.css">
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php
        include 'navbar.php';
        include 'db.php';
        $email = $_COOKIE["email"];
        $query = "SELECT id, leave_type, start_date, end_date, reason, status FROM leave_applications WHERE email = '$email';";
        $data = executeQuery($query);
    ?>
    <div class="table-wrapper">
        <div class="table-container">
            <table class="styled-table">
            <caption>My leave applications</caption>
                <thead>
                    <tr>
                        <th>Leave type</th>
                        <th>Start date</th>
                        <th>End date</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $row) {
                            echo "<tr>
                            <td>" . $row["leave_type"] . "</td>
                            <td>" . $row["start_date"] . "</td>
                            <td>" . $row["end_date"] . "</td>
                            <td>" . $row["reason"] . "</td>
                            <td>" . $row["status"] . "</td>
                            <td>
                            <form action='./delete_view.php' method = 'post'>
                            <div class='button-container'>
                            <input type='hidden' name='id' value = " . $row["id"] . ">
                            <input type='hidden' name='relevence' value = 'view'>
                            <button class='view-details-btn'>Cancel leave</button>
                            </div>
                            </form>
                            </td>
                        </tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>