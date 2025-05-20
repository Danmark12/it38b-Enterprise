<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle privacy settings updates
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_privacy'])) {
    $profileVisibility = $_POST['profile_visibility'] ?? 'private';
    $dataSharing = isset($_POST['data_sharing']) ? 1 : 0;

    // Implement database update logic here to save these preferences
    // Example using PDO:
    $userId = $_SESSION['user_id'];
    $updateQuery = "UPDATE users SET profile_visibility = :visibility, allow_data_sharing = :sharing WHERE id = :user_id";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':visibility', $profileVisibility);
    $updateStmt->bindParam(':sharing', $dataSharing, PDO::PARAM_INT);
    $updateStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    if ($updateStmt->execute()) {
        $message = "Privacy settings updated successfully!";
    } else {
        $error = "Failed to update privacy settings.";
        // Optionally log the error: error_log("Privacy update failed: " . implode(":", $updateStmt->errorInfo()));
    }
}

// Fetch current privacy settings
$userId = $_SESSION['user_id'];
$privacyQuery = "SELECT profile_visibility, allow_data_sharing FROM users WHERE id = :user_id";
$privacyStmt = $conn->prepare($privacyQuery);
$privacyStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$privacyStmt->execute();
$privacySettings = $privacyStmt->fetch(PDO::FETCH_ASSOC);

$profileVisibilitySetting = $privacySettings['profile_visibility'] ?? 'private';
$dataSharingSetting = $privacySettings['allow_data_sharing'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Privacy Settings</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .privacy-container {
            padding: 20px;
        }

        .privacy-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .privacy-section h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: #333;
        }

        .privacy-option {
            margin-bottom: 15px;
        }

        .privacy-option label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }

        .privacy-option select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .privacy-option input[type="checkbox"] {
            margin-right: 10px;
        }

        .privacy-description {
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
                        Privacy Settings
                    </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications"><i class="fas fa-bell"></i></div>
                </div>
            </div>

            <div id="contentArea" class="privacy-container">
                <?php if (isset($message)): ?>
                    <div class="message"><?= $message ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>

                <div class="privacy-section">
                    <h2>Control Your Privacy</h2>

                    <div class="privacy-option">
                        <label for="profile_visibility">Profile Visibility</label>
                        <select id="profile_visibility" name="profile_visibility">
                            <option value="public" <?= $profileVisibilitySetting === 'public' ? 'selected' : '' ?>>Public - Everyone can see your profile.</option>
                            <option value="private" <?= $profileVisibilitySetting === 'private' ? 'selected' : '' ?>>Private - Only you can see your full profile.</option>
                            <option value="connections" <?= $profileVisibilitySetting === 'connections' ? 'selected' : '' ?>>Connections - Only your connections can see your full profile.</option>
                        </select>
                        <p class="privacy-description">Choose who can view your profile information.</p>
                    </div>

                    <div class="privacy-option">
                        <input type="checkbox" id="data_sharing" name="data_sharing" <?= $dataSharingSetting ? 'checked' : '' ?>>
                        <label for="data_sharing">Allow data sharing for research purposes</label>
                        <p class="privacy-description">Anonymized data may be used to improve our services and for research.</p>
                    </div>

                    <div class="button-group">
                        <button type="submit" class="save-btn" name="update_privacy">Save Privacy Settings</button>
                    </div>
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