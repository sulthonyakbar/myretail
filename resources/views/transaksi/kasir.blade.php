@extends('navbar')

@section('content')

<div class="row justify-content-center mt-3">
    <div class="col-sm-8">

      @if (Session::has('error'))
      <div class="container">
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">              
            {{ Session::get('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>
      @endif

    <div class="card">

      <div class="card-header">
        <div class="row">
          <h4 class="card-title col-sm-5">Kasir MyRetail</h4>

          <button type="button" class="btn btn-primary ms-auto me-3 col-sm-2" data-bs-toggle="modal" data-bs-target="#pilihbarang">
            Pilih Barang 
          </button> 

        </div>
      </div>

    <div class="card-body">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Sub Total</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php $total = 0;?>

            @php
              $barang_kasir = Session::get('barang_kasir');
            @endphp

            @foreach($barang_kasir as $index => $item)
          <tr>
            <th scope="row">{{$no}}</th>
            <td>{{ $item['nama_barang'] }}</td>
            <td>Rp. {{ $item['harga'] }}</td>
            <td>{{ $item['jumlah'] }}</td>  
            <td>Rp. {{ $item['subtotal'] }}</td>  
            <td>
                <span class="badge text-bg-danger">
                    <form action="{{ route('transaksi.kasir.destroy', ['index' => $index]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="hapus" value="{{ $index }}" class="btn btn-sm text-white">Hapus</button>
                    </form>
                </span>
            </td>
          </tr>
          <?php 
            $no++;                  
            $total += $item['subtotal'];
          ?>
        @endforeach
        </tbody>
      </table>
    </div>

    <div class="card-footer">
      <h5><b>Total : Rp. {{ $total }}</b></h5>
   </div>
   
  </div>
</div>

<div class="col-sm-3">
  <div class="card">

    <div class="card-header">
        <h4 class="card-title">Order</h4>
    </div>
    
    <div class="card-body">
    <form action="{{ route('transaksi.kasir.store') }}" method="post">
                    @csrf
          <div class="mb-3">
              <label for="name" class="form-label">Nama Kasir</label>
              <input type="text" class="form-control" name="name" id="name" value="{{ auth()->user()->name }}" readonly>
          </div>
          <div class="mb-3">
                <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                <select class="form-control" name="id_pelanggan" id="nama_pelanggan" required>
                    <option value="">Pilih Pelanggan</option>
                    @foreach ($pelanggan as $p)
                    <option value="{{ $p->id_pelanggan }}">{{ $p->nama_pelanggan }}</option>
                    @endforeach
                </select>
          </div>
          <div class="mb-3">
              <label for="bayar" class="form-label">Bayar</label>
              <input type="number" class="form-control" name="bayar" id="bayar" placeholder="0" required="required">
          </div>
          <div class="mb-3">
              <label for="kembali" class="form-label">Kembali</label>
              <input type="number" class="form-control" name="kembali" id="kembali" value="0" readonly>
          </div>
            
                    <button type="submit" class="form-control btn btn-success" name="submit">Bayar</button>
            </form>
    </div>
</div>
</div>
</div>

<!-- Modal Pilih Barang -->
<div class="modal fade" id="pilihbarang" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Pilih Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

    <form class="d-flex mb-3" role="search" method="get">
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Stok</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Opsi</th>
          </tr>
        </thead>
        <tbody>
        <?php $no=1; ?>
        @foreach ($barang as $b)
          <tr>
            <th scope="row">{{$no}}</th>
            <td>{{$b->nama_barang}}</td>
            <td>{{$b->stok}}</td>  
            <form action="{{ route('transaksi.kasir') }}" method="POST">
                @csrf
                <input type="hidden" name="id_barang" value="{{ $b->id_barang }}">
                <td class="col-sm-2">              
                    <input type="number" class="form-control" name="jumlah" id="jumlah-{{ $b->id_barang }}" required="required">
                </td>  
                <td>
                    <span class="badge text-bg-primary">
                        <button type="submit" class="btn btn-sm text-white">+</button>
                    </span>
                </td>
            </form>
          </tr>
        <?php $no++; ?>
        @endforeach
        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>

<script>
    // Get references to the input fields for bayar and kembali
    const bayarInput = document.getElementById('bayar');
    const kembaliInput = document.getElementById('kembali');

    // Get the initial total amount from the displayed total value (from PHP)
    const totalAmount = parseFloat('{{ $total }}');

    // Add an input event listener to the bayarInput
    bayarInput.addEventListener('input', function () {
        // Get the new payment amount from the input field
        const bayarAmount = parseFloat(bayarInput.value);

        // Calculate the new kembali value
        const newKembali = bayarAmount - totalAmount;

        // Update the displayed kembali value
        kembaliInput.value = newKembali; // Display the kembali value with 2 decimal places
    });
</script>


@endsection