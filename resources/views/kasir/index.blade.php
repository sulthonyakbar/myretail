@extends('navbar')

@section('content')

<div class="container">

    <h3 class="mt-3">Data Kasir</h3>

    <a class="btn btn-primary btn-sm mt-3" href="{{ route('kasir.create') }}" role="button">+ Tambah Data Kasir</a>

    <form class="d-flex mt-3" role="search" method="get">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Kasir</th>
      <th scope="col">No Telp</th>
      <th scope="col">Opsi</th>
    </tr>
  </thead>
  <tbody>
        <?php $no=1 + (($kasir->currentPage() - 1 ) * $kasir->perPage()); ?>
        @foreach($kasir as $k)
    <tr>
      <th scope="row">{{$no}}</th>
      <td>{{$k->name}}</td>
      <td>{{$k->no_telp}}</td>  
      <td>
        <span class="badge text-bg-success"><a href="{{ route('kasir.detail', $k->id) }}" class="btn btn-sm text-white">Detail</a></span>
        <span class="badge text-bg-info"><a href="{{ route('kasir.edit', $k->id) }}" class="btn btn-sm text-white">Edit</a></span>
        <span class="badge text-bg-danger">
          <form action="{{ route('kasir.destroy', $k->id) }}" method="POST">
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
{!!$kasir->withQueryString()->links('pagination::bootstrap-5')!!}
</div>
@endsection