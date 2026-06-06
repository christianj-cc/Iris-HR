<?php
include '../DATABASE/db_editDepartment.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/departments-edit-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Edit Department Details</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='departments.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-employee">
                <form action="../DATABASE/db_editDepartment.php" method="POST">
                    <input type="hidden" name="department_id" value="<?= htmlspecialchars($department['department_id']) ?>">

                    <label>Department Name:</label>
                    <input type="text" name="department_name" value="<?= htmlspecialchars($department['department_name']) ?>" required>

                    <label>Description:</label>
                    <textarea name="description"><?= htmlspecialchars($department['description']) ?></textarea>

                    <button type="submit" class="button-default">Update Department</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>