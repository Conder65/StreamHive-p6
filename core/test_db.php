<?php
require_once __DIR__ . '/Database.php';

$pdo = Database::getConnection();

$stmt = $pdo->query("SELECT NOW() AS server_time");
$row = $stmt->fetch();

echo "Connected! MySQL time is: " . $row['server_time'];
