@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    
    <div class="card">
    <div class="card-header">
        <h3 class="card-title">Tambah Data Barang</h3>
    </div>
    
    <div class="card-body">
    <form action="{{ route('barang.store') }}" method="post">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" required="required">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" required="required">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" required="required">
        </div>
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Supplier</label>
            <select class="form-control" name="id_supplier" id="nama_supplier" required>
                <option value="">Pilih Supplier</option>
            @foreach ($supplier as $item)
                <option value="{{ $item->id_supplier }}">{{ $item->nama_supplier }}</option>
            @endforeach
        </select>
        </div>

        <a class="btn btn-success" href="/barang" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    </div>
</div>
</div>
</div>
@endsection