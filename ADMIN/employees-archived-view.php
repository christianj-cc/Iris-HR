<?php
include '../DATABASE/db_viewArchivedEmp.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>
    <?php include '../INCLUDES/ADMIN/head-admin.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/ADMIN/SIDEBAR/employees-archived-view-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>View Archived Employee Details</h2>
            </div>
            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='employees-archived.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel view-Archivedemployee">
                <div class="panel-content profile-layout">
                    <div class="profile-container">
                        <?php
                        if ($employee) {
                            $profilePic = (!empty($employee['profile_picture']))
                                ? "../ASSETS/UPLOADS/ProfilePictures/" . htmlspecialchars($employee['profile_picture'])
                                : "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg";

                            if (!file_exists($profilePic)) {
                                echo "<p style='color:red;'>File does NOT exist at: $profilePic</p>";
                                $profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg";
                            }
                        } else {
                            echo "<p style='color:red;'>Error: Employee data not found!</p>";
                            $profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg";
                        }
                        ?>
                        <img src="<?= htmlspecialchars($profilePic) ?>" class="profile-pic1" alt="Profile Picture">
                    </div>
                </div>

                <div class="details-container">
                    <table class="details-table">
                        <tr>
                            <th>First Name:</th>
                            <td><?= htmlspecialchars($employee['first_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Last Name:</th>
                            <td><?= htmlspecialchars($employee['last_name']) ?></td>
                        </tr>
                        <tr>
                            <th>Date of Birth:</th>
                            <td><?= date("F j, Y", strtotime($employee['date_of_birth'])) ?></td>
                        </tr>
                        <tr>
                            <th>Age:</th>
                            <td><?= date_diff(date_create($employee['date_of_birth']), date_create('today'))->y ?> years old</td>
                        </tr>
                        <tr>
                            <th>Gender:</th>
                            <td><?= htmlspecialchars($employee['gender']) ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?= htmlspecialchars($employee['email'] ?? 'N/A') ?></td>
                        </tr> 
                        <tr>
                            <th>Phone:</th>
                            <td><?= htmlspecialchars($employee['contact_number']) ?></td>
                        </tr>
                        <tr>
                            <th>Address:</th>
                            <td><?= htmlspecialchars($employee['address']) ?></td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td><?= htmlspecialchars($employee['position_name'] ?? 'N/A') ?></td>
                        </tr> 
                        <tr>
                            <th>Department:</th>
                            <td><?= htmlspecialchars($employee['department_name'] ?? 'N/A') ?></td>
                        </tr> 
                        <tr>
                            <th>Hire Date:</th>
                            <td><?= date("F j, Y", strtotime($employee['hire_date'])) ?></td>
                        </tr>
                        <tr>
                            <th>Salary:</th>
                            <td><?= number_format((float) $employee['base_salary'], 2) ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>