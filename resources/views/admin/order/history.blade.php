@extends('admin.layouts.layout')

@section('admin_page-title')
History Order - Admin Panel
@endsection

@section('admin_layout')
<h3>Riwayat Pembelian</h3>

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

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Kategori</th>
            <th>Metode Pembayaran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($purchaseHistories as $history)
            <tr>
                <td>{{ $history->id }}</td>
                <td>{{ $history->category->category_name }}</td>
                <td>{{ $history->payment_method }}</td>
                <td>
                    <form action="{{ route('order.history.delete', $history->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Hapus" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus?');">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
