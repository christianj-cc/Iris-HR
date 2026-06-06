<?php
include '../DATABASE/db_fetchAllPayroll.php';
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
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Payroll</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <div class="header-container">
                <!-- Generate Payroll with Password Modal -->
                <form method="POST" action="../DATABASE/db_generatePayroll.php" id="generatePayrollForm">
                    <input type="hidden" name="admin_password" id="generate_password" value="">
                    <button type="button" id="generatePayrollBtn" class="button-default button-top" onclick="openGeneratePasswordModal()">
                        <i class="fas fa-money-check-alt">&nbsp;&nbsp;</i>Generate Payroll
                    </button>
                </form>

                <!-- Increase Payroll with Password Modal -->
                <button type="button" id="increasePayrollBtn" class="button-default button-top" onclick="openIncreasePasswordModal()">
                    <i class="fas fa-edit"></i>&nbsp;&nbsp;Increase Payroll
                </button>

                <div class="search-container1">
                    <form method="GET" action="payroll.php">
                        <input type="text" name="search" placeholder="Search Employees" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel payroll">
                <div class="table-container">
                    <table class="payroll-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>EMPLOYEE NAME</th>
                                <th>GROSS SALARY</th>
                                <th>DEDUCTIONS</th>
                                <th>NET SALARY</th>
                                <th>PAYMENT STATUS</th>
                                <th>PAYMENT PERIOD</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($payroll_data)): ?>
                                <?php foreach ($payroll_data as $row): ?>
                                    <tr>
                                        <td><?php echo $row['employee_id']; ?></td>
                                        <td><?php echo $row['employee_name']; ?></td>
                                        <td>₱<?php echo $row['gross_salary']; ?></td>
                                        <td>₱<?php echo $row['deductions']; ?></td>
                                        <td>₱<?php echo $row['net_salary']; ?></td>
                                        <td><?php echo $row['payment_status']; ?></td>
                                        <td><?php echo $row['pay_period_start']; ?> to <?php echo $row['pay_period_end']; ?></td>
                                        <td>
                                            <a href="#" class="edit-payroll-btn"
                                                data-id="<?= $row['payroll_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['employee_name']) ?>"
                                                title="Edit">
                                                <i class="fas fa-edit" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">No records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> - <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>
                        <?php if ($page > 1): ?>
                            <a href="payroll.php?page=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="payroll.php?page=<?= $i ?>&search=<?= $search ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="payroll.php?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- GENERATE PAYROLL PASSWORD MODAL -->
        <div id="generatePayrollPasswordModal" class="content-modal" style="display: none;">
            <div class="modalContent">
                <div style="text-align: center;">
                    <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
                </div>
                <br>
                <h3>Admin Password Required</h3>
                <p>Please enter your admin password to generate payroll.</p>
                <form id="generatePayrollPasswordForm">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <input type="password" name="admin_password" id="generate_admin_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="modal-buttons">
                        <button type="button" id="cancelGeneratePassword" class="button-default">Cancel</button>
                        <button type="submit" id="confirmGeneratePassword" class="button-default">Confirm</button>
                    </div>
                </form>
                <div id="generatePasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
            </div>
        </div>

        <!-- INCREASE PAYROLL PASSWORD MODAL -->
        <div id="increasePayrollPasswordModal" class="content-modal" style="display: none;">
            <div class="modalContent">
                <div style="text-align: center;">
                    <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
                </div>
                <br>
                <h3>Admin Password Required</h3>
                <p>Please enter your admin password to access the Increase Payroll form.</p>
                <form id="increasePayrollPasswordForm">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <input type="password" name="admin_password" id="increase_admin_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="modal-buttons">
                        <button type="button" id="cancelIncreasePassword" class="button-default">Cancel</button>
                        <button type="submit" id="confirmIncreasePassword" class="button-default">Continue</button>
                    </div>
                </form>
                <div id="increasePasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
            </div>
        </div>

        <!-- EDIT PAYROLL PASSWORD MODAL -->
        <div id="editPayrollPasswordModal" class="content-modal" style="display: none;">
            <div class="modalContent">
                <div style="text-align: center;">
                    <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
                </div>
                <br>
                <h3>Admin Password Required</h3>
                <p>Please enter your admin password to edit payroll for <span id="payrollNameForEdit"></span>.</p>
                <form id="editPayrollPasswordForm">
                    <input type="hidden" name="payroll_id" id="edit_payroll_id" value="">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <input type="password" name="admin_password" id="edit_payroll_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                    </div>
                    <div class="modal-buttons">
                        <button type="button" id="cancelEditPayrollPassword" class="button-default">Cancel</button>
                        <button type="submit" id="confirmEditPayrollPassword" class="button-default">Continue to Edit</button>
                    </div>
                </form>
                <div id="editPayrollPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
            </div>
        </div>
</body>

</html>