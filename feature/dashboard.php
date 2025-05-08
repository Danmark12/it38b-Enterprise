<?php
require 'admin.php';

// === Count Functions ===
function countUsersByType($conn, $type) {
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE user_type = :type");
    $stmt->bindParam(':type', $type);
    $stmt->execute();
    return $stmt->fetchColumn();
}

function countAllUsers($conn) {
    return $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
}

// === Get Counts ===
$totalUsers   = countAllUsers($conn);
$patientCount = countUsersByType($conn, 'patient');
$doctorCount  = countUsersByType($conn, 'doctor');
$nurseCount   = countUsersByType($conn, 'nurse');

// === Get Recent Logins ===
$recentUsers = $conn->query("SELECT first_name, last_name, user_type, last_login FROM users ORDER BY last_login DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="../style/dashboard.css" />
</head>
<body>
  <div class="content">
    <h2>Welcome Mr. <?= htmlspecialchars($_SESSION['first_name']) ?></h2>

    <div class="cards">
      <div class="card gray">Total Users <span><?= $totalUsers ?></span></div>
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
              <td><?= $user['last_login'] ? date("m/d/Y h:i A", strtotime($user['last_login'])) : 'N/A' ?></td>
              <td><?= ucfirst($user['user_type']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>
