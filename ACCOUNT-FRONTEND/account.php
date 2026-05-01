<?php
require '../PHP/session-script.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account | EcoShop</title>
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
                    <p>Email: <span class="font-medium text-green-700"><?php echo htmlspecialchars($user['email']); ?></span></p>
                </div>
            </div>
        </section>
    </header>

    <div></div>

    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent border-b-2 border-white text-bold">
                Account Information
            </li>
            <li class="hover:text-white cursor-pointer transition-colors">
                <a href="cart.php">Cart</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="history.php">History </a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="shipment.php">Incoming</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="seller.php">Seller</a>
            </li>
            <li class="hover:text-white cursor-pointer transition-colors border-b-2 border-transparent">
                <a href="../index.php">
                    <a href="../index.php">Home</a>
                </a>
            </li>
            
        </ul>
    </nav>



    <main class="max-w-5xl mx-auto p-4 md:p-8 space-y-12">

        <section id="user-geninfo-account" class="">
            <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w flex flex-col items-stretch">

                <div class="text-left w-full">
                    <h2 class="text-2xl font-bold mb-6 text-green-700">Account</h2>

                    <!-- EMAIL SECTION -->
                    <p class="font-bold mb-1">Email Address</p>
                    <p class="text-xs text-gray-500 mb-1">Current Email</p>
                    <div class="border p-2 rounded mb-4 bg-gray-100 text-gray-600">
                        <?= htmlspecialchars($user['email'] ?? 'Loading...') ?>
                    </div>

                    <!-- PASSWORD SECTION -->
                    <p class="font-bold mb-1">Password</p>
                    <div class="mb-4 text-sm">
                        Last Changed: <span class="font-bold text-gray-600"><?= htmlspecialchars($user['pwd_last_updated'] ?? 'Unknown') ?></span>
                    </div>

                    <hr class="mb-6 mt-2 border-gray-100">

                    <h2 class="font-bold mb-5">Personal Information</h2>

                    <!-- First Name -->
                    <p class="text-xs text-gray-500 mb-1">Current First Name</p>
                    <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 italic">
                        <?= htmlspecialchars($user['first_name'] ?? '') ?>
                    </div>

                    <!-- Last Name -->
                    <p class="text-xs text-gray-500 mb-1">Current Last Name</p>
                    <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 italic">
                        <?= htmlspecialchars($user['last_name'] ?? '') ?>
                    </div>

                    <!-- Date of Birth -->
                    <p class="text-xs text-gray-500 mb-1">Current Date of Birth</p>
                    <div class="border p-2 rounded mb-6 bg-gray-100 text-gray-600 italic">
                        <?= htmlspecialchars($user['date_of_birth'] ?? '') ?>
                    </div>

                    <hr class="mb-6 mt-2 border-gray-100">

                    <h2 id="location-update" class="font-bold mb-5">Location Information</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                        <div class="flex flex-col">
                            <p class="text-xs text-gray-500 mb-1">Province</p>
                            <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 text-sm italic">
                                <?= htmlspecialchars($user['province'] ?? '') ?>
                            </div>
                        </div>

                        <div class="flex flex-col">
                            <p class="text-xs text-gray-500 mb-1">Municipality</p>
                            <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 text-sm italic">
                                <?= htmlspecialchars($user['municipality'] ?? '') ?>
                            </div>
                        </div>
                    </div>

                    <!-- Street -->
                    <p class="text-xs text-gray-500 mb-1">Street Address</p>
                    <div class="border p-2 rounded mb-6 bg-gray-100 text-gray-600 italic">
                        <?= htmlspecialchars($user['street'] ?? '') ?>
                    </div>

                    <a href="update.php" class="block w-full bg-green-600 text-center text-white mb-2 mt-4 font-bold py-2 rounded hover:bg-green-700 transition">
                        Edit Account Data
                    </a>
                </div>

                <!-- Separated Logout Form -->
                <form action="../PHP/clear-session-script.php" id="logout-form" method="post" class="w-full">
                    <button type="submit" class="w-full bg-red-600 text-white mb-2 mt-2 font-bold py-2 rounded hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>

            </div>


        </section>


    </main>

    <footer class="py-10 text-center text-gray-400 text-sm">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>




    <script src="JS/script.js"></script>
</body>

</html>