<?php
include '../DATABASE/db_editUserRequest.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Request</title>
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/SIDEBAR/request-editRequest-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Update Request</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='request-user.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-request">
                <form action="../DATABASE/db_updateUserRequest.php" method="POST">
                    <input type="hidden" name="leave_id" value="<?php echo $leave['leave_id']; ?>">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="leave_type">Leave Type:</label>
                            <select id="leave_type" name="leave_type" required>
                                <option value="Vacation" <?php if ($leave['leave_type'] == 'Vacation') echo 'selected'; ?>>Vacation</option>
                                <option value="Sick" <?php if ($leave['leave_type'] == 'Sick') echo 'selected'; ?>>Sick</option>
                                <option value="Emergency" <?php if ($leave['leave_type'] == 'Emergency') echo 'selected'; ?>>Emergency</option>
                                <option value="Maternity" <?php if ($leave['leave_type'] == 'Maternity') echo 'selected'; ?>>Maternity</option>
                                <option value="Paternity" <?php if ($leave['leave_type'] == 'Paternity') echo 'selected'; ?>>Paternity</option>
                                <option value="Bereavement" <?php if ($leave['leave_type'] == 'Bereavement') echo 'selected'; ?>>Bereavement</option>
                                <option value="Unpaid" <?php if ($leave['leave_type'] == 'Unpaid') echo 'selected'; ?>>Unpaid</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" id="start_date" name="start_date" value="<?php echo $leave['start_date']; ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" id="end_date" name="end_date" value="<?php echo $leave['end_date']; ?>" required>
                        </div>
                    </div>

                    <label for="message">Message:</label>
                    <textarea id="message" name="message" required><?php echo htmlspecialchars($leave['message']); ?></textarea>

                    <button type="submit" class="button-default">Update Request</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>