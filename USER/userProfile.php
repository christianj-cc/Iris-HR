<?php
include '../DATABASE/db_fetchupdateUserProfile.php';
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <?php include '../INCLUDES/USER/head.php'; ?>
</head>

<body>
    <div class="container">
        <?php include '../INCLUDES/USER/user-sidebar.php'; ?>

        <div class="main-content">
            <div id="title">
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Profile Information</h2>
            </div>
            <div class="user-dropdown">
                <div class="user-iconProf" id="user-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <div class="dropdown-menu" id="dropdown-menu">
                    <form action="../DATABASE/db_signout.php" method="post" class="dropdown-logout">
                        <button type="submit">
                            <i class="fa fa-sign-out"></i> Logout
                        </button>
                    </form>
                </div>
            </div>

            <button id="backToButton" class="button-default" onclick="location.href='dashboard-user.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <!-- Profile Information Panel -->
            <div class="panel">
                <h3>Profile Information</h3>
                <?php
                // Ensure $user is set before accessing data
                if (isset($user) && !empty($user['profile_picture'])) {
                    $profilePic = "../ASSETS/UPLOADS/ProfilePictures/" . htmlspecialchars($user['profile_picture']);

                    // Debugging: Check if file exists
                    if (!file_exists($profilePic)) {
                        error_log("Error: Profile picture file does NOT exist at: " . $profilePic);
                        $profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg"; // Use default image
                    }
                } else {
                    error_log("Error: User data not found or profile picture is empty!");
                    $profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg"; // Fallback
                }
                ?>
                <img src="<?= $profilePic ?>" class="profile-pic1" alt="Profile Picture">

                <form action="../DATABASE/db_fetchupdateUserProfile.php" method="POST" enctype="multipart/form-data" id="profileForm">
                    <div class="form-row">
                        <div class="form-group">
                            <label>First Name:</label>
                            <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label>Last Name:</label>
                            <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Address:</label>
                            <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="contact_number" id="phone" value="<?= htmlspecialchars($user['contact_number']) ?>">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                        </div>
                    </div>

                    <input type="hidden" name="profile_update" value="1">
                    <input type="hidden" name="user_password" id="user_password" value="">
                    <button type="button" id="saveProfileBtn" class="button-default" onclick="openUserPasswordModal()">Save Profile</button>
                </form>
            </div>

            <!-- Change Password Panel -->
            <div class="panel">
                <h3>Change Password</h3>
                <form method="POST">
                    <label>Current Password:</label>
                    <input type="password" name="current_password" required>

                    <label>New Password:</label>
                    <input type="password" name="new_password" required>

                    <label>Confirm New Password:</label>
                    <input type="password" name="confirm_password" required>

                    <button type="submit" name="update_password" class="button-default">Update Password</button>
                </form>
            </div>
        </div>
    </div>

    <!-- PASSWORD MODAL FOR PROFILE UPDATE -->
    <div id="userPasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Password Required</h3>
            <p>Please enter your current password to update your profile.</p>
            <form id="userPasswordForm">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="current_password" id="user_modal_password" placeholder="Enter current password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelUserPassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmUserPassword" class="button-default">Confirm</button>
                </div>
            </form>
            <div id="userPasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- PROFILE UPDATE SUCCESS MODAL -->
    <div id="userSuccessModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Profile updated successfully!</h3>
            <div class="modal-buttons">
                <button id="closeUserSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Phone number validation (unchanged)
            let phoneInputs = document.querySelectorAll("input[name='phone'], input[name='contact_number']");
            phoneInputs.forEach(function(phoneInput) {
                phoneInput.addEventListener("input", function() {
                    if (!this.value.startsWith("09")) this.value = "09";
                    this.value = this.value.replace(/[^0-9]/g, "");
                    if (this.value.length > 11) this.value = this.value.slice(0, 11);
                    this.setCustomValidity("");
                });
                phoneInput.addEventListener("blur", function() {
                    if (this.value.length < 11) {
                        this.setCustomValidity("Phone number must be 11 digits (e.g., 09123456789).");
                        this.reportValidity();
                    } else {
                        this.setCustomValidity("");
                    }
                });
                phoneInput.addEventListener("keydown", function(e) {
                    if ((this.selectionStart < 2 || this.selectionEnd < 2) && (e.key === "Backspace" || e.key === "Delete")) {
                        e.preventDefault();
                    }
                });
            });

            // Show success modal if session flag is set
            <?php if (isset($_SESSION['user_profile_updated']) && $_SESSION['user_profile_updated'] === true): ?>
                document.getElementById('userSuccessModal').style.display = 'block';
                <?php unset($_SESSION['user_profile_updated']); ?>
            <?php endif; ?>

            // Password modal elements
            const userModal = document.getElementById('userPasswordModal');
            const userPasswordInput = document.getElementById('user_modal_password');
            const userError = document.getElementById('userPasswordError');
            const userForm = document.getElementById('userPasswordForm');
            const cancelUser = document.getElementById('cancelUserPassword');
            const closeSuccess = document.getElementById('closeUserSuccessModal');

            // Open modal function
            window.openUserPasswordModal = function() {
                userModal.style.display = 'block';
                userPasswordInput.value = '';
                userError.style.display = 'none';
            };

            // Handle form submission (password verification)
            if (userForm) {
                userForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const password = userPasswordInput.value;

                    fetch('../DATABASE/verify_user_password.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'current_password=' + encodeURIComponent(password)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('user_password').value = password;
                                userModal.style.display = 'none';
                                document.getElementById('profileForm').submit();
                            } else {
                                userError.textContent = data.message || 'Incorrect password.';
                                userError.style.display = 'block';
                                userPasswordInput.value = '';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                });
            }

            // Cancel button
            if (cancelUser) {
                cancelUser.addEventListener('click', function() {
                    userModal.style.display = 'none';
                });
            }

            // Close success modal
            if (closeSuccess) {
                closeSuccess.addEventListener('click', function() {
                    document.getElementById('userSuccessModal').style.display = 'none';
                });
            }

            // Close modals when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target.classList.contains('content-modal')) {
                    e.target.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>