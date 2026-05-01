<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userId'])) {
    
    // 1. Fetch the actual Seller ID from the database using the Session
    // This is SAFER than trusting a hidden input from the form
    try {
        $seller_check = $conn->prepare("SELECT id FROM sellers WHERE user_id = :uid");
        $seller_check->execute(['uid' => $_SESSION['userId']]);
        $seller = $seller_check->fetch();

        if (!$seller) {
            header("Location: ../SELLER-FRONTEND/add-item.php?error=notaseller");
            exit();
        }
        $seller_id = $seller['id'];

        // 2. Sanitize inputs
        $product_name = $_POST['product_name'] ?? 'Unnamed Product';
        $description  = $_POST['product_description'] ?? '';
        $price        = $_POST['price'] ?? 0;
        $stock        = $_POST['stock'] ?? 0; // Matching your form's 'quantity' name

        // 3. Image Logic
        $image_name = "default-product.png"; 
        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
            $file_ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
            $new_file_name = "prod_" . uniqid('', true) . "." . $file_ext;
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], "../PICTURES/PRODUCT-IMAGES/" . $new_file_name)) {
                $image_name = $new_file_name;
            }
        }

        // 4. Database Insertion (Matching your column names exactly)
        $sql = "INSERT INTO products (product_name, product_description, price, stock, seller_id, date_added) 
                VALUES (:name, :descr, :price, :stock, :sid, NOW())";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'name'  => $product_name,
            'descr' => $description,
            'price' => $price,
            'stock' => $stock,
            'sid'   => $seller_id
        ]);

        header("Location: ../SELLER-FRONTEND/inventory.php?upload=success");
        exit();

    } catch (PDOException $e) {
        // This will tell you EXACTLY what went wrong in your browser
        die("Database Error: " . $e->getMessage()); 
    }
}