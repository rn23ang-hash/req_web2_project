<?php
require '../PHP/session-script.php';

// Fetch Orders for the Seller (Incoming shipments)
// This query looks for products owned by the logged-in user's seller account
$query = "SELECT o.*, p.product_name, u.first_name AS buyer_name, o.shipping_address 
          FROM orders o 
          JOIN products p ON o.product_id = p.id 
          JOIN sellers s ON p.seller_id = s.id
          JOIN users u ON o.user_id = u.id
          WHERE s.user_id = :uid 
          ORDER BY o.order_date DESC";

$stmt = $conn->prepare($query);
$stmt->execute(['uid' => $_SESSION['userId']]);
$shipments = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipments | EcoShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="font-lexend bg-gray-50 text-gray-800">

    <!-- Header Profile Section -->
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

    <!-- Navigation Bar -->
    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="account.php">Account Info</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="cart.php">Cart</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="orders.php">Orders</a>
            </li>
            <li class="border-b-2 border-white hover:text-white cursor-pointer transition-colors">
                Shipment
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="seller.php">Seller</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="../index.php">Home</a>
            </li>
            
        </ul>
    </nav>

    <main class="max-w-5xl mx-auto p-4 md:p-8">
        <section class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <h2 class="text-2xl font-bold mb-8 flex items-center text-gray-900">
                <span class="bg-green-600 w-2 h-7 rounded-full mr-3"></span>
                Incoming & Outgoing Shipments
            </h2>

            <div class="space-y-6">
                <?php if (empty($shipments)): ?>
                    <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                        <p class="text-gray-500 font-medium">No shipment requests found.</p>
                        <p class="text-sm text-gray-400">Orders from buyers will appear here.</p>
                    </div>
                <?php else: ?>
                    <?php foreach ($shipments as $s): ?>
                        <div class="group bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-md hover:border-green-100 transition-all">
                            <div class="flex flex-col md:flex-row justify-between gap-6">
                                
                                <!-- Buyer and Delivery Details -->
                                <div class="space-y-3">
                                    <div class="flex items-center space-x-2">
                                        <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] font-bold uppercase rounded tracking-wider">Buyer</span>
                                        <span class="font-bold text-gray-800"><?= htmlspecialchars($s['buyer_name']) ?></span>
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900"><?= htmlspecialchars($s['product_name']) ?></h3>
                                        <p class="text-sm text-gray-500 mt-1 flex items-start">
                                            <span class="mr-1">📍</span>
                                            <?= htmlspecialchars($s['shipping_address']) ?>
                                        </p>
                                    </div>

                                    <div class="flex items-center text-sm text-gray-600 bg-gray-50 p-2 rounded-lg inline-block">
                                        <span class="mr-2">📞</span>
                                        <span class="font-medium"><?= htmlspecialchars($s['contact_number']) ?></span>
                                    </div>
                                </div>

                                <!-- Order Status and Actions -->
                                <div class="flex flex-col justify-between items-end min-w-[150px]">
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest">Grand Total</p>
                                        <p class="text-2xl font-black text-green-700">₱<?= number_format($s['total_price'], 2) ?></p>
                                        <p class="text-[10px] text-gray-400 mt-1">Payment: <span class="text-gray-600 font-bold">COD</span></p>
                                    </div>

                                    <div class="mt-4">
                                        <?php if($s['status'] == 'Pending'): ?>
                                            <form action="../PHP/shipment-update.php" method="POST">
                                                <input type="hidden" name="order_id" value="<?= $s['id'] ?>">
                                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-xl text-sm font-bold transition-all active:scale-95 shadow-lg shadow-green-100">
                                                    Mark as Shipped
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <span class="flex items-center text-green-600 font-bold text-sm bg-green-50 px-4 py-2 rounded-xl border border-green-100">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"/></svg>
                                                Order Shipped
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <footer class="py-10 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>

</body>

</html>