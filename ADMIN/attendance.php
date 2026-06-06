<?php
include '../DATABASE/db_fetchAllAttendance.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/admin-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Attendance</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <hr class="quick-actions-line">
            <div class="quick-actions-tabs">
                <a href="attendance.php" class="tab <?= $currentPage == 'attendance.php' ? 'active' : '' ?>"><i class="fas fa-users">&nbsp&nbsp</i>Attendance</a>
                <a href="requests.php" class="tab <?= $currentPage == 'requests.php' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-xmark">&nbsp&nbsp</i>Time-off Requests</a>
            </div>

            <div class="header-container">
                <div class="search-container1">
                    <form method="GET" action="attendance.php">
                        <input type="text" name="search" placeholder="Search Employees" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button type="submit" class="btn-search"><i class="fas fa-search"></i></button>
                    </form>
                </div>
            </div>

            <div class="panel attendance">
                <div class="table-container">
                    <table class="attendance-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>TOTAL DAYS WORKED</th>
                                <th>ABSENCES</th>
                                <th>LATES</th>
                                <th>OVERTIME HOURS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['employee_id']) ?></td>
                                        <td><?= htmlspecialchars($row['employee_name']) ?></td>
                                        <td><?= htmlspecialchars($row['total_days_worked']) ?></td>
                                        <td><?= htmlspecialchars($row['absences']) ?></td>
                                        <td><?= htmlspecialchars($row['late_arrivals']) ?></td>
                                        <td><?= htmlspecialchars($row['overtime_hours']) ?></td>
                                        <td>
                                            <a href="attendance-details.php?employee_id=<?= $row['employee_id'] ?>" title="View">
                                                <i class="fas fa-eye" style="color:rgb(48, 87, 155); margin: 0 5px 0 0; font-size: 1.3rem;"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7">No records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> - <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>
                        <?php if ($page > 1): ?>
                            <a href="attendance.php?page=<?= $page - 1 ?>&search=<?= $search ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="attendance.php?page=<?= $i ?>&search=<?= $search ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="attendance.php?page=<?= $page + 1 ?>&search=<?= $search ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>