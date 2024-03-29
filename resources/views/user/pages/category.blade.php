@extends('user.main-page.main')
@push('jquery')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@endpush
@section('content')
    <!-- #region Body -->
    <div class="container grid grid-cols-4 gap-6 pt-4 pb-16 items-start mx-auto">
        <!-- #region Sidebar -->
        <div class="col-span-1 bg-white px-4 pb-6 shadow overflow-hidden">
            <div class="divide-y divide-gray-200 space-y-5">
                <div>
                    <h3 class="text-xl text-gray-800 mb-3 uppercase font-medium mt-3">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category => $value)
                        <div class="flex items-center">
                                <input type="checkbox" name="cat-1" id="cat-{{$loop->iteration}}"
                                       class="text-primary focus:ring-0 cursor-pointer">
                                <label for="cat-{{$loop->iteration}}" class="text-gray-600 ml-3 cusror-pointer">{{$value->name}}</label>
                                <div class="ml-auto text-gray-600 text-sm">({{$value->products->count()}})</div>
                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
        <!-- #endregion Sidebar -->

        <!-- #region Products -->
        <div class="col-span-3">
            <div class="flex items-center mb-4">
                <form method="GET" action="{{route('product.category')}}">
                    <select name="filter" id="filter"
                            class="w-44 text-sm text-gray-600 py-3 px-4 border-gray-300 shadow-sm focus:ring-primary focus:border-primary">
                        <option value="all">Default sorting</option>
                        <option value="best-seller">Penjualan terbanyak</option>
                    </select>
                    <button type="submit"
                        class="mr-3 ml-3 btn btn-success">
                        <i class="gg-filter"></i>
                        Filter
                    </button>
                </form>

                <div class="flex gap-2 ml-auto">
                    <div
                        class="border border-gray-900 w-10 h-9 flex items-center justify-center text-gray-600 cursor-pointer">
                        <i class="gg-layout-grid"></i>
                    </div>
                    <div
                        class="border border-gray-300 w-10 h-9 flex items-center justify-center text-gray-600 cursor-pointer">
                        <i class="gg-layout-list"></i>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6">
                @foreach($products as $product => $value)
                    <div class="bg-white shadow-md overflow-hidden">
                        <div class="relative group">
                            <img src="{{asset('images/' . $value->image)}}" alt="product 1" class="w-full">
                            <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center
                                    justify-center gap-2 opacity-0 group-hover:opacity-100 transition">
                                <a href="#"
                                   class="text-white text-lg w-9 h-8 bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                   title="view product">
                                    <i class="gg-search"></i>
                                </a>
                                <a href="#"
                                   class="text-white text-lg w-9 h-8 bg-primary flex items-center justify-center hover:bg-gray-800 transition"
                                   title="add to wishlist">
                                    <i class="gg-heart"></i>
                                </a>
                            </div>
                        </div>
                        <div class="pt-4 pb-3 px-4">
                            <a href="#">
                                <h4
                                    class="uppercase font-medium text-xl mb-2 text-gray-800 hover:text-primary transition">
                                    {{$value->name}}</h4>
                            </a>
                            <div class="flex items-baseline mb-1 space-x-2">
                                <p class="text-xl text-primary font-semibold">{{$value->rupiah_price}}</p>
                            </div>
                        </div>
                            @if(Auth::guest())
                                <a href="{{route('login')}}"
                                        class="add-to-cart block w-full py-3 text-center text-white bg-green-700 border border-primary hover:bg-green-500 transition">Add
                                    to cart</a>
                            @else
                            <form class="form-cart" action="{{route('cart.store')}}" method="POST">
                                @csrf
                                <input type="hidden" name="product_uuid" value="{{$value->uuid}}">
                                <button type="submit"
                                   class="add-to-cart block w-full py-3 text-center text-white bg-green-700 border border-primary hover:bg-green-500 transition">Add
                                    to cart</button>
                            @endif
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- #endregion Products -->
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function(){
            $(".form-cart").submit(function(r) {
            r.preventDefault();
                $.ajax({
                type: "POST",
                url: "{{route('cart.store')}}",
                data: $(this).serialize(),
                dataType: 'json',
                success: function(e) {
                    return alert("Sukses Menambah Product");
                },
                error: function(e) {
                    return alert("Gagal Menambah Produk");
                }
            });
        });
    });
    </script>
@endpush

