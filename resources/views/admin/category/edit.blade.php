@extends('admin.layouts.layout')

@section('admin_page-title')
Edit Category - Admin Panel
@endsection

@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('update.cat', $category_info->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label for="category_name" class="fw-bold mb-2">Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Input" value="{{ old('category_name', $category_info->category_name) }}" required>

                    <label for="price" class="fw-bold mb-2">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Price" value="{{ old('price', $category_info->price) }}" required min="0">

                    <label for="stock" class="fw-bold mb-2">Stock</label>
                    <input type="number" class="form-control" name="stock" placeholder="Stock" value="{{ old('stock', $category_info->stock) }}" required min="0">
                    
                    <button type="submit" class="btn btn-primary w-100 mt-2">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
