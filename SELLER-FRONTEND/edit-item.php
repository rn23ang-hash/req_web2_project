<?php
require '../PHP/session-script.php';

// 1. Protection & ID Check
if (!isset($_SESSION['userId'])) {
    header("Location: ../USER-AUTH/login.php");
    exit();
}

$product_id = $_GET['id'] ?? null;

if (!$product_id) {
    header("Location: inventory.php?error=noid");
    exit();
}

try {
    // 2. Fetch the product details and verify it belongs to the logged-in seller
    $stmt = $conn->prepare("SELECT p.* FROM products p 
                            JOIN sellers s ON p.seller_id = s.id 
                            WHERE p.id = :pid AND s.user_id = :uid");
    $stmt->execute(['pid' => $product_id, 'uid' => $_SESSION['userId']]);
    $product = $stmt->fetch();

    if (!$product) {
        // Product not found or doesn't belong to this user
        header("Location: inventory.php?error=unauthorized");
        exit();
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
    <title>Edit Product | <?= htmlspecialchars($product['product_name']) ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <style>body { font-family: 'Lexend', sans-serif; }</style>
</head>

<body class="bg-gray-50 text-gray-800">

    <nav class="bg-white border-b border-gray-100 py-4 shadow-sm sticky top-0 z-20">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <a href="../index.php"><img src="../PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop Logo" class="h-10 w-auto"></a>
                <span class="text-gray-300">|</span>
                <span class="text-sm font-semibold text-gray-500 uppercase tracking-widest">Edit Listing</span>
            </div>
            <a href="inventory.php" class="text-sm font-bold text-green-600 hover:underline">Cancel & Return</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto p-6 md:p-12">
        <header class="mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900">Edit Product</h1>
            <p class="text-gray-500 mt-2">Modify the details for <span class="text-green-600 font-bold">"<?= htmlspecialchars($product['product_name']) ?>"</span></p>
        </header>

        <form action="../PHP/prodedit-script.php" method="POST" enctype="multipart/form-data" class="space-y-8">
            <!-- HIDDEN FIELD: The Product ID is required for the UPDATE query -->
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

            <!-- BASIC INFO -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100 space-y-6">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Product Name</label>
                    <input type="text" name="product_name" required value="<?= htmlspecialchars($product['product_name']) ?>"
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 outline-none transition">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Price (₱)</label>
                        <input type="number" step="0.01" name="price" required value="<?= $product['price'] ?>"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Current Stock</label>
                        <input type="number" name="stock" required value="<?= $product['stock'] ?>"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 outline-none transition">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Description</label>
                    <textarea name="description" rows="5" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 outline-none transition"><?= htmlspecialchars($product['product_description']) ?></textarea>
                </div>
            </div>

            <!-- IMAGE EDITING -->
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
                <label class="block text-sm font-bold text-gray-700 mb-4 uppercase tracking-wide">Product Image</label>
                <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-8">
                    <!-- Current Image Preview -->
                    <div class="w-32 h-32 rounded-2xl overflow-hidden border border-gray-100 bg-gray-50">
                        <img src="../PICTURES/PRODUCT-IMAGES/<?= $product['product_image'] ?? 'default-product.png' ?>" 
                             class="w-full h-full object-cover" alt="Current Image">
                    </div>
                    
                    <div class="flex-grow">
                        <p class="text-sm text-gray-500 mb-3">Upload a new image to replace the current one. Leave empty to keep the existing photo.</p>
                        <input type="file" name="product_image" 
                            class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    </div>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex items-center space-x-4 pt-4">
                <button type="submit" class="flex-grow bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-green-100 transition-all active:scale-95">
                    Save Changes
                </button>
                <a href="inventory.php" class="px-8 py-4 text-gray-400 font-bold hover:text-gray-600 transition">
                    Discard
                </a>
            </div>
        </form>
    </main>

    <footer class="py-12 text-center text-gray-400 text-sm">
        <p>EcoShop Seller Central • 2026</p>
    </footer>

</body>
</html>