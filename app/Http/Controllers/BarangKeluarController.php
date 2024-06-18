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
    public function index(Request $request)
    {
        $filters = [
            'min_tanggal' => $request->date('min_tanggal') ? $request->date('min_tanggal') : null,
            'max_tanggal' => $request->date('max_tanggal') ? $request->date('max_tanggal') : null,
            'min_keluar' => $request->integer('min_keluar') ? $request->integer('min_keluar') : null,
            'max_keluar' => $request->integer('max_keluar') ? $request->integer('max_keluar') : null
        ];

        return inertia('BarangKeluar/Index', [
            'barang_keluar' => BarangKeluar::filterDate($filters)->filterQuantity($filters)->with('barang')->get(),
            'filters' => $filters
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
        $data = $request->validate([
            'tanggal_keluar' => 'required',
            'kuantitas_keluar' => ['required', 'min:1', 'integer'],
            'barang_id' => 'required',
        ]);
        $barang = Barang::find($request->barang_id);
        if($barang->stok - $request->kuantitas_keluar < 0){
            return redirect()->back()->with(['error' => 'Stok barang akan menjadi kurang dari 0!']);
        }
        DB::beginTransaction();
        try {
            BarangKeluar::create($data);
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
            'kuantitas_keluar' => ['integer', 'min:1', 'required']
        ]));
        $barang = $barangKeluar->barang;
        if($barang->stok + $barangKeluar->kuantitas_keluar - $request->kuantitas_keluar < 0){
            return redirect()->back()->with(['error' => 'Stok barang akan menjadi kurang dari 0!']);
        }
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
