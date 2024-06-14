<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('BarangMasuk/Index', [
            'barang_masuk' => BarangMasuk::all()->load('barang')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('BarangMasuk/Create', [
            'barang' => Barang::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            BarangMasuk::create($request->validate([
                'tanggal_masuk' => 'required',
                'kuantitas_masuk' => ['integer', 'min:1'],
                'barang_id' => 'required'
            ]));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('barang-masuk.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(BarangMasuk $barangMasuk)
    {
        return inertia('BarangMasuk/Show', [
            'barang_masuk' => $barangMasuk->load('barang')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangMasuk $barangMasuk)
    {
        return inertia('BarangMasuk/Edit', [
            'barang_masuk' => $barangMasuk,
            'barang' => Barang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangMasuk $barangMasuk)
    {
        $data = $request->validate([
            'tanggal_masuk' => ['date', 'required'],
            'kuantitas_masuk' => ['integer', 'min:1', 'required']
        ]);
        $barang = Barang::find($barangMasuk['barang_id']);
        if($barang['stok'] - $barangMasuk['kuantitas_masuk'] + $data['kuantitas_masuk'] < 0){
            return redirect()->back()->withErrors(['error' => 'Stok barang akan menjadi kurang dari 0!']);
        }
        $barangMasuk->update($data);
        return redirect()->route('barang-masuk.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barangmasuk $barangMasuk)
    {
        DB::beginTransaction();
        try {
            $barang = $barangMasuk->barang;
            if($barang['stok'] - $barangMasuk['kuantitas_masuk'] < 0){
                return redirect()->back()->withErrors(['error' => 'Stok barang akan menjadi kurang dari 0!']);
            }
            $barangMasuk->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('barang-masuk.index');
    }
}
