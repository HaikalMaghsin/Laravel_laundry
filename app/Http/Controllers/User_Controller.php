<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class User_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::all();
        $outlet = Outlet::all();

        return view('pengguna.index', compact('user','outlet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'outlet_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'outlet_id' => $request->input('outlet_id')
        ]);
        if ($user) {
            return redirect()->route('user.index')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->route('user.index')->with('error', 'Data Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $user = User::find($id);
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'outlet_id' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
            'outlet_id' => $request->input('outlet_id')
        ]);
        if ($user) {
            return redirect()->route('user.index')->with('update', 'Data Berhasil Diupdate');
        } else {
            return redirect()->route('user.index')->with('error', 'Data Gagal Diupdate');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        if ($user) {
            return redirect()->route('user.index')->with('delete', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('user.index')->with('error', 'Data Gagal Dihapus');
        };

        
    }
}
