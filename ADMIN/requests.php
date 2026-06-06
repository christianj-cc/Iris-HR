<?php
include '../DATABASE/db_fetchCurrentRequests.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time-off Requests</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/request-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Requests</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <hr class="quick-actions-line">
            <div class="quick-actions-tabs">
                <a href="attendance.php" class="tab <?= $currentPage == 'attendance.php' ? 'active' : '' ?>"><i class="fas fa-users">&nbsp&nbsp</i>Attendance</a>
                <a href="requests.php" class="tab <?= $currentPage == 'requests.php' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-xmark">&nbsp&nbsp</i>Time-off Requests</a>
            </div>

            <div class="panel requests">
                <form method="GET">
                    <div class="sorting-group">
                        <div class="selection-group">
                            <label for="status">Filter by Status:</label>
                            <select name="status" id="status">
                                <option value="">All</option>
                                <option value="pending" <?= isset($_GET['status']) && $_GET['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="approved" <?= isset($_GET['status']) && $_GET['status'] == 'approved' ? 'selected' : '' ?>>Approved</option>
                                <option value="rejected" <?= isset($_GET['status']) && $_GET['status'] == 'rejected' ? 'selected' : '' ?>>Rejected</option>
                            </select>
                        </div>
                        <div class="selection-group">
                            <label for="sort">Sort by:</label>
                            <select name="sort" id="sort">
                                <option value="newest" <?= isset($_GET['sort']) && $_GET['sort'] == 'newest' ? 'selected' : '' ?>>Newest</option>
                                <option value="oldest" <?= isset($_GET['sort']) && $_GET['sort'] == 'oldest' ? 'selected' : '' ?>>Oldest</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-filter"><i class="fas fa-filter"></i></button>
                    </div>
                </form>
                <div class="table-container">
                    <table class="requests-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>CREATED BY</th>
                                <th>REQUEST TYPE</th>
                                <th>FROM</th>
                                <th>TO</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tr>
                                    <td><?= $row['leave_id'] ?></td>
                                    <td><?= $row['employee_name'] ?></td>
                                    <td><?= ucfirst($row['leave_type']) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['start_date'])) ?></td>
                                    <td><?= date('M d, Y', strtotime($row['end_date'])) ?></td>
                                    <td>
                                        <?php
                                        $status = strtolower($row['status']);
                                        $statusClass = "status-" . $status;
                                        // Add corresponding emojis
                                        $emoji = "";
                                        if ($status === "approved") {
                                            $emoji = ""; // Green check ✅
                                        } elseif ($status === "rejected") {
                                            $emoji = ""; // Red cross ❌
                                        } elseif ($status === "pending") {
                                            $emoji = ""; // Hourglass ⏳
                                        }
                                        ?>

                                        <span class="status <?= $statusClass ?>"><?= $emoji . " " . ucfirst($status) ?></span>
                                    </td>
                                    <td>
                                        <?php if ($row['status'] === 'Approved' || $row['status'] === 'Rejected') : ?>
                                            <a href="#" class="edit-request-btn" data-id="<?= $row['leave_id'] ?>" data-name="<?= htmlspecialchars($row['employee_name'] . ' - ' . ucfirst($row['leave_type'])) ?>" title="Edit">
                                                <i class="fas fa-edit" style="color: #28a745; margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        <?php else: ?>
                                            <i class="fas fa-edit" style="color:gray; margin: 0 5px 0 0; font-size: 1.3rem; cursor: not-allowed;"></i>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="requests.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="requests.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="requests.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT REQUEST PASSWORD MODAL -->
    <div id="editRequestPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to edit request <span id="requestNameForEdit"></span>.</p>
            <form id="editRequestPasswordForm">
                <input type="hidden" name="leave_id" id="edit_leave_id" value="">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="edit_request_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelEditRequestPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmEditRequestPassword" class="button-default">Continue to Edit</button>
                </div>
            </form>
            <div id="editRequestPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>
</body>

</html>