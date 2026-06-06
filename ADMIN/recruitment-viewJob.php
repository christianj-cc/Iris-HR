<?php
include '../DATABASE/db_viewJob.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/recruitment-viewJob-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Job Details</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <div class="header-container">
                <button id="backToButton" class="button-default" onclick="location.href='recruitment.php';">
                    <i class="fas fa-chevron-left">&nbsp</i>Back
                </button>

                <button id="backToButton" class="button-default right" onclick="location.href='recruitment-applicants.php?job_id=<?= $job_id ?>';">
                    <i class="fas fa-users">&nbsp</i>Applicants
                </button>
            </div>
            <div class="panel view-job">
                <div class="details-container">
                    <table class="details-table">
                        <tr>
                            <th>Job Title:</th>
                            <td><?= htmlspecialchars($job['job_title']) ?></td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td><?= htmlspecialchars($job['department_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Salary:</th>
                            <td><?= number_format((float) $job['salary'], 2) ?></td>
                        </tr>
                        <tr>
                            <th>Number of Vacancies:</th>
                            <td><?= htmlspecialchars($job['vacancies']) ?></td>
                        </tr>
                        <tr>
                            <th>Job Summary:</th>
                            <td><?= nl2br(htmlspecialchars($job['job_summary'])) ?></td>
                        </tr>
                        <tr>
                            <th>Responsibilities:</th>
                            <td><?= nl2br(htmlspecialchars($job['responsibilities'])) ?></td>
                        </tr>
                        <tr>
                            <th>Requirements:</th>
                            <td><?= nl2br(htmlspecialchars($job['requirements'])) ?></td>
                        </tr>
                        <tr>
                            <th>Qualifications:</th>
                            <td><?= nl2br(htmlspecialchars($job['qualifications'])) ?></td>
                        </tr>
                        <tr>
                            <th>Application Deadline:</th>
                            <td><?= htmlspecialchars($job['application_deadline']) ?></td>
                        </tr>
                        <tr>
                            <th>Contact:</th>
                            <td><?= htmlspecialchars($job['contact']) ?></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td><?= htmlspecialchars($job['status']) ?></td>
                        </tr>
                        <tr>
                            <th>Posted On:</th>
                            <td><?= htmlspecialchars($job['created_at']) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>