@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">

    <div class="card-header">
        <h3 class="card-title">Tambah Data Supplier</h3>
    </div>
    
    <div class="card-body">
    <form action="{{ route('supplier.store') }}" method="post">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" required="required">
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" required="required">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2"></textarea>
        </div>

        <a class="btn btn-success" href="/supplier" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    </div>
</div>
</div>
</div>
@endsection