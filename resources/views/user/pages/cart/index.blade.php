@extends('user.main-page.main')
@push('jquery')
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
@endpush
@section('content')
    <!-- #region Body -->
    <div class="container mx-auto grid md:grid-cols-3 gap-6">
        <div class="col-span-2">
            <table class="w-full text-gray-700 shadow-md">
                <thead>
                <tr class="border-b">
                    <th class="py-4 px-6 text-left font-medium uppercase">Product</th>
                    <th class="py-4 px-6 text-left font-medium uppercase">Quantity</th>
                    <th class="py-4 px-6 text-right font-medium uppercase">Price</th>
                </tr>
                </thead>
                <tbody>
                @foreach($userCarts as $cart => $v)
                    <tr class="border-b">
                        <td class="py-4 px-6 text-left">{{$v->product->name}}</td>
                        <td class="py-4 px-6 text-left">
                            <form action="{{route('cart.store')}}" method="POST" class="form-cart" data-product-uuid="{{$v->product->uuid}}">
                            <div class="flex items-center quantity">
                                <button class="decrement-cart text-gray-700 hover:text-gray-900 p-2">
                                    <i class="gg-math-minus"></i>
                                </button>
                                <input class="quantity-input mx-2 w-8 text-center" type="number" value="{{$v->quantity}}" disabled/>
                                <button class="increment-cart text-gray-700 hover:text-gray-900 p-2">
                                    <i class="gg-math-plus"></i>
                                </button>
                            </div>
                            </form>
                        </td>
                        <td class="py-4 px-6 text-right">{{rupiah($v->product->price * $v->quantity)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- Summary -->
        <div class="bg-white shadow-md">
            <table class="w-full text-gray-700">
                <tbody>
                <tr class="border-b">
                    <td class="py-4 px-6 text-left font-medium">Total</td>
                    <td class="py-4 px-6 text-right">{{$total}}</td>
                </tr>
                </tbody>
            </table>
            <div class="mx-6 my-6 flex justify-end">
                <button class="bg-green-700 text-white py-2 px-4 hover:bg-green-500">
                    Checkout now
                </button>
            </div>
        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // Attach an event listener to the buttons
            $('.decrement-cart, .increment-cart').click(function(e) {
                e.preventDefault();
                var inputElement = $(this).siblings('.quantity-input');
                var currentValue = parseInt(inputElement.val());

                if ($(this).hasClass('decrement-cart')) {
                    if (currentValue > 0) {
                        inputElement.val(currentValue - 1);
                        updateCart(inputElement);
                    }
                } else if ($(this).hasClass('increment-cart')) {
                    inputElement.val(currentValue + 1);
                    updateCart(inputElement);
                }
            });

            function updateCart(inputElement) {
                var productUuid = inputElement.closest('.form-cart').data('product-uuid');
                var newQuantity = inputElement.val();

                $.ajax({
                    type: 'POST',
                    url: '{{ route('cart.store') }}', // Update this URL to match your route for updating cart
            data: {
                type: "update",
                product_uuid: productUuid,
                quantity: newQuantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                alert("Sukses Update Cart");
                return location.reload();
            },
            error: function(xhr, status, error) {
                alert("Gagal Update Cart");
                return location.reload();
            }
        });
    }
});
    </script>
@endpush
