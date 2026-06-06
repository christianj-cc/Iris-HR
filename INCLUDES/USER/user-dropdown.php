<?php
include '../DATABASE/db_connect.php';

$user_id = $_SESSION['user_id'] ?? null;
$first_name = $_SESSION['first_name'] ?? 'User';
$last_name = $_SESSION['last_name'] ?? '';

// Fetch profile picture from database
$profilePic = "../ASSETS/UPLOADS/ProfilePictures/default-profile.jpg";
if ($user_id) {
    $sql = "SELECT profile_picture FROM employees WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && !empty($user['profile_picture'])) {
        $profilePicPath = "../ASSETS/UPLOADS/ProfilePictures/" . htmlspecialchars($user['profile_picture']);
        if (file_exists($profilePicPath)) {
            $profilePic = $profilePicPath;
        }
    }
}
?>

<div class="user-dropdown">
    <div class="user-icon" id="user-icon">
        <span class="user-name"><?= htmlspecialchars($first_name . " " . $last_name); ?></span>
        <img src="<?= $profilePic ?>" class="user-profile-pic" alt="User Profile">
    </div>
    <div class="dropdown-menu" id="dropdown-menu">
        <button class="dropdown-profile" onclick="window.location.href='userProfile.php'">
            <i class="fas fa-user"></i> Profile
        </button>
        <form action="../DATABASE/db_loggedout.php" method="post" class="dropdown-logout">
            <button type="submit"><i class="fa fa-sign-out"></i> Logout</button>
        </form>
    </div>
</div>