<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;

class Paket_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Paket Laundry';
        $paket = Paket::all();
        $outlet = Outlet::all();

        return view('paket.index',compact('title','paket','outlet'));
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
            'outlet_id' => 'required',
            'jenis_paket' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
        ]);
        $paket = Paket::create([
            'outlet_id' => $request->input('outlet_id'),
            'jenis_paket' => $request->input('jenis_paket'),
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
        ]);
        if ($paket) {
            return redirect()->route('paket.index')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->route('paket.index')->with('error', 'Data Gagal Ditambah');
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
            'outlet_id' => 'required',
            'jenis_paket' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required|numeric',
        ]);
        $paket = Paket::findOrFail($id);
        $paket->update([
            'outlet_id' => $request->input('outlet_id'),
            'jenis_paket' => $request->input('jenis_paket'),
            'nama_paket' => $request->input('nama_paket'),
            'harga' => $request->input('harga'),
        ]);
        if ($paket) {
            return redirect()->route('paket.index')->with('update', 'Data Berhasil Diedit');
        } else {
            return redirect()->route('paket.index')->with('error', 'Data Gagal Diedit');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->delete();
        
        if ($paket) {
            return redirect()->route('paket.index')->with('delete', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('paket.index')->with('error', 'Data Gagal Dihapus');
        };
    }
}
