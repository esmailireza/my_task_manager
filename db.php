<?php
$host = 'localhost';
$db = 'task_manager';
$user = 'root';
$pass = '123456';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO ($dsn,$user,$pass);
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
    exit;
}

?>