@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">

    <div class="card-header">
        <h3 class="card-title">Tambah Data Kasir</h3>
    </div>
    
    <div class="card-body">
    <form action="{{ route('kasir.store') }}" method="post">
        {{csrf_field()}}
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kasir</label>
            <input type="text" class="form-control" name="name" id="name" required="required">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email" required="required">
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" required="required">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2"></textarea>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" id="password" required="required">
        </div>


        <a class="btn btn-success" href="/datakasir" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    </div>
</div>
</div>
</div>
@endsection