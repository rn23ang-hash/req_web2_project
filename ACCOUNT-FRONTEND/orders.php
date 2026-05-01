<?php
require '../PHP/session-script.php';

// Fetch Buyer's Orders
$query = "SELECT o.*, p.product_name, u.first_name AS seller_name 
          FROM orders o 
          JOIN products p ON o.product_id = p.id 
          JOIN sellers s ON p.seller_id = s.id
          JOIN users u ON s.user_id = u.id
          WHERE o.user_id = :uid 
          ORDER BY o.order_date DESC";
$stmt = $conn->prepare($query);
$stmt->execute(['uid' => $_SESSION['userId']]);
$myOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Orders | EcoShop</title>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-lexend bg-gray-50 text-gray-800">

    <body class="font-lexend bg-gray-50 text-gray-800">

    <header class="bg-white border-b border-green-100 py-6">
        <section class="max-w-5xl mx-auto px-4 flex items-center space-x-6">
            <div class="relative">
                <img class="h-20 w-20 rounded-full border-4 border-green-500 object-cover shadow-sm" src="../PICTURES/default-profile.svg" alt="User profile">
            </div>
            <div class="flex flex-col">
                <h1 id="user-fullname" class="text-2xl font-bold text-gray-900">
                    <?php echo htmlspecialchars($user['first_name'] . " " . $user['last_name']); ?>
                </h1>
                <div class="text-sm text-gray-500 space-y-1">
                    <p>Email: <span class="font-medium text-green-700"><?php echo htmlspecialchars($user['email']); ?></span></p>
                </div>
            </div>
        </section>
    </header>

    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="account.php">Account Info</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="cart.php">Cart</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-white">
                Orders
            </li>
            <li class="hover:text-white cursor-pointer transition-colors">
                <a href="shipment.php">Shipment </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="seller.php">Seller</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="../index.php">Home</a>
            </li>
            
        </ul>
    </nav>

    <main class="max-w-5xl mx-auto p-8">
        <section class="bg-white p-8 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-green-700">Purchase History</h2>
            
            <div class="space-y-4">
                <?php if (empty($myOrders)): ?>
                    <p class="text-gray-500">You haven't placed any orders yet.</p>
                <?php else: ?>
                    <?php foreach ($myOrders as $order): ?>
                        <div class="border p-4 rounded-xl flex justify-between items-center hover:bg-gray-50 transition">
                            <div>
                                <h3 class="font-bold text-lg"><?= htmlspecialchars($order['product_name']) ?></h3>
                                <p class="text-sm text-gray-500">Seller: <?= htmlspecialchars($order['seller_name']) ?></p>
                                <p class="text-xs text-gray-400"><?= date('M d, Y', strtotime($order['order_date'])) ?></p>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-700">₱<?= number_format($order['total_price'], 2) ?></p>
                                <span class="px-3 py-1 rounded-full text-xs font-bold 
                                    <?= $order['status'] == 'Pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' ?>">
                                    <?= $order['status'] ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>