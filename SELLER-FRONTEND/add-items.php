<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Items to your Inventory</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="tailwind.config.js"></script>
</head>
<body>
    <main class="max-w-5xl mx-auto p-4 md:p-8 space-y-8">
    
    <nav class="flex items-center text-sm text-gray-500 mb-2">
        <a href="dashboard.html" class="hover:text-green-600 transition-colors">Dashboard</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900 font-medium">Add New Product</span>
    </nav>

    <section class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="bg-green-600 p-6 text-white">
            <h2 class="text-2xl font-bold">Product Information</h2>
            <p class="opacity-90 text-sm">Fill in the details below to list your eco-friendly item.</p>
        </div>

        <form action="#" method="POST" class="p-6 md:p-10 space-y-8">
            
            <div class="space-y-4">
                <label class="block text-sm font-bold text-gray-700 uppercase tracking-wider">Product Photos</label>
                <div class="flex items-center justify-center w-full">
                    <label class="flex flex-col items-center justify-center w-full h-48 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer bg-gray-50 hover:bg-green-50 hover:border-green-300 transition-all">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <span class="text-3xl mb-2"></span>
                            <p class="mb-2 text-sm text-gray-500 font-semibold">Click to upload or drag and drop</p>
                            <p class="text-xs text-gray-400">PNG, JPG or WEBP (Max. 5MB)</p>
                        </div>
                        <input type="file" class="hidden" accept="image/*" />
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="md:col-span-2">
                    <label for="product-name" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Product Name</label>
                    <input type="text" id="product-name" name="product-name" placeholder="e.g., Reusable Bamboo Cutlery Set" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>

                <div>
                    <label for="category" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Category</label>
                    <select id="category" name="category" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all bg-white">
                        <option value="">Select a category</option>
                        <option value="kitchen">Kitchenware</option>
                        <option value="lifestyle">Lifestyle</option>
                        <option value="personal-care">Personal Care</option>
                        <option value="fashion">Eco-Fashion</option>
                    </select>
                </div>

                <div>
                    <label for="price" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Price (₱)</label>
                    <input type="number" id="price" name="price" placeholder="0.00" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>

                <div>
                    <label for="stock" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Available Stock</label>
                    <input type="number" id="stock" name="stock" placeholder="Quantity" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>

                <div>
                    <label for="weight" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Weight (grams)</label>
                    <input type="text" id="weight" name="weight" placeholder="e.g., 250" 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all">
                </div>

                <div class="md:col-span-2">
                    <label for="description" class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wider">Product Description</label>
                    <textarea id="description" name="description" rows="4" placeholder="Tell customers about the eco-friendly materials and benefits..." 
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition-all"></textarea>
                </div>
            </div>

            <div class="flex flex-col md:flex-row gap-4 pt-4 border-t border-gray-100">
                <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-xl shadow-md transition-all active:scale-95">
                    List Product Now
                </button>
                <button type="button" class="flex-1 bg-white border border-gray-200 text-gray-500 hover:bg-gray-50 font-bold py-4 rounded-xl transition-all">
                    Discard Draft
                </button>
            </div>

        </form>
    </section>

</main>

    <footer class="bg-gray-800 text-white text-center py-4">
        <p>EcoShop, an OM-BSIT Project</p>
    </footer>

    <script src="JS/script.js"></script>
</body>
</html>