<?php
require 'admin.php';

// Fetch user stats
$patientCount = $conn->query("SELECT COUNT(*) FROM users WHERE user_type = 'patient'")->fetchColumn();
$doctorCount = $conn->query("SELECT COUNT(*) FROM users WHERE user_type = 'doctor'")->fetchColumn();
$nurseCount = $conn->query("SELECT COUNT(*) FROM users WHERE user_type = 'nurse'")->fetchColumn();
$recentUsers = $conn->query("SELECT first_name, last_name, user_type, last_login FROM users ORDER BY last_login DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

?>
  <link rel="stylesheet" href="../style/dashboard.css" />

<div class="content">
  <h2>Welcome Mr. <?= htmlspecialchars($_SESSION['first_name']) ?></h2>

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
