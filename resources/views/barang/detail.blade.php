@extends('navbar')

@section('content')

<div class="container">

<h3 class="mt-3 mb-3">Detail Data Barang</h3>

<table class="table mt-3">
  <tbody>
    <tr>
      <td>Nama Barang</td>
      <td>:</td>
      <td>{{$barang->nama_barang}}</td>
    </tr>
    <tr>
      <td>Harga</td>
      <td>:</td>
      <td>{{$barang->harga}}</td>
    </tr>
    <tr>
      <td>Stok</td>
      <td>:</td>
      <td>{{$barang->stok}}</td>
    </tr>
    <tr>
      <td>Supplier</td>
      <td>:</td>
      <td>{{$barang->supplier->nama_supplier}}</td>
    </tr>
  </tbody>
</table>
<a class="btn btn-success" href="/barang" role="button">Kembali</a>
</div>
@endsection