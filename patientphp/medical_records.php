<?php
// Ensure the config.php file is included correctly.
require_once '../feature/config.php';
session_start();

// Check if the user is logged in.
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$records = [];
$limit = 5;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

try {
    // 1. Check if the table exists.  You can do this with a simple query.
    $checkTableStmt = $conn->prepare("SHOW TABLES LIKE 'medical_records'");
    $checkTableStmt->execute();

    if ($checkTableStmt->rowCount() == 0) {
        // The table does not exist.  Handle this error.
        echo "Error: The 'medical_records' table does not exist in the database.  Please create the table or check the table name.";
        exit(); // Stop execution
    }
    
    // Use named parameters consistently
    $stmt = $conn->prepare("SELECT date, note, note_type, doctor, bill_id FROM medical_records WHERE user_id = :user_id ORDER BY date DESC LIMIT :limit OFFSET :offset");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Use named parameter consistently
    $totalRecordsStmt = $conn->prepare("SELECT COUNT(*) FROM medical_records WHERE user_id = :user_id");
    $totalRecordsStmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $totalRecordsStmt->execute();
    $totalRecords = $totalRecordsStmt->fetchColumn();
    $totalPages = ceil($totalRecords / $limit);

} catch (PDOException $e) {
    echo "Database Error: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Records</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../patientcss/medical_records.css"> </head>
<body>
    <div class="section">
        <h2>Medical Records</h2>
        <?php if (empty($records)): ?>
            <p class="no-records">No medical records found.</p>
        <?php else: ?>
            <table class="styled-table">
                <thead>
                    <tr>
                        <th>Consultation Date</th>
                        <th>Note</th>
                        <th>Note Type</th>
                        <th>Author</th>
                        <th>Bill ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td><?= htmlspecialchars($record['date']) ?></td>
                            <td><?= htmlspecialchars($record['note']) ?></td>
                            <td><?= htmlspecialchars($record['note_type']) ?></td>
                            <td><?= htmlspecialchars($record['doctor']) ?></td>
                            <td><?= htmlspecialchars($record['bill_id']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php if ($totalPages > 1): ?>
                    <button <?php if ($page <= 1) echo 'disabled'; ?> onclick="window.location.href='?page=<?= $page - 1 ?>'">Prev.</button>
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <a href="?page=<?= $i ?>" <?php if ($i === $page) echo 'class="active"'; ?>><?= $i ?></a>
                    <?php endfor; ?>
                    <button <?php if ($page >= $totalPages) echo 'disabled'; ?> onclick="window.location.href='?page=<?= $page + 1 ?>'">Next</button>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
