<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Supplier;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($request)) {
            $barang = Barang::where('nama_barang', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $barang = Barang::paginate(5);
        }
     
        return view('barang.index', compact('barang'), ['title' => 'Data Barang | MyRetail']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $supplier = Supplier::all();
        return view('barang.create', compact('supplier'), ['title' => 'Tambah Data Barang | MyRetail']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0', 
        ]);
    
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'id_supplier' => $request->id_supplier,
        ]);

        return redirect('/barang')->with('success', 'Barang created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $barang = Barang::where('id_barang', $id)->first();
        return view('barang.detail', ['barang' => $barang], ['title' => 'Detail Data Barang | MyRetail']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $barang = Barang::where('id_barang',$id)->get();
        $supplier = Supplier::all();
        return view('barang.edit',['barang' => $barang, 'supplier' => $supplier], ['title' => 'Edit Data Barang | MyRetail']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0', 
        ]);

        $barang = Barang::find($request->id_barang);
        $barang->nama_barang = $request->nama_barang;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->id_supplier = $request->id_supplier;
        $barang->save();

        return redirect('/barang')->with('success', 'Barang updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Barang::where('id_barang', $id)->delete();

        return redirect('/barang');
    }
}
