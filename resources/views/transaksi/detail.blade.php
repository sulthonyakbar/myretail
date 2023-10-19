@extends('navbar')

@section('content')

<div class="container">

<h3 class="mt-3 mb-3">Detail Data Transaksi</h3>

@foreach($detailtransaksi as $dt)
    <table class="table mt-3">
      <tbody>
        <tr>
          <td>Nama Barang</td>
          <td>:</td>
          <td>{{$dt->barang->nama_barang}}</td>
        </tr>
        <tr>
          <td>Nama Pelanggan</td>
          <td>:</td>
          <td>{{$dt->transaksi->pelanggan->nama_pelanggan}}</td>
        </tr>
        <tr>
          <td>Harga</td>
          <td>:</td>
          <td>Rp. {{$dt->harga}}</td>
        </tr>
        <tr>
          <td>Jumlah</td>
          <td>:</td>
          <td>{{$dt->jumlah}}</td>
        </tr>
        <tr>
          <td>Total</td>
          <td>:</td>
          <td>Rp. {{$dt->transaksi->total}}</td>
        </tr>
        <tr>
          <td>Bayar</td>
          <td>:</td>
          <td>Rp. {{$dt->transaksi->bayar}}</td>
        </tr>
        <tr>
          <td>Tanggal Transaksi</td>
          <td>:</td>
          <td>{{$dt->created_at}}</td>
        </tr>
      </tbody>
    </table>
@endforeach

<a class="btn btn-success" href="/transaksi" role="button">Kembali</a>
</div>
@endsection
