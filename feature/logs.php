<?php
require 'admin.php';

// Pagination setup
$limit = 6;
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Get total pages
$stmt = $conn->prepare("SELECT COUNT(*) FROM logs 
                        JOIN users ON logs.user_id = users.id");
$stmt->execute();
$totalLogs = $stmt->fetchColumn();
$totalPages = ceil($totalLogs / $limit);

// Fetch paginated logs
$stmt = $conn->prepare("
    SELECT logs.*, users.first_name, users.last_name 
    FROM logs 
    JOIN users ON logs.user_id = users.id 
    ORDER BY logs.created_at DESC 
    LIMIT :limit OFFSET :offset
");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Logs</title>
    <link rel="stylesheet" href="../style/logs.css" />
</head>
<body>
    <div class="logs-card">
        <h2>System Logs</h2>

        <!-- Log Table -->
        <div class="log-table">
            <div class="log-header">
                <div>User</div>
                <div>Event Type</div>
                <div>Description</div>
                <div>Time</div>
                <div>Date</div>
            </div>

            <?php foreach ($logs as $log): ?>
            <div class="log-row">
                <div>
                    <img src="<?= file_exists("../uploads/{$log['user_id']}.jpg") 
                            ? "../uploads/{$log['user_id']}.jpg" 
                            : "../image/default-user.png" ?>" 
                         alt="User Image" class="avatar">
                    <?= htmlspecialchars($log['first_name'] . ' ' . $log['last_name']) ?>
                </div>
                <div><?= htmlspecialchars($log['event_type']) ?></div>
                <div><?= htmlspecialchars($log['description']) ?></div>
                <div><?= date("g:i A", strtotime($log['created_at'])) ?></div>
                <div><?= date("n/j/Y", strtotime($log['created_at'])) ?></div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=<?= $page - 1 ?>">Prev.</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <a href="?page=<?= $i ?>" class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <a href="?page=<?= $page + 1 ?>">Next</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
