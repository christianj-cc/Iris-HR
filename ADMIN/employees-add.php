<?php
include '../DATABASE/db_addEmployee.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/employees-add-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Add Employee</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='employees.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-employee">
                <form action="../DATABASE/db_addEmployee.php" method="POST" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" name="first_name" id="first_name" placeholder="Hank" required onkeyup="generateEmail()">
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" name="last_name" id="last_name" placeholder="Schrader" required onkeyup="generateEmail()">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" id="email" placeholder="h.schrader.456@company.com" readonly>
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="text" name="password" id="password" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Date of Birth:</label>
                            <input type="date" name="dob" required>
                        </div>
                        <div class="form-group">
                            <label>Age:</label>
                            <input type="text" name="age" id="age" placeholder="30" readonly>
                        </div>
                        <div class="form-group">
                            <label>Gender:</label>
                            <select name="gender" required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" id="phone" placeholder="09123456789" maxlength="11" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Address:</label>
                            <input type="text" name="address" placeholder="123 Main St, City" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Position:</label>
                            <select name="position_id" required>
                                <option value="">Select</option>
                                <?php
                                $result = $conn->query("SELECT position_id, position_name FROM positions");
                                while ($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['position_id'] . "'>" . $row['position_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hire Date:</label>
                            <input type="date" name="hire_date" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Profile Picture (Optional):</label>
                        <input type="file" name="profile_pic">
                    </div>
                    <button class="button-default" type="submit" name="add_employee">Add Employee</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let phoneInput = document.getElementById("phone");

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
    </script>

</body>

</html>