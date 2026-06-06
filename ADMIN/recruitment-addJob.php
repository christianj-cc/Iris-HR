<?php
include '../DATABASE/db_addJob.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/recruitment-addJob-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Post New Job</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='recruitment.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel add-job">
                <form action="../DATABASE/db_addJob.php" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Job Title / Position:</label>
                            <select name="job_title" id="job_title" required>
                                <option value="">-- Select a Position --</option>
                                <?php
                                $positions_result = $conn->query("SELECT position_id, position_name FROM positions ORDER BY position_id");
                                while ($row = $positions_result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['position_name']) . "'>" . htmlspecialchars($row['position_name']) . "</option>";
                                }
                                ?>
                            </select>
                            <!--<option value="new">+ Add New Position</option>-->
                            <input type="text" id="new_position" name="new_position" placeholder="Enter new position name" style="display:none;">
                        </div>
                        <div class="form-group">
                            <label>Department:</label>
                            <select name="department_name" id="department" required>
                                <option value="">-- Select a Department --</option>
                                <?php
                                $departments_result = $conn->query("SELECT department_id, department_name FROM departments ORDER BY department_id");
                                while ($row = $departments_result->fetch_assoc()) {
                                    echo "<option value='" . htmlspecialchars($row['department_name']) . "'>" . htmlspecialchars($row['department_name']) . "</option>";
                                }
                                ?>
                                <!--<option value="new">+ Add New Department</option>-->
                            </select>
                            <input type="text" id="new_department" name="new_department" placeholder="Enter new department name" style="display:none;">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Base Salary:</label>
                            <select name="salary" id="salary" required>
                                <option value="">-- Select Salary --</option>
                                <?php
                                $salaries_result = $conn->query("SELECT DISTINCT base_salary FROM positions ORDER BY base_salary ASC");
                                while ($row = $salaries_result->fetch_assoc()) {
                                    echo "<option value='" . $row['base_salary'] . "'>" . number_format($row['base_salary'], 2) . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Number of Vacancies:</label>
                            <input type="number" name="vacancies" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Job Summary:</label>
                            <textarea name="job_summary"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Responsibilities:</label>
                            <textarea name="responsibilities"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Requirements:</label>
                            <textarea name="requirements"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Qualifications:</label>
                            <textarea name="qualifications"></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Application Deadline:</label>
                            <input type="date" name="application_deadline" required>
                        </div>
                        <div class="form-group">
                            <label>Contact:</label>
                            <input type="text" name="contact" required>
                        </div>
                    </div>

                    <button class="button-default" type="submit">Post Job</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>