<?php
session_start();
require 'config.php';

// Simulating logged-in admin; replace with actual login logic
if (!isset($_SESSION['first_name'])) {
    $_SESSION['first_name'] = "AdminName"; // Replace with real admin data
    $_SESSION['user_type'] = "admin";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../style/admin.css" />
  <style>
    /* Add the styles here from your previous request */
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="logo"><span>MF</span> CLINIC</div>
      <ul class="menu">
        <li class="<?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : '' ?>"><a href="dashboard.php">Dashboard</a></li>
        <li class="<?= (basename($_SERVER['PHP_SELF']) == 'user.php') ? 'active' : '' ?>"><a href="user.php">Users</a></li>
        <li class="<?= (basename($_SERVER['PHP_SELF']) == 'logs.php') ? 'active' : '' ?>"><a href="logs.php">Logs</a></li>
      </ul>
      <div class="bottom-user">
        <div class="user-info">
          <img src="image/user.jpg" alt="User" />
          <div>
            <strong><?= $_SESSION['first_name'] ?? 'User' ?></strong>
            <p><?= ucfirst($_SESSION['user_type']) ?></p>
          </div>
        </div>
        <a href="logout.php" class="logout-btn">Log Out</a>
      </div>
    </div>

    <!-- Main Content -->
    <div class="main">
      <div class="top-bar">
        <div class="menu-section">
          <button class="menu-toggle">
            <span>&#9776;</span>
          </button>
          <div class="dashboard-title">Dashboard</div>
        </div>
        <div class="search-notification-section">
          <div class="search-bar">
            <input type="text" placeholder="Search anything..." />
          </div>
          <div class="notification-icon" title="Notifications">&#128276;</div>
        </div>
      </div>

      <!-- Content will be loaded here -->
    </div>
  </div>

  <script>
    const menuToggle = document.querySelector(".menu-toggle");
    const sidebar = document.querySelector(".sidebar");
    const mainContent = document.querySelector(".main");

    menuToggle.addEventListener("click", () => {
      sidebar.classList.toggle("hide");
      mainContent.classList.toggle("full-width");
    });
  </script>
</body>
</html>
