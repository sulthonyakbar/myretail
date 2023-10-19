@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
<div class="col-md-8">
    <div class="card">

    <div class="card-header">
        <h3 class="mt-3 mb-3">Edit Data Pelanggan</h3>
    </div>

    <div class="card-body">
    @foreach($pelanggan as $p)
    <form action="{{ route('pelanggan.update', $p->id_pelanggan) }}" method="post">
        {{csrf_field()}}
        @method('PUT')
        <input type="hidden" name="id_pelanggan" value="{{$p->id_pelanggan}}">
        <div class="mb-3">
            <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" value="{{$p->nama_pelanggan}}">
        </div>
        <div class="mb-3">
            <label for="jk" class="form-label">Jenis Kelamin</label>
            <select class="form-control" name="jk" id="jk">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="Laki-Laki" {{ $p->jk === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                <option value="Perempuan" {{ $p->jk === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>        
        </div>
        <div class="mb-3">
            <label for="no_telp" class="form-label">No Telp</label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{$p->no_telp}}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="2">{{$p->alamat}}</textarea>
        </div>

        <a class="btn btn-success" href="/pelanggan" role="button">Kembali</a>
        <button type="submit" class="btn btn-primary">Ubah</button>
    </form>
    @endforeach
    </div>
</div>
</div>
</div>
@endsection