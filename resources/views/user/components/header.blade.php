<!DOCTYPE html>
<html lang="en">

<head>
    <title>{{config('app.name')}}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="referrer" content="always">
    <meta name="description" content="TailwindCSS Ecommerce Template">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link href='https://cdn.jsdelivr.net/npm/css.gg@2.0.0/icons/all.min.css' rel='stylesheet'>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{asset('assets/js/main.js')}}" defer></script>
</head>

<body>
<div x-data="{ cartOpen: false , isOpen: false }">
    <!-- #region Header -->
    <header class="bg-white">
        <div class="container mx-auto px-6 py-3">
            <div class="flex items-center justify-between">
                <div class="hidden w-full text-gray-600 md:flex md:items-center">
                    <i class="gg-profile"></i>
                </div>
                <div
                    class="w-full text-green-500 md:text-center font-mono text-3xl font-semibold uppercase tracking-widest">
                    {{config('app.name')}}
                </div>
                <div class="flex items-center justify-end w-full">
                    <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none mx-4 sm:mx-0">
                        <i class="gg-shopping-cart"></i>
                    </button>

                    <div class="flex sm:hidden">
                        <button @click="isOpen = !isOpen" type="button"
                                class="text-gray-600 hover:text-gray-500 focus:outline-none focus:text-gray-500"
                                aria-label="toggle menu">
                            <i class="gg-menu-grid-r"></i>
                        </button>
                    </div>
                </div>
            </div>
            <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{route('user.main')}}">Home</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{route('product.category')}}">Category</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="product.html">Product</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="cart.html">Cart</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="contact.html">Contact</a>
                </div>
            </nav>
            <div class="relative mt-6 max-w-lg mx-auto">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                        <i class="gg-search"></i>
                    </span>

                <input
                    class="pl-10 block w-full border-gray-300 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                    type="text" placeholder="Search">
            </div>
        </div>
    </header>
    <!-- #endregion Header -->

    <!-- #region Cart -->
    <div :class="cartOpen ? 'translate-x-0 ease-out' : 'translate-x-full ease-in'"
         class="fixed right-0 top-0 max-w-xs w-full h-full px-6 py-4 transition duration-300 transform overflow-y-auto bg-white border-l-2 border-gray-300 hidden"
         x-init="() => { $el.classList.remove('hidden'); }">
        <div class="flex items-center justify-between">
            <h3 class="text-2xl font-medium text-gray-700">Your cart</h3>
            <button @click="cartOpen = !cartOpen" class="text-gray-600 focus:outline-none">
                <i class="gg-close"></i>
            </button>
        </div>
        <hr class="my-3">
        <div class="flex justify-between mt-6">
            <div class="flex">
                <img class="h-20 w-20 object-cover" src="images/tshirt-front-white-small.png" alt="">
                <div class="mx-3">
                    <h3 class="text-sm text-gray-600">T-Shirt</h3>
                    <div class="flex items-center mt-2">
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <i class="gg-remove"></i>
                        </button>
                        <span class="text-gray-700 mx-2">2</span>
                        <button class="text-gray-500 focus:outline-none focus:text-gray-600">
                            <i class="gg-add"></i>
                        </button>
                    </div>
                </div>
            </div>
            <span class="text-gray-600">$24.99</span>
        </div>
        <a
            class="flex cursor-pointer items-center justify-center mt-4 px-3 py-2 bg-green-700 text-white text-sm uppercase font-medium hover:bg-green-500 focus:outline-none focus:bg-green-500">
            <span>Checkout</span>
            <i class="px-2 gg-arrow-right"></i>
        </a>
    </div>
    <!-- #endregion Cart -->
