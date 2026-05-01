<?php
require '../PHP/session-script.php';

// 1. Protection: Ensure user is logged in AND is a seller
if (!isset($_SESSION['userId'])) {
    header("Location: ../USER-AUTH/login.php");
    exit();
}

try {
    // 2. Fetch Seller ID
    $stmt = $conn->prepare("SELECT id FROM sellers WHERE user_id = :uid");
    $stmt->execute(['uid' => $_SESSION['userId']]);
    $seller = $stmt->fetch();

    if (!$seller) {
        header("Location: ../ACCOUNT-FRONTEND/seller.php?error=not_a_seller");
        exit();
    }

    // 3. Fetch all products for this seller
    $prod_stmt = $conn->prepare("SELECT * FROM products WHERE seller_id = :sid ORDER BY date_added DESC");
    $prod_stmt->execute(['sid' => $seller['id']]);
    $my_products = $prod_stmt->fetchAll();
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Inventory | EcoShop Seller</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-100 py-4 shadow-sm sticky top-0 z-20">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="../index.php" class="flex items-center transition hover:opacity-80">
                    <!-- Resized here: h-10 is roughly 40px -->
                    <img src="../PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop Logo" class="h-10 w-auto">
                </a>
                <span class="text-gray-300">|</span>
                <span class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Inventory</span>
            </div>
            <div class="flex items-center space-x-4">
                <a href="../ACCOUNT-FRONTEND/seller.php" class="text-sm font-medium text-gray-600 hover:text-green-600 transition">Seller Dashboard</a>
                <a href="add-items.php" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition shadow-sm">
                    + Add New Item
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto p-6 md:p-8">

        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-extrabold text-gray-900">Manage Inventory</h1>
                <p class="text-sm text-gray-500">Track and update your product listings and stock levels.</p>
            </div>
            <div class="flex space-x-2">
                <div class="bg-white px-4 py-2 rounded-xl border border-gray-200 shadow-sm text-center">
                    <p class="text-xs text-gray-400 font-bold uppercase">Total Items</p>
                    <p class="text-lg font-bold text-green-700"><?= count($my_products) ?></p>
                </div>
            </div>
        </header>

        <!-- Inventory Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Product</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Price</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Stock</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase">Status</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-400 uppercase text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if (empty($my_products)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    No products found. Start by adding your first item!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($my_products as $product): ?>
                                <tr class="hover:bg-green-50/30 transition">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-lg bg-gray-100 flex-shrink-0 flex items-center justify-center text-gray-400">
                                                📦
                                            </div>
                                            <span class="font-bold text-gray-800 truncate max-w-xs"><?= htmlspecialchars($product['product_name']) ?></span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-semibold text-gray-700">
                                        ₱<?= number_format($product['price'], 2) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-medium"><?= $product['stock'] ?></span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php if ($product['stock'] <= 0): ?>
                                            <span class="px-2 py-1 bg-red-100 text-red-700 text-[10px] font-bold uppercase rounded-md">Out of Stock</span>
                                        <?php elseif ($product['stock'] <= 5): ?>
                                            <span class="px-2 py-1 bg-orange-100 text-orange-700 text-[10px] font-bold uppercase rounded-md">Low Stock</span>
                                        <?php else: ?>
                                            <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded-md">Active</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <div class="flex justify-end space-x-2">
                                            <a href="edit-item.php?id=<?= $product['id'] ?>" class="p-2 text-gray-400 hover:text-green-600 transition">
                                                ⚙️
                                            </a>
                                            <form action="../PHP/delete-item.php" method="POST" onsubmit="return confirm('Delete this product permanently?');">
                                                <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <footer class="py-12 text-center text-gray-400 text-sm">
        <p>EcoShop Seller Dashboard • Managed via OM-BSIT</p>
    </footer>

</body>

</html>