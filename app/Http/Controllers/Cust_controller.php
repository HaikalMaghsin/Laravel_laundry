<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Paket;
use Illuminate\Http\Request;

class Cust_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Halaman Customer';
        $data = Customer::paginate(10);
        $paket = Paket::all();

        return view('customer.index', compact('title', 'data','paket'));
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
        $this->validate($request, [
            'email' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'paket_id' => 'required',
            'berat' => 'required'
        ]);
        $paket = Paket::where('nama_paket', $request->input('nama_paket'))->first();
        $customer = Customer::create([
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'paket_id' =>$request->input('paket_id'),
            'berat'=>$request->input('berat')
        ]);
        if ($customer) {
            return redirect()->route('customer.index')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->route('customer.index')->with('error', 'Data Gagal Ditambah');
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
            'email' => 'required',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
            'paket_id' => 'required',
            'berat' => 'required'
        ]);
        $customer = Customer::findOrFail($id);
        $customer->update([
            'email' => $request->input('email'),
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'no_hp' => $request->input('no_hp'),
            'alamat' => $request->input('alamat'),
            'paket_id' =>$request->input('paket_id'),
            'berat'=>$request->input('berat')
        ]);
        if ($customer) {
            return redirect()->route('customer.index')->with('update', 'Data Berhasil Diedit');
        } else {
            return redirect()->route('customer.index')->with('error', 'Data Gagal Diedit');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        
        if ($customer) {
            return redirect()->route('customer.index')->with('delete', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('customer.index')->with('error', 'Data Gagal Dihapus');
        };
    }
}
