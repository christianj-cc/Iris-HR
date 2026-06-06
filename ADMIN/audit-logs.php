<?php
require '../DATABASE/db_auth.php';
include '../DATABASE/db_fetchAuditLogs.php';
require_once '../INCLUDES/security-helper.php';
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
            <div class="header-container">

                <div class="search-container">
                    <form method="GET" action="audit-logs.php">
                        <input type="text" name="search" placeholder="Search Action or Date" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel employees">
                <form method="GET" action="audit-logs.php">
                    <div class="sorting-group">
                        <!-- Filter by Action -->
                        <div class="selection-group">
                            <label for="action">Filter by Action:</label>
                            <select name="action" id="action">
                                <option value="">All Actions</option>
                                <?php
                                // Reset the result pointer to loop again
                                $actions_result->data_seek(0);
                                while ($action_row = $actions_result->fetch_assoc()):
                                    $selected = ($action_filter == $action_row['action']) ? 'selected' : '';
                                ?>
                                    <option value="<?= htmlspecialchars($action_row['action']) ?>" <?= $selected ?>>
                                        <?= htmlspecialchars($action_row['action']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <!-- Filter by Date (Timestamp) -->
                        <div class="selection-group">
                            <label for="date">Filter by Date:</label>
                            <input type="date" name="date" id="date" value="<?= htmlspecialchars($date_filter) ?>">
                        </div>

                        <button type="submit" class="btn-filter"><i class="fas fa-filter"></i></button>
                    </div>
                </form>
                <div class="table-container">
                    <table class="employee-table">
                        <thead>
                            <tr>
                                <th>TIMESTAMP</th>
                                <th>USER ID</th>
                                <th>ACTION</th>
                                <th>DETAILS</th>
                                <th>IP ADDRESS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($logs->num_rows > 0): ?>
                                <?php while ($log = $logs->fetch_assoc()): ?>
                                    <tr>
                                        <td class="timestamp">
                                            <?= date('M d, Y H:i:s', strtotime($log['timestamp'])) ?>
                                        </td>
                                        <td class="user-cell">
                                            <?php if ($log['user_id'] > 0): ?>
                                                <div class="user-name">
                                                    <?= htmlspecialchars($log['user_id']) ?>
                                                </div>
                                                <div class="user-email">
                                                    <!-- Can't get email without join, so leave empty or show ID -->
                                                </div>
                                            <?php else: ?>
                                                <div class="user-name">System</div>
                                                <div class="user-email">-</div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge <?= getActionBadge($log['action']) ?>">
                                                <?= htmlspecialchars($log['action']) ?>
                                            </span>
                                        </td>
                                        <td class="details-cell">
                                            <div class="details-box">
                                                <?= nl2br(htmlspecialchars($log['details'])) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="ip-address">
                                                <?= htmlspecialchars($log['ip_address'] ?: '::1') ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="no-records">No audit logs found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> - <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>
                        <?php if ($page > 1): ?>
                            <a href="audit-logs.php?page=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="audit-logs.php?page=<?= $i ?>&search=<?= $search ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="audit-logs.php?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- DELETE MODAL -->
    <div id="delEmpModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-exclamation-triangle" style="color: rgb(179, 0, 0); font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Are you sure you want to remove <span id="empNameToDelete"></span>?</h3><br>
            <div class="modal-buttons">
                <button id="cancelDelete" class="button-default">No</button>
                <a id="confirmDelete" href="#" class="button-default">Yes</a>
            </div>
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