<?php
session_start();
require 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Assuming you have a database connection established in config.php ($conn)

// Fetch user data
$userId = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = :user_id";
$stmt = $conn->prepare($query);
$stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle language selection
if (isset($_POST['change_language'])) {
    $selectedLanguage = $_POST['language'];
    $_SESSION['language'] = $selectedLanguage;
    $message = "Language changed to " . htmlspecialchars($selectedLanguage);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Settings</title>
    <link rel="stylesheet" href="../style/admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .settings-container {
            padding: 20px;
        }

        .settings-button {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 10px 15px;
            margin-bottom: 10px;
            cursor: pointer;
            font-size: 1em;
            display: block;
            width: 100%;
            text-align: left;
        }

        .settings-button:hover {
            background-color: #e0e0e0;
        }

        /* Language Card Styles */
        .language-card-container {
            position: relative;
        }

        .language-card {
            position: absolute;
            top: 10px;
            left: 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 15px;
            z-index: 10;
            display: none; /* Hidden by default */
        }

        .language-card.show {
            display: block;
        }

        .language-option {
            margin-bottom: 10px;
        }

        .language-option input[type="radio"] {
            margin-right: 5px;
        }

        .language-option label {
            cursor: pointer;
        }

        .language-card button {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 0.9em;
        }

        .language-card button:hover {
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
                    <strong><?= $user['first_name'] ?? 'User' ?></strong>
                    <p><?= ucfirst($user['user_type'] ?? 'admin') ?></p>
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
                        Settings
                    </div>
                </div>
                <div class="search-notification-section">
                    <div class="search-bar">
                        <input type="text" placeholder="Search anything..." />
                    </div>
                    <div class="notification-icon" title="Notifications"><i class="fas fa-bell"></i></div>
                </div>
            </div>

            <div id="contentArea" class="settings-container">
                <?php if (isset($message)): ?>
                    <div class="message"><?= $message ?></div>
                <?php endif; ?>
                <?php if (isset($error)): ?>
                    <div class="error"><?= $error ?></div>
                <?php endif; ?>

                <button class="settings-button" onclick="window.location.href='profile.php';"><i class="fas fa-user-edit"></i> Edit Profile</button>

                <div class="language-card-container">
                    <button class="settings-button" onclick="toggleLanguageCard()">
                        <i class="fas fa-language"></i> Language
                    </button>
                    <div id="languageCard" class="language-card">
                        <h3>Select Language</h3>
                        <form method="post">
                            <div class="language-option">
                                <input type="radio" id="english" name="language" value="english" <?= ($_SESSION['language'] ?? 'english') === 'english' ? 'checked' : '' ?>>
                                <label for="english">English</label>
                            </div>
                            <div class="language-option">
                                <input type="radio" id="spanish" name="language" value="spanish" <?= ($_SESSION['language'] ?? 'english') === 'spanish' ? 'checked' : '' ?>>
                                <label for="spanish">Spanish</label>
                            </div>
                            <div class="language-option">
                                <input type="radio" id="filipino" name="language" value="filipino" <?= ($_SESSION['language'] ?? 'english') === 'filipino' ? 'checked' : '' ?>>
                                <label for="filipino">Filipino</label>
                            </div>
                            <button type="submit" name="change_language">Save Language</button>
                        </form>
                    </div>
                </div>

                <button class="settings-button" onclick="window.location.href='account_actions.php';"><i class="fas fa-exclamation-triangle"></i> Account Actions</button>

                <button class="settings-button" onclick="window.location.href='notifications_settings.php';"><i class="fas fa-bell"></i> Notification Settings</button>
                <button class="settings-button" onclick="window.location.href='privacy_settings.php';"><i class="fas fa-user-secret"></i> Privacy Settings</button>
                <button class="settings-button" onclick="window.location.href='security_settings.php';"><i class="fas fa-shield-alt"></i> Security Settings</button>
            </div>
        </div>
    </div>

    <script>
        const menuToggle = document.getElementById("menuToggle");
        const closeBtn = document.getElementById("closeBtn");
        const sidebar = document.getElementById("sidebar");
        const mainContent = document.getElementById("mainContent");
        const languageCard = document.getElementById("languageCard");

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

        function toggleLanguageCard() {
            languageCard.classList.toggle("show");
        }

        // Close the language card if clicking outside
        document.addEventListener('click', function(event) {
            if (!event.target.closest('.language-card-container') && languageCard.classList.contains('show')) {
                languageCard.classList.remove('show');
            }
        });
    </script>
</body>
</html>