<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use Illuminate\Http\Request;

class Outlet_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Outlet Laundry';
        $outlet = Outlet::all();
        return view('outlet.index',compact('title','outlet'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_outlet' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required' 
        ]);
        $outlet = Outlet::create([
            'nama_outlet' => $request->input('nama_outlet'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp')
        ]);
        if ($outlet) {
            return redirect()->route('outlet.index')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->route('outlet.index')->with('error', 'Data Gagal Ditambah');
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
        $this->validate($request, [
            'nama_outlet' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
        ]);
        $outlet = Outlet::findOrFail($id);
        $outlet->update([
            'nama_outlet' => $request->input('nama_outlet'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp')
        ]);
        if ($outlet) {
            return redirect()->route('outlet.index')->with('update', 'Data Berhasil Diedit');
        } else {
            return redirect()->route('outlet.index')->with('error', 'Data Gagal Diedit');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $outlet = Outlet::findOrFail($id);
        $outlet->delete();
        
        if ($outlet) {
            return redirect()->route('outlet.index')->with('delete', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('outlet.index')->with('error', 'Data Gagal Dihapus');
        };
    }
}
