@extends('admin.index')
@section('content')
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Order List</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Table</h5>
                </div>
                <div class="card-body">
                    <a class="btn btn-outline-success" href="{{route('admin.export')}}">Export</a>
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
                    {{$orders->links()}}
                </div>
            </div>
        </div>
@endsection
