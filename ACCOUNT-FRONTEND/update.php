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
    <title>Account Update | EcoShop Management</title>
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
                    <p>Type: <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded-full text-xs font-semibold">Buyer</span></p>
                </div>
            </div>
        </section>
    </header>

    <div></div>

    <nav class="bg-green-700 shadow-lg sticky top-0 z-10">
        <ul class="max-w-5xl mx-auto flex space-x-8 text-green-50 font-medium p-4">
            <li class="hover:text-white cursor-pointer transition-colors">
                <a href="cart.php">Cart</a>
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

        <section id="user-geninfo-account" class="">
            <h1 class="font-bold text-3x1 mb-2">Edit Account Information</h1>
            <div>
                <div>
                    <form action="../PHP/change-script.php" id="update-form" method="post" class="bg-white p-8 rounded-xl shadow-lg w-full max-w flex flex-col text-left">

                        <h2 class="text-2xl font-bold mb-6 text-green-700">Account Settings</h2>

                        <!-- EMAIL SECTION -->
                        <p class="font-bold mb-1">Email Address</p>
                        <p class="text-xs text-gray-500 mb-1">Current Email</p>
                        <!-- Placeholder: Replace with PHP variable later -->
                        <div class="border p-2 rounded mb-4 bg-gray-100 text-gray-600">
                            example@email.com
                        </div>

                        <label for="email-update" class="mb-1 text-sm">New Email</label>
                        <input id="email-update" name="user_email" placeholder="Enter new email" type="email" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <hr class="mb-6 mt-2 border-gray-100">

                        <!-- PASSWORD SECTION -->
                        <p class="font-bold mb-3">Security</p>
                        <label for="old-password-update" class="mb-1 text-sm">Verify Current Password</label>
                        <input id="old-password-update" name="old_password" placeholder="Required to save any changes" type="password" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <label for="password-update" class="mb-1 text-sm">New Password</label>
                        <input id="password-update" name="new_password" placeholder="Leave blank to keep current" type="password" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <label for="confirm-password-update" class="mb-1 text-sm">Confirm New Password</label>
                        <input id="confirm-password-update" name="user_confirm_password" placeholder="Confirm new password" type="password" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <hr class="mb-6 mt-2 border-gray-100">

                        <!-- PERSONAL INFORMATION -->
                        <h2 class="font-bold mb-5">Personal Information</h2>

                        <!-- First Name -->
                        <p class="text-xs text-gray-500 mb-1">Current First Name</p>
                        <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 italic">Current First Name...</div>
                        <label for="firstname-update" class="mb-1 text-sm text-green-700 font-medium">Update First Name</label>
                        <input id="firstname-update" name="user_firstname" placeholder="New First Name" type="text" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <!-- Last Name -->
                        <p class="text-xs text-gray-500 mb-1">Current Last Name</p>
                        <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 italic">Current Last Name...</div>
                        <label for="lastname-update" class="mb-1 text-sm text-green-700 font-medium">Update Last Name</label>
                        <input id="lastname-update" name="user_lastname" placeholder="New Last Name" type="text" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <!-- DOB -->
                        <p class="text-xs text-gray-500 mb-1">Current Date of Birth</p>
                        <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 italic">00/00/0000</div>
                        <label for="dob-update" class="mb-1 text-sm text-green-700 font-medium">Update Date of Birth</label>
                        <input id="dob-update" name="user_dob" type="date" class="border p-2 rounded mb-6 focus:outline-green-600">

                        <hr class="mb-6 mt-2 border-gray-100">

                        <!-- LOCATION INFORMATION -->
                        <h2 id="location-update" class="font-bold mb-5">Location Information</h2>

                        <!-- Province & Municipality Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-4">
                            <div class="flex flex-col">
                                <p class="text-xs text-gray-500 mb-1">Current Province</p>
                                <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 text-sm italic">Example: Laguna</div>
                                <label for="address-province" class="text-xs font-bold text-green-700">New Province</label>
                                <input id="address-province" name="user_province" type="text" class="border p-2 rounded mb-4 focus:outline-green-600">
                            </div>

                            <div class="flex flex-col">
                                <p class="text-xs text-gray-500 mb-1">Current Municipality</p>
                                <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 text-sm italic">Example: Biñan</div>
                                <label for="address-municipality" class="text-xs font-bold text-green-700">New Municipality</label>
                                <input id="address-municipality" name="user_municipality" type="text" class="border p-2 rounded mb-4 focus:outline-green-600">
                            </div>
                        </div>

                        <!-- Street -->
                        <p class="text-xs text-gray-500 mb-1">Current Street Address</p>
                        <div class="border p-2 rounded mb-2 bg-gray-100 text-gray-600 italic">Current Street...</div>
                        <label for="address-street" class="mb-1 text-sm text-green-700 font-medium">Update Street</label>
                        <input id="address-street" name="user_street" type="text" class="border p-2 rounded mb-6 focus:outline-green-600">


                        <!-- FORM ACTIONS -->
                        <div id="error-box-update" class="hidden bg-red-100 text-red-700 p-2 rounded mb-4">
                            <span id="err-msg-login"></span>
                        </div>

                        <button id="confirm-update" type="submit" class="bg-green-600 text-white mb-2 mt-4 font-bold py-2 rounded hover:bg-green-700 transition">
                            Save All Changes
                        </button>

                        <p class="text-red-500 text-[10px] uppercase tracking-wider font-bold text-center">
                            Notice: Empty fields will not be updated.
                        </p>

                        <a id="redirect-to-login" href="account.php" class="py-4 font-bold text-center hover:underline hover:text-red-500 text-gray-400 text-sm">
                            Cancel and Return to Account
                        </a>
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