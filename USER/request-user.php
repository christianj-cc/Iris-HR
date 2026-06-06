<?php
include '../DATABASE/db_fetchUserRequests.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
    <link rel="icon" type="image/x-icon" href="../ICONS/site-icon.ico">
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Request</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <div class="header-container">
                <button id="addRequestButton" class="button-default" onclick="location.href='addRequest-user.php';">
                    <i class="fas fa-plus">&nbsp&nbsp</i>Submit New Request
                </button>
                <button id="archivedRequestButton" class="button-default" onclick="location.href='archivedRequest-user.php';">
                    <i class="fas fa-archive">&nbsp&nbsp</i>Archived Requests
                </button>
            </div>

            <div class="panel user-request">
                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>LEAVE TYPE</th>
                                <th>FROM</th>
                                <th>TO</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($leave_requests)) { ?>
                                <?php foreach ($leave_requests as $row) { ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['leave_type']); ?></td>
                                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                                        <td><?php echo htmlspecialchars($row['status']); ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Pending') { ?>
                                                <form action="../DATABASE/db_cancelRequest.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="leave_id" value="<?php echo $row['leave_id']; ?>">
                                                    <button type="submit" onclick="return confirm('Are you sure you want to cancel this request?');">
                                                        <i class="fas fa-times-circle" style="color: orange; font-size: 1.3rem; margin: 0 5px 0 0;"></i>
                                                    </button>
                                                </form>
                                                <a href="editRequest-user.php?leave_id=<?php echo urlencode($row['leave_id']); ?>">
                                                    <i class="fas fa-edit" style="color:rgb(32, 101, 11); font-size: 1.3rem; margin: 0 5px 0 0;"></i>
                                                </a>
                                            <?php } else { ?>
                                                <span>N/A</span>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } else { ?>
                                <tr>
                                    <td colspan="5">No leave requests found.</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="request-user.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="request-user.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="request-user.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>