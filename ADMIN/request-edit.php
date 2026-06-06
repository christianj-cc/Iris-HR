<?php
include '../DATABASE/db_editRequestResponse.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/request-edit-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Edit Request Response</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='requests.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel">
                <h2 style="width: 100%; text-align: left; margin-bottom: 15px;"><strong>This request has already been processed.</strong></h2>
                <table class="details-table">
                    <tr>
                        <th>ID:</th>
                        <td><?= $request['leave_id'] ?></td>
                    </tr>
                    <tr>
                        <th>Created By:</th>
                        <td><?= $request['employee_name'] ?></td>
                    </tr>
                    <tr>
                        <th>Request Type:</th>
                        <td><?= ucfirst($request['leave_type']) ?></td>
                    </tr>
                    <tr>
                        <th>Request Message:</th>
                        <td><?= nl2br(htmlspecialchars($request['message'])) ?></td>
                    </tr>
                    <tr>
                        <th>Starting Date:</th>
                        <td><?= date('M d, Y', strtotime($request['start_date'])) ?></td>
                    </tr>
                    <tr>
                        <th>End Date:</th>
                        <td><?= date('M d, Y', strtotime($request['end_date'])) ?></td>
                    </tr>
                    <tr>
                        <th>Submission Date:</th>
                        <td><?= date('M d, Y H:i A', strtotime($request['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <th>Status:</th>
                        <td><?= ucfirst($request['status']) ?></td>
                    </tr>
                    <tr>
                        <th>Admin Message:</th>
                        <td><?= $request['admin_message'] ? nl2br(htmlspecialchars($request['admin_message'])) : '<i>No response yet.<i>' ?></td>
                    </tr>
                </table>
                <br>
                <h2 style="width: 100%; text-align: left; margin-bottom: 15px;">Change Response</h2>
                <form method="post">
                    <label for="admin_message">Admin Response:</label>
                    <textarea name="admin_message"><?= htmlspecialchars($request['admin_message']) ?></textarea>

                    <label for="status">Update Status:</label>
                    <select name="status">
                        <option value="Pending" <?= ($request['status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                        <option value="Approved" <?= ($request['status'] == 'Approved') ? 'selected' : '' ?>>Approved</option>
                        <option value="Rejected" <?= ($request['status'] == 'Rejected') ? 'selected' : '' ?>>Rejected</option>
                    </select>

                    <button type="submit" class="button-default">Update Request</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>