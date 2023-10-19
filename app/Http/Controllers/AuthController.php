<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('login', ['title' => 'Login | MyRetail']);
    }

    public function loginPost(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::guard('web')->attempt($data)) {
            if (Auth::user()->role == 'admin') {
                return redirect('/barang')->with('success', 'Login Berhasil | Selamat Datang, <b>' . htmlentities(Auth::user()->name) . '</b>');
            } else if (Auth::user()->role == 'kasir') {
                return redirect('/kasir')->with('success', 'Login Berhasil | Selamat Datang, <b>' . htmlentities(Auth::user()->name) . '</b>');
            }
        }else{
            return back()->with('error', 'Email atau Password salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = User::where('role', 'kasir');

        if (!empty($search)) {
            $kasir = $query->where('name', 'like', '%' . $search . '%')->paginate(5);
        } else {
            $kasir = $query->paginate(5);
        }

        return view('kasir.index', ['kasir' => $kasir, 'title' => 'Data Kasir | MyRetail']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kasir.create', ['title' => 'Tambah Data Kasir | MyRetail']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat,
            'role'=>'kasir',
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/datakasir');
    }

    /**
     * Display the specified resource.
     */
    public function detail($id)
    {
        $kasir = User::where('id', $id)->first();
        return view('kasir.detail', ['kasir' => $kasir], ['title' => 'Detail Data Kasir | MyRetail']);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kasir = User::where('id',$id)->get();
        return view ('kasir.edit', ['kasir' => $kasir], ['title' => 'Edit Data Kasir | MyRetail']);  
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        User::where('id', $request->id)->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'no_telp'=>$request->no_telp,
            'alamat'=>$request->alamat,
            'role'=>'kasir',
            'password' => Hash::make($request->input('password')),
        ]);
        return redirect('/datakasir');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect('/datakasir');
    }
}
    