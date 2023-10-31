@extends('admin.index')
@section('content')
{{--  TODO: implement apa  --}}
<h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
<div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">Total Order</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="truck"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{$totalOrder}}</h1>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">List Order</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">User Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delivery Address</th>
                            <th scope="col">Status Pembayaran</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataOrders as $order)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <th>{{$order->users->name}}</th>
                                <td>{{$order->orderDetails->first()->product_name}}</td>
                                <td>{{$order->orderDetails->first()->quantity}}</td>
                                <td>{{$order->orderDetails->first()->total}}</td>
                                <td>{{$order->detail_address}}</td>
                                <td>{{ucfirst($order->payment_status)}}</td>
                                <td>{{$order->created_at->format('Y-m-d H:i:s')}}</td>
                                <td>
                                    <a href="{{route('chat.index')}}" class="btn btn-primary">Chat Admin</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$dataOrders->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection
