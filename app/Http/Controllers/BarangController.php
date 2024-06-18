<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\BarangMasuk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $stokFilters = [
            'min_stok' => $request->integer('min_stok') ? $request->integer('min_stok') : null,
            'max_stok' => $request->integer('max_stok') ? $request->integer('max_stok') : null,
        ];
        $searchFilter = $request->string('search');

        $filters = [
            'min_stok' => $request->integer('min_stok') ? $request->integer('min_stok') : null,
            'max_stok' => $request->integer('max_stok') ? $request->integer('max_stok') : null,
            'search' => $request->string('search')
        ];

        return inertia('Barang/Index', [
            'barang' => Barang::filterStock($stokFilters)->filterSearch($searchFilter)->with('kategori')->get(),
            'filters' => $filters
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Barang/Create', [
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'merk' => ['string', 'required'],
            'seri' => ['string', 'required'],
            'spesifikasi' => ['string', 'required'],
            'stok' => ['integer', 'min:0', 'required'],
            'kategori_id' => ['integer', 'required'],
        ]);
        $data = [
            'merk' => $request->merk,
            'seri' => $request->seri,
            'spesifikasi' => $request->spesifikasi,
            'stok' => 0,
            'kategori_id' => $request->kategori_id,
        ];
        DB::beginTransaction();
        try {
            $barangNew = Barang::create($data);
            if ($request->stok > 0){
                BarangMasuk::create([
                    'tanggal_masuk' => date('Y-m-d'),
                    'kuantitas_masuk' => $request->stok,
                    'barang_id' => $barangNew->id,
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        DB::commit();
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return inertia('Barang/Show', [
            'barang' => $barang->load('kategori')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return inertia('Barang/Edit', [
            'barang' => $barang,
            'kategori' => Kategori::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'merk' => ['string', 'required'],
            'seri' => ['string', 'required'],
            'spesifikasi' => ['string', 'required'],
            'kategori_id' => ['integer', 'required'],
        ]);
        $barang->update(
            $request->validate([
                'merk' => ['string', 'required'],
                'seri' => ['string', 'required'],
                'spesifikasi' => ['string', 'required'],
                'kategori_id' => ['integer', 'required'],
            ])
        );
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        DB::beginTransaction();
        try{
            $barang->delete();
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->route('barang.index')->withErrors(['error' => 'Data tidak dapat dihapus karena sedang digunakan oleh data lain']);
        }
        DB::commit();
        return redirect()->route('barang.index');
    }
}
