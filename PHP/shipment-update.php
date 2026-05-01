<?php
require 'session-script.php';

// Check if the user is logged in and the request is a POST
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userId']) && isset($_POST['order_id'])) {
    
    $order_id = $_POST['order_id'];
    $seller_user_id = $_SESSION['userId'];

    try {
        /**
         * SECURITY CHECK:
         * We join the 'orders' table with 'products' and 'sellers' to verify 
         * that the 'order_id' being updated actually belongs to the 
         * logged-in user.
         */
        $verifyQuery = "SELECT o.id 
                        FROM orders o
                        JOIN products p ON o.product_id = p.id
                        JOIN sellers s ON p.seller_id = s.id
                        WHERE o.id = :oid AND s.user_id = :uid";
        
        $verifyStmt = $conn->prepare($verifyQuery);
        $verifyStmt->execute([
            'oid' => $order_id,
            'uid' => $seller_user_id
        ]);

        if ($verifyStmt->fetch()) {
            // The seller is authorized to update this specific order
            $updateQuery = "UPDATE orders SET status = 'Shipped' WHERE id = :oid";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->execute(['oid' => $order_id]);

            // Redirect back to the shipment page with a success message
            header("Location: ../ACCOUNT-FRONTEND/shipment.php?update=success");
            exit();
        } else {
            // Unauthorized attempt or order does not exist
            header("Location: ../ACCOUNT-FRONTEND/shipment.php?error=unauthorized");
            exit();
        }

    } catch (PDOException $e) {
        // Log the error and show a generic message
        error_log("Update Shipment Error: " . $e->getMessage());
        header("Location: ../ACCOUNT-FRONTEND/shipment.php?error=system");
        exit();
    }
} else {
    // If someone tries to access this file directly via URL
    header("Location: ../ACCOUNT-FRONTEND/shipment.php");
    exit();
}