<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle account actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['deactivate_account'])) {
        // Implement account deactivation logic here
        $deactivateSuccess = true; // Replace with actual database update
        if ($deactivateSuccess) {
            $message = "Account deactivated successfully!";
            // Optionally, redirect or update session
        } else {
            $error = "Failed to deactivate account.";
        }
    } elseif (isset($_POST['delete_account'])) {
        // Implement account deletion logic here
        $deleteSuccess = true; // Replace with actual database delete
        if ($deleteSuccess) {
            session_destroy();
            header("Location: account_deleted.php"); // You'll need this page
            exit();
        } else {
            $error = "Failed to delete account.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Account Actions</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .account-actions-container {
            padding: 20px;
        }

        .account-actions-section {
            background-color: #fff;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .account-actions-section h2 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
            color: #333;
        }

        .action-item {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #eee;
            border-radius: 4px;
        }

        .action-item h3 {
            margin-top: 0;
            color: #555;
        }

        .action-item p {
            color: #777;
            margin-bottom: 10px;
        }

        .action-button {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
        }

        .deactivate-btn {
            background-color: #ff9800;
            color: white;
        }

        .delete-btn {
            background-color: #f44336;
            color: white;
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
                        Account Actions
                    </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications"><i class="fas fa-bell"></i></div>
                </div>
            </div>

            <div id="contentArea" class="account-actions-container">
                <?php if (isset($message)): ?>
                    <div class="message"><?= $message ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>

                <div class="account-actions-section">
                    <h2>Manage Your Account</h2>

                    <div class="action-item">
                        <h3>Deactivate Account</h3>
                        <p>Temporarily disable your account. Your profile and data will be saved, and you can reactivate it later by logging back in.</p>
                        <form method="post" onsubmit="return confirm('Are you sure you want to deactivate your account?');">
                            <button type="submit" class="action-button deactivate-btn" name="deactivate_account">Deactivate Account</button>
                        </form>
                    </div>

                    <div class="action-item">
                        <h3>Delete Account</h3>
                        <p>Permanently delete your account and all associated data. This action cannot be undone. Please be certain before proceeding.</p>
                        <form method="post" onsubmit="return confirm('Are you sure you want to permanently delete your account? This action cannot be undone.');">
                            <button type="submit" class="action-button delete-btn" name="delete_account">Delete Account</button>
                        </form>
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