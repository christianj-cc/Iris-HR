<?php
include '../DATABASE/db_updateProfile.php';
$currentPage = basename($_SERVER['PHP_SELF']);
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
                <h2><i class="fa fa-bars sidebar-menu" id="menu-toggle">&nbsp&nbsp</i>Profile Information</h2>
            </div>

            <?php include '../INCLUDES/ADMIN/user-dropdown-admin.php'; ?>

            <button id="backToButton" class="button-default" onclick="location.href='dashboard.php';">
                <i class="fas fa-chevron-left">&nbsp</i>Back
            </button>

            <div class="panel view-employee">
                <?php
                // Profile picture (unchanged)
                if (isset($employee) && !empty($employee['profile_picture'])) {
                    $profilePic = "../ASSETS/UPLOADS/ProfilePictures/" . htmlspecialchars($employee['profile_picture']);
                    if (!file_exists($profilePic)) {
                        $profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg";
                    }
                } else {
                    $profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg";
                }
                ?>
                <img src="<?= $profilePic ?>" class="profile-pic1" alt="Profile Picture">

                <!-- Profile Information Panel -->
                <div class="panel profile">
                    <h3>Profile Information</h3>
                    <form method="POST" id="profileForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" name="first_name" value="<?= htmlspecialchars($user['first_name']) ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" value="<?= htmlspecialchars($user['last_name']) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label>Contact Number:</label>
                                <input type="text" name="contact_number" id="phone" value="<?= htmlspecialchars($user['contact_number']) ?>">
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" value="<?= htmlspecialchars($user['email']) ?>" disabled>
                            </div>
                        </div>

                        <label>Address:</label>
                        <input type="text" name="address" value="<?= htmlspecialchars($user['address']) ?>">

                        <input type="hidden" name="admin_password" id="profile_admin_password" value="">
                        <input type="hidden" name="update_profile" value="1">
                        <button type="button" id="saveProfileBtn" class="button-default" onclick="openProfilePasswordModal()">Save Profile</button>
                    </form>
                </div>

                <!-- Change Password Panel -->
                <div class="panel">
                    <h3>Change Password</h3>
                    <form method="POST" id="passwordForm">
                        <label>Current Password:</label>
                        <input type="password" name="current_password" required>

                        <label>New Password:</label>
                        <input type="password" name="new_password" required>

                        <label>Confirm New Password:</label>
                        <input type="password" name="confirm_password" required>

                        <input type="hidden" name="admin_password" id="password_admin_password" value="">
                        <input type="hidden" name="update_password" value="1">
                        <button type="button" id="updatePasswordBtn" class="button-default" onclick="openPasswordChangeModal()">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- PROFILE UPDATE PASSWORD MODAL -->
    <div id="profilePasswordModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to update your profile.</p>
            <form id="profilePasswordForm">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="profile_modal_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelProfilePassword" class="button-default">Cancel</button>
                    <button type="submit" id="confirmProfilePassword" class="button-default">Confirm</button>
                </div>
            </form>
            <div id="profilePasswordError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- PASSWORD CHANGE ADMIN PASSWORD MODAL -->
    <div id="passwordChangeModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-lock" style="color: #5e4d8c; font-size: 3rem;"></i>
            </div>
            <br>
            <h3>Admin Password Required</h3>
            <p>Please enter your admin password to change your password.</p>
            <form id="passwordChangeForm">
                <div class="form-group" style="margin-bottom: 15px;">
                    <input type="password" name="admin_password" id="password_change_modal_password" placeholder="Enter admin password" required style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                </div>
                <div class="modal-buttons">
                    <button type="button" id="cancelPasswordChange" class="button-default">Cancel</button>
                    <button type="submit" id="confirmPasswordChange" class="button-default">Confirm</button>
                </div>
            </form>
            <div id="passwordChangeError" style="color: red; font-size: 14px; margin-top: 10px; display: none;"></div>
        </div>
    </div>

    <!-- PROFILE UPDATE SUCCESS MODAL -->
    <div id="profileSuccessModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Profile updated successfully!</h3>
            <div class="modal-buttons">
                <button id="closeProfileSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>

    <!-- PASSWORD UPDATE SUCCESS MODAL -->
    <div id="passwordSuccessModal" class="content-modal" style="display: none;">
        <div class="modalContent">
            <div style="text-align: center;">
                <i class="fas fa-check-circle" style="color: green; font-size: 4rem;"></i>
            </div>
            <h3 style="text-align: center; margin-top: 10px;">Password updated successfully!</h3>
            <div class="modal-buttons">
                <button id="closePasswordSuccessModal" class="button-default">OK</button>
            </div>
        </div>
    </div>

    <script src="scripts.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Phone validation (unchanged)
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

            // Show success modals based on session flags
            <?php if (isset($_SESSION['profile_updated']) && $_SESSION['profile_updated'] === true): ?>
                document.getElementById('profileSuccessModal').style.display = 'block';
                <?php unset($_SESSION['profile_updated']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['password_updated']) && $_SESSION['password_updated'] === true): ?>
                document.getElementById('passwordSuccessModal').style.display = 'block';
                <?php unset($_SESSION['password_updated']); ?>
            <?php endif; ?>

            // -------------------- PROFILE UPDATE MODAL --------------------
            const profileModal = document.getElementById('profilePasswordModal');
            const profilePasswordInput = document.getElementById('profile_modal_password');
            const profileError = document.getElementById('profilePasswordError');
            const profilePasswordForm = document.getElementById('profilePasswordForm');
            const cancelProfile = document.getElementById('cancelProfilePassword');
            const closeProfileSuccess = document.getElementById('closeProfileSuccessModal');

            window.openProfilePasswordModal = function() {
                profileModal.style.display = 'block';
                profilePasswordInput.value = '';
                profileError.style.display = 'none';
            };

            if (profilePasswordForm) {
                profilePasswordForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const password = profilePasswordInput.value;

                    fetch('../DATABASE/verify_admin_password.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'action=profile_update&admin_password=' + encodeURIComponent(password)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('profile_admin_password').value = password;
                                profileModal.style.display = 'none';
                                document.getElementById('profileForm').submit();
                            } else {
                                profileError.textContent = data.message || 'Incorrect password.';
                                profileError.style.display = 'block';
                                profilePasswordInput.value = '';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                });
            }

            if (cancelProfile) {
                cancelProfile.addEventListener('click', function() {
                    profileModal.style.display = 'none';
                });
            }

            if (closeProfileSuccess) {
                closeProfileSuccess.addEventListener('click', function() {
                    document.getElementById('profileSuccessModal').style.display = 'none';
                });
            }

            // -------------------- PASSWORD CHANGE MODAL --------------------
            const passwordChangeModal = document.getElementById('passwordChangeModal');
            const passwordChangeInput = document.getElementById('password_change_modal_password');
            const passwordChangeError = document.getElementById('passwordChangeError');
            const passwordChangeForm = document.getElementById('passwordChangeForm');
            const cancelPasswordChange = document.getElementById('cancelPasswordChange');
            const closePasswordSuccess = document.getElementById('closePasswordSuccessModal');

            window.openPasswordChangeModal = function() {
                passwordChangeModal.style.display = 'block';
                passwordChangeInput.value = '';
                passwordChangeError.style.display = 'none';
            };

            if (passwordChangeForm) {
                passwordChangeForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const password = passwordChangeInput.value;

                    fetch('../DATABASE/verify_admin_password.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'action=password_change&admin_password=' + encodeURIComponent(password)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('password_admin_password').value = password;
                                passwordChangeModal.style.display = 'none';
                                document.getElementById('passwordForm').submit();
                            } else {
                                passwordChangeError.textContent = data.message || 'Incorrect password.';
                                passwordChangeError.style.display = 'block';
                                passwordChangeInput.value = '';
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred. Please try again.');
                        });
                });
            }

            if (cancelPasswordChange) {
                cancelPasswordChange.addEventListener('click', function() {
                    passwordChangeModal.style.display = 'none';
                });
            }

            if (closePasswordSuccess) {
                closePasswordSuccess.addEventListener('click', function() {
                    document.getElementById('passwordSuccessModal').style.display = 'none';
                });
            }

            // Close any modal when clicking outside
            window.addEventListener('click', function(e) {
                if (e.target.classList.contains('content-modal')) {
                    e.target.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>