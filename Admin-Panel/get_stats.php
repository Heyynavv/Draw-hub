<?php
include '../includes/db.php';
$lucky = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM luckyday_users"))['total'];
$weekly = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM weekly_users"))['total'];

header('Content-Type: application/json');
echo json_encode([
    'luckyday' => (int)$lucky,
    'weekly' => (int)$weekly,
    'total' => (int)($lucky + $weekly)
]);
?>