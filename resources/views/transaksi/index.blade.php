@extends('navbar')

@section('content')

<div class="container">

    <h3 class="mt-3">Data Transaksi</h3>

    <form class="d-flex mt-3" role="search" method="get">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

<table class="table mt-3">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal</th>
      <th scope="col">Nama Pelanggan</th>
      <th scope="col">Total</th>
      <th scope="col">Opsi</th>
    </tr>
  </thead>
  <tbody>
        <?php $no=1 ?>
        @foreach($transaksi as $t)
    <tr>
        <th scope="row">{{$no}}</th>
        <td>{{ $t->created_at }}</td>
        <td>{{ $t->pelanggan->nama_pelanggan }}</td>
        <td>Rp. {{ $t->total }}</td>
        <td>
            <span class="badge text-bg-success"><a href="{{ route('transaksi.detail', ['id_transaksi' => $t->id_transaksi]) }}" class="btn btn-success">Detail</a></span>
        </td>
    </tr>
    <?php $no++; ?>
    @endforeach
  </tbody>
</table>
{!!$transaksi->withQueryString()->links('pagination::bootstrap-5')!!}
</div>
@endsection