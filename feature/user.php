<?php
require 'admin.php';

// Fetch all users
$users = $conn->query("SELECT first_name, last_name, user_type, email FROM users")->fetchAll(PDO::FETCH_ASSOC);

?>
  <link rel="stylesheet" href="../style/users.css" />
<div class="content">
  <h2>Users List</h2>

  <table>
    <thead>
      <tr>
        <th>User</th>
        <th>Email</th>
        <th>Role</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= ucfirst($user['user_type']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
