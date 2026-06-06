<?php
include '../DATABASE/db_fetchAttendance.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/attendance-details-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp;&nbsp;</i>Attendance Details</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='attendance.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel">
                <h2><?= htmlspecialchars($employee_name) ?></h2>

                <form method="GET" action="attendance-details.php" class="date-filter-form">
                    <input type="hidden" name="employee_id" value="<?= $employee_id ?>">

                    <div class="date-filter-group">
                        <div class="input-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" value="<?= htmlspecialchars($start_date) ?>">
                        </div>
                        <div class="input-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" value="<?= htmlspecialchars($end_date) ?>">
                        </div>
                        <button type="submit" class="btn-filter"><i class="fas fa-filter"></i></button>
                    </div>
                </form>

                <div class="table-container">
                    <table class="employee-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Status</th>
                                <th>Work Hours</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $attendance_result->fetch_assoc()) { ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['date']) ?></td>
                                    <td><?= htmlspecialchars($row['clock_in']) ?></td>
                                    <td><?= htmlspecialchars($row['clock_out']) ?></td>
                                    <td><?= htmlspecialchars($row['status']) ?></td>
                                    <td><?= $row['work_hours'] !== null ? $row['work_hours'] . " hrs" : "N/A" ?></td>
                                    <td>
                                        <a href="attendance-edit.php?employee_id=<?= $employee_id; ?>&date=<?= $row['date']; ?>" title="Edit">
                                            <i class="fas fa-edit" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i></a>
                                    </td>
                                <?php } ?>

                                <?php if ($attendance_result->num_rows === 0) { ?>
                                <tr>
                                    <td colspan="6" style="text-align: center; font-weight: bold; padding: 10px;">
                                        No records found for this employee in the selected date range.
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>