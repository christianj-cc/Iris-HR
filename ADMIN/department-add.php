<?php
include '../DATABASE/db_addDepartment.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/department-add-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Add Department</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='departments.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-employee">
                <form method="POST" action="">
                    <label for="department_name">Department Name:</label>
                    <input type="text" id="department_name" name="department_name" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description"></textarea>

                    <button class="button-default" type="submit">Add Department</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>