<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($request)) {
            $supplier = Supplier::where('nama_supplier', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $supplier = Supplier::paginate(5);
        }

        return view('supplier.index', ['supplier' => $supplier, 'title' => 'Data Supplier | MyRetail']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create', ['title' => 'Tambah Data Supplier | MyRetail']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Supplier::create([
            'nama_supplier'=>$request->nama_supplier,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat
        ]);
        return redirect('/supplier')->with('success', 'Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $supplier = Supplier::where('id_supplier', $id)->first();
        return view('supplier.detail', ['supplier' => $supplier], ['title' => 'Detail Data Supplier | MyRetail']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $supplier = Supplier::where('id_supplier',$id)->get();
        return view ('supplier.edit', ['supplier' => $supplier], ['title' => 'Edit Data Supplier | MyRetail']);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Supplier::where('id_supplier', $request->id_supplier)->update([
            'nama_supplier'=>$request->nama_supplier,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat        
        ]);
        return redirect('/supplier')->with('success', 'Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Supplier::where('id_supplier',$id)->delete();
        return redirect('/supplier');
    }
}
