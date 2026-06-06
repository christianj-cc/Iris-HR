<?php
include '../DATABASE/db_viewJobUser.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment</title>
    <link rel="icon" type="image/x-icon" href="../ICONS/site-icon.ico">
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>View Job Posting</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <div class="header-container">
                <button id="backToButton" class="button-default" onclick="location.href='recruitment-user.php';">
                    <i class="fas fa-chevron-left">&nbsp</i>Back
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
                            <td><?= htmlspecialchars($job['department']) ?></td>
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

                <div class="apply-form">
                    <?php if (!$already_applied): ?>
                        <form action="../DATABASE/db_applyUser.php" method="POST" enctype="multipart/form-data" class="form-container1">
                            <input type="hidden" name="job_id" value="<?= $job_id ?>">

                            <div class="form-row">
                                <div class="form-group">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" value="<?= htmlspecialchars($user_details['first_name']) ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name" value="<?= htmlspecialchars($user_details['last_name']) ?>" readonly required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input type="email" name="email" value="<?= htmlspecialchars($user_details['email']) ?>" readonly required>
                                </div>
                                <div class="form-group">
                                    <label>Phone Number:</label>
                                    <input type="text" name="phone" value="<?= htmlspecialchars($user_details['contact_number']) ?>" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label>Cover Letter (PDF only):</label>
                                    <input type="file" name="cover_letter" accept=".pdf" required>
                                </div>
                                <div class="form-group">
                                    <label>Resume (PDF only):</label>
                                    <input type="file" name="resume" accept=".pdf" required>
                                </div>
                            </div>

                            <button type="submit" class="button-default">Apply Now</button>
                        </form>
                    <?php else: ?>
                        <p style="color: green;">✅ You have already applied for this job.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>