<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangKeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia('BarangKeluar/Index', [
            'barang_keluar' => BarangKeluar::all()->load('barang')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('BarangKeluar/Create', [
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
            BarangKeluar::create($request->validate([
                'tanggal_keluar' => 'required',
                'kuantitas_keluar' => ['required', 'min:0', 'integer'],
                'barang_id' => 'required',
            ]));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('barang-keluar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(barangKeluar $barangKeluar)
    {
        return inertia('BarangKeluar/Show', [
            'barang_keluar' => $barangKeluar->load('barang')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BarangKeluar $barangKeluar)
    {
        return inertia('BarangKeluar/Edit', [
            'barang_keluar' => $barangKeluar,
            'barang' => Barang::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BarangKeluar $barangKeluar)
    {
        $barangKeluar->update($request->validate([
            'tanggal_keluar' => ['date', 'required'],
            'kuantitas_keluar' => ['integer', 'min:0', 'required']
        ]));
        return redirect()->route('barang-keluar.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BarangKeluar $barangKeluar)
    {
        DB::beginTransaction();
        try {
            $barangKeluar->delete();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('barang-keluar.index');
    }
}
