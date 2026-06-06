<?php
include '../DATABASE/db_editAttendance.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/attendance-edit-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp;&nbsp;</i>Edit Attendance</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='attendance-details.php?employee_id=<?= $employee_id; ?>';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel">
                <form method="POST" action="../DATABASE/db_editAttendance.php?employee_id=<?= $employee_id; ?>&date=<?= $date; ?>">
                    <label>Clock In:</label>
                    <input type="time" name="clock_in" value="<?= $attendance['clock_in']; ?>">

                    <label>Clock Out:</label>
                    <input type="time" name="clock_out" value="<?= $attendance['clock_out']; ?>">

                    <label>Status:</label>
                    <select name="status">
                        <option value="Present" <?= ($attendance['status'] == 'Present') ? 'selected' : ''; ?>>Present</option>
                        <option value="Absent" <?= ($attendance['status'] == 'Absent') ? 'selected' : ''; ?>>Absent</option>
                        <option value="Late" <?= ($attendance['status'] == 'Late') ? 'selected' : ''; ?>>Late</option>
                    </select>

                    <button type="submit" class="button-default">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>