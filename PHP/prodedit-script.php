<?php
require 'session-script.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['userId'])) {

    // 1. Capture Form Data
    $product_id  = $_POST['product_id'];
    
    // Switch to simple assignment or trim() to keep apostrophes as actual characters
    $name        = trim($_POST['product_name'] ?? 'Unnamed Product');
    $price       = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $stock       = filter_var($_POST['stock'], FILTER_SANITIZE_NUMBER_INT);
    
    // Fix: Match the 'name="description"' from your HTML and keep it raw
    $description = trim($_POST['description'] ?? '');

    try {
        // 2. Security Check: Verify ownership
        $check_stmt = $conn->prepare("SELECT product_image FROM products p 
                                     JOIN sellers s ON p.seller_id = s.id 
                                     WHERE p.id = :pid AND s.user_id = :uid");
        $check_stmt->execute(['pid' => $product_id, 'uid' => $_SESSION['userId']]);
        $existing_product = $check_stmt->fetch();

        if (!$existing_product) {
            header("Location: ../SELLER-FRONTEND/inventory.php?error=unauthorized");
            exit();
        }

        // 3. Image Handling
        $final_image_name = $existing_product['product_image']; 

        if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
            $file_ext = strtolower(pathinfo($_FILES['product_image']['name'], PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'webp'];

            if (in_array($file_ext, $allowed_exts)) {
                $new_file_name = "prod_" . uniqid('', true) . "." . $file_ext;
                $upload_path = "../PICTURES/PRODUCT-IMAGES/" . $new_file_name;

                if (move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_path)) {
                    if ($existing_product['product_image'] && $existing_product['product_image'] != 'default-product.png') {
                        @unlink("../PICTURES/PRODUCT-IMAGES/" . $existing_product['product_image']);
                    }
                    $final_image_name = $new_file_name;
                }
            }
        }

        // 4. Update the Database
        $sql = "UPDATE products SET 
                product_name = :name, 
                price = :price, 
                stock = :stock, 
                product_description = :descr, 
                product_image = :img 
                WHERE id = :pid";

        $update_stmt = $conn->prepare($sql);
        $update_stmt->execute([
            'name'  => $name,
            'price' => $price,
            'stock' => $stock,
            'descr' => $description,
            'img'   => $final_image_name,
            'pid'   => $product_id
        ]);

        header("Location: ../SELLER-FRONTEND/inventory.php?update=success");
        exit();

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }

} else {
    header("Location: ../index.php");
    exit();
}