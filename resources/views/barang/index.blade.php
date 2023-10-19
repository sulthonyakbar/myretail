@extends('navbar')

@section('content')

<div class="container">

    <h3 class="mt-3">Data Barang</h3>

    <a class="btn btn-primary btn-sm mt-3" href="{{ route('barang.create') }}" role="button">+ Tambah Data Barang</a>

    <form class="d-flex mt-3" role="search" method="get">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Stok</th>
      <th scope="col">Supplier</th>
      <th scope="col">Opsi</th>
    </tr>
  </thead>
  <tbody>
        <?php $no=1 + (($barang->currentPage() - 1 ) * $barang->perPage()); ?>
        @foreach($barang as $b)
    <tr>
      <th scope="row">{{$no}}</th>
      <td>{{$b->nama_barang}}</td>
      <td>{{$b->stok}}</td>  
      <td>{{$b->supplier->nama_supplier ?? '-'}}</td>
      <td>
        <span class="badge text-bg-success"><a href="{{ route('barang.detail', $b->id_barang) }}" class="btn btn-sm text-white">Detail</a></span>
        <span class="badge text-bg-info"><a href="{{ route('barang.edit', $b->id_barang) }}" class="btn btn-sm text-white">Edit</a></span>
        <span class="badge text-bg-danger">
          <form action="{{ route('barang.destroy', $b->id_barang) }}" method="POST">
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
{!!$barang->withQueryString()->links('pagination::bootstrap-5')!!}
</div>
@endsection