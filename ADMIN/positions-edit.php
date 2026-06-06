<?php
include '../DATABASE/db_editPosition.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Positions</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/positions-edit-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Edit Position Details</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='positions.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-employee">
                <form action="../DATABASE/db_updatePosition.php" method="POST">
                    <input type="hidden" name="position_id" value="<?= htmlspecialchars($position['position_id']) ?>">

                    <label>Position Name:</label>
                    <input type="text" name="position_name" value="<?= htmlspecialchars($position['position_name']) ?>" required>

                    <label>Description:</label>
                    <textarea name="description"><?= htmlspecialchars($position['description']) ?></textarea>

                    <button type="submit" class="button-default">Update Position</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>