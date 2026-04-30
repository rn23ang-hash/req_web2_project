<?php
    session_start();
    include '../PHP/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup | EcoShop</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>
<body class="bg-gray-100 font-lexend">
    <header class="bg-white border-b p-4">
        <a href="index.html" id="return-main-page" class="text-green-600 hover:underline">Return to Landing Page</a>
    </header>

    <main class="flex flex-col items-center justify-center min-h-screen p-6 text-center bg-green-600">
        
        <div class="">

        <form action="../PHP/signup-script.php" id="signup-form" method="post" class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md flex flex-col text-left">

            <img src="../PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop logo" class="object-contain w-[30%] mx-auto mb-8">

            <h2 class="text-2xl font-bold mb-6">Signup</h2>

            <label for="email-signup" class="mb-1">Username or Email</label>
            <input id="email-signup" name="user_email" placeholder="Enter your username or email" type="email" class="border p-2 rounded mb-4 focus:outline-green-600">
            
            <label for="password-signup" class="mb-1">Password</label>
            <input id="password-signup" name="user_password" placeholder="Enter your password" type="password" class="border p-2 rounded mb-2 focus:outline-green-600">

            <label for="confirm-password-signup" class="mb-1">Confirm Password</label>
            <input id="confirm-password-signup" name="user_confirm_password" placeholder="Confirm your password" type="password" class="border p-2 rounded mb-2 focus:outline-green-600">

            <br class="mb-3 mt-3">

            <h2 class="font-bold mb-5">
                Personal Information
            </h2>

            <label for="firstname-signup" class="mb-1">First Name</label>
            <input id="firstname-signup" name="user_firstname" placeholder="Juan" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

            <label for="lastname-signup" class="mb-1">Last Name</label>
            <input id="lastname-signup" name="user_lastname" placeholder="Dela Cruz" type="text" class="border p-2 rounded mb-2 focus:outline-green-600">

            <br class="mb-3 mt-3">
            <label for="dob-signup">Date of Birth</label>
            <input id="dob-signup" name="user_dob" type="date" class="border p-2 rounded mb-2 focus:outline-green-600">


            <div id="error-box-signup" class="hidden bg-red-100 text-red-700 p-2 rounded mb-4">
                <span id="err-msg-login"></span>
            </div>

            <button id="confirm-signup" type="submit" class="bg-green-600 text-white mb-2 mt-4 font-bold py-2 rounded hover:bg-green-700 transition">
                Sign Up
            </button>
            
            <label for="redirect-to-login" class="mb-2">Already have an account?</label>

            <a id="redirect-to-login" href="login.php" class="py-2 font-bold text-center hover:underline hover:text-green-500">
                Login instead
            </a>

        </form>
            

        </div>
    </main>


    <script src="../JS/script.js" defer></script>
</body>
</html>