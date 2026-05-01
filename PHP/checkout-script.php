<?php
require 'session-script.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userId'])) {
    $uid = $_SESSION['userId'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    try {
        $conn->beginTransaction();

        // 1. Get all items from the user's cart
        $stmt = $conn->prepare("SELECT c.product_id, c.quantity, p.price 
                                FROM cart c 
                                JOIN products p ON c.product_id = p.id 
                                WHERE c.user_id = :uid");
        $stmt->execute(['uid' => $uid]);
        $cartItems = $stmt->fetchAll();

        if ($cartItems) {
            // 2. Insert each item into the orders table
            $orderStmt = $conn->prepare("INSERT INTO orders (user_id, product_id, quantity, total_price, shipping_address, contact_number, status) 
                                        VALUES (:uid, :pid, :qty, :total, :addr, :phone, 'Pending')");
            
            foreach ($cartItems as $item) {
                $itemTotal = $item['price'] * $item['quantity'];
                $orderStmt->execute([
                    'uid'   => $uid,
                    'pid'   => $item['product_id'],
                    'qty'   => $item['quantity'],
                    'total' => $itemTotal,
                    'addr'  => $address,
                    'phone' => $contact
                ]);
            }

            // 3. Clear the user's cart
            $clearCart = $conn->prepare("DELETE FROM cart WHERE user_id = :uid");
            $clearCart->execute(['uid' => $uid]);

            $conn->commit();
            header("Location: ../ACCOUNT-FRONTEND/history.php?order=success");
            exit();
        } else {
            header("Location: ../ACCOUNT-FRONTEND/cart.php");
            exit();
        }

    } catch (PDOException $e) {
        $conn->rollBack();
        die("Checkout Error: " . $e->getMessage());
    }
}