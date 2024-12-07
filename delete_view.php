<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $Appname;
    ?> - Delete Leave Approval Form</title>
    <link rel="stylesheet" href="CSS\delete_view.css">
    <link rel="stylesheet" href="./CSS/home.css">
    <link rel="stylesheet" href="./CSS/alert.css">
</head>
<body>
<script src = "./Javascript/logic.js"></script>
    <?php
        include 'navbar.php';
        include 'db.php';
        if ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["relevence"] == "view") {
            $id = $_POST["id"];
            $query = "SELECT id, leave_type, start_date, end_date, reason, status FROM leave_applications WHERE id = $id;";
            $data = executeQuery($query);
        }
        elseif ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["relevence"] == "delete") {
            $id = $_POST["id"];
            // $status = $_POST["decision"];
            // $comment = $_POST["comments"];
            $query = "DELETE FROM leave_applications where id = '$id';";
            if(executeQuery($query)){
                $message = "Leave application deleted";
                include "alert.php";
                exit();
            }
        }
    ?>
    <div class="form-container">
        <form class="approval-form" action="./delete_view.php" method = "post">
            <h2>Leave Approval Form</h2>
            <?php
                echo "Current status : " . $data[0]["status"];
            ?>
            <div class="form-group">
                <label for="leave-type">Leave Type</label>
                <input type="text" id="leave-type" name="leave-type" value="<?php echo $data[0]["leave_type"] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start-date" value="<?php echo $data[0]["start_date"] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date" value="<?php echo $data[0]["end_date"] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason</label>
                <textarea id="reason" name="reason" rows="4" readonly><?php echo $data[0]["reason"] ?></textarea>
            </div>
            <input type='hidden' name='id' value = "<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $_POST["id"];
            } ?>">
            <input type='hidden' name='relevence' value = "delete">
            <div class="button-container">
                <button class="delete-btn">Cancel leave</button>
            </div>
        </form>
    </div>
</body>
</html>