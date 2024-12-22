<!-- resources/views/admin/category/create.blade.php -->
@extends('admin.layouts.layout')

@section('admin_page-title')
Create Category - Admin Panel
@endsection

@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Category</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('store.cat') }}" method="POST">
                    @csrf
                    <label for="category_name" class="fw-bold mb-2">Category Name</label>
                    <input type="text" class="form-control" name="category_name" placeholder="Input" required>

                    <label for="price" class="fw-bold mb-2">Price</label>
                    <input type="number" class="form-control" name="price" placeholder="Price" required min="0 step="0.01">

                    <label for="stock" class="fw-bold mb-2">Stock</label>
                    <input type="number" class="form-control" name="stock" placeholder="Stock" required min="0">
                    
                    <button type="submit" class="btn btn-primary w-100 mt-2">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
