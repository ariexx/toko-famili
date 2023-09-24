@extends('user.main-page.main')
@section('content')
<div class="container mx-auto px-6">
    <div class="h-96 overflow-hidden bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1579113800032-c38bd7635818?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80')">
        <div class="bg-gray-900 bg-opacity-50 flex items-center h-full">
            <div class="px-10 max-w-xl">
                <h2 class="text-2xl text-white font-semibold">Buah dan Sayuran</h2>
                <p class="mt-2 text-gray-400">Selamat datang di situs kami yang menyoroti keindahan alami buah-buahan dan sayuran! Temukan kelezatan dalam setiap warna dan rasa, serta nikmati manfaat kesehatan yang tak ternilai. Dari ladang langsung ke meja Anda, mari bersama-sama merayakan anugerah bumi melalui pilihan produk segar kami.</p>
                <button
                    class="flex items-center mt-4 px-3 py-2 bg-green-700 text-white text-sm uppercase font-medium hover:bg-green-500 focus:outline-none focus:bg-blue-500">
                    <span>Shop Now</span>
                    <i class="px-2 gg-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="flex flex-col py-10 md:flex-row md:py-14">

        <div
            class="mx-auto flex w-4/5 items-start justify-start pb-3 last:border-r-0 sm:w-1/2 md:w-2/5 md:flex-col md:items-center md:justify-center md:border-r-2 md:border-primary-lighter md:pb-0 md:text-center lg:mx-0 lg:w-1/3 lg:flex-row lg:text-left">
            <div>
                <i class="gg-box"></i>
            </div>
            <div class="ml-6 md:mt-3 lg:mt-0">
                <h3 class="font-hk text-xl font-semibold tracking-wide text-primary">
                    Pengiriman Gratis
                </h3>
                <p class="font-hk text-base tracking-wide text-secondary-lighter">
                    Di jarak 2 KM
                </p>
            </div>
        </div>

        <div
            class="mx-auto flex w-4/5 items-start justify-start pb-3 last:border-r-0 sm:w-1/2 md:w-2/5 md:flex-col md:items-center md:justify-center md:border-r-2 md:border-primary-lighter md:pb-0 md:text-center lg:mx-0 lg:w-1/3 lg:flex-row lg:text-left">
            <div>
                <i class="gg-phone"></i>
            </div>
            <div class="ml-6 md:mt-3 lg:mt-0">
                <h3 class="font-hk text-xl font-semibold tracking-wide text-primary">
                    Call Center
                </h3>
                <p class="font-hk text-base tracking-wide text-secondary-lighter">
                    24/7 Untuk mu
                </p>
            </div>
        </div>

        <div
            class="mx-auto flex w-4/5 items-start justify-start pb-3 last:border-r-0 sm:w-1/2 md:w-2/5 md:flex-col md:items-center md:justify-center md:border-r-2 md:border-primary-lighter md:pb-0 md:text-center lg:mx-0 lg:w-1/3 lg:flex-row lg:text-left">
            <div>
                <i class="gg-mail"></i>
            </div>
            <div class="ml-6 md:mt-3 lg:mt-0">
                <h3 class="font-hk text-xl font-semibold tracking-wide text-primary">
                    Free returns
                </h3>
                <p class="font-hk text-base tracking-wide text-secondary-lighter">
                    Pengembalian gratis jika tidak segar
                </p>
            </div>
        </div>

    </div>
@endsection
