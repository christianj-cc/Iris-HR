<?php
include '../DATABASE/db_viewDepartment.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/departments-view-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Department Details</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='departments.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-employee">
                <form>
                    <label>Department Name:</label>
                    <input type="text" value="<?= htmlspecialchars($department['department_name']) ?>" readonly>

                    <label>Description:</label>
                    <textarea readonly><?= htmlspecialchars($department['description']) ?></textarea>
                </form>
            </div>
        </div>
    </div>
</body>

</html>