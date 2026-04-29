<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | EcoShop</title>
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

        <form action="../PHP/login-script.php" id="login-form" method="post" class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md flex flex-col text-left">

            <img src="../PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop logo" class="object-contain w-[30%] mx-auto mb-8">

            <h2 class="text-2xl font-bold mb-6">Login</h2>

            <label for="username-login" class="mb-1">Username or Email</label>
            <input id="username-login" placeholder="Enter your username or email" type="email" class="border p-2 rounded mb-4 focus:outline-green-600">
            
            <label for="password-login" class="mb-1">Password</label>
            <input id="password-login" placeholder="Enter your password" type="password" class="border p-2 rounded mb-2 focus:outline-green-600">
            
            <a href="password-help.html" class="text-sm text-green-600 hover:underline mb-4">Forgot Password?</a>

            <div id="error-box-login" class="hidden bg-red-100 text-red-700 p-2 rounded mb-4">
                <span id="err-msg-login"></span>
            </div>

            <button id="confirm-login" type="submit" class="bg-green-600 text-white mb-2 font-bold py-2 rounded hover:bg-green-700 transition">
                Login
            </button>
            
            <label for="redirect-to-signup" class="mb-2">Don't have an account?</label>
            <!-- <button id="redirect-to-signup" onclick="redirectSignUp()" class="py-2 font-bold hover:underline hover:text-green-500">
                Sign up instead
            </button> -->

            <a id="redirect-to-signup" href="signup.php" class="py-2 font-bold text-center hover:underline hover:text-green-500">
                Create an acocunt instead
            </a>

            <input type="submit" value="Submit">

        </form>
            

        </div>
    </main>


    <script src="../JS/script.js"></script>
</body>
</html>