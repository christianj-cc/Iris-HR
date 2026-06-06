<?php
include '../DATABASE/db_fetchEmployees.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/admin-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Current Employees</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <hr class="quick-actions-line">
            <div class="quick-actions-tabs">
                <a href="employees.php" class="tab <?= $currentPage == 'employees.php' ? 'active' : '' ?>"><i class="fas fa-users">&nbsp&nbsp</i>Current Employees</a>
                <a href="employees-archived.php" class="tab <?= $currentPage == 'employees-archived.php' ? 'active' : '' ?>"><i class="fas fa-archive">&nbsp&nbsp</i>Archived Employees</a>
            </div>

            <div class="header-container">
                <button type="button" id="addEmployeeBtn" class="button-default" onclick="openAddEmployeeModal()">
                    <i class="fas fa-plus">&nbsp&nbsp</i>New Employee
                </button>

                <div class="search-container">
                    <form method="GET" action="employees.php">
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
                            <?php if ($fetchEmployees_result->num_rows > 0): ?>
                                <?php while ($row = $fetchEmployees_result->fetch_assoc()): ?>
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
                                            <a href="employees-view.php?id=<?= $row['employee_id'] ?>" title="View"><i class="fas fa-eye" style="color:rgb(48, 87, 155); margin: 0 5px 0 0; font-size: 1.3rem;"></i></a>
                                            <a href="#"
                                                class="edit-employee-btn"
                                                data-id="<?= $row['employee_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>"
                                                title="Edit">
                                                <i class="fas fa-edit" style="color:rgb(32, 101, 11); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                            <a href="#"
                                                class="delete-employee-btn"
                                                data-id="<?= $row['employee_id'] ?>"
                                                data-name="<?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?>"
                                                title="Delete"><i class="fas fa-trash-alt" style="color: #991c1c; margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No employees found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <p>Showing <?= min(($page - 1) * $limit + 1, $totalRecords) ?> - <?= min($page * $limit, $totalRecords) ?> of <?= $totalRecords ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($search) ?>" class="prev">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=<?= $i ?>&search=<?= htmlspecialchars($search) ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($search) ?>" class="next">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>

    <!-- ADD EMPLOYEE PASSWORD MODAL -->
    <div id="addEmployeePasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to add a new employee.</p>
            <form id="addEmployeePasswordForm">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="add_employee_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelAddEmployee" class="button-default">Cancel</button>
                    <button type="submit" id="confirmAddEmployee" class="button-default">Continue</button>
                </div>
            </form>
            <div id="addEmployeeError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- PASSWORD MODAL FOR EDIT -->
    <div id="editPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to edit <span id="empNameForEdit"></span>.</p>
            <form id="editPasswordForm">
                <input type="hidden" name="employee_id" id="edit_employee_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="edit_admin_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelEditPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmEditPassword" class="button-default">Continue to Edit</button>
                </div>
            </form>
            <div id="editPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- DELETE MODAL WITH PASSWORD CONFIRMATION -->
    <div id="delEmpModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-exclamation-triangle" style="color: rgb(179, 0, 0); font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Remove <span id="empNameToDelete"></span>?</h3>
            <p style="margin: 10px 0; color: #666;">Please enter your admin password to confirm.</p>
            <form id="deleteForm">
                <input type="hidden" name="employee_id" id="delete_employee_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="admin_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelDelete" class="button-default">Cancel</button>
                    <button type="submit" id="confirmDelete" class="button-default">Confirm Archive</button>
                </div>
            </form>
            <div id="passwordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- SUCCESSFULLY REMOVED MODAL -->
    <div id="successModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Employee successfully removed!</h3>
            <div class="modal-buttons">
                <button id="closeSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>
</body>

</html>