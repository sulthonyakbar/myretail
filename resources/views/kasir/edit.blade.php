@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">

    <div class="card-header">
        <h3 class="mt-3 mb-3">Edit Data Kasir</h3>
    </div>

    <div class="card-body">
    @foreach($kasir as $k)
    <form action="{{ route('kasir.update', $k->id) }}" method="post">
        {{csrf_field()}}
        @method('PUT')
        <input type="hidden" name="id" value="{{$k->id}}">
        <div class="mb-3">
            <label for="name" class="form-label">Nama Kasir</label>
            <input type="text" class="form-control" name="name" id="name" value="{{$k->name}}">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" name="email" id="email" value="{{$k->email}}">
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{$k->no_telp}}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2">{{$k->alamat}}</textarea>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="text" class="form-control" name="password" id="password" value="{{$k->password}}">
        </div>

        <a class="btn btn-success" href="/datakasir" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
    @endforeach
    </div>
</div>
</div>
</div>
@endsection