<?php
include '../DATABASE/db_fetchDepartments.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departments</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/departments-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Departments</h2>
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
                <button id="addEmployeeButton" class="button-default" onclick="location.href='department-add.php';">
                    <i class="fas fa-plus">&nbsp&nbsp</i>New Department
                </button>
                <div class="search-container">
                    <form method="GET" action="departments.php">
                        <input type="text" name="search" placeholder="Search by Department Name" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel departments">
                <div class="table-container">
                    <table class="department-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DEPARTMENT</th>
                                <th>DESCRIPTION</th>
                                <th>TOTAL EMPLOYEES</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['department_id']) ?></td>
                                        <td><?= htmlspecialchars($row['department_name']) ?></td>
                                        <td>
                                            <?php
                                            $description = htmlspecialchars($row['description']);
                                            $maxLength = 50;

                                            if (strlen($description) > $maxLength) {
                                                echo substr($description, 0, $maxLength) . '...';
                                            } else {
                                                echo $description;
                                            }
                                            ?>
                                        </td>
                                        <td><?= htmlspecialchars($row['employee_count']) ?></td>
                                        <td>
                                            <a href="departments-view.php?id=<?= $row['department_id'] ?>" title="View"><i class="fas fa-eye" style="color:rgb(48, 87, 155); margin: 0 5px 0 0; font-size: 1.3rem;"></i></a>
                                            <a href="#"
                                                class="edit-department-btn"
                                                data-id="<?= $row['department_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['department_name']) ?>"
                                                title="Edit">
                                                <i class="fas fa-edit" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                            <a href="#"
                                                class="delete-department-btn"
                                                data-id="<?= $row['department_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['department_name']); ?>"
                                                title="Remove">
                                                <i class="fas fa-trash-alt" style="color: #991c1c; margin: 0 5px 0 0; font-size: 1.3rem;"></i></a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No departments found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="departments.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="departments.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="departments.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT DEPARTMENT PASSWORD MODAL -->
    <div id="editDeptPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to edit <span id="deptNameForEdit"></span>.</p>
            <form id="editDeptPasswordForm">
                <input type="hidden" name="department_id" id="edit_dept_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="edit_dept_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelEditDeptPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmEditDeptPassword" class="button-default">Continue to Edit</button>
                </div>
            </form>
            <div id="editDeptPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- DELETE DEPARTMENT PASSWORD MODAL -->
    <div id="delDeptPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to delete <span id="deptNameForDelete"></span>.</p>
            <form id="deleteDeptPasswordForm">
                <input type="hidden" name="department_id" id="delete_dept_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="delete_dept_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelDeleteDeptPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmDeleteDeptPassword" class="button-default">Confirm Delete</button>
                </div>
            </form>
            <div id="deleteDeptPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- SUCCESSFULLY REMOVED MODAL (keep as is) -->
    <div id="successDeptModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Department successfully removed!</h3>
            <div class="modal-buttons">
                <button id="closeDeptSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>
</body>

</html>