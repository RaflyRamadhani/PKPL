@extends('admin.layouts.layout')

@section('admin_page-title')
Pilih Metode Pembayaran - Panel Admin
@endsection

@section('admin_layout')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Pilih Metode Pembayaran</h5>
            </div>
            <div class="card-body">
                <h6>Kategori yang akan dibeli:</h6>
                <p>{{ $category->category_name }}</p>

                <h6>Pilih metode pembayaran:</h6>
                <form action="{{ route('payment.process', $category->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input type="radio" name="payment_method" value="bank" required> Bank
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input type="radio" name="payment_method" value="gopay" required> Gopay
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input type="radio" name="payment_method" value="dana" required> Dana
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input type="radio" name="payment_method" value="shopee" required> Shopee
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

@endsection
