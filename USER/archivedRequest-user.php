<?php
include '../DATABASE/db_fetchArchivedReqs.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archived Reqeusts</title>
    <link rel="icon" type="image/x-icon" href="../ICONS/site-icon.ico">
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/SIDEBAR/request-archived-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i> Archived Requests</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <div class="header-container">
                <button id="backToButton" class="button-default" onclick="location.href='request-user.php';">
                    <i class="fas fa-chevron-left">&nbsp</i>Back
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
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($archivedRequests)): ?>
                                <?php foreach ($archivedRequests as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['leave_type']) ?></td>
                                        <td><?= htmlspecialchars($row['start_date']) ?></td>
                                        <td><?= htmlspecialchars($row['end_date']) ?></td>
                                        <td><?= htmlspecialchars($row['status']) ?></td>
                                        <td>
                                            <form action="../DATABASE/db_restoreArchivedReqs.php" method="POST" onsubmit="return confirm('Are you sure you want to restore this request?');">
                                                <input type="hidden" name="leave_id" value="<?= $row['leave_id'] ?>">
                                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                                    <i class="fas fa-undo" style="color: green; font-size: 1.5rem;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 20px; color: #888;">
                                        No archived requests found.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="archivedRequest-user.php?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="archivedRequest-user.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="archivedRequest-user.php?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>