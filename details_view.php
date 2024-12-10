<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
        include "constants.php";
        echo $APPNAME;
    ?> - Details</title>
    <link rel="stylesheet" href="CSS\details_view.css">
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
        elseif ($_SERVER["REQUEST_METHOD"] == "POST" and $_POST["relevence"] == "update") {
            $id = $_POST["id"];
            $status = $_POST["decision"];
            $comment = $_POST["comments"];
            $query = "update leave_applications SET status = '$status', comment = '$comment' where id = '$id';";
            if(executeQuery($query)){
                $message = "Dissition submitted";
                include "alert.php";
                $query = "SELECT l.id, u.name, l.leave_type, l.start_date, l.end_date, l.reason, l.comment, l.status FROM user u, leave_applications l WHERE u.email = l.email AND u.role = 'employee' AND l.id = $id;";
                $data = executeQuery($query);
            }
        }
    ?>
    <div class="form-container">
        <form class="approval-form" action="./details_view.php" method = "post">
            <h2>Details</h2>
            <?php
                echo "Current status : " . $data[0]["status"];
            ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="<?php echo $data[0]["name"]; ?>" readonly>
            </div>
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
            <div class="form-group approval-buttons">
                <label>Approval</label>
                <div class="radio-group">
                    <input type="radio" id="approve" name="decision" value="Approved" <?php if ($data[0]["status"] == "Approved") {
                        echo "checked";
                    } ?>>
                    <label for="approve">Approve</label>
                    <input type="radio" id="deny" name="decision" value="Denied" <?php if ($data[0]["status"] == "Denied") {
                        echo "checked";
                    } ?>>
                    <label for="deny">Deny</label>
                </div>
            </div>
            <div class="form-group">
                <label for="comments">Comments</label>
                <textarea id="comments" name="comments" rows="4"><?php echo $data[0]["comment"]; ?></textarea>
            </div>
            <input type='hidden' name='id' value = "<?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                echo $_POST["id"];
            } ?>">
            <input type='hidden' name='relevence' value = "update">
            <div class="button-group">
                <button type="submit" class="form-btn">Submit Decision</button>
                <a href = "./pending_applications.php" id = "form-btn" class="form-btn save-btn" style = "text-decoration : none">Back to pending</a>
                <a href = "./aproved_applications.php" id = "form-btn" class="form-btn save-btn" style = "text-decoration : none">Back to approved</a>
                <a href = "./denied_applications.php" id = "form-btn" class="form-btn save-btn" style = "text-decoration : none">Back to denied</a>
            </div>
        </form>
    </div>
</body>
</html>