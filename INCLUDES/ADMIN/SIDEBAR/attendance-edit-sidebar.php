<div class="sidebar" style="display: flex;">
    <div class="logo">
        <a href="dashboard.php" class="logo-f"><img src="../ASSETS/ICONS/logo-full.png" alt="HRM System Logo" class="logo-icon"></a>
        <a href="dashboard.php" class="logo-s" style="display: none;"><img src="../ASSETS/ICONS/logo-small.png" alt="HRM System Logo" class="logo-icon"></a>
    </div>

    <ul class="nav-links">
        <li><a href="dashboard.php" class="<?= $currentPage == 'dashboard.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                    <path fill="#5e4d8c" d="M14 9q-.425 0-.712-.288T13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9zM4 13q-.425 0-.712-.288T3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13zm10 8q-.425 0-.712-.288T13 20v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21zM4 21q-.425 0-.712-.288T3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21z" />
                </svg><span>Dashboard</span></a>
        </li>
        <li><a href="employees.php" class="<?= $currentPage == 'employees.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" class="icon">
                    <path fill="#5e4d8c" d="M8 12a4 4 0 1 0 0-8a4 4 0 0 0 0 8m9 0a3 3 0 1 0 0-6a3 3 0 0 0 0 6M4.25 14A2.25 2.25 0 0 0 2 16.25v.25S2 21 8 21s6-4.5 6-4.5v-.25A2.25 2.25 0 0 0 11.75 14zM17 19.5c-1.171 0-2.068-.181-2.755-.458a5.5 5.5 0 0 0 .736-2.207A4 4 0 0 0 15 16.55v-.3a3.24 3.24 0 0 0-.902-2.248L14.2 14h5.6a2.2 2.2 0 0 1 2.2 2.2s0 3.3-5 3.3" />
                </svg><span>Employees</span></a>
        </li>
        <li><a href="recruitment.php" class="<?= $currentPage == 'recruitment.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" class="icon">
                    <path fill="#5e4d8c" d="M9 2a4 4 0 1 0 0 8a4 4 0 0 0 0-8m-4.991 9A2 2 0 0 0 2 13c0 1.691.833 2.966 2.135 3.797C5.417 17.614 7.145 18 9 18q.617 0 1.21-.057A5.48 5.48 0 0 1 9 14.5c0-1.33.472-2.55 1.257-3.5zM14.5 19a4.5 4.5 0 1 0 0-9a4.5 4.5 0 0 0 0 9m0-7a.5.5 0 0 1 .5.5V14h1.5a.5.5 0 0 1 0 1H15v1.5a.5.5 0 0 1-1 0V15h-1.5a.5.5 0 0 1 0-1H14v-1.5a.5.5 0 0 1 .5-.5" />
                </svg><span>Recruitment</span></a>
        </li>
        <li><a href="attendance.php" class="<?= $currentPage == 'attendance-edit.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                    <path fill="#5e4d8c" d="M11 16H3v3q0 .825.588 1.413T5 21h6zm2 0v5h6q.825 0 1.413-.587T21 19v-3zm-2-2V9H3v5zm2 0h8V9h-8zM3 7h18V5q0-.825-.587-1.412T19 3H5q-.825 0-1.412.588T3 5z" />
                </svg><span>Attendance</span></a>
        </li>
        <li><a href="payroll.php" class="<?= $currentPage == 'payroll.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                    <path fill="#5e4d8c" fill-rule="evenodd" d="M4 6.8V8H2.8A1.8 1.8 0 0 0 1 9.8v8.4A1.8 1.8 0 0 0 2.8 20h16.4a1.8 1.8 0 0 0 1.8-1.8V17h1.2c.992 0 1.8-.808 1.8-1.8V6.8c0-.992-.808-1.8-1.8-1.8H5.8C4.808 5 4 5.808 4 6.8M6 7v1h13.2A1.8 1.8 0 0 1 21 9.8V15h1V7zm3 7a2 2 0 1 1 4 0a2 2 0 0 1-4 0" clip-rule="evenodd" />
                </svg><span>Payroll</span></a>
        </li>
        <li><a href="audit-logs.php" class="<?= $currentPage == 'audit-logs.php' ? 'active' : '' ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                    <path fill="#5e4d8c" d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 18a8 8 0 1 1 0-16 8 8 0 0 1 0 16zm1-8.41V7a1 1 0 0 0-2 0v5c0 .26.11.52.29.71l3 3a1 1 0 0 0 1.42-1.42L13 11.59z" />
                </svg><span>Audit Logs</span></a>
        </li>
    </ul>
</div>