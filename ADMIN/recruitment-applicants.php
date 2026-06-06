<?php
include '../DATABASE/db_fetchAllApplicants.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/recruitment-applicants-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Applicants</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <hr class="quick-actions-line">
            <div class="quick-actions-tabs">
                <a href="recruitment.php" class="tab <?= $currentPage == 'recruitment.php' ? 'active' : '' ?>"><i class="fa-solid fa-newspaper">&nbsp&nbsp</i>Job Postings</a>
                <a href="recruitment-applicants.php" class="tab <?= $currentPage == 'recruitment-applicants.php' ? 'active' : '' ?>"><i class="fas fa-envelope-open">&nbsp&nbsp</i>Applicants</a>
                <a href="departments.php" class="tab <?= $currentPage == 'departments.php' ? 'active' : '' ?>"><i class="fas fa-building">&nbsp&nbsp</i>Departments</a>
                <a href="positions.php" class="tab <?= $currentPage == 'positions.php' ? 'active' : '' ?>"><i class="fas fa-briefcase">&nbsp&nbsp</i>Positions</a>
            </div>

            <div class="header-container">
                <div class="search-container">
                    <form method="GET" action="recruitment-applicants.php">
                        <input type="text" name="search" placeholder="Search by Name or Email" value="<?= htmlspecialchars($search) ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel all-applicants">
                <div class="table-container">
                    <table class="all-applicants-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>FIRST NAME</th>
                                <th>LAST NAME</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>POSITION</th>
                                <th>RESUME</th>
                                <th>COVER LETTER</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row['applicant_id'] ?></td>
                                        <td><?= $row['first_name'] ?></td>
                                        <td><?= $row['last_name'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['phone'] ?></td>
                                        <td><?= $row['position_name'] ?></td>
                                        <td><a href="<?= $row['resume'] ?>" target="_blank" class="view">View</a></td>
                                        <td><a href="<?= $row['cover_letter'] ?>" target="_blank" class="view">View</a></td>
                                        <td><?= $row['status'] ?></td>
                                        <td>
                                            <?php if ($row['status'] === 'Pending'): ?>
                                                <a href="#" class="accept-applicant-btn" data-id="<?= $row['applicant_id'] ?>" data-name="<?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>" title="Accept">
                                                    <div class="icon-container accept"><i class="fas fa-check"></i></div>
                                                </a>
                                                <a href="#" class="reject-applicant-btn" data-id="<?= $row['applicant_id'] ?>" data-name="<?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>" title="Reject">
                                                    <div class="icon-container reject"><i class="fas fa-times"></i></div>
                                                </a>
                                            <?php else: ?>
                                                <div class="icon-container disabled"><i class="fas fa-check"></i></div>
                                                <div class="icon-container disabled"><i class="fas fa-times"></i></div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="10">No applicants found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="recruitment-applicants.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="recruitment-applicants.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="recruitment-applicants.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="scripts.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const confirmModal = document.getElementById('confirmActionModal');
            const confirmTitle = document.getElementById('confirmActionTitle');
            const confirmMessage = document.getElementById('confirmActionMessage');
            const confirmLink = document.getElementById('confirmAction');
            const cancelBtn = document.getElementById('cancelAction');

            // Accept buttons
            document.querySelectorAll('.accept-applicant-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const applicantId = this.getAttribute('data-id');
                    const applicantName = this.getAttribute('data-name');
                    confirmTitle.textContent = 'Accept Applicant?';
                    confirmMessage.textContent = `Are you sure you want to accept ${applicantName}?`;
                    confirmLink.href = `../DATABASE/db_acceptApplicant.php?applicant_id=${applicantId}`;
                    confirmModal.style.display = 'block';
                });
            });

            // Reject buttons
            document.querySelectorAll('.reject-applicant-btn').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const applicantId = this.getAttribute('data-id');
                    const applicantName = this.getAttribute('data-name');
                    confirmTitle.textContent = 'Reject Applicant?';
                    confirmMessage.textContent = `Are you sure you want to reject ${applicantName}?`;
                    confirmLink.href = `../DATABASE/db_rejectApplicant.php?applicant_id=${applicantId}`;
                    confirmModal.style.display = 'block';
                });
            });

            // Cancel button
            cancelBtn.addEventListener('click', function() {
                confirmModal.style.display = 'none';
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target.classList.contains('content-modal')) {
                    e.target.style.display = 'none';
                }
            });
        });
    </script>

    <!-- DELETE DEPARTMENT MODAL -->
    <div id="delJobModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-exclamation-triangle" style="color: rgb(179, 0, 0); font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Are you sure you want to remove the <span id="jobPostToDelete"></span> job posting?</h3><br>
            <div class="modal-buttons">
                <button id="cancelJobDelete" class="button-default">No</button>
                <a id="confirmJobDelete" href="#" class="button-default">Yes</a>
            </div>
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

    <!-- CONFIRM ACTION MODAL (Accept/Reject) -->
    <div id="confirmActionModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-exclamation-triangle" style="color: rgb(179, 0, 0); font-size: 3rem;"></i>
            </div>
            <br>
            <h3 id="confirmActionTitle">Are you sure?</h3>
            <p id="confirmActionMessage"></p>
            <div class="modal-buttons">
                <button id="cancelAction" class="button-default">No</button>
                <a id="confirmAction" href="#" class="button-default">Yes</a>
            </div>
        </div>
    </div>
</body>

</html>