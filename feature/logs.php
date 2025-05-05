<?php
require 'admin.php';

// Fetch logs (assuming your table contains 'message' and 'created_at' columns)
$logs = $conn->query("SELECT * FROM logs ORDER BY created_at DESC LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="../style/logs.css" />

<div class="content">
  <h2>System Logs</h2>

  <table>
    <thead>
      <tr>
        <th>Log Entry</th>
        <th>Timestamp</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($logs as $log): ?>
        <tr>
          <td><?= htmlspecialchars($log['message']) ?></td>
          <td><?= date("m/d/Y H:i:s", strtotime($log['created_at'])) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
