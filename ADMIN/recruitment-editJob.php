<?php
include '../DATABASE/db_editJob.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/employees-view-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Edit Job Posting</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='recruitment.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel edit-job">
                <form method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Status:</label>
                            <select name="status">
                                <option value="Open" <?= ($job['status'] == 'Open') ? 'selected' : '' ?>>Open</option>
                                <option value="Closed" <?= ($job['status'] == 'Closed') ? 'selected' : '' ?>>Closed</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Job Title:</label>
                            <input type="text" name="job_title" value="<?= htmlspecialchars($job['job_title']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Department:</label>
                            <input type="text" name="department" value="<?= htmlspecialchars($job['department']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Salary:</label>
                            <input type="number" name="salary" value="<?= htmlspecialchars($job['salary']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Number of Vacancies:</label>
                            <input type="number" name="vacancies" value="<?= htmlspecialchars($job['vacancies']) ?>" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Job Summary:</label>
                            <textarea name="job_summary"><?= htmlspecialchars($job['job_summary']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Responsibilities:</label>
                            <textarea name="responsibilities"><?= htmlspecialchars($job['responsibilities']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Requirements:</label>
                            <textarea name="requirements"><?= htmlspecialchars($job['requirements']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Qualifications:</label>
                            <textarea name="qualifications"><?= htmlspecialchars($job['qualifications']) ?></textarea>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Application Deadline:</label>
                            <input type="date" name="application_deadline" value="<?= htmlspecialchars($job['application_deadline']) ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Contact:</label>
                            <input type="text" name="contact" value="<?= htmlspecialchars($job['contact']) ?>" required>
                        </div>
                    </div>

                    <button class="button-default" type="submit" name="edit_job">Update Job</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>