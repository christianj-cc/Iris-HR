<?php
include '../DATABASE/db_fetchUserAttendance.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Attendance</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <div class="panel user-attendance">
                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>CLOCK IN</th>
                                <th>CLOCK OUT</th>
                                <th>DATE</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($attendanceData)): ?>
                                <?php foreach ($attendanceData as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['clock_in']) ?></td>
                                        <td><?= htmlspecialchars($row['clock_out']) ?></td>
                                        <td><?= htmlspecialchars($row['date']) ?></td>
                                        <td><?= htmlspecialchars($row['status']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No attendance records available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> - <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>
                        <?php if ($page > 1): ?>
                            <a href="attendance-user.php?page=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="attendance-user.php?page=<?= $i ?>&search=<?= $search ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="attendance-user.php?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>