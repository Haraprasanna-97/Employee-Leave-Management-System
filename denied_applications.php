<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $Appname;
    ?> - Denied application</title>
    <link rel="stylesheet" href="CSS\manager_dashboard.css">
    <link rel="stylesheet" href="./CSS/home.css">
</head>
<body>
    <?php
        include 'navbar.php';
        include 'db.php';
        $query = "SELECT u.name, l.id, l.leave_type, l.start_date, l.end_date, l.reason FROM user u, leave_applications l WHERE u.email = l.email AND u.role = 'employee' AND l.status = 'Denied';";
        $data = executeQuery($query);
    ?>
    <div class="table-wrapper">
        <div class="table-container">
            <table class="styled-table">
                <caption>Denied applications</caption>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Leave type</th>
                        <th>Start_date</th>
                        <th>End_date</th>
                        <th>Reason</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach ($data as $row) {
                            echo "<tr>
                            <td>" . $row["name"] . "</td>
                            <td>" . $row["leave_type"] . "</td>
                            <td>" . $row["start_date"] . "</td>
                            <td>" . $row["end_date"] . "</td>
                            <td>" . $row["reason"] . "</td>
                            <td>
                            <form action='./details_view.php' method = 'post'>
                            <div class='button-container'>
                            <input type='hidden' name='id' value = " . $row["id"] . ">
                            <input type='hidden' name='relevence' value = 'view'>
                            <button class='view-details-btn'>View and take action</button>
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