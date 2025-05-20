<?php
// Include your database configuration
require '../feature/config.php';
session_start();

// Get the user ID from the session
$user_id = $_SESSION['user_id'] ?? 0;
$billings = [];
$records_per_page = 5;

if ($user_id) {
    // 1. Get the total number of billing records for the user
    $count_stmt = $conn->prepare("
        SELECT COUNT(*)
        FROM billing_records
        WHERE user_id = ?
    ");
    $count_stmt->execute([$user_id]);
    $total_records = $count_stmt->fetchColumn();
    $total_pages = ceil($total_records / $records_per_page);

    // 2. Determine the current page number
    $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
    $page = max(1, min($page, $total_pages));
    $offset = ($page - 1) * $records_per_page;

    // 3. Fetch the billing records for the current page
    $sql = "
        SELECT
            br.bill_id,
            br.billed_date,
            br.details,
            br.status,
            u.first_name,
            u.last_name
        FROM billing_records br
        JOIN users u ON br.user_id = u.id
        WHERE br.user_id = ?
        ORDER BY br.billed_date DESC
        LIMIT " . (int)$offset . ", " . (int)$records_per_page;
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user_id]);
    $billings = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Function to format the date
function formatDate($dateString) {
    if (!$dateString) return '';
    $date = new DateTime($dateString);
    return $date->format('m/d/Y');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing Records</title>
    <link rel="stylesheet" href="../patientcss/billing_records.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Source Sans Pro', sans-serif;
      }
    </style>
</head>
<body>
    <div class="section">
        <h2 class="page-title">Billing Records</h2>
        <?php if (empty($billings) && $user_id): ?>
            <p class="no-records">No billing records available for this user.</p>
        <?php elseif (!$user_id): ?>
            <p class="no-records">Please log in to view your billing records.</p>
        <?php else: ?>
            <div class="table-container">
                <div class="pagination-controls">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?= $page - 1 ?>" class="pagination-button prev-page">Prev.</a>
                    <?php else: ?>
                        <span class="pagination-button disabled prev-page">Prev.</span>
                    <?php endif; ?>
                    <?php
                    $range = 2;
                    $start_page = max(1, $page - $range);
                    $end_page = min($total_pages, $page + $range);
                    if ($start_page > 1) {
                        echo '<a href="?page=1" class="pagination-button page-number">1</a>';
                        if ($start_page > 2) {
                            echo '<span class="pagination-dots">...</span>';
                        }
                    }
                    for ($i = $start_page; $i <= $end_page; $i++) {
                        if ($i == $page) {
                            echo '<span class="pagination-button page-number active-page">' . $i . '</span>';
                        } else {
                            echo '<a href="?page=' . $i . '" class="pagination-button page-number">' . $i . '</a>';
                        }
                    }
                    if ($end_page < $total_pages) {
                        if ($end_page < $total_pages - 1) {
                            echo '<span class="pagination-dots">...</span>';
                        }
                        echo '<a href="?page=' . $total_pages . '" class="pagination-button page-number">' . $total_pages . '</a>';
                    }
                    ?>
                    <?php if ($page < $total_pages): ?>
                        <a href="?page=<?= $page + 1 ?>" class="pagination-button next-page">Next</a>
                    <?php else: ?>
                        <span class="pagination-button disabled next-page">Next</span>
                    <?php endif; ?>
                </div>
                <table class="billing-table">
                    <thead class="billing-table-header">
                        <tr>
                            <th class="bill-id-header">Bill ID</th>
                            <th class="status-header">Status</th>
                            <th class="details-header">Details</th>
                            <th class="author-header">Author</th>
                            <th class="billed-date-header">Billed Date</th>
                        </tr>
                    </thead>
                    <tbody class="billing-table-body">
                        <?php foreach ($billings as $bill): ?>
                            <tr class="billing-row">
                                <td class="bill-id-data"><?= htmlspecialchars($bill['bill_id']) ?></td>
                                <td class="status-data"><?= htmlspecialchars(ucfirst($bill['status'])) ?></td>
                                <td class="details-data"><?= htmlspecialchars($bill['details']) ?></td>
                                <td class="author-data"><?= htmlspecialchars($bill['first_name'] . ' ' . $bill['last_name']) ?></td>
                                <td class="billed-date-data"><?= formatDate(htmlspecialchars($bill['billed_date'])) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
