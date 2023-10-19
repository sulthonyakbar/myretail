<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException; 


class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($request)) {
            $transaksi = Transaksi::with('pelanggan', 'user')
            ->whereHas('pelanggan', function ($query) use ($search) {
                $query->where('nama_pelanggan', 'like', '%' . $search . '%');
            })->paginate(5);        
        } else {
            $transaksi = Transaksi::with('pelanggan', 'user') ->paginate(5);        
        }

        return view('transaksi.index', ['transaksi' => $transaksi, 'title' => 'Data Transaksi | MyRetail']); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (!Session::has('barang_kasir')) {
            Session::put('barang_kasir', []);
        }

        $searchQuery = $request->query('search');
    
        if ($searchQuery) {
            $barang = Barang::where('nama_barang', 'LIKE', '%' . $searchQuery . '%')->get();
        } else {
            $barang = Barang::all();
        }
        
        $pelanggan = Pelanggan::all();

        $barangKasir = session('barang_kasir', []);

        $total = 0;
        foreach ($barangKasir as $item) {
            $total += $item['subtotal'];
        }
        
        return view('transaksi.kasir',  compact('barang', 'pelanggan'), ['title' => 'Kasir | MyRetail']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bayar' => 'required|numeric|min:0',
        ]);

        $barangKasir = session('barang_kasir', []);

        $id_user = auth()->user()->id; 
        $id_pelanggan = $request->input('id_pelanggan');
        $bayar = $request->input('bayar');

        $total = 0;
        foreach ($barangKasir as $item) {
            $total += $item['subtotal'];
        }

        if ($request->has('submit')) {
            try {
                DB::beginTransaction();
        
                $transaksi = new Transaksi();
                $transaksi->id_user = $id_user;
                $transaksi->id_pelanggan = $id_pelanggan;
                $transaksi->total = $total;
                $transaksi->bayar = $bayar;
                $transaksi->save();
        
                foreach ($barangKasir as $item) {
                    $detailTransaksi = new DetailTransaksi();
                    $detailTransaksi->id_barang = $item['id_barang'];
                    $detailTransaksi->id_transaksi = $transaksi->id_transaksi; 
                    $detailTransaksi->harga = $item['harga'];
                    $detailTransaksi->jumlah = $item['jumlah'];
                    $detailTransaksi->subtotal = $item['subtotal'];
                    $detailTransaksi->save();

                    $barang = Barang::find($item['id_barang']);

                    if (!$barang) {
                        DB::rollback();
                        return back()->with('error', 'Barang Tidak Ditemukan.');
                    }

                    if ($barang->stok < $item['jumlah']) {
                        DB::rollback();
                        return back()->with('error', 'Stok tidak cukup untuk ' . $barang->nama_barang);
                    }

                    $barang->stok -= $item['jumlah'];
                    $barang->save();
                }   
                DB::commit();
        
                Session::forget('barang_kasir');
        
                return redirect()->route('transaksi.kasir')->with('success', 'Transaksi berhasil disimpan.');

            } catch (QueryException $e) {
                DB::rollback();
                return back()->with('error', 'Error while saving data to the database: ' . $e->getMessage());

            } catch (\Exception $e) {
                return back()->with('error', 'Error occurred: ' . $e->getMessage());
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $barangId = $request->input('id_barang');
        $jumlah = $request->input('jumlah');

        $barang = Barang::find($barangId);

        if (!$barang) {
            return back();
        }
    
        if ($jumlah > $barang->stok) {
            return back();
        }

        $barangKasir = [
            'id_barang' => $barang->id_barang,
            'nama_barang' => $barang->nama_barang,
            'harga' => $barang->harga,
            'jumlah' => $jumlah,
            'subtotal' => $barang->harga * $jumlah
        ];
    
        $barangKasirArr = session('barang_kasir', []);
        $barangKasirArr[] = $barangKasir;
        session(['barang_kasir' => $barangKasirArr]);
     
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($index)
    {
        $barangKasir = session('barang_kasir', []);

        if (isset($barangKasir[$index])) {
            unset($barangKasir[$index]);
            session(['barang_kasir' => $barangKasir]);
        }

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $transaksi = Transaksi::find($id);
    
        $detailtransaksi = DetailTransaksi::where('id_transaksi', $id)->get();
    
        return view('transaksi.detail', compact('transaksi', 'detailtransaksi'))->with('title', 'Detail Data Transaksi | MyRetail');
    }    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

}
