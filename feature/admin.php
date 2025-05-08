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

    .menu li.active a {
      background-color: #4CAF50;
      color: white;
    }

    .main.full-width {
      margin-left: 0 !important;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar show" id="sidebar">
      <button class="close-btn" id="closeBtn">&times;</button>
      <div class="logo"><span>MF</span> CLINIC</div>
      <ul class="menu">
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'dashboard.php' ? 'active' : '' ?>">
          <a href="dashboard.php">Dashboard</a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'user.php' ? 'active' : '' ?>">
          <a href="user.php">Users</a>
        </li>
        <li class="<?= basename($_SERVER['PHP_SELF']) === 'logs.php' ? 'active' : '' ?>">
          <a href="logs.php">Logs</a>
        </li>
      </ul>
      <div class="bottom-user">
        <div class="user-info">
          <img src="image/user.jpg" alt="User" />
          <div>
            <strong><?= $_SESSION['first_name'] ?? 'User' ?></strong>
            <p><?= ucfirst($_SESSION['user_type'] ?? 'admin') ?></p>
          </div>
        </div>
        <a href="logout.php" class="logout-btn">Log Out</a>
      </div>
    </div>

    <!-- Main Content -->
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
          <div class="notification-icon" title="Notifications">&#128276;</div>
        </div>
      </div>

      <div id="contentArea">
        <!-- Page-specific content will be loaded directly in dashboard.php, user.php, or logs.php -->

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
