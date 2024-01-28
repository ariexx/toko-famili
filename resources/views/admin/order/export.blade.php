<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">User Name</th>
        <th scope="col">Product Name</th>
        <th scope="col">Quantity</th>
        <th scope="col">Total</th>
        <th scope="col">Delivery Address</th>
        <th scope="col">Created At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <th>{{$order->users->name}}</th>
            <td>{{$order->orderDetails->first()->product_name}}</td>
            <td>{{$order->orderDetails->first()->quantity}}</td>
            <td>{{$order->orderDetails->first()->total}}</td>
            <td>{{$order->detail_address}}</td>
            <td>{{$order->created_at->format('Y-m-d H:i:s')}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
