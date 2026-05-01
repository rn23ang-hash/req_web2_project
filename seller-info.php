<?php
require 'PHP/database.php'; // We don't necessarily need session-guard if guests can view profiles

// 1. Get Seller ID from URL (e.g., seller-info.php?id=5)
$seller_id = $_GET['id'] ?? null;

if (!$seller_id) {
    header("Location: index.php");
    exit();
}

try {
    // 2. Fetch Seller & User Info
    $stmt = $conn->prepare("SELECT s.*, u.first_name, u.last_name, u.email 
                            FROM sellers s 
                            JOIN users u ON s.user_id = u.id 
                            WHERE s.id = :id");
    $stmt->execute(['id' => $seller_id]);
    $seller = $stmt->fetch();

    // 3. Fetch Seller's Products
    $stmt_prod = $conn->prepare("SELECT * FROM products WHERE seller_id = :id ORDER BY date_added DESC");
    $stmt_prod->execute(['id' => $seller_id]);
    $products = $stmt_prod->fetchAll();

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seller['shop_name'] ?? 'Seller Profile') ?> | EcoShop</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Lexend', sans-serif; }</style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Header Section (Seller Branding) -->
    <header class="bg-white border-b border-green-100 py-10 shadow-sm">
        <section class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8">
            <div class="relative">
                <img class="h-32 w-32 rounded-full border-4 border-green-500 object-cover shadow-md" 
                     src="PICTURES/default-profile.svg" alt="Shop Logo">
            </div>
            <div class="flex flex-col text-center md:text-left flex-grow">
                <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900"><?= htmlspecialchars($seller['shop_name']) ?></h1>
                        <p class="text-green-600 font-medium">Verified Seller • <?= htmlspecialchars($seller['first_name'] . " " . $seller['last_name']) ?></p>
                    </div>
                    <a href="index.php" class="mt-4 md:mt-0 text-sm font-semibold text-green-700 hover:underline">← Back to Marketplace</a>
                </div>
                <p class="mt-4 text-gray-600 max-w-2xl italic">
                    "<?= htmlspecialchars($seller['shop_description'] ?? 'No description available for this shop.') ?>"
                </p>
            </div>
        </section>
    </header>

    <main class="max-w-6xl mx-auto p-4 md:p-8">
        
        <!-- Products Grid Title -->
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                <span class="bg-green-600 w-2 h-8 rounded-full mr-3"></span>
                Products for Sale
            </h2>
            <span class="text-sm text-gray-500 font-medium"><?= count($products) ?> Items</span>
        </div>

        <!-- Products Grid -->
        <?php if (empty($products)): ?>
            <div class="bg-white rounded-xl p-12 text-center border-2 border-dashed border-gray-200">
                <p class="text-gray-500">This seller hasn't posted any products yet.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php foreach ($products as $product): ?>
                    <a href="product-info.php?id=<?= $product['id'] ?>" class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="h-48 bg-gray-200 overflow-hidden">
                            <!-- Replace with actual product image logic -->
                            <img src="PICTURES/product-placeholder.png" class="w-full h-full object-cover group-hover:scale-105 transition-transform">
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-800 truncate"><?= htmlspecialchars($product['product_name']) ?></h3>
                            <p class="text-green-700 font-bold text-lg mt-1">₱<?= number_format($product['price'], 2) ?></p>
                            <div class="mt-3 flex items-center justify-between text-xs text-gray-400">
                                <span>Stock: <?= $product['product_quantity'] ?></span>
                                <span class="bg-gray-100 px-2 py-1 rounded text-gray-500">View Details</span>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

    </main>

    <footer class="py-10 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>

</body>
</html>