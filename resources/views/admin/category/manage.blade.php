@extends('admin.layouts.layout')

@section('admin_page-title')
Manage Categories - Admin Panel
@endsection

@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">All Categories</h5>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Price</th>
                                <th>Stock</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $cat)
                                <tr>
                                    <td>{{ $cat->id }}</td>
                                    <td>{{ $cat->category_name }}</td>
                                    <td>{{ $cat->price }}</td>
                                    <td>{{ $cat->stock }}</td>
                                    <td>
                                        <a href="{{ route('category.show', $cat->id) }}" class="btn btn-info">Edit</a>
                                        <form action="{{ route('category.delete', $cat->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" value="Delete" class="btn btn-danger">
                                        </form>
                                        <form action="{{ route('category.buy', $cat->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <input type="submit" value="Buy" class="btn btn-success">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
