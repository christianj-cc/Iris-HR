<?php
include '../DATABASE/db_fetchJobs.php';
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
        <?php include '../INCLUDES/ADMIN/admin-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Recruitment</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <hr class="quick-actions-line">
            <div class="quick-actions-tabs">
                <a href="recruitment.php" class="tab <?= $currentPage == 'recruitment.php' ? 'active' : '' ?>"><i class="fa-solid fa-newspaper">&nbsp&nbsp</i>Job Postings</a>
                <a href="recruitment-applicants.php" class="tab <?= $currentPage == 'recruitments-applicants.php' ? 'active' : '' ?>"><i class="fas fa-envelope-open">&nbsp&nbsp</i>Applicants</a>
                <a href="departments.php" class="tab <?= $currentPage == 'departments.php' ? 'active' : '' ?>"><i class="fas fa-building">&nbsp&nbsp</i>Departments</a>
                <a href="positions.php" class="tab <?= $currentPage == 'positions.php' ? 'active' : '' ?>"><i class="fas fa-briefcase">&nbsp&nbsp</i>Positions</a>
            </div>

            <div class="header-container">
                <button id="addJobButton" class="button-default" onclick="location.href='recruitment-addJob.php';">
                    <i class="fas fa-plus">&nbsp&nbsp</i>New Job
                </button>

                <div class="search-container">
                    <form method="GET" action="recruitment.php">
                        <input type="text" name="search" placeholder="Search by Job Title or Department" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel recruitment">

                <div class="table-container">
                    <table class="recruitment-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>JOB TITLE</th>
                                <th>DEPARTMENT</th>
                                <th>APPLICANTS</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['job_id'] ?></td>
                                        <td><?= $row['job_title'] ?></td>
                                        <td><?= $row['department'] ?></td>
                                        <td><?= $row['total_applicants'] ?></td>
                                        <td><?= $row['status'] ?></td>
                                        <td>
                                            <a href="recruitment-viewJob.php?job_id=<?= htmlspecialchars($row['job_id']) ?>" title="View"><i class="fas fa-eye" style="color:rgb(48, 87, 155);  margin: 0 5px 0 0; font-size: 1.3rem;"></i></a>
                                            <a href="#"
                                                class="edit-job-btn"
                                                data-id="<?= $row['job_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['job_title']); ?>"
                                                title="Edit">
                                                <i class="fas fa-edit" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                            <a href="#"
                                                class="delete-job-btn"
                                                data-id="<?= $row['job_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['job_title']); ?>"
                                                title="Remove">
                                                <i class="fas fa-trash-alt" style="color: #991c1c; margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No jobs found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="recruitment.php?page=<?= $page - 1 ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="recruitment.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="recruitment.php?page=<?= $page + 1 ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT JOB PASSWORD MODAL -->
    <div id="editJobPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to edit <span id="jobNameForEdit"></span>.</p>
            <form id="editJobPasswordForm">
                <input type="hidden" name="job_id" id="edit_job_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="edit_job_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelEditJobPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmEditJobPassword" class="button-default">Continue to Edit</button>
                </div>
            </form>
            <div id="editJobPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- DELETE JOB PASSWORD MODAL -->
    <div id="delJobPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to delete <span id="jobNameForDelete"></span>.</p>
            <form id="deleteJobPasswordForm">
                <input type="hidden" name="job_id" id="delete_job_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="delete_job_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelDeleteJobPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmDeleteJobPassword" class="button-default">Confirm Delete</button>
                </div>
            </form>
            <div id="deleteJobPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- DELETE JOB PASSWORD MODAL -->
    <div id="delJobPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to delete <span id="jobNameForDelete"></span>.</p>
            <form id="deleteJobPasswordForm">
                <input type="hidden" name="job_id" id="delete_job_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="delete_job_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelDeleteJobPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmDeleteJobPassword" class="button-default">Confirm Delete</button>
                </div>
            </form>
            <div id="deleteJobPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- SUCCESSFULLY REMOVED MODAL -->
    <div id="successJobModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Job posting successfully removed!</h3>
            <div class="modal-buttons">
                <button id="closeJobSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>
</body>

</html>