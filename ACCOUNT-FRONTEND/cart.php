<?php
// This MUST be the first thing in the file
require '../PHP/session-script.php';


// Fetch cart items with Product and Seller details
$query = "SELECT 
                c.id AS cart_id, 
                c.quantity, 
                p.product_name, 
                p.price, 
                u.first_name AS seller_name
            FROM cart c
            JOIN products p ON c.product_id = p.id
            JOIN sellers s ON p.seller_id = s.id
            JOIN users u ON s.user_id = u.id
            WHERE c.user_id = :uid";

$stmt = $conn->prepare($query);
$stmt->execute(['uid' => $_SESSION['userId']]);
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$grandTotal = 0;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart | EcoShop</title>
    <link rel="stylesheet" href="">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>

<body class="font-lexend bg-gray-50 text-gray-800">

    <header class="bg-white border-b border-green-100 py-6">
        <section class="max-w-5xl mx-auto px-4 flex items-center space-x-6">
            <div class="relative">
                <img class="h-20 w-20 rounded-full border-4 border-green-500 object-cover shadow-sm" src="../PICTURES/default-profile.svg" alt="User profile">
                <!-- <span class="absolute bottom-0 right-0 h-5 w-5 bg-green-500 border-2 border-white rounded-full"></span> -->
            </div>
            <div class="flex flex-col">
                <h1 id="user-fullname" class="text-2xl font-bold text-gray-900">
                    <?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?>
                </h1>
                <div class="text-sm text-gray-500 space-y-1">
                    <p>ID: <span id="user-email" class="font-medium text-green-700">user@example.com</span></p>
                    <p>Type: <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Buyer</span></p>
                </div>
            </div>
        </section>
    </header>

    <div></div>

    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors">
                <a href="account.php">Account Info</a>
            </li>
            <li class="border-b-2 border-white hover:text-white cursor-pointer transition-colors">
                Cart
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="history.php">History </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="incoming.php">Incoming</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="seller.php">Seller</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="../index.php">
                    <a href="../index.php">Home</a>
                </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent text-green-300">Settings</li>
        </ul>
    </nav>

    <section id="account-cart" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        <h2 class="text-xl font-bold mb-6 flex items-center">
            <span class="bg-green-600 w-2 h-6 rounded-full mr-3"></span>
            Your Cart
        </h2>

        <div class="space-y-4">
            <?php if (empty($cartItems)): ?>
                <p class="text-gray-500 text-center py-10">Your cart is empty.</p>
            <?php else: ?>
                <?php foreach ($cartItems as $item):
                    $itemTotal = $item['price'] * $item['quantity'];
                    $grandTotal += $itemTotal;
                ?>
                    <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:bg-green-50 transition-colors">
                        <div class="flex items-center space-x-4">
                            <!-- We use the cart_id as the value for checkboxes -->
                            <input name="selected_items[]" value="<?= $item['cart_id'] ?>" type="checkbox" checked class="w-5 h-5 rounded text-green-600 focus:ring-green-500">
                            <div>
                                <h3 class="font-bold text-gray-800"><?= htmlspecialchars($item['product_name']) ?></h3>
                                <p class="text-sm text-gray-500">
                                    Seller: <span class="text-green-600"><?= htmlspecialchars($item['seller_name']) ?></span>
                                    <?php if ($item['quantity'] > 1): ?>
                                        <span class="ml-2 px-2 py-0.5 bg-gray-100 rounded text-xs">Qty: <?= $item['quantity'] ?></span>
                                    <?php endif; ?>
                                </p>
                            </div>
                        </div>
                        <p class="font-bold text-lg text-gray-900">₱<?= number_format($itemTotal, 2) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Total and Checkout -->
        <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-xl font-bold text-gray-900">Total: <span class="text-green-700">₱<?= number_format($grandTotal, 2) ?></span></h2>
            <form action="PHP/checkout-process.php" method="POST">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all active:scale-95">
                    Check Out Selected
                </button>
            </form>
        </div>
    </section>

    <footer class="py-10 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>




    <script src="JS/script.js"></script>
</body>

</html>