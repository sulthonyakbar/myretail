<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PelangganController;
use App\Models\Transaksi;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::post('/', [AuthController::class, 'loginPost'])->name('login');
});

Route::group(['middleware' => 'role.admin'], function () {
    Route::get('barang', [BarangController::class, 'index'])->name('barang.index');

    Route::get('barang/{id_barang}/detail', [BarangController::class, 'detail'])->name('barang.detail');

    Route::get('barang/create', [BarangController::class, 'create'])->name('barang.create');
    Route::post('barang/store', [BarangController::class, 'store'])->name('barang.store');
    
    Route::get('barang/{id_barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
    Route::put('barang/{id_barang}', [BarangController::class, 'update'])->name('barang.update');
    
    Route::delete('barang/{id_barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');

    Route::get('supplier/{id_supplier}/detail', [SupplierController::class, 'detail'])->name('supplier.detail');

    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('supplier/store', [SupplierController::class, 'store'])->name('supplier.store');
    
    Route::get('supplier/{id_supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('supplier/{id_supplier}', [SupplierController::class, 'update'])->name('supplier.update');
    
    Route::delete('supplier/{id_supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');

    Route::get('pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');

    Route::get('pelanggan/{id_pelanggan}/detail', [PelangganController::class, 'detail'])->name('pelanggan.detail');

    Route::get('pelanggan/create', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('pelanggan/store', [PelangganController::class, 'store'])->name('pelanggan.store');
    
    Route::get('pelanggan/{id_pelanggan}/edit', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('pelanggan/{id_pelanggan}', [PelangganController::class, 'update'])->name('pelanggan.update');
    
    Route::delete('pelanggan/{id_supplier}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('datakasir', [AuthController::class, 'index'])->name('pelanggan.index');

    Route::get('datakasir/{id}/detail', [AuthController::class, 'detail'])->name('kasir.detail');

    Route::get('datakasir/create', [AuthController::class, 'create'])->name('kasir.create');
    Route::post('datakasir/store', [AuthController::class, 'store'])->name('kasir.store');
    
    Route::get('datakasir/{id}/edit', [AuthController::class, 'edit'])->name('kasir.edit');
    Route::put('datakasir/{id}', [AuthController::class, 'update'])->name('kasir.update');
    
    Route::delete('datakasir/{id}', [AuthController::class, 'destroy'])->name('kasir.destroy');

    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{id_transaksi}/detail', [TransaksiController::class, 'detail'])->name('transaksi.detail');
    
});

Route::group(['middleware' => 'role.kasir'], function () {    
    Route::get('kasir', [TransaksiController::class, 'create'])->name('transaksi.kasir');
    Route::post('kasir', [TransaksiController::class, 'show'])->name('transaksi.kasir');
    Route::post('kasir/store', [TransaksiController::class, 'store'])->name('transaksi.kasir.store');
    Route::delete('kasir/{index}', [TransaksiController::class, 'destroy'])->name('transaksi.kasir.destroy');
});

Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');

