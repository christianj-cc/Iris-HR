<?php
include '../DATABASE/db_fetchPositions.php';
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
        <?php include '../INCLUDES/ADMIN/SIDEBAR/positions-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Positions</h2>
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
                <button id="addEmployeeButton" class="button-default" onclick="location.href='positions-add.php';">
                    <i class="fas fa-plus">&nbsp&nbsp</i>New Position
                </button>
                <div class="search-container">
                    <form method="GET" action="positions.php">
                        <input type="text" name="search" placeholder="Search by Position Name"
                            value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel employees">
                <div class="table-container">
                    <table class="position-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>POSITION</th>
                                <th>DEPARTMENT</th>
                                <th>EMPLOYEES</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($fetchPositions_result->num_rows > 0): ?>
                                <?php while ($row = $fetchPositions_result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['position_id']) ?></td>
                                        <td><?= htmlspecialchars($row['position_name']) ?></td>
                                        <td><?= htmlspecialchars($row['department_name']) ?></td>
                                        <td><?= htmlspecialchars($row['employee_count']) ?></td>
                                        <td>
                                            <a href="#"
                                                class="edit-position-btn"
                                                data-id="<?= $row['position_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['position_name']) ?>"
                                                title="Edit">
                                                <i class="fas fa-edit" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                            <a href="#"
                                                class="delete-position-btn"
                                                data-id="<?= $row['position_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['position_name']) ?>"
                                                title="Remove">
                                                <i class="fas fa-trash-alt" style="color: #991c1c; margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5">No positions found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="positions.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="positions.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="positions.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT POSITION PASSWORD MODAL -->
    <div id="editPosPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to edit <span id="posNameForEdit"></span>.</p>
            <form id="editPosPasswordForm">
                <input type="hidden" name="position_id" id="edit_pos_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="edit_pos_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelEditPosPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmEditPosPassword" class="button-default">Continue to Edit</button>
                </div>
            </form>
            <div id="editPosPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- DELETE POSITION PASSWORD MODAL -->
    <div id="delPosPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to delete <span id="posNameForDelete"></span>.</p>
            <form id="deletePosPasswordForm">
                <input type="hidden" name="position_id" id="delete_pos_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="delete_pos_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelDeletePosPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmDeletePosPassword" class="button-default">Confirm Delete</button>
                </div>
            </form>
            <div id="deletePosPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- SUCCESSFULLY REMOVED MODAL -->
    <div id="successPosModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Position successfully removed!</h3>
            <div class="modal-buttons">
                <button id="closePosSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>
</body>

</html>