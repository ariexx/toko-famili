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
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href='https://cdn.jsdelivr.net/npm/css.gg@2.0.0/icons/all.min.css' rel='stylesheet'>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{asset('assets/js/main.js')}}" defer></script>
    @stack('jquery')
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
                <div class="flex items-center justify-end w-full relative">
                    <a href="{{route('cart.index')}}"><i class="gg-shopping-cart"></i></a>
                </div>

            </div>
            <nav :class="isOpen ? '' : 'hidden'" class="sm:flex sm:justify-center sm:items-center mt-4">
                <div class="flex flex-col sm:flex-row">
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{route('user.main')}}">Home</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{route('product.category')}}">Product</a>
                    <a class="mt-3 text-gray-600 hover:underline sm:mx-3 sm:mt-0" href="{{route('cart.index')}}">Cart</a>
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
