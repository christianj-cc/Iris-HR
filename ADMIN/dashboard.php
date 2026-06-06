<?php
require '../DATABASE/db_auth.php';
require '../INCLUDES/security-helper.php'; // Add this
$currentPage = basename($_SERVER['PHP_SELF']);

// Optional: Log page view
// logActivity($_SESSION['user_id'], 'view_dashboard', 'Admin viewed dashboard');
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
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Dashboard</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <div class="grid-container">
                <div class="col-1">
                    <div class="grid-item calendar">
                        <a href="#">
                            <h3>Calendar</h3>
                        </a>
                        <iframe src="https://calendar.google.com/calendar/embed?src=k.gellica.544337%40umindanao.edu.ph&ctz=Asia%2FManila"
                            style="border: 0" width="630" height="300" frameborder="0" scrolling="no"></iframe>
                    </div>
                </div>
                <div class="col-2">
                    <div class="grid-item request">
                        <a href="requests.php?from=dashboard">
                            <h3>Pending Approvals</h3>
                            <p>View and approve employee requests.</p>
                        </a>
                    </div>

                    <div class="grid-item task-manager">
                        <h3>Task Manager</h3>
                        <div class="todo-container">
                            <ul id="task-list">
                                <!-- Tasks will be added dynamically here -->
                            </ul>
                        </div>
                        <div class="todo-action-area">
                            <input type="text" id="new-task" placeholder="Add a new task...">
                            <button id="add-task"><i class="fas fa-plus"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="quick-actions">
                <p id="quickactions">Quick Actions</p>

                <a href="employees.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24">
                            <path fill="#5e4d8c" d="M8 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8m9 0a3 3 0 1 0 0-6a3 3 0 0 0 0 6M4.25 14A2.25 2.25 0 0 0 2 16.25v.25S2 21 8 21s6-4.5 6-4.5v-.25A2.25 2.25 0 0 0 11.75 14zM17 19.5c-1.171 0-2.068-.181-2.755-.458a5.5 5.5 0 0 0 .736-2.207A4 4 0 0 0 15 16.55v-.3a3.24 3.24 0 0 0-.902-2.248L14.2 14h5.6a2.2 2.2 0 0 1 2.2 2.2s0 3.3-5 3.3" />
                        </svg>
                    </div>
                    <div class="action-title">Employees</div>
                    <div class="action-link">ADD NEW EMPLOYEE</div>
                </a>

                <a href="attendance.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#5e4d8c" d="M11 16H3v3q0 .825.588 1.413T5 21h6zm2 0v5h6q.825 0 1.413-.587T21 19v-3zm-2-2V9H3v5zm2 0h8V9h-8zM3 7h18V5q0-.825-.587-1.412T19 3H5q-.825 0-1.412.588T3 5z" />
                        </svg>
                    </div>
                    <div class="action-title">Attendance</div>
                    <div class="action-link">VIEW ATTENDANCE</div>
                </a>

                <a href="recruitment.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 20 20">
                            <path fill="#5e4d8c" d="M9 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-4.991 9A2 2 0 0 0 2 13c0 1.691.833 2.966 2.135 3.797C5.417 17.614 7.145 18 9 18q.617 0 1.21-.057A5.48 5.48 0 0 1 9 14.5c0-1.33.472-2.55 1.257-3.5zM14.5 19a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9m0-7a.5.5 0 0 1 .5.5V14h1.5a.5.5 0 0 1 0 1H15v1.5a.5.5 0 0 1-1 0V15h-1.5a.5.5 0 0 1 0-1H14v-1.5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </div>
                    <div class="action-title">Recruitment</div>
                    <div class="action-link">POST NEW JOB</div>
                </a>

                <a href="payroll.php" class="action-box">
                    <div class="action-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24">
                            <path fill="#5e4d8c" fill-rule="evenodd" d="M4 6.8V8H2.8A1.8 1.8 0 0 0 1 9.8v8.4A1.8 1.8 0 0 0 2.8 20h16.4a1.8 1.8 0 0 0 1.8-1.8V17h1.2c.992 0 1.8-.808 1.8-1.8V6.8c0-.992-.808-1.8-1.8-1.8H5.8C4.808 5 4 5.808 4 6.8M6 7v1h13.2A1.8 1.8 0 0 1 21 9.8V15h1V7zm3 7a2 2 0 1 1 4 0a2 2 0 0 1-4 0" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="action-title">Payroll</div>
                    <div class="action-link">PROCESS PAYROLL</div>
                </a>
            </div>
        </div>
    </div>
</body>

</html>