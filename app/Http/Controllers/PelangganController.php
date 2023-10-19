<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if (!empty($request)) {
            $pelanggan = Pelanggan::where('nama_pelanggan', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $pelanggan = Pelanggan::paginate(5);
        }

        return view('pelanggan.index', ['pelanggan' => $pelanggan, 'title' => 'Data Pelanggan | MyRetail']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.create', ['title' => 'Tambah Data Pelanggan | MyRetail']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pelanggan::create([
            'nama_pelanggan'=>$request->nama_pelanggan,
            'jk'=>$request->jk,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat
        ]);
        return redirect('/pelanggan')->with('success', 'Pelanggan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan', $id)->first();
        return view('pelanggan.detail', ['pelanggan' => $pelanggan], ['title' => 'Detail Data Pelanggan | MyRetail']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pelanggan = Pelanggan::where('id_pelanggan',$id)->get();
        return view ('pelanggan.edit', ['pelanggan' => $pelanggan], ['title' => 'Edit Data Pelanggan | MyRetail']);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        Pelanggan::where('id_pelanggan', $request->id_pelanggan)->update([
            'nama_pelanggan'=>$request->nama_pelanggan,
            'jk'=>$request->jk,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat        
        ]);
        return redirect('/pelanggan')->with('success', 'Pelanggan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Pelanggan::where('id_pelanggan',$id)->delete();
        return redirect('/pelanggan');
    }
}
