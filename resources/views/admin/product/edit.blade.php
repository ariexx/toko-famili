@extends('dashboard.admin.index')
@section('content')
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Edit Product</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12">
            <form action="{{route('admin.product.update', $product->uuid)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Edit Product</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Input product name">
                    </div>
                    <div class="card-body">
                        <select name="category" class="form-select mb-3">
                            <option value="{{$product->category_uuid}}" selected>{{$product->category->name}}</option>
                            @foreach($categories as $category)
                                <option value="{{$category->uuid}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="card-body">
                        <input type="number" class="form-control" name="price" value="{{$product->price}}" placeholder="Input product price">
                    </div>
                    <div class="card-body">
                        <input type="number" class="form-control" name="quantity" value="{{$product->quantity}}" placeholder="Input product quantity">
                    </div>
                    <div class="card-body">
                        <textarea class="form-control" name="description" rows="2" placeholder="Input product description">{{$product->description}}</textarea>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
@endsection
