<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $APPNAME;
    ?> - Details</title>
    <link rel="stylesheet" href="CSS\employee_details_view.css">
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/alert.css">
</head>
<body>
    <script src = "./Javascript/validation.js"></script>
    <?php
        include 'navbar.php';
        include 'db.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["relevence"] == "view") {
            $id = $_POST["id"];
            $query = "SELECT l.id, u.name, l.leave_type, l.start_date, l.end_date, l.reason, l.status, l.comment FROM user u, leave_applications l WHERE u.email = l.email AND u.role = 'employee' AND l.id = $id;";
            $data = executeQuery($query);
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["relevence"] == "edit") {
            $id = $_POST["id"];
            $leave_type = $_POST["leave-type"];
            $start_date = $_POST["start-date"];
            $end_date = $_POST["end-date"];
            $reason = $_POST["reason"];
            
            $query = "UPDATE leave_applications SET leave_type = '$leave_type', start_date = '$start_date', end_date = '$end_date', reason = '$reason' where id = '$id';";
            if(executeQuery($query)){
                $message = "Leave application updated";
                include "alert.php";
                $query = "SELECT l.id, u.name, l.leave_type, l.start_date, l.end_date, l.reason, l.status, l.comment FROM user u, leave_applications l WHERE u.email = l.email AND u.role = 'employee' AND l.id = $id;";
                $data = executeQuery($query);
            }
        }
    ?>
    <div class="form-container">
        <form class="approval-form" action="./employee_details_view.php" method = "post">
            <h2>Details</h2>
            <?php
                echo "Current status : " . $data[0]["status"];
            ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $data[0]["name"]; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="leave-type">Type of Leave</label>
                <select id="leave-type" name="leave-type" required>
                    <option value="" selected>-- Selct one --</option>
                    <option value="Sick">Sick Leave</option>
                    <option value="Casual">Casual Leave</option>
                    <option value="Annual">Annual Leave</option>
                    <option value="Vacation">Vacation Leave</option>
                    <option value="Accrued vacation">Accrued vacation</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start-date" value="<?php echo $data[0]["start_date"] ?>">
            </div>
            <div class="form-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date" value="<?php echo $data[0]["end_date"] ?>">
                <p id="message"></p>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" rows="4"><?php echo $data[0]["reason"] ?></textarea>
            </div>
            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" rows="4" readonly><?php echo $data[0]["comment"] ?></textarea>
            </div>
            <div class="button-group">
                <input type="hidden" name="id" value = "<?php echo $data[0]["id"] ?>">
                <input type="hidden" name="relevence" value = "edit">
                <input type="hidden" name="relevence1" value = "delete">
                <button type="submit" id = "form-btn" class="form-btn save-btn">Save</button>
            </div>
        </form>
    </div>
</body>
</html>
