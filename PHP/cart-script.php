<?php
require 'session-script.php'; // Ensures $conn and $_SESSION['userId'] are ready

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    
    $action = $_POST['action'];
    $user_id = $_SESSION['userId'];

    if ($action == 'add') {
        $product_id = $_POST['product_id'];
        $quantity = (int)$_POST['quantity'];

        try {
            // 1. Check if the item is already in the cart for this user
            $check = $conn->prepare("SELECT id, quantity FROM cart WHERE user_id = :uid AND product_id = :pid");
            $check->execute(['uid' => $user_id, 'pid' => $product_id]);
            $existing = $check->fetch();

            if ($existing) {
                // 2. Update quantity if it exists
                $new_qty = $existing['quantity'] + $quantity;
                $update = $conn->prepare("UPDATE cart SET quantity = :qty WHERE id = :cid");
                $update->execute(['qty' => $new_qty, 'cid' => $existing['id']]);
            } else {
                // 3. Insert new row if it doesn't
                $insert = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (:uid, :pid, :qty)");
                $insert->execute(['uid' => $user_id, 'pid' => $product_id, 'qty' => $quantity]);
            }

            header("Location: " . $_SERVER['HTTP_REFERER'] . "?cart=success");
            exit();

        } catch (PDOException $e) {
            die("Cart Error: " . $e->getMessage());
        }
    }
}