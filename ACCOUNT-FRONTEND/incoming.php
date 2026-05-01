<?php 
    // This MUST be the first thing in the file
    require '../PHP/session-script.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incoming | EcoShop</title>
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
            <li class="hover:text-white cursor-pointer transition-colors">
                <a href="cart.php">Cart</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
               <a href="history.php">History </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent border-b-2 border-white text-bold">
                Incoming
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

    <main class="max-w-5xl mx-auto p-4 md:p-8 space-y-12">

    
        <section id="account-incoming_items" class="bg-green-50 rounded-2xl p-6 border border-green-100">
            <h2 class="text-xl font-bold text-green-900 mb-4">Incoming Items</h2>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-green-100 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h3 class="font-bold text-lg text-gray-900" id="checkout-item-name-0">Item 0</h3>
                    <p class="text-sm text-gray-600">Seller: <span class="text-green-600">Seller 0</span> • ₱123.00</p>
                    <p class="text-sm font-medium text-blue-600 mt-1">Expected Arrival: <span id="arrival-date">March 10, 2026</span></p>
                </div>
                <button class="text-red-500 hover:text-red-700 text-sm font-semibold px-4 py-2 border border-red-100 hover:bg-red-50 rounded-lg transition-colors">
                    Cancel Order
                </button>
            </div>
        </section>
        
    </main>

    <footer class="py-10 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>

    


    <script src="JS/script.js"></script>
</body>
</html>