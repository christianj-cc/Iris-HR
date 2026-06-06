<?php
include '../DATABASE/db_fetchJobs.php';
$currentPage = basename($_SERVER['PHP_SELF']);

$rows = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment</title>
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Recruitment</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <!--<div class="header-container">
                <button id="archivedRequestButton" class="button-default" onclick="location.href='archivedRequest-user.php';">
                    <i class="fas fa-briefcase">&nbsp&nbsp</i>Positions Applied
                </button>
            </div>-->

            <div class="panel recruitment">
                <div class="table-container">
                    <table class="user-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>JOB TITLE</th>
                                <th>DEPARTMENT</th>
                                <th>APPLICANTS</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($rows)): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['job_id']) ?></td>
                                        <td><?= htmlspecialchars($row['job_title']) ?></td>
                                        <td><?= htmlspecialchars($row['department']) ?></td>
                                        <td><?= htmlspecialchars($row['total_applicants']) ?></td>
                                        <td><?= htmlspecialchars($row['status']) ?></td>
                                        <td>
                                            <?php if ($row['status'] == 'Open'): ?>
                                                <a href="applyRecruitment.php?job_id=<?= $row['job_id'] ?>" title="Apply"><i class="fas fa-paper-plane" style="color:rgb(32, 101, 11); font-size: 1.3rem;"></i></a>
                                            <?php else: ?>
                                                <span style="color:gray;">Closed</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">No jobs available.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <!-- Pagination Controls -->
                    <div class="pagination">
                        <p>Showing <?= $offset + 1 ?> to <?= min($offset + $records_per_page, $total_records) ?> of <?= $total_records ?> Records</p>

                        <?php if ($page > 1): ?>
                            <a href="recruitment-user.php?page=<?= $page - 1 ?>">Previous</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                            <a href="recruitment-user.php?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                            <a href="recruitment-user.php?page=<?= $page + 1 ?>">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>