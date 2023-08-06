@extends('admin.index')
@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-lg-6">
        <form action="{{route('admin.category.update', $category->uuid)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Category</h5>
                </div>
                <div class="card-body">
                    <input type="text" class="form-control" name="name" value="{{$category->name}}">
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </form>

    </div>
@endsection
