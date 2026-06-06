<?php
include '../DATABASE/db_increasePayroll.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/payroll-increase-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Adjust Payroll</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='payroll.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel payroll">
                <form method="POST" action="../DATABASE/db_increasePayroll.php" class="form-container1">
                    <div class="form-row">
                        <div class="left-side">
                            <div class="row">
                                <label for="adjustment_type">Apply Increase To:</label>
                                <select name="adjustment_type" id="adjustment_type" required onchange="toggleFields()">
                                    <option value="employee">Specific Employee</option>
                                    <option value="position">Job Position</option>
                                    <option value="department">Department</option>
                                </select>
                            </div>
                            <div class="increase-amount">
                                <label for="increase_amount">Increase Amount (₱):</label>
                                <input type="number" name="increase_amount" id="increase_amount" required>
                            </div>
                        </div>

                        <div class="right-side">
                            <div class="row">
                                <label for="employee_id">Employee ID:</label>
                                <input type="text" name="employee_id" id="employee_id" placeholder="Enter Employee ID">
                            </div>
                            <div class="row">
                                <label for="position">Position:</label>
                                <select name="position_id" id="position">
                                    <option value="">Select Position</option>
                                    <?php while ($row = $positions->fetch_assoc()): ?>
                                        <option value="<?= $row['position_id'] ?>"><?= $row['position_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="row">
                                <label for="department">Department:</label>
                                <select name="department_id" id="department">
                                    <option value="">Select Department</option>
                                    <?php while ($row = $departments->fetch_assoc()): ?>
                                        <option value="<?= $row['department_id'] ?>"><?= $row['department_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="button-default apply">Apply Increase</button>
                </form>
            </div>
        </div>

        <script>
            function toggleFields() {
                let type = document.getElementById("adjustment_type").value;
                let empField = document.getElementById("employee_id");
                let posField = document.getElementById("position");
                let deptField = document.getElementById("department");

                empField.disabled = true;
                posField.disabled = true;
                deptField.disabled = true;

                empField.classList.remove("highlight");
                posField.classList.remove("highlight");
                deptField.classList.remove("highlight");

                if (type === "employee") {
                    empField.disabled = false;
                    empField.classList.add("highlight");
                } else if (type === "position") {
                    posField.disabled = false;
                    posField.classList.add("highlight");
                } else {
                    deptField.disabled = false;
                    deptField.classList.add("highlight");
                }
            }

            toggleFields();
        </script>
</body>

</html>