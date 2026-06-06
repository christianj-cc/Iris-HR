<?php
include 'DATABASE/db_login.php';
require_once 'INCLUDES/security-helper.php';

// Check if we have login attempt info from URL parameters
$error = isset($_GET['error']) ? $_GET['error'] : '';
$attempts_left = isset($_GET['attempts_left']) ? (int)$_GET['attempts_left'] : 5;
$locked_minutes = isset($_GET['locked_minutes']) ? (int)$_GET['locked_minutes'] : 0;
$email = isset($_GET['email']) ? $_GET['email'] : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IrisHR</title>
    <link rel="icon" type="image/x-icon" href="ASSETS/ICONS/site-icon.ico">
    <link rel="stylesheet" href="STYLES/styles-login.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="scripts.js"></script>
</head>

<body>
    <div class="login-popup">
        <div class="login-container">
            <div class="login-left">
                <img src="ASSETS/ICONS/illustration.png" alt="HRMS Illustration">
            </div>
            <div class="login-right">
                <a href="index.php" class="logo-f"><img class="logo" src="ASSETS/ICONS/logo-full-big.png" alt="IrisHR Logo"></a>

                <!-- Status Messages -->
                <?php if (!empty($error)): ?>
                    <div class="status-message status-error">
                        <i class="fas fa-exclamation-circle"></i> <?= htmlspecialchars($error) ?>
                    </div>
                <?php endif; ?>

                <?php if ($attempts_left < 3 && $attempts_left > 0 && empty($locked_minutes)): ?>
                    <div class="status-message status-warning">
                        <i class="fas fa-exclamation-triangle"></i>
                        Warning: <?= $attempts_left ?> attempt(s) left before your account is locked for 15 minutes.
                    </div>
                <?php endif; ?>

                <?php if ($locked_minutes > 0): ?>
                    <div class="status-message status-info">
                        <i class="fas fa-lock"></i>
                        Account is locked. Please try again in <span id="timer" class="timer-highlight"><?= $locked_minutes ?>:00</span>
                    </div>
                <?php endif; ?>

                <form method="POST" action="DATABASE/db_login.php" id="loginForm">
                    <div class="form-group <?= $locked_minutes > 0 ? 'disabled' : '' ?>">
                        <input type="email" name="email" placeholder="Email" required
                            value="<?= htmlspecialchars($email) ?>"
                            <?= $locked_minutes > 0 ? 'disabled' : '' ?>>
                    </div>
                    <div class="form-group <?= $locked_minutes > 0 ? 'disabled' : '' ?>">
                        <div class="password-container">
                            <input type="password" id="password" name="password" placeholder="Password" required
                                <?= $locked_minutes > 0 ? 'disabled' : '' ?>>
                            <span class="toggle-password" onclick="togglePassword()">
                                <img id="eyeIcon" src="ASSETS/ICONS/eye-close.svg" alt="Show Password">
                            </span>
                        </div>
                    </div>

                    <!-- Attempts left counter -->
                    <?php if ($attempts_left > 0 && $attempts_left < 5 && empty($locked_minutes)): ?>
                        <div class="attempts-counter">
                            <i class="fas fa-info-circle"></i>
                            <?= $attempts_left ?> of 5 attempts remaining
                        </div>
                    <?php endif; ?>

                    <button class="button-default" type="submit" <?= $locked_minutes > 0 ? 'disabled' : '' ?>>
                        Sign In
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Timer countdown script for locked accounts -->
    <?php if ($locked_minutes > 0): ?>
        <script>
            let minutes = <?= $locked_minutes ?>;
            let seconds = 0;
            const timerElement = document.getElementById('timer');

            function updateTimer() {
                if (seconds === 0) {
                    if (minutes === 0) {
                        // Timer expired, reload page to unlock form
                        window.location.reload();
                        return;
                    }
                    minutes--;
                    seconds = 59;
                } else {
                    seconds--;
                }

                // Format with leading zeros
                const minutesStr = minutes < 10 ? '0' + minutes : minutes;
                const secondsStr = seconds < 10 ? '0' + seconds : seconds;

                timerElement.textContent = minutesStr + ':' + secondsStr;
            }

            // Update timer every second
            setInterval(updateTimer, 1000);
        </script>
    <?php endif; ?>
</body>

</html>