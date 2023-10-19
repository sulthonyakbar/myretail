@extends('navbar')

@section('content')

<div class="container">

<h3 class="mt-3 mb-3">Detail Data Supplier</h3>

<table class="table mt-3">
  <tbody>
    <tr>
      <td>Nama Supplier</td>
      <td>:</td>
      <td>{{$supplier->nama_supplier}}</td>
    </tr>
    <tr>
      <td>No Telp</td>
      <td>:</td>
      <td>{{$supplier->no_telp}}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{$supplier->alamat}}</td>
    </tr>
  </tbody>
</table>
<a class="btn btn-success" href="/supplier" role="button">Kembali</a>
</div>
@endsection