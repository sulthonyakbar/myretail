@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">

    <div class="card-header">
        <h3 class="mt-3 mb-3">Edit Data Barang</h3>
    </div>

    <div class="card-body">
    @foreach($barang as $b)
    <form action="{{ route('barang.update', $b->id_barang) }}" method="post">
        {{csrf_field()}}
        @method('PUT')
        <input type="hidden" name="id_barang" value="{{$b->id_barang}}">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" name="nama_barang" id="nama_barang" value="{{$b->nama_barang}}">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" value="{{$b->harga}}">
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" name="stok" id="stok" value="{{$b->stok}}">
        </div>
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Supplier</label>
            <select class="form-control" name="id_supplier" id="nama_supplier" required>
                <option value="">Pilih Supplier</option>
                @foreach ($supplier as $item)
                    <option value="{{ $item->id_supplier }}" @if ($item->id_supplier == $barang[0]->id_supplier) selected @endif>{{ $item->nama_supplier }}</option>
                @endforeach
            </select>
        </div>

        <a class="btn btn-success" href="/barang" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
    @endforeach
    </div>
</div>
</div>
</div>
@endsection