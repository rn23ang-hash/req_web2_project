<?php 
    // This MUST be the first thing in the file
    require '../PHP/session-script.php'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History | EcoShop</title>
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
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent border-b-2 border-white">
               History
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

    <main class="max-w-5xl mx-auto p-4 md:p-8 space-y-12">


        <section id="account-history" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-900">History</h2>
                <p class="text-sm text-gray-500 italic">Sorted by most recent activity</p>
            </div>
            
            <div class="overflow-hidden rounded-xl border border-gray-100">
                <div class="bg-gray-50 p-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm border-b">
                    <div><p class="text-gray-400 uppercase text-xs font-bold">Date</p><span id="item-order-date">Jan 1, 2026</span></div>
                    <div><p class="text-gray-400 uppercase text-xs font-bold">Item</p><span id="item-name" class="font-medium text-green-700">Broom Set</span></div>
                    <div><p class="text-gray-400 uppercase text-xs font-bold">Qty</p><span id="item-quantity">1</span></div>
                    <div><p class="text-gray-400 uppercase text-xs font-bold">Total</p><span id="item-price" class="font-bold">₱100.00</span></div>
                </div>
                <div class="p-4 text-sm text-gray-600 bg-white">
                    Seller: <span id="seller-name" class="text-green-600 font-medium">EcoSeller</span>
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