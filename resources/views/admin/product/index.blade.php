@extends('dashboard.admin.index')
@section('content')
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Products</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <form action="{{route('admin.product.store')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add Product</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control" name="name" placeholder="Input product name">
                    </div>
                    <div class="card-body">
                        <select name="category" class="form-select mb-3">
                            <option selected>Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{$category->uuid}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <input type="number" class="form-control" name="price" placeholder="Input product price">
                    </div>
                    <div class="card-body">
                        <input type="number" class="form-control" name="quantity" placeholder="Input product quantity">
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" name="description" rows="2" placeholder="Product Description"></textarea>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Table</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Category</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <th>{{$product->category->name}}</th>
                                <td>{{$product->name}}</td>
                                <td>{{$product->price}}</td>
                                <td>{{$product->quantity}}</td>
                                <td>{{$product->created_at->format('Y-m-d H:i:s')}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-outline-primary" style="border-radius: 2px;" href="{{route('admin.category.edit', $product->uuid)}}">Edit</a>
                                        &nbsp;
                                        <form action="{{route('admin.category.delete', $product->uuid)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-outline-danger"  style="border-radius: 2px;">Delete</button>
                                        </form>
                                    </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
                </div>
            </div>
        </div>
@endsection
