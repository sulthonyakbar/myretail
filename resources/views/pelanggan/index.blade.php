@extends('navbar')

@section('content')

<div class="container">

    <h3 class="mt-3">Data Pelanggan</h3>

    <a class="btn btn-primary btn-sm mt-3" href="{{ route('pelanggan.create') }}" role="button">+ Tambah Data Pelanggan</a>

    <form class="d-flex mt-3" role="search" method="get">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Pelanggan</th>
      <th scope="col">No Telp</th>
      <th scope="col">Opsi</th>
    </tr>
  </thead>
  <tbody>
        <?php $no=1 + (($pelanggan->currentPage() - 1 ) * $pelanggan->perPage()); ?>
        @foreach($pelanggan as $p)
    <tr>
      <th scope="row">{{$no}}</th>
      <td>{{$p->nama_pelanggan}}</td>
      <td>{{$p->no_telp}}</td>  
      <td>
        <span class="badge text-bg-success"><a href="{{ route('pelanggan.detail', $p->id_pelanggan) }}" class="btn btn-sm text-white">Detail</a></span>
        <span class="badge text-bg-info"><a href="{{ route('pelanggan.edit', $p->id_pelanggan) }}" class="btn btn-sm text-white">Edit</a></span>
        <span class="badge text-bg-danger">
          <form action="{{ route('pelanggan.destroy', $p->id_pelanggan) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm text-white">Hapus</button>
          </form>
        </span>
      </td>
    </tr>
    <?php $no++; ?>
     @endforeach
  </tbody>
</table>
{!!$pelanggan->withQueryString()->links('pagination::bootstrap-5')!!}
</div>
@endsection