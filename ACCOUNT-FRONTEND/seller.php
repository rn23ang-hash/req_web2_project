<?php 
    // This MUST be the first thing in the file
    require '../PHP/session-script.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Management | EcoShop</title>
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
                    
                </div>
            </div>
        </section>
    </header>

    <div></div>

    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="account.php">Account Information</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors">
                <a href="cart.php">Cart</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="history.php">History </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="incoming.php">Incoming</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent border-b-2 border-white">
                Seller
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="../index.php">
                    <a href="../index.php">Home</a>
                </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent text-green-300">Settings</li>
        </ul>
    </nav>

    <main class="max-w-5xl mx-auto p-4 md:p-8 space-y-12">

        <section id="user-geninfo-account" class="w-full">
            <!-- Grandparent: Full width container -->
            <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-full flex flex-col items-stretch">

                <div class="text-left w-full flex flex-col items-stretch">
                    <h2 class="text-2xl font-bold mb-6 text-green-700">Seller Account</h2>

                    <?php if (isset($user['seller_active']) && $user['seller_active'] == 1): ?>
                        <!-- SELLER DASHBOARD VIEW (Shown when seller_active is 1) -->
                        <div class="mb-4 w-full">
                            <p class="text-xs text-gray-500 mb-1">Account Status</p>
                            <div class="border p-2 rounded mb-6 bg-green-50 text-green-700 font-bold flex items-center">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                Active Seller
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <a href="add-product.php" class="block w-full border-2 border-green-600 text-green-600 text-center font-bold py-3 rounded-lg hover:bg-green-50 transition">
                                    + Post New Product
                                </a>
                                <a href="my-inventory.php" class="block w-full bg-gray-800 text-white text-center font-bold py-3 rounded-lg hover:bg-gray-900 transition">
                                    Manage Inventory
                                </a>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- BECOME A SELLER VIEW (Shown when seller_active is 0) -->
                        <div class="flex flex-col w-full items-stretch">

                            <!-- Promo Box -->
                            <div class="bg-green-50 p-6 rounded-lg mb-6 border border-green-100 w-full">
                                <h3 class="text-xl font-bold text-green-800 mb-2">Become a Seller</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Have environmentally friendly products? We are looking for wooden utensils, biodegradable containers, glass items, and more! Join our community of eco-conscious sellers today.
                                </p>
                            </div>

                            <!-- Benefits Grid (3 columns on desktop) -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 text-sm text-gray-600 w-full">
                                <div class="flex items-center p-3 bg-gray-50 rounded border">
                                    <span class="text-green-500 font-bold mr-2">✔</span> Reach eco-conscious buyers
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded border">
                                    <span class="text-green-500 font-bold mr-2">✔</span> Easy inventory management
                                </div>
                                <div class="flex items-center p-3 bg-gray-50 rounded border">
                                    <span class="text-green-500 font-bold mr-2">✔</span> Secure transactions
                                </div>
                            </div>

                            <!-- Enable Form (Moved OUTSIDE the benefits grid to allow full width) -->
                            <form action="../PHP/q-enable-seller.php" method="post" class="w-full">
                                <button type="submit" class="w-full bg-green-600 text-white font-bold py-4 rounded-lg hover:bg-green-700 transition shadow-md text-lg">
                                    Enable Seller Account
                                </button>
                            </form>

                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </section>


    </main>

    <footer class="py-10 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>




    <script src="JS/script.js"></script>
</body>

</html>