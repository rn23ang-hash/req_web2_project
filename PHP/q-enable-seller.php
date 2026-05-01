<?php
session_start();
require 'database.php'; // Ensure path is correct

// 1. Check if user is logged in
if (!isset($_SESSION['userId'])) {
    header("Location: ../USER-AUTH/login.php");
    exit();
}

$userId = $_SESSION['userId'];

try {
    // 2. Perform the Update (CRUD: Update)
    $sql = "UPDATE users SET seller_active = 1 WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        // 3. Jump back to the account page immediately
        header("Location: ../ACCOUNT-FRONTEND/account.php?seller=enabled");
        exit();
    } else {
        header("Location: ../ACCOUNT-FRONTEND/account.php?error=updatefailed");
        exit();
    }

} catch (PDOException $e) {
    // Log error and redirect
    header("Location: ../ACCOUNT-FRONTEND/account.php?error=sqlerror");
    exit();
}