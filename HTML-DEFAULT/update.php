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


                        <h2 class="text-2xl font-bold mb-6"></h2>

                        <label for="email-update" class="mb-1">Username or Email</label>
                        <input id="email-update" name="user_email" placeholder="Enter your username or email" type="email" class="border p-2 rounded mb-4 focus:outline-green-600">

                        <label for="password-update" class="mb-1">Password</label>
                        <input id="password-update" name="user_password" placeholder="Enter your password" type="password" class="border p-2 rounded mb-2 focus:outline-green-600">

                        <label for="confirm-password-update" class="mb-1">Confirm Password</label>
                        <input id="confirm-password-update" name="user_confirm_password" placeholder="Confirm your password" type="password" class="border p-2 rounded mb-2 focus:outline-green-600">

                        <br class="mb-3 mt-3">

                        <h2 class="font-bold mb-5">
                            Personal Information
                        </h2>

                        <label for="firstname-update" class="mb-1">First Name</label>
                        <input id="firstname-update" name="user_firstname" placeholder="Juan" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                        <label for="lastname-update" class="mb-1">Last Name</label>
                        <input id="lastname-update" name="user_lastname" placeholder="Dela Cruz" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                        <br class="mb-3 mt-3">
                        <label for="dob-update">Date of Birth</label>
                        <input id="dob-update" name="user_dob" type="date" class="border p-2 rounded mb-2 focus:outline-green-600">


                        <div id="error-box-update" class="hidden bg-red-100 text-red-700 p-2 rounded mb-4">
                            <span id="err-msg-login"></span>
                        </div>

                        <button id="confirm-update" type="submit" class="bg-green-600 text-white mb-2 mt-4 font-bold py-2 rounded hover:bg-green-700 transition">
                            Sign Up
                        </button>

                        <label for="redirect-to-login" class="mb-2">Already have an account?</label>

                        <a id="redirect-to-login" href="login.php" class="py-2 font-bold text-center hover:underline hover:text-green-500">
                            Login instead
                        </a>

                    </form>

                    <div class="mb-1">
                        <h3>Addresses</h3>
                        <div>
                            <button id="add-address">Add Address</button>
                        </div>
                        <div>
                            <form action="" method="post" class="flex flex-col">
                                <label for="address-country">Country</label>
                                <input id="address-country" value="Philippines" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                                <label for="address-province">Province</label>
                                <input id="address-province" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                                <label for="address-municipality">Municipality</label>
                                <input id="address-municipality" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                                <label for="address-barangay">Barangay</label>
                                <input id="address-barangay" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                                <label for="address-street">Street</label>
                                <input id="address-street" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

                                <input value="Confirm" type="submit">
                            </form>

                        </div>
                        <div>
                            <ol>
                                <li></li>
                            </ol>
                        </div>
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