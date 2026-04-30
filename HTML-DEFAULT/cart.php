<?php
    session_start();
    include '../PHP/database.php';

    //TO DO

    //*if session false
    //send users to ../index.php?error=nosession

    //*relevant data
    //first_name + last_name, email, location, payment info

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Dashboard</title>
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
                <h1 id="user-fullname" class="text-2xl font-bold text-gray-900">Placeholder Name</h1>
                <div class="text-sm text-gray-500 space-y-1">
                    <p>ID: <span id="user-email" class="font-medium text-green-700">user@example.com</span></p>
                    <p>Mobile: <span id="user-mobile">0912-345-6789</span></p>
                    <p>Type: <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Buyer</span></p>
                </div>
            </div>
        </section>
    </header>

    <div></div>

    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-white">
                <a href="account.php">Account Info</a>

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

    <main class="max-w-5xl mx-auto p-4 md:p-8 space-y-12">
        
        <section id="account-cart" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-bold mb-6 flex items-center">
                <span class="bg-green-600 w-2 h-6 rounded-full mr-3"></span>
                Your Cart
            </h2>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:bg-green-50 transition-colors">
                    <div class="flex items-center space-x-4">
                        <input id="checkout-item-1" type="checkbox" checked class="w-5 h-5 rounded text-green-600 focus:ring-green-500">
                        <div>
                            <h3 class="font-bold text-gray-800" id="checkout-item-name-1">Item 1</h3>
                            <p class="text-sm text-gray-500" id="checkout-item-seller">Seller: <span class="text-green-600">Seller 1</span></p>
                        </div>
                    </div>
                    <p class="font-bold text-lg text-gray-900">₱123.00</p>
                </div>

                <div class="flex items-center justify-between p-4 rounded-xl border border-gray-100 hover:bg-green-50 transition-colors">
                    <div class="flex items-center space-x-4">
                        <input id="checkout-item-2" type="checkbox" class="w-5 h-5 rounded text-green-600 focus:ring-green-500">
                        <div>
                            <h3 class="font-bold text-gray-800" id="checkout-item-name-2">Item 2</h3>
                            <p class="text-sm text-gray-500" id="checkout-item-seller">Seller: <span class="text-green-600">Seller 2</span></p>
                        </div>
                    </div>
                    <p class="font-bold text-lg text-gray-900">₱456.00</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-xl font-bold text-gray-900">Total: <span class="text-green-700">₱123.00</span></h2>
                <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-8 rounded-xl shadow-md transition-all active:scale-95">
                    <a href="confirmed.html">Check Out Selected</a>
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