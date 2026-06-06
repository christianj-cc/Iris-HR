<?php
include '../DATABASE/db_editPayroll.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/admin-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Payroll Review</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='payroll.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel basic-data">
                <h3>Payroll Details</h3>
                <div class="grid-container1">
                    <div class="input-group">
                        <label>Payroll ID</label>
                        <input type="text" value="<?= $payroll_id; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Issued For</label>
                        <input type="text" value="<?= $employee_name; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Base Salary</label>
                        <input type="text" value="₱<?= number_format($base_salary, 2); ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Due Date</label>
                        <input type="text" value="<?= $due_date; ?>" readonly>
                    </div>
                </div>
            </div>

            <div class="panel attendance-data">
                <h3>Attendance Summary</h3>
                <div class="grid-container1">
                    <div class="input-group">
                        <label>Attendable Days (within payment period)</label>
                        <input type="text" value="<?= $attendable_days; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Present</label>
                        <input type="text" value="<?= $days_present; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Late</label>
                        <input type="text" value="<?= $days_late; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Absent</label>
                        <input type="text" value="<?= $days_absent; ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Total Hours Worked</label>
                        <input type="text" value="<?= $total_hours_worked; ?> hrs" readonly>
                    </div>
                    <div class="input-group">
                        <label>Overtime Hours</label>
                        <input type="text" value="<?= $overtime_hours; ?> hrs" readonly>
                    </div>
                </div>
            </div>

            <div class="panel grand-total">
                <h3>Salary Calculation</h3>
                <div class="grid-container1">
                    <div class="input-group">
                        <label>Gross Salary</label>
                        <input type="text" value="₱<?= number_format($gross_salary, 2); ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Deductions</label>
                        <input type="text" value="₱<?= number_format($deductions, 2); ?>" readonly>
                    </div>
                    <div class="input-group">
                        <label>Net Salary</label>
                        <input type="text" value="₱<?= number_format($net_salary, 2); ?>" readonly>
                    </div>
                </div>

                <div class="button-container">
                    <form method="POST" action="../DATABASE/db_updatePayroll.php">
                        <input type="hidden" name="payroll_id" value="<?= $payroll_id ?>">
                        <button type="submit" name="mark_pending" class="button-default pending"
                            <?= ($payment_status === 'Pending') ? 'disabled' : ''; ?>>
                            <i class="fa-solid fa-hourglass-half"></i> Mark as Pending
                        </button>

                        <button type="submit" name="pay" class="button-default"
                            <?= ($payment_status === 'Paid') ? 'disabled' : ''; ?>>
                            <i class="fa-solid fa-check-circle"></i> Mark as Paid
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>