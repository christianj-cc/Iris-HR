<?php
include '../DATABASE/db_addPosition.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/positions-add-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>New Position</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='positions.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-employee">
                <form action="../DATABASE/db_addPosition.php" method="POST">
                    <label>Position Name:</label>
                    <input type="text" name="position_name" placeholder="Enter position name" required>

                    <label>Department:</label>
                    <select name="department_id" required>
                        <option value="" disabled selected>Select a department</option>
                        <?php
                        include 'db_connect.php';
                        $departments = $conn->query("SELECT department_id, department_name FROM departments");
                        while ($row = $departments->fetch_assoc()) {
                            echo "<option value='" . $row['department_id'] . "'>" . htmlspecialchars($row['department_name']) . "</option>";
                        }
                        ?>
                    </select>

                    <label>Base Salary:</label>
                    <input type="number" name="base_salary" placeholder="Enter base salary" required>

                    <label>Description:</label>
                    <textarea name="description" placeholder="Enter position description"></textarea>

                    <button type="submit" class="button-default">Add Position</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>