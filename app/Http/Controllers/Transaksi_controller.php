<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class Transaksi_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
        $outlet = Outlet::all();
        $user = User::all();
        $transaksi = Transaksi::all();
        $customer = Customer::all();
        

        return view('transaksi.index', compact( 'outlet', 'user','transaksi','customer'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $outlet = Outlet::all();
        $customer = Customer::all();
        $user = User::all();
        $paket = Paket::all();
        $data = Transaksi::all();

        $pdf = Pdf::loadView('transaksi.invoice', compact('data','outlet','customer', 'user', 'paket'));
        return $pdf->stream();
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required',
            'customer_id' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
            'tanggal_bayar' => 'required',
            'biaya_tambahan' => 'nullable',
            'diskon' => 'nullable',
            'pajak' => 'nullable',
            'status' => 'required',
            'dibayar' => 'required',
            'users_id' => 'required',
        ]);
        $transaksi = Transaksi::create([
            'outlet_id' => $request->input('outlet_id'),
            'customer_id' => $request->input('customer_id'),
            'tanggal' => $request->input('tanggal'),
            'batas_waktu' => $request->input('batas_waktu'),
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'biaya_tambahan' => $request->input('biaya_tambahan'),
            'diskon' => $request->input('diskon'),
            'pajak' => $request->input('pajak'),
            'status' => $request->input('status'),
            'dibayar' => $request->input('dibayar'),
            'users_id' => $request->input('users_id'),
        ]);
        if ($transaksi) {
            return redirect()->route('transaksi.index')->with('success', 'Data Berhasil Ditambah');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Data Gagal Ditambah');
        };
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
            'customer_id' => 'required',
            'tanggal' => 'required',
            'batas_waktu' => 'required',
            'tanggal_bayar' => 'required',
            'biaya_tambahan' => 'nullable',
            'diskon' => 'nullable',
            'pajak' => 'nullable',
            'status' => 'required',
            'dibayar' => 'required',
            'users_id' => 'required',
        ]);
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'outlet_id' => $request->input('outlet_id'),
            'customer_id' => $request->input('customer_id'),
            'tanggal' => $request->input('tanggal'),
            'batas_waktu' => $request->input('batas_waktu'),
            'tanggal_bayar' => $request->input('tanggal_bayar'),
            'biaya_tambahan' => $request->input('biaya_tambahan'),
            'diskon' => $request->input('diskon'),
            'pajak' => $request->input('pajak'),
            'status' => $request->input('status'),
            'dibayar' => $request->input('dibayar'),
            'users_id' => $request->input('users_id'),
        ]);
        if ($transaksi) {
            return redirect()->route('transaksi.index')->with('update', 'Data Berhasil Diedit');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Data Gagal Diedit');
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();
        
        if ($transaksi) {
            return redirect()->route('transaksi.index')->with('delete', 'Data Berhasil Dihapus');
        } else {
            return redirect()->route('transaksi.index')->with('error', 'Data Gagal Dihapus');
        };
    }
    
}
