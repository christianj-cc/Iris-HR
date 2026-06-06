<?php
include '../DATABASE/db_fetchUserPayroll.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll</title>
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Payroll</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <div class="panel payroll">
                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>Days Worked</th>
                                <th>Absences</th>
                                <th>Late Arrivals</th>
                                <th>Overtime Hours</th>
                                <th>Gross Salary</th>
                                <th>Deductions</th>
                                <th>Net Salary</th>
                                <th>Payment Status</th>
                                <th>PaymentPeriod</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($payrollData)): ?>
                                <?php foreach ($payrollData as $payroll): ?>
                                    <tr>
                                        <td><?= $payroll['days_worked'] ?></td>
                                        <td><?= $payroll['absences'] ?></td>
                                        <td><?= $payroll['lates'] ?></td>
                                        <td><?= $payroll['overtime_hours'] ?></td>
                                        <td>₱<?= number_format($payroll['gross_salary'], 2) ?></td>
                                        <td>₱<?= number_format($payroll['deductions'], 2) ?></td>
                                        <td>₱<?= number_format($payroll['net_salary'], 2) ?></td>
                                        <td><?= $payroll['payment_status'] ?></td>
                                        <td><?= date("F d, Y", strtotime($payroll['pay_period_start'])) ?> to <?= date("F d, Y", strtotime($payroll['pay_period_end'])) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">No payroll records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> - <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>
                        <?php if ($page > 1): ?>
                            <a href="payroll-user.php?page=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="payroll-user.php?page=<?= $i ?>&search=<?= $search ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="payroll-user.php?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>