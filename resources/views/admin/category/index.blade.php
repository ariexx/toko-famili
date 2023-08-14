@extends('admin.index')
@section('content')
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Category</h1>
    </div>
    <div class="row">
        <div class="col-12 col-lg-4">
            <form action="{{route('admin.category.create')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Add Category</h5>
                    </div>
                    <div class="card-body">
                        <input type="text" class="form-control" name="name" placeholder="Input category name">
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Cancel</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Table</h5>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created At</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$category->name}}</td>
                                <td>{{$category->created_at->format('Y-m-d H:i:s')}}</td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn btn-outline-primary" style="border-radius: 2px;" href="{{route('admin.category.edit', $category->uuid)}}">Edit</a>
                                        &nbsp;
                                        <form action="{{route('admin.category.delete', $category->uuid)}}" method="post">
                                            @csrf
                                            @method('delete')
                                        <button class="btn btn-outline-danger"  style="border-radius: 2px;">Delete</button>
                                        </form>
                                    </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>
            </div>
        </div>
@endsection
