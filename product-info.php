<?php
require 'PHP/database.php';
session_start();

// 1. Get Product ID from URL
$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    header("Location: index.php");
    exit();
}

try {
    // 2. Fetch Product, Seller, and User details in one go
    $query = "SELECT p.*, s.shop_name, s.id AS seller_id, u.first_name, u.last_name 
              FROM products p
              JOIN sellers s ON p.seller_id = s.id
              JOIN users u ON s.user_id = u.id
              WHERE p.id = :id";
              
    $stmt = $conn->prepare($query);
    $stmt->execute(['id' => $product_id]);
    $product = $stmt->fetch();

    if (!$product) {
        die("Product not found.");
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($product['product_name']) ?> | EcoShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Lexend', sans-serif; }</style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Simple Breadcrumb -->
    <nav class="max-w-6xl mx-auto px-6 py-4 text-sm">
        <a href="index.php" class="text-gray-500 hover:text-green-600 transition">Marketplace</a>
        <span class="mx-2 text-gray-300">/</span>
        <a href="seller-info.php?id=<?= $product['seller_id'] ?>" class="text-gray-500 hover:text-green-600 transition"><?= htmlspecialchars($product['shop_name']) ?></a>
        <span class="mx-2 text-gray-300">/</span>
        <span class="text-green-700 font-semibold"><?= htmlspecialchars($product['product_name']) ?></span>
    </nav>

    <main class="max-w-6xl mx-auto p-4 md:p-6">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <div class="flex flex-col md:flex-row">
                
                <!-- LEFT: Image Gallery Section -->
                <div class="md:w-1/2 p-6 bg-gray-50 flex items-center justify-center">
                    <div class="relative w-full aspect-square bg-white rounded-2xl shadow-inner flex items-center justify-center overflow-hidden border border-gray-200">
                        <!-- Replace with actual image logic -->
                        <img src="PICTURES/product-placeholder.png" alt="Product Image" class="w-full h-full object-cover">
                        <span class="absolute top-4 left-4 bg-green-600 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                            Eco-Friendly
                        </span>
                    </div>
                </div>

                <!-- RIGHT: Product Details & Action -->
                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-between">
                    <div>
                        <!-- Seller Tag -->
                        <a href="seller-info.php?id=<?= $product['seller_id'] ?>" class="inline-flex items-center space-x-2 text-green-600 hover:text-green-700 transition mb-4">
                            <span class="bg-green-100 p-1 rounded-full">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"></path></svg>
                            </span>
                            <span class="text-sm font-bold uppercase tracking-wide"><?= htmlspecialchars($product['shop_name']) ?></span>
                        </a>

                        <h1 class="text-4xl font-extrabold text-gray-900 leading-tight mb-2">
                            <?= htmlspecialchars($product['product_name']) ?>
                        </h1>
                        
                        <div class="flex items-center space-x-4 mb-6">
                            <span class="text-3xl font-bold text-green-700">₱<?= number_format($product['price'], 2) ?></span>
                            <span class="text-sm text-gray-400">|</span>
                            <span class="text-sm <?= $product['product_quantity'] > 0 ? 'text-blue-600' : 'text-red-500' ?> font-semibold">
                                <?= $product['product_quantity'] ?> items available
                            </span>
                        </div>

                        <div class="border-t border-gray-100 pt-6">
                            <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-3">Product Description</h2>
                            <p class="text-gray-600 leading-relaxed">
                                <?= nl2br(htmlspecialchars($product['product_description'])) ?>
                            </p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 space-y-4">
                        <form action="PHP/add-to-cart.php" method="POST" class="flex items-center space-x-4">
                            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                            
                            <!-- Quantity Selector -->
                            <div class="flex items-center border-2 border-gray-100 rounded-xl">
                                <label class="px-4 text-xs font-bold text-gray-400 uppercase">Qty</label>
                                <input type="number" name="quantity" value="1" min="1" max="<?= $product['product_quantity'] ?>" 
                                       class="w-16 py-3 text-center font-bold focus:outline-none rounded-r-xl">
                            </div>

                            <button type="submit" class="flex-grow bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-200 transition-all active:scale-95">
                                Add to Cart
                            </button>
                        </form>
                        
                        <p class="text-center text-xs text-gray-400">
                            Secure Transaction • Quality Guaranteed
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Extra Seller Info Section -->
        <section class="mt-12 bg-green-50 rounded-3xl p-8 border border-green-100 flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center space-x-6">
                <img src="PICTURES/default-profile.svg" class="w-16 h-16 rounded-full border-2 border-white shadow-sm">
                <div>
                    <h3 class="font-bold text-lg text-gray-900">Sold by <?= htmlspecialchars($product['shop_name']) ?></h3>
                    <p class="text-sm text-gray-500">Representative: <?= htmlspecialchars($product['first_name']) ?></p>
                </div>
            </div>
            <a href="seller-info.php?id=<?= $product['seller_id'] ?>" class="mt-6 md:mt-0 px-6 py-3 bg-white text-green-700 font-bold rounded-xl border border-green-200 hover:bg-green-100 transition">
                Visit Shop Profile
            </a>
        </section>
    </main>

    <footer class="py-12 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project • 2026</p>
    </footer>

</body>
</html>