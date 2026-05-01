<?php
require '../PHP/session-script.php';

// Check if cart is empty
$checkCart = $conn->prepare("SELECT c.*, p.price, p.product_name FROM cart c JOIN products p ON c.product_id = p.id WHERE c.user_id = :uid");
$checkCart->execute(['uid' => $_SESSION['userId']]);
$items = $checkCart->fetchAll();

if (!$items) { 
    header("Location: cart.php"); 
    exit(); 
}

$total = 0;
foreach($items as $i) { 
    $total += ($i['price'] * $i['quantity']); 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout | EcoShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Lexend', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col items-center min-h-screen">

    <!-- Logo at the very top -->
    <div class="py-8">
        <a href="../index.php">
            <img src="../PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop Logo" class="w-24 h-auto hover:opacity-80 transition-opacity">
        </a>
    </div>

    <main class="max-w-2xl w-full mx-auto px-4 pb-12">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header Section -->
            <div class="bg-green-600 p-8 text-white">
                <h2 class="text-2xl font-bold">Finalize Your Order</h2>
                <p class="opacity-90 text-sm">Please confirm your delivery details below.</p>
            </div>

            <form action="../PHP/checkout-script.php" method="POST" class="p-8 space-y-8">
                
                <!-- Order Summary Card -->
                <div class="bg-green-50 p-6 rounded-2xl border border-green-100 flex justify-between items-center">
                    <div>
                        <p class="text-xs text-green-700 font-bold uppercase tracking-widest mb-1">Total Amount Due</p>
                        <p class="text-3xl font-black text-green-900">₱<?= number_format($total, 2) ?></p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-green-600 font-medium"><?= count($items) ?> Item(s)</p>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Shipping Address</label>
                    <textarea name="address" required 
                        class="w-full p-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all" 
                        placeholder="House No., Street, Barangay, City..."><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                </div>

                <!-- Contact Info -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Contact Number</label>
                    <input type="text" name="contact" required 
                        value="<?= htmlspecialchars($user['phone'] ?? '') ?>" 
                        class="w-full p-4 border border-gray-200 rounded-2xl focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all" 
                        placeholder="09xxxxxxxxx">
                    <p class="text-[10px] text-gray-400">We'll use this for delivery updates via SMS/Email.</p>
                </div>

                <!-- Payment Method -->
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-gray-700 uppercase tracking-wide">Payment Method</label>
                    <div class="p-4 border-2 border-green-500 bg-green-50 rounded-2xl flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-4 h-4 bg-green-500 rounded-full border-4 border-white ring-1 ring-green-500"></div>
                            <span class="font-bold text-green-700">Cash on Delivery (COD)</span>
                        </div>
                        <span class="text-[10px] font-bold uppercase bg-green-500 text-white px-2 py-1 rounded-md">Enabled</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-4 pt-4">
                    <button type="submit" class="w-full bg-green-600 text-white font-bold py-4 rounded-2xl hover:bg-green-700 transition shadow-lg shadow-green-100 active:scale-[0.98]">
                        Place Order ₱<?= number_format($total, 2) ?>
                    </button>
                    
                    <!-- Cancel Button -->
                    <a href="cart.php" class="w-full text-center text-gray-400 font-bold py-2 hover:text-red-500 transition-colors text-sm">
                        Cancel and return to cart
                    </a>
                </div>
            </form>
        </div>
    </main>

    <footer class="mt-auto py-8 text-center text-gray-400 text-xs">
        <p>EcoShop Secure Checkout • Lipa City, PH</p>
    </footer>

</body>
</html>