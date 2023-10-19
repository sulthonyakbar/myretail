@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">

    <div class="card-header">
        <h3 class="mt-3 mb-3">Edit Data Supplier</h3>
    </div>

    <div class="card-body">
    @foreach($supplier as $s)
    <form action="{{ route('supplier.update', $s->id_supplier) }}" method="post">
        {{csrf_field()}}
        @method('PUT')
        <input type="hidden" name="id_supplier" value="{{$s->id_supplier}}">
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" value="{{$s->nama_supplier}}">
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{$s->no_telp}}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2">{{$s->alamat}}</textarea>
        </div>

        <a class="btn btn-success" href="/supplier" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
    @endforeach
    </div>
</div>
</div>
</div>
@endsection