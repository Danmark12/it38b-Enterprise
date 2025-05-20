<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle notification settings updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_notifications'])) {
    $emailNotifications = isset($_POST['email_notifications']) ? 1 : 0;
    $smsNotifications = isset($_POST['sms_notifications']) ? 1 : 0;
    $inAppNotifications = isset($_POST['in_app_notifications']) ? 1 : 0;

    // Implement database update logic here to save these preferences for the user
    $updateSuccess = true; // Replace with actual database update result

    if ($updateSuccess) {
        $message = "Notification settings updated successfully!";
    } else {
        $error = "Failed to update notification settings.";
    }
}

// Fetch current notification settings for the user (if you have them in the database)
// $notificationSettings = ... fetch from database ...
$emailNotificationsChecked = $notificationSettings['email_notifications'] ?? true; // Default to true
$smsNotificationsChecked = $notificationSettings['sms_notifications'] ?? false;
$inAppNotificationsChecked = $notificationSettings['in_app_notifications'] ?? true;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Notification Settings</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .notifications-container {
            padding: 20px;
        }

        .notifications-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .notifications-section h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: #333;
        }

        .notification-option {
            margin-bottom: 10px;
        }

        .notification-option label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .notification-option input[type="checkbox"] {
            margin-right: 10px;
        }

        .notification-description {
            color: #777;
            font-size: 0.9em;
            margin-left: 25px;
        }

        .button-group {
            margin-top: 20px;
        }

        .save-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            cursor: pointer;
            font-size: 1em;
        }

        .save-btn:hover {
            background-color: #45a049;
        }

        .message {
            color: green;
            margin-top: 10px;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar show" id="sidebar">
            <button class="close-btn" id="closeBtn">&times;</button>
            <div class="logo"><span>MF</span> CLINIC</div>
            <ul class="menu">
                <li class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
                    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) === 'user.php' ? 'active' : '' ?>">
                    <a href="user.php"><i class="fas fa-users"></i> Users</a>
                </li>
                <li class="<?= basename($_SERVER['PHP_SELF']) === 'logs.php' ? 'active' : '' ?>">
                    <a href="logs.php"><i class="fas fa-list-alt"></i> Logs</a>
                </li>
            </ul>
            <div class="bottom-user">
                <div class="user-card">
                    <img src="image/user.jpg" alt="User Profile" />
                    <strong><?= $_SESSION['first_name'] ?? 'User' ?></strong>
                    <p><?= ucfirst($_SESSION['user_type'] ?? 'admin') ?></p>
                    <a href="settings.php" class="settings-link"><i class="fas fa-cog"></i> Settings</a>
                    <a href="logout.php" class="logout-link"><i class="fas fa-sign-out-alt"></i> Log Out</a>
                </div>
            </div>
        </div>

        <div class="main" id="mainContent">
            <div class="top-bar">
                <div class="menu-section">
                    <button class="menu-toggle" id="menuToggle">
                        <span>&#9776;</span>
                    </button>
                    <div class="dashboard-title" id="pageTitle">
                        Notification Settings
                    </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications"><i class="fas fa-bell"></i></div>
                </div>
            </div>

            <div id="contentArea" class="notifications-container">
                <?php if (isset($message)): ?>
                    <div class="message"><?= $message ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>

                <div class="notifications-section">
                    <h2>Control Your Notifications</h2>
                    <form method="post">
                        <div class="notification-option">
                            <input type="checkbox" id="email_notifications" name="email_notifications" <?= $emailNotificationsChecked ? 'checked' : '' ?>>
                            <label for="email_notifications">Email Notifications</label>
                            <p class="notification-description">Receive important updates and alerts via email.</p>
                        </div>

                        <div class="notification-option">
                            <input type="checkbox" id="sms_notifications" name="sms_notifications" <?= $smsNotificationsChecked ? 'checked' : '' ?>>
                            <label for="sms_notifications">SMS Notifications</label>
                            <p class="notification-description">Get urgent notifications directly on your phone via SMS.</p>
                        </div>

                        <div class="notification-option">
                            <input type="checkbox" id="in_app_notifications" name="in_app_notifications" <?= $inAppNotificationsChecked ? 'checked' : '' ?>>
                            <label for="in_app_notifications">In-App Notifications</label>
                            <p class="notification-description">See real-time notifications within the application.</p>
                        </div>

                        <div class="button-group">
                            <button type="submit" class="save-btn" name="update_notifications">Save Notification Preferences</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById("menuToggle");
        const closeBtn = document.getElementById("closeBtn");
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");

        menuToggle.addEventListener("click", () => {
            sidebar.classList.add("show");
            sidebar.classList.remove("hide");
            mainContent.classList.remove("full-width");
        });

        closeBtn.addEventListener("click", () => {
            sidebar.classList.add("hide");
            sidebar.classList.remove("show");
            mainContent.classList.add("full-width");
        });
    </script>
</body>
</html>