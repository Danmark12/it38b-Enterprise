<?php
session_start();
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .close-btn {
            font-size: 20px;
            color: #fff;
            background: transparent;
            border: none;
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
            display: none;
        }

        .sidebar.show .close-btn {
            display: block;
        }

        .sidebar.hide {
            width: 0 !important;
            padding: 0 !important;
            visibility: hidden !important;
            opacity: 0 !important;
            display: none !important;
            pointer-events: none !important;
        }

        .sidebar.hide * {
            display: none !important;
        }

        .menu li a i {
            margin-right: 10px;
        }

        .menu li.active a {
            background-color: #4CAF50;
            color: white;
        }

        .main.full-width {
            margin-left: 0 !important;
        }

        /* Style for the notification icon */
        .notification-icon {
            font-size: 20px; /* Adjust size as needed */
            cursor: pointer;
            color: #333; /* Dark color to blend with potential dark text */
        }

        /* Styles for the bottom user area */
        .bottom-user {
            margin-top: auto;
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: center; /* Center the card */
        }

        .user-card {
            background-color: #fff;
            color: #333;
            border-radius: 8px;
            padding: 10px; /* Reduce padding */
            text-align: left;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 85%; /* Slightly wider card */
            display: grid;
            grid-template-columns: auto 1fr; /* For image and text */
            grid-template-rows: auto auto auto; /* For name/role and buttons */
            gap: 5px; /* Reduce gap */
            align-items: center;
        }

        .user-card img {
            width: 40px; /* Smaller image */
            height: 40px; /* Smaller image */
            border-radius: 50%;
            grid-row: 1 / 3; /* Span two rows */
        }

        .user-card strong {
            font-size: 0.8em; /* Smaller name */
            display: block;
        }

        .user-card p {
            font-size: 0.7em; /* Smaller role */
            color: #777;
            margin-bottom: 0;
        }

        .settings-link, .logout-link {
            display: flex;
            align-items: center;
            color: #333;
            text-decoration: none;
            font-size: 0.7em; /* Smaller button text */
        }

        .settings-link i, .logout-link i {
            margin-right: 5px; /* Smaller icon spacing */
            font-size: 0.8em; /* Smaller icons */
        }

        .settings-link {
            grid-column: 1 / 2;
            grid-row: 3 / 4;
        }

        .logout-link {
            grid-column: 2 / 3;
            grid-row: 3 / 4;
            justify-self: end; /* Align to the right */
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
                    <a href="profile.php" class="settings-link"><i class="fas fa-cog"></i> Settings</a>
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
                        <?= ucfirst(str_replace('.php', '', basename($_SERVER['PHP_SELF']))) ?>
                    </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications"><i class="fas fa-bell"></i></div>
                </div>
            </div>

            <div id="contentArea">
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