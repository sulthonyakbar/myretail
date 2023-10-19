@extends('navbar')

@section('content')

<div class="container">

<h3 class="mt-3 mb-3">Detail Data Pelanggan</h3>

<table class="table mt-3">
  <tbody>
    <tr>
      <td>Nama Pelanggan</td>
      <td>:</td>
      <td>{{$pelanggan->nama_pelanggan}}</td>
    </tr>
    <tr>
      <td>Jenis Kelamin</td>
      <td>:</td>
      <td>{{$pelanggan->jk}}</td>
    </tr>
    <tr>
      <td>No Telp</td>
      <td>:</td>
      <td>{{$pelanggan->no_telp}}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{$pelanggan->alamat}}</td>
    </tr>
  </tbody>
</table>
<a class="btn btn-success" href="/pelanggan" role="button">Kembali</a>
</div>
@endsection