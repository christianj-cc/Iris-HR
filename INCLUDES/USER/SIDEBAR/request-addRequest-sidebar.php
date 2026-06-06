        <div class="sidebar" style="display: flex;">
            <div class="logo">
                <a href="dashboard-user.php" class="logo-f"><img src="../ASSETS/ICONS/logo-full.png" alt="HRM System Logo" class="logo-icon"></a>
                <a href="dashboard-user.php" class="logo-s" style="display: none;"><img src="../ASSETS/ICONS/logo-small.png" alt="HRM System Logo" class="logo-icon"></a>
            </div>
            <ul class="nav-links">
                <li><a href="dashboard-user.php" class="<?= $currentPage == 'dashboard-user.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                            <path fill="#5e4d8c" d="M14 9q-.425 0-.712-.288T13 8V4q0-.425.288-.712T14 3h6q.425 0 .713.288T21 4v4q0 .425-.288.713T20 9zM4 13q-.425 0-.712-.288T3 12V4q0-.425.288-.712T4 3h6q.425 0 .713.288T11 4v8q0 .425-.288.713T10 13zm10 8q-.425 0-.712-.288T13 20v-8q0-.425.288-.712T14 11h6q.425 0 .713.288T21 12v8q0 .425-.288.713T20 21zM4 21q-.425 0-.712-.288T3 20v-4q0-.425.288-.712T4 15h6q.425 0 .713.288T11 16v4q0 .425-.288.713T10 21z" />
                        </svg><span>Dashboard</span></a>
                </li>
                <li><a href="attendance-user.php" class="<?= $currentPage == 'attendance-user.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                            <path fill="#5e4d8c" d="M11 16H3v3q0 .825.588 1.413T5 21h6zm2 0v5h6q.825 0 1.413-.587T21 19v-3zm-2-2V9H3v5zm2 0h8V9h-8zM3 7h18V5q0-.825-.587-1.412T19 3H5q-.825 0-1.412.588T3 5z" />
                        </svg><span>Attendance</span></a>
                </li>
                <li><a href="payroll-user.php" class="<?= $currentPage == 'payroll-user.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" class="icon1">
                            <path fill="#5e4d8c" fill-rule="evenodd" d="M4 6.8V8H2.8A1.8 1.8 0 0 0 1 9.8v8.4A1.8 1.8 0 0 0 2.8 20h16.4a1.8 1.8 0 0 0 1.8-1.8V17h1.2c.992 0 1.8-.808 1.8-1.8V6.8c0-.992-.808-1.8-1.8-1.8H5.8C4.808 5 4 5.808 4 6.8M6 7v1h13.2A1.8 1.8 0 0 1 21 9.8V15h1V7zm3 7a2 2 0 1 1 4 0a2 2 0 0 1-4 0" clip-rule="evenodd" />
                        </svg><span>Payroll</span></a>
                </li>
                <li><a href="request-user.php" class="<?= $currentPage == 'addRequest-user.php' ? 'active' : '' ?>"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" class="icon">
                            <path fill="#5e4d8c" d="M7.29 4.908a54.4 54.4 0 0 1 9.42 0l1.511.13a2.89 2.89 0 0 1 2.313 1.546a.236.236 0 0 1-.091.307l-6.266 3.88a4.25 4.25 0 0 1-4.4.045L3.47 7.088a.236.236 0 0 1-.103-.293A2.89 2.89 0 0 1 5.78 5.039z" />
                            <path fill="#5e4d8c" d="M3.362 8.767a.248.248 0 0 0-.373.187a30.4 30.4 0 0 0 .184 7.56A2.89 2.89 0 0 0 5.78 18.96l1.51.131c3.135.273 6.287.273 9.422 0l1.51-.13a2.89 2.89 0 0 0 2.606-2.449a30.4 30.4 0 0 0 .161-7.779a.248.248 0 0 0-.377-.182l-5.645 3.494a5.75 5.75 0 0 1-5.951.061z" />
                        </svg><span>Request</span></a>
                </li>
                <li><a href="recruitment-user.php" class="<?= $currentPage == 'recruitment-user.php' ? 'active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" class="icon">
                            <path fill="#5e4d8c" d="M20 6h-4V4c0-1.1-.9-2-2-2h-4c-1.1 0-2 .9-2 2v2H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2zm-6 0h-4V4h4v2z" />
                        </svg><span>Job Openings</span></a>
                </li>
            </ul>
        </div>