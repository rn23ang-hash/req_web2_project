<?php
session_start();
include 'PHP/database.php';

$isLoggedIn = isset($_SESSION['userId']);
$firstName = 'Guest';

if ($isLoggedIn) {
    $stmtUser = $conn->prepare("SELECT first_name FROM users WHERE id = :id");
    $stmtUser->execute(['id' => $_SESSION['userId']]);
    $userRow = $stmtUser->fetch();
    if ($userRow) {
        $firstName = $userRow['first_name'];
    }
}

// FETCH ALL PRODUCTS ONCE (Remove the second $sql block further down)
$stmt = $conn->prepare("SELECT * FROM products ORDER BY date_added DESC");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        <img src="PICTURES/EcoShop_Logo_V2-2.svg" alt="EcoShop Logo" class="w-20 h-auto m-3">
    </div>

    <header class="bg-green-800 shadow-md w-full">
        <nav class="flex items-center justify-between px-6 py-4">

            <div class="flex items-center space-x-4">
                <?php if ($isLoggedIn): ?>
                    <a href="ACCOUNT-FRONTEND/account.php" class="flex items-center space-x-2 group" id="session-status-loggedin">
                        <img src="PICTURES/default-profile.svg" alt="Profile" class="w-10 h-10 rounded-full border border-green-600">
                        <span class="font-semibold text-white group-hover:text-green-200 transition">
                            <?php echo htmlspecialchars($firstName); ?>
                        </span>
                    </a>
                <?php else: ?>
                    <div class="flex space-x-2 session-status-default">
                        <a href="USER-AUTH/login.php"
                            class="px-4 py-2 text-sm font-semibold text-green-700 bg-white border border-white rounded-lg hover:bg-green-50 transition">
                            Log in
                        </a>
                        <a href="USER-AUTH/signup.php"
                            class="px-4 py-2 text-sm font-semibold text-white bg-green-700 border border-green-500 rounded-lg hover:bg-green-600 transition">
                            Sign up
                        </a>
                    </div>
                <?php endif; ?>
            </div>

            <div class="flex-grow max-w-md mx-6">
                <div class="relative">
                    <form action="PHP/search-script.php" method="GET">
                        <input type="text" name="query" placeholder="Search products..."
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-400 bg-white">
                        <button type="submit" class="absolute right-2 top-2 text-gray-500 hover:text-green-600 font-bold px-2">
                            Go
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex items-center space-x-8">
                <ul class="flex space-x-6 text-white font-medium">
                    <li><a href="ACCOUNT-FRONTEND/incoming.php" class="hover:text-green-300 transition">Orders</a></li>
                    <li><a href="ACCOUNT-FRONTEND/cart.php" class="hover:text-green-300 transition">Cart</a></li>
                    <li><a href="ACCOUNT-FRONTEND/history.php" class="hover:text-green-300 transition">History</a></li>
                    <li><a href="help.html" class="hover:text-green-300 transition">Help</a></li>
                </ul>

                <?php if ($isLoggedIn): ?>
                    <form action="PHP/clear-session-script.php" method="POST" class="ml-4">
                        <button type="submit" class="px-4 py-2 text-sm font-bold text-white bg-red-600 rounded-lg hover:bg-red-700 transition shadow-md">
                            Logout
                        </button>
                    </form>
                <?php endif; ?>
            </div>

        </nav>
    </header>

    <main class="grid grid-cols-4 gap-6 p-6 bg-gray-50 grow">


        <section class="col-span-5">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2 mt-6 px-6">Recommended</h2>

                <div class="flex overflow-x-auto gap-5 pb-4 snap-x mb-8 px-6">
                    <?php
                    if ($products):
                        foreach ($products as $row):
                    ?>
                            <div class="bg-white shadow rounded-lg p-4 flex-shrink-0 w-64 snap-start flex flex-col justify-between">
                                <div>
                                    <!-- Updated to show actual product image -->
                                    <div class="w-full h-40 bg-gray-100 rounded overflow-hidden flex items-center justify-center">
                                        <?php if (!empty($row['product_image'])): ?>
                                            <img src="PICTURES/PRODUCT-IMAGES/<?php echo $row['product_image']; ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <span class="text-gray-400 text-xs">No Image</span>
                                        <?php endif; ?>
                                    </div>

                                    <h3 class="mt-2 font-semibold text-gray-700 truncate">
                                        <?php echo htmlspecialchars($row['product_name']); ?>
                                    </h3>

                                    <p class="text-green-600 font-bold">
                                        PHP <?php echo number_format($row['price'], 2); ?>
                                    </p>

                                    <div class="flex items-center text-sm text-gray-600 mt-1">
                                        <span class="text-yellow-400 mr-1">★★★★☆</span>
                                        <span>(4.0)</span>
                                    </div>
                                </div>

                                <div class="mt-4 flex space-x-2">
                                    <form action="PHP/cart-script.php" method="POST" class="flex-grow">
                                        <input type="hidden" name="action" value="add">
                                        <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="quantity" value="1">

                                        <button type="submit" class="w-full bg-green-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-green-700 transition">
                                            Add to Cart
                                        </button>
                                    </form>

                                    <a href="product-info.php?id=<?php echo $row['id']; ?>"
                                        class="px-3 py-1.5 rounded text-sm font-medium bg-gray-50 text-gray-700 border hover:bg-gray-100 transition">
                                        View
                                    </a>
                                </div>
                            </div>
                        <?php
                        endforeach;
                    else:
                        ?>
                        <p class="text-gray-500 italic px-6">No products available.</p>
                    <?php endif; ?>
                </div>


                <h2 class="text-xl font-bold text-gray-800 mb-2 px-6">Kitchen Wares</h2>

                <div class="flex overflow-x-auto gap-5 pb-4 snap-x px-6">

                    <div
                        class="bg-white shadow rounded-lg p-4 flex-shrink-0 w-64 snap-start flex flex-col justify-between">
                        <div>
                            <img src="product1.jpg" alt="Product 1" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold text-gray-700">Bamboo Cutting Board</h3>
                            <p class="text-green-600 font-bold">PHP 150</p>
                            <div class="flex items-center text-sm text-gray-600 mt-1">
                                <span class="text-yellow-400 mr-1">★★★☆</span>
                                <span>(4.1)</span>
                            </div>
                            <div class="mt-1 text-xs px-2 py-0.5 inline-block bg-gray-100 text-gray-600 rounded">
                                Seller: <span class="font-medium text-gray-700">Seller 1</span>
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button
                                class="flex-grow bg-green-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-green-700">Add
                                to Cart</button>
                            <a href="item-details.html"
                                class="px-3 py-1.5 rounded text-sm font-medium bg-gray-50 text-gray-700 border hover:bg-gray-100 hover:border-gray-300">View</a>
                        </div>
                    </div>

                    <div
                        class="bg-white shadow rounded-lg p-4 flex-shrink-0 w-64 snap-start flex flex-col justify-between">
                        <div>
                            <img src="product2.jpg" alt="Product 2" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold text-gray-700 truncate">Metal Straw Set</h3>
                            <p class="text-green-600 font-bold">PHP 75</p>
                            <div class="flex items-center text-sm text-gray-600 mt-1">
                                <span class="text-yellow-400 mr-1">****</span>
                                <span>(5.0)</span>
                            </div>
                            <div class="mt-1 text-xs px-2 py-0.5 inline-block bg-gray-100 text-gray-600 rounded">
                                Seller: <span class="font-medium text-gray-700">Seller 2</span>
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button
                                class="flex-grow bg-green-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-green-700">Add
                                to Cart</button>
                            <a href="item-details.html"
                                class="px-3 py-1.5 rounded text-sm font-medium bg-gray-50 text-gray-700 border hover:bg-gray-100 hover:border-gray-300">View</a>
                        </div>
                    </div>

                    <div
                        class="bg-white shadow rounded-lg p-4 flex-shrink-0 w-64 snap-start flex flex-col justify-between">
                        <div>
                            <img src="product3.jpg" alt="Product 3" class="w-full h-40 object-cover rounded">
                            <h3 class="mt-2 font-semibold text-gray-700">Glass Jars with Wooden Lid</h3>
                            <p class="text-green-600 font-bold">PHP 180</p>
                            <div class="flex items-center text-sm text-gray-600 mt-1">
                                <span class="text-yellow-400 mr-1">★★★★☆</span>
                                <span>(3.8)</span>
                            </div>
                            <div class="mt-1 text-xs px-2 py-0.5 inline-block bg-gray-100 text-gray-600 rounded">
                                Seller: <span class="font-medium text-gray-700">Seller 3</span>
                            </div>
                        </div>
                        <div class="mt-4 flex space-x-2">
                            <button
                                class="flex-grow bg-green-600 text-white px-3 py-1.5 rounded text-sm font-medium hover:bg-green-700">Add
                                to Cart</button>
                            <a href="item-details.html"
                                class="px-3 py-1.5 rounded text-sm font-medium bg-gray-50 text-gray-700 border hover:bg-gray-100 hover:border-gray-300">View</a>
                        </div>
                    </div>

                </div>

            </div>
        </section>

    </main>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>

    <script src="JS/script.js"></script>
    <script src="JS/products.js"></script>
</body>

</html>