<?php
include '../DATABASE/db_addRequest.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reqeust</title>
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/SIDEBAR/request-addRequest-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Submit Request</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='request-user.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-request">
                <form action="../DATABASE/db_addRequest.php" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="leave_type">Leave Type:</label>
                            <select name="leave_type" id="leave_type" required>
                                <option value="Vacation">Vacation</option>
                                <option value="Sick">Sick</option>
                                <option value="Emergency">Emergency</option>
                                <option value="Maternity">Maternity</option>
                                <option value="Paternity">Paternity</option>
                                <option value="Bereavement">Bereavement</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" id="end_date" required>
                        </div>
                    </div>

                    <label for="message">Message:</label>
                    <textarea name="message" id="message" required></textarea>

                    <button type="submit" class="button-default">Submit Request</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>