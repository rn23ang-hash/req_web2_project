<?php
session_start();
include 'PHP/database.php';

$isLoggedIn = isset($_SESSION['user_id']);
$firstName = $isLoggedIn ? $_SESSION['first_name'] : 'Guest';

$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Our Products - EcoShop</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>

<body class="min-h-screen flex flex-col lcss-lexend">

    <div class="flex items-center justify-center">
        <img src="PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop Logo" class="w-12 h-auto">
    </div>
    
    <header class=" bg-green-800  shadow-md">
        <nav class="flex items-center justify-between px-6 py-4">

            <div class="relative">
                <input type="text" placeholder="Search products..."
                    class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">
                <button class="absolute right-2 top-2 text-gray-500 hover:text-green-600">Go</button>
            </div>



            <ul class="flex space-x-6 text-white font-medium">
                <li><a href="account.html" class="hover:text-green-600">Account</a></li>
                <li><a href="account.html#account-incoming_orders" class="hover:text-green-600">Orders</a></li>
                <li><a href="account.html#account-cart" class="hover:text-green-600">Cart</a></li>
                <li><a href="account.html#account-history" class="hover:text-green-600">History</a></li>
                <li><a href="help.html" class="hover:text-green-600">Help</a></li>
            </ul>

            <div class="flex items-center space-x-4">


            <?php if ($isLoggedIn): ?>
                <a href="account.php" class="flex items-center space-x-2" id="session-status-loggedin">
                    <img src="PICTURES/default-profile.svg" alt="Profile Picture" class="w-10 h-10 rounded-full border">
                    <span class="font-semibold text-white"><?php echo htmlspecialchars($firstName); ?></span>
                </a>
            <?php else: ?>
                <div class="flex space-x-2 session-status-default">
                    <a href="USER-AUTH/login.php"
                        class="px-5 py-3 font-semibold text-green-600 bg-white border-2 border-green-600 rounded-lg hover:bg-green-50 transition-colors">
                        Log in
                    </a>
                    <a href="USER-AUTH/signup.php"
                        class="px-5 py-3 font-semibold text-white bg-green-600 border-2 border-green-600 rounded-lg hover:bg-green-700 transition-colors">
                        Sign up
                    </a>
                </div>
            <?php endif; ?>
            </div>


        </nav>
    </header>

    <main class="">

        
    </main>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>

    <script src="JS/script.js"></script>
    <script src="JS/products.js"></script>
</body>
</html>