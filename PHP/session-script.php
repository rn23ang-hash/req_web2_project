<?php
session_start();
require_once 'database.php'; // Path relative to where this is included

// 1. Match the key from your login script
if (!isset($_SESSION['userId'])) {
    header("Location: ../index.php?error=nosession");
    exit();
}

$userId = $_SESSION['userId'];

try {
    // 2. Fetch all user data so $user is available in your HTML
    $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        session_unset();
        session_destroy();
        header("Location: ../index.php?error=invaliduser");
        exit();
    }
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("A system error occurred. Please try again later.");
}