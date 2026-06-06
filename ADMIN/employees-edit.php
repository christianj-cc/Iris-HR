<?php
include "../DATABASE/db_editEmployee.php";
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/employees-edit-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Edit Employee Details</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='employees.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel edit-employee">
                <form action="../DATABASE/db_updateEmployee.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="employee_id" value="<?= $employee['employee_id'] ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" name="first_name" value="<?= $employee['first_name'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" name="last_name" value="<?= $employee['last_name'] ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <input type="date" name="dob" id="dob" value="<?= $employee['date_of_birth'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Age:</label>
                            <input type="text" name="age" value="<?= $age ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <select name="gender" required>
                                <option value="Male" <?= $employee['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
                                <option value="Female" <?= $employee['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
                                <option value="Other" <?= $employee['gender'] == 'Other' ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" value="<?= $employee['email'] ?>" required readonly>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" id="phone" value="<?= $employee['contact_number'] ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Address:</label>
                            <input type="text" name="address" value="<?= $employee['address'] ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Position:</label>
                            <select name="position_id" required>
                                <option value="">Select</option>
                                <option value="1" <?= ($employee['position_id'] == 1) ? 'selected' : '' ?>>HR Manager</option>
                                <option value="2" <?= ($employee['position_id'] == 2) ? 'selected' : '' ?>>HR Officer</option>
                                <option value="3" <?= ($employee['position_id'] == 3) ? 'selected' : '' ?>>Accountant</option>
                                <option value="4" <?= ($employee['position_id'] == 4) ? 'selected' : '' ?>>Financial Analyst</option>
                                <option value="5" <?= ($employee['position_id'] == 5) ? 'selected' : '' ?>>IT Manager</option>
                                <option value="6" <?= ($employee['position_id'] == 6) ? 'selected' : '' ?>>Software Developer</option>
                                <option value="7" <?= ($employee['position_id'] == 7) ? 'selected' : '' ?>>Network Administrator</option>
                                <option value="8" <?= ($employee['position_id'] == 8) ? 'selected' : '' ?>>Sales Executive</option>
                                <option value="9" <?= ($employee['position_id'] == 9) ? 'selected' : '' ?>>Marketing Specialist</option>
                                <option value="10" <?= ($employee['position_id'] == 10) ? 'selected' : '' ?>>Operations Manager</option>
                                <option value="11" <?= ($employee['position_id'] == 11) ? 'selected' : '' ?>>Customer Service Rep</option>
                                <option value="12" <?= ($employee['position_id'] == 12) ? 'selected' : '' ?>>Research Analyst</option>
                                <option value="13" <?= ($employee['position_id'] == 13) ? 'selected' : '' ?>>Product Developer</option>
                                <option value="14" <?= ($employee['position_id'] == 14) ? 'selected' : '' ?>>Legal Advisor</option>
                                <option value="15" <?= ($employee['position_id'] == 15) ? 'selected' : '' ?>>Compliance Officer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Hire Date:</label>
                            <input type="date" name="hire_date" value="<?= date('Y-m-d', strtotime($employee['hire_date'])) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Profile Picture (Optional):</label>
                            <input type="file" name="profile_pic">
                        </div>
                    </div>

                    <button class="button-default" type="submit" name="edit_employee">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let phoneInputs = document.querySelectorAll("input[name='phone']");

            phoneInputs.forEach(function(phoneInput) {
                phoneInput.addEventListener("input", function() {
                    // Ensure the input always starts with "09"
                    if (!this.value.startsWith("09")) {
                        this.value = "09";
                    }

                    // Remove non-numeric characters
                    this.value = this.value.replace(/[^0-9]/g, "");

                    // Limit input to 11 characters
                    if (this.value.length > 11) {
                        this.value = this.value.slice(0, 11);
                    }

                    // Hide error while typing
                    this.setCustomValidity("");
                });

                phoneInput.addEventListener("blur", function() {
                    // Show validation error only when the user leaves the field
                    if (this.value.length < 11) {
                        this.setCustomValidity("Phone number must be 11 digits (e.g., 09123456789).");
                        this.reportValidity(); // Show tooltip
                    } else {
                        this.setCustomValidity("");
                    }
                });

                phoneInput.addEventListener("keydown", function(e) {
                    // Prevent deletion of "09"
                    if ((this.selectionStart < 2 || this.selectionEnd < 2) && (e.key === "Backspace" || e.key === "Delete")) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>

</body>

</html>