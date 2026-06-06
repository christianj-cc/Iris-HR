<?php
include '../DATABASE/db_fetchArchivedEmp.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/employees-archived-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Archived Employees</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <hr class="quick-actions-line">
            <div class="quick-actions-tabs">
                <a href="employees.php" class="tab <?= $currentPage == 'employees.php' ? 'active' : '' ?>"><i class="fas fa-users">&nbsp&nbsp</i>Current Employees</a>
                <a href="employees-archived.php" class="tab <?= $currentPage == 'employees-archived.php' ? 'active' : '' ?>"><i class="fas fa-archive">&nbsp&nbsp</i>Archived Employees</a>
            </div>

            <div class="header-container">
                <div class="search-container">
                    <form method="GET" action="employees-archived.php">
                        <input type="text" name="search" placeholder="Search by Name or Position" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel employees">
                <div class="table-container">
                    <table class="employee-table">
                        <thead>
                            <tr>
                                <th>PROFILE</th>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>POSITION</th>
                                <th>EMAIL</th>
                                <th>PHONE</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($fetchArchivedEmployees_result->num_rows > 0): ?>
                                <?php while ($row = $fetchArchivedEmployees_result->fetch_assoc()): ?>
                                    <tr>
                                        <td>
                                            <?php // for default pic if no image is selected
                                            $profilePic = (is_null($row['profile_picture']) || empty(trim($row['profile_picture'])))
                                                ? "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg"
                                                : "../ASSETS/UPLOADS/ProfilePictures/" . htmlspecialchars($row['profile_picture']);
                                            ?>
                                            <img src="<?= $profilePic ?>" alt="Profile" class="profile-pic">
                                        </td>
                                        <td><?= htmlspecialchars($row['employee_id']) ?></td>
                                        <td><?= htmlspecialchars($row['first_name'] . " " . $row['last_name']) ?></td>
                                        <td><?= htmlspecialchars($row['position_name']) ?></td>
                                        <td><?= htmlspecialchars($row['email']) ?></td>
                                        <td><?= htmlspecialchars($row['contact_number']) ?></td>
                                        <td>
                                            <a href="employees-archived-view.php?id=<?= $row['archive_id'] ?>" title="View"><i class="fas fa-eye" style="color:rgb(48, 87, 155); margin: 0 5px 0 0; font-size: 1.3rem;"></i></a>
                                            <a href="#"
                                                class="restore-employee-btn"
                                                data-archive-id="<?= $row['archive_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>"
                                                title="Restore">
                                                <i class="fas fa-undo" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No archived employees found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="employees-archived.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="employees-archived.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="employees-archived.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- RESTORE PASSWORD MODAL -->
    <div id="restorePasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to restore <span id="empNameForRestore"></span>.</p>
            <form id="restorePasswordForm">
                <input type="hidden" name="archive_id" id="restore_archive_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="restore_admin_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelRestorePassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmRestorePassword" class="button-default">Confirm Restore</button>
                </div>
            </form>
            <div id="restorePasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- RESTORE SUCCESS MODAL -->
    <div id="restoreSuccessModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Employee successfully restored!</h3>
            <div class="modal-buttons">
                <button id="closeRestoreSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>
</body>

</html>