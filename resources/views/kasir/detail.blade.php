@extends('navbar')

@section('content')

<div class="container">

<h3 class="mt-3 mb-3">Detail Data Kasir</h3>

<table class="table mt-3">
  <tbody>
    <tr>
      <td>Nama Kasir</td>
      <td>:</td>
      <td>{{$kasir->name}}</td>
    </tr>
    <tr>
      <td>Email</td>
      <td>:</td>
      <td>{{$kasir->email}}</td>
    </tr>
    <tr>
      <td>No Telp</td>
      <td>:</td>
      <td>{{$kasir->no_telp}}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{$kasir->alamat}}</td>
    </tr>
    <tr>
      <td>Password</td>
      <td>:</td>
      <td>{{$kasir->password}}</td>
    </tr>
  </tbody>
</table>
<a class="btn btn-success" href="/datakasir" role="button">Kembali</a>
</div>
@endsection