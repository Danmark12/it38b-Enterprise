<?php
require 'admin.php';

// Pagination setup
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch users with pagination including last_login
$stmt = $conn->prepare("SELECT id, first_name, last_name, user_type, email, created_at, last_login FROM users LIMIT :start, :limit");
$stmt->bindValue(':start', $start, PDO::PARAM_INT);
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total users
$total_users = $conn->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_pages = ceil($total_users / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Users List</title>
  <link rel="stylesheet" href="../style/users.css">
</head>
<body>
  <div class="content">
    <button class="add-user-btn" onclick="window.location.href='add_user.php'">Add user</button>

    <table>
      <thead>
        <tr>
          <th>User</th>
          <th>Role</th>
          <th>Account Status</th>
          <th>Last Login</th>
          <th>Account Created</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($users as $user): ?>
          <tr>
            <td>
              <img src="https://i.pravatar.cc/40?u=<?= htmlspecialchars($user['email']) ?>" class="avatar" alt="Avatar">
              <?= htmlspecialchars($user['first_name'] . ' ' . $user['last_name']) ?>
            </td>
            <td><?= ucfirst(htmlspecialchars($user['user_type'])) ?></td>
            <td>Active</td> <!-- Placeholder; replace with real logic if needed -->
            <td>
              <strong>
                <?= $user['last_login'] ? date('n/j/Y h:i A', strtotime($user['last_login'])) : 'N/A' ?>
              </strong>
            </td>
            <td><strong><?= date('n/j/Y', strtotime($user['created_at'])) ?></strong></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="pagination">
      <?php if ($page > 1): ?>
        <a href="?page=<?= $page - 1 ?>">Prev.</a>
      <?php endif; ?>

      <?php for ($i = 1; $i <= $total_pages; $i++): ?>
        <?php if ($i == $page): ?>
          <span class="active"><?= $i ?></span>
        <?php else: ?>
          <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>

      <?php if ($page < $total_pages): ?>
        <a href="?page=<?= $page + 1 ?>">Next</a>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>
