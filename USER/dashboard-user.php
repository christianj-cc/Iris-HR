<?php
include '../DATABASE/db_fetchUser.php';
include '../DATABASE/db_fetchSalary.php';

$currentPage = basename($_SERVER['PHP_SELF']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="../ICONS/site-icon.ico">
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Dashboard</h2>
            </div>
            <?php include '../INCLUDES/USER/user-dropdown.php'; ?>

            <div class="grid-container">
                <div class="col-1">
                    <div class="grid-item welcome">
                        <p><strong>Welcome, <?= htmlspecialchars($first_name . ' ' . $last_name) ?>!</strong></p>
                    </div>
                    <div class="grid-item quote">
                        <h3>Quote of the Day</h3>
                        <p id="quoteText"></p>
                        <p id="quoteAuthor"></p>
                    </div>
                </div>

                <div class="col-2">
                    <div class="grid-item clockin" id="clockWidget">
                        <a id="clockLink" href="#">
                            <h3 id="clockText">Clock In</h3>
                        </a>
                        <p>FOR <span id="currentDate"></span></p>
                    </div>

                    <div class="grid-item salary">
                        <h2>Your Salary</h2>
                        <p class="amount">₱<?php echo number_format($net_salary, 2); ?></p>
                        <hr>
                        <p class="info">LATEST PAYROLL RECORD</p>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <p id="quickactions">Quick Actions</p>

                <a href="request-user.php" class="action-box">
                    <div class="action-icon">
                        <i class="fas fa-clock" style="color: #5e4d8c;"></i>
                    </div>
                    <div class="action-title">Request</div>
                    <div class="action-link">SUBMIT NEW REQUEST</div>
                </a>

                <a href="recruitment-user.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20">
                            <path fill="#5e4d8c" d="M9 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-4.991 9A2 2 0 0 0 2 13c0 1.691.833 2.966 2.135 3.797C5.417 17.614 7.145 18 9 18q.617 0 1.21-.057A5.48 5.48 0 0 1 9 14.5c0-1.33.472-2.55 1.257-3.5zM14.5 19a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9m0-7a.5.5 0 0 1 .5.5V14h1.5a.5.5 0 0 1 0 1H15v1.5a.5.5 0 0 1-1 0V15h-1.5a.5.5 0 0 1 0-1H14v-1.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </div>
                    <div class="action-title">Recruitment</div>
                    <div class="action-link">VIEW JOB POSTINGS</div>
                </a>

                <a href="attendance-user.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#5e4d8c" d="M11 16H3v3q0 .825.588 1.413T5 21h6zm2 0v5h6q.825 0 1.413-.587T21 19v-3zm-2-2V9H3v5zm2 0h8V9h-8zM3 7h18V5q0-.825-.587-1.412T19 3H5q-.825 0-1.412.588T3 5z" />
                        </svg>
                    </div>
                    <div class="action-title">Attendance</div>
                    <div class="action-link">VIEW ATTENDANCE</div>
                </a>

                <a href="payroll-user.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#5e4d8c" fill-rule="evenodd" d="M4 6.8V8H2.8A1.8 1.8 0 0 0 1 9.8v8.4A1.8 1.8 0 0 0 2.8 20h16.4a1.8 1.8 0 0 0 1.8-1.8V17h1.2c.992 0 1.8-.808 1.8-1.8V6.8c0-.992-.808-1.8-1.8-1.8H5.8C4.808 5 4 5.808 4 6.8M6 7v1h13.2A1.8 1.8 0 0 1 21 9.8V15h1V7zm3 7a2 2 0 1 1 4 0a2 2 0 0 1-4 0" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="action-title">Payroll</div>
                    <div class="action-link">VIEW PAYMENTS</div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>