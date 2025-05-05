<?php
session_start();
require 'config.php';

// Sample user session (for demo; replace with actual logic)
$_SESSION['first_name'] = "John";
$_SESSION['user_type'] = "admin";

// Fetch user stats
$patientCount = $conn->query("SELECT COUNT(*) FROM users WHERE user_type = 'patient'")->fetchColumn();
$doctorCount = $conn->query("SELECT COUNT(*) FROM users WHERE user_type = 'doctor'")->fetchColumn();
$nurseCount = $conn->query("SELECT COUNT(*) FROM users WHERE user_type = 'nurse'")->fetchColumn();
$recentUsers = $conn->query("SELECT first_name, last_name, user_type, last_login FROM users ORDER BY last_login DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="style/admin.css" />
</head>
<body>
  <div class="container">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
      <div class="logo"><span>MF</span> CLINIC</div>
      <ul class="menu">
        <li class="active"><a href="#">Dashboard</a></li>
        <li><a href="#">Users</a></li>
        <li><a href="#">Logs</a></li>
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

    <!-- Main -->
    <div class="main">
      <div class="top-bar">
        <button class="menu-toggle" id="menu-toggle">&#9776;</button>
        <input type="text" placeholder="Search anything..." />
      </div>

      <h2>Welcome Mr. <?= $_SESSION['first_name'] ?? 'User' ?></h2>

      <div class="cards">
        <div class="card blue">Total Patients <span><?= $patientCount ?></span></div>
        <div class="card yellow">Total Doctors <span><?= $doctorCount ?></span></div>
        <div class="card green">Total Nurses <span><?= $nurseCount ?></span></div>
      </div>

      <div class="recent-users">
        <h3>Recent Users</h3>
        <table>
          <thead>
            <tr>
              <th>User</th>
              <th>Last Logged-in</th>
              <th>Role</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentUsers as $user): ?>
              <tr>
                <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
                <td><?= date("m/d/Y", strtotime($user['last_login'])) ?></td>
                <td><?= ucfirst($user['user_type']) ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="js/toggle.js"></script>
</body>
</html>
